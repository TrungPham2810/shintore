<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CategoryAddRequest;
use App\Components\Recusive;

class CategoryController extends Controller
{
    protected $category;
    protected $recusive;

    public function __construct(
        Category $category,
        Recusive $recusive
    ) {
        $this->category = $category;
        $this->recusive = $recusive;
    }

    public function index()
    {
        $data = $this->category->latest()->paginate(10);
        return view('admin.category.list', compact('data'));
    }

    public function create()
    {
        $htmlSelect = $this->handleCategorySelect();
        return view('admin.category.add', compact('htmlSelect'));
    }

    public function handleCategorySelect($id = 0, $currentCategory = 0)
    {
        $htmlSelect = $this->recusive->categoryRecusive($id, $currentCategory);
        return $htmlSelect;
    }

    public function store(CategoryAddRequest $request)
    {
        $message = '';
        try {
            $dataInsert = [
                'name' => $request->category_name,
                'url_key' => $request->url_key,
                'parent_id' => $request->parent_id,
                'description' => $request->description
            ];
            if (isset($request->status)) {
                $dataInsert['status'] = 1;
            } else {
                $dataInsert['status'] = 0;
            }
            $this->category->create($dataInsert);
            $message = 'Create Category success.';
        } catch (\Exception $e) {
            $message = 'Error: ' . $e->getMessage();
            return redirect()->route('admin.categories.create')->with('message', $message);
        }
        return redirect()->route('admin.categories.index')->with('message', $message);
    }

    public function edit($id, User $user)
    {
        $category = $this->category->find($id);
        $htmlSelect = $this->handleCategorySelect(0, $category->parent_id);
        return view('admin.category.edit', compact('category', 'htmlSelect'));
    }

    public function update($id, CategoryUpdateRequest $request)
    {
        try {
            $dataUpdate = [
                'name' => $request->category_name,
                'url_key' => $request->url_key,
                'parent_id' => $request->parent_id,
                'description' => $request->description
            ];
            if (isset($request->status)) {
                $dataUpdate['status'] = 1;
            } else {
                $dataUpdate['status'] = 0;
            }
            $this->category->find($id)->update($dataUpdate);
            $message = 'Update Category success.';
        } catch (\Exception $e) {
            $message = 'Error: ' . $e->getMessage();
            return redirect()->route('admin.categories.edit', ['id' => $id])->with('message', $message);
        }
        return redirect()->route('admin.categories.index')->with('message', $message);
    }

    public function delete($id, Category $category)
    {
        if ($id) {
            try {
                if( $this->authorize('delete', $category)) {
                    $category = $this->category->find($id);
                    $category->delete();
                    $message = 'Delete category success.';
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
            }//end try
        } else {
            $message = 'Can\'t found item to delete.';
            return response()->json([
                'code' => 500,
                'message' => $message
            ]);
        }
    }
}
