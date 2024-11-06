@extends('dashboard')
@section('content')

<body style="background: lightgray">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('posts.create') }}" class="btn btn-md btn-success mb-3">TAMBAH MAHASISWA</a>
                        <a href="{{ route('posts.cetak') }}" class="btn btn-md btn-warning mb-3">SIMPAN PDF</a> <!-- Tombol Simpan PDF -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">FOTO</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">NAMA MAHASISWA</th>
                                    <th scope="col">ACT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/public/posts/' . $post->foto_mahasiswa) }}" class="rounded-circle" style="width: 80px; height: 85px" alt="Foto Mahasiswa">
                                        </td>
                                        <td>{{ $post->nim }}</td>
                                        <td>{{ $post->nama_mahasiswa }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-info">SHOW</a>
                                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center alert alert-danger">Data Mahasiswa belum Tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $posts->links() }} <!-- Pagination -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection
