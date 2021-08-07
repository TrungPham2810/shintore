<?php

namespace App\Http\Controllers\Admin;

use App\AuthorizationRule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class RuleController extends Controller
{
    protected $rule;

    public function __construct(
        AuthorizationRule $rule
    ){
        $this->rule = $rule;
    }

    public function index()
    {
        $data = $this->rule->latest()->paginate(20);
        return view('admin.permission.rule.list', compact('data'));
    }

    public function create()
    {
        return view('admin.permission.rule.add');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataInsert = [
                'name'=> $request->module_name,
                'rule_key'=> $request->module_name,
                'parent_id'=>0,
            ];
            $rule = $this->rule->create($dataInsert);
            foreach ($request->action as $action) {
                $this->rule->create([
                    'name'=> $action.'_'.$request->module_name,
                    'parent_id' => $rule->id,
                    'rule_key' => $action.'_'.$request->module_name
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = 'Message: ' . $e->getMessage() . 'Line: ' . $e->getLine();
            Log::error($message);
            return redirect()->route('admin.rule.create')->with('message', $message);
        }
        return redirect()->route('admin.rule.index');
    }

    public function delete($id, AuthorizationRule $rule)
    {
        if ($id) {
            try {
                if( $this->authorize('delete', $rule)) {
                    $rule = $this->rule->find($id);
                    $rule->delete();
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
