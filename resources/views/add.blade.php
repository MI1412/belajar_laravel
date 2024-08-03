<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
    {{-- aktifkan jika memakai mix --}}
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
    <style>
        .preview {
            max-width: 300px;
            /* Atur ukuran preview sesuai kebutuhan */
            max-height: 300px;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Upload Image') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="image" id="image" required>
                            <input type="text" name="title" placeholder="Title" required>
                            <textarea name="description" placeholder="Description"></textarea>
                            <button type="submit">Upload</button>
                            <br><br>
                            <img id="preview" class="preview" src="" alt="Image Preview"
                                style="display:none;">
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
                preview.style.display = 'block'; // Menampilkan preview
            };

            // Cek apakah file ada
            if (this.files && this.files[0]) {
                reader.readAsDataURL(this.files[0]);
            } else {
                preview.style.display = 'none'; // Menyembunyikan preview jika tidak ada file
            }
        });
    </script>
    {{-- aktifkan jika memakai mix --}}
    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
</body>

</html>
