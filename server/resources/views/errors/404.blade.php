@extends('layouts.app')

@section('content')
<div class="error d-flex justify-content-center align-items-center">
<div class="container mx-auto">
    <h2 class="text-center mb-5 font-weight-bold">お探しのページは見つかりませんでした。</h2>
    <a href="{{ route('main') }}" class="text-center d-block h5">トップページに戻る</a>
</div>
</div>
@endsection