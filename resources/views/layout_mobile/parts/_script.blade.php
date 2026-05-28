<!-- Required jquery and libraries -->
<script src="{{ mix('js/bankminimobile.js') }}"></script>
<script>
	function handleLogout(){
		FlutterChannel.postMessage('logout');
	}
</script>
@stack('scripts')