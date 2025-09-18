<!-- Filepath: resources/views/layouts/partials/sidebar.blade.php -->
<aside
    class="fixed inset-y-0 left-0 bg-white w-64 shadow-lg z-30 flex flex-col transition-transform duration-300 ease-in-out md:relative md:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    @click.outside="sidebarOpen = false" x-cloak>

    <div class="flex items-center justify-center p-4 border-b flex-shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
        <h1 class="text-xl font-bold ml-2">SPPG Super App</h1>
    </div>
    
    <nav class="flex-1 overflow-y-auto p-2 space-y-1 sidebar">
        <div x-data="{ open: true }">
            <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                <span class="flex items-center">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h6M9 11.25h6m-6 4.5h6M5.25 6h.008v.008H5.25V6zm.75 4.5h.008v.008H6v-.008zm-.75 4.5h.008v.008H5.25v-.008zm13.5-9h.008v.008h-.008V6zm-.75 4.5h.008v.008h-.008v-.008zm.75 4.5h.008v.008h-.008v-.008z" /></svg>
                    <span class="ml-3">Operasional</span>
                </span>
                <svg class="h-5 w-5 transition-transform" :class="{ 'rotate-90': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
            </button>
            <div class="ml-4 pl-4 border-l border-gray-200" x-show="open" x-collapse>
                <a href="{{ route('operasional.perencanaan.index') }}" 
                   class="flex items-center px-4 py-2 text-gray-500 hover:text-blue-600 rounded-lg text-sm
                          {{ request()->routeIs('operasional.perencanaan.index') || request()->routeIs('operasional.recipes.*') || request()->routeIs('operasional.siklus.*') ? 'nav-link-active' : '' }}">
                    Perencanaan Menu
                </a>
            </div>
        </div>
    </nav>
</aside>

