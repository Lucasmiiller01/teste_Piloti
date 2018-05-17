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
        return view('home');
    }

    public function getUsers()
    {
        $users = DB::table('users')->select('id','name')->get();
        return view('home', ['users' => $users]);
        dd($users);
    }
    public function deleteUser($id)
    {
          DB::table('users')->where('id',$id)->delete();
          return redirect()->route('getUsers');
     }

}
