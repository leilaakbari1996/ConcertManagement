<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\SingleRoleResource;
use App\Models\permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        return response()->json([
            'data' => [
                'roles' => RoleResource::collection(Role::all())
            ]
        ])->setStatusCode(200);
    }
    public function show(Role $role){
        return response()->json([
            'data' => [
                'role' => new SingleRoleResource($role),

            ]
            ]);
    }
    public function store(RoleRequest $request){
        /**
         * @var Role $role
         */
        $role = Role::query()->create([
            'title' => $request->get('title'),
        ]);
        if($request->filled('permissions')){//$request->get('permissions) != null
            $permissions = permission::query()->whereIn('title',$request->get('permissions'))->get();
            $role->permissions()->attach($permissions);
        }
        return response()->json([
            'data' => [
                'role' => new SingleRoleResource($role)
            ]
        ])->setStatusCode(201);



    }
    public function update(Role $role,UpdateRoleRequest $request){
        $Is_exist = Role::query()->where('title',$request->get('title'))->where('id','!=',$role->id)->exists();
        if($Is_exist){
            return response()->json([
                'data' => [
                    'msg' => 'this title already exist.'
                ]
            ])->setStatusCode(400);
        }
        $role->update([
            'title' => $request->get('title',$role->title)
        ]);
        if($request->filled('permissions')){
            $permissions = permission::query()->whereIn('title',$request->get('permissions'))->get();
            $role->permissions()->sync($permissions);
        }
        return response()->json([
            'data' => [
                'role' => new SingleRoleResource($role)
            ]
            ]);
    }
    public function destroy(Role $role){
        if($role->users()->count() > 0){
            return response()->json([
                'data' => [
                    'msg' => 'role has many users.'
                ]
                ])->setStatusCode(400);
        }
        $role->permissions()->detach();
        $role->delete();
        return response()->json([
            'data' => [
               'msg' => 'role successfully deleted.'
            ]
        ])->setStatusCode(200);
    }
}
