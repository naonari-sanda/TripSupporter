<h2 font-weight-bold>Favorite</h2>

<div class="row">
    @foreach ($user->likes as $like)
    <div class="col d-flex justify-content-center ">
        <div class="card" style="width: 18rem; margin-bottom: 5rem;">
            <img class="card-img-top" src="https://placehold.it/400x230" alt="Card image cap" />
            <div class="card-body">
                <h5 class="card-title font-weight-bolder">{{ $like->country->name }}</h5>
                <div class="d-flex">
                    <star-rating v-bind:increment="0.5" v-bind:rating="{{ $like->country->reviews->avg('recommend') ?? '0' }}" text-class="custom-text" v-bind:read-only="true" v-bind:show-rating="false" v-bind:star-size="25" active-color="#ff4742"></star-rating>
                    <p class="custom-text d-flex align-items-center mb-0 ml-1">{{ $like->country->reviews->avg('recommend') ?? '' }}</p>
                </div>
                <p class="card-text mt-2">Some quick example text to build on </p>
                <p>{{ $like->user_id ? 'true' : 'false' }}</p>
                <div class="d-flex">
                    <a href="{{ route('detail', $like->country->id ) }}" class="btn btn-primary">詳細はこちら</a>

                    <like-component :country-id="{{ json_encode($like->country->id) }}" :auth-id="{{ json_encode(Auth::user()->id ?? '[]') }}" :like-check="{{ json_encode($like) }}" :like-count="{{ json_encode(count($like->country->likes)) }}" />
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>