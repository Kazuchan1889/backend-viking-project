<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>News Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Dummy data items
        window.items = [
            {
                photo: 'https://randomuser.me/api/portraits/men/32.jpg',
                title: 'Judul Item 1',
                description: 'Deskripsi singkat untuk item pertama.'
            },
            {
                photo: 'https://randomuser.me/api/portraits/women/44.jpg',
                title: 'Judul Item 2',
                description: 'Deskripsi singkat untuk item kedua.'
            }
        ];

        // Buka modal edit
        function openEditModal(index) {
            const item = window.items[index];
            document.getElementById('editIndex').value = index;
            document.getElementById('editTitle').value = item.title;
            document.getElementById('editDescription').value = item.description;
            document.getElementById('modalEdit').classList.remove('hidden');
        }

        // Tutup modal edit
        function closeEditModal() {
            document.getElementById('modalEdit').classList.add('hidden');
        }

        // Simpan edit
        function saveEdit() {
            const index = document.getElementById('editIndex').value;
            window.items[index].title = document.getElementById('editTitle').value;
            window.items[index].description = document.getElementById('editDescription').value;
            renderList();
            closeEditModal();
        }

        // Buka modal add
        function openAddModal() {
            // reset form
            document.getElementById('addPhoto').value = '';
            document.getElementById('addTitle').value = '';
            document.getElementById('addDescription').value = '';
            document.getElementById('modalAdd').classList.remove('hidden');
        }

        // Tutup modal add
        function closeAddModal() {
            document.getElementById('modalAdd').classList.add('hidden');
        }

        // Simpan add item baru
        function saveAdd() {
            const photo = document.getElementById('addPhoto').value || 'https://via.placeholder.com/80';
            const title = document.getElementById('addTitle').value.trim();
            const description = document.getElementById('addDescription').value.trim();

            if (!title) {
                alert('Title wajib diisi');
                return;
            }

            window.items.push({
                photo,
                title,
                description
            });

            renderList();
            closeAddModal();
        }

        // Render list items
        function renderList() {
            const container = document.getElementById('listContainer');
            container.innerHTML = '';

            window.items.forEach((item, idx) => {
                const div = document.createElement('div');
                div.className = "flex bg-white rounded shadow p-4 mb-4 items-center";

                div.innerHTML = `
                    <img src="${item.photo}" alt="photo" class="w-20 h-20 object-cover rounded mr-4" />
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold">${item.title}</h3>
                        <p class="text-gray-600">${item.description}</p>
                    </div>
                    <button onclick="openEditModal(${idx})" class="ml-4 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Edit</button>
                `;

                container.appendChild(div);
            });
        }

        window.onload = function () {
            renderList();
        }
    </script>
</head>
<body class="h-screen bg-gray-100">
    <div class="flex h-full">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white p-6">
            <h2 class="text-2xl font-bold mb-6">Dashboard</h2>
            <nav class="flex flex-col space-y-4">
                <a href="/dashboard" class="hover:bg-gray-700 p-2 rounded text-white">Home</a>
                <a href="/news" class="bg-white text-gray-900 p-2 rounded">News</a> <!-- Active -->
                <a href="/login" class="hover:bg-gray-700 p-2 rounded text-white">Login</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">News List</h1>
                <button onclick="openAddModal()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Add</button>
            </div>

            <div id="listContainer"></div>
        </main>
    </div>

    <!-- Modal Edit -->
    <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded shadow-lg w-96 p-6 relative">
            <h2 class="text-xl font-semibold mb-4">Edit News Item</h2>
            <input type="hidden" id="editIndex" />
            <div class="mb-4">
                <label for="editTitle" class="block font-medium mb-1">Title</label>
                <input id="editTitle" type="text" class="w-full border rounded px-3 py-2" />
            </div>
            <div class="mb-4">
                <label for="editDescription" class="block font-medium mb-1">Description</label>
                <textarea id="editDescription" rows="4" class="w-full border rounded px-3 py-2"></textarea>
            </div>

            <div class="flex justify-end space-x-4">
                <button onclick="closeEditModal()" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                <button onclick="saveEdit()" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Save</button>
            </div>
        </div>
    </div>

    <!-- Modal Add -->
    <div id="modalAdd" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded shadow-lg w-96 p-6 relative">
            <h2 class="text-xl font-semibold mb-4">Add News Item</h2>
            <div class="mb-4">
                <label for="addPhoto" class="block font-medium mb-1">Photo URL</label>
                <input id="addPhoto" type="text" placeholder="https://example.com/photo.jpg" class="w-full border rounded px-3 py-2" />
            </div>
            <div class="mb-4">
                <label for="addTitle" class="block font-medium mb-1">Title</label>
                <input id="addTitle" type="text" class="w-full border rounded px-3 py-2" />
            </div>
            <div class="mb-4">
                <label for="addDescription" class="block font-medium mb-1">Description</label>
                <textarea id="addDescription" rows="4" class="w-full border rounded px-3 py-2"></textarea>
            </div>

            <div class="flex justify-end space-x-4">
                <button onclick="closeAddModal()" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                <button onclick="saveAdd()" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Submit</button>
            </div>
        </div>
    </div>
</body>
</html>
