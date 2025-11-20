<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::with('restaurant.owner')
            ->orderBy('is_approved')
            ->latest()
            ->paginate(15);

        return view('admin.branches.index', compact('branches'));
    }

    public function approve(Branch $branch)
    {
        $branch->update(['is_approved' => true]);

        return redirect()->route('admin.branches.index')
            ->with('success', 'Şube başarıyla onaylandı.');
    }

    public function reject(Branch $branch)
    {
        $branch->delete();

        return redirect()->route('admin.branches.index')
            ->with('success', 'Şube başarıyla reddedildi ve silindi.');
    }

    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'is_approved' => 'required|boolean',
        ]);

        $branch->update($validated);

        return redirect()->route('admin.branches.index')
            ->with('success', 'Şube durumu güncellendi.');
    }
}
