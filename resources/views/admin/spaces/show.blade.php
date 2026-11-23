@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Space Details: {{ $space->name }}</h2>
    <div>
        <a href="{{ route('spaces.edit', $space->id) }}" class="btn btn-warning">Edit Space</a>
        <a href="{{ route('spaces.index') }}" class="btn btn-secondary">Back to Spaces</a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Space Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Space Name:</strong> {{ $space->name }}</p>
                <p><strong>Parent Center:</strong>
                    @if($space->center)
                        <a href="{{ route('centers.show', $space->center->id) }}" class="text-decoration-none fw-bold">
                            {{ $space->center->name }}
                        </a>
                    @else
                        <span class="text-muted">N/A</span>
                    @endif
                </p>
                <p><strong>Space Type:</strong> {{ $space->type }}</p>
                <p><strong>Maximum Capacity:</strong> {{ $space->maximum_capacity }} persons</p>
                <p><strong>Price Per Hour:</strong> ${{ number_format($space->hourly_price, 2) }}</p>
                <p><strong>Status:</strong>
                    <span class="badge {{ $space->status == 'Available' ? 'bg-success' : 'bg-danger' }}">
                        {{ $space->status }}
                    </span>
                </p>
                <p><strong>Description:</strong> {{ $space->description ?? 'No description provided.' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
