<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService{

    public function get($request = null){
        $data = User::get();
        return $data;
    }

    public function findById($id){
        $data = User::where(['id'=>$id])->first();
        return $data;
    }

    public function insert($payload){
        $payload['email_verified_at'] = date('Y-m-d H:i:s');
        $payload['password'] = Hash::make($payload['password']);
        $data = User::insert($payload);
        return $data;
    }

    public function update($payload){
        $payload['updated_at'] = date('Y-m-d H:i:s');
        $payload['password'] = Hash::make($payload['password']);
        $data = User::where(['email'=>$payload['email']])->update($payload);
        return $data;
    }

    public function delete($id){
        $data = User::destroy($id);
    }

}
