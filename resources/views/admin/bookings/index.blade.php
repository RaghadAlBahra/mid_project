@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Bookings Management</h2>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="row g-2 align-items-center">
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" @selected(($selectedstatus ?? '') === $status)>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>

                    <th>Customer</th>
                    <th>Center</th>
                    <th>Space</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>People</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    @php
                        $badgeClass = match ($booking->status) {
                            'Confirmed' => 'bg-success',
                            'Rejected' => 'bg-danger',
                            'Pending' => 'bg-warning text-dark',
                            default => 'bg-secondary',
                        };
                    @endphp
                    <tr>
                        <td class="fw-bold">{{ $booking->customer->user->name ?? 'N/A' }}</td>
                        <td>{{ $booking->space->center->name ?? 'N/A' }}</td>
                        <td>{{ $booking->space->name ?? 'N/A' }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                        <td>{{ $booking->number_of_people }} persons</td>
                        <td>${{ number_format($booking->total_price, 2) }}</td>

                        <td>
                            <span class="badge {{ $badgeClass }}">
                                {{ $booking->status }}
                            </span>
                        </td>

                        <td class="text-end">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-info text-white">View</a>

                            @if($booking->status === 'Pending')
                                <form action="{{ route('admin.bookings.confirm', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success">Confirm</button>
                                </form>

                                <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">No bookings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection
