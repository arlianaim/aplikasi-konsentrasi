<x-main>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="ms-5 p-3"> {{ __('Kos kosan') }}</h2>
            <a href="{{ route('house.create') }}" class="btn btn-outline-success">Tambah Kos Kosan</a>
        </div>
    </x-slot>
    <div class="row col-12">

        <style>
            .action_house_palettes {
                background-color: var(--action-palettes-color);
                color: var(--bg-palettes-color);
            }

            .action_house_palettes:hover {
                background-color: var(--object-palettes-color);
                color: #FFFF;
            }
        </style>

        <div class="row col-12">
            @foreach ($datas as $d)
                @php

                    $image = $d->image[0]->url;
                    $image = App\Helpers\Fungsi::image($image);

                @endphp
                <div class="col-3 p-2">
                    <a class="card btn action_house_palettes align-middle h-100"
                        href="{{ route('house.detail', ['id' => $d->id]) }}">
                        {{-- <div class="card-img-overlay text-start"> --}}
                        <h5 class="card-title text-center">
                            {{ $d->name }}
                        </h5>
                        {{-- </div> --}}
                        <div class="card-body">
                            <p class="card-text">
                                <img src="{{ Storage::url($image) }}" class="card-img-bottom " alt="Image not load">
                                {{ $d->address }}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach


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
