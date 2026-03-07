<!DOCTYPE html>
<html>
<head>
    <title>Reporte RTN - INATUR</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .title { font-size: 18px; font-weight: bold; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: right; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Instituto Nacional de Turismo (INATUR)</div>
        <div>Sistema de Información Gerencial - Reporte de Prestadores (RTN)</div>
        <div>Fecha de generación: {{ now()->format('d/m/Y H:i') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>RTN</th>
                <th>RIF</th>
                <th>Razón Social</th>
                <th>Categoría</th>
                <th>Estado</th>
                <th>Municipio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($providers as $provider)
                <tr>
                    <td>{{ $provider->num_rtn }}</td>
                    <td>{{ $provider->rif }}</td>
                    <td>{{ $provider->razon_social }}</td>
                    <td>{{ $provider->category->name }}</td>
                    <td>{{ $provider->municipality->state->name }}</td>
                    <td>{{ $provider->municipality->name }}</td>
                </tr>
            @endforeach
            @if($providers->isEmpty())
                <tr>
                    <td colspan="6" style="text-align: center;">No se encontraron registros activos en el RTN.</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        Generado automáticamente por el SIG-INATUR - Página <script type="text/php">if (isset($pdf)) { $pdf->page_script('echo $PAGE_NUM . " de " . $PAGE_COUNT;'); }</script>
    </div>
</body>
</html>
