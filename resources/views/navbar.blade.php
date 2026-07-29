<nav class="w-full z-50 transition-all duration-300 bg-[#050505] border-b border-white/10">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse group">
            <span class="self-center text-2xl font-bold whitespace-nowrap text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600 font-['Cinzel'] tracking-wider group-hover:from-pink-500 group-hover:to-purple-500 transition-all duration-300">Cek Kodam</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-300 rounded-lg md:hidden hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 bg-transparent rounded-lg border border-white/10 md:border-0">
                <li>
                    <a href="/"
                        class="block py-2 px-3 text-white rounded hover:bg-white/10 md:hover:bg-transparent md:border-0 md:hover:text-pink-400 md:p-0 transition-all font-['Outfit']">Beranda</a>
                </li>
                <li>
                    <a href="{{url('/kodam')}}"
                        class="block py-2 px-3 text-gray-300 rounded hover:bg-white/10 md:hover:bg-transparent md:border-0 md:hover:text-pink-400 md:p-0 transition-all font-['Outfit']">API Docs</a>
                </li>
                <li>
                    <button onclick="toggleAudio()" id="audioToggleBtn" class="flex items-center gap-2 py-2 px-3 text-emerald-400 rounded hover:bg-white/10 md:hover:bg-transparent md:border-0 md:hover:text-emerald-300 md:p-0 transition-all font-['Outfit'] w-full md:w-auto text-left">
                        <svg id="audioIcon" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path><path id="audioIconLines" stroke-linecap="round" stroke-linejoin="round" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"></path></svg>
                        <span id="audioText">Audio Off</span>
                    </button>
                </li>
                <li>
                    <button data-modal-target="top-sesajen-modal" data-modal-toggle="top-sesajen-modal" class="flex items-center gap-2 py-2 px-3 text-orange-400 rounded hover:bg-white/10 md:hover:bg-transparent md:border-0 md:hover:text-orange-300 md:p-0 transition-all font-['Outfit'] w-full md:w-auto text-left">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Sultan Khodam
                    </button>
                </li>
                <li>
                    <button data-modal-target="hof-modal" data-modal-toggle="hof-modal" class="flex items-center gap-2 py-2 px-3 text-yellow-500 rounded hover:bg-white/10 md:hover:bg-transparent md:border-0 md:hover:text-yellow-400 md:p-0 transition-all font-['Outfit'] w-full md:w-auto text-left">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path><path d="M4 22h16"></path><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path></svg>
                        Hall of Fame
                    </button>
                </li>
                <li>
                    <button data-modal-target="hos-modal" data-modal-toggle="hos-modal" class="flex items-center gap-2 py-2 px-3 text-gray-400 rounded hover:bg-white/10 md:hover:bg-transparent md:border-0 md:hover:text-gray-300 md:p-0 transition-all font-['Outfit'] w-full md:w-auto text-left">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M10 11v6M14 11v6"></path></svg>
                        Hall of Shame
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>
