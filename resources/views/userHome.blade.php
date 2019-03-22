@extends('templates/screen')
@section('css')
    <link rel="stylesheet" href="{{ asset("css/userHome.css") }}">
@endsection

@section('main')
<div class="user-body-homepage">
    <div class="container">
        <ul id="user-menu" class="f-regular-25">
            <li onclick="directTo('thong-tin-ca-nhan')"><a href="{{ route('user.information') }}">Thông tin cá nhân</a></li>
            <li onclick="directTo('quan-ly-bai-viet')"><a href="{{ route('user.postManagement') }}">Quản lý bài viết</a></li>
            <li onclick="directTo('dang-bai')"><a href="{{ route('user.postCreate') }}">Đăng bài</a></li>
        </ul>

        <div class="content-container f-regular-16">
            @include("UserTemplates/$page")
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset("js/userHome.js") }}"></script>
@endsection
