<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = User::role('owner')->with('restaurants')->paginate(15);
        return view('admin.owners.index', compact('owners'));
    }

    public function create()
    {
        return view('admin.owners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole('owner');

        return redirect()->route('admin.owners.index')
            ->with('success', 'İşletme sahibi başarıyla oluşturuldu.');
    }

    public function edit(User $owner)
    {
        // Sadece owner rolüne sahip kullanıcıları düzenleyebilir
        if (!$owner->hasRole('owner')) {
            abort(404);
        }

        return view('admin.owners.edit', compact('owner'));
    }

    public function update(Request $request, User $owner)
    {
        if (!$owner->hasRole('owner')) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $owner->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $owner->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (!empty($validated['password'])) {
            $owner->update(['password' => Hash::make($validated['password'])]);
        }

        return redirect()->route('admin.owners.index')
            ->with('success', 'İşletme sahibi başarıyla güncellendi.');
    }

    public function destroy(User $owner)
    {
        if (!$owner->hasRole('owner')) {
            abort(404);
        }

        // İşletme sahibinin restoranları varsa silinememeli
        if ($owner->restaurants()->count() > 0) {
            return back()->with('error', 'Bu işletme sahibine ait restoranlar bulunmaktadır. Önce restoranları silin.');
        }

        $owner->delete();

        return redirect()->route('admin.owners.index')
            ->with('success', 'İşletme sahibi başarıyla silindi.');
    }
}
