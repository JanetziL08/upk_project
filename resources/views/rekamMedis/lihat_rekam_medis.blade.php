<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Interaktif Rekam Medis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {

                        'primary-green': '#10B981',
                        'danger-red': '#EF4444',
                        'light-blue': '#bfdbfe',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .chart-container {
            position: relative;
            width: 100%;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            height: 300px;
            max-height: 350px;
        }

        @media (min-width: 768px) {
            .chart-container {
                height: 350px;
            }
        }

        .nav-button.active {
            background-color: #0284c7;
            font-weight: 600;
        }

        .therapy-card {
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            padding: 2.5rem;
            background-color: white;
            border-radius: 0.75rem;
        }

        .therapy-header {
            background-color: #bfdbfe;
            padding: 1rem 0;
            margin: -2.5rem -2.5rem 2rem;
            border-radius: 0.75rem 0.75rem 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 2.5rem;
            padding-right: 2.5rem;
        }

        .input-group-field {
            margin-bottom: 1.5rem;
        }

        .input-group-field label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .input-text-style {
            width: 100%;
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.15s;
        }

        .simulated-date-input {
            width: 180px;
            height: 40px;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 8px 12px;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .custom-select-patient {
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="%236b7280"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>');
            background-repeat: no-repeat;
            background-position: right 0.5rem center;
            background-size: 1.5em;
        }

        .records-card {
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .records-header {
            background-color: #bfdbfe;
            padding: 1.5rem 2rem;
            border-radius: 0.75rem 0.75rem 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .records-table-container {
            border: 1px solid #bfdbfe;
            border-radius: 0.5rem;
            overflow: hidden;
            margin: 1.5rem 2rem;
            padding: 0;
        }

        .records-table-row {
            display: grid;
            grid-template-columns: 0.5fr 3fr 2fr 1.5fr 1.5fr;
            border-bottom: 1px solid #e5e7eb;
            transition: background-color 0.2s;
        }

        .records-table-row:nth-child(even) {
            background-color: #eff6ff;
        }

        .records-table-row:last-child {
            border-bottom: none;
        }

        .records-table-cell {
            padding: 0.75rem 1rem;
            color: #374151;
        }

        .records-table-header {
            font-weight: 600;
            background-color: #dbeafe;
            color: #1f2937;
        }
    </style>
</head>

<body class="text-slate-800">

    <div class="container mx-auto p-4 md:p-6">

        <header class="mb-6 pb-4 border-b border-slate-200">
            <h1 class="text-3xl font-bold text-sky-700">Dasbor Rekam Medis Pasien</h1>
            <p class="text-slate-500 mt-1">Pilih pasien untuk melihat ringkasan riwayat, atau untuk memasukkan data diagnosa dan terapi baru.</p>
        </header>

        <div class="bg-white p-4 rounded-xl shadow-md mb-6 sticky top-0 z-10 border border-slate-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex-grow">
                    <label for="patient-select-nav" class="block text-sm font-medium text-slate-700 mb-1">Pilih Pasien:</label>
                    <select id="patient-select-nav" class="w-full p-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                    </select>
                </div>
                <div class="flex items-center gap-2 flex-wrap">
                    <button data-view="records" class="nav-button flex-grow md:flex-grow-0 py-2 px-4 rounded-lg text-slate-700 bg-slate-100 hover:bg-sky-500 hover:text-white transition-colors duration-200">Riwayat Kunjungan</button>
                    <button data-view="summary" class="nav-button flex-grow md:flex-grow-0 py-2 px-4 rounded-lg text-slate-700 bg-slate-100 hover:bg-sky-500 hover:text-white transition-colors duration-200">Ringkasan</button>
                    <button data-view="diagnosis" class="nav-button flex-grow md:flex-grow-0 py-2 px-4 rounded-lg text-slate-700 bg-slate-100 hover:bg-sky-500 hover:text-white transition-colors duration-200">Input Diagnosa</button>
                    <button data-view="therapy" class="nav-button flex-grow md:flex-grow-0 py-2 px-4 rounded-lg text-slate-700 bg-slate-100 hover:bg-sky-500 hover:text-white transition-colors duration-200">Input Terapi</button>
                </div>
            </div>
        </div>

        <main id="app-content">

            <div id="records-view" class="view-content hidden">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-slate-700 mb-4">Rekam Medis Pasien</h2>
                    <p class="text-slate-600 mb-4">
                        Daftar riwayat kunjungan medis untuk pasien yang dipilih.
                    </p>
                </div>

                <div class="records-card">

                    <div class="records-header">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white px-3 py-1 rounded-full text-sky-600 font-semibold text-sm shadow-sm border border-sky-300">
                                Pasien
                            </div>
                            <h5 class="text-xl font-semibold text-slate-800">Daftar Kunjungan</h5>
                        </div>
                        <button class="bg-white border border-gray-300 text-sm py-1 px-4 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                            Logout
                        </button>
                    </div>

                    <div class="px-6 md:px-10 pb-6 pt-4">

                        <div class="flex space-x-4 mb-4">
                            <button class="flex items-center space-x-1 bg-white border border-slate-300 text-slate-700 text-sm py-2 px-4 rounded-lg shadow-sm hover:bg-slate-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <span>Search</span>
                            </button>
                            <button class="flex items-center space-x-1 bg-white border border-slate-300 text-slate-700 text-sm py-2 px-4 rounded-lg shadow-sm hover:bg-slate-100 transition-colors">
                                <!-- Print Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m0 0v-4a2 2 0 012-2h4a2 2 0 012 2v4m0 0h-4m-4 0a2 2 0 100 4h4a2 2 0 100-4h-4z" />
                                </svg>
                                <span>Print</span>
                            </button>
                        </div>

                        <div class="records-table-container">

                            <div class="records-table-row records-table-header">
                                <div class="records-table-cell">No.</div>
                                <div class="records-table-cell">Nama</div>
                                <div class="records-table-cell">Tanggal Kunjungan</div>
                                <div class="records-table-cell">Hari</div>
                                <div class="records-table-cell">Jam</div>
                            </div>

                            <div id="records-table-body">
                            </div>

                        </div>

                        <div class="mt-4 text-center text-slate-500 text-sm" id="records-pagination">
                            Menampilkan 5 dari 5 data kunjungan.
                        </div>

                    </div>
                </div>
            </div>


            <div id="summary-view" class="view-content hidden">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-slate-700 mb-4">Ringkasan Pasien</h2>
                    <p class="text-slate-600 mb-4">
                        Bagian ini memberikan gambaran umum tentang data demografis pasien yang dipilih, serta visualisasi dari riwayat medis mereka.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-1 bg-white p-6 rounded-xl shadow-md border border-slate-200">
                        <h3 class="text-xl font-semibold mb-4 text-sky-700">Info Pasien</h3>
                        <div id="patient-info" class="space-y-3">
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
                            <h3 class="text-xl font-semibold mb-4 text-sky-700">Distribusi Jenis Terapi</h3>
                            <div class="chart-container">
                                <canvas id="therapy-chart"></canvas>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
                            <h3 class="text-xl font-semibold mb-4 text-sky-700">Linimasa Rekam Medis</h3>
                            <div id="medical-history" class="relative border-l-2 border-sky-200 pl-6 space-y-8">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="diagnosis-view" class="view-content hidden">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-slate-700 mb-4">Input Diagnosa Baru</h2>
                    <p class="text-slate-600 mb-4">
                        Gunakan formulir ini untuk mencatat diagnosa baru untuk pasien yang dipilih.
                    </p>
                </div>
                <div class="bg-white p-6 md:p-10 rounded-xl shadow-2xl border border-gray-100 max-w-4xl mx-auto">

                    <h5 class="text-2xl font-bold text-slate-800 border-b pb-3 mb-6">Input Diagnosa Pasien</h5>

                    <form>
                        <div class="space-y-6">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                                <div>
                                    <label for="diag-date" class="block text-sm font-semibold text-slate-700 mb-1">Tanggal Diagnosa</label>
                                    <input type="date" id="diag-date" value="2025-10-11" class="w-full px-4 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-500 transition duration-150">
                                </div>
                                <div>
                                    <label for="diag-doctor" class="block text-sm font-semibold text-slate-700 mb-1">Nama Dokter</label>
                                    <select id="diag-doctor" class="w-full px-4 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-500 transition duration-150 appearance-none bg-white">
                                        <option value="" disabled selected>Pilih Dokter</option>
                                        <option>dr. Anastasiya Sp.OG</option>
                                        <option>dr. Budi Sp.M</option>
                                        <option>dr. Eko Gunawan Sp.PD</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Pasien</label>
                                <input type="text" id="diag-patient-name" class="w-full px-4 py-2 border border-slate-300 rounded-lg bg-gray-100 text-gray-600 shadow-sm cursor-not-allowed" readonly>
                            </div>

                            <div>
                                <label for="diag-details" class="block text-sm font-semibold text-slate-700 mb-1">Diagnosa (Wajib)</label>
                                <textarea id="diag-details" rows="3" class="w-full px-4 py-3 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-500 transition duration-150" placeholder="Masukkan kode ICD-10 atau deskripsi diagnosa medis..." required></textarea>
                            </div>

                            <div class="mb-8">
                                <label for="diag-notes" class="block text-sm font-semibold text-slate-700 mb-1">Keterangan Tambahan</label>
                                <textarea id="diag-notes" rows="3" class="w-full px-4 py-3 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-500 transition duration-150" placeholder="Catatan seperti instruksi pengobatan, resep, atau rujukan."></textarea>
                            </div>
                        </div>

                        <div class="flex justify-center space-x-4">
                            <button type="submit" class="bg-primary-green hover:bg-emerald-600 text-white font-bold py-2 px-8 rounded-xl shadow-lg transform hover:scale-[1.02] transition duration-300 focus:outline-none focus:ring-4 focus:ring-primary-green/50">
                                Simpan
                            </button>
                            <button type="button" class="bg-danger-red hover:bg-red-600 text-white font-bold py-2 px-8 rounded-xl shadow-lg transform hover:scale-[1.02] transition duration-300 focus:outline-none focus:ring-4 focus:ring-danger-red/50">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="therapy-view" class="view-content hidden">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-slate-700 mb-4">Input Terapi Baru</h2>
                    <p class="text-slate-600 mb-4">
                        Di sini Anda dapat memasukkan detail terapi yang diberikan kepada pasien.
                    </p>
                </div>

                <div class="therapy-card">

                    <div class="therapy-header">
                        <h5 class="text-xl font-semibold text-slate-800">Input Terapi</h5>
                        <button class="bg-white border border-gray-300 text-sm py-1 px-4 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                            Logout
                        </button>
                    </div>

                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12">

                            <div>

                                <div class="input-group-field">
                                    <label>Tanggal Terapi :</label>
                                    <div class="simulated-date-input">
                                        <span class="text-slate-700 font-medium">12 / 05 / 2025</span>
                                        <span class="text-xl text-sky-600">&#128197;</span>
                                    </div>
                                </div>

                                <div class="input-group-field">
                                    <label for="therapy-patient-select">Nama Pasien :</label>
                                    <select id="therapy-patient-select" class="input-text-style custom-select-patient border-gray-400">
                                    </select>
                                </div>
                            </div>

                            <div>

                                <div class="input-group-field">
                                    <label for="therapy-type">Jenis Terapi :</label>
                                    <select id="therapy-type" class="input-text-style custom-select-patient border-gray-400">
                                        <option>Fisioterapi</option>
                                        <option>Injeksi</option>
                                        <option>Dosis Obat</option>
                                        <option>Lainnya</option>
                                    </select>
                                </div>

                                <div class="input-group-field">
                                    <label for="therapy-meds">Obat Diberikan :</label>
                                    <input type="text" id="therapy-meds" value="Omeprazole" class="input-text-style border-gray-400">
                                </div>

                                <div class="input-group-field mt-10 md:mt-0 md:row-span-2">
                                    <label for="therapy-notes">Keterangan Tambahan :</label>
                                    <textarea id="therapy-notes" rows="4" class="input-text-style border-gray-400" placeholder="Masukkan catatan tambahan...">Cenderung kram di perut</textarea>
                                </div>

                            </div>
                        </div>

                        <div class="flex justify-between mt-10 md:mt-16 border-t pt-4">
                            <button type="submit" class="bg-primary-green text-white font-bold py-2 px-6 rounded-lg shadow hover:bg-emerald-600 transition-colors">
                                Simpan
                            </button>
                            <button type="button" class="bg-danger-red text-white font-bold py-2 px-6 rounded-lg shadow hover:bg-red-600 transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const DB = {
                patients: [{
                        id: 1,
                        name: 'Bayu Pratama',
                        patientId: '21567482',
                        dob: '1998-08-15',
                        phone: '081234567890',
                        type: 'Mahasiswa'
                    },
                    {
                        id: 2,
                        name: 'Sritika',
                        patientId: '235314178',
                        dob: '1985-04-22',
                        phone: '081298765432',
                        type: 'Dosen'
                    },
                    {
                        id: 3,
                        name: 'Keziana',
                        patientId: '22431678',
                        dob: '2000-11-30',
                        phone: '081211223344',
                        type: 'Pegawai'
                    },
                ],
                records: [{
                        id: 101,
                        patientId: 1,
                        type: 'Diagnosa',
                        date: '2025-06-10',
                        time: '08:00-10:00',
                        title: 'Migrain Akut',
                        details: 'Sakit kepala parah di sisi kanan.',
                        doctor: 'dr. Budi Sp.M'
                    },
                    {
                        id: 102,
                        patientId: 1,
                        type: 'Terapi',
                        date: '2025-06-10',
                        time: '10:00-10:30',
                        title: 'Injeksi Pereda Nyeri',
                        details: 'Diberikan injeksi Ketorolac. Obat: Omeprazole, Paracetamol.'
                    },
                    {
                        id: 103,
                        patientId: 1,
                        type: 'Diagnosa',
                        date: '2025-07-25',
                        time: '14:00-15:00',
                        title: 'Gastritis',
                        details: 'Nyeri ulu hati dan mual.',
                        doctor: 'dr. Eko Gunawan Sp.PD'
                    },
                    {
                        id: 104,
                        patientId: 2,
                        type: 'Diagnosa',
                        date: '2025-08-10',
                        time: '09:00-10:00',
                        title: 'Miopia',
                        details: 'Penglihatan kabur untuk objek jauh.',
                        doctor: 'dr. Budi Sp.M'
                    },
                    {
                        id: 105,
                        patientId: 2,
                        type: 'Terapi',
                        date: '2025-08-12',
                        time: '11:00-11:30',
                        title: 'Resep Kacamata',
                        details: 'Diberikan resep kacamata baru.'
                    },
                    {
                        id: 106,
                        patientId: 3,
                        type: 'Diagnosa',
                        date: '2025-09-15',
                        time: '16:00-17:00',
                        title: 'Infeksi Saluran Pernapasan Atas',
                        details: 'Batuk, pilek, dan demam ringan.',
                        doctor: 'dr. Eko Gunawan Sp.PD'
                    },
                ]
            };

            function getDayName(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', {
                    weekday: 'long'
                });
            }

            let state = {
                selectedPatientId: 1,
                currentView: 'records',
            };

            let therapyChartInstance = null;

            const patientSelectNav = document.getElementById('patient-select-nav');
            const navButtons = document.querySelectorAll('.nav-button');
            const views = document.querySelectorAll('.view-content');

            const patientInfoEl = document.getElementById('patient-info');
            const medicalHistoryEl = document.getElementById('medical-history');
            const diagPatientName = document.getElementById('diag-patient-name');
            const therapyPatientSelect = document.getElementById('therapy-patient-select');

            const recordsTableBody = document.getElementById('records-table-body');

            function populatePatientSelector() {
                [patientSelectNav, therapyPatientSelect].forEach(selectEl => {
                    selectEl.innerHTML = '';
                    DB.patients.forEach(p => {
                        const option = document.createElement('option');
                        option.value = p.id;
                        option.textContent = `${p.name} - ${p.patientId}`;
                        selectEl.appendChild(option);
                    });
                    selectEl.value = state.selectedPatientId;
                });
            }

            function addEventListeners() {
                patientSelectNav.addEventListener('change', (e) => {
                    state.selectedPatientId = parseInt(e.target.value);
                    therapyPatientSelect.value = state.selectedPatientId;
                    render();
                });

                therapyPatientSelect.addEventListener('change', (e) => {
                    state.selectedPatientId = parseInt(e.target.value);
                    patientSelectNav.value = state.selectedPatientId;
                    render();
                });

                navButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        state.currentView = button.dataset.view;
                        render();
                    });
                });
            }

            function render() {
                updateActiveView();
                const patient = DB.patients.find(p => p.id === state.selectedPatientId);

                if (patient) {
                    if (state.currentView === 'summary') {
                        renderPatientInfo(patient);
                        renderMedicalHistory(state.selectedPatientId);
                        renderTherapyChart(state.selectedPatientId);
                    } else if (state.currentView === 'diagnosis') {
                        diagPatientName.value = `${patient.name} - ${patient.patientId}`;
                    } else if (state.currentView === 'therapy') {
                        therapyPatientSelect.value = state.selectedPatientId;
                    } else if (state.currentView === 'records') {
                        renderRecordsTable(state.selectedPatientId, patient);
                    }
                }
            }

            function updateActiveView() {
                views.forEach(view => view.classList.add('hidden'));
                document.getElementById(`${state.currentView}-view`).classList.remove('hidden');

                navButtons.forEach(btn => {
                    btn.classList.toggle('active', btn.dataset.view === state.currentView);
                });
            }

            function renderRecordsTable(patientId, patient) {
                const records = DB.records
                    .filter(r => r.patientId === patientId)
                    .sort((a, b) => new Date(a.date) - new Date(b.date));

                recordsTableBody.innerHTML = '';

                if (records.length === 0) {
                    recordsTableBody.innerHTML = `
                         <div class="records-table-row">
                             <div class="records-table-cell col-span-5 text-center text-slate-500 italic">
                                 Tidak ada riwayat kunjungan untuk pasien ${patient.name}.
                             </div>
                         </div>
                     `;
                    document.getElementById('records-pagination').textContent = "Menampilkan 0 dari 0 data kunjungan.";
                    return;
                }

                records.forEach((record, index) => {
                    const row = document.createElement('div');
                    row.className = 'records-table-row cursor-pointer hover:bg-blue-100/50';
                    const formattedDate = new Date(record.date).toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric'
                    }).replace(/\//g, '-');

                    row.innerHTML = `
                        <div class="records-table-cell">${index + 1}.</div>
                        <div class="records-table-cell">${patient.name}</div>
                        <div class="records-table-cell">${formattedDate}</div>
                        <div class="records-table-cell">${getDayName(record.date)}</div>
                        <div class="records-table-cell">${record.time}</div>
                    `;

                    row.addEventListener('click', () => {
                        console.log(`Detail Kunjungan ID ${record.id}:`, record);
                        alert(`Detail Kunjungan Pasien ${patient.name}:\nTanggal: ${formattedDate}\nJenis: ${record.type}\nJudul: ${record.title}`);
                    });

                    recordsTableBody.appendChild(row);
                });

                document.getElementById('records-pagination').textContent = `Menampilkan ${records.length} dari ${records.length} data kunjungan.`;

            }

            function renderPatientInfo(patient) {
                if (!patient) return;
                patientInfoEl.innerHTML = `
                    <div>
                        <p class="text-sm text-slate-500">Nama Lengkap</p>
                        <p class="font-semibold">${patient.name}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">ID Pasien</p>
                        <p class="font-semibold">${patient.patientId}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Tanggal Lahir</p>
                        <p class="font-semibold">${new Date(patient.dob).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}</p>
                    </div>
                     <div>
                        <p class="text-sm text-slate-500">Tipe Pasien</p>
                        <p class="font-semibold">${patient.type}</p>
                    </div>
                `;
            }

            function renderMedicalHistory(patientId) {
                const records = DB.records.filter(r => r.patientId === patientId).sort((a, b) => new Date(b.date) - new Date(a.date));
                medicalHistoryEl.innerHTML = records.map(record => {
                    const isDiagnosis = record.type === 'Diagnosa';
                    const bgColor = isDiagnosis ? 'bg-sky-100' : 'bg-green-100';
                    const iconColor = isDiagnosis ? 'text-sky-600' : 'text-green-600';
                    const icon = isDiagnosis ? '&#9776;' : '&#10010;';

                    return `
                        <div class="relative">
                            <div class="absolute -left-[34px] top-1 h-6 w-6 rounded-full ${bgColor} flex items-center justify-center ${iconColor} font-bold text-lg">${icon}</div>
                            <div class="${bgColor} p-4 rounded-lg">
                                <p class="text-sm text-slate-500">${new Date(record.date).toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' })}</p>
                                <h4 class="font-semibold text-lg ${iconColor}">${record.title}</h4>
                                <p class="text-slate-700 mt-1">${record.details}</p>
                                ${record.doctor ? `<p class="text-xs text-slate-500 mt-2">Diperiksa oleh: ${record.doctor}</p>` : ''}
                            </div>
                        </div>
                    `;
                }).join('');
                if (records.length === 0) {
                    medicalHistoryEl.innerHTML = `<p class="text-slate-500">Belum ada riwayat rekam medis untuk pasien ini.</p>`;
                }
            }

            function renderTherapyChart(patientId) {
                const records = DB.records.filter(r => r.patientId === patientId && r.type === 'Terapi');
                const therapyCounts = records.reduce((acc, record) => {
                    let type = 'Lainnya';
                    if (record.title.toLowerCase().includes('fisioterapi')) type = 'Fisioterapi';
                    if (record.title.toLowerCase().includes('injeksi')) type = 'Injeksi';
                    if (record.title.toLowerCase().includes('resep')) type = 'Resep Obat';

                    acc[type] = (acc[type] || 0) + 1;
                    return acc;
                }, {});

                const ctx = document.getElementById('therapy-chart').getContext('2d');
                if (therapyChartInstance) {
                    therapyChartInstance.destroy();
                }

                if (Object.keys(therapyCounts).length === 0) {
                    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
                    ctx.font = "16px Inter";
                    ctx.fillStyle = "#64748b";
                    ctx.textAlign = "center";
                    ctx.fillText("Tidak ada data terapi.", ctx.canvas.width / 2, ctx.canvas.height / 2);
                    return;
                }

                therapyChartInstance = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: Object.keys(therapyCounts),
                        datasets: [{
                            label: 'Jumlah Terapi',
                            data: Object.values(therapyCounts),
                            backgroundColor: ['#38bdf8', '#4ade80', '#fbbf24', '#a78bfa'],
                            borderColor: '#fff',
                            borderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    font: {
                                        family: 'Inter'
                                    }
                                }
                            },
                            tooltip: {
                                titleFont: {
                                    family: 'Inter'
                                },
                                bodyFont: {
                                    family: 'Inter'
                                },
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.parsed !== null) {
                                            label += context.parsed + ' kali';
                                        }
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            function init() {
                state.selectedPatientId = DB.patients[0].id;
                populatePatientSelector();
                addEventListeners();
                render();
            }

            init();
        });
    </script>
</body>

</html>