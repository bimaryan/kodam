<?php

namespace App\Http\Controllers;

use App\Models\Kodam;
use Illuminate\Http\Request;

class KodamController extends Controller
{
    public function kodamIndex()
    {
        $kodams = Kodam::all();
        return view('kodam', compact('kodams'));
    }

    public function index()
    {
        return Kodam::all();
    }

    public function show($id)
    {
        return Kodam::find($id);
    }

    public function store(Request $request)
    {
        $kodam = Kodam::create($request->all());
        return response()->json($kodam, 201);
    }

    public function update(Request $request, $id)
    {
        $kodam = Kodam::findOrFail($id);
        $kodam->update($request->all());
        return response()->json($kodam, 200);
    }

    public function destroy($id)
    {
        Kodam::destroy($id);
        return response()->json(null, 204);
    }

    public function showForm()
    {
        return view('home');
    }

    public function generateKodam(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kodam = Kodam::inRandomOrder()->first();

        return view('home', ['nama' => $request->nama, 'kodam' => $kodam]);
    }
}
