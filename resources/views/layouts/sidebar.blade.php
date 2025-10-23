<!-- Sidebar -->
<aside class="fixed inset-y-0 left-0 bg-white dark:bg-dark-bg-secondary shadow-lg max-h-screen w-64">
    <div class="flex flex-col justify-between h-full">
        <div class="flex-grow">
            <!-- Logo Kısmı -->
            <div class="px-4 py-6 text-center border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-xl font-bold leading-none text-gray-800 dark:text-dark-text-primary">
                    <span class="text-blue-600 dark:text-blue-400">Stok Takip</span> Sistemi
                </h1>
            </div>
            
            <!-- Profil Kısmı -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        @if(Auth::user()->profile_photo_path)
                            <img class="w-10 h-10 rounded-full border-2 border-blue-100 dark:border-blue-900" src="{{ asset('storage/'.Auth::user()->profile_photo_path) }}" alt="Profil Fotoğrafı">
                        @else
                            <div class="w-10 h-10 rounded-full border-2 border-blue-100 dark:border-blue-900 bg-blue-500 flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white dark:border-dark-bg-secondary"></span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-dark-text-primary truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-dark-text-secondary truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="p-1 text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 rounded-full hover:bg-blue-50 dark:hover:bg-blue-900/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Menü Kısmı -->
            <div class="p-4">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('categories.index') }}"
                           class="flex items-center rounded-xl font-bold text-sm py-3 px-4 transition-all {{ request()->routeIs('categories.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400' : 'text-gray-700 dark:text-dark-text-secondary hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-lg mr-4 {{ request()->routeIs('categories.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400 dark:text-dark-text-secondary' }}" viewBox="0 0 16 16">
                                <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                            </svg>Kategoriler
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}"
                           class="flex items-center rounded-xl font-bold text-sm py-3 px-4 transition-all {{ request()->routeIs('products.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400' : 'text-gray-700 dark:text-dark-text-secondary hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-lg mr-4 {{ request()->routeIs('products.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400 dark:text-dark-text-secondary' }}" viewBox="0 0 16 16">
                                <rect x="2" y="2" width="12" height="12" rx="2" fill="currentColor"/>
                                <rect x="4" y="4" width="8" height="8" rx="1" fill="white"/>
                            </svg>Ürünler
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sales.index') }}"
                           class="flex items-center rounded-xl font-bold text-sm py-3 px-4 transition-all {{ request()->routeIs('sales.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400' : 'text-gray-700 dark:text-dark-text-secondary hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-lg mr-4 {{ request()->routeIs('sales.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400 dark:text-dark-text-secondary' }}" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>Satış
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('statistics.index') }}"
                           class="flex items-center rounded-xl font-bold text-sm py-3 px-4 transition-all {{ request()->routeIs('statistics.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400' : 'text-gray-700 dark:text-dark-text-secondary hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 w-5 h-5 {{ request()->routeIs('statistics.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400 dark:text-dark-text-secondary' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17a1 1 0 102 0v-6a1 1 0 10-2 0v6zm-4 0a1 1 0 102 0V7a1 1 0 10-2 0v10zm8 0a1 1 0 102 0v-3a1 1 0 10-2 0v3z" />
                            </svg>İstatistik
                        </a>
                    </li>
                    @can('manage-users')
                        <li>
                            <a href="{{ route('admin.users.index') }}"
                               class="flex items-center rounded-xl font-bold text-sm py-3 px-4 transition-all {{ request()->routeIs('admin.users.*') ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400' : 'text-gray-700 dark:text-dark-text-secondary hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 w-5 h-5 {{ request()->routeIs('admin.users.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400 dark:text-dark-text-secondary' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>Kullanıcılar
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>
        
        <!-- Çıkış Butonu ve Footer -->
        <div>
            <!-- Dark Mode Toggle -->
            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                <button id="theme-toggle" class="w-full flex items-center justify-center space-x-2 text-sm font-medium text-gray-600 dark:text-dark-text-secondary hover:text-blue-600 dark:hover:text-blue-400 p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path class="sun-icon hidden dark:block" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        <path class="moon-icon block dark:hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <span class="theme-text">Karanlık Mod</span>
                </button>
            </div>

            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                   class="flex items-center justify-center space-x-2 text-sm font-medium text-gray-600 dark:text-dark-text-secondary hover:text-blue-600 dark:hover:text-blue-400 p-2 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Çıkış Yap</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                <div class="text-xs text-gray-500 dark:text-dark-text-secondary text-center">
                    2025 &copy; Tüm Hakları Saklıdır<br>
                    <span class="text-blue-500 dark:text-blue-400">v2.1.0</span>
                </div>
            </div>
        </div>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const themeToggle = document.getElementById('theme-toggle');
        const themeText = themeToggle.querySelector('.theme-text');
        
        // Set initial text
        if (document.documentElement.classList.contains('dark')) {
            themeText.textContent = 'Aydınlık Mod';
        } else {
            themeText.textContent = 'Karanlık Mod';
        }
        
        themeToggle.addEventListener('click', function() {
            console.log('Toggle clicked');
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                themeText.textContent = 'Karanlık Mod';
                console.log('Switched to light mode');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                themeText.textContent = 'Aydınlık Mod';
                console.log('Switched to dark mode');
            }
        });
    });
</script>