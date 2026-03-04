@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Phishing Campaigns</h2>
    <a href="{{ route('campaigns.create') }}" class="btn btn-primary mb-3">Create Campaign</a>
    
    @if($campaigns->isEmpty())
        <div class="alert alert-info">No campaigns created yet.</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Phishing Link</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($campaigns as $campaign)
                <tr>
                    <td>{{ $campaign->subject }}</td>
                    <td><a href="{{ $campaign->phishing_link }}" target="_blank">{{ substr($campaign->phishing_link, 0, 40) }}...</a></td>
                    <td>
                        <span class="badge bg-{{ $campaign->status === 'active' ? 'success' : 'secondary' }}">
                            {{ ucfirst($campaign->status ?? 'inactive') }}
                        </span>
                    </td>
                    <td>{{ $campaign->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('campaigns.show', $campaign->id) }}" class="btn btn-sm btn-info">View</a>
                        <form action="{{ route('campaigns.destroy', $campaign->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection