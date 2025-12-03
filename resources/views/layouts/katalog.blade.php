<x-page-style>
    @section('title', 'Carental | Katalog');

    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm font-medium text-gray-500">
                <li><a href="#" class="hover:text-gray-900">Home</a></li>
                <li aria-current="page"><span class="mx-2">/</span><span class="text-gray-900">Electronics</span></li>
            </ol>
        </nav>

        <h1 class="text-2xl font-bold text-gray-900 mb-6">
            Electronics
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <aside class="lg:col-span-3">
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100">

                    {{-- Kategori (Categories) --}}
                    <div id="accordion-categories" data-accordion="collapse">
                        <h2 id="categories-heading">
                            <button type="button" class="flex items-center justify-between w-full py-3 font-semibold
                            text-left text-gray-900" data-accordion-target="#categories-body"
                                aria-expanded="false"
                                aria-controls="categories-body">
                                Categories
                                <svg class="w-3 h-3 shrink-0"aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5 5 1 1 5"/>
                                </svg>
                            </button>
                        </h2>
                        <div id="categories-body" class="hidden pt-2"ria-labelledby="categories-heading">
                            {{-- Isi Konten Kategori --}}
                            <div class="mb-4">
                                <input type="text" placeholder="Search for categories" class="w-full p-2 border border-gray-300
                                rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <ul class="space-y-3 text-sm text-gray-700">
                                {{-- Checkbox items --}}
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> TV, Audio-Video</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Desktop PC</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Gaming</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Monitors</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Laptops</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Console</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Tablets</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Foto</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Fashion</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Books</li>
                            </ul>
                            <a href="#" class="text-sm text-blue-600 mt-2 inline-block hover:underline">See more &rarr;</a>
                        </div>
                    </div>

                    <hr class="my-4 border-gray-200">

                    {{-- Rating --}}
                    <div id="accordion-rating" data-accordion="collapse">
                        <h2 id="rating-heading">
                            <button type="button" class="flex items-center justify-between w-full py-3 font-semibold text-left
                             text-gray-900" data-accordion-target="#rating-body"
                                aria-expanded="false"
                                aria-controls="rating-body">
                                Rating
                                <svg class="w-3 h-3 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                </svg>
                            </button>
                        </h2>
                        <div id="rating-body" class="hidden pt-2" aria-labelledby="rating-heading">
                            <p class="text-sm text-gray-500">Rating filter content here...</p>
                        </div>
                    </div>

                    <hr class="my-4 border-gray-200">

                    {{-- Price --}}
                    <div id="accordion-price" data-accordion="collapse">
                        <h2 id="price-heading">
                            <button type="button" class="flex items-center justify-between w-full py-3 font-semibold text-left text-gray-900" data-accordion-target="#price-body"
                                aria-expanded="false"
                                aria-controls="price-body">
                                Price
                                <svg class="w-3 h-3 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                </svg>
                            </button>
                        </h2>
                        <div id="price-body" class="hidden pt-2" aria-labelledby="price-heading">
                            <p class="text-sm text-gray-500">Price range slider/inputs...</p>
                        </div>
                    </div>

                </div>
            </aside>

            <main class="lg:col-span-9">
                <div class="flex justify-end mb-6">
                    <button id="dropdownSortButton" data-dropdown-toggle="dropdownSort" class="text-gray-500 hover:bg-gray-100 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center" type="button">
                        <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m-4 4l4 4"></path></svg>
                        Sort
                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>

                    <div id="dropdownSort" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownSortButton">
                            <li class="px-4 py-2 font-bold text-blue-600">The most popular</li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Newest</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Increasing price</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Decreasing price</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">No. reviews</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Discount %</a></li>
                        </ul>
                    </div>
                </div>

                {{-- BARIS INI YANG DIPERBAIKI --}}
                <div class="grid grid-cols-1 gap-6">

                    <x-car-list-in-catalog></x-car-list-in-catalog>
                    <x-car-list-in-catalog></x-car-list-in-catalog>
                    <x-car-list-in-catalog></x-car-list-in-catalog>
                    <x-car-list-in-catalog></x-car-list-in-catalog>

                </div>
            </main>
        </div>
    </div>

</x-page-style>
