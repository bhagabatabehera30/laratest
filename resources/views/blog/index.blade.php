<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog List') }}
        </h2>
        <p class="text-right"><a href="{{ route('blog.create')}}" class="btn btn-primary"> Add New</a></p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <table class="table table-striped dataTable" id="blogList">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Title</th>
                          <th scope="col">Image</th>
                          <th scope="col">Date</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($blogs as $key => $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>
                            <img src="{{ url('storage/uploads/'.$blog->file) }}" alt="" title="" width="60" height="60" />
                        </td>
                        <td>{{ $blog->created_at }}</td>
                        <td>
                            @if($blog->status==1) 
                            <span class="badge badge-success">Active</span>
                            @else 
                            <span class="badge badge-warning">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('blog.edit', $blog->id) }}" class="badge badge-primary">Edit</a> | 
                            <form method="POST" action="{{ route('blog.destroy', $blog->id) }}" style="display:inline;" id="d_{{ $blog->id }}">@csrf @method('delete')
                                <button type="button" class="badge badge-danger" onclick="deleteBlog('d_{{ $blog->id }}');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</x-app-layout>
<script type="text/javascript">
    function deleteBlog(ide) {
        if(confirm('Do you want to delete?')){
            document.getElementById(ide).submit();
        }
    }
</script>

