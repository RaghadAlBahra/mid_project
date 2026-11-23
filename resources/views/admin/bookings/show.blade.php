@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Booking #{{ $booking->id }} Details</h2>
    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Back to Bookings</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@php
    $badgeClass = match ($booking->status) {
        'Confirmed' => 'bg-success',
        'Rejected' => 'bg-danger',
        'Pending' => 'bg-warning text-dark',
        default => 'bg-secondary',
    };
@endphp

<div class="card shadow-sm">
    <div class="card-body p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <p class="mb-2">
                    <strong>Status:</strong>
                    <span class="badge {{ $badgeClass }}">{{ $booking->status }}</span>
                </p>
                <p class="mb-2">
                    <strong>Customer:</strong>
                    {{ $booking->customer->user->name ?? 'N/A' }}
                    @if(!empty($booking->customer->user->email))
                        <span class="text-muted">({{ $booking->customer->user->email }})</span>
                    @endif
                </p>
                <p class="mb-2">
                    <strong>Center:</strong>
                    {{ $booking->space->center->name ?? 'N/A' }}
                </p>
                <p class="mb-0">
                    <strong>Space:</strong>
                    {{ $booking->space->name ?? 'N/A' }}
                </p>
            </div>

            <div class="col-md-6">
                <p class="mb-2">
                    <strong>Booking Date:</strong>
                    {{ $booking->booking_date }}
                </p>
                <p class="mb-2">
                    <strong>Time Range:</strong>
                    {{ $booking->start_time }} - {{ $booking->end_time }}
                </p>
                <p class="mb-2">
                    <strong>Number of People:</strong>
                    {{ $booking->number_of_people }} persons
                </p>
                <p class="mb-0">
                    <strong>Total Price:</strong>
                    ${{ number_format($booking->total_price, 2) }}
                </p>
            </div>
        </div>

        @if($booking->status === 'Pending')
            <hr class="my-4">
            <div class="d-flex gap-2">
                <form method="POST" action="{{ route('admin.bookings.confirm', $booking->id) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">Confirm Booking</button>
                </form>

                <form method="POST" action="{{ route('admin.bookings.reject', $booking->id) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger">Reject Booking</button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
