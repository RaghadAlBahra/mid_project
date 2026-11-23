@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Spaces Management</h2>
    <a href="{{ route('spaces.create') }}" class="btn btn-primary">+ Add New Space</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Space Name</th>
                    <th>Center</th>
                    <th>Type</th>
                    <th>Capacity</th>
                    <th>Price / Hour</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($spaces as $space)
                    <tr>
                        <td class="fw-bold">{{ $space->name }}</td>
                        <td>{{ $space->center->name ?? 'N/A' }}</td>
                        <td>{{ $space->type }}</td>
                        <td>{{ $space->maximum_capacity }} persons</td>
                        <td>${{ number_format($space->hourly_price, 2) }}</td>
                        <td>
                            <span class="badge {{ $space->status == 'Available' ? 'bg-success' : 'bg-danger' }}">
                                {{ $space->status }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('spaces.show', $space->id) }}" class="btn btn-sm btn-info text-white">View</a>
                            <a href="{{ route('spaces.edit', $space->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('spaces.destroy', $space->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No spaces found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
