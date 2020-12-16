@extends('layouts.app')
@section('title', '各国詳細画面')

@section('content')
<section class="jumbotron text-center d-flex align-items-center">
    <div class="container">
        <h1 class="jumbotron-heading text-light mb-0">
            {{ $country->name }}
        </h1>
        <p class="lead text-muted">
            Something short and leading about the collection below—its contents,
            the creator, etc. Make it short and sweet, but not too short so folks
            don't simply skip over it entirely.
        </p>
        <!-- <p>
            @auth
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">レビューを投稿</button>
            @else
            @endauth -->

        @if(count($country->reviews->where('user_id', Auth::id())) !== 0)
        <button type="button" class="btn btn-primary">レビューは投稿済みです</button>
        @else
        @auth
        <button type="button" class="btn btn-primary" @click="showReview">レビューを投稿</button>
        <!-- <button type="button" class="btn btn-primary" @click="reviewModal">レビューを投稿</button> -->
        @else
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#guestModal">レビューを投稿</button> -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#guestModal">レビューを投稿</button>

        @endauth
        @endif
        </p>
    </div>
</section>

<div class="container detail">

    <ul class="nav d-flex justify-content-around nav nav-tabs">
        <li @click="tabChange(1)" :class="{'active': isActive === 1}">プロフィール</li>
        <li @click="tabChange(2)" :class="{'active': isActive === 2}">レビュー</li>
        <li @click="tabChange(3)" :class="{'active': isActive === 3}">チャット</li>
        <li @click="tabChange(4)" :class="{'active': isActive === 4}">いいね</li>
    </ul>

    <article v-if="isActive === 1" class="detail mb-5">

        <h2>詳細</h2>
        <table class="table table-striped">

            <tr>
                <th>面積</th>
                <td>{{ number_format($country->area) }}万平方キロメートル</td>
            </tr>
            <tr>
                <th>人口</th>
                <td>約{{ number_format($country->population) }}万人</td>
            </tr>
            <tr>
                <th>首都</th>
                <td>{{ $country->capital }}</td>
            </tr>
            <tr>
                <th>母国語</th>
                <td>{{ $country->language }}</td>
            </tr>
            <tr>
                <th>宗教</th>
                <td>{{ $country->religion }}</td>
            </tr>
            <tr>
                <th>入稿制限（コロナの影響の為）</th>
                <td>{{ $country->covid }}</td>
            </tr>
            <tr>
                <th>詳細</th>
                <td>
                    <p>{{ $country->detail }}</p>
                </td>
            </tr>
            <tr>
                <th>マップ</th>
                <!-- <td> <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9237205.544498684!2d28.420596565161407!3d55.58152447172236!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54afc73d4b0c9%3A0x3d44d6cc5757cf4c!2z44Ot44K344KiIOODouOCueOCr-ODrw!5e0!3m2!1sja!2sjp!4v1602160755350!5m2!1sja!2sjp" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></td> -->
            </tr>
        </table>

    </article>


    <article v-else-if="isActive === 2" class="mb-5">

        <h2>レビュー 一覧</h2>

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

        @if($review->imgpath !== "")
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

        <p>レビューがありません</p>

        @endif

    </article>

    <article v-else-if="isActive === 3">
        <h2>チャット</h2>




    </article>

    <article v-else-if="isActive === 4">
        <h2>いいねユーザー</h2>
    </article>

</div>


<review-component v-show="reviewModal" @review-child="closeReview" :country-id="{{ $country->id }}" :user-id="{{ Auth::id() ?? '[]' }}" />




</div>
@endsection