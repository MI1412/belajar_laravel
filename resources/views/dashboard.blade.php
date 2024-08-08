<!-- Tampilan lainnya di dashboard -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    {{-- alert sukses upload --}}

    @if (session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>

        <script>
            // JavaScript untuk menghilangkan pesan setelah 2 detik
            setTimeout(function() {
                var message = document.getElementById('success-message');
                if (message) {
                    message.style.opacity = '0';
                    // Tunggu beberapa detik untuk efek transisi
                    setTimeout(function() {
                        message.style.display = 'none';
                    }, 600); // 600 ms untuk menunggu efek transisi
                }
            }, 2000); // 2000 ms = 2 detik
        </script>
    @endif

    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        href="{{ route('add') }}">tambahkan produk</a>

    <!-- Tampilan lainnya di dashboard -->


    {{-- tugas front end : atur register baru menjadi halaman kosong dan menampilkan peringatan untuk menambahkan produk --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("terdaftar !") }}
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h1>Daftar Gambar</h1>
        <br><br>

        {{-- mengulangi tabel images --}}

        @foreach ($images as $image)
            <div class="card">
                <img src="{{ asset('storage/' . $image->path) }}" alt="Image">
                <div class="card-body">
                    <h2 class="card-title">{{ $image->title }}</h2>
                    <p class="card-description">{{ $image->description }}</p>
                    <a href="{{ route('images.edit', $image->id) }}">Edit</a> |
                    <form action="{{ route('images.destroy', $image->id) }}" method="POST" {{-- membuat alert hapus --}}
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>


    {{-- 
    @foreach (auth()->user()->images as $image)
        <div>
            <img src="{{ asset('storage/' . $image->path) }}" alt="Image" style="width: 100px;">
            <h3>{{ $image->title }}</h3>
            <p>{{ $image->description }}</p>
        </div>
    @endforeach --}}


</x-app-layout>
