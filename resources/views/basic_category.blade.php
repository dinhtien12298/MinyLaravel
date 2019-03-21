@extends('templates/screen')
@section('css')
    <link rel="stylesheet" href="{{ asset("css/category.css") }}">
@endsection

@section('main')
<div class="content">
    <div class="container">
        <div class="d-flex">
            <!-- START MAIN CONTENT -->
            <div class="content-post">
                @foreach ($data_content as $list_posts)
                    @if (sizeof($list_posts) > 0)
                        <div class="list-post basic">
                            <div class="tab-heading">
                                <div class="tab-title f-regular-30">
                                    {{ $list_posts[0]->subject }}
                                </div>
                                <div class="view-all">
                                    <a class="f-regular-13" href="{{ url("/danh-muc/" . $list_posts[0]->class . "/" . $list_posts[0]->subject . "/1") }}">
                                        Xem tất cả
                                        <i class="fas fa-caret-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="line-orange"></div>
                            <div class="tab-post">
                                @for ($i = 0; $i < sizeof($list_posts); $i++)
                                    <div class="post-model" onclick="directTo('/bai-viet/{{ $list_posts[$i]->id }}')">
                                        <div class="post-title">
                                            <a href="{{ url("/bai-viet/" . $list_posts[$i]->id) }}" class="f-medium-17">{{ $list_posts[$i]->title }}</a>
                                        </div>
                                        <div class="post-heading d-flex">
                                            <div class="post-author f-medium-12">
                                                {{ $list_posts[$i]->fullname }}
                                            </div>
                                            <div class="post-info f-regular-13">
                                                <div><img src="{{ asset('images/homepage/icon-view.png') }}" alt="icon-view">{{ $list_posts[$i]->view_num }}</div>
                                                <div><img src="{{ asset('images/homepage/icon-heart.png') }}" alt="icon-like">{{ $list_posts[$i]->like_num }}</div>
                                            </div>
                                        </div>
                                        <div class="post-content f-regular-13">
                                            {!! $list_posts[$i]->content !!}
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <div class="view-more">
                                <a href="{{ url("/danh-muc/" . $list_posts[0]->class . "/" . $list_posts[0]->subject . "/1") }}"><button class="f-regular-13">Xem thêm</button></a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- END MAIN CONTENT -->

            <!-- START SIDEBAR -->
            @include('templates/sidebar')
            <!-- END SIDEBAR -->
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset("js/category.js") }}"></script>
@endsection