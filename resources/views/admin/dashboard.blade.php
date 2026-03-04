@extends('layouts.app')
@section('content')

<div class="container mt-4">
    <h2>Admin Dashboard</h2>

    @if(!auth()->user()->isAdmin())
        <div class="alert alert-danger">Access Denied. You must be an admin to view this page.</div>
    @else
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <h2 class="text-primary">{{ \App\Models\User::count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Admin Users</h5>
                        <h2 class="text-danger">{{ \App\Models\User::where('role', 'admin')->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Regular Users</h5>
                        <h2 class="text-info">{{ \App\Models\User::where('role', 'user')->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Campaigns</h5>
                        <h2 class="text-success">{{ \App\Models\Campaign::count() }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Admin Actions</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Manage Users</a>
                        <a href="{{ route('logs.phishing') }}" class="btn btn-danger">View All Credentials</a>
                        <a href="{{ route('logs.clicks') }}" class="btn btn-warning">View All Clicks</a>
                        <a href="{{ route('export.phishing-logs') }}" class="btn btn-success">Export All Credentials</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection
