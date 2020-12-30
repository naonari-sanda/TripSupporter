<h2 font-weight-bold>Review</h2>

@if(!count($user->reviews) == 0)
<p class="mb-3 font-weight-bold">{{ count($user->reviews) }}件のレビューを投稿しました</p>

@foreach($user->reviews as $review)

<div class="wrapper">
    <div class="header d-flex">
        <a class="text-dark d-flex align-items-center font-weight-bold mb-0 mr-auto" href="{{ route('detail' , $review->country_id) }}">
            <img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/' . $review->country->imgpath ) }}" alt="ユーザーアイコン" />{{ $review->country->name }}</a>
        @if(Auth::id() == $review->user->id)
        <div class="btn-box d-flex">
            <button class="btn btn-success mr-1 mb-3" @click="showReview({{ $review->country_id }},{{ json_encode( $review->country->name ) }},{{ json_encode($review) }})">編集</button>
            <form action="{{ route('review.delete') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $review->id }}">
                <input onclick="return confirm('{{ $review->country->name }} のレビューを削除してもよろしいですか？')" class="btn btn-danger  mb-3" type="submit" value="削除">
            </form>
        </div>
        @endif
    </div>
    <p class="mt-1 ml-1 mb-0">{{ $review->created_at->format('Y年m月d日') }}に投稿しました。</p>

    <div class="star d-flex align-items-center ml-1 mb-1">
        <p class="d-flex align-items-center mb-0  mr-1 font-weight-bold">総合</p>
        <star-rating v-bind:increment=" 0.5" v-bind:rating="{{ $review->recommend ?? '0' }}" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="20" active-color="#ff4742">
        </star-rating>
        <p class="custom-text d-flex align-items-center mb-0 ml-1 mr-1">{{ number_format($review->recommend,1) ?? '' }}</p>
        <a href="" data-toggle="collapse" data-target="#review-{{$review->id }}" aria-expand="false" aria-controls="review-{{$review->id }}">評価を詳しく見る</a>
    </div>
    <div class="collapse" id="review-{{$review->id }}">
        <div class="star d-flex align-items-center ml-1 mb-1">
            <p class="d-flex align-items-center mb-0  mr-1">治安</p>
            <star-rating v-bind:increment=" 0.5" v-bind:rating="{{ $review->safe }}" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="20" active-color="#ff4742">
            </star-rating>
            <p class="custom-text d-flex align-items-center mb-0 ml-1 mr-1">{{ $review->safe }}</p>
        </div>
        <div class="star d-flex align-items-center ml-1 mb-1">
            <p class="d-flex align-items-center mb-0  mr-1">費用</p>
            <star-rating v-bind:increment=" 0.5" v-bind:rating="{{ $review->cost }}" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="20" active-color="#ff4742">
            </star-rating>
            <p class="custom-text d-flex align-items-center mb-0 ml-1 mr-1">{{ $review->cost }}</p>
        </div>
        <div class="star d-flex align-items-center ml-1 mb-1">
            <p class="d-flex align-items-center mb-0  mr-1">観光</p>
            <star-rating v-bind:increment=" 0.5" v-bind:rating="{{ $review->tourism }}" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="20" active-color="#ff4742">
            </star-rating>
            <p class="custom-text d-flex align-items-center mb-0 ml-1 mr-1">{{ $review->tourism }}</p>
        </div>
        <div class="star d-flex align-items-center ml-1 mb-1">
            <p class="d-flex align-items-center mb-0  mr-1">料理</p>
            <star-rating v-bind:increment=" 0.5" v-bind:rating="{{ $review->food }}" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="20" active-color="#ff4742">
            </star-rating>
            <p class="custom-text d-flex align-items-center mb-0 ml-1 mr-1">{{ $review->food }}</p>
        </div>
        <div class="star d-flex align-items-center ml-1 mb-1">
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
    <a class="d-block" style="width: 200px;" href="{{ asset('/storage/' . $review->imgpath ) }}" data-lightbox="review-{{ $review->id }}" title="<p class='title'>{{ $review->user->name }}さんの{{ $review->country->name  }}の思い出。</p><p class='text'>{{ $review->updated_at->format('Y年m月d日') }}に投稿">
        <img class="img img-thumbnail" src="{{ asset('/storage/' . $review->imgpath ) }}" />
    </a>
    @endif


</div>



@endforeach

<review-edit-component v-show="reviewModal" @review-child="closeReview" :country-id="countryId" :country-name="countryName" :user-id="{{ Auth::id() ?? '[]' }}" :review-data="reviewDetail" />


@else
<div>
    <h5 class="mb-5">＊レビューの投稿がありません</h5>
    <a href="{{ route('main') }}" type="button" class="btn btn-primary">レビューを投稿しよう!</a>
</div>
@endif