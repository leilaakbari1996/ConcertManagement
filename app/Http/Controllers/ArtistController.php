<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewArtisanRequest;
use App\Http\Requests\UpdateArtistRequest;
use App\Http\Resources\ArtistResource;
use App\Http\Resources\singleArtistResource;
use App\Models\Artist;
use App\Models\Concert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    public function index(){
        return response()->json([
            'data' => [
                'artists' => ArtistResource::collection(Artist::paginate(5))->response()->getData()
            ]
        ])->setStatusCode(200);
    }
    public function store(NewArtisanRequest $request){
        $artistDirectory = $request->get('full_name').now()->timestamp;
        $avator = $this -> uploader($request,'public/artists/'.$artistDirectory,'avator');
        $background = $this -> uploader($request,'public/artists/'.$artistDirectory,'background');
        $artist = Artist::query()->create([
            'full_name' => $request->get('full_name'),
            'category_id' => $request->get('category_id'),
            'avator' => $avator,
            'background' => $background
        ]);
        return response()->json([
            'data' => [
                'artist' => new singleArtistResource($artist)
            ]
        ])->
        setStatusCode(201);
    }
    public function update(Artist $artist,UpdateArtistRequest $request){
        $artistDirectory = explode('/',$artist->avator);
        array_pop($artistDirectory);
        $artistDirectory = implode('/',$artistDirectory);

        if($request->hasFile('avator')){
            Storage::delete($artist->avator);
            $avator = $this -> uploader($request,$artistDirectory,'avator');
        }else{
            $avator = $artist->avator;
        }
        if($request->hasFile('background')){
            Storage::delete($artist->background);
            $background = $this -> uploader($request,$artistDirectory,'background');
        }else{
            $background = $artist->background;
        }

        $artist->update([
            'full_name' => $request->get('full_name',$artist->full_name),
            'category_id' => $request->get('category_id',$artist->category_id),
            'avator' => $avator,
            'background' => $background

        ]);
        return response()->json([
            'data' => [
                'artist' => new singleArtistResource($artist)
            ]
        ])->setStatusCode(200);
    }
    public function show(Artist $artist){
        return response()->json([
            'data' => new ArtistResource($artist)
        ])->setStatusCode(200);
    }
    public function destroy(Artist $artist){
        Storage::delete($artist->avator);
        Storage::delete($artist->background);
        $artist->delete();
        return response([
            'msg' => 'artist been delete'
        ]);
    }
    public function concerts(){
        return $this-> hasMany(Concert::class);
    }
}
