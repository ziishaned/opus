@if(Session::get('alert_type'))
	<script type="text/javascript">
		@if(Session::get('alert_type') === 'success')
			toastr.success("{{ Session::get('alert') }}")
		@endif
		@if(Session::get('alert_type') === 'info')
	 		toastr.info("{{ Session::get('alert') }}");
		@endif
		@if(Session::get('alert_type') === 'warning')
	 		toastr.warning("{{ Session::get('alert') }}");
		@endif
		@if(Session::get('alert_type') === 'error')
	 		toastr.error("{{ Session::get('alert') }}");
		@endif
	</script>
@endif