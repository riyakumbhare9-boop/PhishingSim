<h1>Campaigns</h1>

@if($campaigns->count())
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Subject</th>
            <th>Email Body</th>
            <th>Phishing Link</th>
            <th>Created At</th>
        </tr>
        @foreach($campaigns as $campaign)
            <tr>
                <td>{{ $campaign->id }}</td>
                <td>{{ $campaign->subject }}</td>
                <td>{{ $campaign->email_body }}</td>
                <td>{{ $campaign->phishing_link }}</td>
                <td>{{ $campaign->created_at }}</td>
            </tr>
        @endforeach
    </table>
@else
    <p>No campaigns found.</p>
@endif
