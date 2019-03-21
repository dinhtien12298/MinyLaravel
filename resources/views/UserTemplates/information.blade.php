<div id="user-infomation">
    <div class="user-infomation-content">
        @foreach ($list_info as $key => $value)
            <div class="info-element d-flex">
                <div class="info-name">{{ $key }}</div>
                <div class="info-content">{{ $value }}</div>
            </div>
        @endforeach
    </div>
    <div class="update-button"><button onclick="directTo('/nguoi-dung/cap-nhat-thong-tin')" class="f-medium-17">Cập nhật thông tin</button></div>
</div>
