@extends('layouts.app')

@section('content')

@include('inc.alert')
<div class="container">
    <h1 class="fw-bold">New Supplier</h1>

    <div class="border border-dark mt-3 p-3">
        <form action="{{ route('supplier.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Brand name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label for="incharge_name" class="form-label">Person in Charge</label>
                <input type="text" class="form-control" name="incharge_name">
            </div>
            <div class="mb-3">
                <label for="contact_number" class="form-label">Phone</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number">
            </div>
        <div class="d-inline">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
            <a href="{{ route('supplier') }}" class="btn btn-secondary">Go Back</a>
        </div>
    </div>
</div>
@endsection
