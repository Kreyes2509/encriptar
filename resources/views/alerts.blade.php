@if (session('msg') == 'Bienvenido!')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
        Swal.fire({
        position: 'center',
        icon: 'success',
        title:'Bienvenido!',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif

@if (session('msg') == 'OK')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
        Swal.fire({
        position: 'center',
        icon: 'success',
        title:'mensaje encriptado',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif

@if (session('msg') == 'adios')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
        Swal.fire({
        position: 'center',
        icon: 'success',
        title:'adios',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif


@if (session('msg') == 'frase')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
        Swal.fire({
        position: 'center',
        icon: 'success',
        title:'mensaje descifrado',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif

@if (session('msg') == 'credenciales no validas')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'credenciales no validas',
    })
</script>
@endif

@if (session('msg') == 'datos no validos')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'datos no validos',
    })
</script>
@endif

@if (session('msg') == 'Badrequest')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'la frase no fue desencriptada',
    })
</script>
@endif

@if (session('msg') == 'Badrequest1')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'error al encriptar',
    })
</script>
@endif


@if (session('msg') == 'findError')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'El usuario no puede desencriptar esta fresa, porque no es el destinatorio',
    })
</script>
@endif

