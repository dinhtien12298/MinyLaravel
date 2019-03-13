@extends('basicCategory')
@extends('detailCategory')
@section('sidebar')
<div class="side-bar">
    @if (isset($data_related) && sizeof($data_related) > 0)
        <div class="related">
            <div class="related-heading f-medium-17">
                Bạn muốn tìm thêm với
            </div>
            <div class="line-orange"></div>
            <div class="related-content f-regular-14">
                @for ($i = 0; $i < sizeof($data_related); $i++)
                    <a href="/index.php?controller=post&action=detail&post={{ $data_related[$i]->id }}">{{ $data_related[$i]->title }}</a>
                @endfor
            </div>
        </div>
    @endif
    @if (isset($all_ads) && sizeof($all_ads) > 0 )
        @foreach ($all_ads as $ad)
            <a href="{{ $ad->link }}"><img src="{{ $ad->image }}" alt="{{ $ad->title }}"></a>
        @endforeach
    @endif
</div>
@stop