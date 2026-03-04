@extends('layouts.app')
@section('content')

<div class="container mt-4">
    <h2>Edit Campaign</h2>

    <form action="{{ route('campaigns.update', $campaign->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Subject:</label>
            <input type="text" name="subject" class="form-control" value="{{ $campaign->subject }}" required>
            @error('subject')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label>Email Body:</label>
            <textarea name="email_body" class="form-control" rows="5" required>{{ $campaign->email_body }}</textarea>
            @error('email_body')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label>Phishing Link:</label>
            <input type="url" name="phishing_link" class="form-control" value="{{ $campaign->phishing_link }}" required>
            @error('phishing_link')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label>Target Emails (one per line):</label>
            <textarea name="target_emails" class="form-control" rows="5">{{ $campaign->target_emails }}</textarea>
            @error('target_emails')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label>Status:</label>
            <select name="status" class="form-control" required>
                <option value="inactive" {{ $campaign->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="active" {{ $campaign->status === 'active' ? 'selected' : '' }}>Active</option>
            </select>
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Campaign</button>
        <a href="{{ route('campaigns.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
