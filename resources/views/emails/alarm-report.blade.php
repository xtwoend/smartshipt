<!DOCTYPE html>
<html>
<head>
    <title>Smartship</title>
</head>
<body>
    <div><b>DAILY ALARM MONITORING AND SENSOR CONDITION REPORT</b></div>
    <br>
    <br>
    <table>
        <tr>
            <td>VESSEL</td>
            <td>: <b>{{ $fleet->name }}</b></td>
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
        {{-- <tr>
            <td>POSITION</td>
            <td>: {{ $status[$fleet->fleet_status] }}</td>
        </tr> --}}
        <tr>
            <td>CONNECTION</td>
            <td>: {{ $fleet->connected ? 'Good' : 'Lost' }}</td>
        </tr>
        <tr>
            <td>POSITION</td>
            <td>: {{ $status[$fleet->fleet_status] }} @if(in_array($fleet->fleet_status, ['at_port', 'at_anchorage'])) {{ $fleet->last_port }} @endif, Latitude {{ $fleet->navigation?->lat }} {{ $fleet->navigation?->lat_dir }}, Longitude {{ $fleet->navigation?->lng }} {{ $fleet->navigation?->lng_dir }}</td>
        </tr>
        <tr>
            <td>COURSE</td>
            <td>: {{ $fleet->navigation->cog }} DEGREE</td>
        </tr>
        <tr>
            <td>DISTANCE TO RUN</td>
            <td>: {{ $fleet->navigation->distance }} NM</td>
        </tr>
        <tr>
            <td>TOTAL DISTANCE TO RUN</td>
            <td>: {{ $fleet->navigation->total_distance }} NM</td>
        </tr>
        <tr>
            <td>AVERAGE SPEED</td>
            <td>: {{ number_format($avgSpeed, 2) }} KNOT</td>
        </tr>
        <tr>
            <td>CURENT SPEED</td>
            <td>: {{ $fleet->navigation?->sog }} KNOT</td>
        </tr>
        <tr>
            <td>RPM (REV PER MINUTE)</td>
            <td>: {{ $fleet->engine()?->rpm == 0 &&  $fleet->navigation?->sog > 2 ? 'UNAVAILABLE': $fleet->engine()?->rpm }} RPM</td>
        </tr>
        @if($fleet->navigation?->wind_speed <= 0 && $fleet->navigation?->sog > 0)
        <tr>
            <td>WEATHER CONDITION</td>
            <td>: UNAVAILABLE</td>
        </tr>
        @else
        <tr>
            <td>WEATHER CONDITION</td>
            <td>: Speed {{ $fleet->navigation?->wind_speed}}, Scale {{ scaleBeafort($fleet->navigation?->wind_speed) }}, Direction {{ $fleet->navigation?->wind_direction }}</td>
        </tr>
        @endif
    </table>
    <br>
    <div><b>Sensor condition: <span style="color:red;">{{ $sensors->abnormal ?? 0 }}</span> of the <span style="color:red;">{{ $sensors->total ?? 0 }}</span> sensors recorded were abnormal</b></div>
    <br>
    <br>
    {{-- TODO: collection  alarm terbanyak --}}
    {{-- <div>Abnormal Alarm that just occurred: </div>
    <br>
    <table>
        <tr>
            <th>ALARM MESSAGE</th>
            <th>DURATION</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table> --}}
    <br>
    <br>
    <div><b>Sensor condition and alarm history information document from 6 am & 12 pm yesterday until now in the attached pdf file. </b></div>
    <br>
    <br>
    <div style="font-size: 12px; padding: 20px; 0;"><i>Note: This message has been sent by smartship system. Please do not reply</i></div>
    <br>
    <br>
    <div><b>By PIS Smartship System - Fleet Management Solution </b></div>
    {{-- <div>LAST UPDATE: {{ $fleet->last_connection }}</div> --}}
    <div><b>Auto Created At: {{ date('Y-m-d H:i:s') }}</b></div>
    <br>
    <div>Contact Person :</div>
    <div>Aris Yulianto</div>
    <div>aris.yulianto@pertamina.com</div>
    <div>+62 813 2000 2481</div>
    <br>
    <br>
    <div>Disclaimer:</div>
    <div style="text-align: justify; text-justify: inter-word;">The information contained in this transmission, including any attachment(s), is confidential information intended for the use of the intended recipient only. Any dissemination, distribution or copying of this communication by any person other than the intended recipient is strictly prohibited and subject to applicable law. If you are not the intended recipient of this communication, please immediately advise the sender of this fact and completely destroy this transmission.</div>
    <br>
    <br>
    <div>Copyright@2023 Fleet Management Solutions</div>
</body>
</html>