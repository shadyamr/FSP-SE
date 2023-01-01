@extends('layouts.app')

@section('content')

<div class="container">
    <h1><span class="badge rounded-pill bg-dark">Logging</span></h1>
    <div class="h-100 p-5 bg-light border rounded-3">
        @if(count($logs_all) > 0)
        <div class="table-responsive">
            <table class="table table-hover table-striped table-dark table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Log Type</th>
                        <th scope="col">Data ID</th>
                        <th scope="col">Data User</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs_all as $log)
                    <tr>
                        <td scope="row">{{ $log->id }}</td>
                        <td>{{ $log->log_type }}</td>
                        <td>{{ $log->data_id }}</td>
                        <td>
                            {{ $log->user ? $log->user->name : 'Unknown' }}
                        </td>
                        <td>{{ $log->created_at }}</td>
                        <td>{{ $log->updated_at }}</td>
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
                    <td scope="row">There are no logs available at the moment.</td>
                </tr>
            </tbody>
        </table>
        @endif
    </div>
</div>

@endsection