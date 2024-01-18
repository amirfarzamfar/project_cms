<?php
//
//namespace App\Http\Middleware;
//
//use Closure;
//use Illuminate\Http\Request;
//use Symfony\Component\HttpFoundation\Response;
//
//class role
//{
//    /**
//     * Handle an incoming request.
//     *
//     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//     */
//    public function handle(Request $request, Closure $next, ...$roles): Response
//    {
////        $user = auth()->user();
////        if (!$user) {
////            return response()->json(['error' => 'please login'], 401);
////        } else {
////            if (in_array($user->role, $role))
////                return $next($request);
////
////            else
////                return response()->json(['error' => ' login'], 401);
////
////            return $next($request);
////        }
////    }}
////        dd(auth()->user());
//        if (in_array(auth()->user()->role, $roles)) {
////            dd(123);
//            return $next($request);
//        } else {
//            return back();
//        }
//    }}
//
//
//
//
//
//
////        $user = auth()->user();
////        if (!$user) {
////            return redirect()->route('login');
////        } else {
////            if (in_array($user->role, $role))
////                return $next($request);
////            else
////                return redirect()->route('error');
////
////            return $next($request);
////        }
////    }
//
//
//
////public function handle(Request $request, Closure $next,string $admin,string $seller='',string $customer=''): Response
////    {
////
////        $user=auth()->user();
////        if(!$user)
////        {
////            return redirect()->route('login');
////        }
////        else
////        {
////            if($admin=='admin' && $seller == '' && $customer=='')
////            {
////                if($user->role == 'admin') {
////                    return $next($request);
////                }
////                else
////                {
////
////                    return redirect()->route('error');
////                }
////
////            }
////            if($admin=='admin' && $seller == 'seller' && $customer=='')
////            {
////                if($user->role == 'admin' || $user->role == 'seller') {
////                    return $next($request);
////                }
////                else{
////
////                    return redirect()->route('error');
////                }
////            }
////            if($admin=='admin' && $seller == 'seller' && $customer=='customer')
////            {
////                if($user->role == 'admin' || $user->role == 'seller' || $user->role == 'customer') {
////                    return $next($request);
////                }
////                else{
////
////                    return redirect()->route('error');
////                }
////            }
////
////
////
////        }
////
////        return $next($request);
////    }
////}
