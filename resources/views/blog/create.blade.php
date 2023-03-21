<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="post" action="{{ route('blog.store') }}" class="mt-6 space-y-6" enctype='multipart/form-data'>
                        @csrf



                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ old('title', null) }}" required>
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" rows="5" name="description">{!! old('description', null) !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">Image</label>
                                <input type="file" name="file" class="form-control" id="file" required>
                                <x-input-error class="mt-2" :messages="$errors->get('file')" required/>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" id="status" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Submit') }}</x-primary-button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </x-app-layout>

