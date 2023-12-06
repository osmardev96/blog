<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('js/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
    </style>
</head>
    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <!-- Page JS Code -->

<body class="antialiased">
    <button class="btn btn-primary" onclick="window.location='{{ url("/registrar") }}'">Agregar</button>
    <div id="contenedor-entrada">

    </div>
</body>
<script>
    $(document).ready(function () {

    $.ajax({
        url: "/api/entradas",
        method: 'get',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(respuesta) {
            console.log(respuesta);
            /*let code = parseInt(respuesta.code);
            if (code === 1) {
                Swal.fire({
                    icon: 'success',
                    title: 'Exito',
                    text: '',
                    timer: 3000
                }).then(() => {
                    window.location.href = "/dashboard";
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Aviso',
                    text: 'Credenciales invalidas',
                });
            }*/
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<a href="">Why do I have this issue?</a>'
            });
        }
    });
});
</script>

</html>
