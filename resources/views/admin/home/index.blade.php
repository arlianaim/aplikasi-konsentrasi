<x-main>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ __('HOME') }}
        </h2>
    </x-slot>
    <div class="row action_button">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="col">
                <div class="card h-100 text-center action_button fg2_palettes shadow-lg border">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Kos Kosan</h5>
                        <p class="card-text h1">{{ $jumlah_kos }}</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 text-center action_button fg2_palettes shadow-lg border">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Kamar</h5>
                        <p class="card-text h1">{{ $jumlah_kamar }}</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 text-center action_button fg2_palettes shadow-lg border">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Fasilitas Umum</h5>
                        <p class="card-text h1">{{ $fasilitas_umum }}</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 text-center action_button fg2_palettes shadow-lg border">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Fasilitas Kamar</h5>
                        <p class="card-text h1">{{ $fasilitas_kamar }}</p>
                    </div>
                </div>
            </div>


        </div>
    </div>
</x-main>
