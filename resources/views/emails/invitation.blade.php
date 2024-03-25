<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation Email</title>
</head>
<body>
<h2>Hello {{ $name }}</h2>
<p>{{ $description }}</p>

@if (!empty($attachmentUrls))
    <p>Attachments:</p>
    <ul>
        @foreach ($attachmentUrls as $url)
            <li><a href="{{ $url }}">{{ $url }}</a></li>
        @endforeach
    </ul>
@endif
</body>
</html>
