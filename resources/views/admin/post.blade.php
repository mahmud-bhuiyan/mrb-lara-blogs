@extends('admin.layouts.app')

@section('title')
    Posts
@endsection

@php
    $page = 'Posts';
@endphp

@section('mainpart')
    <div class="card">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">All Posts</h4>
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#PostAddModal">Add Post</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover text-center" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead class="bg-info text-white">
                        <tr>
                            <th>SL</th>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $sl => $post)
                            <tr>
                                <td>{{ ++$sl }}</td>

                                <td>
                                    <img src="{{ asset('post_thumbnails/' . $post->thumbnail) }}"
                                        alt="{{ $post->title }}"style="width: 100px;">
                                </td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->description }}</td>
                                <td>{{ $post->category_name }}</td>

                                <td class="d-flex justify-content-center">
                                    {{-- <button class="btn btn-sm btn-primary mr-2" data-toggle="modal"
                                        data-target="{{ '#postEdit' . $post->id . 'Modal' }}"><i
                                            class="fas fa-edit"></i></button>
                                <form action="{{ route('post.destroy', $post->id) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="delete btn btn-sm btn-danger"><i
                                            class="fa fa-trash"></i></button>
                                </form> --}}
                                </td>
                            </tr>

                            {{-- <!-- post Edit Modal-->
                            <div class="modal fade" id="{{ 'postEdit' . $post->id . 'Modal' }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit {{ $post->name }}</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('post.update', $post->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="_method" value="put">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">post Name</label>
                                                    <input type="text" name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ $post->name }}">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>
                                                                {{ $message }}
                                                            </strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">post Description</label>
                                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ $post->description }}</textarea>
                                                    @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>
                                                                {{ $message }}
                                                            </strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-sm btn-light"
                                                    data-dismiss="modal">Cancel</a>
                                                <button type="submit" class="btn btn-sm btn-primary">Update
                                                    post</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- post Add Modal-->
    <div class="modal fade" id="PostAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Post</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- title --}}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        {{-- category --}}
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category_id" class="form-control">
                                <option selected disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- description --}}
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                value="{{ old('description') }}" rows="5"></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        {{-- thumbnail --}}
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            <input type="file" name="thumbnail" class="form-control-file">
                        </div>

                        {{-- status --}}
                        <label for="status" class="form-check-label">
                            <input type="checkbox" name="status" id="status" value="1"> Publish Post
                        </label>


                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-primary">Add post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
