@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard Overview</h2>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Centers</h6>
                <h3 class="mb-0">{{ $stats['centers_count'] }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Spaces</h6>
                <h3 class="mb-0">{{ $stats['spaces_count'] }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Employees</h6>
                <h3 class="mb-0">{{ $stats['employees_count'] }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Customers</h6>
                <h3 class="mb-0">{{ $stats['customers_count'] }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="mb-3">Bookings by Status</h5>
        <div class="row g-3">
            <div class="col-md-3">
                <div class="p-3 border rounded">
                    <span class="badge bg-warning text-dark mb-1">Pending</span>
                    <h4 class="mb-0">{{ $stats['bookings_by_status']['Pending'] }}</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 border rounded">
                    <span class="badge bg-success mb-1">Confirmed</span>
                    <h4 class="mb-0">{{ $stats['bookings_by_status']['Confirmed'] }}</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 border rounded">
                    <span class="badge bg-danger mb-1">Rejected</span>
                    <h4 class="mb-0">{{ $stats['bookings_by_status']['Rejected'] }}</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 border rounded">
                    <span class="badge bg-secondary mb-1">Cancelled</span>
                    <h4 class="mb-0">{{ $stats['bookings_by_status']['Cancelled'] }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
