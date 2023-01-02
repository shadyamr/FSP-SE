@extends('layouts.app')

@section('content')

@include('inc.alert')
<div class="container">
    <h1 class="fw-bold">Add Borrower</h1>

    <div class="border border-dark mt-3 p-3">
        <form action="{{ route('borrower.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Borrower Name</label>
                <input type="text" name="name" class="form-control" id="name" required>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="staff_id" class="form-label">Staff Id</label>
                <input type="text" name="staff_id" class="form-control" id="staff_id" required>

                @error('staff_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="item_id" class="form-label">Item</label>
                <select class="form-select" name="item_id" required>
                    @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('item_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">Authorized By</label>
                <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                @error('user_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="d-inline">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
            <a href="{{ route('borrower') }}" class="btn btn-secondary">Back</a>
            </div>
    </div>
</div>
@endsection
