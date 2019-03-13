@extends('templates/screen')
@section('banner')
@if (isset($banner_title))
    <div id="banner">
        <div class="container">
            <div class="breadcrumb f-regular-13">
                @for ($i = 0; $i < sizeof($breadcrumb) - 1; $i++)
                    <div><a class="breadcrumb-tag">{{ $breadcrumb[$i] }}</a></div>
                @endfor
                <div>{{ $breadcrumb[sizeof($breadcrumb) - 1] }}</div>
            </div>
            <div class="banner-heading f-bold-30">
                {{ $banner_title }}
            </div>
        </div>
    </div>
@else
    <div id="banner-hp"></div>
@endif
@stop
