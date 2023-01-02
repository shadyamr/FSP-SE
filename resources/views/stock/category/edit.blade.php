@extends('layouts.app')

@section('content')

@include('inc.alert')
<div class="container">
    <h1 class="fw-bold">Edit Category</h1>

    <div class="border border-dark mt-3 p-3">
        <form action="{{ route('category.update' , ['id' => request()->route('id')]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}" required>
            </div>

            <div class="d-inline">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
            <a href="{{ route('category') }}" class="btn btn-secondary">Go Back</a>
            </div>
    </div>
</div>
@endsection
