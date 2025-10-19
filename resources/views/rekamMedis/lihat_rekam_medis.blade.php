<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Rekam Medis Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#1D4ED8',
                        'primary-light': '#EFF6FF',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-white h-screen p-4 shadow-lg hidden md:block border-r border-slate-200">
            <div class="flex items-center mb-8">
                <i class="fas fa-clinic-medical text-primary text-2xl mr-2"></i>
                <h1 class="font-semibold text-lg text-gray-800">Klinik Kampus</h1>
            </div>
            <nav class="space-y-2 text-sm">
                <a href="#" class="flex items-center p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                    <i class="fas fa-home w-5 mr-3 text-gray-500"></i> Dashboard
                </a>
                <a href="/daftar-pasien" class="flex items-center p-2 rounded-lg bg-primary-light text-primary font-semibold transition">
                    <i class="fas fa-notes-medical w-5 mr-3"></i> Rekam Medis Pasien
                </a>
                <a href="#" class="flex items-center p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                    <i class="fas fa-user-plus w-5 mr-3 text-gray-500"></i> Pendaftaran
                </a>
            </nav>
        </aside>

        <main class="flex-1">
            <header class="bg-white h-16 flex items-center justify-between px-6 shadow-sm border-b border-slate-200">
                <h1 class="text-xl font-semibold text-gray-800">Lihat Rekam Medis Pasien</h1>
                <button class="text-sm font-medium border border-gray-300 px-3 py-1 rounded-md bg-white hover:bg-gray-50 transition shadow-sm">
                    dr. Eko Gunawan (Dokter) - Logout
                </button>
            </header>

            <div class="container mx-auto px-4 py-8">
                <div class="max-w-7xl mx-auto">
                    <div class="bg-white p-6 rounded-xl shadow-xl border border-slate-200 mb-8">
                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 items-end">
                            <div class="col-span-full md:col-span-2">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Nama Pasien</label>
                                <div class="relative">
                                    <input type="text" id="search" placeholder="Cari berdasarkan nama atau ID..." class="w-full p-2 pl-10 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="filter-tipe" class="block text-sm font-medium text-gray-700 mb-1">Filter Tipe Pasien</label>
                                <select id="filter-tipe" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                                    <option value="">Semua Tipe</option>
                                    <option value="MAHASISWA">MAHASISWA</option>
                                    <option value="DOSEN">DOSEN</option>
                                    <option value="PEGAWAI">PEGAWAI</option>
                                </select>
                            </div>

                            <button id="apply-filter-btn" class="col-span-1 bg-primary hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 h-10">
                                Terapkan Filter
                            </button>
                        </div>
                    </div>

                    <div class="bg-white shadow-xl rounded-xl border border-slate-200 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID Pasien</th>
                                    <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Lengkap</th>
                                    <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tipe</th>
                                    <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Terakhir Kunjungan</th>
                                </tr>
                            </thead>
                            <tbody id="patient-list-body" class="bg-white divide-y divide-gray-200 text-sm"></tbody>
                        </table>
                    </div>

                    <div class="flex justify-between items-center mt-6 text-sm text-gray-600">
                        <span id="pagination-info">Menampilkan 0 sampai 0 dari 0 Pasien</span>
                        <div class="flex space-x-1">
                            <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">Previous</button>
                            <button class="px-3 py-1 border border-primary bg-primary text-white rounded-lg">1</button>
                            <button class="px-3 py-1 border border-gray-300 rounded-lg hover:bg-gray-100">Next</button>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <script>
        const ALL_PATIENTS = [{
                id: 'P-001',
                name: 'Budi Santoso',
                type: 'DOSEN',
                last_visit: '20 Oktober 2025'
            },
            {
                id: 'P-002',
                name: 'Ani Fitriana',
                type: 'MAHASISWA',
                last_visit: '18 Oktober 2025'
            },
            {
                id: 'P-003',
                name: 'Citra Dewi',
                type: 'PEGAWAI',
                last_visit: '01 Oktober 2025'
            },
            {
                id: 'P-004',
                name: 'Dedi Kurniawan',
                type: 'MAHASISWA',
                last_visit: '29 September 2025'
            },
            {
                id: 'P-005',
                name: 'Eka Lestari',
                type: 'MAHASISWA',
                last_visit: '15 September 2025'
            },
            {
                id: 'P-006',
                name: 'Fajar Nugraha',
                type: 'DOSEN',
                last_visit: '10 September 2025'
            },
            {
                id: 'P-007',
                name: 'Gita Permata',
                type: 'PEGAWAI',
                last_visit: '05 September 2025'
            },
        ];

        const patientListBody = document.getElementById('patient-list-body');
        const searchInput = document.getElementById('search');
        const filterSelect = document.getElementById('filter-tipe');
        const applyFilterBtn = document.getElementById('apply-filter-btn');
        const paginationInfo = document.getElementById('pagination-info');

        function getTypeBadge(type) {
            let colorClass = '';
            switch (type) {
                case 'MAHASISWA':
                    colorClass = 'bg-green-100 text-green-800';
                    break;
                case 'DOSEN':
                    colorClass = 'bg-yellow-100 text-yellow-800';
                    break;
                case 'PEGAWAI':
                    colorClass = 'bg-purple-100 text-purple-800';
                    break;
                default:
                    colorClass = 'bg-gray-100 text-gray-800';
            }
            return `<span class="${colorClass} text-xs font-medium px-2 py-0.5 rounded-full">${type}</span>`;
        }

        function renderPatientList(patients) {
            patientListBody.innerHTML = '';
            if (patients.length === 0) {
                patientListBody.innerHTML = `
                    <tr>
                        <td colspan="4" class="py-8 text-center text-gray-500">
                            Tidak ada data pasien yang ditemukan.
                        </td>
                    </tr>
                `;
            } else {
                patients.forEach(patient => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="py-3 px-4 text-gray-900">${patient.id}</td>
                        <td class="py-3 px-4 text-sm text-blue-600 font-medium hover:underline cursor-pointer">
                            <a href="/rekam-medis/${patient.id.replace('P-', '')}" title="Lihat Detail Rekam Medis">${patient.name}</a>
                        </td>
                        <td class="py-3 px-4 text-gray-700">${getTypeBadge(patient.type)}</td>
                        <td class="py-3 px-4 text-gray-500">${patient.last_visit}</td>
                    `;
                    patientListBody.appendChild(row);
                });
            }

            const count = patients.length;
            const total = ALL_PATIENTS.length;
            paginationInfo.textContent = `Menampilkan 1 sampai ${count} dari ${total} Pasien`;
        }

        function applyFilterAndSearch() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedType = filterSelect.value;

            const filteredPatients = ALL_PATIENTS.filter(patient => {
                const nameMatch = patient.name.toLowerCase().includes(searchTerm) || patient.id.toLowerCase().includes(searchTerm);
                const typeMatch = selectedType === '' || patient.type === selectedType;
                return nameMatch && typeMatch;
            });

            renderPatientList(filteredPatients);
        }

        applyFilterBtn.addEventListener('click', applyFilterAndSearch);

        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                applyFilterAndSearch();
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            renderPatientList(ALL_PATIENTS);
        });
    </script>

</body>

</html>