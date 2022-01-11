<?php

namespace App\Http\Controllers;

use App\Http\Middleware\checkAccessMiddleware;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return response()->json([
            'data' => CategoryResource::collection(Category::all())
        ])->setStatusCode(200);
    }
    public function store(CategoryRequest $request){

        $category = Category::query()->create([
            'title' => $request->get('title')
        ]);
        return response()->json([
            'data' => new CategoryResource($category)
        ])->setStatusCode(201);
    }
    public function update(Category $category,Request $request){

        $is_exist = Category::query()->where('title',$request->get('title'))->where('id','!=',$category->id)->exists();
        if($is_exist){
            return response()->json([
                'data' => [
                    'msg' => 'this title is already'
                ]
                ])->setStatusCode(423);
        }
        $category->update([
            'title' => $request->get('title',$category->title)
        ]);
        return response()->json([
            'data' => new CategoryResource($category)
        ])->setStatusCode(200);
    }
    public function show(Category $category){

        return response()->json([
            'data' => new CategoryResource($category)
        ])->setStatusCode(200);
    }
    public function destroy(Category $category){

        $category->delete();
        return response()->json([
            'data' => [
                'msg' => 'This category has been remove.'
            ]
        ])->setStatusCode(200);
    }
}
