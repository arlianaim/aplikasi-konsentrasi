<?php

namespace App\Http\Controllers;

use App\Http\Resources\BoardingHouseResource;
use App\Models\Facility;
use App\Models\House;
use Illuminate\Http\Request;

class APIController extends Controller
{

    public function checkConnection()
    {
        return response()->json(['message' => 'API Connected'], 200);
    }

    public function getAllBoardingHouse()
    {
        $boardingHouse = House::with(['rooms.facilities.facility', 'rooms.image', 'rooms.image', 'facilities.facility', 'image'])->get();
        // $boardingHouse->each(function ($house) {
        //     $house->image_url = asset('storage/images/house/' . $house->id . '.jpg');
        // });
        return BoardingHouseResource::collection($boardingHouse);
    }

    public function getBoardingHouseByType($type)
    {
        $boardingHouse = House::with(['rooms.facilities.facility', 'rooms.image', 'facilities.facility', 'image'])->where('type', $type)->get();
        return BoardingHouseResource::collection($boardingHouse);
    }

    public function getBoardingHouseBySearch($search)
    {
        $boardingHouse = House::with(['rooms.facilities.facility', 'rooms.image', 'facilities.facility', 'image'])->where('name', 'LIKE', "%$search%")->get();
        return BoardingHouseResource::collection($boardingHouse);
    }

    public function getBoardingHouse($id)
    {
        $boardingHouse = House::with(['rooms.facilities.facility', 'rooms.image', 'facilities.facility', 'image'])->find($id);
        return new BoardingHouseResource($boardingHouse);
    }

    public function getAllFacility()
    {
        $facility = Facility::all();
        return $facility;
    }

    public function getBoardingHouseByFacility($id)
    {
        $boardingHouse = House::with(['rooms.facilities.facility', 'rooms.image', 'facilities.facility'])->whereHas('facilities', function ($query) use ($id) {
            $query->where('facility_id', $id);
        })->get();
        return BoardingHouseResource::collection($boardingHouse);
    }
}
