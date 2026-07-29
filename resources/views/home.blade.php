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
    
    <!-- Flowbite & Tailwind (Flowbite includes Tailwind) -->
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
        
        .glass-card:hover {
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.5), inset 0 0 25px rgba(236, 72, 153, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
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
        
        /* Modal tweaks */
        #kodamModal .bg-white {
            background: rgba(20, 15, 35, 0.8) !important;
            backdrop-filter: blur(16px);
            border: 1px solid rgba(139, 92, 246, 0.3);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.8), 0 0 20px rgba(236, 72, 153, 0.2);
        }
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
                    <p class="text-sm text-gray-400 mb-6 font-light">Hasil terawangan energi mistis untuk:</p>
                    <p class="text-2xl font-semibold text-white mb-6">{{ $nama }}</p>
                    
                    <div class="py-6 bg-black/30 rounded-xl border border-purple-500/20 mb-8 relative overflow-hidden">
                        <!-- Subtle glow behind the text -->
                        <div class="absolute inset-0 bg-gradient-to-b from-purple-500/10 to-pink-500/10 z-0"></div>
                        <svg class="mx-auto mb-3 w-10 h-10 text-pink-400 opacity-80 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        <p class="text-sm text-gray-400 mb-2 relative z-10">Kodam Pendamping:</p>
                        <p class="title-font text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-purple-400 relative z-10">
                            {{ $kodam->nama }}
                        </p>
                    </div>

                    <a href="{{ url('/') }}" class="inline-block mystic-btn w-full text-white font-semibold rounded-xl text-md px-5 py-3.5 focus:outline-none focus:ring-4 focus:ring-purple-500/50">
                        <span class="tracking-wide">Coba Nama Lain</span>
                    </a>
                @else
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

                    <script>
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
            </div>
        </div>
    </main>

    <footer class="mt-auto py-6 text-center text-sm text-gray-500/60 font-light z-10">
        &copy; {{ date('Y') }} Cek Kodam Online. Hanya untuk hiburan.
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
