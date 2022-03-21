<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <style type="text/css">
            body{
                font-family: Roboto;
            }
            .contenedor{
                padding: 0px 7vw 0px 7vw;
            }
            .contenedor_interior{
                background-image: linear-gradient(#fff8eb, #ffe7b5);
                padding: 10px 3vw 10px 3vw;
            }
            .final{
                text-align: center !important;
                font-size: 0.7em;
                font-weight: 600;
                padding-top: 1em;
            }
        </style>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    </head>
    <body>
        <div class="contenedor">
            <img src="{{ $message->embed('img/cabecera_correo.png') }}" width="100%">
            <div class="contenedor_interior">
                @yield('contenido')
            </div>
            <div class="final">
                Por favor No Responda a este correo.
            </div>
        </div>
    </body>
</html>