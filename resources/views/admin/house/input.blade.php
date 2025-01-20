<x-main>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="ms-5 p-3">
                {{ $mode . ' Kos Kosan' }}
            </h2>
            <a href="{{ isset($data)? route('house.detail', ['id' => $data->id]) : route('house') }}" class="btn btn-secondary">
                Kembali
            </a>

        </div>
    </x-slot>
    <div class="row">
        @php
            $set = isset($data);
            $jenisKosan = ['Khusus Putra' => 'Khusus Putra', 'Khusus Putri' => 'Khusus Putri', 'Bebas' => 'Bebas'];
            $chec = $facilities;
            $checkeddFacilities = $set ? $data->facilities : [];
        @endphp
        <div class="col-12 mb-3 row">
            <form action="{{ !$set ? route('house.store') : route('house.set', ['id' => $data->id]) }}" method="POST"
                class="row needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                @if ($set)
                    @method('put')
                @endif
                <x-forms.input label="Nama Kosan *" name="name" value="{{ old('name', $set ? $data->name : '') }}" />
                <x-forms.select label="Jenis Kosan *" name="type" :options="$jenisKosan"
                    selected="{{ old('type', $set ? $data->type : '') }}" />
                <x-forms.checkbox label="Fasilitas *" name="facility" :options="$chec" :checked="$checkeddFacilities" />
                <x-forms.input label="Jam Malam" type="time" name="curfew"
                    value="{{ old('curfew', $set ? $data->curfew : '') }}" />
                <x-forms.input label="Peraturan" type="text" name="rules"
                    value="{{ old('rules', $set ? $data->rules : '') }}" />
                <x-forms.input label="Alamat *" type="text" name="address"
                    value="{{ old('address', $set ? $data->address : '') }}" />
                <label for="map" class="form-label h_palettes col-12">
                    Lokasi di Map*
                    {{-- @if ($set) --}}
                        <button type="button" class="btn btn-outline-secondary btn-sm ms-2"
                            onclick="resetMap()">Reset</button>
                    {{-- @endif --}}
                </label>
                <div id="map" style="height: 200px; width:300px;" class="ms-3 mb-3"></div>
                <x-forms.input label="Latitude" type="text" name="latitude"
                    value="{{ old('latitude', $set ? $data->latitude : '') }}" readonly />
                <x-forms.input label="Longitude" type="text" name="longitude"
                    value="{{ old('longitude', $set ? $data->longitude : '') }}" readonly />
                <x-forms.input label="Deskripsi" name="description"
                    value="{{ old('description', $set ? $data->description : '') }}" />
                <div class="mb-3">
                    @if ($set)
                        <x-forms.input label="Gambar Kosan" name="image" help="Gambar Kosan Tidak Bisa Diubah di Sini"
                            type="file" value="{{ $data->image[0]->url }}" disabled />
                    @else
                        <x-forms.input label="Gambar Kosan" name="image" type="file" />
                    @endif
                    <img src="{{ $set ? Storage::url($data->image[0]->url) : '' }}" id="preview" class="img-fluid"
                        alt="Preview Image" width="300" />
                </div>
                <script>
                    const input = document.querySelector('input[name="image"]');
                    const preview = document.getElementById('preview');

                    input.addEventListener('change', () => {
                        const file = input.files[0];
                        const reader = new FileReader();

                        reader.addEventListener('load', () => {
                            preview.src = reader.result;
                        });

                        reader.readAsDataURL(file);
                    });
                </script>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    <script>
        var mapElementId = 'map';
        var latitude = -5.147665; // Default latitude untuk Kota Makassar
        var longitude = 119.432731; // Default longitude untuk Kota Makassar

        @if ($set)
            latitude = {{ $data->latitude }};
            longitude = {{ $data->longitude }};
        @endif

        var map, existingMarker, temporaryMarker;

        try {
            if (document.getElementById(mapElementId)) {
                map = L.map(mapElementId).setView([latitude, longitude], 13);
                map.zoomControl.remove();

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // Tambahkan marker utama jika $set
                @if ($set)
                    existingMarker = L.marker([latitude, longitude]).addTo(map)
                        .bindPopup(
                            `<b>{{ $data->name }}</b><br />{{ $data->type }} <br> <a href="https://www.google.com/maps?q=${latitude},${longitude}" target="_blank">buka maps</a>`
                        )
                        .openPopup()
                        .on('click', function() {
                            window.open(`https://www.google.com/maps?q=${latitude},${longitude}`, '_blank');
                        });
                @endif

                // Event listener untuk klik pada peta
                map.on('click', function(e) {
                    var clickedLat = e.latlng.lat; // Latitude dari klik
                    var clickedLng = e.latlng.lng; // Longitude dari klik

                    // Isi nilai ke dalam input dengan ID latitude dan longitude
                    document.getElementById('latitude').value = clickedLat;
                    document.getElementById('longitude').value = clickedLng;

                    // Tambahkan marker baru di titik yang diklik
                    if (temporaryMarker) {
                        map.removeLayer(temporaryMarker); // Hapus marker sementara sebelumnya
                    }
                    if (existingMarker) {
                        map.removeLayer(existingMarker); // Hapus marker utama jika $set tersedia
                    }
                    temporaryMarker = L.marker([clickedLat, clickedLng]).addTo(map);
                });
            }
        } catch (error) {
            console.error("Error initializing map: ", error);
            alert("Gagal memuat peta, silakan coba lagi.");
        }

        // Fungsi untuk reset marker ke $data latitude dan longitude
        function resetMap() {
            try {
                if (existingMarker) {
                    map.removeLayer(existingMarker); // Hapus marker utama sebelumnya
                }
                if (temporaryMarker) {
                    map.removeLayer(temporaryMarker); // Hapus marker sementara
                }
                @if ($set)
                    // Atur ulang marker ke posisi awal ($data latitude dan longitude)
                    existingMarker = L.marker([latitude, longitude]).addTo(map)
                        .bindPopup(
                            `<b>{{ $data->name }}</b><br />{{ $data->type }} <br> <a href="https://www.google.com/maps?q=${latitude},${longitude}" target="_blank">buka maps</a>`
                        )
                        .openPopup();

                    // Perbarui input latitude dan longitude dengan nilai awal
                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;
                @else
                    map.setView([latitude, longitude], 13);
                    document.getElementById('latitude').value = '';
                    document.getElementById('longitude').value = '';
                @endif
            } catch (error) {
                console.error("Error resetting map: ", error);
                alert("Gagal mereset peta, silakan coba lagi.");
            }
        }
    </script>


</x-main>
