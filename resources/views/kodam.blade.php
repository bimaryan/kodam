<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REST API KODAM - Dokumentasi</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Outfit:wght@300;400;600&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Flowbite & Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background-color: #08080c;
            color: #e2e8f0;
            font-family: 'Outfit', sans-serif;
            background-image: 
                radial-gradient(at 100% 0%, hsla(253,16%,15%,0.3) 0, transparent 50%),
                radial-gradient(at 0% 100%, hsla(339,49%,15%,0.2) 0, transparent 50%);
            background-attachment: fixed;
        }

        .title-font {
            font-family: 'Cinzel', serif;
        }
        
        .code-font {
            font-family: 'Fira Code', monospace;
        }

        .glass-panel {
            background: rgba(20, 15, 30, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        }

        .code-block {
            background: #110d18;
            border: 1px solid #2a2235;
            border-radius: 12px;
            overflow: hidden;
        }
        
        .code-header {
            background: #1a1423;
            border-bottom: 1px solid #2a2235;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .mac-btn {
            width: 10px; height: 10px; border-radius: 50%;
        }
        
        .method-badge {
            font-size: 0.7rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 4px;
            letter-spacing: 0.5px;
        }
        
        .method-get { background: rgba(59, 130, 246, 0.2); color: #60a5fa; border: 1px solid rgba(59,130,246,0.3); }
        .method-post { background: rgba(16, 185, 129, 0.2); color: #34d399; border: 1px solid rgba(16,185,129,0.3); }

        pre { margin: 0; padding: 16px; font-size: 0.85rem; overflow-x: auto; color: #a599b5; }
        
        .json-key { color: #8b5cf6; }
        .json-string { color: #ec4899; }
        .json-number { color: #3b82f6; }
        
        /* Custom scrollbar for code blocks */
        pre::-webkit-scrollbar { height: 6px; }
        pre::-webkit-scrollbar-track { background: #110d18; }
        pre::-webkit-scrollbar-thumb { background: #2a2235; border-radius: 4px; }
        pre::-webkit-scrollbar-thumb:hover { background: #3d324d; }
    </style>
</head>

<body class="antialiased min-h-screen flex flex-col">
    @include('navbar')

    <main class="flex-grow pt-8 pb-12 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto w-full z-10">
        
        <div class="mb-12 text-center">
            <h1 class="title-font text-4xl md:text-5xl font-bold mb-4 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-500">
                API Dokumentasi
            </h1>
            <p class="text-gray-400 max-w-2xl mx-auto font-light text-lg">
                Integrasikan kehebatan Cek Kodam Online ke dalam aplikasi Anda melalui REST API yang cepat dan handal.
            </p>
        </div>

        <div class="glass-panel rounded-2xl p-6 md:p-8 mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-white flex items-center gap-2">
                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                Pengenalan
            </h2>
            <p class="text-gray-400 mb-6 leading-relaxed">
                Base URL untuk semua endpoint API ini adalah <code class="code-font bg-black/40 px-2 py-1 rounded text-purple-400 border border-white/5">http://127.0.0.1:8000/api</code>. Semua request dan response menggunakan format JSON.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- GET Endpoint -->
            <div class="glass-panel rounded-2xl p-6 md:p-8 flex flex-col h-full">
                <div class="flex items-center gap-3 mb-4">
                    <span class="method-badge method-get">GET</span>
                    <h3 class="text-xl font-semibold text-white">/kodam</h3>
                </div>
                <p class="text-gray-400 mb-6 text-sm flex-grow">Mengambil daftar seluruh Kodam yang tersedia di dalam database.</p>
                
                <div class="space-y-4 mt-auto">
                    <div>
                        <p class="text-sm text-gray-500 mb-2 font-medium">Contoh Request:</p>
                        <div class="code-block">
                            <div class="code-header">
                                <div class="mac-btn bg-red-500"></div><div class="mac-btn bg-yellow-500"></div><div class="mac-btn bg-green-500"></div>
                            </div>
                            <pre class="code-font">curl -X GET http://127.0.0.1:8000/api/kodam \
  -H "Accept: application/json"</pre>
                        </div>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-500 mb-2 font-medium">Response Sukses (200 OK):</p>
                        <div class="code-block">
                            <div class="code-header">
                                <div class="mac-btn bg-red-500"></div><div class="mac-btn bg-yellow-500"></div><div class="mac-btn bg-green-500"></div>
                            </div>
                            <pre class="code-font">[
  {
    <span class="json-key">"id"</span>: <span class="json-number">1</span>,
    <span class="json-key">"nama"</span>: <span class="json-string">"Macan Putih"</span>,
    <span class="json-key">"created_at"</span>: <span class="json-string">"2024-06-21T07:30:11.000000Z"</span>
  },
  {
    <span class="json-key">"id"</span>: <span class="json-number">2</span>,
    <span class="json-key">"nama"</span>: <span class="json-string">"Naga Api"</span>,
    <span class="json-key">"created_at"</span>: <span class="json-string">"2024-06-21T07:35:10.000000Z"</span>
  }
]</pre>
                        </div>
                    </div>
                </div>
            </div>

            <!-- POST Endpoint -->
            <div class="glass-panel rounded-2xl p-6 md:p-8 flex flex-col h-full">
                <div class="flex items-center gap-3 mb-4">
                    <span class="method-badge method-post">POST</span>
                    <h3 class="text-xl font-semibold text-white">/kodam</h3>
                </div>
                <p class="text-gray-400 mb-6 text-sm flex-grow">Menambahkan entitas Kodam baru ke dalam koleksi database mistis.</p>
                
                <div class="space-y-4 mt-auto">
                    <div>
                        <p class="text-sm text-gray-500 mb-2 font-medium">Contoh Request:</p>
                        <div class="code-block">
                            <div class="code-header">
                                <div class="mac-btn bg-red-500"></div><div class="mac-btn bg-yellow-500"></div><div class="mac-btn bg-green-500"></div>
                            </div>
                            <pre class="code-font">curl -X POST http://127.0.0.1:8000/api/kodam \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    <span class="json-key">"nama"</span>: <span class="json-string">"Kucing Oyen"</span>
  }'</pre>
                        </div>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-500 mb-2 font-medium">Response Sukses (201 Created):</p>
                        <div class="code-block">
                            <div class="code-header">
                                <div class="mac-btn bg-red-500"></div><div class="mac-btn bg-yellow-500"></div><div class="mac-btn bg-green-500"></div>
                            </div>
                            <pre class="code-font">{
  <span class="json-key">"id"</span>: <span class="json-number">1001</span>,
  <span class="json-key">"nama"</span>: <span class="json-string">"Kucing Oyen"</span>,
  <span class="json-key">"created_at"</span>: <span class="json-string">"2024-06-22T08:10:05.000000Z"</span>,
  <span class="json-key">"updated_at"</span>: <span class="json-string">"2024-06-22T08:10:05.000000Z"</span>
}</pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer class="mt-auto py-6 text-center text-sm text-gray-500/60 font-light z-10">
        &copy; {{ date('Y') }} Cek Kodam Online. API didesain untuk pengembang.
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
