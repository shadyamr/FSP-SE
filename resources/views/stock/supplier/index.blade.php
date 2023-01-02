@extends('layouts.app')

@section('content')

@include('inc.alert')
<div class="container">
    <h1><span class="badge rounded-pill bg-dark">Suppliers</span></h1>
    <div class="h-100 p-5 bg-light border rounded-3">
        <a href="{{ route('supplier.showAdd') }}" class="btn btn-success mb-3 float-end">New Supplier</a>
        <table class="table table-hover table-striped table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Brand Name</th>
                    <th scope="col">Person in Charge</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                <tr>
                    <th scope="row">{{ $supplier->id }}</th>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->incharge_name }}</td>
                    <td>{{ $supplier->contact_number }}</td>
                    <td>
                        <a href="{{ route('supplier.showEdit', ['id'=>$supplier->id]) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <a href="{{ route('supplier.destroy', ['id'=>$supplier->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection