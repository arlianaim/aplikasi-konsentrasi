<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\House;
use App\Models\Room;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home() {
        $jumlah_kamar = Room::count();
        $jumlah_kos = House::count();
        $fasilitas_umum = Facility::where('category', 'Umum')->count();
        $fasilitas_kamar = Facility::where('category', 'Kamar')->count();

        return view('admin.home.index', compact(['jumlah_kamar', 'jumlah_kos', 'fasilitas_umum', 'fasilitas_kamar']));
    }
}
