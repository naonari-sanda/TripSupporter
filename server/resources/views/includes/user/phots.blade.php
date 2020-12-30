<h2 font-weight-bold>Photo gallery</h2>

@if(!empty($user->reviews->imgpath))
<div id="lightgallery ">
    <div class="row">
        @foreach($user->reviews as $review)
        @if(!empty($review->imgpath))
        <div class="bg col-md-3 col-6 mb-3">
            <a class="d-block" href="{{ asset('/storage/' . $review->imgpath ) }}" data-lightbox="example-1" title="<p class='title'>{{ $review->country->name }}の思い出。</p><p class='text'>{{ $review->country->review }}">
                <img class="img img-thumbnail" src="{{ asset('/storage/' . $review->imgpath ) }}" />
            </a>
            <p class="text">{{ $review->country->name }} </p>
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