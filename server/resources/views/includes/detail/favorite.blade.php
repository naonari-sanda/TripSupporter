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
                <p class="text-dark d-flex align-items-center font-weight-bold" href="#">

                    @if(!empty($like->user->acounts->icon))
                    <img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/' . $like->user->acounts->icon ) }}" alt="ユーザーアイコン" />
                    @elseif(optional($like->user->acounts)->gender == "男性")
                    <img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/men.png') }}" alt="男性アイコン" />
                    @elseif(optional($like->user->acounts)->gender === "女性")
                    <img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/women.png') }}" alt="女性アイコン" />
                    @else
                    <img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/none.png') }}" alt="女性アイコン" />
                    @endif
                    {{ $like->user->name }}</p>
            </td>
            <td>{{ $like->user->acounts->age }}</td>
            <td>{{ $like->user->acounts->gender }}</td>
            <td>
                <button class="btn btn-primary">詳細</button>
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