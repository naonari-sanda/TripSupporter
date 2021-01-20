<h2 font-weight-bold>Favorite</h2>



@if(count($user->likes) > 0 )
<p class="mb-3 font-weight-bold">{{ count($user->likes) }}件のいいねをしました</p>
<table class="table table-hover">
    <thead class="">
        <tr>
            <th scope="col">国名</th>
            <th scope="col">評価</th>
            <th scope="col">レビュー数</th>
            <th scope="col">いいね数</th>
            <th scope="col">国詳細</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($user->likes as $like)

        <tr>

            <th><a class="text-dark d-flex align-items-center" href="{{ route('detail' , $like->country_id) }}"><img class="cycle img-thumbnail mr-2" src="{{ $like->country->imgpath }}" alt="{{ $like->country->name }}のアイコン" />{{ $like->country->name }}</a></th>
            <td>
                <i class=" fas fa-star mr-1 text-danger"></i>{{ number_format($like->country->reviews->avg('recommend'),1) }}
            </td>
            <td class="text-center">
                {{ count($like->country->reviews)}}件
            </td>
            <td class="float-left">
                <like-component :country-id="{{ json_encode($like->country->id) }}" :auth-id="{{ json_encode(Auth::user()->id ?? '[]') }}" :like-check="{{ count($like->country->likes->where('user_id', Auth::id())) > 0 ? 'true' : 'false' }}" :like-count="{{ json_encode(count($like->country->likes)) }}" />
            </td>
            <td>
                <a href="{{ route('detail' , $like->country_id) }}" class="btn btn-primary">詳細</a>
            </td>
        </tr>

        @endforeach

    </tbody>
</table>


@else
<div>
    <h5 class=" mb-5">＊いいねがありません</h5>
    <a href="{{ route('main') }}" type="button" class="btn btn-primary">お気に入りの国をさがそう！</a>
</div>
@endif 