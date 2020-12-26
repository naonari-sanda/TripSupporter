@extends('layouts.app')
@section('title', '旅に出かけよう！')

@section('content')

<section class="jumbotron text-center" style="margin-bottom: 3rem">
    <div class="container">
        <h1 class="jumbotron-heading text-light">さあ 旅に出かけよう！</h1>
        <p class="lead text-muted">
            Something short and leading about the collection below—its contents,
            the creator, etc. Make it short and sweet, but not too short so folks
            don't simply skip over it entirely.
        </p>
        <p>
            <a href="https://www.skyscanner.jp/" class="btn btn-primary my-2">チケットを探す</a>
        </p>
    </div>
</section>
<div class="container marketing">

    <div class="container row">
        <div class="col-lg-4 mb-2">
            <img class="rounded-circle mx-auto d-flex justify-content-center mb-3" src="{{ asset('/storage/find.png') }}" alt="" alt="Generic placeholder image" width="140" height="140">
            <h2 class="text-center">見つけよう</h2>
            <p class="text-center">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
            <p class="d-flex justify-content-center"><a class="btn  btn-primary center-block" href="#" role="button">見つける &raquo;</a></p>
        </div>
        <div class="col-lg-4 mb-2">
            <img class="rounded-circle mx-auto d-flex justify-content-center mb-3" src="{{ asset('/storage/corona.png')  }}" alt="Generic placeholder image" width="140" height="140">
            <h2 class="text-center">入国可能国</h2>
            <p class="text-center">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
            <p class="d-flex justify-content-center"><a class=" btn  btn-primary" href="#" role="button">見つける &raquo;</a></p>
        </div>
        <div class="col-lg-4 mb-2">
            <img class="rounded-circle mx-auto d-flex justify-content-center mb-3" src="{{ asset('/storage/waking.png') }}" alt="Generic placeholder image" width="140" height="140">
            <h2 class="text-center">ワーキングホリデー</h2>
            <p class="text-center">Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p class="d-flex justify-content-center"><a class=" btn  btn-primary" href="#" role="button">見つける &raquo;</a></p>
        </div>
    </div>



    <hr class="featurette-divider" style="margin: 3rem 0;">

    <div class="container main">
        <div class="row">

            @foreach ($countries ?? '' as $country)
            <div class="col d-flex justify-content-center">
                <div class="card shadow" style="width: 18rem; margin-bottom: 5rem;">
                    <div class="bg">
                        <img class="card-img-top country_img" src="{{ asset('/storage/' . $country->imgpath ) }}" alt="Card image cap" />
                        <h5 class="text">{{ $country->name }}:{{ count($country->reviews) }}</h5>
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

</div>


@endsection