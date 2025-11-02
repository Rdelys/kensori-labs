@extends('layouts.clients')

@section('title', 'Risques & Opportunités')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<style>
.card { background: white; border-radius: 1rem; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 1.5rem; transition: 0.3s; }
.card:hover { transform: translateY(-4px); }
.grid { display: grid; gap: 2rem; }
.matrix { border-collapse: collapse; width: 100%; }
.matrix th, .matrix td { border: 1px solid #ddd; text-align: center; padding: 0.75rem; }
.matrix th { background-color: #f4f4f4; font-weight: 600; }
.critical-high { background: #ef4444; color: white; }
.critical-medium { background: #f59e0b; color: white; }
.critical-low { background: #10b981; color: white; }
.badge { padding: 0.4rem 0.8rem; border-radius: 0.5rem; font-size: 0.8rem; font-weight: 600; color: white; }
.badge-risk { background-color: #ef4444; }
.badge-opportunity { background-color: #10b981; }
.fade-in { animation: fadeIn 0.4s ease-out both; }
@keyframes fadeIn { from {opacity:0; transform:translateY(6px);} to {opacity:1; transform:none;} }
</style>

<div class="space-y-10 fade-in">

    <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center gap-3">
        <i class="fa-solid fa-triangle-exclamation text-red-500"></i>
        Risques & Opportunités – Système Qualité (ISO 9001:2015 §6.1)
    </h2>

    {{-- SECTION 1 - Graphiques Risques et Opportunités --}}
    <div class="grid md:grid-cols-2">
        <div class="card">
            <h3 class="text-xl font-semibold mb-3 text-gray-700">Répartition des Risques</h3>
            <canvas id="risquesChart"></canvas>
        </div>
        <div class="card">
            <h3 class="text-xl font-semibold mb-3 text-gray-700">Répartition des Opportunités</h3>
            <canvas id="opportunitesChart"></canvas>
        </div>
    </div>

    {{-- SECTION 1B - Calcul brut/net et suivi --}}
    <div class="card">
        <h3 class="text-xl font-semibold mb-4 text-gray-700">
            <i class="fa-solid fa-scale-balanced text-indigo-600"></i> Calcul Brut/Net et Suivi des Risques
        </h3>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h4 class="text-gray-700 font-semibold mb-2"><i class="fa-solid fa-gauge text-red-500"></i> Évaluation Brut vs Net</h4>
                <canvas id="riskEvalChart"></canvas>
            </div>
            <div>
                <h4 class="text-gray-700 font-semibold mb-2"><i class="fa-solid fa-chart-bar text-green-600"></i> Efficacité des Actions</h4>
                <canvas id="efficaciteChart"></canvas>
            </div>
        </div>
    </div>

    {{-- SECTION 2 - Matrice de criticité --}}
    <div class="card">
        <h3 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
            <i class="fa-solid fa-table-cells-large text-indigo-500"></i> Matrice de Criticité (Probabilité × Gravité)
        </h3>
        <table class="matrix text-sm">
            <thead>
                <tr>
                    <th>Probabilité \ Gravité</th>
                    <th>Faible</th>
                    <th>Moyenne</th>
                    <th>Élevée</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Faible</th>
                    <td class="critical-low">Faible</td>
                    <td class="critical-low">Faible</td>
                    <td class="critical-medium">Modérée</td>
                </tr>
                <tr>
                    <th>Moyenne</th>
                    <td class="critical-low">Faible</td>
                    <td class="critical-medium">Modérée</td>
                    <td class="critical-high">Élevée</td>
                </tr>
                <tr>
                    <th>Élevée</th>
                    <td class="critical-medium">Modérée</td>
                    <td class="critical-high">Élevée</td>
                    <td class="critical-high">Critique</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- SECTION 3 - Formulaire Ajout Risque/Opportunité --}}
    <div class="card">
        <h3 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
            <i class="fa-solid fa-plus text-green-600"></i> Ajouter un Risque ou une Opportunité (statique)
        </h3>
        <form id="formRisk" class="grid md:grid-cols-5 gap-4 text-sm">
            <select id="riskType" class="border rounded-lg p-2 focus:ring-2 focus:ring-emerald-300">
                <option value="Risque">Risque</option>
                <option value="Opportunité">Opportunité</option>
            </select>
            <input id="riskDesc" type="text" placeholder="Description" class="border rounded-lg p-2 focus:ring-2 focus:ring-emerald-300 col-span-2">
            <input id="riskResp" type="text" placeholder="Responsable" class="border rounded-lg p-2 focus:ring-2 focus:ring-emerald-300">
            <input id="riskDate" type="date" class="border rounded-lg p-2 focus:ring-2 focus:ring-emerald-300">
            <button id="addRisk" type="button" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg shadow flex items-center justify-center gap-2">
                <i class="fa-solid fa-check"></i> Ajouter
            </button>
        </form>
    </div>

    {{-- SECTION 4 - Suivi des actions --}}
    <div class="card">
        <h3 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
            <i class="fa-solid fa-list-check text-blue-500"></i> Suivi des Actions Risques / Opportunités
        </h3>
        <div id="riskTableWrapper">
            <table id="riskTable" class="table-auto w-full text-sm border-collapse">
                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="p-2">Type</th>
                        <th class="p-2">Description</th>
                        <th class="p-2">Responsable</th>
                        <th class="p-2">Échéance</th>
                        <th class="p-2">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2"><span class="badge badge-risk">Risque</span></td>
                        <td class="p-2">Défaillance du serveur principal</td>
                        <td class="p-2">IT Manager</td>
                        <td class="p-2">20/10/2025</td>
                        <td class="p-2 text-yellow-500 font-semibold">En cours</td>
                    </tr>
                    <tr>
                        <td class="p-2"><span class="badge badge-opportunity">Opportunité</span></td>
                        <td class="p-2">Implémentation d’un système de sauvegarde cloud</td>
                        <td class="p-2">Chef Qualité</td>
                        <td class="p-2">05/11/2025</td>
                        <td class="p-2 text-green-500 font-semibold">Planifiée</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="text-right mt-4">
            <button id="exportPdf" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">
                <i class="fa-solid fa-file-pdf"></i> Exporter PDF
            </button>
        </div>
    </div>

    {{-- SECTION 5 - Validation QMS --}}
    <div class="card">
        <h3 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
            <i class="fa-solid fa-check-double text-green-600"></i> Validation & Suivi Qualité
        </h3>
        <form id="validateForm" class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Validé par</label>
                <input id="validName" type="text" class="border rounded-lg p-2 w-full focus:ring-2 focus:ring-emerald-300" placeholder="Directeur Qualité">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Date</label>
                <input id="validDate" type="date" class="border rounded-lg p-2 w-full focus:ring-2 focus:ring-emerald-300">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm text-gray-600 mb-1">Commentaire</label>
                <textarea id="validComment" rows="3" class="border rounded-lg p-3 w-full focus:ring-2 focus:ring-emerald-300" placeholder="Observations et décisions qualité..."></textarea>
            </div>
            <div class="text-right md:col-span-2">
                <button id="btnValidate" type="button" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-lg shadow">
                    <i class="fa-solid fa-save"></i> Valider
                </button>
            </div>
        </form>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    // Graphiques
    new Chart(document.getElementById('risquesChart'), {
        type: 'pie',
        data: { labels: ['Critiques', 'Modérés', 'Faibles'], datasets: [{ data: [4, 7, 3], backgroundColor: ['#ef4444','#f59e0b','#10b981'] }] },
        options: { plugins: { legend: { position: 'bottom' } } }
    });
    new Chart(document.getElementById('opportunitesChart'), {
        type: 'pie',
        data: { labels: ['Implémentées', 'Planifiées', 'À étudier'], datasets: [{ data: [5, 3, 2], backgroundColor: ['#10b981','#3b82f6','#a855f7'] }] },
        options: { plugins: { legend: { position: 'bottom' } } }
    });

    new Chart(document.getElementById('riskEvalChart'), {
        type: 'bar',
        data: { labels: ['Risque 1', 'Risque 2', 'Risque 3'], datasets: [
            { label: 'Brut', data: [9, 7, 6], backgroundColor: '#ef4444' },
            { label: 'Net', data: [5, 4, 3], backgroundColor: '#10b981' }
        ]},
        options: { responsive: true, plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero:true, max:10 } } }
    });

    new Chart(document.getElementById('efficaciteChart'), {
        type: 'line',
        data: { labels: ['T1', 'T2', 'T3', 'T4'], datasets: [{ label: 'Efficacité (%)', data: [60,70,78,85], borderColor:'#10b981', tension:0.4, fill:true }] },
        options: { plugins: { legend: { position:'bottom' } } }
    });

    // Ajout Risque / Opportunité
    document.getElementById('addRisk').addEventListener('click', () => {
        const type = document.getElementById('riskType').value;
        const desc = document.getElementById('riskDesc').value.trim();
        const resp = document.getElementById('riskResp').value.trim();
        const date = document.getElementById('riskDate').value;
        if(!desc || !resp || !date) return alert('Veuillez remplir tous les champs.');
        const table = document.querySelector('#riskTable tbody');
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="p-2"><span class="badge ${type==='Risque'?'badge-risk':'badge-opportunity'}">${type}</span></td>
            <td class="p-2">${desc}</td>
            <td class="p-2">${resp}</td>
            <td class="p-2">${date}</td>
            <td class="p-2 text-gray-600 font-semibold">Nouveau</td>`;
        table.appendChild(tr);
        alert(`${type} ajouté (statique uniquement).`);
        document.getElementById('formRisk').reset();
    });

    // Validation QMS
    document.getElementById('btnValidate').addEventListener('click', () => {
        const name = document.getElementById('validName').value.trim();
        const date = document.getElementById('validDate').value;
        if(!name || !date) return alert('Nom et date requis.');
        alert(`Validation effectuée par ${name} le ${date}.`);
    });

    // Export PDF
    document.getElementById('exportPdf').addEventListener('click', () => {
        const el = document.getElementById('riskTableWrapper');
        html2pdf().set({ margin:0.5, filename:'Risques_Opportunites_QMS.pdf', jsPDF:{unit:'in', format:'a4', orientation:'landscape'} }).from(el).save();
    });
});
</script>

@endsection
