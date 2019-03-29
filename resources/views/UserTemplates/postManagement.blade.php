<div id="post-management">
    <table>
        <tr class="table-heading f-regular-15">
            <th>Tiêu đề</th>
            <th>Lớp</th>
            <th>Chủ đề</th>
            <th>Lượt xem</th>
            <th>Lượt thích</th>
            <th style="width: 30%">Nội dung</th>
            <th>Quản lý</th>
        </tr>
        @if (sizeof($all_posts) > 0)
            @foreach ($all_posts as $post)
                @php $index = $all_posts->search($post);
                $post_id = $post->id @endphp
                <tr class="f-regular-14">
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->class }}</td>
                    <td>{{ $post->subject }}</td>
                    <td>{{ $post->view_num }}</td>
                    <td>{{ $post->like_num }}</td>
                    <td class="content-column">{!! $post->content !!}</td>
                    <td>
                        <a href="{{ route('detail', ['post_id' => $post->id]) }}">Xem</a>
                        <a href="{{ route('user.edit', ['post_id' => $post_id]) }}">Sửa</a>
                        @php $input[0] = $post_id; $input[1] = $index @endphp
                        <a onclick="deletePost({{ json_encode($input) }})">Xóa</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr class="f-regular-14">
                <td></td>
                <td></td>
                <td>Bạn</td>
                <td>chưa</td>
                <td>có</td>
                <td>bài viết nào cả!</td>
                <td></td>
            </tr>
        @endif
    </table>
</div>