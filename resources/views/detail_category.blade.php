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
                <div class="list-post">
                    <div class="tab-heading">
                        <div class="tab-title f-regular-30">
                            {{ $tab_title }}
                        </div>
                    </div>
                    <div class="line-orange"></div>
                    <div class="tab-post">
                        @for ($i = 0; $i < sizeof($data_content); $i++)
                            <div class="post-model" onclick="directTo('/bai-viet/{{ $data_content[$i]->id }}')">
                                <div class="post-title">
                                    <a href="{{ url("bai-viet/" . $data_content[$i]->id) }}" class="f-medium-17">{{ $data_content[$i]->title }}</a>
                                </div>
                                <div class="post-heading d-flex">
                                    <div class="post-author f-medium-12">
                                        {{ $data_content[$i]->fullname }}
                                    </div>
                                    <div class="post-info f-regular-13">
                                        <div><img src="{{ asset('images/homepage/icon-view.png') }}" alt="icon-view">{{ $data_content[$i]->view_num }}</div>
                                        <div><img src="{{ asset('images/homepage/icon-heart.png') }}" alt="icon-like">{{ $data_content[$i]->like_num }}</div>
                                    </div>
                                </div>
                                <div class="post-content f-regular-13">
                                    {!! $data_content[$i]->content !!}
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT -->

            <!-- START SIDEBAR -->
            @include('templates/sidebar')
            <!-- END SIDEBAR -->
        </div>
        <div class="page-button">
            @for ($i = 0; $i < $page_button; $i++)
                <a href="{{ url("/danh-muc/$class/$subject/" . ($i + 1)) }}"><button class="paginate-button f-regular-14">{{ $i + 1 }}</button></a>
            @endfor
            @if ($continue)
                <div class="etc"></div>
                <div class="etc"></div>
                <div class="etc"></div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset("js/category.js") }}"></script>
@endsection