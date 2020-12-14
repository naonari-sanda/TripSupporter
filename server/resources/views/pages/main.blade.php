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

    <div class="row">
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

    <div class="container">
        <div class="row">

            @foreach ($countries ?? '' as $country)
            <div class="col d-flex justify-content-center ">
                <div class="card" style="width: 18rem; margin-bottom: 5rem;">
                    <img class="card-img-top" src="https://placehold.it/400x230" alt="Card image cap" />
                    <div class="card-body">
                        <h5 class="card-title">{{ $country->name }}</h5>
                        <div class="d-flex">
                            <star-rating v-bind:increment="0.5" v-bind:rating="{{ $country->reviews->avg('recommend') ?? '0' }}" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="25"></star-rating>
                            <p class="d-flex align-items-center mb-0 ml-1">{{ $country->reviews->avg('recommend') ?? '' }}</p>
                        </div>
                        <p class="card-text mt-2">Some quick example text to build on</p>
                        <div class="d-flex">
                            <a href="{{ route('detail', $country->id ) }}" class="btn btn-primary">詳細はこちら</a>

                            <like-component :country-id="{{ json_encode($country->id) }}" :auth-id="{{ json_encode(Auth::user()->id ?? '[]') }}" :like-check="{{ json_encode($like) }}" :like-count="{{ json_encode(count($country->likes)) }}" />
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{$countries->links()}}
        </div>
    </div>


    @endsection