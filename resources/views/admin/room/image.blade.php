<x-main>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="ms-5 p-3">
                {{ 'Gambar Kamar'  }} <span class="text-info">{{ $kamar }}</span>
            </h2>
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('room.image.create', ['room_id' => $room_id]) }}"
                    class="btn btn-outline-success me-3">{{ __('Tambah Gambar') }}</a>
                <a href="{{ route('house.detail', ['id' => $house_id]) }}" class="btn btn-outline-secondary">Kembali</a>
            </div>
        </div>
    </x-slot>
    <div class="row col-12">
        <table class="table table-bordered h_palettes text-center table_border mt-3">
            <thead class="">
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>URL</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($datas->count() == 0)
                    <tr class="text-center">
                        <th scope="col" colspan="4">Gambar Belum Ada</th>
                    </tr>
                @else
                    @foreach ($datas as $d)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td><img src="{{ Storage::url($d->url) }}" alt="" width="300"></td>
                            <td>{{ $d->url }}</td>
                            <td class="d-flex justify-content-evenly border-0">
                                <a href="{{ route('room.image.update', ['room_id' => $room_id, 'id' => $d->id]) }}"
                                    class="btn btn-outline-info">Update</a>

                                <form action="{{ route('room.image.delete', ['id' => $d->id]) }}" method="POST">
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
</x-main>
