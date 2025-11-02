<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h3 style="text-align:center;">Laporan Data Mahasiswa</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswas as $index => $mhs)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $mhs->nama }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
