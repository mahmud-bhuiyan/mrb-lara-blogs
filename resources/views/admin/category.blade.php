@extends('admin.layouts.app')

@section('title')
    Categories
@endsection

@php
    $page = 'Categories';
@endphp

@section('mainpart')
    <div class="card">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">All Categories</h4>
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#CategoryAddModal">Add Category</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover text-center" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead class="bg-info text-white">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $sl => $category)
                            <tr>
                                <td>{{ ++$sl }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td class="d-flex justify-content-center">
                                    <button class="btn btn-sm btn-primary mr-2" data-toggle="modal"
                                        data-target="{{ '#CategoryEdit' . $category->id . 'Modal' }}"><i
                                            class="fas fa-edit"></i></button>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="delete btn btn-sm btn-danger"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Category Edit Modal-->
                            <div class="modal fade" id="{{ 'CategoryEdit' . $category->id . 'Modal' }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit {{ $category->name }}</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('category.update', $category->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="_method" value="put">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Category Name</label>
                                                    <input type="text" name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ $category->name }}">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>
                                                                {{ $message }}
                                                            </strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Category Description</label>
                                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ $category->description }}</textarea>
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
                                                    Category</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Category Add Modal-->
    <div class="modal fade" id="CategoryAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('category.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Category Description</label>
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
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-primary">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
