@extends('layouts.clients')

@section('title', 'Processus du SMQ')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- =========== HEADER / META (Ajouts Premium) =========== -->
<div class="bg-gradient-to-r from-sky-50 via-white to-indigo-50 p-4 md:p-6 rounded-b-3xl shadow-inner">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex items-start gap-4">
            <div class="rounded-full bg-white p-3 shadow-md">
                <i class="fa-solid fa-shield-check text-blue-600 text-2xl"></i>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-gray-800 leading-tight">Processus du Système de Management de la Qualité (SMQ)</h1>
                <p class="text-sm text-gray-500 mt-1">Vue consolidée des processus, cartographie, KPI et traçabilité — alignée ISO 9001:2015.</p>
                <p class="text-xs text-gray-400 mt-1">Integrations & exigences du Cahier des Charges QMS inclues. </p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <div class="hidden md:flex items-center gap-2 text-sm">
                <span class="text-gray-500">Filtrer :</span>
                <select id="filterClause" class="border rounded-lg px-3 py-2 text-sm">
                    <option value="all">Toutes les Clauses</option>
                    <option value="4.4">4.4 - Processus</option>
                    <option value="8.4">8.4 - Fournisseurs</option>
                    <option value="8.5">8.5 - Production</option>
                    <option value="9.1">9.1 - Performance</option>
                </select>
            </div>

            <button id="openModalBtn" class="bg-gradient-to-b from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-5 py-2 rounded-xl shadow-lg transition transform hover:-translate-y-0.5">
                <i class="fa-solid fa-plus mr-2"></i> Nouveau Processus
            </button>

            <button id="exportPdfBtn" class="ml-2 bg-white border px-4 py-2 rounded-xl shadow-sm hover:shadow-md text-sm flex items-center gap-2">
                <i class="fa-solid fa-file-export text-gray-700"></i> Exporter PDF
            </button>
        </div>
    </div>
</div>

<!-- =========== MAIN CONTENT (Ton code original) =========== -->
<!-- J'ai laissé TON code EXACT tel quel : -->
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
    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200 overflow-x-auto" id="printArea">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-800">
            <i class="fa-solid fa-table-list text-blue-500"></i> Liste des Processus
        </h2>
        <div class="mb-3 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div class="flex items-center gap-2">
                <input id="searchProcesses" type="text" placeholder="Recherche par nom / propriétaire / clause..." class="border rounded-lg px-3 py-2 text-sm w-64" aria-label="Recherche processus">
                <button id="clearSearch" class="ml-2 text-sm text-gray-500 hover:text-gray-700"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="flex items-center gap-2">
                <div class="text-sm text-gray-500">Vue :</div>
                <button id="tableViewBtn" class="px-3 py-1 rounded bg-blue-50 text-blue-600 text-sm">Table</button>
                <button id="cardViewBtn" class="px-3 py-1 rounded text-sm border">Cartes</button>
            </div>
        </div>

        <!-- TABLE ORIGINEL (inchangé) -->
        <table class="min-w-full border border-gray-200 text-sm text-gray-700" id="processTable">
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
                <tr class="hover:bg-gray-50 process-row" data-name="Achats" data-owner="Jean Dupont" data-clause="8.4" data-kpi="Taux de conformité fournisseurs" data-resources="ERP - Fournisseurs">
                    <td class="p-2 border">Achats</td>
                    <td class="p-2 border">Jean Dupont</td>
                    <td class="p-2 border">8.4</td>
                    <td class="p-2 border">Taux de conformité fournisseurs</td>
                    <td class="p-2 border">ERP - Fournisseurs</td>
                    <td class="p-2 border text-center space-x-2">
                        <button class="text-blue-600 hover:text-blue-800 btn-edit" data-id="1" title="éditer"><i class="fa-solid fa-pen"></i></button>
                        <button class="text-red-600 hover:text-red-800 btn-delete" data-id="1" title="supprimer"><i class="fa-solid fa-trash"></i></button>
                        <button class="text-gray-600 hover:text-gray-800 btn-details" data-id="1" title="détails"><i class="fa-solid fa-eye"></i></button>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50 process-row" data-name="Production" data-owner="Sophie Martin" data-clause="8.5" data-kpi="Taux de rendement global (TRG)" data-resources="Machines CNC, opérateurs">
                    <td class="p-2 border">Production</td>
                    <td class="p-2 border">Sophie Martin</td>
                    <td class="p-2 border">8.5</td>
                    <td class="p-2 border">Taux de rendement global (TRG)</td>
                    <td class="p-2 border">Machines CNC, opérateurs</td>
                    <td class="p-2 border text-center space-x-2">
                        <button class="text-blue-600 hover:text-blue-800 btn-edit" data-id="2"><i class="fa-solid fa-pen"></i></button>
                        <button class="text-red-600 hover:text-red-800 btn-delete" data-id="2"><i class="fa-solid fa-trash"></i></button>
                        <button class="text-gray-600 hover:text-gray-800 btn-details" data-id="2"><i class="fa-solid fa-eye"></i></button>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50 process-row" data-name="Livraison" data-owner="Ali Rabe" data-clause="8.6" data-kpi="Taux de livraison à temps" data-resources="Véhicules, chauffeurs">
                    <td class="p-2 border">Livraison</td>
                    <td class="p-2 border">Ali Rabe</td>
                    <td class="p-2 border">8.6</td>
                    <td class="p-2 border">Taux de livraison à temps</td>
                    <td class="p-2 border">Véhicules, chauffeurs</td>
                    <td class="p-2 border text-center space-x-2">
                        <button class="text-blue-600 hover:text-blue-800 btn-edit" data-id="3"><i class="fa-solid fa-pen"></i></button>
                        <button class="text-red-600 hover:text-red-800 btn-delete" data-id="3"><i class="fa-solid fa-trash"></i></button>
                        <button class="text-gray-600 hover:text-gray-800 btn-details" data-id="3"><i class="fa-solid fa-eye"></i></button>
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
        <form class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="processForm">
            <div>
                <label class="text-sm font-semibold text-gray-600">Nom du Processus</label>
                <input type="text" id="processName" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-600">Propriétaire</label>
                <input type="text" id="processOwner" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-600">Clause ISO</label>
                <select id="processClause" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option>4.4 - Processus</option>
                    <option>8.4 - Fournisseurs</option>
                    <option>8.5 - Production</option>
                    <option>9.1 - Performance</option>
                </select>
            </div>
            <div class="md:col-span-3">
                <label class="text-sm font-semibold text-gray-600">Intrants</label>
                <textarea id="processInputs" rows="2" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
            <div class="md:col-span-3">
                <label class="text-sm font-semibold text-gray-600">Extrants</label>
                <textarea id="processOutputs" rows="2" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
            <div class="md:col-span-3">
                <label class="text-sm font-semibold text-gray-600">Indicateurs (KPI)</label>
                <input type="text" id="processKpi" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="ex: Taux de conformité fournisseurs">
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

