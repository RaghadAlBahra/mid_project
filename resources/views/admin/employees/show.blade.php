@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Employee #{{ $employee->id }} Details</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">Back to Employees</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <p class="mb-2"><strong>Name:</strong> {{ $employee->user->name ?? 'N/A' }}</p>
                <p class="mb-2"><strong>Email:</strong> {{ $employee->user->email ?? 'N/A' }}</p>
                <p class="mb-2"><strong>Phone Number:</strong> {{ $employee->user->phone_number ?? 'N/A' }}</p>
                <p class="mb-0"><strong>Address:</strong> {{ $employee->user->address ?? 'N/A' }}</p>
            </div>

            <div class="col-md-6">
                <p class="mb-2"><strong>Job Title:</strong> {{ $employee->job_title }}</p>
                <p class="mb-2"><strong>Hire Date:</strong> {{ $employee->hire_date }}</p>
                <p class="mb-0"><strong>Account Type:</strong> {{ $employee->user->type ?? 'employee' }}</p>
            </div>
        </div>

        <hr class="my-4">
        <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this employee?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Employee</button>
        </form>
    </div>
</div>
@endsection
