<div class="d-flex mb-3">
    <h2 class="mb-0">Favorites </h2>
    <like-component :country-id="{{ json_encode($country->id) }}" :auth-id="{{ json_encode(Auth::user()->id ?? '[]') }}" :like-count="{{ count($country->likes) }}" :like-check="{{ count($country->likes->where('user_id', Auth::id())) > 0 ? 'true' : 'false' }}" />
</div>

@if(count($country->likes) > 0)
<table class="table table-hover">
    <thead class="">
        <tr>
            <th scope="col">ユーザー</th>
            <th scope="col">性別</th>
            <th scope="col">年齢</th>
            <th scope="col">詳細</th>
        </tr>
    </thead>
    <tbody>

        @foreach($country->likes as $like)
        <tr>

            <td>
                @auth
                <a class="text-dark d-flex align-items-center font-weight-bold" href="{{ route('user', $like->user->id) }}">
                    @if(!empty($like->user->acount->icon))
                    <img class="cycle img-thumbnail mr-2" src="{{ $like->user->acount->icon }}" alt="ユーザーアイコン" />
                    @elseif(optional($like->user->acount)->gender == "男性")
                    <img class="cycle img-thumbnail mr-2" src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/men.png" alt="男性アイコン" />
                    @elseif(optional($like->user->acount)->gender === "女性")
                    <img class="cycle img-thumbnail mr-2" src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/women.png" alt="女性アイコン" />
                    @else
                    <img class="cycle img-thumbnail mr-2" src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/none.png" alt="アイコン" />
                    @endif
                    {{ $like->user->name }}</a>
                @else
                <a class="text-dark d-flex align-items-center font-weight-bold" data-toggle="modal" data-target="#guestModal">
                    @if(!empty($like->user->acount->icon))
                    <img class="cycle img-thumbnail mr-2" src="{{ $like->user->acount->icon }}" alt="ユーザーアイコン" />
                    @elseif(optional($like->user->acount)->gender == "男性")
                    <img class="cycle img-thumbnail mr-2" src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/men.png" alt="男性アイコン" />
                    @elseif(optional($like->user->acount)->gender === "女性")
                    <img class="cycle img-thumbnail mr-2" src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/women.png" alt="女性アイコン" />
                    @else
                    <img class="cycle img-thumbnail mr-2" src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/none.png" alt="アイコン" />
                    @endif
                    {{ $like->user->name }}</a>
                @endauth
            </td>
            <td>{{ optional($like->user->acount)->age ?? 'なし' }}</td>
            <td>{{ optional($like->user->acount)->gender ?? 'なし'  }}</td>
            <td>
                @auth
                <a href="{{ route('user', $like->user->id) }}" class="btn btn-primary">詳細</a>
                @else
                <a data-toggle="modal" data-target="#guestModal" class="btn btn-primary">詳細</a>
                @endauth
            </td>
        </tr>

        @endforeach
    </tbody>
</table>
@else
<div>
    <h5 class="mb-5">＊いいねの投稿がありません</h5>
    <a href="{{ route('main') }}" type="button" class="btn btn-primary">お気に入りの国をさがそう！</a>
</div>

@endif