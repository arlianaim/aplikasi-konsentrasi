<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityHouse extends Model
{
    use HasFactory;
    protected $table = "facility_house";
    protected $guarded = [];

    public function boardingHouse()
    {
        return $this->belongsTo(House::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
