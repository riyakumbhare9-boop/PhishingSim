@extends('layouts.app')
@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <h2>{{ $campaign->subject }}</h2>
            <hr>

            <div class="card">
                <div class="card-header">
                    <h5>Campaign Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Subject:</strong> {{ $campaign->subject }}</p>
                    <p><strong>Status:</strong> <span class="badge bg-{{ $campaign->status === 'active' ? 'success' : 'secondary' }}">{{ ucfirst($campaign->status) }}</span></p>
                    <p><strong>Phishing Link:</strong> <a href="{{ $campaign->phishing_link }}" target="_blank">{{ $campaign->phishing_link }}</a></p>
                    <p><strong>Email Body:</strong></p>
                    <div class="border p-3 bg-light">
                        {!! nl2br(e($campaign->email_body)) !!}
                    </div>
                    <p><strong>Created:</strong> {{ $campaign->created_at->format('M d, Y H:i') }}</p>
                    <p><strong>Last Updated:</strong> {{ $campaign->updated_at->format('M d, Y H:i') }}</p>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5>Target Emails</h5>
                </div>
                <div class="card-body">
                    @php
                        $targetEmails = $campaign->getTargetEmailsArray();
                    @endphp
                    @if(empty($targetEmails))
                        <p class="text-muted">No target emails specified.</p>
                    @else
                        <p><strong>Total Recipients:</strong> {{ count($targetEmails) }}</p>
                        <div class="border p-3 bg-light" style="max-height: 300px; overflow-y: auto;">
                            <ul class="mb-0">
                                @foreach($targetEmails as $email)
                                    <li><code>{{ $email }}</code></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5>Campaign Statistics</h5>
                </div>
                <div class="card-body">
                    @php
                        $clicks = \App\Models\Clicklog::where('campaign_id', $campaign->id)->count();
                        $phishing = \App\Models\Phishinglog::where('campaign_id', $campaign->id)->count();
                    @endphp
                    <p><strong>Total Clicks:</strong> {{ $clicks }}</p>
                    <p><strong>Credentials Captured:</strong> {{ $phishing }}</p>
                    @if($clicks > 0)
                        <p><strong>Success Rate:</strong> {{ round(($phishing / $clicks) * 100, 2) }}%</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Actions</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-warning btn-block mb-2">Edit Campaign</a>
                    
                    @if(!empty($campaign->getTargetEmailsArray()))
                        <form action="{{ route('campaigns.send-emails', $campaign->id) }}" method="POST" style="margin-bottom: 10px;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-block mb-2" onclick="return confirm('Send emails to all targets?')">
                                📧 Send Emails
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('logs.phishing') }}?campaign_id={{ $campaign->id }}" class="btn btn-danger btn-block mb-2">View Credentials</a>
                    <a href="{{ route('logs.clicks') }}?campaign_id={{ $campaign->id }}" class="btn btn-warning btn-block mb-2">View Clicks</a>
                    <a href="{{ route('export.campaign', $campaign->id) }}" class="btn btn-info btn-block mb-2">📥 Export Report</a>
                    <a href="{{ route('campaigns.index') }}" class="btn btn-secondary btn-block mb-2">Back to Campaigns</a>
                    
                    <form action="{{ route('campaigns.destroy', $campaign->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Are you sure?')">Delete Campaign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
