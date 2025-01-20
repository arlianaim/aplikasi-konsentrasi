<x-main>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="ms-5 p-3">
                {{ $mode . ' Fasilitas' }}
            </h2>
            <a href="{{ route('facility') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </x-slot>
    <div class="row">
        @php
            $set = isset($data);
            $opts = ['Kamar'=>'Kamar', 'Umum' =>'Umum'];
        @endphp
        <div class="col-12 mb-3 row">
            <form action="{{ !$set ? route('facility.store') : route('facility.set', ['id' => $data->id]) }}"
                method="POST" class="row needs-validation" novalidate>
                @csrf
                @if ($set)
                    @method('put')
                @endif
                <x-forms.input label="Nama Fasilitas" name="facility_name"
                    value="{{ $set ? $data->facility_name : '' }}" />
            <x-forms.select label="Kategori" name="category"  :options="$opts" selected="{{($set)? $data->category : ''}}" />
                <button type="submit" class="btn btn-primary ">Save</button>
            </form>
        </div>
    </div>
</x-main>
