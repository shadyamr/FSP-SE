@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('access'))
        <div class="alert alert-danger" role="alert">
            {{ session('access') }}
        </div>
        @endif
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <div class="col-sm-4 mt-2">
            <div class="card">
                <div class="card-header text-center">
                    Requests
                </div>
                <div class="card-body text-center">
                    <p class="card-text"><span class="badge bg-dark">{{ $requests }}</span></p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-2">
            <div class="card">
                <div class="card-header text-center">
                    Inspections
                </div>
                <div class="card-body text-center">
                    <p class="card-text"><span class="badge bg-dark">{{ $inspections }}</span></p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-2">
            <div class="card">
                <div class="card-header text-center">
                    Categories
                </div>
                <div class="card-body text-center">
                    <p class="card-text"><span class="badge bg-dark">{{ $categories }}</span></p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-2">
            <div class="card">
                <div class="card-header text-center">
                    Items
                </div>
                <div class="card-body text-center">
                    <p class="card-text"><span class="badge bg-dark">{{ $items }}</span></p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-2">
            <div class="card">
                <div class="card-header text-center">
                    Suppliers
                </div>
                <div class="card-body text-center">
                    <p class="card-text"><span class="badge bg-dark">{{ $suppliers }}</span></p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-2">
            <div class="card">
                <div class="card-header text-center">
                    Employees
                </div>
                <div class="card-body text-center">
                    <p class="card-text"><span class="badge bg-dark">{{ $employees }}</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection