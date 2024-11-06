<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF; // Pastikan untuk menambahkan import untuk PDF

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::paginate(10); // Ambil data mahasiswa dengan pagination
        return view('posts.index', compact('posts'));
    }

public function cetak()
{
    // Ambil semua data post
    $data['posts'] = Post::all();

    // Muat tampilan untuk PDF dan kirimkan data
    $pdf = PDF::loadView('posts.cetak', $data);
    
    // Unduh PDF dengan nama file tertentu
    return $pdf->download('data-mahasiswa.pdf');
}
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Validasi formulir
        $request->validate([
            'foto_mahasiswa' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nim' => 'required|min:5',
            'nama_mahasiswa' => 'required|min:5'
        ]);
        // Mengunggah gambar
        $image = $request->file('foto_mahasiswa');
        $image->storeAs('public/posts', $image->hashName());
        // Membuat posting baru
        Post::create([
            'foto_mahasiswa' => $image->hashName(),
            'nim' => $request->nim,
            'nama_mahasiswa' => $request->nama_mahasiswa
        ]);
        // Mengalihkan ke halaman index dengan pesan sukses
        return redirect()->route('posts.index')->with([
            'success' => 'Data Berhasil Disimpan!'
        ]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // Validasi formulir
        $request->validate([
            'foto_mahasiswa' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nim' => 'required|min:5',
            'nama_mahasiswa' => 'required|min:5'
        ]);
        // Memeriksa apakah gambar diunggah
        if ($request->hasFile('foto_mahasiswa')) {
            // Mengunggah gambar baru
            $image = $request->file('foto_mahasiswa');
            $image->storeAs('public/posts', $image->hashName());
            // Menghapus gambar lama
            Storage::delete('public/posts/' . $post->foto_mahasiswa);
            // Memperbarui posting dengan gambar baru
            $post->update([
                'foto_mahasiswa' => $image->hashName(),
                'nim' => $request->nim,
                'nama_mahasiswa' => $request->nama_mahasiswa
            ]);
        } else {
            // Memperbarui posting tanpa gambar
            $post->update([
                'nim' => $request->nim,
                'nama_mahasiswa' => $request->nama_mahasiswa
            ]);
        }
        // Mengalihkan ke halaman index dengan pesan sukses
        return redirect()->route('posts.index')->with([
            'success' => 'Data Berhasil Diubah!'
        ]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function destroy(Post $post)
    {
        // Menghapus gambar jika ada
        if ($post->foto_mahasiswa && Storage::exists('public/posts/' . $post->foto_mahasiswa)) {
            Storage::delete('public/posts/' . $post->foto_mahasiswa);
        }
        
        // Menghapus post
        $post->delete();
        
        // Mengalihkan ke halaman index dengan pesan sukses
        return redirect()->route('posts.index')->with([
            'success' => 'Data Berhasil Dihapus!'
        ]);
    }
}
