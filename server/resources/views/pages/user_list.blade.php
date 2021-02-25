@extends('layouts.app')
@section('title', 'ユーザー一覧ページ')

@section('content')
<section class="jumbotron text-center d-flex align-items-center visual">
    <div class="bg">
        <img class="card-img-top country_img" src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/user.jpg" alt="Card image cap" />
        <div class="container text">
            <h1 class="jumbotron-heading text-light mb-0 font-weight-bold">
                ユーザー一覧
            </h1>
            <p class="lead text-light">Find your favorite user</p>

            <a href="{{ route('main') }}" role="button" class="btn btn-primary">お気に入りの国をさがそう！</a>
        </div>
    </div>
</section>

<div class="container mypage">
    <article class="user">
        <table class="table table-hover">
            <thead class="">
                <tr>
                    <th scope="col">ユーザー</th>
                    <th scope="col">性別</th>
                    <th scope="col">年齢</th>
                    <th scope="col">詳細</th>
                </tr>
            </thead>
            <tbody>

                @foreach($users as $user)
                <tr>

                    <td>
                        <a class="text-dark d-flex align-items-center font-weight-bold" href="{{ route('user', $user->id) }}">

                            @if(!empty($user->acount->icon))
                            <img class="cycle img-thumbnail mr-2" src="{{ $user->acount->icon }}" alt="ユーザーアイコン" />
                            @elseif(optional($user->acount)->gender == "男性")
                            <img class="cycle img-thumbnail mr-2" src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/men.png" alt="男性アイコン" />
                            @elseif(optional($user->acount)->gender === "女性")
                            <img class="cycle img-thumbnail mr-2" src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/women.png" alt="女性アイコン" />
                            @else
                            <img class="cycle img-thumbnail mr-2" src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/none.png" alt="アイコン" />
                            @endif
                            {{ $user->name }}</a>
                    </td>
                    <td>{{ optional($user->acount)->gender ?? '回答なし' }}</td>
                    <td>{{ optional($user->acount)->age ?? '回答なし' }}</td>
                    <td>
                        <a href="{{ route('user', $user->id ) }}" class="btn btn-primary">詳細</a>
                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>
    </article>
</div>
@endsection