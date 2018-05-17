<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deleted = DB::table('deleted')->select('name')->get();
        $users = DB::table('users')->select('id','name')->get();
        return view('home', ['users' => $users, 'deleted'  => $deleted]);
    }

    public function getUsers()
    {
        $deleted = DB::table('deleted')->select('name')->get();
        $users = DB::table('users')->select('id','name')->get();
        return view('home', ['users' => $users, 'deleted'  => $deleted]);
    }
    public function deleteUser($id)
    {
          $user = DB::table('users')->where('id',$id)->get();

            DB::table('deleted')->insert(
              ['name' => $user[0]->name , 'email' => $user[0]->email, 'password' => $user[0]->password]
            );
            DB::table('users')->where('id',$id)->delete();
          $users = DB::table('users')->select('id','name')->get();
          $deleted = DB::table('deleted')->select('name')->get();
          return view('home', ['users' => $users, 'deleted'  => $deleted]);
     }

     public function editUser($id)
     {
           $user = DB::table('users')->where('id',$id)->get();
           return view('edit',compact('user'));
     }
     public function updateUser(Request $request, $id)
     {
           $user = DB::table('users')->where('id',$id)->get();
           if($request-> input('name') != "" || $request-> input('email') != "")
           {
               $user->name =  $request-> input('name');
               $user->email =  $request-> input('email');
               DB::table('users')
                ->where('id', $id)
                ->update(['name' =>  $user->name, 'email' =>  $user->email]);
               $users = DB::table('users')->select('id','name')->get();
               $deleted = DB::table('deleted')->select('name')->get();
               return view('home', ['users' => $users, 'deleted'  => $deleted]);
           }

     }

}
