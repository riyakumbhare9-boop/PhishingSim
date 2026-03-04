@extends('layouts.app')
@section('content')

<div class="container mt-4">
    <h2>Click Logs - Link Tracking</h2>
    
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
        <a href="{{ route('export.click-logs', request()->all()) }}" class="btn btn-success">📥 Export CSV</a>
    </div>

    @if($logs->isEmpty())
        <div class="alert alert-info">No clicks tracked yet.</div>
    @else
        <div class="card">
            <div class="card-header">
                <h5>Total Clicks: {{ $logs->total() }}</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Campaign</th>
                            <th>Visitor IP</th>
                            <th>User Agent</th>
                            <th>Referer</th>
                            <th>Clicked</th>
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
                            <td>{{ $log->visitor_ip }}</td>
                            <td>
                                <small>{{ substr($log->user_agent, 0, 50) }}...</small>
                            </td>
                            <td>
                                @if($log->referer)
                                    <small><a href="{{ $log->referer }}" target="_blank">{{ substr($log->referer, 0, 30) }}...</a></small>
                                @else
                                    <span class="text-muted">Direct</span>
                                @endif
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
