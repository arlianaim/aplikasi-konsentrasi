<x-main>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="ms-5 p-3">
                {{ $mode . ' Kamar' }}
            </h2>
            <a href="{{ route('house.detail', ['id' => $house_id]) }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </x-slot>
    <div class="row">
        @php
            $set = isset($data);
            $opts = ['1' => 'Tersedia', '0' => 'Tidak Tersedia'];
            $chec = $data_facility;
            $checkeddFacilities = $set ? $data->facilities : [];
        @endphp
        <div class="col-12 mb-3 row">
            <form action="{{ !$set ? route('room.store') : route('room.set', ['id' => $data->id]) }}" method="POST"
                class="row needs-validation" novalidate>
                @csrf
                @if ($set)
                    @method('put')
                @endif
                <x-forms.input name="house_id" value="{{ $house_id }}" :hidden="true" />
                <x-forms.input label="Nomor Kamar/Nama Kamar" name="room_number"
                    value="{{ $set ? $data->room_number : '' }}" />
                <x-forms.input label="Ukuran" name="size" value="{{ $set ? $data->size : '' }}" />
                <x-forms.input label="Harga Sewa" name="price" value="{{ $set ? $data->price : '' }}" />
                <x-forms.select label="Status" name="availability" value="{{ $set ? $data->availability : '' }}"
                    :options="$opts" selected="{{ $set ? $data->availability : '' }}" />

                <x-forms.checkbox label="Fasilitas" name="facility" :options="$chec" :checked="$checkeddFacilities" />
                {{-- @dd($checkeddFacilities) --}}
                <x-forms.input label="Deskripsi" name="description" value="{{ $set ? $data->description : '' }}"
                    raw-value="{!! $set ? $data->description : '' !!}" />

                <button type="submit" class="btn btn-primary ">Save</button>
            </form>
        </div>
    </div>
</x-main>
