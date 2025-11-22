@extends('layouts.clients')

@section('title', 'Politique de Qualité')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- HEADER -->
<header class="bg-gradient-to-r from-blue-50 via-white to-indigo-50 border-b border-gray-200 py-6 px-4 md:px-10 shadow-inner">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="bg-white shadow-md p-3 rounded-full">
                <i class="fa-solid fa-scroll text-blue-600 text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-extrabold text-gray-800">Politique Qualité</h1>
            </div>
        </div>
        <div class="flex gap-3">
            <button id="toggleEdit"
                class="bg-gradient-to-b from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-5 py-2 rounded-xl shadow-md transition flex items-center gap-2">
                <i class="fa-solid fa-pen-to-square"></i> Modifier
            </button>
            <button id="exportPdfBtn"
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl shadow-md transition flex items-center gap-2">
                <i class="fa-solid fa-file-export"></i> Exporter PDF
            </button>
        </div>
    </div>
</header>

<!-- CONTENU -->
<main class="p-6 md:p-10 bg-gray-50 min-h-screen space-y-10">

    <!-- POLITIQUE QUALITÉ -->
    <section class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 space-y-6">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-flag text-blue-500"></i> Politique Qualité
        </h2>

        <!-- Zone de texte -->
        <article id="policyView" class="text-gray-700 leading-relaxed">
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
            <p class="mt-4 italic text-gray-600">
                Dernière mise à jour :
                <span id="lastUpdate">15 septembre 2025</span> — approuvée par la Direction Générale.
            </p>
        </article>

        <!-- Formulaire masqué -->
        <div id="policyEdit" class="hidden">
            <textarea id="policyTextarea" rows="10"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 text-gray-700">
La politique qualité de TechnoFab Industrie vise à garantir la satisfaction totale de nos clients à travers l'amélioration continue de nos processus et le respect des exigences réglementaires et normatives, notamment la norme ISO 9001:2015.

- Assurer la conformité des produits et services livrés.
- Développer les compétences et la sensibilisation du personnel.
- Améliorer en continu l’efficacité du SMQ.
- Renforcer la communication interne et la satisfaction client.
            </textarea>
            <div class="flex justify-end gap-3 mt-4">
                <button id="cancelEdit"
                    class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-gray-700 transition">
                    Annuler
                </button>
                <button id="savePolicy"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                </button>
            </div>
        </div>

        <!-- Signature -->
        <div class="mt-6 flex flex-col md:flex-row md:items-center md:justify-between border-t pt-4">
            <div>
                <p class="font-semibold text-gray-800">Validée par :</p>
                <p>Marie Laurent — Directrice Générale</p>
                <p class="text-sm text-gray-500">Signature électronique enregistrée</p>
            </div>
            <img src="https://cdn-icons-png.flaticon.com/512/747/747310.png" alt="Signature"
                class="w-24 opacity-70 mt-3 md:mt-0">
        </div>
    </section>

    <!-- ENGAGEMENT -->
    <section class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-user-tie text-indigo-500"></i> Engagement de la Direction
        </h2>
        <div class="grid md:grid-cols-2 gap-6 text-gray-700">
            <div>
                <ul class="list-disc ml-6 space-y-1">
                    <li>Assurer la mise à disposition des ressources nécessaires au SMQ.</li>
                    <li>Promouvoir une culture qualité et d'amélioration continue.</li>
                    <li>Veiller à l’efficacité des processus et à la satisfaction des parties intéressées.</li>
                    <li>Garantir la conformité à la norme ISO 9001:2015.</li>
                </ul>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Indicateurs de suivi :</p>
                <ul class="list-disc ml-6 mt-2 space-y-1">
                    <li>Taux de satisfaction client ≥ 90 %</li>
                    <li>Objectifs atteints ≥ 85 %</li>
                    <li>Taux de diffusion de la politique ≥ 100 %</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- DIFFUSION -->
    <section class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 space-y-4">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-share-nodes text-green-500"></i> Diffusion et Accusés de Lecture
        </h2>
        <form id="addRecipientForm" class="flex flex-col md:flex-row gap-3">
            <input type="text" id="recipientName" placeholder="Destinataire (nom ou service)"
                class="border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2 w-full md:w-1/2">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition flex items-center gap-2">
                <i class="fa-solid fa-paper-plane"></i> Diffuser
            </button>
        </form>

        <div class="overflow-x-auto">
            <table id="readersTable" class="min-w-full border border-gray-200 text-sm text-gray-700">
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
                    <tr>
                        <td class="p-2 border">Jean Dupont</td>
                        <td class="p-2 border">Resp. Production</td>
                        <td class="p-2 border">16/09/2025</td>
                        <td class="p-2 border text-center"><i class="fa-solid fa-check text-green-600"></i></td>
                        <td class="p-2 border text-green-700 font-semibold">Lu</td>
                    </tr>
                    <tr>
                        <td class="p-2 border">Sophie Martin</td>
                        <td class="p-2 border">Contrôle Qualité</td>
                        <td class="p-2 border">16/09/2025</td>
                        <td class="p-2 border text-center"><i class="fa-solid fa-hourglass-half text-yellow-500"></i></td>
                        <td class="p-2 border text-yellow-600 font-semibold">En attente</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="text-sm text-gray-600">
            <i class="fa-solid fa-info-circle text-blue-500"></i>
            Taux global de lecture :
            <strong id="readRate">50 %</strong>
        </p>
    </section>

    <!-- HISTORIQUE -->
    <section class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-clock-rotate-left text-orange-500"></i> Historique des Versions
        </h2>
        <ul id="versionList" class="divide-y text-gray-700">
            <li class="py-2"><strong>V1.3</strong> – 15/09/2025 : Actualisation des engagements qualité.</li>
            <li class="py-2"><strong>V1.2</strong> – 10/01/2025 : Ajout des objectifs de satisfaction client.</li>
            <li class="py-2"><strong>V1.1</strong> – 01/07/2024 : Première mise à jour validée par la direction.</li>
        </ul>
    </section>

    <!-- KPI CHART -->
    <section class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-chart-pie text-blue-500"></i> Taux de Lecture de la Politique
        </h2>
        <div class="h-64">
            <canvas id="readChart"></canvas>
        </div>
    </section>
