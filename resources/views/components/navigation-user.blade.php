<nav class="flex gap-4 relative w-full h-[80px] bg-[#357DFF] shadow-md">
            <div class="container mx-auto px-4 flex justify-between items-center h-full">
                <a
                    href="{{ url('/') }}"
                    class="inline-block text-white font-bold tracking-wide px-3.5 py-1 text-xl leading-normal"
                >
                    CARENTAL
                </a>
                @auth
                    <a
                        href="{{ url('/dashboard') }}"
                        class="inline-block font-bold tracking-wide px-5 py-2.5 bg-white border-[#19140035] hover:border-[#1915014a] border text-[#357DFF] rounded-xl text-sm leading-none"
                    >
                        Dashboard
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="inline-block font-bold tracking-wide px-5 py-2.5 bg-white border-[#19140035] hover:border-[#1915014a] border text-[#357DFF] rounded-xl text-sm leading-none"
                    >
                        Login
                    </a>

                @endauth
            </div>
        </nav>
