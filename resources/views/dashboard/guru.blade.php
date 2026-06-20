<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                🏫 Dashboard Guru
            </h2>
            <span class="text-sm text-gray-500 dark:text-gray-400">
                Halo, {{ Auth::user()->name }} 👋
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- KARTU STATISTIK GLOBAL --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 text-center border-l-4 border-indigo-500">
                    <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $totalSantri }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Total Santri</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 text-center border-l-4 border-blue-500">
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $totalHafalan }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Total Setoran</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 text-center border-l-4 border-green-500">
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $hafalanSelesai }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Hafalan Selesai</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 text-center border-l-4 border-amber-500">
                    <p class="text-3xl font-bold text-amber-500 dark:text-amber-400">
                        {{ $rataRataGlobal ? number_format($rataRataGlobal, 1) : '-' }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Rata-rata Nilai</p>
                </div>

            </div>

            {{-- CHART BAR --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-6">
                    📊 Perbandingan Jumlah Setoran Hafalan per Santri
                </h3>
                @if($santriList->isNotEmpty())
                    <div style="height: 300px;">
                        <canvas id="chartGuru"></canvas>
                    </div>
                @else
                    <div class="flex items-center justify-center h-48 text-gray-400">
                        <p>Belum ada santri terdaftar.</p>
                    </div>
                @endif
            </div>

            {{-- TABEL SEMUA SANTRI --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">
                    👥 Rekap Progress Semua Santri
                </h3>

                @if($santriList->isEmpty())
                    <div class="text-center py-12">
                        <p class="text-gray-400 dark:text-gray-500 text-lg">Belum ada santri terdaftar.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left">
                            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs tracking-wider">
                                <tr>
                                    <th class="px-4 py-3 rounded-tl-lg">No</th>
                                    <th class="px-4 py-3">Nama Santri</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3 text-center">Total</th>
                                    <th class="px-4 py-3 text-center">✅ Selesai</th>
                                    <th class="px-4 py-3 text-center">🔄 Proses</th>
                                    <th class="px-4 py-3 text-center">⏳ Belum</th>
                                    <th class="px-4 py-3 text-center rounded-tr-lg">Rata-rata Nilai</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach($santriList as $index => $santri)
                                @php
                                    $jmlSelesai = $santri->hafalan->where('status', 'selesai')->count();
                                    $jmlProses  = $santri->hafalan->where('status', 'proses')->count();
                                    $jmlBelum   = $santri->hafalan->where('status', 'belum')->count();
                                    $avgNilai   = $santri->hafalan
                                                    ->where('status', 'selesai')
                                                    ->whereNotNull('nilai')
                                                    ->avg('nilai');
                                @endphp
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                    <td class="px-4 py-3 text-gray-400">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 font-semibold text-gray-800 dark:text-gray-200">
                                        {{ $santri->name }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-500 dark:text-gray-400">
                                        {{ $santri->email }}
                                    </td>
                                    <td class="px-4 py-3 text-center font-medium text-gray-700 dark:text-gray-300">
                                        {{ $santri->hafalan_count }}
                                    </td>
                                    <td class="px-4 py-3 text-center font-semibold text-green-600 dark:text-green-400">
                                        {{ $jmlSelesai }}
                                    </td>
                                    <td class="px-4 py-3 text-center font-semibold text-yellow-500 dark:text-yellow-400">
                                        {{ $jmlProses }}
                                    </td>
                                    <td class="px-4 py-3 text-center font-semibold text-red-500 dark:text-red-400">
                                        {{ $jmlBelum }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($avgNilai)
                                            <span class="font-bold text-indigo-600 dark:text-indigo-400 text-base">
                                                {{ number_format($avgNilai, 1) }}
                                            </span>
                                        @else
                                            <span class="text-gray-300 dark:text-gray-600">—</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        @if($santriList->isNotEmpty())
        const labels  = @json($santriList->pluck('name'));
        const selesai = @json($santriList->map(fn($s) => $s->hafalan->where('status','selesai')->count()));
        const proses  = @json($santriList->map(fn($s) => $s->hafalan->where('status','proses')->count()));
        const belum   = @json($santriList->map(fn($s) => $s->hafalan->where('status','belum')->count()));

        const ctx = document.getElementById('chartGuru').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Selesai',
                        data: selesai,
                        backgroundColor: 'rgba(34, 197, 94, 0.8)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 1,
                        borderRadius: 4,
                    },
                    {
                        label: 'Proses',
                        data: proses,
                        backgroundColor: 'rgba(234, 179, 8, 0.8)',
                        borderColor: 'rgba(234, 179, 8, 1)',
                        borderWidth: 1,
                        borderRadius: 4,
                    },
                    {
                        label: 'Belum',
                        data: belum,
                        backgroundColor: 'rgba(239, 68, 68, 0.8)',
                        borderColor: 'rgba(239, 68, 68, 1)',
                        borderWidth: 1,
                        borderRadius: 4,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 16,
                            font: { size: 13 }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    x: {
                        stacked: false,
                        grid: { display: false }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    }
                }
            }
        });
        @endif
    </script>
    @endpush

</x-app-layout>