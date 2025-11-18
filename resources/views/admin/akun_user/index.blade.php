<x-app-layout>

    <div class="py-12">
        <div class="rounded-lg p-6">
            <div class="sm:ml-64 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-10">
                    <p class="text-4xl font-semibold dark:text-white">Daftar Akun User</p>
                    <x-secondary-button data-modal-target="create-modal" data-modal-toggle="create-modal">+ Tambah Akun Baru</x-secondary-button>
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
                                <th scope="col" class="px-6 py-3">Username</th>
                                <th scope="col" class="px-6 py-3">Nama Depan</th>
                                <th scope="col" class="px-6 py-3">Nama Belakang</th>
                                <th scope="col" class="px-6 py-3">Tanggal Lahir</th>
                                <th scope="col" class="px-6 py-3">Role</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4">{{ $user->nama_depan }}</td>
                                <td class="px-6 py-4">{{ $user->nama_belakang }}</td>
                                <td class="px-6 py-4">{{ $user->tanggal_lahir }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    @if($user->roles == 'admin') bg-red-400 text-white
                                    @elseif($user->roles == 'user') bg-yellow-400 text-gray-800
                                    @endif">
                                        {{ ucfirst($user->roles) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex space-x-2">
                                    <button data-modal-target="edit-modal-{{ $user->id }}" data-modal-toggle="edit-modal-{{ $user->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>

                                    <form action="{{ route('akun_user.destroy', $user->id) }}" id="delete-form-{{ $user->id }}" method="POST" onsubmit="event.preventDefault(); confirmDelete('delete-form-{{ $user->id }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @include('admin.akun_user.edit-modal',['user' => $user])
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
@include('admin.akun_user.create-modal')
<script>
    // Datatables Init
    if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#search-table", {
            searchable: true,
            sortable: false
        });
    }

    function loadUserData(user) {
        // 1. Ambil Form dan Set Action URL
        const form = document.getElementById('edit-user-form');
        // Route update memerlukan ID user: /akun_user/{id}
        form.action = `/akun_user/${user.id}`;

        document.getElementById('edit-name').value = user.name;
        document.getElementById('edit-nama_depan').value = user.nama_depan;
        document.getElementById('edit-nama_belakang').value = user.nama_belakang;
        document.getElementById('edit-email').value = user.email;
        document.getElementById('edit-tanggal_lahir').value = user.tanggal_lahir;

        document.getElementById('edit-roles').value = user.roles;
    }

    function confirmDelete(formId) {
    // Fungsi ini dipanggil dari event onsubmit pada tag <form>

    // Gunakan SweetAlert2 untuk menampilkan dialog konfirmasi
    Swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Anda akan menghapus data ini secara permanen dan tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true, // Menampilkan tombol Batal

        // Warna tombol Hapus (Warna merah)
        confirmButtonColor: "#dc3545", // Tailwind red-600/Bootstrap danger color

        // Warna tombol Batal (Warna abu-abu/biru)
        cancelButtonColor: "#6c757d",

        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal",

        // Tambahkan atribut custom (opsional)
        reverseButtons: true // Membalik urutan tombol (Batal di kiri, Hapus di kanan)
    }).then((result) => {
        // Logika dijalankan setelah user merespons dialog

        if (result.isConfirmed) {
            // Jika user menekan 'Ya, Hapus'

            // 1. Dapatkan elemen form yang dituju berdasarkan ID
            const form = document.getElementById(formId);

            // 2. Submit form DELETE secara manual
            form.submit();

            // Opsional: Tampilkan loading SweetAlert
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
