<?php

namespace App\Http\Controllers;

use App\Models\News; // Pastikan ini mengarah ke App\Models\News
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Menampilkan semua berita
    public function index()
    {
        $news = News::all();
        return response()->json($news);
    }

    // Menampilkan berita berdasarkan ID
    public function show($id)
    {
        $news = News::find($id);
        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }
        return response()->json($news);
    }

    // Menambahkan berita baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:2048', // validasi file gambar max 2MB
        ]);

        // Simpan file gambar ke folder public storage
        $imagePath = $request->file('image')->store('news_images', 'public');

        // Buat URL gambar lengkap
        $imageUrl = asset('storage/' . $imagePath);

        $news = News::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageUrl,  // simpan URL gambar di DB
        ]);

        return response()->json($news, 201);
    }

    // Memperbarui berita berdasarkan ID
    public function update(Request $request, $id)
    {
        $news = News::find($id);
        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|string', // Update nama file image
        ]);

        $news->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image, // Update nama file image
        ]);

        return response()->json($news);
    }

    // Menghapus berita berdasarkan ID
    public function destroy($id)
    {
        $news = News::find($id);
        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        $news->delete();
        return response()->json(['message' => 'News deleted successfully']);
    }
}