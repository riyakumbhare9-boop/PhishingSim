
@extends('layouts.app')
@section('content')

<div class="container mt-4">
    <h2>Create Campaign</h2>

    <form action="{{ route('campaigns.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label>Subject:</label>
            <input type="text" name="subject" class="form-control" required>
            @error('subject')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label>Email Body:</label>
            <textarea name="email_body" class="form-control" rows="5" required placeholder="Enter your email content"></textarea>
            @error('email_body')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label>Phishing Link:</label>
            <input type="url" name="phishing_link" class="form-control" required placeholder="https://example.com/facebook-login">
            @error('phishing_link')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label>Target Emails (one per line):</label>
            <textarea name="target_emails" class="form-control" rows="5" placeholder="user1@example.com&#10;user2@example.com"></textarea>
            @error('target_emails')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Create Campaign</button>
        <a href="{{ route('campaigns.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
