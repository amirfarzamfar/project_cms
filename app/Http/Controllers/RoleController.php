<?php

namespace App\Http\Controllers;




use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        $roles =Role::all();
        return response()->json([
            'status'=>true,
            'roles'=>$roles,
            'permissions'=>$permissions,
            'message'=>'همه ی پرمیژن ها!!'
        ]);
    }


    public function AddPermission(Request $request)
    {
//            dd(auth()->user());
        $roleName = $request->role;
        $permissions = $request->permissions;
        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            return response()->json([
                'status' => false,
                'message' => 'Role not found'
            ]);
        }

        $role->syncPermissions([$permissions]);

        return response()->json([
            'status' => true,
            'message' => 'Permissions added'
        ]);
    }

    public function show(Role $role)
    {
        return response([
            'status'=>true,
            'message'=>'نقش'.$role->name,
            $role,
        ]);
    }
public function store(Request $request)
{
    $validator = Validator::make($request->all(),[

        'name'=>'required',
        ]);
    if ($validator->fails()){
        return response()->json($validator->messages(),422);
    }
 $role = Role::create([
        'name'=>$request->name,
//        'guard_name'=>'api'
    ]);
    

    // اختصاص اجازه به نقش
//    $permissionName = 'users'; // تغییر نام اجازه به نیاز شما
//    $permission = Permission::firstOrCreate(['name' => $permissionName]);
//    $role->givePermissionTo($permission);

    return response()->json([
        'status' => true,
        'message' => 'نقش ایجاد شد!',
        'role' => $role,
    ]);


}


    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required'
        ]);
        if ($validator->fails())
        {
            return response()->json($validator->messages(),422);
        }
        $role->update([
            'name'=>$request->name,
        ]);
        return response()->json([
            'status'=>true,
            'message'=>' پرمیشن آپدیت شد!!'
        ]);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json([
            'status'=>true,
            'message'=>' نقش حذف شد!!'
        ]);
    }


}
