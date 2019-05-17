@if(Session::has('message'))
<script type="text/javascript">
$(function(){
  Swal.fire({
    title: 'สำเร็จ!',
    text: '{{Session::get('message')}}',
    type: 'success',
    confirmButtonText: 'ตกลง'
  })
})
</script>
@endif
@if(Session::has('error'))
<script type="text/javascript">
$(function(){
  Swal.fire({
    title: 'พบข้อผิดพลาด!',
    text: '{{Session::get('error')}}',
    type: 'error',
    confirmButtonText: 'ตกลง'
  })
})
</script>
@endif