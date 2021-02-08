<h2 font-weight-bold>Photo gallery</h2>
@if(Auth::id() == $user->id)
<a @click="showImage" type="button" class="btn btn-success mb-2">画像を投稿しよう！</a>
@endif


@if(count($user->reviews) > 0)
<hr>
@if(!empty($user->reviews))
<div id="lightgallery ">
    <div class="row">
        @foreach($user->reviews as $review)
        @if(!empty($review->imgpath))
        <div class="bg col-md-3 col-6 mt-3">
            <a class="d-block" href="{{ $review->imgpath }}" data-lightbox="example-1" title="<p class='title'>{{ $review->country->name }}の思い出。</p><p class='text mb-1'>{{ $review->review }}</p><p>{{ $review->updated_at->format('Y年m月d日') }}に投稿</p>">
                <img class="img img-thumbnail" src="{{ $review->imgpath }}" />
            </a>
            <p class="text mb-0">{{ $review->country->name }} </p>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endif
@if(!empty($user->images))
<hr>
<div id="lightgallery ">
    <div class="row">
        @foreach($user->images as $img)
        @if(!empty($img->imgpath))
        <div class="bg col-md-3 col-6 mb-3">
            <a class="d-block" href="{{ $img->imgpath }}" data-lightbox="example-1" title="<p class='title'>{{ $img->country->name }}の思い出。</p><p>{{ $img->created_at->format('Y年m月d日') }}に投稿</p>">
                <img class="img img-thumbnail" src="{{ $img->imgpath }}" />
            </a>
            <p class="text mb-1">{{ $img->country->name }} </p>
            @if(Auth::id() == $user->id)
            <form action="{{ route('delete.img') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $img->id }}">
                <input onclick="return confirm('{{ $img->country->name }} のレビューを削除してもよろしいですか？')" class="btn btn-danger  mb-3" type="submit" value="削除">
            </form>
            @endif
        </div>
        @endif
        @endforeach
    </div>
</div>
@endif
@endif




<img-upload-component v-show="imageModal" @image-child="closeImage" :user-id="{{ Auth::id() ?? '0' }}" country-id="{{ $country->id ?? '0' }}" />