@extends('layouts.clients')

@section('title', 'Processus du SMQ')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="space-y-10 p-4 md:p-10 bg-gray-50 min-h-screen">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-diagram-project text-blue-600"></i>
            Processus du Système de Management de la Qualité (SMQ)
        </h1>
        <button id="openModalBtn" class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow-md transition">
            <i class="fa-solid fa-plus"></i> Nouveau Processus
        </button>
    </div>

    <!-- Description -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border">
        <p class="text-gray-700 leading-relaxed">
            Cette section permet de créer, visualiser et gérer la <strong>cartographie des processus</strong> du SMQ,
            conformément à la norme <strong>ISO 9001:2015 (Clause 4.4)</strong>. Chaque processus comprend ses
            intrants, extrants, indicateurs de performance, ressources associées et interactions avec d’autres processus.
        </p>
    </div>

    <!-- Tableau des processus -->
    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200 overflow-x-auto">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-800">
            <i class="fa-solid fa-table-list text-blue-500"></i> Liste des Processus
        </h2>
        <table class="min-w-full border border-gray-200 text-sm text-gray-700">
            <thead class="bg-blue-100">
                <tr>
                    <th class="p-2 border">Nom</th>
                    <th class="p-2 border">Propriétaire</th>
                    <th class="p-2 border">Clause ISO</th>
                    <th class="p-2 border">Indicateurs</th>
                    <th class="p-2 border">Ressources</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-50">
                    <td class="p-2 border">Achats</td>
                    <td class="p-2 border">Jean Dupont</td>
                    <td class="p-2 border">8.4</td>
                    <td class="p-2 border">Taux de conformité fournisseurs</td>
                    <td class="p-2 border">ERP - Fournisseurs</td>
                    <td class="p-2 border text-center space-x-2">
                        <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-pen"></i></button>
                        <button class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="p-2 border">Production</td>
                    <td class="p-2 border">Sophie Martin</td>
                    <td class="p-2 border">8.5</td>
                    <td class="p-2 border">Taux de rendement global (TRG)</td>
                    <td class="p-2 border">Machines CNC, opérateurs</td>
                    <td class="p-2 border text-center space-x-2">
                        <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-pen"></i></button>
                        <button class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="p-2 border">Livraison</td>
                    <td class="p-2 border">Ali Rabe</td>
                    <td class="p-2 border">8.6</td>
                    <td class="p-2 border">Taux de livraison à temps</td>
                    <td class="p-2 border">Véhicules, chauffeurs</td>
                    <td class="p-2 border text-center space-x-2">
                        <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-pen"></i></button>
                        <button class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Graphiques KPI -->
    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-800">
            <i class="fa-solid fa-chart-line text-blue-500"></i> Suivi des Indicateurs de Performance (KPI)
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="h-72">
                <canvas id="kpiChart"></canvas>
            </div>
            <div class="h-72">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Interactions entre Processus -->
    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-800">
            <i class="fa-solid fa-diagram-next text-blue-500"></i> Interactions entre Processus
        </h2>
        <p class="text-gray-600 mb-3">Chaîne d’interaction simplifiée :</p>

        <div class="relative flex flex-col md:flex-row items-center justify-center gap-6 text-center">
            <div class="p-4 bg-blue-100 rounded-lg shadow-sm w-40">
                <i class="fa-solid fa-circle-nodes text-blue-600 text-3xl mb-2"></i>
                <p class="font-semibold text-gray-700">Achats</p>
            </div>
            <i class="fa-solid fa-arrow-right text-gray-500 text-3xl hidden md:block"></i>
            <div class="p-4 bg-green-100 rounded-lg shadow-sm w-40">
                <i class="fa-solid fa-industry text-green-600 text-3xl mb-2"></i>
                <p class="font-semibold text-gray-700">Production</p>
            </div>
            <i class="fa-solid fa-arrow-right text-gray-500 text-3xl hidden md:block"></i>
            <div class="p-4 bg-yellow-100 rounded-lg shadow-sm w-40">
                <i class="fa-solid fa-truck text-yellow-600 text-3xl mb-2"></i>
                <p class="font-semibold text-gray-700">Livraison</p>
            </div>
            <i class="fa-solid fa-arrow-right text-gray-500 text-3xl hidden md:block"></i>
            <div class="p-4 bg-purple-100 rounded-lg shadow-sm w-40">
                <i class="fa-solid fa-clipboard-check text-purple-600 text-3xl mb-2"></i>
                <p class="font-semibold text-gray-700">Contrôle Qualité</p>
            </div>
        </div>
    </div>

    <!-- Export -->
    <div class="flex justify-end mt-6">
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow-md transition">
            <i class="fa-solid fa-file-pdf"></i> Exporter en PDF
        </button>
    </div>
</div>

<!-- Modal Formulaire -->
<div id="processModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-3xl relative">
        <button id="closeModalBtn" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <h2 class="text-2xl font-semibold mb-4 text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-pen-to-square text-blue-500"></i> Ajouter / Modifier un Processus
        </h2>
        <form class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>
                <label class="text-sm font-semibold text-gray-600">Nom du Processus</label>
                <input type="text" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-600">Propriétaire</label>
                <input type="text" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-600">Clause ISO</label>
                <select class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option>4.4 - Processus</option>
                    <option>8.5 - Production</option>
                    <option>9.1 - Performance</option>
                </select>
            </div>
            <div class="md:col-span-3">
                <label class="text-sm font-semibold text-gray-600">Intrants</label>
                <textarea rows="2" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
            <div class="md:col-span-3">
                <label class="text-sm font-semibold text-gray-600">Extrants</label>
                <textarea rows="2" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
            <div class="md:col-span-3 flex justify-end gap-3">
                <button type="reset" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-gray-700 transition">
                    <i class="fa-solid fa-rotate-left"></i> Réinitialiser
                </button>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">
                    <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.getElementById('openModalBtn').addEventListener('click', () => {
    document.getElementById('processModal').classList.remove('hidden');
});
document.getElementById('closeModalBtn').addEventListener('click', () => {
    document.getElementById('processModal').classList.add('hidden');
});

new Chart(document.getElementById('kpiChart'), {
    type: 'bar',
    data: {
        labels: ['Achats', 'Production', 'Livraison', 'Qualité'],
        datasets: [{
            label: 'Performance (%)',
            data: [88, 92, 85, 95],
            backgroundColor: ['#60A5FA', '#34D399', '#FBBF24', '#A78BFA']
        }]
    },
    options: {
        maintainAspectRatio: false,
        responsive: true,
        scales: { y: { beginAtZero: true, max: 100 } },
        plugins: { legend: { display: true, position: 'bottom' } }
    }
});

new Chart(document.getElementById('pieChart'), {
    type: 'doughnut',
    data: {
        labels: ['Achats', 'Production', 'Livraison', 'Qualité'],
        datasets: [{
            data: [20, 40, 25, 15],
            backgroundColor: ['#60A5FA', '#34D399', '#FBBF24', '#A78BFA']
        }]
    },
    options: {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
            legend: { position: 'bottom' },
            title: { display: true, text: 'Répartition des Processus (%)' }
        }
    }
});
</script>
@endsection
