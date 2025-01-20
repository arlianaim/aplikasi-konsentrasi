<x-main>
    <x-slot name="header">

        <div class="d-flex justify-content-between align-items-center">
            <h2 class="ms-5 p-3">
                {{ 'Fasilitas' }}
            </h2>
            <a href="{{ route('facility.create') }}" class="btn btn-outline-success">Tambah Fasilitas</a>
        </div>
    </x-slot>
    <div class="row">
        <div class="col-12 mt-3">
            <div class="action_button h5">Fasilitas Kamar</div>
            <div class="row row-cols-1 row-cols-md-4 g-4">

                @if (empty($datas))
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <p class="card-text">Tidak ada data</p>
                            </div>
                        </div>
                    </div>
                @else
                    @foreach ($datas as $d)
                        @if ($d->category == 'Kamar')
                            <div class="col">
                                <div class="card h-100 text-center action_button fg2_palettes shadow-lg border">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <h5 class="card-title">{{ $d->facility_name }}</h5>
                                            <p class="card-text">
                                            <div class="me-auto">Kategori : {{ $d->category }}</div>
                                            </p>
                                        </div>
                                        <div>
                                            <a href="{{ route('facility.update', ['id' => $d->id]) }}"
                                                class="btn btn-info">Update</a>
                                            <form action="{{ route('facility.delete', ['id' => $d->id]) }}"
                                                method="POST" class="ms-auto d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>

            <div class="action_button h5 mt-3">Fasilitas Umum</div>
            <div class="row row-cols-1 row-cols-md-4 g-4">

                @if (empty($datas))
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <p class="card-text">Tidak ada data</p>
                            </div>
                        </div>
                    </div>
                @else
                    @foreach ($datas as $d)
                        @if ($d->category == 'Umum')
                            <div class="col">
                                <div class="card h-100 text-center action_button fg2_palettes shadow-lg border">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <h5 class="card-title">{{ $d->facility_name }}</h5>
                                            <p class="card-text">
                                            <div class="me-auto">Kategori : {{ $d->category }}</div>
                                            </p>
                                        </div>
                                        <div>
                                            <a href="{{ route('facility.update', ['id' => $d->id]) }}"
                                                class="btn btn-info">Update</a>
                                            <form action="{{ route('facility.delete', ['id' => $d->id]) }}"
                                                method="POST" class="ms-auto d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>


        </div>
    </div>

    <script>
        function toggleVisibility(elementId) {
            var element = document.getElementById(elementId);
            if (element.style.display === 'none') {
                element.style.display = 'block';
            } else {
                element.style.display = 'none';
            }
        }
    </script>
</x-main>
