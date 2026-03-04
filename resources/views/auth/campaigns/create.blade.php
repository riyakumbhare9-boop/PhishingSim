@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Campaign</h2>

    {{-- Show success / error messages --}}
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Campaign form --}}
    <form action="{{ route('campaigns.store') }}" method="POST">
        @csrf

        <div>
            <label for="subject">Subject:</label><br>
            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required>
        </div>

        <div>
            <label for="email_body">Email Body:</label><br>
            <textarea name="email_body" id="email_body" rows="5" required>{{ old('email_body') }}</textarea>
        </div>

        <div>
            <label for="phishing_link">Phishing Link:</label><br>
            <input type="url" name="phishing_link" id="phishing_link" value="{{ old('phishing_link') }}" required>
        </div>

        <button type="submit">Create Campaign</button>
    </form>
</div>
@endsection
