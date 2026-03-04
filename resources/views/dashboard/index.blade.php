@extends('layouts.app')
@section('content')

<div class="container-fluid mt-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <h1 class="mb-4">Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Campaigns</h5>
                    <h2 class="text-primary">{{ $totalCampaigns }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Active Campaigns</h5>
                    <h2 class="text-success">{{ $activeCampaigns }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Credentials Captured</h5>
                    <h2 class="text-danger">{{ $totalCredentialsCapture }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Clicks</h5>
                    <h2 class="text-warning">{{ $totalClicks }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('campaigns.create') }}" class="btn btn-primary">Create Campaign</a>
                    <a href="{{ route('campaigns.index') }}" class="btn btn-info">View All Campaigns</a>
                    <a href="{{ route('logs.phishing') }}" class="btn btn-danger">View Credentials</a>
                    <a href="{{ route('logs.clicks') }}" class="btn btn-warning">View Clicks</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Credentials Captured</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Campaign</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPhishingLogs as $log)
                            <tr>
                                <td><code>{{ substr($log->email, 0, 20) }}</code></td>
                                <td>
                                    @if($log->campaign)
                                        <small>{{ substr($log->campaign->subject, 0, 20) }}</small>
                                    @else
                                        <span class="badge bg-warning">Unknown</span>
                                    @endif
                                </td>
                                <td><small>{{ $log->created_at->diffForHumans() }}</small></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">No credentials captured yet</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Clicks</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>IP Address</th>
                                <th>Campaign</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentClickLogs as $log)
                            <tr>
                                <td><code>{{ $log->visitor_ip }}</code></td>
                                <td>
                                    @if($log->campaign)
                                        <small>{{ substr($log->campaign->subject, 0, 20) }}</small>
                                    @else
                                        <span class="badge bg-warning">Unknown</span>
                                    @endif
                                </td>
                                <td><small>{{ $log->created_at->diffForHumans() }}</small></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">No clicks tracked yet</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Campaigns Performance -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Top Campaigns by Performance</h5>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Campaign</th>
                                <th>Status</th>
                                <th>Clicks</th>
                                <th>Credentials</th>
                                <th>Success Rate</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($campaigns as $campaign)
                            <tr>
                                <td><strong>{{ $campaign->subject }}</strong></td>
                                <td>
                                    <span class="badge bg-{{ $campaign->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($campaign->status) }}
                                    </span>
                                </td>
                                <td>{{ $campaign->clicklogs_count }}</td>
                                <td>{{ $campaign->phishinglogs_count }}</td>
                                <td>
                                    @php
                                        $rate = $campaign->clicklogs_count > 0 ? round(($campaign->phishinglogs_count / $campaign->clicklogs_count) * 100, 2) : 0;
                                    @endphp
                                    {{ $rate }}%
                                </td>
                                <td>
                                    <a href="{{ route('campaigns.show', $campaign->id) }}" class="btn btn-sm btn-info">View</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No campaigns yet</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
