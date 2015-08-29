<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Shoutbox - Ansible, live on stage</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div class="container">

    <div class="shoutbox">
        <form action="/" method="POST">
            <input type="submit" value="S!" class="shout" tabindex="10">
            <input type="text" name="message" class="message" placeholder="Say something..." tabindex="5" autocomplete="off">
        </form>
    </div>

    <div class="conversation" data-latest="{{ $shouts->max('id') }}">
        @forelse ($shouts as $shout)
            @include('shout', ['shout' => $shout])
        @empty
            <p class="empty"><em>No shouts found...</em></p>
        @endforelse
    </div>

    <script src="{{ asset('js/all.js') }}"></script>
</body>
</html>
