<h2 font-weight-bold>Review</h2>

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

            <th><a class="text-dark" href="{{ route('detail' , $review->country_id) }}">{{ $review->country->name }}</a></th>
            <td><i class=" fas fa-star mr-1 text-danger"></i>{{ $review->recommend }}</td>
            <!-- <td>{{ $review->review }}</td> -->
            <td>
                <button class="btn btn-primary" data-toggle="modal" data-target="#review-{{ $review->id }}">詳細</button>
            </td>
            <td>
                <button class="btn btn-success" @click="showReview({{ $review->country_id }},'{{ $review->country->name }}')">編集</button>
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
                    </div>
                </div>
            </div>
        </div>
        </div>
        @endforeach
        <review-create-component v-show="reviewModal" @review-child="closeReview" :country-id="countryId" :country-name="countryName" :user-id="{{ Auth::id() ?? '[]' }}" />
        <review-detail-component v-show="reviewDetailModal" @review-detail-child="closeReviewDetail" :raview-detail="reviewDetail" />
    </tbody>
</table>