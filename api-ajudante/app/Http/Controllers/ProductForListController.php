<?php

namespace App\Http\Controllers;

use App\Models\ListProd;
use App\Models\Product;
use App\Models\ProductForList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductForListController extends Controller
{
    public function index(int $user_id)
    {
        $list = ListProd::whereUserId($user_id)
            ->where('status', 'N_ENVIADA')
            ->orderBy('id', 'DESC')
            ->with('products_for_list')
            ->first();

        return response()->json([
            'response' => [
                'list' => $list
            ]
        ]);
    }

    public function store(Request $request)
    {
        try {
            $credentials = $request->only('list_prods_id', 'username', 'name', 'status');

            $validator = Validator::make($credentials, [
                'name' => 'required|string',
                'status' => 'required'
            ], [
                'name.required' => 'Nome é um campo obrigatório.',
                'status.required' => 'Status é um campo obrigatório.',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors());
            }

            $listProd = ListProd::find($request->list_prods_id);
            $nameList = date("d-m-y_H:m-") . strtolower(explode(' ', $request->username)[0]);
            $list_prods = '';

            if ($listProd) {
                $list_prods = $listProd;
            } else {
                $newListProd = new ListProd([
                    'user_id' => $request->user_id,
                    'name' => $nameList
                ]);
                if (!$newListProd->save()) {
                    return response()->json([
                        'error' => true,
                        'response' => [
                            'message' => 'Erro ao tentar cadastrar lista. Tente novamente!'
                        ]
                    ]);
                }
                $list_prods = $newListProd;
            }

            $newProduct = new ProductForList([
                'list_prods_id' => $list_prods->id,
                'name' => $request->name,
                'status' => $request->status,
            ]);

            if (!$newProduct->save()) {
                return response()->json([
                    'error' => true,
                    'response' => [
                        'message' => 'Falha ao tentar cadastrar produto. Tente novamente!'
                    ]
                ]);
            }

            $this->saveProduct($request->name);
            return response()->json([
                'error' => false,
                'response' => [
                    'lista' => $list_prods,
                    'produto' => $newProduct
                ]
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function saveProduct(string $product)
    {
        $getProduct = Product::whereSlug($product)->first();

        if (!$getProduct) {
            $new = new Product([
                'name' => $product,
                'slug' => Str::slug($product),
                'status' => 'ATIVO'
            ]);
            $new->save();
        }
    }

    public function show(int $id)
    {
        return response()->json([
            'product' => ProductForList::find($id)
        ]);
    }

    public function update(Request $request, int $id)
    {
        try {
            $credentials = $request->only('list_prods_id', 'username', 'name', 'status');

            $validator = Validator::make($credentials, [
                'name' => 'required|string',
                'status' => 'required'
            ], [
                'name.required' => 'Nome é um campo obrigatório.',
                'status.required' => 'Status é um campo obrigatório.',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors());
            }

            $update = ProductForList::whereId($id)
                ->update([
                    'name' => $request->name,
                    'status' => $request->status
                ]);

            if (!$update) {
                return response()->json(['error' => true]);
            }

            return response()->json(['error' => false]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductForList  $productForList
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {
            if (ProductForList::whereId($id)->delete()) {
                return response()->json([
                    'success' => false,
                ]);
            }

            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
