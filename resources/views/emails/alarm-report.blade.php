<!DOCTYPE html>
<html>
<head>
    <title>Smartship</title>
</head>
<body>
    <table>
        <tr>
            <td>VESSEL</td>
            <td>{{ $fleet->name }}</td>
        </tr>
        <tr>
            <td>SATELLITE TELEPHONE</td>
            <td>{{ $fleet->telp }}</td>
        </tr>
        <tr>
            <td>SATELLITE EMAIL</td>
            <td>{{ $fleet->email }}</td>
        </tr>
        <tr>
            <td>LAST UPDATE</td>
            <td>{{ $fleet->last_connection }}</td>
        </tr>
        <tr>
            <td>POSITION</td>
            <td>{{ $status[$fleet->fleet_status] }}</td>
        </tr>
        <tr>
            <td>CONNECTION</td>
            <td>{{ $fleet->connected ? 'Good' : 'Lost' }}</td>
        </tr>
    </table>
</body>
</html>