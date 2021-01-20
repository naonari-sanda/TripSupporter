<h2 font-weight-bold>Profile</h2>
@if(!empty($user->acount->icon))
<img class="img-thumbnail mb-4" src="{{ $user->acount->icon }}" alt="ユーザーアイコン" />
@elseif(optional($user->acount)->gender == "男性")
<img class="img-thumbnail mb-4" src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/men.png" alt="男性アイコン" />
@elseif(optional($user->acount)->gender === "女性")
<img class="img-thumbnail mb-4" src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/women.png" alt="女性アイコン" />
@else
<img class="img-thumbnail mb-4" src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/none.png" alt="アイコン" />

@endif

<table class="table table-striped mb-0">
    <tr>
        <th>アカウント名</th>
        <td>{{ $user->name }}</td>
    </tr>
    <tr>
        <th>年齢</th>
        <td>{{ optional($user->acount)->age }}</td>
    </tr>
    <tr>
        <th>性別</th>
        <td>{{ optional($user->acount)->gender }}</td>
    </tr>
    <tr>
        <th>趣味</th>
        <td>{{ optional($user->acount)->hobby }}</td>
    </tr>
</table>
<table class=" table table-striped">
    <tr>
        <th>プロフィール</th>
    </tr>
    <tr class="text" style="border-bottom: 1px solid #dee2e6;">
        <td class="br">{!! nl2br(optional($user->acount)->profile) !!}</td>

    </tr>
</table>

<div class=" mt-4">
    @if(Auth::id() == $user->id and !empty($user->acount))
    <div class="button mr-3 mb-4">
        <button class="btn btn-primary" @click="showProfileEdit">プロフィールを変更する</button>
    </div>
    <form action="{{ route('delete.acount') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $user->acount->id }}">
        <input onclick="return confirm('{{ $user->name }} さんのプロフィールを削除してもよろしいですか？')" class="btn btn-danger  mb-3" type="submit" value="プロフィールを削除する">
    </form>
    @endif
</div>
<acount-edit-component v-show="profileEditModal" @profile-child="closeProfileEdit" :user-id="{{ $user->id }}" :user-data="{{ $user->acount ?? '[]' }}" /> 