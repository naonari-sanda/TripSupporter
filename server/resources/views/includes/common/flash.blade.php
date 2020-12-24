@if(session('flash_message'))
<script>
    toastr.success("{{  session('flash_message')  }}");
</script>
@endif
@if(count($errors) !== 0)
<script>
    toastr.error('エラーが発生しました');
</script>
@endif