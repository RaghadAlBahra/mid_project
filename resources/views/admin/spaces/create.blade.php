@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Add New Space</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('spaces.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Select Center</label>
                        <select name="center_id" class="form-select" required>
                            <option value="">-- Choose Center --</option>
                            @foreach($centers as $center)
                                <option value="{{ $center->id }}" {{ old('center_id') == $center->id ? 'selected' : '' }}>
                                    {{ $center->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Space Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Space Type (e.g., Meeting Room, Desk)</label>
                        <input type="text" name="type" class="form-control" value="{{ old('type') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Maximum Capacity</label>
                            <input type="number" name="maximum_capacity" class="form-control" value="{{ old('maximum_capacity') }}" min="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price Per Hour ($)</label>
                            <input type="number" step="1" name="hourly_price" class="form-control" value="{{ old('hourly_price') }}" min="0" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Available</option>
                            <option value="Maintenance" {{ old('status') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Save Space</button>
                    <a href="{{ route('spaces.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
