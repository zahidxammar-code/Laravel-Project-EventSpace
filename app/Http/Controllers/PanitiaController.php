<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StorePanitiaRequest;
use Illuminate\Support\Facades\Hash;

class PanitiaController extends Controller
{
    public function index()
    {
        $panitias = User::where('role', 'panitia')->latest()->paginate(10);
        return view('panitia.index', compact('panitias'));
    }

    public function create()
    {
        return view('panitia.create');
    }

    public function store(StorePanitiaRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'panitia',
        ]);

        return redirect()->route('panitia.index')->with('sukses', 'Akun panitia ditambahkan.');
    }

    public function destroy(User $panitia)
    {
        $panitia->delete();
        return redirect()->route('panitia.index')->with('sukses', 'Akun panitia dihapus.');
    }
}