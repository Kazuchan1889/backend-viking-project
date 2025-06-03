<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen bg-gray-100">
    <div class="flex h-full">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white p-6">
            <h2 class="text-2xl font-bold mb-6">Dashboard</h2>
            <nav class="flex flex-col space-y-4">
                <a href="/dashboard" class="hover:bg-gray-700 p-2 rounded">Home</a>
                <a href="#" class="hover:bg-gray-700 p-2 rounded">News</a>
                <a href="/login" class="hover:bg-gray-700 p-2 rounded">Login</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Selamat Datang</h1>
            <p class="text-gray-600">Ini adalah halaman dashboard awal.</p>
        </main>
    </div>
</body>
</html>
