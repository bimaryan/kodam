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
        $histories = \App\Models\History::latest()->take(5)->get();
        return view('home', compact('histories'));
    }

    public function generateKodam(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kodam = Kodam::inRandomOrder()->first();
        
        // Save history
        \App\Models\History::create([
            'nama' => $request->nama,
            'kodam_nama' => $kodam->nama
        ]);
        
        // Generate deterministic funny description based on Kodam Name
        $descriptions = [
            "Khodam ini membuatmu gampang overthinking di malam hari tapi selalu ngantuk di pagi hari.",
            "Aura mistis dari khodam ini membuatmu sering lupa menaruh kunci motor atau kacamata.",
            "Kekuatan khodam ini memberimu daya tarik magnetis, tapi sayangnya cuma buat nyamuk.",
            "Khodam ini membuatmu sangat berani saat main game horor, tapi takut saat ke kamar mandi sendirian.",
            "Kehadirannya membuatmu selalu ingin makan gorengan setiap kali hujan turun.",
            "Khodam ini melindungi dompetmu dari copet, tapi tidak melindunginya dari diskon e-commerce.",
            "Energi khodam ini membuatmu terlihat berwibawa, kecuali kalau sedang rebahan.",
            "Khodam pendamping ini akan memberimu kekuatan membalas chat dengan sangat cepat, kalau lagi butuh.",
            "Dia memberikan aura misterius padamu, sering bikin orang nanya 'kamu lagi marah ya?'.",
            "Khodam ini membuatmu suka tiba-tiba joget sendiri kalau dengar lagu dangdut di minimarket.",
            "Energinya sangat kuat, membuatmu selalu jadi tempat curhat teman tapi jarang diprioritaskan.",
            "Khodam ini melindungimu dari nasib buruk, kecuali nasib jomblo menahun.",
            "Sifat khodam ini membantumu selalu menemukan jalan keluar, tapi sering nyasar duluan di Google Maps.",
            "Kehadirannya membuatmu terlihat rajin di mata bos, padahal sebenarnya cuma jago pura-pura sibuk.",
            "Khodam ini memiliki ilmu kebal, sayangnya cuma kebal terhadap gombalan buaya."
        ];
        
        $hashIndex = hexdec(substr(md5($kodam->nama), 0, 5)) % count($descriptions);
        $deskripsi = $descriptions[$hashIndex];

        $histories = \App\Models\History::latest()->take(5)->get();

        return view('home', [
            'nama' => $request->nama, 
            'kodam' => $kodam, 
            'deskripsi' => $deskripsi,
            'histories' => $histories
        ]);
    }
}
