<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                📖 Dashboard Santri
            </h2>
            <span class="text-sm text-gray-500 dark:text-gray-400">
                Halo, {{ Auth::user()->name }} 👋
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- KARTU STATISTIK --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 text-center border-l-4 border-indigo-500">
                    <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $total }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Total Hafalan</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 text-center border-l-4 border-green-500">
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $selesai }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Selesai</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 text-center border-l-4 border-yellow-400">
                    <p class="text-3xl font-bold text-yellow-500 dark:text-yellow-300">{{ $proses }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Sedang Proses</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 text-center border-l-4 border-red-500">
                    <p class="text-3xl font-bold text-red-500 dark:text-red-400">{{ $belum }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Belum Disetorkan</p>
                </div>

            </div>

            {{-- CHART + NILAI --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Donut Chart Progress --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">
                        📊 Grafik Progress Hafalan
                    </h3>
                    @if($total > 0)
                        <div class="flex justify-center" style="height: 280px;">
                            <canvas id="chartProgress"></canvas>
                        </div>
                    @else
                        <div class="flex items-center justify-center h-48 text-gray-400">
                            <p>Belum ada data hafalan.</p>
                        </div>
                    @endif
                </div>

                {{-- Statistik Nilai --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 flex flex-col justify-center items-center space-y-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 self-start w-full">
                        🏆 Statistik Nilai
                    </h3>

                    <div class="text-center">
                        <p class="text-gray-400 dark:text-gray-500 text-sm mb-1">Rata-rata Nilai Hafalan</p>
                        <p class="text-7xl font-bold text-indigo-600 dark:text-indigo-400">
                            {{ $rataRata ? number_format($rataRata, 0) : '-' }}
                        </p>
                        <p class="text-gray-400 dark:text-gray-500 text-xs mt-1">dari skala 100</p>
                    </div>

                    <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-4 mt-4">
                        <div
                            class="bg-indigo-500 h-4 rounded-full transition-all duration-500"
                            style="width: {{ $persenSelesai }}%">
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $persenSelesai }}% hafalan selesai
                    </p>
                </div>

            </div>

            {{-- TABEL RIWAYAT HAFALAN --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">
                    📋 Riwayat Setoran Hafalan
                </h3>

                @if($hafalan->isEmpty())
                    <div class="text-center py-12">
                        <p class="text-gray-400 dark:text-gray-500 text-lg">Belum ada hafalan tercatat.</p>
                        <p class="text-gray-300 dark:text-gray-600 text-sm mt-2">
                            Hubungi Guru untuk menambahkan setoran hafalan kamu.
                        </p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left">
                            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs tracking-wider">
                                <tr>
                                    <th class="px-4 py-3 rounded-tl-lg">No</th>
                                    <th class="px-4 py-3">Nama Surah</th>
                                    <th class="px-4 py-3">Ayat</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Nilai</th>
                                    <th class="px-4 py-3 rounded-tr-lg">Catatan Guru</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach($hafalan as $index => $h)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                    <td class="px-4 py-3 text-gray-400">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-200">
                                        {{ $h->surah->nama_surah ?? '-' }}
                                        <span class="text-xs text-gray-400 ml-1">
                                            (QS. {{ $h->surah->nomor_surah ?? '' }})
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                        Ayat {{ $h->ayat_mulai }} – {{ $h->ayat_selesai }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($h->status === 'selesai')
                                            <span class="inline-flex items-center gap-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 text-xs font-medium px-2.5 py-1 rounded-full">
                                                ✅ Selesai
                                            </span>
                                        @elseif($h->status === 'proses')
                                            <span class="inline-flex items-center gap-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-300 text-xs font-medium px-2.5 py-1 rounded-full">
                                                🔄 Proses
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 text-xs font-medium px-2.5 py-1 rounded-full">
                                                ⏳ Belum
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($h->nilai)
                                            <span class="font-bold text-indigo-600 dark:text-indigo-400 text-base">
                                                {{ $h->nilai }}
                                            </span>
                                        @else
                                            <span class="text-gray-300 dark:text-gray-600">—</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-gray-500 dark:text-gray-400 italic text-xs">
                                        {{ $h->catatan_guru ?? '—' }}
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
        @if($total > 0)
        const ctx = document.getElementById('chartProgress').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Selesai', 'Sedang Proses', 'Belum'],
                datasets: [{
                    data: [{{ $selesai }}, {{ $proses }}, {{ $belum }}],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.85)',
                        'rgba(234, 179, 8, 0.85)',
                        'rgba(239, 68, 68, 0.85)'
                    ],
                    borderColor: [
                        'rgba(34, 197, 94, 1)',
                        'rgba(234, 179, 8, 1)',
                        'rgba(239, 68, 68, 1)'
                    ],
                    borderWidth: 2,
                    hoverOffset: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 13 },
                            padding: 16,
                            usePointStyle: true,
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const persen = total > 0 ? Math.round((context.raw / total) * 100) : 0;
                                return ` ${context.label}: ${context.raw} (${persen}%)`;
                            }
                        }
                    }
                }
            }
        });
        @endif
    </script>
    @endpush

</x-app-layout>