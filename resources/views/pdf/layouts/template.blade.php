<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Documento' }}</title>

    <link rel="stylesheet" href="{{ resource_path('css/pdf/default.css') }}">
</head>
<body>
    <header>
        @section('header')
            <h1>{{ $title ?? 'Documento' }}</h1>
        @show
    </header>

    <div class="content">
        @yield('content')
    </div>

    <footer>
        @section('footer')
            <p>Generado el {{ now()->format('d/m/Y H:i:s') }} </p>
        @show
    </footer>

    {{-- PAGINACION --}}
    {{-- <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(300, 800, "Pagina $PAGE_NUM de $PAGE_COUNT", $font, 10);
            ');
        }
    </script> --}}
</body>
</html>
