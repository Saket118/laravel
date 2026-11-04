<?php

namespace App\Http\Controllers;
use App\Models\test;
use Illuminate\Http\Request;

class testcontroller extends Controller
{
    public function __construct()
    {
     $this->test =  new test(); 
    }
    
    public function home()
    {
        return view('form');
    }
         public function deshboard()
    {

       if (!session('is_login')) {
        return redirect('/form');
    }
      $get["data"]= $this->test->getData();

    return view('deshboard', $get);
    }

     public function AddUser()
    {
       if (!session('is_login')) {
        return redirect('/form');
    }
    return view('AddUser');
    }
    public function  register(Request $request){
    // dd($request->all());
    // exit();
    $email= $request->input("email");
    $password= $request->input("pass");
    $modelAction=  $this->test->user($email,$password);
 if ($modelAction['status']) {

        session([
            'user_id' => $modelAction['user_id'],
            'user_name' => $modelAction['name'],
            'is_login' => true
        ]);

    }

    return response()->json($modelAction);
    }

   
    public function logout()
{
    session()->flush();

    return response()->json([
        'status' => true,
        'message' => 'Logout successful'
    ]);
}

 public function  newuser(Request $request){
    $data=[
        "name" => $request->input("name"),
        "email" => $request->input("email"),
        'password' => $request->input("password")
    ];
    $modelAction=  $this->test->newuser($data);
    return response()->json($modelAction);
    }

public function DeleteUser($id)
{
    $Delete = $this->test->DeleteUser($id);
    return redirect('/dashboard')
        ->with('success', 'User deleted successfully');
}

public  function  ShowEditForm($id){
$userData= $this->test->singleUserData($id);

return view('edit-user', ['userData' => $userData]);

}

public function Update_user(Request $request){
      $data=[
        "name" => $request->input("name"),
        "email" => $request->input("email"),
        'password' => $request->input("password")
    ];
  $UpdateUser=  $this->test->update_user($data);
    return response()->json($UpdateUser);

}

    }

