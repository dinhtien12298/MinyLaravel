<footer>
    <div class="container">
        <div class="logo">
            <a href="{{ url('/') }}"><img src="{{ asset('images/all/logo.png') }}" alt="logo"></a>
        </div>
        <div class="menu f-regular-14">
            @if (isset($data_footer) && sizeof($data_footer) > 0)
                @foreach ($data_footer as $data)
                    <div class="footer-menu-item"><a href="{{ url("/danh-muc/$data->class/$data->subject/1") }}">{{ $data->subject }}</a></div>
                @endforeach
            @endif
        </div>
        <div class="copyright f-regular-12"><p>Copyright © 2018 Miny. Design by 123DOC</p></div>
    </div>
</footer>