</main>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
<script>
/* === Graphique KPI === */
const readChart = new Chart(document.getElementById('readChart'), {
    type: 'doughnut',
    data: {
        labels: ['Lu', 'En attente'],
        datasets: [{
            data: [50, 50],
            backgroundColor: ['#34D399', '#FBBF24']
        }]
    },
    options: {
        maintainAspectRatio: false,
        plugins: {
            legend: { position: 'bottom' },
            title: { display: true, text: 'Taux global de lecture : 50 %' }
        }
    }
});

/* === Inline Edit === */
const toggleEdit = document.getElementById('toggleEdit');
const policyView = document.getElementById('policyView');
const policyEdit = document.getElementById('policyEdit');
const savePolicy = document.getElementById('savePolicy');
const cancelEdit = document.getElementById('cancelEdit');
const policyTextarea = document.getElementById('policyTextarea');
const versionList = document.getElementById('versionList');
const lastUpdate = document.getElementById('lastUpdate');

toggleEdit.addEventListener('click', () => {
    policyView.classList.toggle('hidden');
    policyEdit.classList.toggle('hidden');
    policyTextarea.focus();
});

cancelEdit.addEventListener('click', () => {
    policyEdit.classList.add('hidden');
    policyView.classList.remove('hidden');
});

savePolicy.addEventListener('click', () => {
    const text = policyTextarea.value.trim();
    if (text) {
        policyView.innerHTML = '<pre class="whitespace-pre-wrap text-gray-700">' + text + '</pre>';
        const newDate = new Date().toLocaleDateString('fr-FR');
        lastUpdate.textContent = newDate;
        versionList.insertAdjacentHTML('afterbegin',
            `<li class="py-2"><strong>V${(Math.random() * 10).toFixed(1)}</strong> – ${newDate} : Mise à jour de la politique.</li>`);
        policyEdit.classList.add('hidden');
        policyView.classList.remove('hidden');
    }
});

/* === Diffusion Simulation === */
const addRecipientForm = document.getElementById('addRecipientForm');
const readersTable = document.querySelector('#readersTable tbody');
const readRate = document.getElementById('readRate');

addRecipientForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const name = document.getElementById('recipientName').value.trim();
    if (!name) return;

    readersTable.insertAdjacentHTML('beforeend', `
        <tr>
            <td class="p-2 border">${name}</td>
            <td class="p-2 border">Service</td>
            <td class="p-2 border">${new Date().toLocaleDateString('fr-FR')}</td>
            <td class="p-2 border text-center"><i class="fa-solid fa-hourglass-half text-yellow-500"></i></td>
            <td class="p-2 border text-yellow-600 font-semibold">En attente</td>
        </tr>
    `);

    document.getElementById('recipientName').value = '';
    updateReadRate();
});

function updateReadRate() {
    const total = readersTable.querySelectorAll('tr').length;
    const read = readersTable.querySelectorAll('.fa-check').length;
    const rate = Math.round((read / total) * 100);
    readRate.textContent = rate + '%';
    readChart.data.datasets[0].data = [rate, 100 - rate];
    readChart.update();
}

/* === Export PDF === */
document.getElementById('exportPdfBtn').addEventListener('click', () => {
    const element = document.body;
    const opt = {
        margin: 0.5,
        filename: 'Politique_Qualite_TechnoFab.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(element).save();
});
</script>

<style>
body { background: linear-gradient(to bottom right, #f8fafc, #eef2ff); font-family: 'Inter', sans-serif; }
section { transition: all .2s ease-in-out; }
section:hover { box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05); }
table tbody tr { transition: all .2s ease; }
table tbody tr:hover { transform: scale(1.01); background: #f9fafb; }
textarea { font-family: 'Inter', sans-serif; }
button { transition: all .15s ease-in-out; }
button:hover { transform: translateY(-2px); }
pre { font-family: inherit; }
</style>
@endsection
