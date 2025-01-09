<div class="min-h-screen w-72 bg-gradient-to-br from-[#2F1810] via-[#4A3428] to-[#8B4513] border-r border-[#8B4513]/20 shadow-xl">
    <!-- Logo Area -->
    <div class="px-6 py-8">
        <div class="text-2xl font-bold text-white tracking-tight">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-[#FFB347] to-[#FFCC33]">
                Fire Command
            </span>
        </div>
    </div>

    <!-- User Profile Section -->
    <div class="mx-4 mb-8 p-4 rounded-xl bg-[#2F1810]/50 backdrop-blur-sm border border-[#8B4513]/30">
        <div class="flex flex-col" x-data="{ open: false }">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#D2691E] to-[#FFB347] flex items-center justify-center text-white font-semibold shadow-lg transform transition-transform hover:scale-105">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="text-white font-medium">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-[#FFB347]">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <button @click="open = !open" class="text-gray-400 hover:text-[#FFB347] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>
            
            <!-- Dropdown -->
            <div x-show="open" 
                 @click.away="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                 class="absolute left-0 mt-14 w-72 py-2 bg-[#2F1810] border-y border-[#8B4513]/20 shadow-xl backdrop-blur-sm">
                <a href="{{ route('profile.edit') }}" 
                   class="flex items-center px-6 py-2 text-sm text-gray-300 hover:bg-[#8B4513]/20 hover:text-[#FFB347] transition-colors">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profile Settings
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-6 py-2 text-sm text-gray-300 hover:bg-[#8B4513]/20 hover:text-[#FFB347] transition-colors">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="px-4 space-y-2">
           <!-- Fire Section -->
        <div x-data="{ open: true }" class="mb-4">
            <button @click="open = !open" 
                    class="flex items-center w-full px-4 py-3 rounded-lg text-gray-300 hover:text-[#FFB347] hover:bg-[#2F1810]/50 transition-all duration-200 group">
                <div class="p-2 mr-3 rounded-lg bg-gradient-to-br from-[#D2691E] to-[#FFB347] shadow-lg group-hover:shadow-[#FFB347]/20">
                    <svg class="w-5 h-5 text-white transform transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                    </svg>
                </div>
                <span class="font-medium">Fire</span>
                <svg :class="{'rotate-180': open}" class="w-4 h-4 ml-auto transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                 class="mt-2 ml-4 pl-8 border-l-2 border-[#8B4513]/30">
                <a href="{{ route('fire.command.index') }}" 
                   class="flex items-center py-2 text-sm text-gray-300 hover:text-[#FFB347] transition-colors">
                    Fire Command
                </a>
            </div>
        </div>
    </nav>
</div> 