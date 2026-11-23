@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Center Details: {{ $center->name }}</h2>
    <div>
        <a href="{{ route('centers.edit', $center->id) }}" class="btn btn-warning">Edit Center</a>
        <a href="{{ route('centers.index') }}" class="btn btn-secondary">Back to Centers</a>
    </div>
</div>

<div class="row">
    <!-- Center Information Card -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">General Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $center->name }}</p>
                <p><strong>City & Country:</strong> {{ $center->city }}, {{ $center->country }}</p>
                <p><strong>Address:</strong> {{ $center->address }}</p>
                <p><strong>Contact Number:</strong> {{ $center->contact_number }}</p>
                <p><strong>Status:</strong>
                    <span class="badge {{ $center->status == 'Active' ? 'bg-success' : 'bg-secondary' }}">
                        {{ $center->status }}
                    </span>
                </p>
                <p><strong>Description:</strong> {{ $center->description ?? 'No description provided.' }}</p>
            </div>
        </div>
    </div>

    <!-- Associated Spaces Card -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Spaces in this Center</h5>
            </div>
            <div class="card-body">
                @if($center->spaces->count() > 0)
                    <ul class="list-group">
                        @foreach($center->spaces as $space)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $space->name }}</strong><br>
                                    <small class="text-muted">Type: {{ $space->type }} | Capacity: {{ $space->maximum_capacity }} persons</small>
                                </div>
                                <span class="badge bg-primary">
                                    ${{ number_format($space->price_per_hour, 2) }} / hr
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted text-center my-3">No spaces registered under this center yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
