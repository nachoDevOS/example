<?php

namespace App\Http\Controllers;

use App\Models\ItemSale;
use Illuminate\Http\Request;

class ItemSaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->custom_authorize('browse_item_sales');
        return view('parameters.item-sales.browse');
    }

    public function list(){

        $this->custom_authorize('browse_item_sales');

        $search = request('search') ?? null;
        $paginate = request('paginate') ?? 10;

        $data = ItemSale::with(['category'])
                        ->where(function($query) use ($search){
                            $query->OrwhereHas('category', function($query) use($search){
                                $query->whereRaw($search ? "name like '%$search%'" : 1);
                            })
                            ->OrWhereRaw($search ? "id = '$search'" : 1)
                            ->OrWhereRaw($search ? "typeSale like '%$search%'" : 1)
                            ->OrWhereRaw($search ? "name like '%$search%'" : 1);
                        })
                        ->where('deleted_at', NULL)->orderBy('id', 'DESC')->paginate($paginate);

        return view('parameters.item-sales.list', compact('data'));
    }

    public function show($id)
    {
        $this->custom_authorize('read_item_sales');

        $item = ItemSale::with(['category'])
            ->where('id', $id)
            ->where('deleted_at', null)
            ->first();

        return view('parameters.item-sales.read', compact('item'));
    }
}
