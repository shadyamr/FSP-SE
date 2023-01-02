@extends('layouts.app')

@section('content')

@include('inc.alert')
<div class="container">
    <h1><span class="badge rounded-pill bg-dark">Items</span></h1>
    <a href="{{ route('item.showAdd') }}" class="btn btn-success mt-3 mb-3 float-end">New Item</a>
    <table class="table table-hover table-striped table-dark table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Serial Number</th>
                <th scope="col">Category</th>
                <th scope="col">Supplier</th>
                <th scope="col">Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td>{{ $item->name }}</td>
                <td>{{ $item->serial_number }}</td>
                <td>{{ $item->category->name ?? 'N/A' }}</td>
                <td>{{ $item->supplier->name }}</td>
                @if ($item->status == '1')
                <td>
                    <h4><span class="badge rounded-pill text-bg-success">Available</span></h4>
                </td>
                @else
                <td>
                    <h4><span class="badge rounded-pill text-bg-warning">Not Available</span></h4>
                </td>
                @endif
                <td>
                    <a href="{{ route('item.showEdit' , ['id' => $item->id]) }}" class="btn btn-secondary">Edit</a>
                    <a href="{{ route('item.destroy', ['id' => $item->id]) }}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
