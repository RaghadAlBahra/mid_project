@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Employees Management</h2>
    <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">+ Add New Employee</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Employee Name</th>
                    <th>Email</th>
                    <th>Job Title</th>
                    <th>Hire Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $employee)
                    <tr>
                        <td class="fw-bold">{{ $employee->user->name ?? 'N/A' }}</td>
                        <td>{{ $employee->user->email ?? 'N/A' }}</td>
                        <td>{{ $employee->job_title }}</td>
                        <td>{{ $employee->hire_date }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this employee?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                            <a href="{{ route('admin.employees.show', $employee->id) }}" class="btn btn-sm btn-info text-white">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No employees found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $employees->links() }}
        </div>
    </div>
</div>
@endsection
