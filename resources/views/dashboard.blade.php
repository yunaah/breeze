<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div x-data="{ showModal: false, deleteUrl: '' }" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">

                <h2 class="text-xl font-semibold text-white">Data Mahasiswa</h2>

                <!-- Button Tambah Mahasiswa -->
                <button onclick="toggleModal()" class="bg-blue-500 text-white px-4 py-2 rounded mb-3 inline-block">
                    Tambah Mahasiswa
                </button>

                <!-- Tabel Mahasiswa -->
                <table class="table-auto w-full border border-gray-300 mt-4 text-white">
                    <thead class="bg-black-100">
                        <tr>
                            <th class="border px-4 py-2">ID</th>
                            <th class="border px-4 py-2">NIM</th>
                            <th class="border px-4 py-2">Nama</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswa as $m)
                            <tr>
                                <td class="border px-4 py-2">{{ $m->id }}</td>
                                <td class="border px-4 py-2">{{ $m->nim }}</td>
                                <td class="border px-4 py-2">{{ $m->nama }}</td>
                                <td class="border px-4 py-2 flex space-x-2">
                                    <!-- Edit -->
                                    <button onclick="openEditModal({{ $m->id }}, '{{ $m->nama }}', '{{ $m->nim }}')" class="text-yellow-500 hover:text-yellow-700">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Delete -->
                                    <button 
                                        @click.prevent="deleteUrl = '{{ route('mahasiswa.destroy', $m->id) }}'; showModal = true"
                                        class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Modal Tambah Mahasiswa -->
                <div id="addMahasiswaModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50">
                    <div class="flex items-center justify-center min-h-screen px-4">
                        <div class="relative w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
                            <h2 class="mb-4 text-lg font-semibold">Tambah Mahasiswa</h2>
                            <form action="{{ route('mahasiswa.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-700">Nama</label>
                                    <input type="text" id="nama" name="nama" class="w-full px-3 py-2 border rounded-lg" required>
                                </div>
                                <div class="mb-4">
                                    <label for="nim" class="block mb-2 text-sm font-medium text-gray-700">NIM</label>
                                    <input type="text" id="nim" name="nim" class="w-full px-3 py-2 border rounded-lg" required>
                                </div>
                                <div class="flex justify-end space-x-2">
                                    <button type="button" onclick="toggleModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">Batal</button>
                                    <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div id="modalEdit" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white p-6 rounded w-full max-w-md">
                        <h2 class="text-lg font-semibold mb-4">Edit Mahasiswa</h2>
                        <form id="editForm" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" id="editNama" name="nama" class="w-full mb-3 border px-3 py-2 rounded" required>
                            <input type="text" id="editNim" name="nim" class="w-full mb-3 border px-3 py-2 rounded" required>
                            <div class="flex justify-end space-x-2">
                                <button type="button" onclick="toggleEditModal()" class="bg-gray-300 px-4 py-2 rounded">Batal</button>
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Konfirmasi Hapus -->
                <div 
                    x-show="showModal" 
                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                    x-transition
                >
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96" @click.away="showModal = false">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Konfirmasi Hapus</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">Apakah Anda yakin ingin menghapus data mahasiswa ini?</p>
                        <div class="flex justify-end space-x-2">
                            <button @click="showModal = false" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                                Batal
                            </button>
                            <form :action="deleteUrl" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Toast Success -->
                @if(session('success'))
                    <div id="toast-success" class="fixed top-5 right-5 z-50 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <script>
                        setTimeout(() => {
                            document.getElementById('toast-success').style.display = 'none';
                        }, 3000);
                    </script>
                @endif

                <!-- JS Function -->
                <script>
                    function toggleModal() {
                        document.getElementById('addMahasiswaModal').classList.toggle('hidden');
                    }

                    function toggleEditModal() {
                        document.getElementById('modalEdit').classList.toggle('hidden');
                    }

                    function openEditModal(id, nama, nim) {
                        toggleEditModal();
                        document.getElementById('editNama').value = nama;
                        document.getElementById('editNim').value = nim;
                        document.getElementById('editForm').action = `/mahasiswa/${id}`;
                    }
                </script>

            </div>
        </div>
    </div>

    {{-- Include Alpine.js --}}
    <script src="https://unpkg.com/alpinejs" defer></script>
</x-app-layout>