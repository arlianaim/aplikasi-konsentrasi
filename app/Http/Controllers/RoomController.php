<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FacilityRoom;
use App\Models\House;
use App\Models\ImageRoom;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class RoomController extends Controller
{
    public function index($id)
    {
        $house = House::find($id)->name;
        $house_id = $id;
        $datas = Room::with('facilities.facility')->where('house_id', $id)->get();
        $data_facility = Facility::where('category', 'Kamar')->get();
        // dd($datas);
        return view('admin.room.index', compact(['datas', 'house', 'house_id', 'data_facility']));
    }
    public function create($house_id)
    {
        $mode = 'Tambah';
        $data_facility = Facility::where('category', 'Kamar')
            ->select('id', 'facility_name')
            ->get();

        $data_facility = $data_facility->pluck('facility_name', 'id')->toArray();

        return view('admin.room.input', compact(['mode', 'house_id', 'data_facility']));
    }
    public function update($house_id, $id)
    {
        $mode = 'Edit';
        $data = Room::with('facilities.facility')->where('id', $id)->where('house_id', $house_id)->first();

        $data_facility = Facility::where('category', 'Kamar')
            ->select('id', 'facility_name')
            ->get();
        // dd($data);
        $data_facility = $data_facility->pluck('facility_name', 'id')->toArray();

        return view('admin.room.input', compact(['mode', 'data', 'house_id', 'data_facility']));
    }

    public function store(Request $request)
    {
        try {
            $save = $request->validate([
                'house_id' => 'required',
                'room_number' => 'required',
                'size' => 'required',
                'price' => 'required',
                'availability' => 'required',
                'description' => '',
                'facility' => 'array',
            ]);

            // dd($save);

            $room = Room::create(Arr::except($save, ['facility']));

            if (!empty($save['facility'])) {
                foreach ($save['facility'] as $facility) {
                    FacilityRoom::create([
                        'room_id' => $room->id,
                        'facility_id' => $facility,
                    ]);
                }
            }

            return redirect()->route('house.detail', ['id' => $save['house_id']])->with('success', 'Fasilitas berhasil ditambah');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    public function set(Request $request, $id)
    {
        try {
            // Validasi data input
            $validated = $request->validate([
                'house_id' => 'required',
                'room_number' => 'required',
                'size' => 'required',
                'price' => 'required',
                'availability' => 'required',
                'description' => '',
                'facility' => 'array',
            ]);

            // Cari data Room berdasarkan ID
            $room = Room::findOrFail($id);

            // Update data Room (kecuali 'facility')
            $room->update(Arr::except($validated, ['facility']));
            $room->update(['updated_at' => now()]);
            // Hapus semua fasilitas terkait room ini
            FacilityRoom::where('room_id', $room->id)->delete();

            // Jika ada fasilitas baru, tambahkan kembali
            if (!empty($validated['facility'])) {
                foreach ($validated['facility'] as $facility) {
                    FacilityRoom::create([
                        'room_id' => $room->id,
                        'facility_id' => $facility,
                    ]);
                }
            }

            return redirect()
                ->route('house.detail', ['id' => $validated['house_id']])
                ->with('success', 'Data ruangan berhasil diperbarui.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        try {
            // Cari data Room berdasarkan ID
            $room = Room::findOrFail($id);

            // Hapus semua fasilitas terkait room ini
            FacilityRoom::where('room_id', $room->id)->delete();

            // Hapus data Room
            $room->delete();

            return redirect()
                ->route('house.rooms', ['id' => $room->house_id])
                ->with('success', 'Data ruangan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function facility(Request $request, $house_id, $id)
    {
        FacilityRoom::where('room_id', $id)->delete();
        Room::findOrFail($id)->update(['updated_at' => now()]);
        $fac = $request->input('facility');
        if (!is_null($fac)) {
            foreach ($fac as $f) {
                $new = new FacilityRoom();
                $new->room_id = $id;
                $new->facility_id = $f;
                $new->save();
            }
        }

        return redirect()->route('house.detail', ['id' => $house_id])->with('success', 'Fasilitas berhasil diupdate');
    }

    public function image($room_id)
    {
        $data = Room::where('id', $room_id)->with(['facilities.facility', 'image'])->first();
        $house_id = $data->house_id;
        $kamar = $data->room_number;
        $datas = $data->image;
        return view('admin.room.image', compact('datas', 'room_id', 'house_id', 'kamar'));
    }

    public function image_create($room_id)
    {
        $mode = 'Tambah';
        $data = Room::find($room_id);
        $kamar = $data->room_number;
        return view('admin.room.image.input', compact('room_id', 'mode', 'kamar'));
    }


    public function image_update($room_id, $id)
    {
        $mode = 'Edit';
        $data = ImageRoom::find($id);
        $room = Room::find($room_id);
        $kamar = $room->room_number;
        return view('admin.room.image.input', compact('data', 'room_id', 'mode', 'kamar'));
    }

    public function image_store(Request $request,)
    {
        // dd($request->room);
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'room_id' => 'required',
        ]);

        $image = $request->file('image');
        $date = date('YmdHis');
        $name = $request->room_id . '_' . $date . '.' . $image->getClientOriginalExtension();
        $url = 'images/room/' . $name;

        Storage::disk('public')->putFileAs('images/room/', $image, $name);

        $room = Room::find($request->room_id);
        $room->image()->create([
            'name' => $request->input('name'),
            'url' => $url,
        ]);

        return redirect()->route('room.image', ['room_id' => $room->id]);
    }

    public function image_set(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $image = $request->file('image');
        $date = date('YmdHis');
        $name = $request->room_id . '_' . $date . '.' . $image->getClientOriginalExtension();
        $url = 'images/room/' . $name;
        Storage::disk('public')->putFileAs('images/room/', $image, $name);

        $image = ImageRoom::find($id);
        Storage::disk('public')->delete($image->url);


        $image->update([
            'name' => $request->name,
            'url' => $url,
        ]);
        return redirect()->route('room.image', ['room_id' => $image->room_id]);
    }

    public function image_delete($id)
    {
        $image = ImageRoom::find($id);
        $room_id = $image->room_id;
        Storage::disk('public')->delete($image->url);
        $image->delete();
        return redirect()->route('room.image', ['room_id' => $room_id]);
    }
}
