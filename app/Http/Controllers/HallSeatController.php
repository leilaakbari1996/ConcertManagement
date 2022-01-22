<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallSeatRequest;
use App\Http\Resources\HallResource;
use App\Http\Resources\HallSeatResource;
use App\Http\Resources\seatClassResource;
use App\Models\Hall;
use Illuminate\Http\Request;

class HallSeatController extends Controller
{

    public function index(Hall $hall){
        return response()->json([
            'data' => [
                'seats_hall' => new HallSeatResource($hall)
            ]
        ])->setStatusCode(200);
    }
    public function store(Hall $hall,HallSeatRequest $request){
        $total = collect($request->get('seats'))->sum('count');
        if($total > $hall->seat_count){
             return response()->json([
                 'data' => [
                     'error' => 'Hall capacity is less than $total'
                 ]
             ])->setStatusCode(400);
        }
        $hall->seats()->attach($request->get('seats'));
        return response()->json([
            'data' => [
                'seats' => new HallSeatResource($hall)
            ]
        ])->setStatusCode(201);
    }
    public function update(Hall $hall,Request $request){
        $total = collect($request->get('seats'))->sum('count');
        if($total > $hall->seat_count){
            return response()->json([
                'data' => [
                    'error' => 'Hall capacity is less than $total'
                ]
            ])->setStatusCode(400);
       }
        $hall->seats()->detach();
        $hall->seats()->attach($request->get('seats'));
        return response()->json([
            'data' => [
                'hall_seats' => new HallSeatResource($hall)
            ]
        ])->setStatusCode(200);
    }
}
