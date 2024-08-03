<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Image</title>

    {{-- jika memakai mix aktifkan code ini --}}
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
    <style>
        .preview {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Image') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $image->id }}">
                        <ul>
                            <li>
                                <label for="title">Title:</label>
                                <input type="text" name="title" id="title" required value="{{ old('title', $image->title) }}">
                            </li>
                            <li>
                                <label for="description">Description:</label>
                                <textarea name="description" id="description">{{ old('description', $image->description) }}</textarea>
                            </li>
                            <li>
                                <label for="image">Image:</label>
                                <input type="file" name="image" id="image">
                                <img id="preview" class="preview" src="{{ asset('storage/' . $image->path) }}" alt="Current Image">
                            </li>
                            <li>
                                <button type="submit">Update</button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    document.getElementById('image').addEventListener('change', function(event) {
        var reader = new FileReader();
        var preview = document.getElementById('preview');

        reader.onload = function(e) {
            preview.src = e.target.result;
        };

        // Cek apakah file ada
        if (this.files && this.files[0]) {
            reader.readAsDataURL(this.files[0]);
        } else {
            // Jika tidak ada file, gunakan gambar default
            preview.src = "{{ asset('storage/' . $image->path) }}";
        }
    });
</script>

{{-- jika memakai mix aktifkan ini --}}
{{-- <script src="{{ mix('js/app.js') }}"></script> --}}
</body>
</html>
