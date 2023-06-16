@if(session()->has('Success'))
<script>
  $.NotificationApp.send("@lang('settings.Success')","{{ session()->get('Success') }}","bottom-right","rgba(0,0,0,0.2)","success")
</script>
@endif
@if(session()->has('Failed'))
<script>
  $.NotificationApp.send("@lang('settings.Failed')","{{ session()->get('Failed') }}","bottom-right","rgba(0,0,0,0.2)","error")
</script>
@endif
@if ($errors->any())
<script>
  $.NotificationApp.send("@lang('settings.Failed')","{{ $errors->all()[0] }}","bottom-right","rgba(0,0,0,0.2)","error")
</script>
@endif