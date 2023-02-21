<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <h2 align="center">Data siswa</h2>

   <div class="container">
   <table class="table table-hover table-striped">
        <thead>
            <tr class="bg-dark text-light">
                <th>Id</th>
                <th>Nama</th>
                <th>Tgl lahir</th>
                <th>Gender</th>
                <th>Alamat</th>
                <th>Hapus</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data_siswa as $siswa)
            <tr>
                <td>{{ $siswa -> id_siswa }}</td>
                <td>{{ $siswa -> nama_siswa }}</td>
                <td>{{ $siswa -> tanggal_lahir }}</td>
                <td>{{ $siswa -> gender }}</td>
                <td>{{ $siswa -> alamat }}</td>
                <td><form method="POST" action="{{url("deletesiswa/$siswa->id_siswa") }}">
                    @method('DELETE') 
                    <input type="submit" class="btn btn-warning" value="hapus">
                </form></td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
   </div>
    
</body>
</html>