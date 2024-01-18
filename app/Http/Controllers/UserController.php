<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function status()
    {
        $statuses = User::where('status', 'Awaiting confirmation')->get();
        return view('users.status', ['statuses' => $statuses]);
    }

    public function confirmed(User $user)
    {
        $user->update([
            'status' => 'confirmation'
        ]);
        return redirect()->route('users.status');
    }

    //--------------------------------------- Logout ------------------------------------------

    public function UserLogout()
    {
//        dd(12321321321312);
//        $user = User::find($id);
        auth('sanctum')->user()->tokens()->delete();
        return response()->json('logged out',200);

    }

    //--------------------------------------- Register ------------------------------------------



    public function UserRegister(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json($validator->messages(),422);
        }
        if ($request->role == 'seller') {
            $user = User::create([
                'first_name' => $request->first_name,
                'email' => $request->email,
                'status' => 'Awaiting confirmation',
                'password' => Hash::make($request->password),
            ]);
            $user->syncRoles([$request->role]);
        } else {
            $user = User::create([
                'first_name' => $request->first_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->syncRoles([$request->role]);
        }
      $token =  $user->createToken("API TOKEN")->plainTextToken;

        return response()->json([
            'user'=>$user,
            'token'=>$token
        ]);
//            session()->put('token', $user->createToken("API TOKEN")->plainTextToken);
//        return redirect()->route('workplace');
    }












//    public function UserRegister(Request $request)
//    {
//
//        try {
//            $validateUser = Validator::make($request->all(),
//                [
//                    'first_name' => 'required',
//                    'email' => 'required|email|unique:users,email',
//                    'password' => 'required',
//                    'role' => 'required'
//                ]
//            );
//            if ($validateUser->fails()) {
//                return response()->json([
//                    'status' => false,
//                    'message' => 'validation error',
//                    'errors' => $validateUser->errors(),
//                ], 401);
//            }
//            if ($request->role == 'seller') {
//                $user=User::create([
//                    'first_name' => $request->first_name,
//                    'email' => $request->email,
//                    'role' => $request->role,
//                    'status' => 'Awaiting confirmation',
//                    'password' => Hash::make($request->password),
//                ]);
//            } else {
//                $user = User::create([
//                    'first_name' => $request->first_name,
//                    'email' => $request->email,
//                    'role' => $request->role,
//                    'password' => Hash::make($request->password),
//                ]);
//            }
//
//             $user->createToken("API TOKEN")->plainTextToken;
////            session()->put('token', $user->createToken("API TOKEN")->plainTextToken);
//            return redirect()->route('workplace');
//
////            dd(session()->has('token'));
////            return response()->json([
////                'status'=>true,
////                'message'=>'User Created Successfully',
////                'token'=>$token,
////            ],200);
//
//
//        } catch (\Throwable $th) {
//            return response()->json([
//                'status' => false,
//                'message' => $th->getMessage(),
//            ], 500);
//        }
//    }

//--------------------------------------- login ------------------------------------------

    public function UserLogin(LoginRequest $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required',
                ]
            );
//            $validateUser=$request->validated();
//            dd($validateUser);
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors(),
                ], 401);
            }
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('API TOKEN')->plainTextToken;
            return response()->json([
                'status'=>true,
                'message'=>'User Logged In Succesfully',
                'token'=> $token
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
//        return redirect()->route('workplace');
    }


    public function create()
    {
        return view('users.addUser');
    }

    public function index(Request $request)
    {
        $users = User::all();
        return view('users.usersData', ['users' => $users]);
    }

    public function filter(Request $request)
    {
        $users = User::all();
        if ($request->filterEmail)
            $users = $users->where('email', $request->filterEmail);
        if ($request->filterFirstName)
            $users = $users->where('first_name', $request->filterFirstName);
        if ($request->filterLastName)
            $users = $users->where('last_name', $request->filterLastName);
        if ($request->filterUserName)
            $users = $users->where('user_name', $request->filterUserName);
        if ($request->filterAgeMin && $request->filterAgeMax)
            $users = $users->whereBetween('age', [$request->filterAgeMin,$request->filterAgeMax]);
        if ($request->filterPhoneNumber)
            $users = $users->where('phone_number', $request->filterPhoneNumber);
        if ($request->filterPostalCode)
            $users = $users->where('postal_code', $request->filterPostalCode);
        if ($request->filterGender)
            $users = $users->where('gender', $request->filterGender);
        if ($request->filterStatus)
            $users = $users->where('status', $request->filterStatus);
        if ($request->filterRoles)
            $users = $users->where('role', $request->filterRoles);

//        dd($users->first()->user_name);
//        return view('users.usersData', compact('users'));
        return response()->json($users,200);
    }


    public function store(UserRequest $request)
    {
//        $request->validate([
//            'user_name'=>'required',
//            'first_name'=>'required',
//            'last_name'=>'required',
//            'age'=>'required',
//            'gender'=>'required',
//            'email'=>'required|email|unique:users',
//            'phone_number'=>'required',
//            'address'=>'required',
//            'postal_code'=>'required',
//            'country'=>'required',
//            'province'=>'required',
//            'city'=>'required',
//            'password'=>'required',
//
//        ]);

        $imagename = $request->image->getClientOriginalName();
        $request->image->move(public_path('image/users'), $imagename);

        User::create([
            'user_name' => $request->user_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => md5($request->password),
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'province' => $request->province,
            'city' => $request->city,
            'created_at' => date('Y-m-d H:i:s'),
            'image' => $imagename,

        ]);
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('users.editUser', ['user' => $user]);
    }

//    public function destroy($id)
//    {
//        User::where('id', $id)->delete();
//        return back();
//    }

    public function update(UserUpdateRequest $request, $id)
    {
//        dd(123231);
        $user = User::find($id);
        if (!$user)
        {
            return response()->json(['error'=>'User Not found'],404);
        }

       $user->update([
            'user_name' => $request->user_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'province' => $request->province,
            'city' => $request->city,
            'updated_at'=> now(),
        ]);
        return response()->json(['message'=>'User updated successfully']);
    }
}
