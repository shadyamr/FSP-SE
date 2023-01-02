@extends('layouts.app')

@section('content')

<div class="container">
    <h1><span class="badge rounded-pill bg-dark">Salaries</span></h1>
    <div class="h-100 p-5 bg-light border rounded-3">
        @if(count($employees_all) > 0)
        <div class="table-responsive">
            <table class="table table-hover table-striped table-dark table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Employee ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees_all as $employee)
                    <tr>
                        <td scope="row">{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>
                            @foreach ($employee->roles as $roles)
                                {{ $roles->role->description}}
                            @endforeach
                        </td>
                        <td>
                            {{ __('EGP ') . number_format($employee->salary, 2) }}
                        </td>
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