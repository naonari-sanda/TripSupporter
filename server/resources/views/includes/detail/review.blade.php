<h2>Reviews</h2>

@if(!count($country->reviews) == 0)
<p class="mb-3 font-weight-bold">{{ count($country->reviews) }}件のレビューがありました</p>

@foreach($country->reviews as $review)

<div class="wrapper">
    @auth
    <a class="text-dark d-flex align-items-center font-weight-bold mb-0" href="{{ route('user', $review->user_id) }}">

        @if(!empty($review->user->acount->icon))
        <img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/' . $review->user->acount->icon ) }}" alt="ユーザーアイコン" />
        @elseif(optional($review->user->acount)->gender == "男性")
        <img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/men.png') }}" alt="男性アイコン" />
        @elseif(optional($review->user->acount)->gender === "女性")
        <img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/women.png') }}" alt="女性アイコン" />
        @else
        <img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/none.png') }}" alt="女性アイコン" />
        @endif
        {{ $review->user->name }}</a>
    @else
    <a class="text-dark d-flex align-items-center font-weight-bold mb-0" data-toggle="modal" data-target="#guestModal">

        @if(!empty($review->user->acount->icon))
        <img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/' . $review->user->acount->icon ) }}" alt="ユーザーアイコン" />
        @elseif(optional($review->user->acount)->gender == "男性")
        <img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/men.png') }}" alt="男性アイコン" />
        @elseif(optional($review->user->acount)->gender === "女性")
        <img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/women.png') }}" alt="女性アイコン" />
        @else
        <img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/none.png') }}" alt="女性アイコン" />
        @endif
        {{ $review->user->name }}</a>
    @endauth
    <p class="mt-1 ml-1 mb-0">{{ $review->updated_at->format('Y年m月d日') }}に投稿しました。</p>

    <div class="star d-flex align-items-center ml-1 mb-2">
        <p class="d-flex align-items-center mb-0  mr-1 font-weight-bold">総合</p>
        <star-rating v-bind:increment=" 0.5" v-bind:rating="{{ $review->recommend ?? '0' }}" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="20" active-color="#ff4742">
        </star-rating>
        <p class="custom-text d-flex align-items-center mb-0 ml-1 mr-1">{{ number_format($review->recommend,1) ?? '' }}</p>
        <a href="" data-toggle="collapse" data-target="#review-{{$review->id }}" aria-expand="false" aria-controls="review-{{$review->id }}">評価を詳しく見る</a>
    </div>
    <div class="collapse" id="review-{{$review->id }}">
        <div class="star d-flex align-items-center ml-1 mb-2">
            <p class="d-flex align-items-center mb-0  mr-1">治安</p>
            <star-rating v-bind:increment=" 0.5" v-bind:rating="{{ $review->safe }}" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="20" active-color="#ff4742">
            </star-rating>
            <p class="custom-text d-flex align-items-center mb-0 ml-1 mr-1">{{ $review->safe }}</p>
        </div>
        <div class="star d-flex align-items-center ml-1 mb-2">
            <p class="d-flex align-items-center mb-0  mr-1">費用</p>
            <star-rating v-bind:increment=" 0.5" v-bind:rating="{{ $review->cost }}" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="20" active-color="#ff4742">
            </star-rating>
            <p class="custom-text d-flex align-items-center mb-0 ml-1 mr-1">{{ $review->cost }}</p>
        </div>
        <div class="star d-flex align-items-center ml-1 mb-2">
            <p class="d-flex align-items-center mb-0  mr-1">観光</p>
            <star-rating v-bind:increment=" 0.5" v-bind:rating="{{ $review->tourism }}" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="20" active-color="#ff4742">
            </star-rating>
            <p class="custom-text d-flex align-items-center mb-0 ml-1 mr-1">{{ $review->tourism }}</p>
        </div>
        <div class="star d-flex align-items-center ml-1 mb-2">
            <p class="d-flex align-items-center mb-0  mr-1">料理</p>
            <star-rating v-bind:increment=" 0.5" v-bind:rating="{{ $review->food }}" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="20" active-color="#ff4742">
            </star-rating>
            <p class="custom-text d-flex align-items-center mb-0 ml-1 mr-1">{{ $review->food }}</p>
        </div>
        <div class="star d-flex align-items-center ml-1 mb-2">
            <p class="d-flex align-items-center mb-0  mr-1">楽しさ</p>
            <star-rating v-bind:increment=" 0.5" v-bind:rating="{{ $review->fun }}" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="20" active-color="#ff4742">
            </star-rating>
            <p class="custom-text d-flex align-items-center mb-0 ml-1 mr-1">{{ $review->fun }}</p>
        </div>
    </div>

    @if(!empty($review->city))
    <div class="fill mb-1">
        <p class="mb-1 font-weight-bold">お気に入り都市</p>
        <p class="text mb-0">{{ $review->city}}</p>
    </div>
    @endif

    <div class="fill mb-3">
        <p class="mb-1 font-weight-bold">レビュー</p>
        <p class="text mb-0">{!! nl2br($review->review) !!}</p>
    </div>

    @if(!empty($review->imgpath))
    <a class="d-block" href="{{ asset('/storage/' . $review->imgpath ) }}" data-lightbox="review-{{ $review->id }}" title="<p class='title'>{{ $review->user->name }}さんの{{ $review->country->name  }}の思い出。</p><p class='text'>{{ $review->updated_at->format('Y年m月d日') }}に投稿">
        <img class="img img-thumbnail" src="{{ asset('/storage/' . $review->imgpath ) }}" style="width: 200px;" />
    </a>
    @endif


</div>

@endforeach

@else

<div>
    <h5 class="mb-5">＊レビューの投稿がありません</h5>
    <a href="{{ route('main') }}" type="button" class="btn btn-primary">お気に入りの国をさがそう！</a>
</div>

@endif