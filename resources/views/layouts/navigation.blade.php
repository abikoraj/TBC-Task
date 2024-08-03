<!-- resources/views/layouts/sidebar.blade.php -->
<div x-data="{ open: window.innerWidth >= 768 }" x-init="$watch('open', value => value)" @resize.window="open = window.innerWidth >= 768 || open" class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside :class="{ 'w-64': open, 'w-16': !open }" class="fixed inset-y-0 left-0 bg-gray-900 border-r border-gray-700 transition-width duration-300 ease-in-out z-30">
        <div class="flex flex-col h-full">
            <!-- Hamburger Icon -->
            <div class="flex items-center justify-between p-4 sm:hidden">
                <button @click="open = ! open" class="text-gray-400 hover:text-gray-200 focus:outline-none">
                    <i :class="{'fa-solid fa-bars': !open, 'fa-solid fa-xmark': open}" class="fa-lg"></i>
                </button>
            </div>

            <!-- Logo and Sidebar Toggle Button -->
            <div class="flex items-center justify-between p-4">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-100" x-show="open" />
                        <span x-show="open" class="text-gray-100 font-bold ms-2">AppName</span>
                    </a>
                </div>
                <button @click="open = ! open" class="text-gray-400 hover:text-gray-200 focus:outline-none hidden sm:block">
                    <i :class="{'fa-solid fa-bars': !open, 'fa-solid fa-xmark': open}" class="fa-lg"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 p-4 space-y-2">
                <ul>
                    <li>
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center space-x-2 p-2 rounded-md hover:bg-gray-700 transition text-gray-300 hover:text-gray-100">
                            <i class="fa-solid fa-tachometer-alt"></i>
                            <span x-show="open" class="ms-1">Dashboard</span>
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('post-categories.index')" :active="request()->routeIs('post-categories.index')" class="flex items-center space-x-2 p-2 rounded-md hover:bg-gray-700 transition text-gray-300 hover:text-gray-100">
                            <i class="fa-solid fa-list"></i>
                            <span x-show="open" class="ms-1">Categories</span>
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.*')" class="flex items-center space-x-2 p-2 rounded-md hover:bg-gray-700 transition text-gray-300 hover:text-gray-100">
                            <i class="fa-solid fa-list"></i>
                            <span x-show="open" class="ms-1">Posts</span>
                        </x-nav-link>
                    </li>
                </ul>
            </nav>

            <!-- User Settings -->
            <div class="p-4 border-t border-gray-700">
                <div x-show="!open" class="flex items-center justify-center">
                    <i class="fa-solid fa-user-circle text-gray-400 fa-xl"></i>
                </div>
                <div x-show="open" class="mt-4">
                    <div class="font-medium text-base text-gray-100">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-4 space-y-2">
                    <x-nav-link :href="route('profile.edit')" class="flex items-center space-x-2 p-2 rounded-md hover:bg-gray-700 transition text-gray-300 hover:text-gray-100">
                        <i class="fa-solid fa-user"></i>
                        <span x-show="open" class="ms-1">Profile</span>
                    </x-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-nav-link :href="route('logout')" class="flex items-center space-x-2 p-2 rounded-md hover:bg-gray-700 transition text-gray-300 hover:text-gray-100"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fa-solid fa-sign-out-alt"></i>
                            <span x-show="open" class="ms-1">Log Out</span>
                        </x-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main :class="{ 'ml-64': open, 'ml-16': !open }" class="flex-1 transition-all duration-300 ease-in-out bg-gray-50">
        
        <div class="p-3">
            {{ $slot }}
        </div>
    </main>
</div>