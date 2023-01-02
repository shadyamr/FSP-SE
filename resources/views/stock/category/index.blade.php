@extends('layouts.app')

@section('content')

@include('inc.alert')
<div class="container">
    <h1><span class="badge rounded-pill bg-dark">Categories</span></h1>
    <div class="h-100 p-5 bg-light border rounded-3">
        <a href="{{ route('category.showAdd') }}" class="btn btn-success mb-3 float-end">New Category</a>
        <table class="table table-hover table-striped table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('category.showEdit', ['id'=> $category->id]) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <a href="{{ route('category.destroy', ['id'=>$category->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection