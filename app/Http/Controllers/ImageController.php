<?php

namespace App\Http\Controllers;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{

    // Menghapus gambar dari database dan penyimpanan
    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        // Hapus file dari penyimpanan
        if (Storage::exists('public/' . $image->path)) {
            Storage::delete('public/' . $image->path);
        }

        // Hapus data dari database
        $image->delete();

        return redirect()->route('dashboard')->with('success', 'Image deleted successfully');
    }

    // Menampilkan form edit gambar
    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('update', compact('image'));
    }

    // Mengupdate data gambar
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = Image::findOrFail($id);

        // Update data tanpa mengganti gambar
        $image->title = $request->input('title');
        $image->description = $request->input('description');

        // Jika ada file gambar baru, simpan gambar tersebut
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $image->path = $path;
        }

        $image->save();

        return redirect()->route('dashboard')->with('success', 'Image updated successfully');
    }

    // fungsi membaca index database
    public function index()
    {
        $images = Image::all();
        return view('dashboard', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $path = $request->file('image')->store('images', 'public');

        Image::create([
            'user_id' => auth()->id(),
            'path' => $path,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Image uploaded successfully');
    }
}
