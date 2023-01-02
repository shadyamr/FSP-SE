@extends('layouts.app')

@section('content')

<div class="container">
    <h1><span class="badge rounded-pill bg-dark">Invoices</span></h1>
    <div class="h-100 p-5 bg-light border rounded-3">
        @if(count($all_requests) > 0)
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
                    @foreach ($all_requests as $requests)
                    <tr>
                        <td scope="row">{{ $requests->id }}</td>
                        <td>{{ $requests->corporate_name }}</td>
                        <td>
                            @foreach ($requests->inspections as $inspection)
                                <ul><li>{{ __('Inspection #').$inspection->id ?? "No Inspections" }}</li></ul>
                            @endforeach
                        </td>
                        <td>{{ $requests->user ? $requests->user->name : 'Vacant' }}</td>
                        <td>
                            @foreach ($requests->inspections as $inspection)
                                <ul><li>{{ $inspection->inspector->name ?? "Vacant" }}</li></ul>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('accounting.invoice.pdf', $requests->id) }}" class="btn btn-sm btn-secondary mb-2">View</a>
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
                    <td scope="row">There are no requestss available at the moment.</td>
                </tr>
            </tbody>
        </table>
        @endif
    </div>
</div>

@endsection