<!-- =========== NOUVEAUX MODALS & PANELS PREMIUM (AJOUTS) =========== -->
<!-- Modal Détails Processus (traceability / history / RACI / documents) -->
<div id="detailsModal" class="hidden fixed inset-0 bg-black bg-opacity-40 z-50 p-4">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-2xl overflow-hidden">
        <div class="flex items-center justify-between p-4 border-b">
            <h3 id="detailTitle" class="text-lg font-semibold">Détails du Processus</h3>
            <button id="closeDetails" class="text-gray-500 hover:text-gray-800"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2">
                <div class="mb-4">
                    <h4 class="font-semibold text-gray-700">Informations Générales</h4>
                    <p id="detailOwner" class="text-sm text-gray-600">Propriétaire: -</p>
                    <p id="detailClause" class="text-sm text-gray-600">Clause ISO: -</p>
                    <p id="detailKpi" class="text-sm text-gray-600">KPI: -</p>
                </div>

                <div class="mb-4">
                    <h4 class="font-semibold text-gray-700">Intrants / Extrants</h4>
                    <div id="detailIO" class="text-sm text-gray-600"></div>
                </div>

                <div>
                    <h4 class="font-semibold text-gray-700">Lien vers Documents (Traçabilité)</h4>
                    <ul id="detailDocs" class="text-sm text-gray-600 list-disc ml-4">
                        <!-- exemples -->
                    </ul>
                </div>
            </div>

            <div>
                <h4 class="font-semibold text-gray-700">Historique & Versions</h4>
                <div id="detailHistory" class="text-sm text-gray-600 space-y-2 mt-2">
                    <!-- timeline -->
                </div>

                <div class="mt-4">
                    <h4 class="font-semibold text-gray-700">Statut</h4>
                    <div id="detailStatus" class="mt-2">
                        <span class="inline-block px-3 py-1 rounded-full text-sm bg-green-100 text-green-700">En vigueur</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 border-t flex justify-end gap-3">
            <button id="openInEditor" class="px-4 py-2 bg-blue-50 text-blue-600 rounded">Ouvrir l'éditeur</button>
            <button id="closeDetailsBottom" class="px-4 py-2 bg-gray-100 rounded">Fermer</button>
        </div>
    </div>
