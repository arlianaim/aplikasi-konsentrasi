@php
    use App\Helpers\Fungsi;

    $d = $datas;
@endphp

<x-main>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="ms-5 p-3">
                {{ $d->name }}
            </h2>
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('house.update', ['id' => $d->id]) }}" class="btn btn-outline-info me-3">Update</a>
                <a href="{{ route('house') }}" class="btn btn-outline-secondary">Kembali</a>
            </div>
        </div>
    </x-slot>
    <div class="row">
        <div class="row col-12 card fg_palettes text-white">
            <div class="card-body">
                {{-- <h5 class="card-title mb-3">{{ $d->name }}
                    <a href="{{ route('house.update', ['id' => $d->id]) }}" class="btn btn-outline-info">Edit</a>
                </h5> --}}
                <div class="my-2">
                    @if (count($d->image) > 0)
                        @foreach ($d->image as $img)
                            <img src="{{ Storage::url($img->url) }}" class="p-2" alt="Image not load" width="300">
                        @endforeach
                    @else
                        <img src="{{ Storage::url('public/images/404.png') }}" class="p-2" alt="Image not load"
                            width="300">
                    @endif
                </div>
                <a href="{{ route('house.image', ['house_id' => $d->id]) }}" class="btn btn-info my-3">Edit Image</a>
                <div class="card-text">
                    <!-- Row for address -->
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ Fungsi::icon('marker') }}" alt="Icon" class="me-3" width="24">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="me-3">
                                {{ $d->address }}
                            </span>
                            <a href="{{ route('house.map', ['id' => $d->id]) }}" class="btn btn-outline-info">maps</a>
                        </div>
                    </div>
                    <!-- Row for facility -->
                    <div class="d-flex align-items-center">
                        <img src="{{ Fungsi::icon('sofa') }}" alt="Icon" class="me-3" width="24">
                        <span>Fasilitas Umum</span>
                    </div>
                    <ol class="mb-3 ">
                        @foreach ($d->facilities as $f)
                            <li>{{ $f->facility->facility_name }}</li>
                        @endforeach
                    </ol>

                    <!-- Row for room -->
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ Fungsi::icon('room') }}" alt="Icon" class="me-3" width="24">
                        <span>
                            Kamar
                        </span>
                    </div>
                    <div class="mb-3 col-12 row">
                        <a href="{{ route('room.create', ['house_id' => $d->id]) }}"
                            class="btn btn-outline-success mb-3">Tambah</a>
                        @foreach ($d->rooms as $r)
                            <div class="card mb-3 col-9"
                                style="color: var(--object-palettes-color); background-color: var(--fg-palettes-color); border-color: var(--action-palettes-color);">
                                <div class="row g-0 p-2">
                                    <div class="col-md-4">
                                        <!-- Gambar Utama -->
                                        <div class="main-image text-center mb-3">
                                            <img id="mainImage{{ $r->id }}"
                                                src="{{ $r->image->count() > 0 ? Storage::url($r->image[0]->url) : Storage::url('public/images/404.png') }}"
                                                class="img-fluid rounded main-image" data-room-id="{{ $r->id }}"
                                                alt="Gambar Utama">
                                        </div>

                                        <!-- Thumbnail Gambar -->
                                        <div class="thumbnail-images d-flex justify-content-center gap-2"
                                            data-room-id="{{ $r->id }}">
                                            @foreach ($r->image as $img)
                                                <img src="{{ Storage::url($img->url) }}"
                                                    class="img-thumbnail thumbnail"
                                                    style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;"
                                                    alt="Thumbnail">
                                            @endforeach
                                        </div>

                                        <script>
                                            // Event delegation untuk semua thumbnail
                                            document.addEventListener('click', function(event) {
                                                // Pastikan elemen yang ditekan adalah thumbnail
                                                if (event.target.classList.contains('thumbnail')) {
                                                    // Ambil room ID dari parent element
                                                    const roomId = event.target.closest('.thumbnail-images').getAttribute('data-room-id');

                                                    // Cari elemen gambar utama berdasarkan room ID
                                                    const mainImage = document.querySelector(`#mainImage${roomId}`);

                                                    // Ganti src gambar utama
                                                    if (mainImage) {
                                                        mainImage.src = event.target.src;
                                                    }
                                                }
                                            });
                                        </script>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title text-white">{{ $r->room_number }}</h5>
                                            <p class="card-text">Ukuran : {{ $r->size }}</p>
                                            <p class="card-text">Harga : {{ Fungsi::rupiah($r->price) }}/ bulan</p>
                                            <p class="card-text">
                                                Fasilitas :
                                            <ol>
                                                @foreach ($r->facilities as $f)
                                                    <li>{{ $f->facility->facility_name }}</li>
                                                @endforeach
                                            </ol>

                                            </p>
                                            <p class="card-text">
                                                Deskripsi : <br>
                                                {{ $r->description }}
                                            </p>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    Terakhir diperbarui {{ $r->updated_at }}
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 p-2 d-flex flex-column align-items-center">
                                <a href="{{ route('room.image', ['room_id' => $r->id]) }}"
                                    class="btn btn-outline-success mb-3">
                                    Edit Gambar
                                </a>
                                <div class="d-flex justify-content-evenly w-100">
                                    <a href="{{ route('room.update', ['house_id' => $d->id, 'id' => $r->id]) }}"
                                        class="btn btn-outline-info me-2">
                                        Update
                                    </a>
                                    <form action="{{ route('room.delete', ['id' => $d->id]) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Row for description -->
                    <div class="d-flex align-items-start mb-3">
                        <img src="{{ Fungsi::icon('rules') }}" alt="Icon" class="me-3" width="24">
                        <span>
                            Peraturan :
                            {{ $d->rules ? '<br>' . $d->rules : 'Tidak diatur' }}
                        </span>
                    </div>

                    <!-- Row for description -->
                    <div class="d-flex align-items-start mb-3">
                        <img src="{{ Fungsi::icon('info') }}" alt="Icon" class="me-3" width="24">
                        <span> Keterangan :
                            {{ $d->description ? '<br>' . $d->description : 'Tidak diatur' }}</span>
                    </div>
                </div>
            </div>
        </div>
</x-main>
