@extends('layouts.app')

@section('content')

@include('inc.alert')
<div class="container">
    <h1><span class="badge rounded-pill bg-dark">Borrowers</span></h1>
    <div class="h-100 p-5 bg-light border rounded-3">
        <a href="{{ route('borrower.showAdd') }}" class="btn btn-success mb-3 float-end">Add New Borrower</a>
        <table class="table table-hover table-striped table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Borrower Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Borrow Date</th>
                    <th scope="col">Staff ID</th>
                    <th scope="col">Item</th>
                    <th scope="col">Authorized By</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($borrowers as $borrower)
                <tr>
                    <th scope="row">{{ $borrower->id }}</th>
                    <td>{{ $borrower->name }}</td>
                    <td>
                        @if ($borrower->status == 1)
                        <h5><span class="badge rounded-pill text-bg-success">Active</span></h5>
                        @else

                        <h5><span class="badge rounded-pill text-bg-warning">Returned</span></h5>
                        @endif
                    </td>
                    <td>{{ $borrower->created_at->format('d-M-Y') }}</td>
                    <td>{{ $borrower->staff_id }}</td>
                    <td>{{ $borrower->item->name }}</td>
                    <td>{{ $borrower->user->name }}</td>
                    <td>
                        <a href="{{ route('borrower.showEdit', ['id' => $borrower->id]) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <a href="{{ route('borrower.destroy', ['id' => $borrower->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection