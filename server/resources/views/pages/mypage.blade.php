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
        <button type="button" class="btn btn-denger" @click="showProfile">プロフィールを追加する</button>
        @else
        <a href="{{ route('main') }}" type="button" class="btn btn-primary">お気に入りの国をさがそう！</a>
        @endif
    </div>
</section>

<div class="container mypage">

    <ul class="nav d-flex justify-content-around nav nav-tabs">
        <li @click="tabChange(1)" :class="{'active': isActive === 1}">プロフィール</li>
        <li @click="tabChange(2)" :class="{'active': isActive === 2}">レビュー</li>
        <li @click="tabChange(3)" :class="{'active': isActive === 3}">チャット</li>
        <li @click="tabChange(4)" :class="{'active': isActive === 4}">いいね</li>
    </ul>

    <article v-if="isActive === 1" class="profile mb-5">
        @include('includes.mypage.user')
    </article>

    <article v-else-if="isActive === 2" class="review mb-5">
        @include('includes.mypage.review')
    </article>

    <article v-else-if="isActive === 3">
        <h2 font-weight-bold>Chat</h2>
    </article>

    <article v-else-if="isActive === 4">
        <h2 font-weight-bold>Favorite</h2>
    </article>

    <acount-component v-show="profileModal" @profile-child="closeProfile" :user-id="{{ $user->id }}" />
</div>






</div>
@endsection