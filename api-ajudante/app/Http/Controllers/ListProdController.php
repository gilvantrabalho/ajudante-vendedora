<?php

namespace App\Http\Controllers;

use App\Models\ListProd;
use App\Models\ProductForList;
use Illuminate\Http\Request;

class ListProdController extends Controller
{

    public function index()
    {
        $lists = ListProd::whereStatus('ENVIADA')->with('user')->get();
        return response()->json([
            'lists' => $lists
        ]);
    }

    public function destroy(int $id)
    {
        try {
            ProductForList::where('list_prods_id', $id)->delete();
            ListProd::whereId($id)->delete();

            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function enviar(int $id)
    {
        $update = ListProd::whereId($id)
            ->update(['status' => 'ENVIADA']);

        if (!$update) {
            return response()->json([
                'error' => true
            ]);
        }

        return response()->json([
            'error' => false
        ]);
    }

    public function show(int $id)
    {
        return response()->json([
            'list' => ListProd::whereId($id)->with('products_for_list', 'user')->first()
        ]);
    }

    public function update(Request $request, int $id)
    {
        try {

            $update = ListProd::whereId($id)
                ->update([
                    'user_id' => $request->user_id,
                    'name' => $request->name,
                    'status' => $request->status,
                ]);

            if (!$update) {
                return response()->json([
                    'error' => true,
                    'response' => [
                        'message' => 'Erro ao tentar atualizar'
                    ]
                ]);
            }

            return response()->json([
                'error' => false,
                'response' => [
                    'message' => 'Lista atualizada com sucesso!'
                ]
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
