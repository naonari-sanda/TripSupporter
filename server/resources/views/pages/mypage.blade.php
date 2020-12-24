@extends('layouts.app')
@section('title', 'マイページ')

@section('content')
<section class="jumbotron text-center d-flex align-items-center">
    <div class="container">
        <h1 class="jumbotron-heading text-light mb-0">
            マイページ
        </h1>
        <p class="lead text-muted">
            Something short and leading about the collection below—its contents,
            the creator, etc. Make it short and sweet, but not too short so folks
            don't simply skip over it entirely.
        </p>

        @if(!isset($user->acounts))
        <button type="button" class="btn btn-danger" @click="showProfile">プロフィールを追加する</button>
        @else
        <a href="{{ route('main') }}" type="button" class="btn btn-primary">お気に入りの国をさがそう！</a>
        @endif
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
        @include('includes.mypage.profile')
    </article>

    <article v-else-if="isActive === 2" class="review">
        @include('includes.mypage.review')
    </article>

    <article v-else-if="isActive === 3" class="favorite">
        @include('includes.mypage.favorite')
    </article>

    <article v-else-if="isActive === 4" class="phots ">
        @include('includes.mypage.phots')
    </article>

    <acount-component v-show="profileModal" @profile-child="closeProfile" :user-id="{{ $user->id }}" />
</div>






</div>
@endsection