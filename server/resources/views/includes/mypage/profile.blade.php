<h2 font-weight-bold>Profile</h2>
@if(!empty($user->acounts->icon))
<img class="img-thumbnail mb-4" src="{{ asset('/storage/' . $user->acounts->icon ) }}" alt="ユーザーアイコン" />
@elseif(optional($user->acounts)->gender == "男性")
<img class="img-thumbnail mb-4" src="{{ asset('/storage/men.png') }}" alt="男性アイコン" />
@elseif(optional($user->acounts)->gender === "女性")
<img class="img-thumbnail mb-4" src="{{ asset('/storage/women.png') }}" alt="女性アイコン" />
@else
<img class="img-thumbnail mb-4" src="{{ asset('/storage/none.png') }}" alt="女性アイコン" />

@endif

<table class="table table-striped mb-0">
    <tr>
        <th>アカウント名</th>
        <td>{{ $user->name }}</td>
    </tr>
    <tr>
        <th>年齢</th>
        <td>{{ optional($user->acounts)->age }}</td>
    </tr>
    <tr>
        <th>性別</th>
        <td>{{ optional($user->acounts)->gender }}</td>
    </tr>
    <tr>
        <th>趣味</th>
        <td>{{ optional($user->acounts)->hobby }}</td>
    </tr>
</table>
<table class="table table-striped">
    <tr>
        <th>プロフィール</th>
    </tr>
    <tr class="text" style="border-bottom: 1px solid #dee2e6;">
        <td class="br">{{ optional($user->acounts)->profile }}</td>
    </tr>
</table>

@if(!empty($user->acounts))
<div class="button mt-4">
    <button @click="showProfile" class="btn btn-primary">プロフィールを変更する</button>
</div>
@endif