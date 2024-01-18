<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use http\Env\Response;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
{
    $permissions =Permission::all();
    return response()->json([
        'status'=>true,
        $permissions,
        'message'=>'همه ی پرمیژن ها!!'
    ]);
}

public function store(Request $request)
{
    $validator = Validator::make($request->all(),[
        'name'=>'required',
    ]);
    if ($validator->fails())
    {
        return response()->json($validator->messages(),422);
    }

    Permission::create([
       'name'=>$request->name,
        'guard_name'=>'api'
    ]);
    return response()->json([
        'status'=>true,
        'message'=>' پرمیشن ذخیره شد!!'
    ]);
}
public function update(Request $request, Permission $permission)
{
    $validator = Validator::make($request->all(),[
        'name'=>'required'
    ]);
    if ($validator->fails())
    {
        return response()->json($validator->messages(),422);
    }
    $permission->update([
        'name'=>$request->name,
    ]);
    return response()->json([
        'status'=>true,
        'message'=>' پرمیشن آپدیت شد!!'
    ]);
}
public function show(Permission $permission)
{
    return response([
        'status'=>true,
        'message'=> $permission->name.' پرمیشن ',
       $permission,
    ]);
}

public function destroy(Permission $permission)
{
    $permission->delete();
    return response()->json([
        'status'=>true,
        'message'=>' پرمیشن حذف شد!!'
    ]);
}


}
