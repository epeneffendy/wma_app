<?php

namespace App\Http\Controllers\Admin\Master\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    public function index(){
        return view('admin.master.users.index');
    }

    public function add(Request $request)
    {
        $editable = false;
        return view('admin.master.users.add', compact('editable'));
    }

    public function store(UserRequest $userRequest, UserService $userService){
        try {
            $input = $userRequest->validated();
            $store = $userService->insert($input);
            return redirect()->route('admin.master.users.index');
        } catch (\Throwable $th) {
            dd($th);
            $request->session()->flash('status', 'Gagal Simpan!');
            return back()->withInput();
        }catch(\Exception  $e){
            dd($e); die();
        }
    }
}
