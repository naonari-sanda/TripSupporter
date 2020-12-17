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
        <button type="button" class="btn btn-primary" @click="showProfile">プロフィールを追加する</button>
        @else
        <button type="button" class="btn btn-primary" @click="showProfile">HOME</button>
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

    <article v-if="isActive === 1" class="detail mb-5">

        <h2>詳細</h2>

        @if(isset($user->acounts->icon))
        <img class="img-thumbnail mb-4" src="{{ asset('/storage/' . $user->acounts->icon ) }}" alt="" />

        @endif

        <table class="table table-striped mb-0">
            <tr>
                <th>アカウント名</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>年齢</th>
                <td>{{ $user->acounts->age }}</td>
            </tr>
            <tr>
                <th>性別</th>
                <td>{{ $user->acounts->gender }}</td>
            </tr>
            <tr>
                <th>趣味</th>
                <td>{{ $user->acounts->hobby }}</td>
            </tr>
        </table>
        <table class="table table-striped">
            <tr>
                <td>プロフィール</td>
            </tr>
            <tr>
                <td>{{ $user->acounts->profile }}</td>
            </tr>
        </table>
    </article>

    <article v-else-if="isActive === 2" class="mb-5">
        <h2>レビュー 一覧</h2>
    </article>

    <article v-else-if="isActive === 3">
        <h2>チャット</h2>
    </article>

    <article v-else-if="isActive === 4">
        <h2>いいね</h2>
    </article>

    <acount-component v-show="profileModal" @profile-child="closeProfile" :user-id="{{ $user->id }}" />
</div>






</div>
@endsection