<!-- Header -->
<div class="flex flex-col gap-3 lg:flex-row justify-between p-5 bg-gradient-to-r from-indigo-500 to-sky-500 shadow">
    <div>
        <form action="{{ route('home') }}" method="GET" class="flex items-center max-w-sm mx-auto">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                    </svg>
                </div>
                <input type="text" id="simple-search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                    placeholder="Search..." value="{{ request()->query('search') }}" name="search" />
            </div>
        </form>
    </div>
    <div class="text-3xl font-bold text-slate-100 text-center">
        The New Dispatch
    </div>
    <div class="flex justify-center">
        <div class="flex gap-4">
            <a href="{{ route('login') }}" class="py-2 text-slate-100 font-bold hover:text-slate-800">Sign In</a>
            <button data-modal-target="subscribe-modal" data-modal-toggle="subscribe-modal"
                class="bg-emerald-600 hover:bg-teal-800 text-white font-bold py-2 px-4 rounded shadow">
                Subscribe
            </button>
        </div>
    </div>
</div>

<div class="flex flex-wrap justify-center gap-7 py-8 bg-slate-300 px-5 md:px-0">
    <a href="{{ route('home') }}"
        class="font-bold text-slate-500 hover:text-slate-800 {{ request()->routeIs('home') ? 'text-slate-800' : 'text-slate-500' }}">All</a>
    @foreach ($categories as $category)
        <a href="{{ route('category.articles', $category->name) }}"
            class="font-bold text-slate-500 hover:text-slate-800 {{ isset($selectedCategory) && $selectedCategory->name === $category->name ? 'text-slate-800' : 'text-slate-500' }}">{{ $category->name ?? '' }}</a>
    @endforeach
</div>
