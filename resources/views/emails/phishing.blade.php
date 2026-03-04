<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h2>{{ $campaign->subject }}</h2>
    <div>
        {!! nl2br(e($campaign->email_body)) !!}
    </div>
    <br>
    <p>
        <a href="{{ $phishingLink }}" style="background-color: #1877f2; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Click Here
        </a>
    </p>
</body>
</html>
