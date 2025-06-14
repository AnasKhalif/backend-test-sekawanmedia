<header class="bg-white shadow-sm z-10">
    <div class="flex items-center justify-between p-4">

        <button id="menuButton" type="button" class="md:hidden text-gray-600 focus:outline-none">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <div class="flex items-center">
            <div class="relative">
                <button class="flex items-center focus:outline-none">
                    <div
                        class="h-8 w-8 rounded-full bg-amber-500 flex items-center justify-center text-white font-semibold mr-2">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="hidden md:block text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                </button>
            </div>
        </div>
    </div>
</header>
