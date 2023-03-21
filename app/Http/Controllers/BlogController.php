<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
use Illuminate\View\View;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs=Blog::all();
        return view('blog.index',['blogs'=>$blogs]);
        
    }
    public function create()
    {
        return view('blog.create');
    }
    public function store(Request $request): RedirectResponse
    {
        //dd($request);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'file' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);



        $blog=new Blog;
        $blog->title=$request->title;
        $blog->description=$request->description;
        $blog->status=$request->status;
        $blog->save();
        if($request->hasFile('file')){
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('file')->storeAs('public/uploads',$fileNameToStore);
            $blog->file = $fileNameToStore;
            $blog->save();
        }

        return Redirect::route('blog.list')->with('success', 'Blog has been updated successfully.');
    }

    public function edit($id)
    {
     $blog=Blog::findOrFail($id);
     return view('blog.edit',['blog'=>$blog]);
 }
 public function update(Request $request, $id)
 {
    $blog=Blog::findOrFail($id);
    $validArr=[
        'title' => 'required|max:255' 
    ];
    if($blog->file==null || ($request->hasFile('file'))){
        $validArr['file']='required|mimes:png,jpg,jpeg|max:2048';
    }
    $validated = $request->validate($validArr);

    $blog->title=$request->title;
    $blog->description=$request->description;
    $blog->status=$request->status;
    $blog->save();
    if($request->hasFile('file')){
        if($blog->file!=null && file_exists(storage_path('app/public/uploads/'.$blog->file))){
            @unlink(storage_path('app/public/uploads/'.$blog->file));
            $blog->file = null;
            $blog->save();
        }
        $filenameWithExt = $request->file('file')->getClientOriginalName();
            //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
        $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
        $path = $request->file('file')->storeAs('public/uploads',$fileNameToStore);
        $blog->file = $fileNameToStore;
        $blog->save();
    }

    return Redirect::route('blog.list')->with('success', 'Blog has been created successfully.');

}
public function destroy($id)
{
    $blog=Blog::findOrFail($id);
    $blog->delete();
    return Redirect::route('blog.list')->with('success', 'Blog has been deleted successfully.');
}
}
