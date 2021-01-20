@extends('layouts.app')
@section('title', '{{ $user->name }}さんのページ')

@section('content')
<section class="jumbotron text-center d-flex align-items-center visual">
    <div class="bg">
        <img class="card-img-top country_img" src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/user.jpg" alt="Card image cap" />
        <div class="container text">
            <div class="mb-0">
                @if(Auth::id() === $user->id)
                <h1 class="jumbotron-heading text-light mb-0 font-weight-bold">
                    マイページ
                </h1>
                @else
                <h1 class="jumbotron-heading text-light mb-0 font-weight-bold">
                    {{ $user->name }}さんのページ
                </h1>
                @endif
            </div>
            <p class="lead text-light">Find your favorite user</p>


            @if(Auth::id() == $user->id and empty($user->acount))
            <button type="button" class="btn btn-danger" @click="showProfile">プロフィールを追加する</button>
            @else
            <a href="{{ route('main') }}" type="button" class="btn btn-primary">お気に入りの国をさがそう!</a>
            @endif
        </div>
    </div>
</section>

<div class="container mypage">

    <ul class="nav d-flex justify-content-around nav nav-tabs">
        <li @click="tabChange(1)" :class="{'active': isActive === 1}">プロフィール</li>
        <li @click="tabChange(2)" :class="{'active': isActive === 2}">レビュー</li>
        <li @click="tabChange(3)" :class="{'active': isActive === 3}">いいね</li>
        <li @click="tabChange(4)" :class="{'active': isActive === 4}">フォト</li>
    </ul>

    <article v-if="isActive === 1" class="profile">
        @include('includes.user.profile')
    </article>

    <article v-else-if="isActive === 2" class="review">
        @include('includes.user.review')
    </article>

    <article v-else-if="isActive === 3" class="favorite">
        @include('includes.user.favorite')
    </article>

    <article v-else-if="isActive === 4" class="phots ">
        @include('includes.user.phots')
    </article>

    <acount-component v-show="profileModal" @profile-child="closeProfile" :user-id="{{ $user->id }}" />
</div>
@endsection 