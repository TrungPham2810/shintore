<?php

namespace App\Http\Controllers\Admin;

use App\AuthorizationRole;
use App\AuthorizationRule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    protected $role;
    protected $rule;

    public function __construct(
        AuthorizationRole $role,
        AuthorizationRule $rule
    ) {
        $this->role = $role;
        $this->rule = $rule;
    }

    public function index()
    {
        $data = $this->role->latest()->paginate(20);
        return view('admin.permission.role.list', compact('data'));
    }

    public function create()
    {
        $rules = $this->rule->where('parent_id', 0)->get();
        return view('admin.permission.role.add', compact('rules'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataInsert = [
                'name' => $request->name,
                'role_key' => $request->role_key,
            ];
            $role = $this->role->create($dataInsert);
            if($ruleIds = $request->rule) {
                if($ruleIds[0] == null) {
                    unset($ruleIds[0]);
                }
                $role->rules()->attach($ruleIds);
            }
            $message = 'Create role success.';
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
        return redirect()->route('admin.role.index')->with('message', $message);
    }

    public function edit($id)
    {
        try {
            $message = '';
            $role = $this->role->find($id);
            $currentRule = $role->rules;
            $rules = $this->rule->where('parent_id', 0)->get();
            if ($role->id) {
                return view('admin.permission.role.edit', compact('role', 'rules', 'currentRule'));
            } else {
                $message = "Không tìm thấy role để sửa.";
            }
        } catch (\Exception $e) {
            $message = 'Message: ' . $e->getMessage() . 'Line: ' . $e->getLine();
            Log::error($message);
        }
        return redirect()->route('admin.role.index')->with('message', $message);
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $dataUpdate = [];
            $dataUpdate['name'] = $request->name;
            $dataUpdate['role_key'] = $request->role_key;
            $this->role->find($id)->update($dataUpdate);
            $role = $this->role->find($id);
            if($role->id) {
                $ruleIds = $request->rule;
                if(is_array($ruleIds)) {
                    $role->rules()->sync($ruleIds);
                }
            }
            $message = "Update Role success.";
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = 'Message: ' . $e->getMessage() . 'Line: ' . $e->getLine();
            Log::error($message);
            return redirect()->route('admin.role.edit', ['id'=>$id])->with('message', $message);
        }
        return redirect()->route('admin.role.index')->with('message', $message);
    }


    public function delete($id, AuthorizationRole $role)
    {
        if ($id) {
            try {
                if( $this->authorize('delete', $role)) {
                    $role = $this->role->find($id);
                    $role->delete();
                    $message = 'Delete rule success.';
                    return response()->json([
                        'code' => 200,
                        'message' => $message
                    ], 200);
                }
            } catch (\Exception $e) {
                $message = 'Error: ' . $e->getMessage();
                return response()->json([
                    'code' => 500,
                    'message' => $message
                ]);
            }
        } else {
            $message = 'Can\'t found item to delete.';
            return response()->json([
                'code' => 500,
                'message' => $message
            ]);
        }
    }
}
