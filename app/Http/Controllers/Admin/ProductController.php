<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Components\Recusive;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{
    use StoreageImageTrait;
    protected $product;
    protected $recusive;

    public function __construct(
        Product $product,
        Recusive $recusive

    ) {
        $this->product = $product;
        $this->recusive = $recusive;
    }

    public function handleCategorySelect($id = 0, $currentCategory = 0)
    {
        $htmlSelect = $this->recusive->categoryRecusive($id, $currentCategory);
        return $htmlSelect;
    }

    public function index()
    {
        $data = $this->product->orderBy('id')->paginate(20);
//        dd($this->product->orderBy('id')->paginate(20));
        return view('admin.product.list', compact('data'));
    }

    public function create()
    {
        $htmlSelect = $this->handleCategorySelect();
        return view('admin.product.add', compact('htmlSelect'));
    }

    public function store(ProductRequest $request)
    {
        $message = '';
        try {
            DB::beginTransaction();
            $dataUpload = $this->storageImgUpload($request, 'image_path', 'product');
            $dataInsert = [
                'name' => $request->product_name,
                'sku' => $request->sku,
                'import_price' => $request->import_price,
                'price' => $request->price,
                'qty' => $request->qty,
                'url_key' => $request->url_key,
                'category_id' => $request->category_id,
                'description' => $request->description
            ];

            if(!empty($dataUpload)) {
                $dataInsert['image_name'] = $dataUpload['file_name'];
                $dataInsert['image_path'] = $dataUpload['file_path'];
            }
            $product = $this->product->create($dataInsert);

            if($product->id) {
                if($request->tags) {
                    $product->tags()->attach($request->tags);
                }
            }
            $message = 'Create product success.';
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = 'Error: ' . $e->getMessage();
            Log::error($message. ' Line: '.$e->getLine());
            return redirect()->route('admin.product.create')->with('message', $message);
        }
        return redirect()->route('admin.product.index')->with('message', $message);
    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        $htmlSelect = $this->handleCategorySelect(0, $product->category_id);
        return view('admin.product.edit', compact('product','htmlSelect'));
    }

    public function update($id, ProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataUpdate = [
                'name' => $request->product_name,
                'sku' => $request->sku,
                'import_price' => $request->import_price,
                'url_key' => $request->url_key,
                'price' => $request->price,
                'qty' => $request->qty,
                'category_id' => $request->category_id,
                'description' => $request->description
            ];
            $dataUpload = $this->storageImgUpload($request, 'image_path', 'product');
            if(!empty($dataUpload)) {
                $dataUpdate['image_name'] = $dataUpload['file_name'];
                $dataUpdate['image_path'] = $dataUpload['file_path'];
            }
            $this->product->find($id)->update($dataUpdate);
            $product = $this->product->find($id);
            $message = 'Update product success.';
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = 'Error: ' . $e->getMessage();
            Log::error($message. ' Line: '.$e->getLine());
            return redirect()->route('admin.product.edit', ['id' => $id])->with('message', $message);
        }
        return redirect()->route('admin.product.index')->with('message', $message);
    }


    public function delete($id, Product $product)
    {
        if ($id) {
            try {
                if( $this->authorize('delete', $product)) {
                    $product = $this->product->find($id);
                    $product->delete();
                    $message = 'Delete product success.';
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
