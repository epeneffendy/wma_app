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
            $message = '';
            $input = $userRequest->validated();
            if ($userRequest->editable == 'false'){
                $store = $userService->insert($input);
                $message = 'Data Berhasil Disimpan!';
            }else{
                $store = $userService->update($input);
                $message = 'Data Berhasil Diupdate!';
            }

            return redirect()->route('admin.master.users.index')->with('message', $message);
        } catch (\Throwable $th) {
            return back()->with('errors', $th->getMessage());
        } catch (\Exception  $e) {
            return back()->with('errors', $e->getMessage());
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
        return redirect()->route('admin.master.users.index')->with('message','Data Berhasil dihapus!');
    }
}
