<script>
    window.message = []
    @if( Session::has( 'error' ))
        window.message.push({
            type:'error',
            title: '{{trans('dashboard.error')}}',
            message: '{{ Session::get( 'error' ) }}'
        })
    @elseif( Session::has( 'success' ))
    window.message.push({
        type:'success',
        title: '{{trans('dashboard.success')}}',
        message: '{{ Session::get( 'success' ) }}'
    })
    @endif
</script>

