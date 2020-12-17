<h2 font-weight-bold>Review</h2>

<table class="table table-hover">
    <thead class="">
        <tr>
            <th scope="col">国名</th>
            <th scope="col">オススメ</th>
            <th scope="col">レビュー</th>
            <th scope="col">詳細</th>
            <th scope="col">編集</th>
            <th scope="col">削除</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user->reviews as $review)
        <tr>

            <td>{{ $review->country->name }}</td>
            <td><i class="fas fa-star mr-1 text-danger"></i>{{ $review->recommend }}</td>
            <td>{{ $review->review }}</td>
            <td>
                <button class="btn btn-primary">詳細</button>
            </td>
            <td>
                <button class="btn btn-success">編集</button>
            </td>
            <td>
                <form action="{{ route('review.delete') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $review->id }}">
                    <input onclick="return confirm('{{ $review->country->name }} のレビューを削除してもよろしいですか？')" class="btn btn-danger" type="submit" value="削除">
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>