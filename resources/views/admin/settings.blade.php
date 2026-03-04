@extends('layouts.app')
@section('content')

<div class="container mt-4">
    <h2>Admin Settings</h2>

    <div class="card">
        <div class="card-header">
            <h5>System Settings</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label>Application Name:</label>
                    <input type="text" name="app_name" class="form-control" value="{{ config('app.name') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label>Mail From Address:</label>
                    <input type="email" name="email_from" class="form-control" value="{{ env('MAIL_FROM_ADDRESS', 'noreply@example.com') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label>Phishing Domain (for tracking links):</label>
                    <input type="text" name="phishing_domain" class="form-control" value="{{ env('PHISHING_DOMAIN', 'localhost') }}" required>
                </div>

                <button type="submit" class="btn btn-success">Save Settings</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5>System Information</h5>
        </div>
        <div class="card-body">
            <p><strong>Laravel Version:</strong> {{ app()::VERSION }}</p>
            <p><strong>PHP Version:</strong> {{ phpversion() }}</p>
            <p><strong>Environment:</strong> {{ config('app.env') }}</p>
        </div>
    </div>
</div>

@endsection
