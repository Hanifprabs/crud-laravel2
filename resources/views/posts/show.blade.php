@extends('dashboard')
@section('content')

<body style="background: lightgray">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow rounded">
                    <div class="card-header">
                        <h4>Detail Mahasiswa</h4>
                    </div>
                    <div class="card-body text-center">
                        <!-- Display student photo -->
                        <img src="{{ asset('storage/public/posts/' . $post->foto_mahasiswa) }}" 
                             class="rounded-circle mb-3" 
                             style="width: 150px; height: 150px">

                        <!-- Display student details -->
                        <h5>NIM: {{ $post->nim }}</h5>
                        <h5>Nama: {{ $post->nama_mahasiswa }}</h5>
                        
                        <!-- Back button to go to list -->
                        <a href="{{ route('posts.index') }}" class="btn btn-primary mt-3">Kembali ke Daftar Mahasiswa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection

