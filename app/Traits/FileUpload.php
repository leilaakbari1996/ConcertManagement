<?php namespace App\Traits;

use Illuminate\Http\Request;

trait FileUpload
{
    public function uploader(Request $request,$directory,$file){

        return $request->file($file)->storePubliclyAs(
            $directory,$request->file($file)->getClientOriginalName()
        );
    }
}
