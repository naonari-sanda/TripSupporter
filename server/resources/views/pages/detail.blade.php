@extends('layouts.app')
@section('title', '各国詳細画面')

@section('content')
<section class="jumbotron text-center d-flex align-items-center visual">
    <div class="bg">
        <img class="card-img-top country_img" src="{{ asset('/storage/' . $country->imgpath ) }}" alt="Card image cap" />


        <div class="container text">

            <h1 class="jumbotron-heading text-light mb-3 font-weight-bold">
                {{ $country->name }}
            </h1>
            <h6 class="text-light mb-3">{{ Str::limit($country->detail, $limit =90, $end = '...') }}
            </h6>

            @if(count($country->reviews->where('user_id', Auth::id())) !== 0)
            <button type="button" class="btn btn-primary">レビューは投稿済みです</button>
            @else
            @auth
            <button type="button" class="btn btn-danger" @click="showReview">レビューを投稿</button>
            @else
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#guestModal">レビューを投稿</button>
            @endauth
            @endif
            </p>
        </div>
    </div>
</section>

<div class="container detail">

    <ul class="nav d-flex justify-content-around nav nav-tabs">
        <li @click="tabChange(1)" :class="{'active': isActive === 1}">プロフィール</li>
        <li @click="tabChange(2)" :class="{'active': isActive === 2}">レビュー</li>
        <li @click="tabChange(3)" :class="{'active': isActive === 3}">いいね</li>
        <li @click="tabChange(4)" :class="{'active': isActive === 4}">写真</li>
    </ul>

    <article v-if="isActive === 1" class="profile mb-5">
        @include('includes.detail.profile')
    </article>


    <article v-else-if="isActive === 2" class="review mb-5">
        @include('includes.detail.review')
    </article>

    <article v-else-if="isActive === 3" class="favorite">
        @include('includes.detail.favorite')
    </article>

    <article v-else-if="isActive === 4" class="favorite">
        @include('includes.detail.phots')
    </article>

</div>


<review-create-component v-show="reviewModal" @review-child="closeReview" :country-id="{{ $country->id }}" :country-name="{{ json_encode($country->name) }}" :user-id="{{ Auth::id() ?? '[]' }}" />




</div>
@endsection