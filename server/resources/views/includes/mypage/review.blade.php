<h2 font-weight-bold>Review</h2>


@if(count($user->reviews) > 0)
<table class="table table-hover">
    <thead class="">
        <tr>
            <th scope="col">国名</th>
            <th scope="col">オススメ</th>
            <!-- <th scope="col">レビュー</th> -->
            <th scope="col">詳細</th>
            <th scope="col">編集</th>
            <th scope="col">削除</th>
        </tr>
    </thead>
    <tbody>

        @foreach($user->reviews as $review)
        <tr>

            <th><a class="text-dark d-flex align-items-center" href="{{ route('detail' , $review->country_id) }}"><img class="cycle img-thumbnail mr-2" src="{{ asset('/storage/' . $review->country->imgpath) }}" alt="{{ $review->country->name }}のアイコン" />{{ $review->country->name }}</a></th>
            <td class="">
                <p class="mb-0"><i class=" fas fa-star mr-1 text-danger"></i>{{ $review->recommend }}</p>
            </td>
            <!-- <td>{{ $review->review }}</td> -->
            <td>
                <button class="btn btn-primary" data-toggle="modal" data-target="#review-{{ $review->id }}">詳細</button>
            </td>
            <td>
                <button class="btn btn-success" @click="showReview({{ $review->country_id }},{{ json_encode( $review->country->name ) }},{{ json_encode($review) }})">編集</button>
            </td>
            <td>
                <form action="{{ route('review.delete') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $review->id }}">
                    <input onclick="return confirm('{{ $review->country->name }} のレビューを削除してもよろしいですか？')" class="btn btn-danger" type="submit" value="削除">
                </form>
            </td>
        </tr>

        <div class="modal fade" id="review-{{ $review->id}}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content mx-auto" style="max-width:360px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span class="font-weight-bold ml-1">{{ $review->country->name }}</span>のレビューの詳細</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="star d-flex align-items-center mb-2">
                            <label class="font-weight-bold">総合</label>
                            <div class="d-flex align-items-center">
                                <star-rating v-bind:increment="0.5" v-bind:rating="{{ $review->recommend }}" text-class="custom-text" v-bind:show-rating="true" v-bind:read-only="true" v-bind:star-size="28" active-color="#ff4742"></star-rating>
                            </div>
                        </div>


                        <div class="star d-flex align-items-center">
                            <label class="font-weight-bold">治安</label>
                            <div class="d-flex align-items-center">
                                <star-rating v-bind:increment="1" v-bind:rating="{{ $review->safe }}" v-bind:show-rating="false" v-bind:read-only="true" v-bind:star-size="25" active-color="#ff4742"></star-rating>
                            </div>
                        </div>

                        <div class="star d-flex align-items-center">
                            <label class="font-weight-bold">費用</label>
                            <div class="d-flex align-items-center">
                                <star-rating v-bind:increment="1" v-bind:rating="{{ $review->cost }}" v-bind:show-rating="false" v-bind:read-only="true" v-bind:star-size="25" active-color="#ff4742"></star-rating>
                            </div>
                        </div>

                        <div class="star d-flex align-items-center">
                            <label class="font-weight-bold">観光</label>
                            <div class="d-flex align-items-center">
                                <star-rating v-bind:increment="1" v-bind:rating="{{ $review->tourism }}" v-bind:show-rating="false" v-bind:read-only="true" v-bind:star-size="25" active-color="#ff4742"></star-rating>
                            </div>
                        </div>

                        <div class="star d-flex align-items-center">
                            <label class="font-weight-bold">料理</label>
                            <div class="d-flex align-items-center">
                                <star-rating v-bind:increment="1" v-bind:rating="{{ $review->food }}" v-bind:show-rating="false" v-bind:read-only="true" v-bind:star-size="25" active-color="#ff4742"></star-rating>
                            </div>
                        </div>

                        <div class="star d-flex align-items-center">
                            <label class="font-weight-bold">英語</label>
                            <div class="d-flex align-items-center">
                                <star-rating v-bind:increment="1" v-bind:rating="{{ $review->english }}" v-bind:show-rating="false" v-bind:read-only="true" v-bind:star-size="25" active-color="#ff4742"></star-rating>
                            </div>
                        </div>

                        <div class="star d-flex align-items-center mb-3">
                            <label class="font-weight-bold">楽しさ</label>
                            <div class="d-flex align-items-center">
                                <star-rating v-bind:increment="1" v-bind:rating="{{ $review->fun }}" v-bind:show-rating="false" v-bind:read-only="true" v-bind:star-size="25" active-color="#ff4742"></star-rating>
                            </div>
                        </div>

                        <div class="star mb=1">
                            <p class=" font-weight-bold mb-0">お気に入り都市</p>
                            <div>
                                <p class="mb-0">{{ $review->city ?: '回答はありません'  }}</p>
                            </div>
                        </div>

                        <div class="star mb=1">
                            <p class="font-weight-bold mb-0">レビュー</p>
                            <div>
                                <p class="mb-0">{{ $review->review }}</p>
                            </div>
                        </div>

                        @if (!empty( $review->imgpath ))
                        <div class="star">
                            <p class="font-weight-bold mb-1">画僧</p>
                            <div>
                                <img class="img-thumbnail" src="{{ asset('/storage/' . $review->imgpath) }}" alt=" {{ $review->country->name }}の画像" />
                            </div>
                        </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>

        @endforeach
        <review-edit-component v-show="reviewModal" @review-child="closeReview" :country-id="countryId" :country-name="countryName" :user-id="{{ Auth::id() ?? '[]' }}" :review-data="reviewDetail" />



    </tbody>
</table>
@else
<div>
    <h5 class="mb-5">＊レビューの投稿がありません</h5>
    <a href="{{ route('main') }}" type="button" class="btn btn-primary">お気に入りの国をさがそう！</a>
</div>
@endif