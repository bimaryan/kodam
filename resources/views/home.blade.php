<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cek Kodam Online - Temukan Energi Mistismu</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- Flowbite & Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- html2canvas for Download feature -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        body {
            background-color: #050505;
            background-image: 
                radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(225,39%,30%,0.2) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(339,49%,30%,0.2) 0, transparent 50%);
            background-attachment: fixed;
            color: #e2e8f0;
            font-family: 'Outfit', sans-serif;
            overflow-x: hidden;
        }

        .mystic-bg {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: -1;
            background: url('https://www.transparenttextures.com/patterns/stardust.png');
            opacity: 0.3;
            animation: pulseBg 8s infinite alternate;
        }

        @keyframes pulseBg {
            0% { opacity: 0.2; }
            100% { opacity: 0.5; }
        }

        .glass-card {
            background: rgba(20, 15, 35, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37), inset 0 0 20px rgba(139, 92, 246, 0.1);
            border-radius: 24px;
            transition: all 0.4s ease;
        }

        .title-font {
            font-family: 'Cinzel', serif;
        }

        .mystic-input {
            background: rgba(0, 0, 0, 0.3) !important;
            border: 1px solid rgba(139, 92, 246, 0.3) !important;
            color: white !important;
            transition: all 0.3s;
        }
        
        .mystic-input:focus {
            border-color: rgba(236, 72, 153, 0.6) !important;
            box-shadow: 0 0 15px rgba(236, 72, 153, 0.3) !important;
        }

        .mystic-btn {
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            background-size: 200% 200%;
            transition: all 0.4s ease;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }
        
        .mystic-btn::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
            z-index: -1;
            transition: opacity 0.4s ease;
            opacity: 0;
        }

        .mystic-btn:hover::before {
            opacity: 1;
        }

        .tab-active {
            border-bottom-color: #ec4899;
            color: white;
            font-weight: 600;
        }
        .tab-inactive {
            border-bottom-color: transparent;
            color: #9ca3af;
        }

        /* Ambient floating orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            animation: floatOrb 10s infinite ease-in-out alternate;
        }
        .orb-1 { width: 300px; height: 300px; background: rgba(139, 92, 246, 0.15); top: 10%; left: 20%; }
        .orb-2 { width: 400px; height: 400px; background: rgba(236, 72, 153, 0.1); bottom: -10%; right: 10%; animation-delay: -5s; }

        @keyframes floatOrb {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(30px, -50px) scale(1.1); }
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(236, 72, 153, 0.2);
            border-top-color: #ec4899;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { 100% { transform: rotate(360deg); } }

        /* Rarity Styles */
        .border-SSR { border-color: rgba(234, 179, 8, 0.6); box-shadow: 0 0 25px rgba(239, 68, 68, 0.5); }
        .bg-SSR { background: linear-gradient(to bottom, rgba(239,68,68,0.1), rgba(234,179,8,0.15)); }
        .text-SSR { background: -webkit-linear-gradient(45deg, #ef4444, #eab308); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        
        .border-Epic { border-color: rgba(236, 72, 153, 0.5); box-shadow: 0 0 20px rgba(139, 92, 246, 0.4); }
        .bg-Epic { background: linear-gradient(to bottom, rgba(139,92,246,0.1), rgba(236,72,153,0.15)); }
        .text-Epic { background: -webkit-linear-gradient(45deg, #8b5cf6, #ec4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        
        .border-Rare { border-color: rgba(6, 182, 212, 0.5); box-shadow: 0 0 15px rgba(59, 130, 246, 0.3); }
        .bg-Rare { background: linear-gradient(to bottom, rgba(59,130,246,0.1), rgba(6,182,212,0.1)); }
        .text-Rare { background: -webkit-linear-gradient(45deg, #3b82f6, #06b6d4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        
        .border-Common { border-color: rgba(156, 163, 175, 0.3); box-shadow: 0 0 10px rgba(156, 163, 175, 0.1); }
        .bg-Common { background: linear-gradient(to bottom, rgba(156,163,175,0.05), rgba(209,213,219,0.05)); }
        .text-Common { background: -webkit-linear-gradient(45deg, #9ca3af, #d1d5db); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        /* HTML2Canvas Fixes for Text Gradients */
        body.exporting .bg-clip-text,
        body.exporting .text-transparent {
            background: none !important;
            -webkit-text-fill-color: initial !important;
            color: #ec4899 !important;
        }
        body.exporting h1.bg-clip-text {
            color: #ffffff !important;
        }
        body.exporting .text-SSR { background: none !important; -webkit-text-fill-color: initial !important; color: #eab308 !important; }
        body.exporting .text-Epic { background: none !important; -webkit-text-fill-color: initial !important; color: #ec4899 !important; }
        body.exporting .text-Rare { background: none !important; -webkit-text-fill-color: initial !important; color: #06b6d4 !important; }
        body.exporting .text-Common { background: none !important; -webkit-text-fill-color: initial !important; color: #d1d5db !important; }
    </style>
</head>

<body class="antialiased min-h-screen flex flex-col relative">
    <div class="mystic-bg"></div>
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
    </div>

    @include('navbar')

    <main class="flex-grow flex items-center justify-center px-4 py-12 w-full z-10 relative">

        <div class="w-full max-w-md">
            <div class="glass-card p-6 md:p-8 text-center relative overflow-hidden" id="captureCard">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 via-pink-500 to-purple-500 opacity-70"></div>
                
                <h1 class="title-font text-4xl font-bold mb-2 text-transparent bg-clip-text bg-gradient-to-br from-white to-gray-400">
                    Cek Kodam
                </h1>
                
                @if(isset($mode) && $mode === 'error')
                    <div class="py-10 px-4 text-center">
                        <svg class="w-20 h-20 mx-auto text-red-500 mb-4 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <h2 class="text-2xl font-bold text-white mb-2">Waduh!</h2>
                        <p class="text-pink-400 font-medium">{{ $error }}</p>
                    </div>
                @elseif(isset($mode) && $mode === 'single' && isset($kodam))
                    <!-- SINGLE RESULT -->
                    <p class="text-sm text-gray-400 mb-4 font-light">Hasil terawangan energi mistis untuk:</p>
                    <p class="text-2xl font-semibold text-white mb-4">{{ $nama }}</p>
                    
                    <div class="py-6 px-4 bg-black/40 rounded-xl border {{ 'border-'.$rarity }} {{ 'bg-'.$rarity }} mb-6 relative overflow-hidden">
                        <!-- Rarity Badge -->
                        <div class="absolute top-2 right-2 px-2 py-0.5 rounded text-xs font-bold bg-black/50 {{ 'text-'.$rarity }}">
                            {{ $rarity }}
                        </div>

                        <svg class="mx-auto mb-3 w-10 h-10 opacity-80" style="color: 
                            @if($rarity == 'SSR') #eab308 
                            @elseif($rarity == 'Epic') #ec4899 
                            @elseif($rarity == 'Rare') #06b6d4 
                            @else #d1d5db @endif;" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        <p class="text-sm text-gray-400 mb-1">Kodam Pendamping:</p>
                        <p class="title-font text-3xl font-bold mb-4 {{ 'text-'.$rarity }}">
                            {{ $kodam->nama }}
                        </p>
                        
                        <div class="relative z-10 border-t border-white/10 pt-4 mt-2 text-left">
                            <p class="text-sm text-gray-300 italic mb-2">"{{ $deskripsi }}"</p>
                            @if(isset($ramalan))
                            <div class="mt-3 p-3 bg-white/5 rounded-lg border border-white/10">
                                <p class="text-xs text-pink-400 font-bold mb-1 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                    Pesan Gaib Hari Ini:
                                </p>
                                <p class="text-sm text-gray-300">{{ $ramalan }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                @elseif(isset($mode) && $mode === 'jodoh' && isset($kodam1))
                    <!-- JODOH RESULT -->
                    <p class="text-sm text-gray-400 mb-4 font-light">Kecocokan Energi Khodam Pasangan:</p>
                    
                    <div class="flex justify-between items-center mb-6">
                        <div class="text-center w-5/12">
                            <p class="font-semibold text-white truncate" title="{{ $nama_1 }}">{{ $nama_1 }}</p>
                            <p class="text-xs text-pink-400 mt-1 truncate">{{ $kodam1->nama }}</p>
                        </div>
                        <div class="w-2/12 text-center text-xl font-bold text-gray-500">VS</div>
                        <div class="text-center w-5/12">
                            <p class="font-semibold text-white truncate" title="{{ $nama_2 }}">{{ $nama_2 }}</p>
                            <p class="text-xs text-pink-400 mt-1 truncate">{{ $kodam2->nama }}</p>
                        </div>
                    </div>

                    <div class="py-6 px-4 bg-black/40 rounded-xl border border-pink-500/30 bg-gradient-to-b from-purple-500/10 to-pink-500/10 mb-6 text-left">
                        <div class="text-center">
                            <p class="text-sm text-gray-400 mb-2">Persentase Kecocokan</p>
                            <p class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-purple-400 mb-4">
                                {{ $matchVal }}%
                            </p>
                            <div class="w-full bg-gray-700 rounded-full h-2.5 mb-4">
                                <div class="bg-gradient-to-r from-pink-500 to-purple-500 h-2.5 rounded-full" style="width: {{ $matchVal }}%"></div>
                            </div>
                        </div>
                        <div class="border-t border-white/10 pt-4 mt-2">
                            <p class="text-sm text-gray-300 font-medium italic">"{{ $matchDesc }}"</p>
                            @if(isset($ramalan))
                            <div class="mt-4 p-3 bg-white/5 rounded-lg border border-white/10">
                                <p class="text-xs text-pink-400 font-bold mb-1 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                    Nasihat Pasangan Hari Ini:
                                </p>
                                <p class="text-sm text-gray-300">{{ $ramalan }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                @elseif(isset($mode) && $mode === 'fusion' && isset($kodam1))
                    <!-- FUSION RESULT -->
                    <p class="text-sm text-gray-400 mb-4 font-light">Hasil Fusi Khodam Terlarang:</p>
                    
                    <div class="flex justify-between items-center mb-6">
                        <div class="text-center w-5/12">
                            <p class="font-semibold text-white truncate" title="{{ $nama_1 }}">{{ $nama_1 }}</p>
                            <p class="text-xs text-pink-400 mt-1 truncate">{{ $kodam1->nama }}</p>
                        </div>
                        <div class="w-2/12 text-center text-xl font-bold text-purple-500">
                            <svg class="w-8 h-8 mx-auto animate-spin" style="animation-duration: 3s;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </div>
                        <div class="text-center w-5/12">
                            <p class="font-semibold text-white truncate" title="{{ $nama_2 }}">{{ $nama_2 }}</p>
                            <p class="text-xs text-pink-400 mt-1 truncate">{{ $kodam2->nama }}</p>
                        </div>
                    </div>
                    
                    <div class="py-6 px-4 bg-black/60 rounded-xl border border-purple-500/50 bg-gradient-to-b from-purple-900/40 to-black mb-6 text-center shadow-[0_0_20px_rgba(168,85,247,0.3)]">
                        <p class="text-sm text-gray-400 mb-1">Melahirkan Mutan:</p>
                        <h3 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-500 mb-3">
                            {{ $mutantName }}
                        </h3>
                        <p class="text-sm text-gray-300 italic">"{{ $mutantDesc }}"</p>
                    </div>
                @elseif(isset($mode) && $mode === 'battle' && isset($kodam1))
                    <!-- BATTLE RESULT -->
                    <p class="text-sm text-gray-400 mb-4 font-light">Hasil Pertarungan Sengit Khodam:</p>
                    
                    <div class="flex justify-between items-stretch mb-6">
                        <div class="text-center flex-1 flex flex-col justify-between border {{ $power1 > $power2 ? 'border-yellow-500 shadow-[0_0_15px_rgba(234,179,8,0.4)]' : 'border-gray-700 opacity-50' }} p-3 rounded-xl bg-black/40 transition-all relative overflow-hidden">
                            @if($power1 > $power2)
                                <div class="absolute -top-1 -right-1 bg-yellow-500 text-black text-[10px] font-black px-2 py-0.5 rounded-bl-lg">WIN</div>
                            @endif
                            <p class="font-bold text-white text-sm truncate" title="{{ $nama_1 }}">{{ $nama_1 }}</p>
                            <p class="text-xs text-pink-400 mt-1 mb-2">{{ $kodam1->nama }}</p>
                            <p class="text-lg font-black mt-auto {{ $power1 > $power2 ? 'text-yellow-400' : 'text-gray-500' }}">{{ $power1 }} BP</p>
                        </div>
                        <div class="px-2 flex items-center justify-center text-3xl font-black text-red-500 italic" style="text-shadow: 2px 2px 0 #000, -1px -1px 0 #fff;">
                            VS
                        </div>
                        <div class="text-center flex-1 flex flex-col justify-between border {{ $power2 > $power1 ? 'border-yellow-500 shadow-[0_0_15px_rgba(234,179,8,0.4)]' : 'border-gray-700 opacity-50' }} p-3 rounded-xl bg-black/40 transition-all relative overflow-hidden">
                            @if($power2 > $power1)
                                <div class="absolute -top-1 -right-1 bg-yellow-500 text-black text-[10px] font-black px-2 py-0.5 rounded-bl-lg">WIN</div>
                            @endif
                            <p class="font-bold text-white text-sm truncate" title="{{ $nama_2 }}">{{ $nama_2 }}</p>
                            <p class="text-xs text-pink-400 mt-1 mb-2">{{ $kodam2->nama }}</p>
                            <p class="text-lg font-black mt-auto {{ $power2 > $power1 ? 'text-yellow-400' : 'text-gray-500' }}">{{ $power2 }} BP</p>
                        </div>
                    </div>

                    <div class="py-6 px-4 bg-black/60 rounded-xl border border-red-500/30 mb-6 relative overflow-hidden text-left">
                        <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/diagonal-stripes.png')] opacity-10 z-0"></div>
                        <div class="relative z-10">
                            <h3 class="text-xl font-bold mb-3 text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-yellow-600 flex items-center justify-center gap-2">
                                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path><path d="M4 22h16"></path><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path></svg>
                                Pemenang: {{ $winner }}!
                            </h3>
                            <p class="text-sm text-gray-300 leading-relaxed italic">"{{ $battleDesc }}"</p>
                        </div>
                    </div>
                @endif
                
                @if(!isset($mode) || (isset($mode) && !isset($kodam) && !isset($kodam1)))
                    <!-- FORMS -->
                    <div id="formSection">
                        <!-- TABS -->
                        <div class="flex justify-center border-b border-white/10 mb-6 whitespace-nowrap overflow-x-auto pb-1 no-scrollbar">
                            <button type="button" id="tabSingle" class="px-3 py-2 border-b-2 tab-active transition-colors text-sm font-medium" onclick="switchMode('single')">Personal</button>
                            <button type="button" id="tabJodoh" class="px-3 py-2 border-b-2 tab-inactive transition-colors text-sm font-medium" onclick="switchMode('jodoh')">Cek Jodoh</button>
                            <button type="button" id="tabFusion" class="px-3 py-2 border-b-2 tab-inactive transition-colors text-sm font-medium" onclick="switchMode('fusion')">Fusi Khodam</button>
                            <button type="button" id="tabBattle" class="px-3 py-2 border-b-2 tab-inactive transition-colors text-sm font-medium" onclick="switchMode('battle')">Adu Mekanik</button>
                        </div>

                        <!-- Single Form -->
                        <form method="POST" action="{{ url('/') }}" class="space-y-4 relative z-10 block" id="formSingle" novalidate>
                            @csrf
                            <input type="hidden" name="mode" value="single">
                            <div>
                                <input type="text" id="nama" name="nama" autocomplete="off"
                                    class="mystic-input text-center w-full px-4 py-3 rounded-xl text-lg placeholder-gray-500 focus:outline-none"
                                    placeholder="Ketik nama kamu...">
                                <div id="errorSingle" class="hidden mt-2 text-pink-500 text-sm font-medium">Nama tidak boleh kosong...</div>
                            </div>
                            <button type="submit" class="mystic-btn w-full text-white font-semibold rounded-xl text-md px-5 py-3.5 mt-2">Terawang Sekarang</button>
                        </form>

                        <!-- Jodoh Form -->
                        <form method="POST" action="{{ url('/') }}" class="space-y-4 relative z-10 hidden" id="formJodoh" novalidate>
                            @csrf
                            <input type="hidden" name="mode" value="jodoh">
                            <div class="flex gap-2">
                                <div class="w-1/2">
                                    <input type="text" id="jodoh_nama_1" name="nama_1" autocomplete="off"
                                        class="mystic-input text-center w-full px-3 py-3 rounded-xl text-sm placeholder-gray-500" placeholder="Nama Kamu">
                                </div>
                                <div class="w-1/2">
                                    <input type="text" id="jodoh_nama_2" name="nama_2" autocomplete="off"
                                        class="mystic-input text-center w-full px-3 py-3 rounded-xl text-sm placeholder-gray-500" placeholder="Nama Pasangan">
                                </div>
                            </div>
                            <div id="errorJodoh" class="hidden text-pink-500 text-sm font-medium">Kedua nama harus diisi...</div>
                            <button type="submit" class="mystic-btn w-full text-white font-semibold rounded-xl text-md px-5 py-3.5 mt-2">Cek Kecocokan</button>
                        </form>

                        <!-- Fusion Form -->
                        <form method="POST" action="{{ url('/') }}" class="space-y-4 relative z-10 hidden" id="formFusion" novalidate>
                            @csrf
                            <input type="hidden" name="mode" value="fusion">
                            <div class="flex gap-2">
                                <div class="w-1/2">
                                    <input type="text" id="fusion_nama_1" name="nama_1" autocomplete="off"
                                        class="mystic-input border-purple-500/50 text-center w-full px-3 py-3 rounded-xl text-sm placeholder-gray-500" placeholder="Bahan 1">
                                </div>
                                <div class="w-1/2">
                                    <input type="text" id="fusion_nama_2" name="nama_2" autocomplete="off"
                                        class="mystic-input border-purple-500/50 text-center w-full px-3 py-3 rounded-xl text-sm placeholder-gray-500" placeholder="Bahan 2">
                                </div>
                            </div>
                            <div id="errorFusion" class="hidden text-pink-500 text-sm font-medium">Kedua nama harus diisi...</div>
                            <button type="submit" class="w-full text-white font-bold rounded-xl text-md px-5 py-3.5 mt-2 transition-all bg-gradient-to-r from-purple-600 to-indigo-500 hover:from-indigo-500 hover:to-purple-600 shadow-[0_0_15px_rgba(168,85,247,0.5)] border border-purple-400 flex items-center justify-center gap-2">
                                Gabungkan Entitas!
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            </button>
                        </form>

                        <!-- Battle Form -->
                        <form method="POST" action="{{ url('/') }}" class="space-y-4 relative z-10 hidden" id="formBattle" novalidate>
                            @csrf
                            <input type="hidden" name="mode" value="battle">
                            <div class="flex gap-2">
                                <div class="w-1/2">
                                    <input type="text" id="battle_nama_1" name="nama_1" autocomplete="off"
                                        class="mystic-input border-red-500/50 text-center w-full px-3 py-3 rounded-xl text-sm placeholder-gray-500" placeholder="Penantang 1">
                                </div>
                                <div class="w-1/2">
                                    <input type="text" id="battle_nama_2" name="nama_2" autocomplete="off"
                                        class="mystic-input border-red-500/50 text-center w-full px-3 py-3 rounded-xl text-sm placeholder-gray-500" placeholder="Penantang 2">
                                </div>
                            </div>
                            <div id="errorBattle" class="hidden text-pink-500 text-sm font-medium">Kedua nama harus diisi...</div>
                            <button type="submit" class="w-full text-white font-bold rounded-xl text-md px-5 py-3.5 mt-2 transition-all bg-gradient-to-r from-red-600 to-orange-500 hover:from-orange-500 hover:to-red-600 shadow-[0_0_15px_rgba(239,68,68,0.5)] border border-red-400 flex items-center justify-center gap-2">
                                Mulai Pertarungan
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 17.5L3 6V3h3l11.5 11.5"></path><path d="M13 19l6-6"></path><path d="M16 16l4 4"></path><path d="M19 21l2-2"></path></svg>
                            </button>
                        </form>
                    </div>

                    <!-- FAKE LOADING SECTION -->
                    <div id="loadingSection" class="hidden py-8 flex flex-col items-center justify-center">
                        <div class="spinner mb-6" id="loadingSpinner"></div>
                        <p class="text-pink-400 font-medium animate-pulse text-lg title-font" id="loadingText">Mengumpulkan energi spiritual...</p>
                        <p class="text-xs text-gray-500 mt-2" id="loadingSubtext">Membuka gerbang dimensi gaib</p>
                    </div>

                    <script>
                        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                        function playWhoosh() {
                            if(audioCtx.state === 'suspended') audioCtx.resume();
                            const osc = audioCtx.createOscillator();
                            const gain = audioCtx.createGain();
                            osc.connect(gain);
                            gain.connect(audioCtx.destination);
                            osc.type = 'triangle';
                            osc.frequency.setValueAtTime(100, audioCtx.currentTime);
                            osc.frequency.exponentialRampToValueAtTime(400, audioCtx.currentTime + 1);
                            gain.gain.setValueAtTime(0, audioCtx.currentTime);
                            gain.gain.linearRampToValueAtTime(0.3, audioCtx.currentTime + 0.5);
                            gain.gain.linearRampToValueAtTime(0, audioCtx.currentTime + 1);
                            osc.start();
                            osc.stop(audioCtx.currentTime + 1);
                        }

                        function switchMode(mode) {
                            const tabs = ['Single', 'Jodoh', 'Fusion', 'Battle'];
                            tabs.forEach(t => {
                                const m = t.toLowerCase();
                                const isMatch = m === mode;
                                document.getElementById(`tab${t}`).className = isMatch 
                                    ? 'px-3 py-2 border-b-2 tab-active transition-colors text-sm font-medium' 
                                    : 'px-3 py-2 border-b-2 tab-inactive transition-colors text-sm font-medium';
                                
                                const form = document.getElementById(`form${t}`);
                                if(form) {
                                    if(isMatch) form.classList.remove('hidden');
                                    else form.classList.add('hidden');
                                }
                            });
                        }

                        function handleForm(e, mode) {
                            let isValid = true;
                            if (mode === 'jodoh') {
                                const n1 = document.getElementById('jodoh_nama_1');
                                const n2 = document.getElementById('jodoh_nama_2');
                                if (!n1.value.trim() || !n2.value.trim()) {
                                    document.getElementById('errorJodoh').classList.remove('hidden');
                                    isValid = false;
                                }
                            } else if (mode === 'fusion') {
                                const n1 = document.getElementById('fusion_nama_1');
                                const n2 = document.getElementById('fusion_nama_2');
                                if (!n1.value.trim() || !n2.value.trim()) {
                                    document.getElementById('errorFusion').classList.remove('hidden');
                                    isValid = false;
                                }
                                if (isValid) {
                                    document.getElementById('loadingSpinner').style.borderColor = "rgba(168, 85, 247, 0.2)";
                                    document.getElementById('loadingSpinner').style.borderTopColor = "#a855f7";
                                    document.getElementById('loadingText').className = "text-purple-500 font-bold animate-pulse text-lg title-font";
                                    document.getElementById('loadingText').innerText = "MENYATUKAN ENTITAS...";
                                    document.getElementById('loadingSubtext').innerText = "Menggabungkan dua aura gaib menjadi satu mutan...";
                                }
                            } else if (mode === 'battle') {
                                const n1 = document.getElementById('battle_nama_1');
                                const n2 = document.getElementById('battle_nama_2');
                                if (!n1.value.trim() || !n2.value.trim()) {
                                    document.getElementById('errorBattle').classList.remove('hidden');
                                    isValid = false;
                                }
                                if (isValid) {
                                    // Make battle loading look aggressive
                                    document.getElementById('loadingSpinner').style.borderColor = "rgba(239, 68, 68, 0.2)";
                                    document.getElementById('loadingSpinner').style.borderTopColor = "#ef4444";
                                    document.getElementById('loadingText').className = "text-red-500 font-bold animate-pulse text-lg title-font";
                                    document.getElementById('loadingText').innerText = "MENYIAPKAN ARENA PERTARUNGAN...";
                                    document.getElementById('loadingSubtext').innerText = "Memanggil khodam masing-masing pihak...";
                                }
                            } else {
                                const n = document.getElementById('nama');
                                if (!n.value.trim()) {
                                    document.getElementById('errorSingle').classList.remove('hidden');
                                    isValid = false;
                                }
                            }

                            if (!isValid) {
                                e.preventDefault();
                            } else {
                                e.preventDefault();
                                document.getElementById('formSection').classList.add('hidden');
                                document.getElementById('loadingSection').classList.remove('hidden');
                                playWhoosh();
                                
                                setTimeout(() => { 
                                    e.target.submit(); 
                                }, 2500);
                            }
                        }

                        const fs = document.getElementById('formSingle');
                        const fj = document.getElementById('formJodoh');
                        const ff = document.getElementById('formFusion');
                        const fb = document.getElementById('formBattle');
                        if(fs) fs.addEventListener('submit', (e) => handleForm(e, 'single'));
                        if(fj) fj.addEventListener('submit', (e) => handleForm(e, 'jodoh'));
                        if(ff) ff.addEventListener('submit', (e) => handleForm(e, 'fusion'));
                        if(fb) fb.addEventListener('submit', (e) => handleForm(e, 'battle'));
                    </script>
                    
                    <style>
                        /* Hide scrollbar for tab list */
                        .no-scrollbar::-webkit-scrollbar { display: none; }
                        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
                    </style>
                @endif
            </div>

            <!-- RESULT ACTION BUTTONS -->
            @if(isset($mode) && (isset($kodam) || isset($kodam1)))
                <!-- Hide action buttons from html2canvas by putting them outside #captureCard -->
                <div class="mt-4 flex flex-col gap-3">
                    
                    <!-- SHARE BUTTONS -->
                    <div class="flex gap-3 justify-center mt-2">
                        <a href="https://api.whatsapp.com/send?text=Astaga!%20Khodamku%20ternyata%20adalah%20*{{ urlencode($kodam->nama ?? 'Sangat Gaib') }}*.%0A%0ACek%20khodammu%20di%20{{ urlencode(url('/')) }}" target="_blank" class="flex-1 py-2.5 bg-[#25D366] text-white rounded-xl flex items-center justify-center gap-2 hover:bg-[#128C7E] transition-all text-sm font-medium shadow-lg">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.029 18.88c-1.161 0-2.305-.292-3.318-.844l-3.677.964.984-3.595c-.607-1.052-.927-2.246-.926-3.468.001-3.825 3.113-6.937 6.937-6.937 3.825.001 6.938 3.113 6.939 6.937-.001 3.824-3.113 6.936-6.939 6.943z"></path></svg>
                            WhatsApp
                        </a>
                        <a href="https://twitter.com/intent/tweet?text=Astaga!%20Khodamku%20ternyata%20adalah%20*{{ urlencode($kodam->nama ?? 'Sangat Gaib') }}*.%0A%0ACek%20khodammu%20di%20{{ urlencode(url('/')) }}" target="_blank" class="flex-1 py-2.5 bg-black text-white rounded-xl flex items-center justify-center gap-2 hover:bg-gray-800 transition-all text-sm font-medium border border-gray-700 shadow-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></svg>
                            X / Twitter
                        </a>
                    </div>

                    @if($mode === 'single')
                    <div class="flex gap-2">
                        <button onclick="downloadCard('square')" class="flex-1 py-3 bg-white/10 hover:bg-white/20 border border-white/20 text-white rounded-xl flex items-center justify-center gap-2 transition-all font-medium text-sm shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Post IG
                        </button>
                        <button onclick="downloadCard('story')" class="flex-1 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-pink-600 hover:to-purple-600 border border-pink-500/50 text-white rounded-xl flex items-center justify-center gap-2 transition-all font-medium text-sm shadow-[0_0_15px_rgba(236,72,153,0.3)]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            Story IG/TikTok
                        </button>
                    </div>
                    @else
                    <button onclick="downloadCard('square')" class="w-full py-3 bg-white/10 hover:bg-white/20 border border-white/20 text-white rounded-xl flex items-center justify-center gap-2 transition-all font-medium shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Download Sertifikat
                    </button>
                    @endif
                    
                    <a href="{{ url('/') }}" class="inline-block mystic-btn w-full text-center text-white font-semibold rounded-xl px-5 py-3 shadow-lg mb-2">
                        Coba Nama Lain
                    </a>
                    
                    @if($mode === 'single')
                    <a href="{{ url('/chat') }}?nama={{ urlencode($nama) }}&kodam={{ urlencode($kodam->nama) }}" class="inline-flex items-center justify-center w-full text-center text-white font-semibold rounded-xl px-5 py-3 shadow-lg mb-2 gap-2 mt-2 transition-all hover:scale-[1.02]" style="background: linear-gradient(45deg, #db2777, #9333ea);">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 10h.01"></path><path d="M15 10h.01"></path><path d="M12 2a8 8 0 0 0-8 8v12l3-3 2.5 2.5L12 19l2.5 2.5L17 19l3 3V10a8 8 0 0 0-8-8z"></path></svg>
                        Ngobrol Bareng Khodam
                    </a>
                    @endif
                </div>

                <!-- HIDDEN TEMPLATES FOR CERTIFICATE DOWNLOADS -->
                @if(isset($mode) && $mode === 'single' && isset($kodam))
                <!-- Square (1:1 / 4:5 ish) Template -->
                <div id="certificateTemplateSingle" style="position: absolute; left: -9999px; top: -9999px; width: 600px; padding: 40px; background: #0f0a18; color: #fff; font-family: 'Outfit', sans-serif; text-align: center; border: 8px solid #ec4899; border-radius: 20px;">
                    <h1 style="font-family: 'Cinzel', serif; font-size: 3rem; font-weight: bold; margin-bottom: 10px; color: #fff;">Sertifikat Khodam</h1>
                    <p style="font-size: 1.2rem; color: #cbd5e1; margin-bottom: 40px;">Diberikan secara gaib kepada:</p>
                    <p style="font-size: 2.5rem; font-weight: bold; margin-bottom: 10px; color: #fff;">{{ $nama }}</p>
                    <div style="margin: 30px auto; padding: 30px; border: 2px solid rgba(255,255,255,0.2); border-radius: 20px; background: rgba(0,0,0,0.5);">
                        <p style="font-size: 1.2rem; color: #9ca3af; margin-bottom: 10px;">Entitas Pendamping:</p>
                        <p style="font-family: 'Cinzel', serif; font-size: 3.5rem; font-weight: bold; margin-bottom: 20px;" id="certKodamName">{{ $kodam->nama }}</p>
                        <div style="display: inline-block; padding: 5px 20px; background: rgba(0,0,0,0.8); border-radius: 5px; font-weight: bold; font-size: 1.5rem; margin-bottom: 20px;" id="certRarity">RANK: {{ $rarity }}</div>
                        <p style="font-size: 1.2rem; color: #e2e8f0; font-style: italic;">"{{ $deskripsi }}"</p>
                    </div>
                    <div style="margin-top: 40px; font-size: 1rem; color: #9ca3af;">
                        <p>Di-generate oleh <strong>Cek Kodam Online</strong></p>
                        <p class="flex items-center justify-center gap-1">Crafted with <svg class="w-3 h-3 text-[#ec4899]" fill="currentColor" viewBox="0 0 24 24"><path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"></path></svg> by <strong style="color: #ec4899;">Ryaze.my.id</strong></p>
                    </div>
                </div>
                <!-- Story (9:16) Template -->
                <div id="certificateTemplateStory" style="position: absolute; left: -9999px; top: -9999px; width: 1080px; height: 1920px; padding: 80px; background: linear-gradient(135deg, #0f0a18 0%, #1a1025 100%); color: #fff; font-family: 'Outfit', sans-serif; text-align: center; border: 20px solid #ec4899; border-radius: 40px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <div style="position: absolute; top: 10%; left: 10%; width: 300px; height: 300px; background: rgba(236,72,153,0.3); filter: blur(100px); border-radius: 50%;"></div>
                    <div style="position: absolute; bottom: 10%; right: 10%; width: 400px; height: 400px; background: rgba(139,92,246,0.2); filter: blur(120px); border-radius: 50%;"></div>
                    
                    <h1 style="font-family: 'Cinzel', serif; font-size: 5rem; font-weight: bold; margin-bottom: 20px; color: #fff; z-index: 10;">Cek Khodam 2026</h1>
                    <p style="font-size: 2rem; color: #cbd5e1; margin-bottom: 80px; z-index: 10;">Hasil Terawangan Akurat 99%</p>
                    
                    <div style="width: 100%; margin: 0 auto; padding: 60px; border: 4px solid rgba(255,255,255,0.2); border-radius: 40px; background: rgba(0,0,0,0.6); box-shadow: 0 20px 50px rgba(0,0,0,0.5); z-index: 10; backdrop-filter: blur(20px);">
                        <p style="font-size: 2rem; color: #9ca3af; margin-bottom: 20px;">Nama Korban:</p>
                        <p style="font-size: 4.5rem; font-weight: bold; margin-bottom: 60px; color: #fff; text-transform: uppercase;">{{ $nama }}</p>
                        
                        <div style="width: 80%; height: 2px; background: rgba(255,255,255,0.2); margin: 0 auto 60px auto;"></div>
                        
                        <p style="font-size: 2rem; color: #9ca3af; margin-bottom: 20px;">Dijaga Oleh:</p>
                        <p style="font-family: 'Cinzel', serif; font-size: 6rem; font-weight: bold; margin-bottom: 40px;" id="storyCertKodamName">{{ $kodam->nama }}</p>
                        
                        <div style="display: inline-block; padding: 15px 40px; background: rgba(0,0,0,0.8); border: 2px solid #fff; border-radius: 15px; font-weight: bold; font-size: 3rem; margin-bottom: 60px; text-transform: uppercase;" id="storyCertRarity">{{ $rarity }} RANK</div>
                        
                        <p style="font-size: 2.2rem; color: #e2e8f0; font-style: italic; line-height: 1.5; padding: 0 40px;">"{{ $deskripsi }}"</p>
                    </div>
                    
                    <div style="margin-top: 100px; font-size: 2rem; color: #9ca3af; z-index: 10; padding: 40px; background: rgba(0,0,0,0.5); border-radius: 20px;">
                        <p style="margin-bottom: 20px;">Berani cek khodammu sendiri?</p>
                        <p>Kunjungi <strong style="color: #ec4899; font-size: 2.5rem;">kodam.ryz.my.id</strong></p>
                    </div>
                </div>

                @elseif(isset($mode) && $mode === 'couple' && isset($kodam1))
                <div id="certificateTemplateCouple" style="position: absolute; left: -9999px; top: -9999px; width: 600px; padding: 40px; background: #0f0a18; color: #fff; font-family: 'Outfit', sans-serif; text-align: center; border: 8px solid #ec4899; border-radius: 20px;">
                    <h1 style="font-family: 'Cinzel', serif; font-size: 2.5rem; font-weight: bold; margin-bottom: 10px; color: #fff;">Sertifikat Kecocokan Gaib</h1>
                    <p style="font-size: 1.2rem; color: #cbd5e1; margin-bottom: 40px;">Hasil Terawangan Pasangan:</p>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                        <div style="width: 45%;">
                            <p style="font-size: 1.8rem; font-weight: bold; color: #fff;">{{ $nama_1 }}</p>
                            <p style="font-size: 1.2rem; color: #eab308; margin-top: 10px;">{{ $kodam1->nama }}</p>
                        </div>
                        <div style="width: 10%; font-size: 2.5rem; font-weight: bold; color: #6b7280;">VS</div>
                        <div style="width: 45%;">
                            <p style="font-size: 1.8rem; font-weight: bold; color: #fff;">{{ $nama_2 }}</p>
                            <p style="font-size: 1.2rem; color: #eab308; margin-top: 10px;">{{ $kodam2->nama }}</p>
                        </div>
                    </div>
                    <div style="margin: 30px auto; padding: 30px; border: 2px solid rgba(255,255,255,0.2); border-radius: 20px; background: rgba(0,0,0,0.5);">
                        <p style="font-size: 1.2rem; color: #9ca3af; margin-bottom: 10px;">Tingkat Kecocokan Khodam:</p>
                        <p style="font-size: 5rem; font-weight: bold; margin-bottom: 20px; color: #ec4899;">{{ $matchVal }}%</p>
                        <p style="font-size: 1.2rem; color: #e2e8f0; font-style: italic;">"{{ $matchDesc }}"</p>
                    </div>
                    <div style="margin-top: 40px; font-size: 1rem; color: #9ca3af;">
                        <p>Di-generate oleh <strong>Cek Kodam Online</strong></p>
                        <p class="flex items-center justify-center gap-1">Crafted with <svg class="w-3 h-3 text-[#ec4899]" fill="currentColor" viewBox="0 0 24 24"><path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"></path></svg> by <strong style="color: #ec4899;">Ryaze.my.id</strong></p>
                    </div>
                </div>

                @elseif(isset($mode) && $mode === 'battle' && isset($kodam1))
                <div id="certificateTemplateBattle" style="position: absolute; left: -9999px; top: -9999px; width: 600px; padding: 40px; background: #0a0505; color: #fff; font-family: 'Outfit', sans-serif; text-align: center; border: 8px solid #ef4444; border-radius: 20px;">
                    <h1 style="font-family: 'Cinzel', serif; font-size: 2.5rem; font-weight: bold; margin-bottom: 10px; color: #ef4444; text-transform: uppercase;">Sertifikat Adu Mekanik</h1>
                    <p style="font-size: 1.2rem; color: #cbd5e1; margin-bottom: 40px;">Hasil Pertarungan Berdarah:</p>
                    <div style="display: flex; justify-content: space-between; align-items: stretch; margin-bottom: 30px;">
                        <div style="width: 45%; padding: 20px; border: 2px solid {{ $power1 > $power2 ? '#eab308' : '#374151' }}; border-radius: 10px; background: rgba(0,0,0,0.5); position: relative;">
                            @if($power1 > $power2) <div style="position: absolute; top: -15px; right: -15px; background: #eab308; color: #000; padding: 5px 10px; font-weight: bold; border-radius: 5px; font-size: 0.8rem;">WINNER</div> @endif
                            <p style="font-size: 1.5rem; font-weight: bold; color: #fff;">{{ $nama_1 }}</p>
                            <p style="font-size: 1rem; color: #ec4899; margin-top: 10px;">{{ $kodam1->nama }}</p>
                            <p style="font-size: 1.8rem; font-weight: bold; color: {{ $power1 > $power2 ? '#eab308' : '#6b7280' }}; margin-top: 20px;">{{ $power1 }} BP</p>
                        </div>
                        <div style="width: 10%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: bold; color: #ef4444; font-style: italic;">VS</div>
                        <div style="width: 45%; padding: 20px; border: 2px solid {{ $power2 > $power1 ? '#eab308' : '#374151' }}; border-radius: 10px; background: rgba(0,0,0,0.5); position: relative;">
                            @if($power2 > $power1) <div style="position: absolute; top: -15px; right: -15px; background: #eab308; color: #000; padding: 5px 10px; font-weight: bold; border-radius: 5px; font-size: 0.8rem;">WINNER</div> @endif
                            <p style="font-size: 1.5rem; font-weight: bold; color: #fff;">{{ $nama_2 }}</p>
                            <p style="font-size: 1rem; color: #ec4899; margin-top: 10px;">{{ $kodam2->nama }}</p>
                            <p style="font-size: 1.8rem; font-weight: bold; color: {{ $power2 > $power1 ? '#eab308' : '#6b7280' }}; margin-top: 20px;">{{ $power2 }} BP</p>
                        </div>
                    </div>
                    <div style="margin: 30px auto; padding: 30px; border: 2px solid rgba(239,68,68,0.5); border-radius: 20px; background: rgba(239,68,68,0.1);">
                        <p style="font-size: 1.8rem; font-weight: bold; color: #eab308; margin-bottom: 15px;">Pemenang Mutlak: {{ $winner }}!</p>
                        <p style="font-size: 1.2rem; color: #e2e8f0; font-style: italic;">"{{ $battleDesc }}"</p>
                    </div>
                    <div style="margin-top: 40px; font-size: 1rem; color: #9ca3af;">
                        <p>Di-generate oleh <strong>Cek Kodam Online</strong></p>
                        <p class="flex items-center justify-center gap-1 mt-1">Crafted with <svg class="w-3 h-3 text-[#ec4899]" fill="currentColor" viewBox="0 0 24 24"><path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"></path></svg> by <strong style="color: #ec4899;">Ryaze.my.id</strong></p>
                    </div>
                </div>
                @endif

                <script>
                    (function() {
                        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                        if(audioCtx.state === 'suspended') audioCtx.resume();
                        const osc = audioCtx.createOscillator();
                        const gain = audioCtx.createGain();
                        osc.connect(gain);
                        gain.connect(audioCtx.destination);
                        osc.type = 'sine';
                        
                        const mode = '{{ $mode ?? "" }}';
                        if (mode === 'battle') {
                            // aggressive sound
                            osc.type = 'square';
                            osc.frequency.setValueAtTime(100, audioCtx.currentTime);
                            osc.frequency.linearRampToValueAtTime(300, audioCtx.currentTime + 0.2);
                            osc.frequency.linearRampToValueAtTime(50, audioCtx.currentTime + 1);
                        } else if (mode === 'couple') {
                            osc.frequency.setValueAtTime(300, audioCtx.currentTime);
                            osc.frequency.exponentialRampToValueAtTime(100, audioCtx.currentTime + 1.5);
                        } else {
                            osc.frequency.setValueAtTime(150, audioCtx.currentTime);
                            osc.frequency.exponentialRampToValueAtTime(40, audioCtx.currentTime + 3);
                        }
                        
                        gain.gain.setValueAtTime(0.5, audioCtx.currentTime);
                        gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 3);
                        osc.start();
                        osc.stop(audioCtx.currentTime + 3);
                    })();

                    function downloadCard(format = 'square') {
                        const mode = '{{ $mode ?? "" }}';
                        let certId = 'certificateTemplateSingle';
                        
                        if (mode === 'couple') certId = 'certificateTemplateCouple';
                        else if (mode === 'battle') certId = 'certificateTemplateBattle';
                        else if (mode === 'single' && format === 'story') certId = 'certificateTemplateStory';
                        
                        const cert = document.getElementById(certId);
                        if (!cert) return;

                        if (mode === 'single') {
                            const rarity = '{{ $rarity ?? "" }}';
                            
                            let hex = '#d1d5db'; // common
                            if (rarity === 'SSR') hex = '#eab308';
                            if (rarity === 'Epic') hex = '#ec4899';
                            if (rarity === 'Rare') hex = '#06b6d4';
                            
                            cert.style.borderColor = hex;
                            if(format === 'square') {
                                document.getElementById('certKodamName').style.color = hex; 
                                document.getElementById('certRarity').style.color = hex; 
                            } else if (format === 'story') {
                                document.getElementById('storyCertKodamName').style.color = hex; 
                                document.getElementById('storyCertRarity').style.color = hex; 
                                document.getElementById('storyCertRarity').style.borderColor = hex; 
                            }
                        }
                        
                        document.body.classList.add('exporting');
                        
                        html2canvas(cert, {
                            backgroundColor: mode === 'battle' ? '#0a0505' : "#0f0a18",
                            scale: format === 'story' ? 1 : 2 // 1 scale for story is enough (1080p width)
                        }).then(canvas => {
                            document.body.classList.remove('exporting');
                            const link = document.createElement('a');
                            
                            let filename = 'Sertifikat-Khodam.png';
                            if (mode === 'couple') filename = 'Kecocokan-Khodam-{{ $nama_1 ?? "" }}-{{ $nama_2 ?? "" }}.png';
                            else if (mode === 'battle') filename = 'Battle-Khodam-{{ $nama_1 ?? "" }}-vs-{{ $nama_2 ?? "" }}.png';
                            else filename = (format === 'story' ? 'Story-' : 'Square-') + 'Khodam-{{ $nama ?? "Anda" }}.png';
                            
                            link.download = filename;
                            link.href = canvas.toDataURL('image/png');
                            link.click();
                        });
                    }
                </script>
            @endif

            <!-- RIWAYAT TERAWANGAN & SESAJEN -->
            @if(isset($histories) && count($histories) > 0)
            <div class="mt-10 text-left border-t border-white/10 pt-6 px-2" id="historyListContainer">
                <h3 class="text-sm font-medium text-gray-400 mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Terawangan Terakhir (Live)
                </h3>
                <div class="space-y-3">
                    @foreach($histories as $h)
                    <div class="flex justify-between items-center text-sm bg-black/30 p-3 rounded-lg border border-white/5 shadow-inner">
                        <div class="overflow-hidden flex-grow mr-2">
                            <p class="text-gray-300 font-medium truncate">{{ $h->nama }}</p>
                            <p class="text-pink-400 font-bold truncate text-xs">{{ $h->kodam_nama }}</p>
                        </div>
                        <button onclick="giveSesajen({{ $h->id }}, this)" class="shrink-0 flex items-center gap-1 bg-white/5 hover:bg-white/10 px-2 py-1 rounded-md border border-white/10 transition-colors">
                            <span>
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M17 8h1a4 4 0 1 1 0 8h-1"></path><path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4Z"></path><path d="M6 2v2"></path><path d="M10 2v2"></path><path d="M14 2v2"></path></svg>
                            </span>
                            <span class="text-xs font-semibold text-gray-300 sesajen-count">{{ $h->sesajen ?? 0 }}</span>
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- PROMO RYAZE.MY.ID (Outside IF block) -->
            <div class="mt-8 p-4 rounded-xl border border-pink-500/30 bg-pink-500/10 text-sm text-center mx-2">
                <p class="text-gray-300 font-medium mb-1">
                    <span class="flex items-center gap-1 justify-center"><svg class="w-4 h-4 text-pink-500 inline" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2l.5-.5a5.4 5.4 0 0 0 1-1.5c1.6-1.6 4.6-5 6-6.5a4.24 4.24 0 0 0 .5-6 4.24 4.24 0 0 0-6 .5c-1.5 1.4-4.9 4.4-6.5 6a5.4 5.4 0 0 0-1.5 1l-.5.5Z"></path><path d="m12 15 3.5 3.5"></path><path d="m9 12-3.5-3.5"></path></svg> Butuh layanan Hosting Premium, Tunneling, atau pembuatan APK?</span>
                </p>
                <a href="https://ryaze.my.id" target="_blank" class="text-pink-400 font-bold hover:text-pink-300 transition-colors underline decoration-pink-500/50 underline-offset-4">
                    Kunjungi Ryaze.my.id sekarang!
                </a>
            </div>

            <script>
                function giveSesajen(id, btn) {
                    fetch(`/history/${id}/sesajen`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(r => r.json())
                    .then(data => {
                        if(data.success) {
                            const countSpan = btn.querySelector('.sesajen-count');
                            countSpan.innerText = data.sesajen;
                            btn.classList.add('bg-pink-500/20', 'border-pink-500/50');
                            setTimeout(() => {
                                btn.classList.remove('bg-pink-500/20', 'border-pink-500/50');
                            }, 500);
                        }
                    });
                }

                if (window.pollingInterval) clearInterval(window.pollingInterval);
                window.pollingInterval = setInterval(() => {
                    fetch('{{ url("/") }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(res => res.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newHistory = doc.getElementById('historyListContainer');
                        const oldHistory = document.getElementById('historyListContainer');
                        if(newHistory && oldHistory) {
                            oldHistory.innerHTML = newHistory.innerHTML;
                        }
                    });
                }, 5000); // 5 seconds polling
            </script>
            @endif

        </div>
    </main>

    <footer class="mt-auto py-6 text-center text-sm text-gray-500/60 font-light z-10">
        &copy; {{ date('Y') }} Cek Kodam Online. Crafted with <svg class="w-3 h-3 text-pink-500 inline mx-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"></path></svg> by <a href="https://ryaze.my.id" target="_blank" class="hover:text-pink-400 transition-colors font-medium">Ryaze.my.id</a>.
    </footer>


    <!-- Hall of Fame Modal -->
    <div id="hof-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative rounded-2xl shadow border border-yellow-500/50 bg-gray-900/95 backdrop-blur-xl">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-yellow-500/20 rounded-t">
                    <h3 class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-yellow-600 title-font flex items-center gap-2">
                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path><path d="M4 22h16"></path><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path></svg>
                        Papan Atas Gacha
                    </h3>
                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="hof-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <p class="text-sm font-light text-gray-400 mb-4 text-center">Berikut adalah daftar para penguasa beruntung yang baru saja mendapatkan Khodam SSR atau Epic!</p>
                    <ul class="space-y-3">
                        @if(isset($hallOfFame) && count($hallOfFame) > 0)
                            @foreach($hallOfFame as $hof)
                                <li class="flex items-center p-3 rounded-lg bg-black/50 border {{ $hof->rarity === 'SSR' ? 'border-yellow-500 shadow-[0_0_10px_rgba(234,179,8,0.2)]' : 'border-pink-500' }}">
                                    <div class="flex-1 min-w-0 ms-3">
                                        <p class="text-sm font-bold text-white truncate">{{ $hof->nama }}</p>
                                        <p class="text-xs text-gray-400 truncate">{{ $hof->kodam_nama }}</p>
                                    </div>
                                    <span class="inline-flex items-center bg-black/60 font-bold px-2.5 py-0.5 rounded text-xs {{ 'text-'.$hof->rarity }}">
                                        {{ $hof->rarity }}
                                    </span>
                                </li>
                            @endforeach
                        @else
                            <p class="text-center text-gray-500 italic text-sm">Belum ada pemain beruntung. Jadilah yang pertama!</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>



    <!-- Hall of Shame Modal -->
    <div id="hos-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative rounded-2xl shadow border border-gray-600/50 bg-gray-900/95 backdrop-blur-xl">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-600/20 rounded-t">
                    <h3 class="text-xl font-bold text-gray-300 title-font flex items-center gap-2">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M10 11v6M14 11v6"></path></svg>
                        Papan Ampas Gacha
                    </h3>
                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="hos-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <p class="text-sm font-light text-gray-400 mb-4 text-center">Berikut adalah daftar para beban server yang mendapatkan Khodam Common alias ampas!</p>
                    <ul class="space-y-3">
                        @if(isset($hallOfShame) && count($hallOfShame) > 0)
                            @foreach($hallOfShame as $hos)
                                <li class="flex items-center p-3 rounded-lg bg-black/50 border border-gray-700">
                                    <div class="flex-1 min-w-0 ms-3">
                                        <p class="text-sm font-bold text-gray-300 truncate">{{ $hos->nama }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ $hos->kodam_nama }}</p>
                                    </div>
                                    <span class="inline-flex items-center bg-gray-800 font-bold px-2.5 py-0.5 rounded text-xs text-gray-400">
                                        {{ $hos->rarity }}
                                    </span>
                                </li>
                            @endforeach
                        @else
                            <p class="text-center text-gray-500 italic text-sm">Belum ada pemain ampas. Syukurlah!</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Top Sesajen Modal -->
    <div id="top-sesajen-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative rounded-2xl shadow border border-orange-500/50 bg-gray-900/95 backdrop-blur-xl">
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-orange-500/20 rounded-t">
                    <h3 class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600 title-font flex items-center gap-2">
                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Sultan Khodam
                    </h3>
                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="top-sesajen-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <div class="p-4 md:p-5">
                    <p class="text-sm font-light text-gray-400 mb-4 text-center">Inilah jajaran Khodam yang paling banyak menerima sesajen dari pemujanya!</p>
                    <ul class="space-y-3">
                        @if(isset($topSesajen) && count($topSesajen) > 0)
                            @foreach($topSesajen as $index => $top)
                                <li class="flex items-center p-3 rounded-lg bg-black/50 border border-orange-500/30 {{ $index === 0 ? 'bg-orange-900/20 shadow-[0_0_15px_rgba(249,115,22,0.2)]' : '' }}">
                                    <div class="font-bold text-orange-400 text-lg mr-4">#{{ $index + 1 }}</div>
                                    <div class="flex-1 min-w-0 ms-1">
                                        <p class="text-sm font-bold text-white truncate">{{ $top->kodam_nama }}</p>
                                        <p class="text-xs text-gray-400 truncate">Pemilik: {{ $top->nama }}</p>
                                    </div>
                                    <span class="inline-flex items-center gap-1 bg-black/60 font-bold px-2.5 py-1 rounded-lg text-xs text-amber-500">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 8h1a4 4 0 1 1 0 8h-1M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4Z M6 2v2 M10 2v2 M14 2v2"></path></svg>
                                        {{ $top->sesajen }}
                                    </span>
                                </li>
                            @endforeach
                        @else
                            <p class="text-center text-gray-500 italic text-sm">Belum ada Khodam yang disembah.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Audio Manager -->
    <script>
        let audioEnabled = localStorage.getItem('audio_khodam') === 'true';
        window.bgm = new Audio('https://www.soundjay.com/nature/sounds/wind-howl-01.mp3');
        window.bgm.loop = true;
        window.bgm.volume = 0.3;
        
        // Cek kalau ada hasil, putar sfx
        @if(isset($mode) && !in_array($mode, ['error']))
            window.sfxJumpscare = new Audio('https://www.soundjay.com/misc/sounds/magic-chime-01.mp3');
            if(audioEnabled && window.sfxJumpscare) {
                window.sfxJumpscare.play().catch(e => console.log('Audio autoplay prevented'));
            }
        @endif

        function toggleAudio() {
            audioEnabled = !audioEnabled;
            localStorage.setItem('audio_khodam', audioEnabled);
            updateAudioUI();
            if (audioEnabled) {
                if (window.bgm && window.bgm.paused) window.bgm.play().catch(e => console.log(e));
            } else {
                if (window.bgm) window.bgm.pause();
            }
        }
        
        function updateAudioUI() {
            const icon = document.getElementById('audioIconLines');
            const text = document.getElementById('audioText');
            if (icon && text) {
                if (audioEnabled) {
                    icon.classList.remove('hidden');
                    text.innerText = 'Audio On';
                } else {
                    icon.classList.add('hidden');
                    text.innerText = 'Audio Off';
                }
            }
        }
        
        document.addEventListener('DOMContentLoaded', () => {
            updateAudioUI();
            if (audioEnabled) {
                window.bgm.play().catch(e => console.log('Audio autoplay prevented'));
            }
        });
    </script>

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
