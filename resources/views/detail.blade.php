@extends('templates/screen')
@section('css')
    <link rel="stylesheet" href="{{ asset("css/detail.css") }}">
@endsection
@section('main')
<div class="content">
    <div class="container">
        <div class="main-content d-flex">
            <!-- START POST DETAIL -->
            <div class="post-detail">
                <div class="post-main">
                    <div class="post-heading">
                        <div class="post-author">
                            <a href=""><img class="author-thumbnail" src="{{ asset('images/thumbnail/author-post.png') }}" alt=""></a>
                            <a class="f-medium-15" href="">{{ $post->fullname }}</a>
                        </div>
                        <div class="post-info">
                            <div><img src="{{ asset('images/homepage/icon-view.png') }}" alt="icon-view">{{ $post->view_num }}</div>
                            <div><img src="{{ asset('images/homepage/icon-heart.png') }}" alt="icon-like">{{ $post->like_num }}</div>
                        </div>
                    </div>
                    <div class="post-content f-regular-17">
                        {!! $post->content !!}
                    </div>
                </div>
                <div class="fb-comments" data-href="http://dinhtien12298.github.io/web2018/detail.html" data-width="100%"></div>
            </div>
            <!-- END POST DETAIL -->

            <!-- START SIDEBAR -->
            @include('templates/sidebar')
            <!-- END SIDEBAR -->
        </div>
        <!-- START MOREPOST -->
        <div class="more-post">
            @if (isset($data_more_post) && sizeof($data_more_post) > 0)
                <div class="tab-heading">
                    <div class="tab-title f-regular-30">
                        Có thể bạn quan tâm
                    </div>
                    <div class="view-all">
                        <a class="f-regular-13" href="{{ url("/danh-muc/$post->class") }}">
                            Xem tất cả
                            <i class="fas fa-caret-right"></i>
                        </a>
                    </div>
                </div>
                <div class="line-orange"></div>
                <div class="tab-post">
                    @for ($i = 0; $i < sizeof($data_more_post); $i++)
                        <div class="post-model" onclick="directTo('/bai-viet/{{ $data_more_post[$i]->id }}')">
                            <div class="post-title">
                                <a href="{{ url("/bai-viet/" . $data_more_post[$i]->id) }}" class="f-medium-17">{{ $data_more_post[$i]->title }}</a>
                            </div>
                            <div class="post-heading d-flex">
                                <div class="post-author f-medium-12">
                                    {{ $data_more_post[$i]->fullname }}
                                </div>
                                <div class="post-info f-regular-13">
                                    <div><img src="{{ asset('images/homepage/icon-view.png') }}" alt="icon-view">{{ $data_more_post[$i]->view_num }}</div>
                                    <div><img src="{{ asset('images/homepage/icon-heart.png') }}" alt="icon-like">{{ $data_more_post[$i]->like_num }}</div>
                                </div>
                            </div>
                            <div class="post-content f-regular-13">
                                {!! $data_more_post[$i]->content !!}
                            </div>
                        </div>
                    @endfor
                </div>
            @endif
        </div>
        <!-- END MOREPOST -->
    </div>
</div>
@endsection