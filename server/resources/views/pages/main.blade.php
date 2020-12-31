@extends('layouts.app')
@section('title', '旅に出かけよう！')

@section('content')

<section class="jumbotron text-center visual mainvisual" style="margin-bottom: 6rem">
    <div class="bg">
        <img class="card-img-top country_img" src="{{ asset('/storage/main.jpg') }}" alt="Card image cap" />

        <div class="container text">
            <h1 class="jumbotron-heading font-weight-bold text-light mb-4">さあ 旅に出かけよう！</h1>

            <div id="search">
                <div class="inner">

                    <form action="{{ route('serch') }}" method="get">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="">
                                <label for="category">地域</label>
                                <select name="category" id="category" class="form-control">
                                    <option disabled selected value>選択...</option>
                                    <option value="ajia">アジア</option>
                                    <option value="ocea">オセアニア</option>
                                    <option value="eu">ヨーロッパ</option>
                                    <option value="easta">中東</option>
                                    <option value="africa">アフリカ</option>
                                    <option value="northa">北米</option>
                                    <option value="latin">南米</option>
                                </select>
                            </div>
                            <div class="">
                                <label for="special">詳細</label>
                                <select name="special" id="special" class="form-control">
                                    <option disabled selected value>選択...</option>
                                    <option value="wh">ワーキングホリデー</option>
                                    <option value="corona">入国可能国(コロナ禍)</option>
                                </select>
                            </div>

                            <div class="keyword">
                                <label for="keyword">国名</label>
                                <input id="keyword" type="text" name="keyword" class=" form-control" placeholder="入力てください...">
                            </div>
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container row mx-auto">
    <div class="col-lg-4 mb-2">
        <img class="rounded-circle mx-auto d-flex justify-content-center mb-3" src="{{ asset('/storage/find.png') }}" alt="" alt="Generic placeholder image" width="140" height="140">
        <h2 class="text-center">見つけよう</h2>
        <p class="text-center">「海外に行きたい！」しかし「どこに行くか？」。国々のそれぞれの良いところを紹介します。ぜひ、次の旅行先の決定の参考にしてみてくださいね。</p>
        <p class="d-flex justify-content-center">
            <a class="btn  btn-primary center-block" href="#" role="button">見つける &raquo;</a>
        </p>
    </div>
    <div class="col-lg-4 mb-2">
        <img class="rounded-circle mx-auto d-flex justify-content-center mb-3" src="{{ asset('/storage/corona.png')  }}" alt="Generic placeholder image" width="140" height="140">
        <h2 class="text-center">入国可能国</h2>
        <p class="text-center">新型コロナウィルス感染拡大中のヨーロッパではロックダウン中の国も多め。日本からの入国規制解除や緩和を発表した国にも変化が出ています。</p>
        <div class="d-flex justify-content-center">
            <form action="{{ route('serch') }}" method="get">
                @csrf
                <input type="hidden" name="special" value="corona">
                <input type="submit" class="btn  btn-primary" value="見つける &raquo;" />
            </form>
        </div>
    </div>
    <div class="col-lg-4 mb-2">
        <img class="rounded-circle mx-auto d-flex justify-content-center mb-3" src="{{ asset('/storage/waking.png') }}" alt="Generic placeholder image" width="140" height="140">
        <h2 class="text-center">ワーキングホリデー</h2>
        <p class="text-center">働きながら旅行をしたりということが出来るのはワーキングホリデーという制度だけです。ただお金の為に働くのではなく海外の文化を楽しもう！</p>
        <div class="d-flex justify-content-center">
            <form action="{{ route('serch') }}" method="get">
                @csrf
                <input type="hidden" name="special" value="wh">
                <input type="submit" class="btn  btn-primary" value="見つける &raquo;" />
            </form>
        </div>
    </div>
</div>

<hr class="featurette-divider" style="margin: 3rem 0;">

<div class="container main">
    <div class="row">

        @foreach ($countries ?? '' as $country)
        <div class="col d-flex justify-content-center">
            <div class="card shadow">
                <div class="bg">
                    <img class="card-img-top country_img" src="{{ asset('/storage/' . $country->imgpath ) }}" alt="Card image cap" />
                    <h5 class="text">{{ $country->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex mb-2">
                        <star-rating v-bind:increment="0.5" v-bind:rating="{{ $country->reviews->avg('recommend') ?? '0' }}" text-class="custom-text" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="23" active-color="#ff4742"></star-rating>
                        <p class="custom-text d-flex align-items-center mb-0 ml-1">{{ number_format($country->reviews->avg('recommend'),1) ?? '' }}</p>
                    </div>

                    <p class="card-text mb-2">{{ Str::limit($country->detail, $limit = 55, $end = '...') }}</p>
                    <div class="d-flex">
                        <a href="{{ route('detail', $country->id ) }}" class="btn btn-primary">詳細はこちら</a>

                        <like-component :country-id="{{ json_encode($country->id) }}" :auth-id="{{ json_encode(Auth::user()->id ?? '[]') }}" :like-count="{{ count($country->likes) }}" :like-check="{{ count($country->likes->where('user_id', Auth::id())) > 0 ? 'true' : 'false' }}" />
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    {{$countries->links()}}
</div>

@endsection