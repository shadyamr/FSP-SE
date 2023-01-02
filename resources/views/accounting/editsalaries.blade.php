@extends('layouts.app')

@section('content')

<div class="container">
    <div class="h-100 p-5 bg-light border rounded-3">
        <h2 class="fw-bold">Edit Salary — (User ID: {{ $edit_user_salary->id }})</h2>
        <div class="d-inline">
            <p>Editing the salary of {{ $edit_user_salary->name }}</p>
        </div>

        <form method="POST" action="{{ route('accounting.salaries.store.edit', $edit_user_salary->id) }}">
        @csrf
            <div class="mb-3">
                <label for="employee_name" class="form-label">Employee Name:</label>
                <input class="form-control" id="employee_name" name="employee_name" value="{{ $edit_user_salary->name }}" disabled>
            </div>
            <div class="mb-3">
                <label for="salary" class="form-label">Salary:</label>
                <input class="form-control" type="number" name="salary" id="salary" min="1000" max="300000" value="{{ $edit_user_salary->salary }}" required>
            </div>
            <div class="mb-3">
                <input class="form-control" type="hidden" name="o_salary" id="o_salary" value="{{ $edit_user_salary->salary }}">
            </div>
            <div class="d-inline">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href=".." class="btn btn-secondary">Go Back</a>
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
    function editSalary() {
        var name = document.getElementById('employee_name').value;
        var esalary = document.getElementById('salary').value;
        var oldsalary = document.getElementById('o_salary').value;

        axios.post('/edit_user_salary', {
                employee_name: name,
                salary: esalary,
                o_salary: oldsalary
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