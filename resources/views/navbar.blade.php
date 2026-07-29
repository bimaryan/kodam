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
            </ul>
        </div>
    </div>
</nav>
