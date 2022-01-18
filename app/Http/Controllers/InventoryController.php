<?php

namespace App\Http\Controllers;

use App\DataTables\InventoryDataTable;
use App\Http\Requests\InventoryRequest;
use App\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    /**
     * Display Table View
     */
    public function index(InventoryDataTable $inventoryDataTable)
    {
        return $inventoryDataTable->render('index');
    }

    /**
     * Display Create View
     */
    public function create()
    {
        return view('create');
    }

     /**
     * Create save post
     */
    public function createSave(InventoryRequest $request)
    {
        $data = $request->validated();
        $createProduct = Inventory::create($data);
        if ($createProduct) {
            return redirect()->route('index')->withMessage('Produk berhasil dibuat');
        }
        return redirect()->route('index')->withErrors('Produk gagal dibuat');
    }

   /**
     * Display Edit View
     */
    public function edit(Request $request)
    {
        $id = request()->route('id');
        if (!is_numeric($id)) {
            return redirect()->route('index')->withErrors('ID Produk Invalid');
        }
        $inventory = Inventory::where('inventory_id', $id)->first();
        if (!$inventory) {
            return redirect()->route('index')->withErrors('Produk Tidak Ditemukan');
        }
        return view('edit', compact('inventory'));
    }

    /**
     * Edit save post
     */
    public function editSave(InventoryRequest $request)
    {
        $updateData = $request->validated();
        try {
            DB::beginTransaction();
            $product = Inventory::where('inventory_id', $request->id)->lockForUpdate()->first();
            if (!$product) {
                throw new \Exception('Produk tidak ditemukan');
            }
            $product->update($updateData);
            DB::commit();
            return redirect()->route('index')->withMessage('Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withMessage($e->getMessage())->withInput();
        }
    }

    /**
     * Delete product
     */
    public function delete(Request $request)
    {
        $validator = $this->validateIds($request->only('ids'));
        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'message' => $validator->getMessageBag()], 422);
        }
        $products = Inventory::whereIn('inventory_id', $request->ids)->get();
        if (!$products) {
            return response()->json(['status' => 'fail', 'message' => 'not found'], 404);
        }
        $toBeDeletedIds= [];
        foreach ($products as $product) {
            $toBeDeletedIds[] = $product->inventory_id;
        }
        Inventory::whereIn('inventory_id', $toBeDeletedIds)->delete();
        return response()->json(['status' => 'ok', 'message' => 'inventory terhapus'], 200);
    }

    public function validateIds($ids)
    {
        return Validator::make($ids, [
            "ids"    => "required|array|min:1",
            "ids.*"  => "required|integer|distinct|min:1",
        ]);
    }
}
