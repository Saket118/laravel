<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\DB;
use Illuminate\Support\Facades\DB;
class test extends Model
{
    public function _construct(){

    }
    
public function user($email, $password)
{
    $user = DB::table('login_user')->where('email', $email)->first();

   if (!$user || $password != $user->password) {
        return [
            'status' => false,
            'message' => 'Invalid email or password'
        ];
    }

    return [
        'status' => true,
        'message' => 'Login successful',
        'user_id' => $user->id,
        "name" => $user->name
    ];
}
public function getData(){
    $getData = DB::table("login_user")->get();
    return $getData;
    }

    public function newuser($data){
     $insert=  DB::table('login_user')->insert($data);

if($insert){
     return [
        'status' => true,
        'message' => 'Add User Successfully',   
    ];
}
else{
    return [
        'status' => false,
        'message' => 'User cant ADD',   
    ];
}
    }

    public function DeleteUser($id){
        $delete=  DB::table('login_user')->delete($id);
        if($delete){
     return [
        'status' => true,
        'message' => 'User Delete Successfully',   
    ];
}
else{
    return [
        'status' => false,
        'message' => 'User cant Delete',   
    ];
    

}}
public function singleUserData($id){
      $user = DB::table('login_user')->where('id', $id)->first();
  return $user;
}

public function update_user($data){
   $update=  DB::table('login_user')->update($data);

if($update){
     return [
        'status' => true,
        'message' => 'update User Successfully',   
    ];
}
else{
    return [
        'status' => false,
        'message' => 'User cant update',   
    ];
}
}


}
