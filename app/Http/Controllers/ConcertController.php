<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConcertRequest;
use App\Http\Resources\ConcertResource;
use App\Models\Concert;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

class ConcertController extends Controller
{
    public function index(){
        return response()->json([
            'data' => [
                'concerts' => ConcertResource::collection(Concert::paginate(5))->response()->getData()
            ]
        ])->setStatusCode(200);
    }
    public function store(ConcertRequest $request){
        dd($request->get('starts_at'),$request->get('ends_at'));
        $concert = Concert::query()->create([
            'title' => $request->get('title'),
            'artist_id' => $request->get('artist_id'),
            'description' => $request->get('description'),
            'starts_at' => $request->get('starts_at'),
            'ends_at' => $request->get('ends_at'),
            'is_published' =>(Boolean) $request->get('is_published',false)
        ]);
        return response()->json([
            'data' => [
                'concert' => new ConcertResource($concert)
            ]
            ])->setStatusCode(201);
    }
}
