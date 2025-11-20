<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Product;
use App\Models\Branch;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_restaurants' => Restaurant::count(),
            'active_restaurants' => Restaurant::where('is_active', true)->count(),
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'pending_branches' => Branch::where('is_approved', false)->count(),
            'total_customers' => Customer::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
