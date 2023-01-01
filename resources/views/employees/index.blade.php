@extends('layouts.app')

@section('content')

<div class="container">
    <h1><span class="badge rounded-pill bg-dark">Employees</span></h1>
    <div class="h-100 p-5 bg-light border rounded-3">
        @if(count($employees_all) > 0)
        <div class="table-responsive">
            <table class="table table-hover table-striped table-dark table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Number of Requests & Inspections</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees_all as $employee)
                    <tr>
                        <td scope="row">{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td></td>
                        <td>
                            {{ __('EGP ') . number_format($employee->salary, 2) }}
                        </td>
                        <td>REQ: {{ count($employee->requests) }} / INS: {{ count($employee->inspections) }}</td>
                        <td>
                            <a href="{{ route('accounting.salaries.edit', $employee->id) }}" class="btn btn-sm btn-secondary mb-2">Edit</a>
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