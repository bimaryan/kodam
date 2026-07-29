<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat Khodam - Cek Kodam Online</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Flowbite & Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background-color: #08080c;
            color: #e2e8f0;
            font-family: 'Outfit', sans-serif;
            background-image: 
                radial-gradient(at 0% 0%, hsla(253,16%,15%,0.5) 0, transparent 50%),
                radial-gradient(at 100% 100%, hsla(339,49%,15%,0.5) 0, transparent 50%);
            background-attachment: fixed;
        }

        .title-font {
            font-family: 'Cinzel', serif;
        }

        .glass-card {
            background: rgba(20, 15, 30, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        /* Hide scrollbar for chat Box */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="antialiased min-h-screen flex flex-col relative">

    @include('navbar')

    <main class="flex-grow flex items-center justify-center px-4 py-8 w-full z-10 relative">

        <div class="w-full max-w-2xl h-[80vh] flex flex-col">
            <div class="glass-card flex flex-col h-full rounded-2xl border border-pink-500/30 overflow-hidden relative shadow-[0_0_30px_rgba(236,72,153,0.15)]">
                
                <!-- Chat Header -->
                <div class="flex items-center gap-3 p-4 border-b border-pink-500/20 bg-black/40 shadow-sm z-20 relative">
                    <div class="w-10 h-10 rounded-full bg-pink-500/20 flex items-center justify-center text-pink-400">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 10h.01"></path><path d="M15 10h.01"></path><path d="M12 2a8 8 0 0 0-8 8v12l3-3 2.5 2.5L12 19l2.5 2.5L17 19l3 3V10a8 8 0 0 0-8-8z"></path></svg>
                    </div>
                    <div>
                        <p class="text-white text-lg font-bold leading-tight">{{ $kodamNama }}</p>
                        <p class="text-sm text-green-400 animate-pulse">Online - Siap julid</p>
                    </div>
                </div>
                
                <!-- Chat Body -->
                <div id="chatBox" class="flex-1 overflow-y-auto p-4 space-y-4 no-scrollbar flex flex-col z-10 relative">
                    <!-- Initial Khodam Message -->
                    <div class="flex flex-col gap-1 items-start w-[85%] md:w-[75%] mr-auto">
                        <div class="bg-gray-800/90 text-gray-200 text-sm md:text-base px-4 py-3 rounded-2xl rounded-tl-none border border-gray-700 shadow-sm">
                            Heh {{ $nama }}, ada yang mau ditanyain gak? Jangan kelamaan, gue sibuk ngurusin alam gaib.
                        </div>
                    </div>
                </div>

                <!-- Chat Input Area -->
                <div class="p-4 bg-black/40 border-t border-pink-500/20 z-20 relative">
                    <div class="relative flex items-center">
                        <input type="text" id="chatInput" placeholder="Tanya sesuatu ke khodam..." class="w-full bg-black/60 border border-gray-600 text-white text-sm rounded-full px-5 py-3 pr-12 focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition-all shadow-inner">
                        <button id="sendChat" class="absolute right-1.5 w-10 h-10 flex items-center justify-center bg-pink-600 rounded-full text-white hover:bg-pink-700 hover:scale-105 transition-all shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        </button>
                    </div>
                </div>
                
            </div>
            
            <a href="{{ url('/') }}" class="mt-6 text-center text-sm text-gray-400 hover:text-pink-400 transition-colors font-medium">
                &larr; Kembali ke Beranda
            </a>
        </div>
    </main>

    <script>
        let chatHistory = [];
        const userNama = "{{ addslashes($nama) }}";
        const khodamNama = "{{ addslashes($kodamNama) }}";
        const chatInput = document.getElementById('chatInput');
        const sendChatBtn = document.getElementById('sendChat');
        const chatBox = document.getElementById('chatBox');

        function escapeHtml(unsafe) {
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        function addBubble(text, sender) {
            const isUser = sender === 'user';
            const alignment = isUser ? 'items-end ml-auto' : 'items-start mr-auto';
            const bubbleClass = isUser 
                ? 'bg-pink-600 text-white rounded-2xl rounded-tr-none shadow-md' 
                : 'bg-gray-800/90 text-gray-200 rounded-2xl rounded-tl-none border border-gray-700 shadow-md';
            
            const div = document.createElement('div');
            div.className = `flex flex-col gap-1 w-[85%] md:w-[75%] ${alignment}`;
            div.innerHTML = `<div class="text-sm md:text-base px-4 py-3 ${bubbleClass}">${escapeHtml(text)}</div>`;
            chatBox.appendChild(div);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function addTyping() {
            const div = document.createElement('div');
            div.id = 'typingBubble';
            div.className = `flex flex-col gap-1 w-[85%] md:w-[75%] items-start mr-auto`;
            div.innerHTML = `<div class="text-sm px-4 py-3 bg-gray-800/90 text-gray-400 rounded-2xl rounded-tl-none border border-gray-700 flex gap-1.5 items-center h-[44px]">
                <span class="w-2 h-2 bg-gray-500 rounded-full animate-bounce" style="animation-delay: 0s;"></span>
                <span class="w-2 h-2 bg-gray-500 rounded-full animate-bounce" style="animation-delay: 0.2s;"></span>
                <span class="w-2 h-2 bg-gray-500 rounded-full animate-bounce" style="animation-delay: 0.4s;"></span>
            </div>`;
            chatBox.appendChild(div);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function removeTyping() {
            const typing = document.getElementById('typingBubble');
            if(typing) typing.remove();
        }

        async function sendChat() {
            const msg = chatInput.value.trim();
            if(!msg) return;
            
            addBubble(msg, 'user');
            chatInput.value = '';
            chatInput.disabled = true;
            sendChatBtn.disabled = true;
            
            addTyping();

            try {
                const res = await fetch('/api/chat-khodam', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        user_nama: userNama,
                        khodam_nama: khodamNama,
                        message: msg,
                        history: chatHistory
                    })
                });
                
                const data = await res.json();
                removeTyping();
                chatInput.disabled = false;
                sendChatBtn.disabled = false;
                chatInput.focus();
                
                if(data.reply) {
                    addBubble(data.reply, 'assistant');
                    chatHistory.push({role: 'user', content: msg});
                    chatHistory.push({role: 'assistant', content: data.reply});
                } else {
                    addBubble('Khodamnya lagi ngambek, gak mau bales.', 'assistant');
                }
            } catch (e) {
                removeTyping();
                chatInput.disabled = false;
                sendChatBtn.disabled = false;
                addBubble('Koneksi gaib terputus...', 'assistant');
            }
        }

        sendChatBtn.addEventListener('click', sendChat);
        chatInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') sendChat();
        });
    </script>
    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
