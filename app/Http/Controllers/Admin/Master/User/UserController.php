<?php

namespace App\Http\Controllers\Admin\Master\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    public function index(UserService $userService)
    {
        $data = $userService->get();
        return view('admin.master.users.index', ['data' => $data]);
    }

    public function add(Request $request)
    {
        $editable = false;
        return view('admin.master.users.add', compact('editable'));
    }

    public function store(UserRequest $userRequest, UserService $userService)
    {
        try {
            $input = $userRequest->validated();
            $store = $userService->insert($input);
            return redirect()->route('admin.master.users.index');
        } catch (\Throwable $th) {
            dd($th);
            $request->session()->flash('status', 'Gagal Simpan!');
            return back()->withInput();
        } catch (\Exception  $e) {
            dd($e);
            die();
        }
    }

    public function edit($id, UserService $userService)
    {
        $editable = true;
        $data = $userService->findById($id);
        return view('admin.master.users.add', compact('data','editable'));
    }

    public function delete($id, UserService $userService)
    {
        $deleted = $userService->delete($id);
        return redirect()->route('admin.master.users.index');
    }
}