</div>

<!-- Diagramme dynamique (Mermaid) -->
<div class="max-w-7xl mx-auto p-4 md:p-10">
    <div class="bg-white p-6 rounded-2xl shadow-md border">
        <h2 class="text-xl font-semibold mb-4">Cartographie dynamique (diagramme)</h2>
        <div class="prose mb-3 text-sm text-gray-500">
            Le diagramme est généré automatiquement à partir des processus listés. (Basé sur Mermaid.js)
        </div>
        <div id="mermaidArea" class="bg-gray-50 rounded p-4">
            <div class="mermaid" id="mermaidChart">
                graph LR
                A[Achats] --> B[Production]
                B --> C[Livraison]
                C --> D[Contrôle Qualité]
            </div>
        </div>
    </div>
</div>

<!-- =========== SCRIPTS (Garde tes scripts initiaux + AJOUTS) =========== -->
<!-- Scripts originaux (inchangés) -->
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

<!-- =========== SCRIPTS PREMIUM (AJOUTS) =========== -->
<!-- mermaid -->
<script src="https://cdn.jsdelivr.net/npm/mermaid/dist/mermaid.min.js"></script>
<!-- html2pdf for export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<script>
/* ========== Utils UI ========== */
const processRows = document.querySelectorAll('.process-row');
const searchInput = document.getElementById('searchProcesses');
const clearSearchBtn = document.getElementById('clearSearch');
const filterClause = document.getElementById('filterClause');

