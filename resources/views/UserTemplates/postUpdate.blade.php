<div id="post-create">
    <form method="post" action="{{ route('user.edit', ['post_id' => $post_detail->id]) }}">
        {{ csrf_field() }}
        <div class="post-banner">
            <h1 class="f-regular-25">Cập nhật bài viết</h1>
            <hr>
            <h6 class="f-regular-15">Đóng góp cho cộng đồng những bài viết bổ ích</h6>
        </div>
        <div class="form-element">
            <label for="title">Tiêu đề</label>
            <input class="title-input" type="text" name="title" value="{{ $post_detail->title }}">
        </div>
        <div class="form-element double-element">
            <div>
                <label for="class">Lớp</label>
                <select class="class-input" name="class" required>
                    @foreach ($all_classes as $class)
                        <option
                            value="{{ $class->class }}"
                            @if ($class->class == $post_detail->subject->class)
                                selected
                            @endif
                        >
                            {{ $class->class }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="subject">Chủ đề</label>
                <select class="subject-input" name="subject" required>

                </select>
            </div>
        </div>
        <div class="form-element">
            <label for="content">Nội dung</label>
            <textarea class="content-input" name="content" required>{!! $post_detail->content !!}</textarea>
            <script>CKEDITOR.replace( 'content' )</script>
        </div>
        @if (isset($error))
            <div class="error-messages f-regular-17">{{ $error }}</div>
        @endif
        <button name="submit" type="submit">Cập nhật</button>
    </form>
</div>