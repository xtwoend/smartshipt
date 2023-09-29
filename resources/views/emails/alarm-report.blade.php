<!DOCTYPE html>
<html>
<head>
    <title>Smartship</title>
</head>
<body>
    <table>
        <tr>
            <td>VESSEL</td>
            <td>: {{ $fleet->name }}</td>
        </tr>
        <tr>
            <td>SATELLITE TELEPHONE</td>
            <td>: {{ $fleet->telp }}</td>
        </tr>
        <tr>
            <td>SATELLITE EMAIL</td>
            <td>: {{ $fleet->email }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>POSITION</td>
            <td>: {{ $status[$fleet->fleet_status] }}</td>
        </tr>
        <tr>
            <td>CONNECTION</td>
            <td>: {{ $fleet->connected ? 'Good' : 'Lost' }}</td>
        </tr>
        <tr>
            <td>POSITION</td>
            <td>: LATITUDE {{ $fleet->navigation?->lat }} {{ $fleet->navigation?->lat_dir }}, LONGITUDE {{ $fleet->navigation?->lng }} {{ $fleet->navigation?->lng_dir }}</td>
        </tr>
        <tr>
            <td>COURSE</td>
            <td>: {{ $fleet->navigation->cog }}</td>
        </tr>
        <tr>
            <td>DISTANCE TO RUN</td>
            <td>: {{ $fleet->navigation->distance }}</td>
        </tr>
        <tr>
            <td>TOTAL DISTANCE TO RUN</td>
            <td>: {{ $fleet->navigation->total_distance }}</td>
        </tr>
        <tr>
            <td>AVERAGE SPEED</td>
            <td>: {{ $avgSpeed }}</td>
        </tr>
        <tr>
            <td>CURENT SPEED</td>
            <td>: {{ $fleet->navigation?->sog }} KNOT</td>
        </tr>
        <tr>
            <td>RPM (REV PER MINUTE)</td>
            <td>: {{ $fleet->engine()?->rpm == 0 &&  $fleet->navigation?->sog > 0 ? 'UNAVAILABLE': $fleet->engine()?->rpm }} RPM</td>
        </tr>
        @if($fleet->navigation?->wind_speed <= 0 && $fleet->navigation?->sog > 0)
        <tr>
            <td>WEATHER CONDITION</td>
            <td>: UNAVAILABLE</td>
        </tr>
        @else
        <tr>
            <td>WEATHER CONDITION</td>
            <td>: Speed {{ $fleet->navigation?->wind_speed}}, Scale {{ scaleBeafort($fleet->navigation?->wind_speed) }}, direction {{ $fleet->navigation?->wind_direction }}</td>
        </tr>
        @endif
    </table>
    <br>
    <br>
    <div>Alarm history information document from 6 am yesterday until now in the attached pdf file.</div>
    <div style="font-size: 12px; padding: 20px; 0;"><i>Note: This message has been sent by smartship system. Please do not reply</i></div>
    <div>By PIS Smartship System - Fleet Management Solution</div>
    <div>LAST UPDATE: {{ $fleet->last_connection }}</div>
    <div><b>AUTO CREATED AT: {{ date('Y-m-d H:i:s') }}</b></div>
</body>
</html>