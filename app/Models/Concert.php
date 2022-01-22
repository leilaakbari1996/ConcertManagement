<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request as FacadesRequest;

class Concert extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function artist(){
        return $this->belongsTo(Artist::class);
    }
    public function otherActiveconcert(HttpRequest $request){
        return Concert::query()->where('artist_id',$request->get('artist_id'))->
        where(function($query) use($request){
            $query->where(function($query) use($request){
                $query->where('starts_at','>=',$request->get('starts_at'))->
                orwhere('starts_at','=<',$request->get('ends_at'));
             })->orwhere(function($query) use($request){
                $query->where('ends_at','>=',$request->get('starts_at'))->
                orwhere('ends_at','=<',$request->get('ends_at'));
             });
        })->exists();
    }

}
