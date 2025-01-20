<x-main>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ __('Kos kosan') }}
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-4 mb-3">
        </div>

        <div class="col-12">
            <table class="table-responsive table table-bordered border-dark ">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col" style="width: 5%;">#</th>
                        <th scope="col" style="width: 15%;">Nama Kos Kosan</th>
                        <th scope="col" style="width: 10%;">Type</th>
                        <th scope="col" style="width: 10%;">Peraturan</th>
                        <th scope="col" style="width: 10%;">Kamar</th>
                        <th scope="col" style="width: 15%;">Fasilitas</th>
                        <th scope="col" style="width: 20%;">Lokasi</th>
                        <th scope="col" style="width: 10%;">Deskripsi</th>
                        <th scope="col" style="width: 5%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($datas))
                        <tr class="text-center">
                            <th scope="col" colspan="6">Tidak ada data</th>
                        </tr>
                    @else
                        @foreach ($datas as $d)
                            <tr class="text-center">
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td class="text-start">{{ $d->name }}</td>
                                <td>{{ $d->type }}</td>

                                <!-- Peraturan Column with Toggle -->
                                <td>
                                    <button class="btn btn-outline-secondary btn-sm"
                                        onclick="toggleVisibility('rules{{ $d->id }}')">Tampilkan
                                        Peraturan</button>
                                    <div id="rules{{ $d->id }}" style="display: none;" class="text-sm-left">
                                        {{ $d->rules }}
                                    </div>
                                </td>

                                <td>
                                    @if (empty($d->rooms))
                                        Tidak ada data tentang kamar
                                    @else
                                        <a class="btn btn-outline-info" href="{{ route('house.rooms', ['id' => $d->id]) }}">Lihat kamar</a>
                                    @endif
                                </td>

                                <td>
                                    @if (empty($d->facilities))
                                        Tidak ada fasilitas tersedia
                                    @else
                                        <div class="list-group">
                                            @foreach ($d->facilities as $f)
                                                <div class="list-group-item list-group-item-action">
                                                    {{ $f->facility->facility_name }}
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('house.map', ['id' => $d->id]) }}"
                                        class="btn btn-outline-info">Lihat peta</a>
                                    {{-- <div id="map{{ $d->id }}" style="height: 250px;"></div>
                                    <script>
                                        var latitude = {{ $d->latitude ?? 0 }};
                                        var longitude = {{ $d->longitude ?? 0 }};
                                        var mapElementId = 'map{{ $d->id }}';
                                        if (document.getElementById(mapElementId)) {
                                            var map = L.map(mapElementId).setView([latitude, longitude], 13);
                                            map.zoomControl.remove();

                                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                            }).addTo(map);

                                            var marker = L.marker([latitude, longitude]).addTo(map)
                                                .bindPopup('<b>{{ $d->name }}</b><br />{{ $d->type }}')
                                                .openPopup()
                                                .on('click', function() {
                                                    window.open(`https://www.google.com/maps?q=${latitude},${longitude}`, '_blank');
                                                });
                                        }
                                    </script> --}}
                                </td>

                                <!-- Deskripsi Column with Toggle -->
                                <td>
                                    <button class="btn btn-outline-secondary btn-sm"
                                        onclick="toggleVisibility('description{{ $d->id }}')">Tampilkan
                                        Deskripsi</button>
                                    <div id="description{{ $d->id }}" style="display: none;">
                                        {{ $d->description }}
                                    </div>
                                </td>

                                <td class="d-flex justify-content-evenly">
                                    <!-- Action buttons if needed -->
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
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
