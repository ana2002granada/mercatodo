<script>
    window.message = []
    @if( Session::has( 'error' ))
        window.message.push({
            type:'error',
            title: 'Error',
            message: '{{ Session::get( 'error' ) }}'
        })
    @elseif( Session::has( 'success' ))
    window.message.push({
        type:'success',
        title: 'Exito',
        message: '{{ Session::get( 'success' ) }}'
    })
    @endif
</script>

