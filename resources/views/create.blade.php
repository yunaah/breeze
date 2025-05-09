<div id="addMahasiswaModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="relative w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-lg font-semibold">Tambah Mahasiswa</h2>
            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300" required>
                </div>
                <div class="mb-4">
                    <label for="nim" class="block mb-2 text-sm font-medium text-gray-700">NIM</label>
                    <input type="text" id="nim" name="nim" pattern="[0-9]" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="toggleModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
