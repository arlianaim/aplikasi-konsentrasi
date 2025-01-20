<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        $datas = Facility::all();
        return view('admin.facility.index', compact(['datas']));
    }

    public function create()
    {
        $mode = 'Tambah';
        return view('admin.facility.input', compact(['mode']));
    }
    public function update($id)
    {
        $mode = 'Edit';
        $data = Facility::find($id);
        return view('admin.facility.input', compact(['mode', 'data']));
    }

    public function store(Request $request)
    {
        // dd($request);
        try {
            $save = $request->validate([
                'facility_name' => 'required',
                'category'=>'required',
            ]);
            // dd($save);
            Facility::create($save);
            // return redirect()->route('facility');
            return redirect()->route('facility')->with('success', 'Fasilitas berhasil ditambah');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    public function set(Request $request, $id)
    {
        $data = Facility::find($id);
        try {
            $save = $request->validate([
                'facility_name' => 'required',
                'category'=>'required',
            ]);
            // dd($save);
            $data->update($save);
            // return redirect()->route('facility');
            return redirect()->route('facility')->with('success', 'Fasilitas berhasil diupdate');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    public function delete($id)
    {
        $data = Facility::find($id);
        $data->delete();
        return redirect()->route('facility')->with('success', 'Fasilitas berhasil dihapus');
    }
}
