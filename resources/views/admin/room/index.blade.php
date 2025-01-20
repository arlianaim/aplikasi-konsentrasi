<x-main>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ __('Semua Kamar ') }} <span class="text-info">{{ $house }}</span>
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-4 mb-3">
            <a href="{{ route('room.create', ['house_id' => $house_id]) }}" class="btn btn-outline-success">Tambah
                Kamar</a>
            <a class="btn btn-outline-info" href="{{ route('house') }}">Kembali</a>
        </div>
        <div class="col-12">
            <table class="table-responsive table table-bordered border-dark">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col" style="width: 5%;">#</th>
                        <th scope="col">No Kamar / Nama Kamar</th>
                        <th scope="col">Ukuran</th>
                        <th scope="col">Harga Sewa</th>
                        <th scope="col">Status</th>
                        <th scope="col">Fasilitas</th>
                        <th scope="col" style="width: 20%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($datas))
                        <tr class="text-center">
                            <th scope="col" colspan="3">Tidak ada data</th>
                        </tr>
                    @else
                        @foreach ($datas as $d)
                            <tr class="text-center">
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $d->room_number }}</td>
                                <td>{{ $d->size }}</td>
                                <td>{{ App\Helpers\Fungsi::rupiah($d->price) }}</td>
                                <td>{{ $d->availability == 1 ? 'Tersedia' : 'Tidak Tersedia' }}</td>
                                {{-- Fasilitas --}}
                                <td>
                                    <div class="list-group">
                                        @foreach ($d->facilities as $f)
                                            <div
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $f->facility->facility_name }}
                                            </div>
                                        @endforeach
                                        <button class="list-group-item list-group-item-action list-group-item-success"
                                            href="" data-bs-toggle="modal"
                                            data-bs-target="#mFacility{{ $d->id }}">
                                            Edit
                                        </button>
                                        <div class="modal fade" id="mFacility{{ $d->id }}" tabindex="-1"
                                            aria-labelledby="mFacility{{ $d->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form
                                                    action="{{ route('room.facility', ['id' => $d->id, 'house_id' => $house_id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('post')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="mFacility{{ $d->id }}Label">
                                                                Fasilitas Kamar <span
                                                                    class="text-primary">{{ $d->room_number }}</span>
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            <div class="list-group">
                                                                @foreach ($data_facility as $fac)
                                                                    <label class="list-group-item">
                                                                        @php
                                                                            $isChecked = false;
                                                                        @endphp

                                                                        @foreach ($d->facilities as $f)
                                                                            @if ($fac->id == $f->facility_id)
                                                                                <input name="facility[]"
                                                                                    class="form-check-input me-1"
                                                                                    type="checkbox"
                                                                                    value="{{ $fac->id }}"
                                                                                    checked>
                                                                                @php
                                                                                    $isChecked = true;
                                                                                @endphp
                                                                            @break
                                                                        @endif
                                                                    @endforeach

                                                                    @if (!$isChecked)
                                                                        <input name="facility[]"
                                                                            class="form-check-input me-1"
                                                                            type="checkbox"
                                                                            value="{{ $fac->id }}">
                                                                    @endif
                                                                    {{ $fac->facility_name }}
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Simpan
                                                            Fasilitas</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
    </div>
    </td>
    <td class="d-flex justify-content-evenly">
        <a href="{{ route('room.update', ['house_id' => $house_id, 'id' => $d->id]) }}"
            class="btn btn-outline-info">Update</a>
        <form action="{{ route('room.delete', ['id' => $d->id]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
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
