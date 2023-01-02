@extends('layouts.app')

@section('content')

<div class="container">
    <h1><span class="badge rounded-pill bg-dark">Invoices</span></h1>
    <div class="h-100 p-5 bg-light border rounded-3">
        @if(count($employees_all) > 0)
        <div class="table-responsive">
            <table class="table table-hover table-striped table-dark table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Request ID</th>
                        <th scope="col">Corporate</th>
                        <th scope="col">Inspections List</th>
                        <th scope="col">Sales Handler</th>
                        <th scope="col">Inspector</th>
                        <th scope="col">Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees_all as $employee)
                    <tr>
                        <td scope="row">{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->data_id }}</td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="{{ route('accounting.invoice.pdf') }}" class="btn btn-sm btn-secondary mb-2">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <table class="table table-hover table-striped table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">Empty Data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">There are no employees available at the moment.</td>
                </tr>
            </tbody>
        </table>
        @endif
    </div>
</div>

@endsection