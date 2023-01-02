@extends('layouts.app')

@section('content')

@include('inc.alert')
<div class="container">
    <h2 class="fw-bold">Edit Borrower</h2>

    <div class="border border-dark mt-3 p-3">
        <form action="{{ route('borrower.update', ['id'=>request()->route('id')]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Borrower Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $borrower->name }}" required>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="staff_id" class="form-label">Staff Id</label>
                <input type="text" name="staff_id" class="form-control" id="staff_id" value="{{ $borrower->staff_id }}"
                    required>

                @error('staff_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="item_id" class="form-label">Item</label>
                <select class="form-select" name="item_id" required>
                    @if ($items->isEmpty())
                    <option value="{{ $borrower->item_id }}" selected>{{
                        $borrower->item->name }}</option>
                    @else
                    @foreach ($items as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $borrower->item_id ? 'selected' : ''}} >{{
                        $item->name }}</option>
                    @endforeach
                    <option value="{{ $borrower->item_id }}" selected>{{
                        $borrower->item->name }}</option>
                    @endif
                </select>
                @error('item_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status" required>
                    <option value="1" {{ '1'==$borrower->status ? 'selected' : ''}}>
                        Active
                    </option>
                    <option value="0" {{ '0'==$borrower->status ? 'selected' : ''}}>
                        Returned
                    </option>
                </select>
                @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">Authorized By</label>
                <input type="text" class="form-control" value="{{ $borrower->user->name }}" disabled>
                <input type="hidden" name="user_id" value="{{ $borrower->user_id }}">

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
