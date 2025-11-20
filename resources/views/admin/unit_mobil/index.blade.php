<x-app-layout>

    <div class="py-12">
        <div class="rounded-lg p-6">
            <div class="sm:ml-64 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-10">
                    <p class="text-4xl font-semibold dark:text-white">Daftar Unit Mobil</p>
                    <x-secondary-button data-modal-target="create-modal" data-modal-toggle="create-modal">+ Tambah Mobil Baru</x-secondary-button>
                </div>
                @if (session()->has('success'))
                    <div id="alert-border-1" class="flex items-center p-4 mb-4 text-sm text-green-400 border-t-4 border-green-500 bg-gray-700 rounded-lg" role="alert">

                        {{-- SVG Icon untuk tanda centang / sukses --}}
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h4a1 1 0 0 1 0 2Zm1.713-3.693a1 1 0 0 1-1.42 1.42l-3-3a1 1 0 0 1 1.42-1.42l2.364 2.364Z"/>
                        </svg>

                        <div class="ms-3 text-sm font-medium">
                            <span class="font-bold">Berhasil!</span> {{ session()->get('success') }}
                        </div>

                        {{-- Tombol Tutup (Silang) --}}
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-gray-700 text-green-400 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-gray-600 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-border-1" aria-label="Close">
                            <span class="sr-only">Dismiss</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                @endif

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table id="search-table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Jenis Mobil</th>
                                <th scope="col" class="px-6 py-3">Plat Nomor</th>
                                <th scope="col" class="px-6 py-3">Warna</th>
                                <th scope="col" class="px-6 py-3">Status Mobil</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unit_mobils as $unit_mobil)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $unit_mobil->jenis_mobil->merek }}
                                </td>
                                <td class="px-6 py-4">{{ $unit_mobil->plat_nomor }}</td>
                                <td class="px-6 py-4">{{ $unit_mobil->warna }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    @if($unit_mobil->status_mobil == 'tersedia') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-300
                                    @elseif($unit_mobil->status_mobil == 'dipesan') bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-300
                                    @elseif($unit_mobil->status_mobil == 'dirental') bg-indigo-100 text-indigo-800 dark:bg-indigo-800 dark:text-indigo-300
                                    @else bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-300
                                    @endif">
                                        {{ ucfirst($unit_mobil->status_mobil) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex space-x-2">
                                    <button data-modal-target="edit-modal-{{ $unit_mobil->id_unit_mobil }}" data-modal-toggle="edit-modal-{{ $unit_mobil->id_unit_mobil }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>

                                    <form action="{{ route('unit_mobil.destroy', $unit_mobil->id_unit_mobil) }}" id="delete-form-{{ $unit_mobil->id_unit_mobil }}" method="POST" onsubmit="event.preventDefault(); confirmDelete('delete-form-{{ $unit_mobil->id_unit_mobil }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @include('admin.unit_mobil.edit-modal',['unit_mobil' => $unit_mobil])
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
@include('admin.unit_mobil.create-modal')
<script>
    // Datatables Init
    if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#search-table", {
            searchable: true,
            sortable: false
        });
    }

        function confirmDelete(formId) {
        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Anda akan menghapus data ini secara permanen dan tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",

            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById(formId);
                form.submit();
                Swal.fire({
                    title: 'Menghapus...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }
        });
    }

</script>
