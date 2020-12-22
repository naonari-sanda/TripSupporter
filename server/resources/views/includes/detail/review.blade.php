<h2>Reviews</h2>

@if(!count($country->reviews) == 0)

@foreach($country->reviews as $review)

<h3>{{ $review->user->name }}</h3>

<table class="">
    <tbody>

        <tr>
            <th>総合</th>
            <td>
                <star-rating v-bind:increment="0.5" v-bind:rating="{{ $review->avg('recommend') ?? '0' }}" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="25"></star-rating>
            </td>
        </tr>

        <tr>
            <th>治安</th>
            <td>
                <star-rating v-bind:increment="0.5" v-bind:rating="{{ $review->avg('safe') ?? '0' }}" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="25"></star-rating>

            </td>
        </tr>

        <tr>
            <th>物価</th>
            <td>
                <star-rating v-bind:increment="0.5" v-bind:rating="{{ $review->avg('cost') ?? '0' }}" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="25"></star-rating>

            </td>
        </tr>

        <tr>
            <th>料理</th>
            <td>
                <star-rating v-bind:increment="0.5" v-bind:rating="{{ $review->avg('food') ?? '0' }}" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="25"></star-rating>

            </td>
        </tr>

        <tr>
            <th>英語力</th>
            <td>
                <star-rating v-bind:increment="0.5" v-bind:rating="{{ $review->avg('english') ?? '0' }}" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="25"></star-rating>

            </td>
        </tr>

    </tbody>
</table>

@if(!empty($review->imgpath))
<img src="{{ asset('/storage/' . $review->imgpath) }}" alt="{{ $country->name }}" style="width: 300px;">
@endif

@if (isset($review->review))
<p>{{ $review->review }}</p>
@else
<p>レビューはありません</p>
@endif

<small>{{ $review->updated_at->format('Y年m月d日') }}</small>

@endforeach

<strong>{{ count($country->reviews) }}つのレビューがありました</strong>
@else

<div>
    <h5 class="mb-5">＊レビューの投稿がありません</h5>
    <a href="{{ route('main') }}" type="button" class="btn btn-primary">お気に入りの国をさがそう！</a>
</div>

@endif