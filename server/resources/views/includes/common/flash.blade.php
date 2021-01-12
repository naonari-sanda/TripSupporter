@if(session('success_message'))
<script>
    toastr.success("{{  session('success_message')  }}");
</script>
@elseif (session('danger_message'))
<script>
    toastr.error("{{  session('danger_message')  }}");
</script>
@elseif (session('info_message'))
<script>
    toastr.info("{{ session('info_message') }}");
</script>
@endif
@if(count($errors) !== 0)
<script>
    toastr.error('エラーが発生しました');
</script>
@endif