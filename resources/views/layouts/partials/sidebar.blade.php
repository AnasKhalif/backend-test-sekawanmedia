<div id="mobileSidebar"
    class="mobile-sidebar fixed inset-y-0 left-0 z-30 w-64 bg-gray-800 text-gray-100 transform -translate-x-full md:hidden">
    <div class="px-4 py-6 border-b border-gray-700 flex items-center justify-between">
        <div class="flex items-center">
            <i class="fas fa-truck text-2xl text-amber-500 mr-3"></i>
            <span class="text-lg font-semibold">Vehicle Management</span>
        </div>
        <button id="closeSidebar" class="text-gray-400 hover:text-white">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto scrollbar-hide">
        <ul class="px-2 py-4 space-y-1">
            <li>
                <a href="#" class="flex items-center px-4 py-3 rounded-md bg-amber-700 text-white">
                    <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-4 py-3 rounded-md text-gray-300 hover:bg-gray-700">
                    <i class="fas fa-calendar-alt w-5 h-5 mr-3"></i>
                    <span>Reservations</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-4 py-3 rounded-md text-gray-300 hover:bg-gray-700">
                    <i class="fas fa-check-circle w-5 h-5 mr-3"></i>
                    <span>Approvals</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-4 py-3 rounded-md text-gray-300 hover:bg-gray-700">
                    <i class="fas fa-file-alt w-5 h-5 mr-3"></i>
                    <span>Reports</span>
                </a>
            </li>
        </ul>

        <div class="px-4 py-2 mt-6 border-t border-gray-700">
            <h5 class="uppercase text-xs text-gray-400 font-semibold tracking-wider">System</h5>
            <ul class="mt-3 space-y-1">
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="flex items-center px-4 py-3 rounded-md text-gray-300 hover:bg-gray-700">
                        <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                        <span>Logout</span>
                    </a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </ul>
        </div>
    </nav>
</div>

<aside class="hidden md:flex md:flex-col w-64 bg-gray-800 text-gray-100">
    <div class="px-4 py-6 border-b border-gray-700 flex items-center">
        <i class="fas fa-truck text-2xl text-amber-500 mr-3"></i>
        <span class="text-lg font-semibold">Vehicle Management</span>
    </div>

    <nav class="flex-1 overflow-y-auto scrollbar-hide">
        <ul class="px-2 py-4 space-y-1">
            <li>
                <a href="#" class="flex items-center px-4 py-3 rounded-md bg-amber-700 text-white">
                    <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-4 py-3 rounded-md text-gray-300 hover:bg-gray-700">
                    <i class="fas fa-calendar-alt w-5 h-5 mr-3"></i>
                    <span>Reservations</span>
                </a>
            </li>
            @role(['approver_level1', 'approver_level2'])
                <li>
                    <a href="#" class="flex items-center px-4 py-3 rounded-md text-gray-300 hover:bg-gray-700">
                        <i class="fas fa-check-circle w-5 h-5 mr-3"></i>
                        <span>Approvals</span>
                    </a>
                </li>
            @endrole
            <li>
                <a href="#" class="flex items-center px-4 py-3 rounded-md text-gray-300 hover:bg-gray-700">
                    <i class="fas fa-file-alt w-5 h-5 mr-3"></i>
                    <span>Reports</span>
                </a>
            </li>
        </ul>

        <div class="px-4 py-2 mt-6 border-t border-gray-700">
            <h5 class="uppercase text-xs text-gray-400 font-semibold tracking-wider">System</h5>
            <ul class="mt-3 space-y-1">
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="flex items-center px-4 py-3 rounded-md text-gray-300 hover:bg-gray-700">
                        <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                        <span>Logout</span>
                    </a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </ul>
        </div>
    </nav>
</aside>

<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden md:hidden"></div>
