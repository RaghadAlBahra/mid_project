@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Centers Management</h2>
    <a href="{{ route('centers.create') }}" class="btn btn-primary">+ Add New Center</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    
                    <th>Name</th>
                    <th>City</th>
                    <th>Contact Number</th>
                    <th>Status</th>

                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($centers as $center)
                    <tr>
                        <td class="fw-bold">{{ $center->name }}</td>
                        <td>{{ $center->city }}, {{ $center->country }}</td>
                        <td>{{ $center->contact_number }}</td>
                        <td>
                            <span class="badge {{ $center->status == 'Active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $center->status }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('centers.show', $center->id) }}" class="btn btn-sm btn-info text-white">View</a>
                            <a href="{{ route('centers.edit', $center->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('centers.destroy', $center->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No centers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
