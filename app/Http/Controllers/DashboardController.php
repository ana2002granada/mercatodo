<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\IndexDashboardRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(IndexDashboardRequest $request): View
    {
        $products = Product::active()
            ->priceFilter($request->get('start_price'), $request->get('end_price'))
            ->categoryFilter($request->get('category'))
            ->search($request->get('search'))
            ->orderBy('name')
            ->paginate(2);

        $categories = Category::active()->nameField($request->get('search'))->orderBy('name')->get();
        return view('dashboard', compact('products', 'categories'));
    }
}
