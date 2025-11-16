<div class="grid grid-cols-1 gap-4 font-sans lg:grid-cols-4 lg:gap-1">
        <div class="px-10 bg-blue-900 rounded md:h-screen">
            <div class="flex flex-col justify-center py-10">
                <div class="relative w-20 h-20 mx-auto overflow-hidden border-2 border-gray-200 rounded-full shadow-md bg-neutral-secondary-medium shadow-black">
                    <svg class="absolute w-24 h-24 text-body-subtle -left-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                </div>
                <div class="mx-auto mt-3">
                    @forEach ($user as $users)
                        @if (auth()->id() === $users->id)
                            <h1 class="text-xl text-gray-300">Hello, <span class="text-2xl font-bold">{{ $users->name }}!</span></h1>
                        @endif
                    @endforEach
                </div>
                    
            </div>
            <div class="flex justify-start px-5 ">
                <nav class="flex flex-col gap-5 ">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-2xl font-bold text-gray-300 hover:font-normal hover:text-gray-100">
                        <span class="text-4xl text-yellow-300 material-symbols-outlined">dashboard</span>Dashboard
                    </a>
                    <a href="{{ route('update-sales') }}" class="flex items-center gap-2 text-2xl font-bold text-gray-300 hover:font-normal hover:text-gray-100">
                        <span class="text-4xl text-green-500 material-symbols-outlined">finance</span>Daily Sales</a>
                    <a href="{{ route('update-expenses') }}" class="flex items-center gap-2 text-2xl font-bold text-gray-300 hover:font-normal hover:text-gray-100">
                        <span class="text-4xl text-red-500 material-symbols-outlined">paid</span>Expenses</a>
                    <a href="{{ route('partitions') }}" class="flex items-center gap-2 text-2xl font-bold text-gray-300 hover:font-normal hover:text-gray-100">
                        <span class="text-4xl text-green-500 material-symbols-outlined">split_scene_left</span>Partitions</a>
                </nav>
            </div>
        </div>
        <div class="h-screen overflow-y-scroll bg-gray-800 rounded lg:col-span-3 no-scrollbar">
            {{ $slot }}
        </div>
    </div>