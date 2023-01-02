@extends('layouts.app')

@section('content')

<div class="container">
    <h1><span class="badge rounded-pill bg-dark">Employee Management</span></h1>
    <div class="h-100 p-5 bg-light border rounded-3">
        <button type="button" class="btn btn-success float-end mb-2" data-bs-toggle="modal" data-bs-target="#makeEmployeeModal">
            New Employee
        </button>
        <br><br>
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
                        <td>
                            @foreach ($employee->roles as $roles)
                            {{ $roles->role->description }}
                            @endforeach
                        </td>
                        <td>
                            {{ __('EGP ') . number_format($employee->salary, 2) }}
                        </td>
                        <td>REQ: {{ count($employee->requests) }} / INS: {{ count($employee->inspections) }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#viewModal-{{ $employee->id }}">View</button>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-secondary mb-2">Edit</a>
                            <a href="{{ route('employees.delete', $employee->id) }}" class="btn btn-sm btn-danger mb-2">Delete</a>
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
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>
</div>
<div class="modal fade" id="makeEmployeeModal" tabindex="-1" aria-labelledby="makeEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="makeEmployeeModalLabel">New Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('employees.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="employee_name">Name:</label>
                        <input class="form-control" type="text" name="employee_name" id="employee_name" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="employee_email">Email:</label>
                        <input class="form-control" type="email" name="employee_email" id="employee_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="employee_ssn">SSN:</label>
                        <input class="form-control" type="text" name="employee_ssn" id="employee_ssn" required>
                    </div>
                    <div class="mb-3">
                        <label for="employee_address">Address:</label>
                        <textarea class="form-control" type="text" name="employee_address" id="employee_address" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="employee_phone">Phone:</label>
                        <input class="form-control" type="tel" name="employee_phone" id="employee_phone" placeholder="01002010222" pattern="[0-9]{11}" required>
                    </div>
                    <div class="mb-3">
                        <label for="employee_salary">Salary:</label>
                        <input class="form-control" type="number" name="employee_salary" id="employee_salary" min="1000" max="300000" required>
                    </div>
                    <div class="mb-3">
                        <label for="employee_role">Roles:</label>
                        <select class="form-select" name="employee_role" id="employee_role" required>
                            @foreach($list_roles as $roles)
                                <option value="{{ $roles->id }}">{{ $roles->description }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="addEmployee()" class="mb-2 btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if(count($employees_all) > 0)
@foreach ($employees_all as $employees)
<div class="modal fade" id="viewModal-{{ $employees->id }}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Viewing: {{ $employees->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <h5 class="card-header">
                        <span class="fw-bold">Name: </span>{{ $employees->name }}
                    </h5>
                    <div class="card-body">
                        <h5 class="card-title"><span class="fw-bold">SSN:</span> {{ $employees->ssn ?? "Unknown" }}</h5>
                        <p class="card-text">
                            <span class="fw-bold">Address: </span>
                            {{ $employees->address ?? "Unknown" }}
                        </p>
                        <p class="card-text">
                            <span class="fw-bold">Phone: </span>
                            {{ $employees->phone ?? "Unknown" }}
                        </p>
                        <p class="card-text">
                            <span class="fw-bold">Email: </span>
                            {{ $employees->email }}
                        </p>
                        <hr>
                        <p class="card-text">
                            <span class="fw-bold">Salary: </span>
                            {{ __('EGP ') . number_format($employees->salary, 2) }}
                        </p>
                        <p class="card-text">
                            <span class="fw-bold">Account Creation:</span>
                            {{ $employees->created_at ?? "Unknown" }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif

@endsection
@section('scripts')

<script>
    function addEmployee() {
        var name = document.getElementById('employee_name').value;
        var email = document.getElementById('employee_email').value;
        var ssn = document.getElementById('employee_ssn').value;
        var address = document.getElementById('employee_address').value;
        var phone = document.getElementById('employee_phone').value;
        var salary = document.getElementById('employee_salary').value;

        axios.post('/employees', {
                employee_name: name,
                employee_email: email,
                employee_ssn: ssn,
                employee_address: address,
                employee_phone: phone,
                employee_salary: salary
            })
            .then(function(response) {
                console.log(response);
            })
            .catch(function(error) {
                console.log(error);
            });
    }
</script>
@endsection