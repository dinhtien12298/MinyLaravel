@extends('templates/screen')
@section('footer')
<footer>
    <div class="container">
        <div class="logo">
            <a href="/"><img src="resources/assets/images/all/logo.png" alt="logo"></a>
        </div>
        <div class="menu f-regular-14">
            @if (isset($data_footer) && sizeof($data_footer) > 0)
                @foreach ($data_footer as $data)
                    <div class="footer-menu-item"><a href="/index.php?controller=category&action=detail&class={{ $data->class }}}&subject={{ $data->subject }}&page=1">{{ $data->subject }}</a></div>
                @endforeach
            @endif
        </div>
        <div class="copyright f-regular-12"><p>Copyright © 2018 Miny. Design by 123DOC</p></div>
    </div>
</footer>
@stop