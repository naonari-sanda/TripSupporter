<h2 font-weight-bold>Favorite</h2>


@if(count($user->likes) > 0 )
<div class="row">
    @foreach ($user->likes as $like)
    <div class="col d-flex justify-content-center ">
        <div class="card shadow" style="width: 18rem; margin-bottom: 5rem;">

            <div class="bg">
                <img class="card-img-top country_img" src="{{ asset('/storage/' . $like->country->imgpath ) }}" alt="Card image cap" />
                <h5 class="text">{{ $like->country->name }} </h5>
            </div>

            <div class="card-body">
                <div class="d-flex mb-2">
                    <star-rating v-bind:increment="0.5" v-bind:rating="{{ $like->country->reviews->avg('recommend') ?? '0' }}" text-class="custom-text" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="25" active-color="#ff4742"></star-rating>
                    <p class="custom-text d-flex align-items-center mb-0 ml-1">{{ number_format($like->country->reviews->avg('recommend'), 1) ?? '' }}</p>
                </div>
                <p class="card-text mt-2">{{ Str::limit($like->country->detail, $limit = 55, $end = '...') }}</p>
                <div class="d-flex">
                    <a href="{{ route('detail', $like->country->id ) }}" class="btn btn-primary">詳細はこちら</a>

                    <like-component :country-id="{{ json_encode($like->country->id) }}" :auth-id="{{ json_encode(Auth::user()->id ?? '[]') }}" :like-check="{{ $like ? 'true' : 'false' }}" :like-count="{{ json_encode(count($like->country->likes)) }}" />
                </div>
            </div>
        </div>
    </div>

    @endforeach

    @else
    <div>
        <h5 class="mb-5">＊いいねがありません</h5>
        <a href="{{ route('main') }}" type="button" class="btn btn-primary">お気に入りの国をさがそう！</a>
    </div>
    @endif