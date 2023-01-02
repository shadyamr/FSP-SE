@extends('layouts.app')

@section('content')

<div class="container">
    <div class="h-100 p-5 bg-light border rounded-3">
        <h2 class="fw-bold">Edit Employee — (User ID: {{ $employee->id }})</h2>
        <div class="d-inline">
            <p>Editing the profile of {{ $employee->name }}</p>
        </div>

        <form method="POST" action="{{ route('employees.store.edit', $employee->id) }}">
        @csrf
            <div class="mb-3">
                <label for="employee_name" class="form-label">Employee Name:</label>
                <input type="text" class="form-control" id="employee_name" name="employee_name" value="{{ $employee->name }}" required>
            </div>

            <div class="mb-3">
                <label for="employee_email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="employee_email" name="employee_email" value="{{ $employee->email }}" required>
            </div>
            <div class="mb-3">
                <label for="employee_ssn" class="form-label">SSN:</label>
                <input type="text" class="form-control" id="employee_ssn" name="employee_ssn" value="{{ $employee->ssn }}" required>
            </div>
            <div class="mb-3">
                <label for="employee_address" class="form-label">Address:</label>
                <textarea class="form-control" id="employee_address" name="employee_address" required>{{ $employee->address }}</textarea>
            </div>
            <div class="mb-3">
                <label for="employee_phone" class="form-label">Phone:</label>
                <input class="form-control" type="tel" name="employee_phone" id="employee_phone" placeholder="01002010222" pattern="[0-9]{11}" value="{{ $employee->phone }}" required>
            </div>
            <div class="mb-3">
                <label for="employee_role" class="form-label">Role:</label>
                <select class="form-select" name="employee_role" id="employee_role" required>
                    @foreach($list_roles as $roles)
                        <option value="{{ $roles->id }}">{{ $roles->description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="employee_password" class="form-label">Password:</label>
                <input class="form-control" type="password" name="employee_password" id="employee_password">
            </div>
            <div class="d-inline">
                <button type="submit" onclick="editEmployee()" class="btn btn-primary">Save</button>
                <a href="../" class="btn btn-secondary">Go Back</a>
            </div>
        </form>

        @if (session('success'))
        <div class="mt-2 alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
        <div class="mt-2 alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>
</div>

@endsection
@section('scripts')

<script>
    function editEmployee() {
        var name = document.getElementById('employee_name').value;
        var email = document.getElementById('employee_email').value;
        var ssn = document.getElementById('employee_ssn').value;
        var address = document.getElementById('employee_address').value;
        var phone = document.getElementById('employee_phone').value;
        var role = document.getElementById('employee_role').value;
        var password = document.getElementById('employee_pasword').value;

        axios.post('/edit-employee', {
                employee_name: name,
                employee_email: email,
                employee_ssn: ssn,
                employee_address: address,
                employee_phone: phone,
                employee_role: role,
                employee_pasword: password,
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