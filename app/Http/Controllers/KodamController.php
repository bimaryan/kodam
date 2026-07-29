<?php

namespace App\Http\Controllers;

use App\Models\Kodam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KodamController extends Controller
{
    private function callGroq($prompt, $maxTokens = 150)
    {
        $apiKey = env('GROQ_API_KEY');
        $model = env('GROQ_TEXT_MODEL', 'llama-3.3-70b-versatile');

        if (!$apiKey) {
            return "Koneksi ke alam gaib terputus. Khodam sedang tidur.";
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => $model,
                'messages' => [
                    ['role' => 'system', 'content' => 'Kamu adalah Mbah Gaib, dukun sakti dari alam astral yang sangat lucu, nyeleneh, sarkas, dan menggunakan bahasa gaul Indonesia (lo/gue, anjir, dll). Jawabanmu harus singkat, padat, dan langsung nge-punchline. JANGAN menggunakan format markdown, langsung teks saja.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'max_tokens' => $maxTokens,
                'temperature' => 0.9,
            ]);

            if ($response->successful()) {
                $text = $response->json('choices.0.message.content');
                return trim(str_replace(['"', '*'], '', $text ?? ""));
            }
        } catch (\Exception $e) {
            // fallback
        }

        return "Energi gaib sedang ngadat, silakan sajenin developer...";
    }

    private function getGlobalData()
    {
        $histories = \App\Models\History::latest()->take(5)->get();
        
        $allHist = \App\Models\History::latest()->take(300)->get();
        $hallOfFame = [];
        $hallOfShame = [];
        foreach($allHist as $h) {
            if (in_array($h->kodam_nama, ["Battle", "Fusion", "Jodoh"])) continue;
            
            $hash = hexdec(substr(md5($h->kodam_nama . "rarity"), 0, 5)) % 100;
            if ($hash < 20 && count($hallOfFame) < 10) { 
                $h->rarity = $hash < 5 ? 'SSR' : 'Epic';
                $hallOfFame[] = $h;
            } elseif ($hash >= 50 && count($hallOfShame) < 10) {
                $h->rarity = 'Common';
                $hallOfShame[] = $h;
            }
        }
        
        $topSesajen = \App\Models\History::where('sesajen', '>', 0)
                        ->whereNotIn('kodam_nama', ["Battle", "Fusion", "Jodoh"])
                        ->orderByDesc('sesajen')
                        ->take(10)
                        ->get();

        return [$histories, $hallOfFame, $hallOfShame, $topSesajen];
    }

    public function chatPage(Request $request)
    {
        $nama = $request->query('nama');
        $kodamNama = $request->query('kodam');

        if (!$nama || !$kodamNama) {
            return redirect('/');
        }

        return view('chat', compact('nama', 'kodamNama'));
    }

    public function chatKhodam(Request $request)
    {
        $request->validate([
            'user_nama' => 'required|string',
            'khodam_nama' => 'required|string',
            'message' => 'required|string',
            'history' => 'nullable|array'
        ]);

        $apiKey = env('GROQ_API_KEY');
        $model = env('GROQ_TEXT_MODEL', 'llama-3.3-70b-versatile');

        if (!$apiKey) {
            return response()->json(['reply' => 'Sinyal gaib terputus, Mbah lagi offline.']);
        }

        $systemPrompt = "Kamu adalah wujud roh khodam bernama '{$request->khodam_nama}'. Kamu bertugas menjaga/mendampingi manusia (tuanmu) bernama '{$request->user_nama}'. Jawab setiap pesan dari '{$request->user_nama}' dengan gaya bahasa khodam/dukun sarkas, sombong tapi lucu, dan pakai bahasa gaul Indonesia (lo/gue, dsb). Jawaban maksimal 3 kalimat padat. Jangan lepas karakter!";

        $messages = [
            ['role' => 'system', 'content' => $systemPrompt]
        ];

        if ($request->history && is_array($request->history)) {
            foreach($request->history as $msg) {
                if(isset($msg['role']) && isset($msg['content']) && in_array($msg['role'], ['user', 'assistant'])) {
                    $messages[] = ['role' => $msg['role'], 'content' => $msg['content']];
                }
            }
        }

        $messages[] = ['role' => 'user', 'content' => $request->message];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(15)->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => $model,
                'messages' => $messages,
                'max_tokens' => 150,
                'temperature' => 0.9,
            ]);

            if ($response->successful()) {
                $reply = $response->json('choices.0.message.content');
                return response()->json(['reply' => trim(str_replace(['"', '*'], '', $reply ?? ""))]);
            }
        } catch (\Exception $e) {}

        return response()->json(['reply' => 'Energi gaibku sedang lemah, sajenmu kurang!']);
    }

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
        list($histories, $hallOfFame, $hallOfShame, $topSesajen) = $this->getGlobalData();
        
        return view('home', compact('histories', 'hallOfFame', 'hallOfShame', 'topSesajen'));
    }

    public function generateKodam(Request $request)
    {
        $ip = $request->ip();
        $today = date('Y-m-d');
        
        $limit = \App\Models\DailyLimit::firstOrCreate(
            ['ip_address' => $ip, 'date' => $today],
            ['usage_count' => 0]
        );

        if ($limit->usage_count >= 3) {
            list($histories, $hallOfFame, $hallOfShame, $topSesajen) = $this->getGlobalData();
            return view('home', [
                'error' => 'Energi gaib lu habis hari ini! Balik lagi besok atau puasa mutih dulu.',
                'histories' => $histories,
                'hallOfFame' => $hallOfFame,
                'hallOfShame' => $hallOfShame,
                'topSesajen' => $topSesajen,
                'mode' => 'error'
            ]);
        }

        $limit->increment('usage_count');

        $mode = $request->input('mode', 'single');

        if ($mode === 'jodoh') {
            $request->validate([
                'nama_1' => 'required|string|max:255',
                'nama_2' => 'required|string|max:255',
            ]);

            $kodam1 = Kodam::inRandomOrder()->first();
            $kodam2 = Kodam::inRandomOrder()->first();

            $matchVal = hexdec(substr(md5($kodam1->nama . $kodam2->nama), 0, 5)) % 101;
            
            $prompt = "Si '{$request->nama_1}' (dijaga khodam '{$kodam1->nama}') berpasangan dengan si '{$request->nama_2}' (dijaga khodam '{$kodam2->nama}'). Tingkat kecocokan mereka {$matchVal}%. Berikan 1 kalimat komentar sarkas nan kocak ala dukun soal hubungan mereka ini.";
            $matchDesc = $this->callGroq($prompt, 80);

            \App\Models\History::create([
                'nama' => $request->nama_1 . ' & ' . $request->nama_2,
                'kodam_nama' => "Jodoh"
            ]);

            list($histories, $hallOfFame, $hallOfShame, $topSesajen) = $this->getGlobalData();

            $promptRamalan = "Beri 1 kalimat pendek ramalan nyeleneh hari ini untuk pasangan {$request->nama_1} & {$request->nama_2}.";
            $ramalan = $this->callGroq($promptRamalan, 50);

            return view('home', [
                'mode' => 'jodoh',
                'nama_1' => $request->nama_1,
                'nama_2' => $request->nama_2,
                'kodam1' => $kodam1,
                'kodam2' => $kodam2,
                'matchVal' => $matchVal,
                'matchDesc' => $matchDesc,
                'histories' => $histories,
                'hallOfFame' => $hallOfFame,
                'hallOfShame' => $hallOfShame,
                'topSesajen' => $topSesajen,
                'ramalan' => "Ramalan: " . $ramalan
            ]);

        } elseif ($mode === 'fusion') {
            $request->validate([
                'nama_1' => 'required|string|max:255',
                'nama_2' => 'required|string|max:255',
            ]);

            $kodam1 = Kodam::inRandomOrder()->first();
            $kodam2 = Kodam::inRandomOrder()->first();

            $prompt = "Gabungkan dua entitas khodam: '{$kodam1->nama}' dan '{$kodam2->nama}'. Ciptakan 1 nama mutan khodam sakti yang absurd dan lucu (maksimal 3 kata). Lalu beri 1 kalimat deskripsi kemampuannya yang konyol.";
            $result = $this->callGroq($prompt, 100);

            $parts = explode("\n", $result);
            $mutantName = trim($parts[0] ?? $kodam1->nama . " " . $kodam2->nama);
            $mutantDesc = trim($parts[1] ?? "Khodam ini terlalu absurd untuk dideskripsikan.");

            \App\Models\History::create([
                'nama' => $request->nama_1 . ' + ' . $request->nama_2,
                'kodam_nama' => "Fusion"
            ]);

            list($histories, $hallOfFame, $hallOfShame, $topSesajen) = $this->getGlobalData();

            return view('home', [
                'mode' => 'fusion',
                'nama_1' => $request->nama_1,
                'nama_2' => $request->nama_2,
                'kodam1' => $kodam1,
                'kodam2' => $kodam2,
                'mutantName' => $mutantName,
                'mutantDesc' => $mutantDesc,
                'histories' => $histories,
                'hallOfFame' => $hallOfFame,
                'hallOfShame' => $hallOfShame,
                'topSesajen' => $topSesajen
            ]);

        } elseif ($mode === 'battle') {
            $request->validate([
                'nama_1' => 'required|string|max:255',
                'nama_2' => 'required|string|max:255',
            ]);

            $kodam1 = Kodam::inRandomOrder()->first();
            $kodam2 = Kodam::inRandomOrder()->first();

            $power1 = hexdec(substr(md5($request->nama_1 . $kodam1->nama), 0, 4)) % 10000;
            $power2 = hexdec(substr(md5($request->nama_2 . $kodam2->nama), 0, 4)) % 10000;

            if ($power1 > $power2) {
                $winner = $request->nama_1;
                $winnerKodam = $kodam1->nama;
                $loser = $request->nama_2;
                $loserKodam = $kodam2->nama;
            } else {
                $winner = $request->nama_2;
                $winnerKodam = $kodam2->nama;
                $loser = $request->nama_1;
                $loserKodam = $kodam1->nama;
            }

            $prompt = "Khodam '{$winnerKodam}' milik '{$winner}' BARU SAJA MENANG TELAK melawan khodam '{$loserKodam}' milik '{$loser}' di arena gaib. Ceritakan dengan gaya lebay, nyeleneh, dan kocak (maksimal 2 kalimat) JURUS ANEH apa yang dipakai {$winnerKodam} buat mengalahkan {$loserKodam}!";
            $battleDesc = $this->callGroq($prompt, 100);

            \App\Models\History::create([
                'nama' => $request->nama_1 . ' vs ' . $request->nama_2,
                'kodam_nama' => "Battle"
            ]);

            $histories = \App\Models\History::latest()->take(5)->get();
            list($histories, $hallOfFame, $hallOfShame, $topSesajen) = $this->getGlobalData();

            return view('home', [
                'mode' => 'battle',
                'nama_1' => $request->nama_1,
                'nama_2' => $request->nama_2,
                'kodam1' => $kodam1,
                'kodam2' => $kodam2,
                'power1' => $power1,
                'power2' => $power2,
                'winner' => $winner,
                'loser' => $loser,
                'battleDesc' => $battleDesc,
                'histories' => $histories,
                'hallOfFame' => $hallOfFame,
                'hallOfShame' => $hallOfShame,
                'topSesajen' => $topSesajen
            ]);

        } else {
            $request->validate([
                'nama' => 'required|string|max:255',
            ]);

            $nameLower = strtolower(trim($request->nama));
            
            // Easter Eggs
            if (in_array($nameLower, ['ryaze', 'admin'])) {
                $kodam = new Kodam(['nama' => 'Penguasa Server (SSR)']);
                $rarity = 'SSR';
                $deskripsi = "Pawang bug dan penakluk DDOS. Siapa berani macem-macem, siap-siap IP-nya di-ban permanen ke neraka!";
                $ramalan = "Ramalan: Coba cek log server hari ini, ada yang diam-diam mencoba masuk hatimu.";
            } elseif (in_array($nameLower, ['jokowi', 'prabowo'])) {
                $kodam = new Kodam(['nama' => 'Naga Nusantara (SSR)']);
                $rarity = 'SSR';
                $deskripsi = "Aura wibawanya bikin semua setan langsung baris berbaris dan hormat senjata.";
                $ramalan = "Ramalan: Jangan lupa makan siang, urusan negara masih panjang.";
            } else {
                $kodam = Kodam::inRandomOrder()->first();
                
                $prompt = "Orang bernama '{$request->nama}' ternyata didampingi oleh khodam berwujud '{$kodam->nama}'.\nBerikan 2 hal (pisahkan dengan pemisah ||):\n1. Deskripsi lucu/sarkas soal sifat khodam ini ke '{$request->nama}' (1 kalimat)\n2. Ramalan kocak untuk '{$request->nama}' hari ini (1 kalimat)\nFormat wajib: Deskripsi || Ramalan";
                $result = $this->callGroq($prompt, 120);
                
                $parts = explode('||', $result);
                $deskripsi = trim($parts[0] ?? "Khodammu lagi asyik nongkrong di warkop depan.");
                $ramalanText = trim($parts[1] ?? "Jangan lupa nafas hari ini.");
                $ramalan = "Ramalan: " . $ramalanText;

                // Rarity Calculation
                $hashVal = hexdec(substr(md5($kodam->nama . "rarity"), 0, 5)) % 100;
                if ($hashVal < 5) {
                    $rarity = 'SSR'; 
                } elseif ($hashVal < 20) {
                    $rarity = 'Epic';
                } elseif ($hashVal < 50) {
                    $rarity = 'Rare';
                } else {
                    $rarity = 'Common';
                }
            }
            
            \App\Models\History::create([
                'nama' => $request->nama,
                'kodam_nama' => $kodam->nama
            ]);
            
            $histories = \App\Models\History::latest()->take(5)->get();
            list($histories, $hallOfFame, $hallOfShame, $topSesajen) = $this->getGlobalData();

            return view('home', [
                'mode' => 'single',
                'nama' => $request->nama, 
                'kodam' => $kodam, 
                'deskripsi' => $deskripsi,
                'rarity' => $rarity,
                'histories' => $histories,
                'hallOfFame' => $hallOfFame,
                'hallOfShame' => $hallOfShame,
                'topSesajen' => $topSesajen,
                'ramalan' => $ramalan
            ]);
        }
    }

    public function tambahSesajen($id)
    {
        $history = \App\Models\History::find($id);
        if ($history) {
            $history->increment('sesajen');
            return response()->json(['success' => true, 'sesajen' => $history->sesajen]);
        }
        return response()->json(['success' => false], 404);
    }

    public function addLimit(Request $request)
    {
        $ip = $request->ip();
        $today = date('Y-m-d');
        
        $limit = \App\Models\DailyLimit::where('ip_address', $ip)->where('date', $today)->first();
        if ($limit) {
            $limit->usage_count = max(0, $limit->usage_count - 3);
            $limit->save();
        }
        
        return response()->json(['success' => true]);
    }
}
