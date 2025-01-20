<?php

namespace App\Http\Controllers;

use App\Http\Resources\BoardingHouseResource;
use App\Models\Facility;
use App\Models\House;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class HouseController extends Controller
{
    public function index()
    {
        $datas = House::with(['rooms.facilities', 'facilities.facility'])->get();
        return view('admin.house.index', compact(['datas']));
    }

    public function detail($id)
    {
        $datas = House::with(['rooms.image', 'rooms.facilities', 'facilities.facility',])->where('id', $id)->first();
        $data_facility = Facility::where('category', 'Kamar')->get();
        return view('admin.house.detail', compact(['datas', 'data_facility']));
    }

    public function map($id)
    {
        $data = House::find($id);
        $name = $data->name;
        return view('admin.house.map', compact('data', 'name', 'id'));
    }



    public function image($house_id)
    {
        $data = House::where('id', $house_id)->with(['rooms.facilities', 'facilities.facility', 'image'])->first();
        $datas = $data->image;
        $name = $data->name;
        return view('admin.house.image', compact('datas', 'house_id', 'name'));
    }

    public function image_create($house_id)
    {
        $mode = 'Tambah';
        return view('admin.house.image.input', compact('house_id', 'mode'));
    }

    public function image_update($house_id, $id)
    {
        $mode = 'Edit';
        $data = Image::find($id);
        return view('admin.house.image.input', compact('data', 'house_id', 'mode'));
    }

    public function image_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $date = date('YmdHis');
        $name = $request->house_id . '_' . $date . '.' . $image->getClientOriginalExtension();
        $url = 'images/house/' . $name;

        Storage::disk('public')->putFileAs('images/house/', $image, $name);

        $house = House::find($request->house_id);
        $house->image()->create([
            'name' => $request->input('name'),
            'url' => $url,
        ]);

        return redirect()->route('house.image', $request->house_id);
    }

    public function image_set(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $image = $request->file('image');
        $date = date('YmdHis');
        $name = $request->house_id . '_' . $date . '.' . $image->getClientOriginalExtension();
        $url = 'images/house/' . $name;
        Storage::disk('public')->putFileAs('images/house/', $image, $name);

        $image = Image::find($id);
        Storage::disk('public')->delete($image->url);


        $image->update([
            'name' => $request->name,
            'url' => $url,
        ]);
        return redirect()->route('house.image', ['house_id' => $image->house_id]);
    }

    public function image_delete($id)
    {
        $image = Image::find($id);
        Storage::disk('public')->delete($image->url);
        $house_id = $image->house_id;
        $image->delete();
        return redirect()->route('house.image', ['house_id' => $house_id]);
    }

    public function create()
    {
        $mode = 'Tambah';
        $facilities = Facility::where('category', 'Umum')->select('id', 'facility_name')->get();
        $facilities = $facilities->pluck('facility_name', 'id')->toArray();
        return view('admin.house.input', compact('facilities', 'mode'));
    }

    public function update($id)
    {
        $mode = 'Edit';
        $data = House::where('id', $id)->with(['rooms.facilities', 'facilities.facility', 'image'])->first();
        // dd($data->image[0]->url);
        $facilities = Facility::where('category', 'Umum')->select('id', 'facility_name')->get();
        $facilities = $facilities->pluck('facility_name', 'id')->toArray();
        return view('admin.house.input', compact('facilities', 'mode', 'data'));
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|string',
                'facility' => 'required|array',
                'curfew' => 'nullable|string',
                'rules' => 'nullable|string',
                'address' => 'required|string|max:255',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $house = House::create([
                'name' => $request->name,
                'type' => $request->type,
                'curfew' => $request->curfew,
                'rules' => $request->rules,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'description' => $request->description,
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $date = date('YmdHis');
                $name = $house->id . '_' . $date . '.' . $image->getClientOriginalExtension();
                $url = 'images/house/' . $name;
                Storage::disk('public')->putFileAs('images/house/', $image, $name);
                $house->image()->create([
                    'name' => $request->input('name'),
                    'url' => $url,
                ]);
            }

            foreach ($request->facility as $facilityId) {
                $house->facilities()->create([
                    'facility_id' => $facilityId,
                ]);
            }

            return redirect()->route('house');
        } catch (ValidationException $e) {
            // dd($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }


    public function set(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|string',
                'facility' => 'required|array',
                'curfew' => 'nullable|string',
                'rules' => 'nullable|string',
                'address' => 'required|string|max:255',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'description' => 'nullable|string',
            ]);

            $house = House::findOrFail($id);
            $house->update([
                'name' => $request->name,
                'type' => $request->type,
                'curfew' => $request->curfew,
                'rules' => $request->rules,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'description' => $request->description,
            ]);

            $house->facilities()->delete();
            foreach ($request->facility as $facilityId) {
                $house->facilities()->create([
                    'facility_id' => $facilityId,
                ]);
            }

            return redirect()->route('house.detail', ['id' => $id]);
        } catch (ValidationException $e) {
            // dd($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
}
