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
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
    </style>
</head>
<!-- jQuery (required for DataTables plugin) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<!-- Page JS Plugins -->
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<!-- Page JS Code -->

<body class="">
    <div class="container-fluid">
        <div class="container mt-4">
            <form id="formulario">
                @csrf
                <div class="form-group">
                    <label for="titulo">titulo</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" aria-describedby="titulo"
                        placeholder="titulo">
                </div>
                <div class="form-group">
                    <label for="autor">autor</label>
                    <input type="text" class="form-control" id="autor" name="autor" aria-describedby="autor"
                        placeholder="autor">
                </div>
                <div class="form-group">
                    <label for="fecha_publicacion">fecha_publicacion</label>
                    <input type="date" class="form-control" id="fecha_publicacion" name="fecha_publicacion"
                        aria-describedby="fecha_publicacion" placeholder="fecha_publicacion">
                </div>
                <div class="form-group">
                    <label for="contenido">contenido</label>
                    <textarea type="text" class="form-control" id="contenido" name="contenido" aria-describedby="contenido"
                        placeholder="contenido"></textarea>
                </div>
                <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        let modulo = {
            obtenerFechaActual() {
                let fecha = new Date();
                let dia = fecha.getDate();
                let mes = fecha.getMonth() + 1;
                let anio = fecha.getFullYear();
                dia = (dia < 10) ? `0${dia}` : dia;
                return anio + "-" + mes + "-" + dia;
            }
        };
        $('#fecha_publicacion').val(modulo.obtenerFechaActual());

        $('#formulario').validate({
            rules: {
                'titulo': {
                    required: true,
                },
                'autor': {
                    required: true,
                },
                'fecha_publicacion': {
                    required: true,
                },
                'contenido': {
                    required: true,
                },
            },
            messages: {
                'titulo': {
                    required: 'Requerido',
                },
                'autor': {
                    required: 'Requerido',
                },
                'fecha_publicacion': {
                    required: 'Requerido',
                },
                'contenido': {
                    required: 'Requerido',
                },
            }
        });

        $('#guardar').click(function(e) {
            e.preventDefault();

            if (!$('#formulario').valid()) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Aviso',
                    text: 'Campos requeridos',
                });
                return;
            }
            let datos = $('#formulario').serialize();
            $.ajax({
                url: "/api/guardar",
                method: 'post',
                dataType: 'json',
                data: datos,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(respuesta) {
                    let codigo = parseInt(respuesta.codigo);
                    if (codigo === 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Exito',
                            text: '',
                            timer: 1000
                        }).then(() => {
                            window.location.href = "/";
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Aviso',
                            text: 'Campos requeridos',
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: '<a href="">Why do I have this issue?</a>'
                    });
                }
            })
        });
    });
</script>

</html>
