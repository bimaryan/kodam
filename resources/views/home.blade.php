<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cek Kodam Online - Temukan Energi Mistismu</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- Flowbite & Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

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
        
        .mystic-btn:hover {
            box-shadow: 0 0 20px rgba(236, 72, 153, 0.6);
            transform: translateY(-2px);
        }

        /* Ambient floating orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            animation: floatOrb 10s infinite ease-in-out alternate;
        }
        .orb-1 {
            width: 300px; height: 300px;
            background: rgba(139, 92, 246, 0.15);
            top: 10%; left: 20%;
        }
        .orb-2 {
            width: 400px; height: 400px;
            background: rgba(236, 72, 153, 0.1);
            bottom: -10%; right: 10%;
            animation-delay: -5s;
        }

        @keyframes floatOrb {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(30px, -50px) scale(1.1); }
        }

        /* Spinner */
        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(236, 72, 153, 0.2);
            border-top-color: #ec4899;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</head>

<body class="antialiased min-h-screen flex flex-col">
    <div class="mystic-bg"></div>
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
    </div>

    @include('navbar')

    <main class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <div class="glass-card p-8 text-center relative overflow-hidden">
                <!-- decorative accent -->
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 via-pink-500 to-purple-500 opacity-70"></div>
                
                <h1 class="title-font text-4xl font-bold mb-2 text-transparent bg-clip-text bg-gradient-to-br from-white to-gray-400">
                    Cek Kodam
                </h1>
                
                @if(isset($kodam))
                    <!-- HASIL TERAWANGAN -->
                    <p class="text-sm text-gray-400 mb-6 font-light">Hasil terawangan energi mistis untuk:</p>
                    <p class="text-2xl font-semibold text-white mb-6">{{ $nama }}</p>
                    
                    <div class="py-6 px-4 bg-black/30 rounded-xl border border-purple-500/20 mb-6 relative overflow-hidden">
                        <!-- Subtle glow behind the text -->
                        <div class="absolute inset-0 bg-gradient-to-b from-purple-500/10 to-pink-500/10 z-0"></div>
                        <svg class="mx-auto mb-3 w-10 h-10 text-pink-400 opacity-80 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        <p class="text-sm text-gray-400 mb-2 relative z-10">Kodam Pendamping:</p>
                        <p class="title-font text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-purple-400 relative z-10 mb-4">
                            {{ $kodam->nama }}
                        </p>
                        
                        <!-- DESKRIPSI -->
                        <div class="relative z-10 border-t border-white/10 pt-4 mt-2">
                            <p class="text-sm text-gray-300 italic">"{{ $deskripsi ?? 'Energi kodam ini sangat misterius.' }}"</p>
                        </div>
                    </div>

                    <!-- SHARE BUTTONS -->
                    <div class="flex gap-3 justify-center mb-6">
                        <a href="https://api.whatsapp.com/send?text=Astaga!%20Kodam%20pendampingku%20ternyata%20adalah%20*{{ urlencode($kodam->nama) }}*.%0A%0A%22{{ urlencode($deskripsi ?? '') }}%22%0A%0ACek%20kodammu%20di%20{{ urlencode(url('/')) }}" target="_blank" class="flex-1 py-2.5 bg-[#25D366] text-white rounded-lg flex items-center justify-center gap-2 hover:bg-[#128C7E] transition-all text-sm font-medium">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.029 18.88c-1.161 0-2.305-.292-3.318-.844l-3.677.964.984-3.595c-.607-1.052-.927-2.246-.926-3.468.001-3.825 3.113-6.937 6.937-6.937 3.825.001 6.938 3.113 6.939 6.937-.001 3.824-3.113 6.936-6.939 6.943z"></path></svg>
                            WhatsApp
                        </a>
                        <a href="https://twitter.com/intent/tweet?text=Astaga!%20Kodam%20pendampingku%20ternyata%20adalah%20*{{ urlencode($kodam->nama) }}*.%0A%0ACek%20kodammu%20di%20{{ urlencode(url('/')) }}" target="_blank" class="flex-1 py-2.5 bg-black text-white rounded-lg flex items-center justify-center gap-2 hover:bg-gray-800 transition-all text-sm font-medium border border-gray-700">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></svg>
                            X / Twitter
                        </a>
                    </div>

                    <a href="{{ url('/') }}" class="inline-block mystic-btn w-full text-white font-semibold rounded-xl text-md px-5 py-3.5 focus:outline-none focus:ring-4 focus:ring-purple-500/50">
                        <span class="tracking-wide">Coba Nama Lain</span>
                    </a>

                    <!-- PLAY GONG SCRIPT -->
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                            if(audioCtx.state === 'suspended') audioCtx.resume();
                            const osc = audioCtx.createOscillator();
                            const gain = audioCtx.createGain();
                            osc.connect(gain);
                            gain.connect(audioCtx.destination);
                            osc.type = 'sine';
                            osc.frequency.setValueAtTime(150, audioCtx.currentTime);
                            osc.frequency.exponentialRampToValueAtTime(40, audioCtx.currentTime + 3);
                            gain.gain.setValueAtTime(0.5, audioCtx.currentTime);
                            gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 4);
                            osc.start();
                            osc.stop(audioCtx.currentTime + 4);
                        });
                    </script>

                @else
                    <!-- FORM INPUT -->
                    <div id="formSection">
                        <p class="text-sm text-gray-400 mb-8 font-light">Masukkan nama Anda untuk melihat entitas mistis yang mendampingi.</p>
                        
                        <form method="POST" action="{{ url('/') }}" class="space-y-6 relative z-10" id="kodamForm" novalidate>
                            @csrf
                            <div>
                                <input type="text" id="nama" name="nama" autocomplete="off"
                                    class="mystic-input text-center w-full px-4 py-3 rounded-xl text-lg placeholder-gray-500 focus:outline-none"
                                    placeholder="Ketik nama kamu...">
                                <!-- Custom Error Message -->
                                <div id="errorMessage" class="hidden mt-2 text-pink-500 text-sm font-medium">
                                    Nama tidak boleh kosong, wahai manusia...
                                </div>
                            </div>
                            
                            <button type="submit"
                                class="mystic-btn w-full text-white font-semibold rounded-xl text-md px-5 py-3.5 focus:outline-none focus:ring-4 focus:ring-purple-500/50 mt-4">
                                <span class="tracking-wide">Terawang Sekarang</span>
                            </button>
                        </form>
                    </div>

                    <!-- FAKE LOADING SECTION -->
                    <div id="loadingSection" class="hidden py-8 flex flex-col items-center justify-center">
                        <div class="spinner mb-6"></div>
                        <p class="text-pink-400 font-medium animate-pulse text-lg title-font">Mengumpulkan energi spiritual...</p>
                        <p class="text-xs text-gray-500 mt-2">Membuka gerbang dimensi gaib</p>
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

                        document.getElementById('kodamForm').addEventListener('submit', function(e) {
                            const namaInput = document.getElementById('nama');
                            const errorMessage = document.getElementById('errorMessage');
                            
                            if (namaInput.value.trim() === '') {
                                e.preventDefault();
                                
                                namaInput.style.borderColor = '#ec4899';
                                namaInput.classList.add('animate-pulse');
                                setTimeout(() => namaInput.classList.remove('animate-pulse'), 1000);
                                
                                errorMessage.classList.remove('hidden');
                                namaInput.focus();
                            } else {
                                e.preventDefault();
                                // Hide form, show loading
                                document.getElementById('formSection').classList.add('hidden');
                                document.getElementById('loadingSection').classList.remove('hidden');
                                
                                playWhoosh();

                                // Fake delay before actual submit
                                setTimeout(() => {
                                    e.target.submit();
                                }, 2500);
                            }
                        });

                        document.getElementById('nama').addEventListener('input', function() {
                            const errorMessage = document.getElementById('errorMessage');
                            this.style.borderColor = '';
                            if (this.value.trim() !== '') {
                                errorMessage.classList.add('hidden');
                            }
                        });
                    </script>
                @endif
                
                <!-- RIWAYAT TERAWANGAN -->
                @if(isset($histories) && count($histories) > 0)
                <div class="mt-10 text-left border-t border-white/10 pt-6">
                    <h3 class="text-sm font-medium text-gray-400 mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Terawangan Terakhir:
                    </h3>
                    <div class="space-y-3">
                        @foreach($histories as $h)
                        <div class="flex justify-between items-center text-sm bg-black/20 p-3 rounded-lg border border-white/5 shadow-inner">
                            <span class="text-gray-300 font-medium truncate max-w-[50%]">{{ $h->nama }}</span>
                            <span class="text-pink-400 font-bold truncate max-w-[45%] text-right">{{ $h->kodam_nama }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- PROMO RYAZE.MY.ID -->
                <div class="mt-6 p-4 rounded-xl border border-pink-500/30 bg-pink-500/10 text-sm">
                    <p class="text-gray-300 font-medium mb-1">
                        🚀 Butuh layanan Hosting Premium, Tunneling, atau pembuatan APK?
                    </p>
                    <a href="https://ryaze.my.id" target="_blank" class="text-pink-400 font-bold hover:text-pink-300 transition-colors underline decoration-pink-500/50 underline-offset-4">
                        Kunjungi Ryaze.my.id sekarang!
                    </a>
                </div>

            </div>
        </div>
    </main>

    <footer class="mt-auto py-6 text-center text-sm text-gray-500/60 font-light z-10">
        &copy; {{ date('Y') }} Cek Kodam Online. Crafted with 💜 by <a href="https://ryaze.my.id" target="_blank" class="hover:text-pink-400 transition-colors font-medium">Ryaze.my.id</a>.
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
