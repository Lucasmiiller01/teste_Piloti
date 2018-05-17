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
        //pegando lista de users e users deletados
        $deleted = DB::table('deleted')->select('name')->get();
        $users = DB::table('users')->select('id','name')->get();
         //indo para tela inicial
        return view('home', ['users' => $users, 'deleted'  => $deleted]);
    }
    public function deleteUser($id)
    {
          //pegando lista de users
          $user = DB::table('users')->where('id',$id)->get();

            //inserindo users deletados na tabela deleted
            DB::table('deleted')->insert(
              ['name' => $user[0]->name , 'email' => $user[0]->email, 'password' => $user[0]->password]
            );
            //deletando user pelo id
            DB::table('users')->where('id',$id)->delete();
          $users = DB::table('users')->select('id','name')->get();
          $deleted = DB::table('deleted')->select('name')->get();
           //voltando para tela inicial
          return view('home', ['users' => $users, 'deleted'  => $deleted]);
     }

     public function editUser($id)
     {
           //pegando referencia do user na tabela pelo id
           $user = DB::table('users')->where('id',$id)->get();
           return view('edit',compact('user'));
     }
     public function updateUser(Request $request, $id)
     {
             //pegando referencia do user na tabela pelo id
           $user = DB::table('users')->where('id',$id)->get();
            //verificando se os valores dos inputs não são vazios
           if($request-> input('name') != "" || $request-> input('email') != "")
           {
              //pegando valores de inputs
               $user->name =  $request-> input('name');
               $user->email =  $request-> input('email');
               //atualizando user relacionado com id com valores de input
               DB::table('users')
                ->where('id', $id)
                ->update(['name' =>  $user->name, 'email' =>  $user->email]);
               $users = DB::table('users')->select('id','name')->get();
               $deleted = DB::table('deleted')->select('name')->get();
               //voltando para tela inicial
               return view('home', ['users' => $users, 'deleted'  => $deleted]);
           }

     }

}
