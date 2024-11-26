<?php

namespace App\Http\Controllers;

use App\Models\Basketball;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Basketball::query();
        
        if ($request->type) {
            $query->where('type', $request->type);
        }
        
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
        }
        
        $basketballs = $query->get();
        
        return view('shop', compact('basketballs'));
    }
} 