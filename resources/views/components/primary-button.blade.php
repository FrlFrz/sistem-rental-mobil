<button {{ $attributes->merge(['type' => 'submit',
            'class' => 'w-full px-4 py-2 bg-[#357DFF] border rounded-md font-extrabold text-sm text-white uppercase tracking-widest hover:bg-[#0c59e8] focus:bg-[#357DFF] active:bg-[#00379c] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
