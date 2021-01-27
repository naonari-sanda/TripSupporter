<h2 font-weight-bold>Photo gallery</h2>

@auth
<a @click="showImage" type="button" class="btn btn-danger mb-2">画像を投稿しよう！</a>
@endauth
<hr>
@if(!empty($country->reviews))
<div id="lightgallery ">
    <div class="row">
        @foreach($country->reviews as $review)
        @if(!empty($review->imgpath))
        <div class="bg col-md-3 col-6 mb-2">
            <a class="d-block" href="{{ $review->imgpath }}" data-lightbox="example-1" title="<p class='title'>{{ $review->user->name }}さんの{{ $review->country->name  }}の思い出。</p><p class='text'>{{ $review->review }}</p><p><p>{{ $review->updated_at->format('Y年m月d日') }}に投稿</p>">
                <img class=" img img-thumbnail" src="{{ $review->imgpath }}" />
            </a>
            <p class="text">{{ $review->user->name }}さんの投稿</p>
        </div>
        @endif
        @endforeach
        @foreach($country->images as $img)
        <div class="bg col-md-3 col-6 mb-2">
            <a class="d-block" href="{{ $img->imgpath }}" data-lightbox="example-1" title="<p class='title'>{{ $img->user->name }}さんの{{ $img->country->name  }}の思い出。</p><p class='text'>{{ $img->updated_at->format('Y年m月d日') }}に投稿">
                <img class="img img-thumbnail" src="{{ $img->imgpath }}" />
            </a>
            <p class="text">{{ $img->user->name }}さんの投稿</p>
        </div>
        @endforeach
    </div>
</div>

@endif
<img-upload-component v-show="imageModal" @image-child="closeImage" :user-id="{{ Auth::id() ?? '0' }}" country-id="{{ $country->id ?? '0' }}" /> 