<div class="d-flex mb-3">
    <h2 class="mb-0">favorites </h2>
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
                <a class="text-dark d-flex align-items-center font-weight-bold" href="{{ route('user', $like->user->id) }}">

                    @if(!empty($like->user->acount->icon))
                    <img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/' . $like->user->acount->icon ) }}" alt="ユーザーアイコン" />
                    @elseif(optional($like->user->acount)->gender == "男性")
                    <img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/men.png') }}" alt="男性アイコン" />
                    @elseif(optional($like->user->acount)->gender === "女性")
                    <img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/women.png') }}" alt="女性アイコン" />
                    @else
                    <img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/none.png') }}" alt="女性アイコン" />
                    @endif
                    {{ $like->user->name }}</a>
            </td>
            <td>{{ optional($like->user->acount)->age ?? 'なし' }}</td>
            <td>{{ optional($like->user->acount)->gender ?? 'なし'  }}</td>
            <td>
                <a href="{{ route('user', $like->user->id) }}" class="btn btn-primary">詳細</a>
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