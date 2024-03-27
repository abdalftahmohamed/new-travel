<!DOCTYPE html>
<html>
<head>
    <title>{{ $invitation->subject }}</title>
</head>
<body>
<h1>Congratulations : {{ $invitation->name }}</h1>
<p>{{ $invitation->description }}</p>

    @foreach($invitation->Files()->get() as $item)
        @php
            $extension = pathinfo($item->file_path, PATHINFO_EXTENSION);
        @endphp

        @if(in_array($extension, ['jpeg', 'jpg', 'png', 'gif', 'bmp']))
            <img class="img-fluid mb-2"
                 style="padding: 5px;margin-left: 10px; width: 200px; height: 200px;"
                 src="{{ $message->embed('attachments/files/'.$invitation->id.'/'.$item->file_path) }}"
                 alt="image">
        @elseif(in_array($extension, ['pdf']))
            <!-- Display PDF -->
            <p><a href="{{ $message->embed('attachments/files/'.$invitation->id.'/'.$item->file_path) }}"></a></p>
        @else
            <!-- Default content if neither image nor PDF -->
            <p>No preview available for this file type</p>
        @endif
    @endforeach

<p>Thank you</p>
</body>
</html>
