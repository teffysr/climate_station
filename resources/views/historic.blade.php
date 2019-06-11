@extends('layouts.layout')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Temperatura_Abrigo">ta</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Temperatura_Abrigo_Min">tamin</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Temperatura_Abrigo_Max">tamax</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Temp_Intemperie_5cm">ti5</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Temp_Intemperie_5cm_min">ti5min</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Temp_Intemperie_50cm_min">ti50min</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Temperatura_Suelo_5cm">ts5</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Temperatura_Suelo_10cm">ts10cm</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Precipitacion_Pluv">pp</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Precipitacion_Crono">pc</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Humedad_81420">h81420</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Humedad_Media">hm</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Vel_Viento_10m">vv10</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Vel_Viento_2m">vv2</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Vel_Viento_Max">vvmax</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Dir_Viento_2m">dv2</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Dir_Viento_10m">dv10</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Prof_Napa">pn</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Horas_Frio">hf</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Unidades_Frio">uf</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Durac_Follaje_Mojado">dfm</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Presion_Media">pm</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Helio_Efectiva">he</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Helio_Relativa">hr</th>
                <th scope="col" data-toggle="tooltip" data-placement="top" title="Rocio_Medio">rm</th>
            </tr>            
        </thead>
        <tbody>
            @foreach ($stationValue as $value)
                <tr>
                    <td scope="col" style="width: 115px; display: block; border:none">{{ $value->fecha }}</td>
                    <td scope="col">{{ $value->temperatura_abrigo }} </td>
                    <td scope="col">{{ $value->temperatura_abrigo_min }} </td>
                    <td scope="col">{{ $value->temperatura_abrigo_max }} </td>
                    <td scope="col">{{ $value->temp_intemperie_5cm }} </td>
                    <td scope="col">{{ $value->temp_intemperie_5cm_min }} </td>
                    <td scope="col">{{ $value->temp_intemperie_50cm_min }} </td>
                    <td scope="col">{{ $value->temperatura_suelo_5cm }} </td>
                    <td scope="col">{{ $value->temperatura_suelo_10cm }} </td>
                    <td scope="col">{{ $value->precipitacion_pluv }} </td>
                    <td scope="col">{{ $value->precipitacion_crono }} </td>
                    <td scope="col">{{ $value->humedad_81420 }} </td>
                    <td scope="col">{{ $value->humedad_media }} </td>
                    <td scope="col">{{ $value->vel_viento_10m }} </td>
                    <td scope="col">{{ $value->vel_viento_2m }} </td>
                    <td scope="col">{{ $value->vel_viento_max }} </td>
                    <td scope="col">{{ $value->dir_viento_2m }} </td>
                    <td scope="col">{{ $value->dir_viento_10m }} </td>
                    <td scope="col">{{ $value->prof_napa }} </td>
                    <td scope="col">{{ $value->horas_frio }} </td>
                    <td scope="col">{{ $value->unidades_frio }} </td>
                    <td scope="col">{{ $value->durac_follaje_mojado }} </td>
                    <td scope="col">{{ $value->presion_media }} </td>
                    <td scope="col">{{ $value->helio_efectiva }} </td>
                    <td scope="col">{{ $value->helio_relativa }} </td>
                    <td scope="col">{{ $value->rocio_medio }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $stationValue->links() }}

<script type="text/javascript">
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
</script>

@endsection