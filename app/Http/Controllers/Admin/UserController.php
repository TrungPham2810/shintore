<?php

namespace App\Http\Controllers\Admin;

use App\AuthorizationRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $user;
    protected $role;

    public function __construct(
        User $user,
        AuthorizationRole $role
    ) {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
        $data = $this->user->latest()->paginate(10);
        return view('admin.permission.user.list', compact('data'));
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('admin.permission.user.add', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        try {
            DB::beginTransaction();
            $roleId = $request->role;
            $dataInsert = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ];
            $user = $this->user->create($dataInsert);
            if ($roleId) {
                $user->role()->attach([$roleId]);
            }
            $message = "Create User success.";
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = 'Message: ' . $e->getMessage() . 'Line: ' . $e->getLine();
            Log::error($message);
            return redirect()->route('admin.user.create')->with('message', $message);
        }
        return redirect()->route('admin.user.index')->with('message', $message);
    }


    public function edit($id)
    {
        try {
            $user = $this->user->find($id);
            $currentRoles = $user->role;
            $roles = $this->role->all();
            if ($user->id) {
                return view('admin.permission.user.edit', compact('user', 'roles', 'currentRoles'));
            }
            $message = '';
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
        return redirect()->route('admin.user.index');
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $dataUpdate = [];
            $user = $this->user->find($id);
            if($request->has('new_password') && $request->new_password) {
                if(Hash::check($request->password, $user->password)){
                    $dataUpdate['password'] = bcrypt($request->new_password);
                } else {
                    $message = 'Message: Incorrect current password please enter again.';
                    Log::error($message);
                    return redirect()->route('admin.user.edit', ['id'=>$id])->with('message', $message);
                }
            }
            $dataUpdate['name'] = $request->name;
            $dataUpdate['email'] = $request->email;
            $this->user->find($id)->update($dataUpdate);
            $user = $this->user->find($id);
            if($user->id) {
                $rolesId = $request->role;
                if($rolesId) {
                    $user->role()->sync([$rolesId]);
                }
            }
            $message = "Update success user.";
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = 'Message: ' . $e->getMessage() . 'Line: ' . $e->getLine();
            Log::error($message);
        }
        return redirect()->route('admin.user.edit', ['id'=>$id])->with('message', $message);
    }

    public function delete($id, User $user)
    {
        if($id) {
            try {
                if( $this->authorize('delete', $user)) {
                    $user = $this->user->find($id);
                    $user->delete();
                    $message = 'Delete user success.';
                    return response()->json([
                        'code' => 200,
                        'message' => $message
                    ], 200);
                }
            } catch (\Exception $e) {
                $message = 'Error: '.$e->getMessage();
                return response()->json([
                    'code' =>500,
                    'message' => $message
                ]);
            }
        } else {
            $message = 'Error: Can\'t found slider to delete ';
            return response()->json([
                'code' =>500,
                'message' => $message
            ]);
        }
    }
}
