<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak | MengajiYuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="text-center px-6">
        <div class="text-8xl mb-6">🚫</div>
        <h1 class="text-6xl font-bold text-indigo-600 mb-2">403</h1>
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Akses Ditolak</h2>
        <p class="text-gray-500 mb-2">{{ $exception->getMessage() ?? 'Kamu tidak memiliki izin untuk mengakses halaman ini.' }}</p>
        <p class="text-gray-400 text-sm mb-8">Pastikan kamu login dengan akun yang sesuai.</p>
        <div class="flex gap-4 justify-center">
            <a href="{{ url()->previous() }}"
               class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                ← Kembali
            </a>
            <a href="{{ route('dashboard') }}"
               class="px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                🏠 Dashboard
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="px-5 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                    🔓 Logout
                </button>
            </form>
        </div>
    </div>
</body>
</html>