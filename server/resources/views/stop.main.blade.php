@extends('layouts.app')

@section('content')

<section class="jumbotron text-center">
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


<!-- <div class="album py-5 bg-light">
    <div class="container">

        <star-rating v-bind:rating="3" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="25"></star-rating>
        <div class="row">


            @foreach ($countries ?? '' as $country)
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <!-- href="{{ route('detail', $country->id) }}" -->
<a>
    <div class="card-body">
        <h3 class="text-center">{{ $country->name }}</h3>


        <table class="mt-２">
            <tbody>

                <tr>
                    <th>総合</th>
                    <td>
                        <div class="star-ratings-sprite">
                            <span @php $avg=$country->reviews->avg('recommend');
                                $num = $avg * 20;

                                echo ' style="width:' . round($num, 1) . '%"';

                                @endphp
                                class="star-ratings-sprite-rating">
                            </span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>治安</th>
                    <td>
                        <div class="star-ratings-sprite">
                            <span @php $avg=$country->reviews->avg('safe');
                                $num = $avg * 20;

                                echo ' style="width:' . round($num, 1) . '%"';

                                @endphp
                                class="star-ratings-sprite-rating">
                            </span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>物価</th>
                    <td>
                        <div class="star-ratings-sprite">
                            <span @php $avg=$country->reviews->avg('cost');
                                $num = $avg * 20;

                                echo ' style="width:' . round($num, 1) . '%"';

                                @endphp
                                class="star-ratings-sprite-rating">
                            </span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>料理</th>
                    <td>
                        <div class="star-ratings-sprite">
                            <span @php $avg=$country->reviews->avg('food');
                                $num = $avg * 20;

                                echo ' style="width:' . round($num, 1) . '%"';

                                @endphp
                                class="star-ratings-sprite-rating">
                            </span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>英語力</th>
                    <td>
                        <div class="star-ratings-sprite">
                            <span @php $avg=$country->reviews->avg('english');
                                $num = $avg * 20;

                                echo ' style="width:' . round($num, 1) . '%"';

                                @endphp
                                class="star-ratings-sprite-rating">
                            </span>
                        </div>
                    </td>
                </tr>
                <like-component :country-id="{{ $country->id }}" :auth-id="{{ Auth::user()->id ?? '[]' }}" />
            </tbody>
        </table>



    </div>
</a>
</div>
</div>
@endforeach



</div>
</div>
</div>


@endsection