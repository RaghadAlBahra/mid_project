@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Employee</h2>
    <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">Back to Employees</a>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name', $employee->user->name ?? '') }}" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $employee->user->email ?? '') }}" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">New Password <span class="text-muted">(optional)</span></label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', $employee->user->phone_number ?? '') }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" value="{{ old('address', $employee->user->address ?? '') }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Job Title</label>
                    <input type="text" name="job_title" value="{{ old('job_title', $employee->job_title) }}" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Hire Date</label>
                    <input type="date" name="hire_date" value="{{ old('hire_date', $employee->hire_date) }}" class="form-control" required>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Employee</button>
            </div>
        </form>
    </div>
</div>
@endsection
