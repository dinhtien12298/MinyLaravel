<div id="user-infomation">
    <div class="user-infomation-content">
        @foreach ($list_info as $key => $value)
            <div class="info-element d-flex">
                <div class="info-name">{{ $key }}</div>
                <div class="info-content">{{ $value }}</div>
            </div>
        @endforeach
    </div>
    <div class="update-button"><button onclick="directTo('{{ route('user.update') }}')" class="f-medium-17">Cập nhật thông tin</button></div>
</div>
