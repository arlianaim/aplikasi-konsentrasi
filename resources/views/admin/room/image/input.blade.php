<x-main>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="ms-5 p-3">
                {{ $mode . ' Gambar Kamar'  }} <span class="text-info">{{ $kamar }}</span>
            </h2>
            <a href="{{ route('room.image', ['room_id' => $room_id]) }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </x-slot>
    <div class="row">
        @php
            $set = isset($data);
        @endphp
        <div class="col-12 mb-3 row">
            <form action="{{ !$set ? route('room.image.store') : route('room.image.set', ['id' => $data->id]) }}" method="POST"
                class="row needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                @if ($set)
                    @method('put')
                @endif
                <x-forms.input name="room_id" value="{{ $room_id }}" :hidden="true" />
                <x-forms.input label="Nama Gambar" name="name" value="{{ $set ? $data->name : '' }}" />
                <div class="mb-3">
                    <x-forms.input label="Gambar" name="image" type="file" />
                    <img src="{{ $set ? Storage::url($data->url) : '' }}" id="preview" class="img-fluid"
                        alt="Preview Image" width="300" />
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</x-main>

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
