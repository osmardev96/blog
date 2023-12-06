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
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<!-- Page JS Plugins -->
<!-- Page JS Code -->

<body class="">
    <div class="container-fluid">
        <div class="container mt-2">
            <div class="row">
                <div class="col">
                    <input class="form-control" id="busqueda" type="text" placeholder="buscar...">
                </div>
                <div class="col">
                    <button id="buscar" class="btn btn-primary">buscar</button>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <button class="btn btn-primary" onclick="window.location='{{ url('/registrar') }}'">nuevo</button>
                </div>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">titulo</th>
                        <th scope="col">autor</th>
                        <th scope="col">fecha publicacion</th>
                        <th scope="col">contenido</th>
                    </tr>
                </thead>
                <tbody id="tabla">
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        let modulo = {
            mostrarEntradas(entradas) {
                $('#tabla').empty();
                if (entradas.length == 0) {
                    $('#tabla').append(`
						<tr class="text-center">
							<td colspan="5">sin registros</td>
						</tr>
					`);
                }
                entradas.forEach(entrada => {
                    let contenido = entrada.contenido;
                    let contenidoTexto = contenido;
                    if (contenido.length > 70) {
                        contenidoTexto = contenido.slice(0, 70) + '...';
                    }
                    $('#tabla').append(`
                        <tr>
                            <th scope="row">${entrada.id}</th>
                            <td>${entrada.titulo}</td>
                            <td>${entrada.autor}</td>
                            <td>${entrada.fecha_publicacion}</td>
                            <td id="contenido" data-contenido="${contenido}">${contenidoTexto}</td>
                        </tr>
					`);
                });
            }
        }
        $.ajax({
            url: "/api/entradas",
            method: 'get',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(entradas) {
                modulo.mostrarEntradas(entradas);
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

        $(document).on('click', '#tabla tr', function(event) {
            let tr = $(this);
            let td = tr.find("td[id='contenido']");
            let actual = td.text();
            let contenido = $(td).data('contenido');
            $(td).data('contenido', actual);
            $(td).text(contenido);
        });
        $(document).on('click', '#buscar', function(event) {
            let busqueda = $('#busqueda').val();
            $.ajax({
                url: `/api/entradas/${busqueda}`,
                method: 'get',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(entradas) {
                    modulo.mostrarEntradas(entradas);
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
    });
</script>

</html>
