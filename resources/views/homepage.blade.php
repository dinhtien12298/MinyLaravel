@extends('templates/screen')
@section('main');
@php extract($data) @endphp
<!-- START CONTENT -->
<div class="content">
    <div class="container">
        @foreach($list_classes as $class_name)
            @php $index = array_search($class_name, $list_classes); @endphp
            @if (sizeof($data_content[$index]) != 0)
                <div class="tab-heading">
                    <div class="tab-title f-regular-30">
                        {{ $class_name }}
                    </div>
                    @if (sizeof($list_buttons[$index]) != 0)
                        <div class="menu-button f-regular-12">
                            @for ($i = 0; $i < sizeof($list_buttons[$index]); $i++)
                                <button class="subject-tab" data-subjectId="{{ $list_buttons[$index][$i]->id }}">{{ $list_buttons[$index][$i]->subject }}</button>
                            @endfor
                        </div>
                    @endif
                    <div class="view-all">
                        <a class="view-all-tag f-regular-13" onclick="directTo('/index.php?controller=category&action=basic&class={{ $class_name }}&page=1')">
                        Xem tất cả
                        <i class="fas fa-caret-right"></i>
                        </a>
                    </div>
                </div>
                <div class="line-orange"></div>
                <div class="tab-post">
                    @for ($i = 0; $i < sizeof($data_content[$index]); $i++)
                        <div class="post-model" onclick="directTo('/index.php?controller=post&action=detail&post={{ $data_content[$index][$i]->id }}')">
                            <div class="post-title">
                                <a href="/index.php?controller=post&action=detail&post={{ $data_content[$index][$i]->id }}" class="f-medium-17">{{ $data_content[$index][$i]->title }}</a>
                            </div>
                            <div class="post-heading d-flex">
                                <div class="post-author f-medium-12">
                                    {{ $data_content[$index][$i]->fullname }}
                                </div>
                                <div class="post-info f-regular-13">
                                    <div><img src="Public/Images/homepage/icon-view.png" alt="icon-view">{{ $data_content[$index][$i]->view_num }}</div>
                                    <div><img src="Public/Images/homepage/icon-heart.png" alt="icon-like">{{ $data_content[$index][$i]->like_num }}</div>
                                </div>
                            </div>
                            <div class="post-content f-regular-13">
                                {{ $data_content[$index][$i]->content }}
                            </div>
                        </div>
                    @endfor
                </div>
            @endif
        @endforeach
    </div>
</div>
<!-- END CONTENT -->

<!-- START SERVICE -->
<div id="service">
    <div class="container">
        <div id="service-header">
            <p class="f-regular-30">Chúng tôi cung cấp cho bạn</p>
        </div>
        <div id="service-info" class="d-flex">
            <div class="service-1" style="width: 29%">
                <div class="service-icon">
                    <img src="Public/Images/homepage/icon-file.png" alt="icon-file">
                </div>
                <div class="service-content">
                    <div class="content-heading f-regular-20">Tài nguyên học tập miễn phí</div>
                    <div class="content-detail f-regular-13">Cung cấp hơn 1 triệu tài nguyên về học tập miễn phí trên trang web</div>
                </div>
            </div>
            <div class="service-2" style="width: 44%">
                <div class="service-icon">
                    <img src="Public/Images/homepage/icon-download.png" alt="icon-download">
                </div>
                <div class="service-content" style="padding: 0px 65px">
                    <div class="content-heading f-regular-20">Nội dung cập nhật liên tục</div>
                    <div class="content-detail f-regular-13">Nội dung trên web được cập nhật liên tục hàng ngày bởi đội ngũ giáo viên giỏi</div>
                </div>
            </div>
            <div class="service-3" style="width: 27%">
                <div class="service-icon">
                    <img src="Public/Images/homepage/icon-pc.png" alt="icon-pc">
                </div>
                <div class="service-content">
                    <div class="content-heading f-regular-20">Giao diện thân thiện</div>
                    <div class="content-detail f-regular-13">Trang web luôn lắng nghe góp ý để đổi mới trang web phục vụ các bạn cả nước</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SERVICE -->

@stop