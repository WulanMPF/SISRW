<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table>
        @foreach ($data as $d)
            <tr>
                <td>Nama Undangan</td>
                <td>: </td>
                <td>{{ $d->undangan_nama }}</td>
            </tr>
            <tr>
                <td>Tempat Undangan</td>
                <td>: </td>
                <td>{{ $d->undangan_tempat }}</td>
            </tr>
            <tr>
                <td>Tanggal Undangan</td>
                <td>: </td>
                <td>{{ $d->undangan_tanggal }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
