@extends('layouts.clients')

@section('title', 'Politique de Qualité')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="p-6 md:p-10 bg-gray-50 min-h-screen space-y-10">

    <!-- En-tête -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-scroll text-blue-600"></i>
            Politique Qualité de l’Entreprise
        </h1>
        <div class="flex gap-3">
            <button id="openModalBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow-md transition">
                <i class="fa-solid fa-pen-to-square"></i> Mettre à jour
            </button>
            <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl shadow-md transition">
                <i class="fa-solid fa-file-export"></i> Exporter PDF
            </button>
        </div>
    </div>

    <!-- Section Politique Qualité -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-flag text-blue-500"></i> Politique Qualité Actuelle
        </h2>
        <div class="text-gray-700 leading-relaxed">
            <p>
                La politique qualité de <strong>TechnoFab Industrie</strong> vise à garantir la satisfaction totale de nos clients
                à travers l'amélioration continue de nos processus et le respect des exigences réglementaires et normatives,
                notamment la norme <strong>ISO 9001:2015</strong>.
            </p>
            <ul class="list-disc ml-6 mt-3 space-y-1">
                <li>Assurer la conformité des produits et services livrés.</li>
                <li>Développer les compétences et la sensibilisation du personnel.</li>
                <li>Améliorer en continu l’efficacité du SMQ.</li>
                <li>Renforcer la communication interne et la satisfaction client.</li>
            </ul>
            <p class="mt-4 italic text-gray-600">Dernière mise à jour : 15 septembre 2025 — approuvée par la Direction Générale.</p>

            <!-- Signature -->
            <div class="mt-6 flex flex-col md:flex-row md:items-center md:justify-between border-t pt-4">
                <div>
                    <p class="font-semibold text-gray-800">Validée par :</p>
                    <p>Marie Laurent — Directrice Générale</p>
                    <p class="text-sm text-gray-500">Signature électronique enregistrée</p>
                </div>
                <img src="https://cdn-icons-png.flaticon.com/512/747/747310.png" alt="Signature" class="w-24 opacity-70 mt-3 md:mt-0">
            </div>
        </div>
    </div>

    <!-- Diffusion & Accusés de Lecture -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-share-nodes text-green-500"></i> Diffusion et Accusés de Lecture
        </h2>

        <!-- Mini Formulaire de Diffusion -->
        <form class="mb-6 flex flex-col md:flex-row gap-3">
            <input type="text" placeholder="Destinataire (nom ou service)" class="border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2 w-full md:w-1/2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition">
                <i class="fa-solid fa-paper-plane"></i> Diffuser
            </button>
        </form>

        <!-- Tableau -->
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 text-sm text-gray-700">
                <thead class="bg-green-100">
                    <tr>
                        <th class="p-2 border">Nom</th>
                        <th class="p-2 border">Poste</th>
                        <th class="p-2 border">Date de Diffusion</th>
                        <th class="p-2 border">Accusé de Lecture</th>
                        <th class="p-2 border">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">Jean Dupont</td>
                        <td class="p-2 border">Resp. Production</td>
                        <td class="p-2 border">16/09/2025</td>
                        <td class="p-2 border text-center"><i class="fa-solid fa-check text-green-600"></i></td>
                        <td class="p-2 border text-green-700 font-semibold">Lu</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">Sophie Martin</td>
                        <td class="p-2 border">Contrôle Qualité</td>
                        <td class="p-2 border">16/09/2025</td>
                        <td class="p-2 border text-center"><i class="fa-solid fa-hourglass-half text-yellow-500"></i></td>
                        <td class="p-2 border text-yellow-600 font-semibold">En attente</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">Ali Rabe</td>
                        <td class="p-2 border">Service Logistique</td>
                        <td class="p-2 border">17/09/2025</td>
                        <td class="p-2 border text-center"><i class="fa-solid fa-check text-green-600"></i></td>
                        <td class="p-2 border text-green-700 font-semibold">Lu</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Historique des Versions -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-clock-rotate-left text-orange-500"></i> Historique des Versions
        </h2>
        <ul class="divide-y text-gray-700">
            <li class="py-2"><strong>V1.3</strong> – 15/09/2025 : Actualisation des engagements qualité.</li>
            <li class="py-2"><strong>V1.2</strong> – 10/01/2025 : Ajout des objectifs de satisfaction client.</li>
            <li class="py-2"><strong>V1.1</strong> – 01/07/2024 : Première mise à jour validée par la direction.</li>
        </ul>
    </div>

    <!-- Graphique -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-chart-pie text-blue-500"></i> Taux de Lecture de la Politique Qualité
        </h2>
        <div class="h-64">
            <canvas id="readChart"></canvas>
        </div>
    </div>
</div>

<!-- Modal d’édition -->
<div id="policyModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-3xl relative">
        <button id="closeModalBtn" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <h2 class="text-2xl font-semibold mb-4 text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-pen-to-square text-blue-500"></i> Modifier la Politique Qualité
        </h2>
        <form class="space-y-4">
            <textarea rows="8" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
Notre politique qualité vise à assurer la conformité, la satisfaction client et l'amélioration continue...
            </textarea>
            <div class="flex justify-end gap-3">
                <button type="button" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-gray-700 transition">Annuler</button>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.getElementById('openModalBtn').addEventListener('click', () => {
    document.getElementById('policyModal').classList.remove('hidden');
});
document.getElementById('closeModalBtn').addEventListener('click', () => {
    document.getElementById('policyModal').classList.add('hidden');
});

new Chart(document.getElementById('readChart'), {
    type: 'doughnut',
    data: {
        labels: ['Lu', 'En attente'],
        datasets: [{
            data: [75, 25],
            backgroundColor: ['#34D399', '#FBBF24'],
            hoverOffset: 10
        }]
    },
    options: {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
            legend: { position: 'bottom' },
            title: { display: true, text: 'Taux de lecture global (75%)' }
        }
    }
});
</script>
@endsection
