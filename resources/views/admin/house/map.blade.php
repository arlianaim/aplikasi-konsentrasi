<x-main>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="ms-5 p-3">
                {{ 'Lokasi:  ' . $name }}
            </h2>
            <a href="{{ route('house.detail', ['id' => $id]) }}" class="btn btn-outline-secondary">Kembali</a>
        </div>

    </x-slot>
    <div class="row">
        <div id="map" style="height: 450px; width:500;" class=" mt-4"></div>
        @if (!is_null($data))
            <script>
                var latitude = {{ $data->latitude ?? 0 }};
                var longitude = {{ $data->longitude ?? 0 }};
                var mapElementId = 'map';
                if (document.getElementById(mapElementId)) {
                    var map = L.map(mapElementId).setView([latitude, longitude], 18);
                    map.zoomControl.remove();

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    var marker = L.marker([latitude, longitude]).addTo(map)
                        .bindPopup(
                            `<b>{{ $data->name }}</b><br />{{ $data->type }} <br> <a href="https://www.google.com/maps?q=${latitude},${longitude}" target="_blank">buka maps</a>`
                        )
                        .openPopup()
                        .on('click', function() {
                            window.open(`https://www.google.com/maps?q=${latitude},${longitude}`, '_blank');
                        });
                }
            </script>
        @endif
    </div>
</x-main>
