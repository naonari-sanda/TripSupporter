<h2 font-weight-bold>Photo gallery</h2>

@if(!empty($country->reviews->imgpath))
<div id="lightgallery ">
    <div class="row">
        @foreach($country->reviews as $review)
        @if(!empty($review->imgpath))
        <div class="bg col-md-3 col-6 mb-3">
            <a class="d-block" href="{{ asset('/storage/' . $review->imgpath ) }}" data-lightbox="example-1" title="<p class='title'>{{ $review->user->name }}さんの{{ $review->country->name  }}の思い出。</p><p class='text'>{{ $review->updated_at->format('Y年m月d日') }}に投稿">
                <img class="img img-thumbnail" src="{{ asset('/storage/' . $review->imgpath ) }}" />
            </a>
            <a href="#" class="text">{{ $review->user->name }}さんの投稿</あ>
        </div>
        @endif
        @endforeach
    </div>
</div>
@else
<div>
    <h5 class="mb-5">＊投稿がありません</h5>
    <a href="{{ route('main') }}" type="button" class="btn btn-primary">レビューを投稿しよう！</a>
</div>
@endif