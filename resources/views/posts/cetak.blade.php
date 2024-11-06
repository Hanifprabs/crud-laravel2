<!DOCTYPE html>
<html>

<head>
    <title>Data Mahasiswa</title>
    <style>
        /* Style khusus untuk PDF */
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            width: 50px;
            /* Ukuran gambar */
            height: auto;
            /* Agar tetap proporsional */
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Data Mahasiswa</h2>
    <table>
        <thead>
            <tr>
                <th>FOTO</th>
                <th>NIM</th>
                <th>NAMA MAHASISWA</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td class="text-center">
                        <img src="{{ asset('storage/public/posts/' . $post->foto_mahasiswa) }}" class="rounded-circle"
                            style="width: 80px; height: 85px" alt="Foto Mahasiswa">
                    </td>
                    <td>{{ $post->nim }}</td>
                    <td>{{ $post->nama_mahasiswa }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center;">Data Mahasiswa tidak tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>