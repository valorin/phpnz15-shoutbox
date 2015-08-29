<div class="shout" style="border-color: #{{ substr(md5($shout->message), 0, 6) }};">
    <div class="id" id="shout-{{ $shout->id }}">
        #{{ $shout->id }}
    </div>
    <div class="message">
        {{ $shout->message }}
    </div>
</div>