searchInput?.addEventListener('input', () => {
    const q = searchInput.value.toLowerCase();
    processRows.forEach(row => {
        const name = row.dataset.name.toLowerCase();
        const owner = row.dataset.owner.toLowerCase();
        const clause = row.dataset.clause.toLowerCase();
        if (name.includes(q) || owner.includes(q) || clause.includes(q)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

clearSearchBtn?.addEventListener('click', () => {
    searchInput.value = '';
    searchInput.dispatchEvent(new Event('input'));
});

filterClause?.addEventListener('change', () => {
    const val = filterClause.value;
    processRows.forEach(row => {
        if (val === 'all' || row.dataset.clause === val) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

/* View switcher (table / cards) */
const tableViewBtn = document.getElementById('tableViewBtn');
const cardViewBtn = document.getElementById('cardViewBtn');
const processTable = document.getElementById('processTable');

tableViewBtn?.addEventListener('click', () => {
    processTable?.parentElement?.classList.remove('hidden');
    tableViewBtn.classList.add('bg-blue-50','text-blue-600');
    cardViewBtn.classList.remove('bg-blue-50','text-blue-600');
});
cardViewBtn?.addEventListener('click', () => {
    // Simple cards view generation (if needed later) - placeholder
    alert('Vue cartes (à implémenter côté serveur si nécessaire).');
});

/* Modal details handlers */
const detailsModal = document.getElementById('detailsModal');
const detailTitle = document.getElementById('detailTitle');
const detailOwner = document.getElementById('detailOwner');
const detailClause = document.getElementById('detailClause');
const detailKpi = document.getElementById('detailKpi');
const detailIO = document.getElementById('detailIO');
const detailDocs = document.getElementById('detailDocs');
const detailHistory = document.getElementById('detailHistory');

document.querySelectorAll('.btn-details').forEach(btn => {
    btn.addEventListener('click', (e) => {
        const tr = e.target.closest('tr') || e.target.closest('tr.process-row');
        const name = tr.dataset.name;
        const owner = tr.dataset.owner;
        const clause = tr.dataset.clause;
        const kpi = tr.dataset.kpi;
        const resources = tr.dataset.resources;

        detailTitle.textContent = `Processus — ${name}`;
        detailOwner.textContent = `Propriétaire: ${owner}`;
        detailClause.textContent = `Clause ISO: ${clause}`;
        detailKpi.textContent = `KPI principal: ${kpi}`;
        detailIO.innerHTML = `<strong>Ressources:</strong> ${resources}`;

        // Exemple de documents liés (traçabilité)
        detailDocs.innerHTML = `
            <li><a href="#" class="text-blue-600 hover:underline">Procédure_${name}.pdf</a></li>
            <li><a href="#" class="text-blue-600 hover:underline">FicheProcess_${name}.docx</a></li>
        `;

        // Exemple d'historique
        detailHistory.innerHTML = `
            <div class="text-xs text-gray-500">12/06/2025 — Création (Jean Dupont)</div>
            <div class="text-xs text-gray-500">20/07/2025 — Mise à jour KPI (Sophie Martin)</div>
        `;

        detailsModal.classList.remove('hidden');
    });
});

document.getElementById('closeDetails')?.addEventListener('click', () => detailsModal.classList.add('hidden'));
document.getElementById('closeDetailsBottom')?.addEventListener('click', () => detailsModal.classList.add('hidden'));

/* Modal add / edit process (submit) */
document.getElementById('processForm')?.addEventListener('submit', (e) => {
    e.preventDefault();
    // Récupérer les valeurs
    const name = document.getElementById('processName').value.trim();
    const owner = document.getElementById('processOwner').value.trim();
    const clause = document.getElementById('processClause').value.trim();
    const inputs = document.getElementById('processInputs').value.trim();
    const outputs = document.getElementById('processOutputs').value.trim();
    const kpi = document.getElementById('processKpi').value.trim();

    // Ici : appeler une API pour sauvegarder côté serveur (placeholder)
    // Pour la démo on ajoute juste une ligne au tableau (client-side)
    const tbody = document.querySelector('#processTable tbody');
    const tr = document.createElement('tr');
    tr.className = 'hover:bg-gray-50 process-row';
    tr.setAttribute('data-name', name);
    tr.setAttribute('data-owner', owner);
    tr.setAttribute('data-clause', clause.split(' - ')[0] || clause);
    tr.setAttribute('data-kpi', kpi);
    tr.setAttribute('data-resources', '—');

    tr.innerHTML = `
        <td class="p-2 border">${name}</td>
        <td class="p-2 border">${owner}</td>
        <td class="p-2 border">${clause}</td>
        <td class="p-2 border">${kpi}</td>
        <td class="p-2 border">—</td>
        <td class="p-2 border text-center space-x-2">
            <button class="text-blue-600 hover:text-blue-800 btn-edit" data-id="new"><i class="fa-solid fa-pen"></i></button>
            <button class="text-red-600 hover:text-red-800 btn-delete" data-id="new"><i class="fa-solid fa-trash"></i></button>
            <button class="text-gray-600 hover:text-gray-800 btn-details" data-id="new"><i class="fa-solid fa-eye"></i></button>
        </td>
    `;
    tbody.appendChild(tr);

    // Réinitialiser et fermer modal
    document.getElementById('processForm').reset();
    document.getElementById('processModal').classList.add('hidden');

    // Mettre à jour diagramme mermaid (simple regen)
    generateMermaidFromTable();
});

/* Export PDF */
document.getElementById('exportPdfBtn')?.addEventListener('click', () => {
    const element = document.getElementById('printArea');
    const opt = {
      margin:       0.5,
      filename:     'SMQ_Processus.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 2, useCORS: true },
      jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(element).save();
});

/* Mermaid diagram generation (simple) */
mermaid.initialize({ startOnLoad: true });

function generateMermaidFromTable() {
    const rows = document.querySelectorAll('#processTable tbody tr');
    const nodes = [];
    const edges = []; // for demo, we link sequentially
    rows.forEach((r, i) => {
        const name = r.dataset.name || r.querySelector('td')?.innerText || `P${i}`;
        const id = `P${i}`;
        nodes.push(`${id}[${name}]`);
        if (i > 0) {
            edges.push(`P${i-1} --> ${id}`);
        }
    });
    const graphDef = `graph LR\n${nodes.join('\n')}\n${edges.join('\n')}`;
    const mermaidEl = document.getElementById('mermaidChart');
    mermaidEl.innerHTML = graphDef;
    mermaid.init(undefined, mermaidEl);
}

// initial generation
generateMermaidFromTable();

/* Simple delete handler (client-side) */
document.addEventListener('click', (e) => {
    if (e.target.closest('.btn-delete')) {
        const tr = e.target.closest('tr');
        if (confirm('Confirmez-vous la suppression de ce processus ?')) {
            tr.remove();
            generateMermaidFromTable();
        }
    }
});

/* keep original export button (if present) hooking - optional */
document.querySelectorAll('.bg-blue-600 .fa-file-pdf').forEach(btn => {
    /* placeholder if needed */
});

/* Accessibility: focus traps and keyboard shortcuts could be added here */
</script>

<style>
/* Ajouts CSS premium (animations subtiles, card shadows) */
#processTable tbody tr { transition: background 150ms ease, transform 120ms ease; }
#processTable tbody tr:hover { transform: translateY(-2px); }
.mermaid { width: 100%; overflow-x: auto; }
</style>

@endsection
