<script>

@if(session('success'))
    $.notify({
	// options
	message: '{{ session("success")}}' 
    },{
    // settings
    offset: {
		x: 10,
		y: 60
	},
	type: 'success'
    });
@endif
    
@if(session('info'))
    $.notify({
	// options
	message: '{{ session("info")}}' 
    },{
    //settings:
    offset: {
		x: 10,
		y: 60
	},
	type: 'info'
    });
@endif

@if(session('danger'))
    $.notify({
	// options
	message: '{{ session("danger")}}' 
    },{
    // settings
    offset: {
		x: 10,
		y: 60
	},
	type: 'danger'
    });
@endif

</script>