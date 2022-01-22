<?php

namespace App\Http\Controllers;

use App\Http\Resources\seatClassResource;
use App\Models\SeatClass;
use Illuminate\Http\Request;

class SeatClassController extends Controller
{
    public function index(){
        return response()->json([
            'data' => [
                'seatclasses' => seatClassResource::collection(SeatClass::all())
            ]
        ])->setStatusCode(200);
    }
}
