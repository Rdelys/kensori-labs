@extends('layouts.clients')

@section('title', 'Processus du SMQ')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- =========== HEADER / META (Amélioré CDC) =========== -->
<div class="bg-gradient-to-r from-sky-50 via-white to-indigo-50 p-4 md:p-6 rounded-b-3xl shadow-inner sticky top-0 z-40">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex items-start gap-4">
            <div class="rounded-full bg-white p-3 shadow-md">
                <i class="fa-solid fa-shield-check text-blue-600 text-2xl"></i>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-gray-800 leading-tight">Processus du Système de Management de la Qualité (SMQ)</h1>
                <p class="text-sm text-gray-500 mt-1">Vue consolidée des processus, cartographie, KPI et traçabilité — alignée ISO 9001:2015.</p>
                <p class="text-xs text-gray-400 mt-1">Intégrations & exigences du Cahier des Charges QMS incluses.</p>
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

            <button id="toggleFormBtn" class="bg-gradient-to-b from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-5 py-2 rounded-xl shadow-lg transition transform hover:-translate-y-0.5 flex items-center gap-2">
                <i class="fa-solid fa-plus mr-2"></i> Nouveau Processus
            </button>

            <button id="exportPdfBtn" class="ml-2 bg-white border px-4 py-2 rounded-xl shadow-sm hover:shadow-md text-sm flex items-center gap-2">
                <i class="fa-solid fa-file-export text-gray-700"></i> Exporter PDF
            </button>
        </div>
    </div>
</div>

<!-- =========== MAIN CONTENT =========== -->
<div class="space-y-8 p-4 md:p-10 bg-gray-50 min-h-screen">

    <!-- KPI SUMMARY & MATURITY -->
    <div class="grid md:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-2xl shadow-sm border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500">Processus enregistrés</p>
                    <p id="countProcesses" class="text-2xl font-bold text-gray-800">3</p>
                </div>
                <div class="text-blue-600 text-3xl">
                    <i class="fa-solid fa-diagram-project"></i>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-3">Nombre total de processus présents dans la cartographie.</p>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500">KPI conformes</p>
                    <p id="kpiOkPct" class="text-2xl font-bold text-gray-800">90%</p>
                </div>
                <div class="text-green-500 text-3xl">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-3">Pourcentage de processus avec KPI au-dessus du seuil cible (heuristique).</p>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500">Maturité SMQ</p>
                    <div class="mt-2 w-full bg-gray-100 rounded-full h-3">
                        <div id="maturityBar" class="h-3 rounded-full bg-indigo-500" style="width:72%"></div>
                    </div>
                    <p id="maturityText" class="text-sm mt-2 text-gray-600">72% — Niveau : Opérationnel</p>
                </div>
                <div class="text-indigo-500 text-3xl">
                    <i class="fa-solid fa-check-double"></i>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-3">Évaluation synthétique (automatique) basée sur KPI et présence de processus clés.</p>
        </div>
    </div>

    <!-- Inline Form (non modal) -->
    <section id="processFormPanel" class="hidden bg-white p-6 rounded-2xl shadow-md border border-blue-50 transition-all">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                <i class="fa-solid fa-pen-to-square text-blue-500"></i> Ajouter / Modifier un Processus
            </h2>
            <div class="text-sm text-gray-500">Vous pouvez ajouter un processus conforme à la clause ISO correspondante.</div>
        </div>

        <form id="inlineProcessForm" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>
                <label class="text-sm font-semibold text-gray-600">Nom du Processus <span class="text-red-500">*</span></label>
                <input type="text" id="processName" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required placeholder="Ex: Achats">
                <p class="text-xs text-gray-400 mt-1">Nom lisible du processus (unique si possible).</p>
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-600">Propriétaire <span class="text-red-500">*</span></label>
                <input type="text" id="processOwner" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required placeholder="Ex: Jean Dupont">
                <p class="text-xs text-gray-400 mt-1">Personne responsable du suivi / KPI.</p>
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-600">Clause ISO</label>
                <select id="processClause" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option>4.4 - Processus</option>
                    <option>8.4 - Fournisseurs</option>
                    <option>8.5 - Production</option>
                    <option>8.6 - Livraison</option>
                    <option>9.1 - Performance</option>
                </select>
                <p class="text-xs text-gray-400 mt-1">Clause ISO la plus liée à ce processus.</p>
            </div>

            <div class="md:col-span-3">
                <label class="text-sm font-semibold text-gray-600">Intrants</label>
                <textarea id="processInputs" rows="2" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: Commandes clients, spécifications"></textarea>
                <p class="text-xs text-gray-400 mt-1">Principaux intrants (matières, données, informations).</p>
            </div>

            <div class="md:col-span-3">
                <label class="text-sm font-semibold text-gray-600">Extrants</label>
                <textarea id="processOutputs" rows="2" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: Produits livrés, rapports"></textarea>
                <p class="text-xs text-gray-400 mt-1">Ce que produit le processus (livrables).</p>
            </div>

            <div class="md:col-span-2">
                <label class="text-sm font-semibold text-gray-600">Indicateurs (KPI)</label>
                <input type="text" id="processKpi" class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="ex: Taux de conformité fournisseurs">
                <p class="text-xs text-gray-400 mt-1">Indicateur principal permettant d’évaluer la performance.</p>
            </div>

            <div class="flex items-center gap-3 justify-end md:col-span-3">
                <button type="button" id="cancelInlineForm" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Annuler</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                </button>
            </div>
        </form>
    </section>

    <!-- Description -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border">
        <p class="text-gray-700 leading-relaxed">
            Cette section permet de créer, visualiser et gérer la <strong>cartographie des processus</strong> du SMQ,
            conformément à la norme <strong>ISO 9001:2015 (Clause 4.4)</strong>. Chaque processus comprend ses
            intrants, extrants, indicateurs de performance, ressources associées et interactions avec d’autres processus.
        </p>
    </div>

    <!-- TABLE DES PROCESSUS -->
    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200 overflow-x-auto" id="printArea">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-800">
            <i class="fa-solid fa-table-list text-blue-500"></i> Liste des Processus
        </h2>

        <div class="mb-3 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div class="flex items-center gap-2">
                <input id="searchProcesses" type="text" placeholder="Recherche par nom / propriétaire / clause..." class="border rounded-lg px-3 py-2 text-sm w-64" aria-label="Recherche processus">
                <button id="clearSearch" class="ml-2 text-sm text-gray-500 hover:text-gray-700" title="Effacer la recherche"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="flex items-center gap-2">
                <div class="text-sm text-gray-500">Vue :</div>
                <button id="tableViewBtn" class="px-3 py-1 rounded bg-blue-50 text-blue-600 text-sm">Table</button>
                <button id="cardViewBtn" class="px-3 py-1 rounded text-sm border">Cartes</button>
            </div>
        </div>

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
                        <button class="text-blue-600 hover:text-blue-800 btn-edit" data-id="2" title="éditer"><i class="fa-solid fa-pen"></i></button>
                        <button class="text-red-600 hover:text-red-800 btn-delete" data-id="2" title="supprimer"><i class="fa-solid fa-trash"></i></button>
                        <button class="text-gray-600 hover:text-gray-800 btn-details" data-id="2" title="détails"><i class="fa-solid fa-eye"></i></button>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50 process-row" data-name="Livraison" data-owner="Ali Rabe" data-clause="8.6" data-kpi="Taux de livraison à temps" data-resources="Véhicules, chauffeurs">
                    <td class="p-2 border">Livraison</td>
                    <td class="p-2 border">Ali Rabe</td>
                    <td class="p-2 border">8.6</td>
                    <td class="p-2 border">Taux de livraison à temps</td>
                    <td class="p-2 border">Véhicules, chauffeurs</td>
                    <td class="p-2 border text-center space-x-2">
                        <button class="text-blue-600 hover:text-blue-800 btn-edit" data-id="3" title="éditer"><i class="fa-solid fa-pen"></i></button>
                        <button class="text-red-600 hover:text-red-800 btn-delete" data-id="3" title="supprimer"><i class="fa-solid fa-trash"></i></button>
                        <button class="text-gray-600 hover:text-gray-800 btn-details" data-id="3" title="détails"><i class="fa-solid fa-eye"></i></button>
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
        <button id="exportPdfBtnBottom" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow-md transition">
            <i class="fa-solid fa-file-pdf"></i> Exporter en PDF
        </button>
    </div>
</div>

<!-- Détails Modal (conservé) -->
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
                    <ul id="detailDocs" class="text-sm text-gray-600 list-disc ml-4"></ul>
                </div>
            </div>

            <div>
                <h4 class="font-semibold text-gray-700">Historique & Versions</h4>
                <div id="detailHistory" class="text-sm text-gray-600 space-y-2 mt-2"></div>

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

<!-- Diagramme Mermaid -->
<div class="max-w-7xl mx-auto p-4 md:p-10">
    <div class="bg-white p-6 rounded-2xl shadow-md border">
        <h2 class="text-xl font-semibold mb-4">Cartographie dynamique (diagramme)</h2>
        <div class="prose mb-3 text-sm text-gray-500">
            Le diagramme est généré automatiquement à partir des processus listés. (Basé sur Mermaid.js)
        </div>
        <div id="mermaidArea" class="bg-gray-50 rounded p-4 overflow-auto">
            <div class="mermaid" id="mermaidChart">
                graph LR
                A[Achats] --> B[Production]
                B --> C[Livraison]
                C --> D[Contrôle Qualité]
            </div>
        </div>
    </div>
</div>

<!-- SCRIPTS: Chart.js, Mermaid, html2pdf -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/mermaid/dist/mermaid.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<script>
/* ================== INIT CHARTS ================== */
const kpiCtx = document.getElementById('kpiChart');
new Chart(kpiCtx, {
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
        animation: { duration: 800, easing: 'easeOutQuart' },
        scales: { y: { beginAtZero: true, max: 100 } },
        plugins: { legend: { display: true, position: 'bottom' } }
    }
});

const pieCtx = document.getElementById('pieChart');
new Chart(pieCtx, {
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

/* ================== MERMAID ================== */
mermaid.initialize({ startOnLoad: false, theme: 'default' });
function generateMermaidFromTable() {
    const rows = document.querySelectorAll('#processTable tbody tr');
    const nodes = [];
    const edges = [];
    rows.forEach((r, i) => {
        const name = (r.dataset.name || r.querySelector('td')?.innerText || `P${i}`).replace(/["]/g,'');
        const id = `P${i}`;
        nodes.push(`${id}["${name}"]`);
        if (i > 0) edges.push(`P${i-1} --> ${id}`);
    });
    const graphDef = `graph LR\n${nodes.join('\n')}\n${edges.join('\n')}`;
    const mermaidEl = document.getElementById('mermaidChart');
    mermaidEl.innerHTML = graphDef;
    try { mermaid.init(undefined, mermaidEl); } catch (err) { console.error('Mermaid error', err); }
}
generateMermaidFromTable();

/* ================== UI LOGIC ================== */
const toggleFormBtn = document.getElementById('toggleFormBtn');
const processFormPanel = document.getElementById('processFormPanel');
const inlineForm = document.getElementById('inlineProcessForm');
const cancelInlineForm = document.getElementById('cancelInlineForm');
const searchInput = document.getElementById('searchProcesses');
const clearSearchBtn = document.getElementById('clearSearch');
const filterClause = document.getElementById('filterClause');
const countProcessesEl = document.getElementById('countProcesses');
const kpiOkPctEl = document.getElementById('kpiOkPct');
const maturityBar = document.getElementById('maturityBar');
const maturityText = document.getElementById('maturityText');

function updateSummary() {
    const rows = document.querySelectorAll('#processTable tbody tr');
    countProcessesEl.textContent = rows.length;
    const kpiOk = Array.from(rows).filter(r => {
        const kpi = r.dataset.kpi || '';
        return /taux|Taux|%|Taux de|TRG/i.test(kpi) || kpi.length>0;
    }).length;
    const pct = rows.length ? Math.round((kpiOk / rows.length) * 100) : 0;
    kpiOkPctEl.textContent = pct + '%';
    const maturity = Math.min(95, 50 + Math.round((pct/100) * 50));
    maturityBar.style.width = maturity + '%';
    maturityText.textContent = `${maturity}% — Niveau : ${maturity >= 80 ? 'Mature' : maturity >= 60 ? 'Opérationnel' : 'Débutant'}`;
}
updateSummary();

/* Toggle inline form display */
toggleFormBtn?.addEventListener('click', () => {
    processFormPanel.classList.toggle('hidden');
    if (!processFormPanel.classList.contains('hidden')) setTimeout(()=>document.getElementById('processName').focus(), 120);
});
cancelInlineForm?.addEventListener('click', ()=> {
    inlineForm.reset();
    processFormPanel.classList.add('hidden');
});

/* Search & filter */
searchInput?.addEventListener('input', () => {
    const q = searchInput.value.toLowerCase();
    document.querySelectorAll('#processTable tbody tr').forEach(row => {
        const name = (row.dataset.name || '').toLowerCase();
        const owner = (row.dataset.owner || '').toLowerCase();
        const clause = (row.dataset.clause || '').toLowerCase();
        row.style.display = (!q || name.includes(q) || owner.includes(q) || clause.includes(q)) ? '' : 'none';
    });
});

clearSearchBtn?.addEventListener('click', ()=> {
    searchInput.value = '';
    searchInput.dispatchEvent(new Event('input'));
});

filterClause?.addEventListener('change', ()=> {
    const val = filterClause.value;
    document.querySelectorAll('#processTable tbody tr').forEach(row => {
        if (val === 'all' || row.dataset.clause === val) row.style.display = '';
        else row.style.display = 'none';
    });
    updateSummary();
});

/* Submit inline form -> add row client-side (simulation) */
inlineForm?.addEventListener('submit', (e)=> {
    e.preventDefault();
    const name = document.getElementById('processName').value.trim();
    const owner = document.getElementById('processOwner').value.trim();
    const clause = document.getElementById('processClause').value.trim();
    const inputs = document.getElementById('processInputs').value.trim();
    const outputs = document.getElementById('processOutputs').value.trim();
    const kpi = document.getElementById('processKpi').value.trim();

    if (!name || !owner) { alert('Veuillez renseigner au minimum le nom et le propriétaire du processus.'); return; }

    const tbody = document.querySelector('#processTable tbody');
    const tr = document.createElement('tr');
    tr.className = 'hover:bg-gray-50 process-row';
    tr.setAttribute('data-name', name);
    tr.setAttribute('data-owner', owner);
    tr.setAttribute('data-clause', clause.split(' - ')[0] || clause);
    tr.setAttribute('data-kpi', kpi);
    tr.setAttribute('data-resources', '—');
    tr.setAttribute('data-inputs', inputs);
    tr.setAttribute('data-outputs', outputs);

    tr.innerHTML = `
        <td class="p-2 border">${name}</td>
        <td class="p-2 border">${owner}</td>
        <td class="p-2 border">${clause}</td>
        <td class="p-2 border">${kpi || '—'}</td>
        <td class="p-2 border">—</td>
        <td class="p-2 border text-center space-x-2">
            <button class="text-blue-600 hover:text-blue-800 btn-edit" data-id="new" title="éditer"><i class="fa-solid fa-pen"></i></button>
            <button class="text-red-600 hover:text-red-800 btn-delete" data-id="new" title="supprimer"><i class="fa-solid fa-trash"></i></button>
            <button class="text-gray-600 hover:text-gray-800 btn-details" data-id="new" title="détails"><i class="fa-solid fa-eye"></i></button>
        </td>
    `;
    tbody.appendChild(tr);

    inlineForm.reset();
    processFormPanel.classList.add('hidden');
    generateMermaidFromTable();
    updateSummary();
    attachRowHandlers(tr);

    // hint for backend integration
    console.info('Processus ajouté localement — implémentez un POST côté serveur pour persister.');
});

/* Row handlers (details, edit, delete) */
function attachRowHandlers(row) {
    row.querySelectorAll('.btn-details').forEach(btn => btn.addEventListener('click', () => {
        const tr = btn.closest('tr');
        document.getElementById('detailTitle').textContent = `Processus — ${tr.dataset.name}`;
        document.getElementById('detailOwner').textContent = `Propriétaire: ${tr.dataset.owner || '—'}`;
        document.getElementById('detailClause').textContent = `Clause ISO: ${tr.dataset.clause || '—'}`;
        document.getElementById('detailKpi').textContent = `KPI principal: ${tr.dataset.kpi || '—'}`;
        document.getElementById('detailIO').innerHTML = `<strong>Intrants:</strong> ${tr.dataset.inputs || '—'}<br><strong>Extrants:</strong> ${tr.dataset.outputs || '—'}`;
        document.getElementById('detailDocs').innerHTML = `
            <li><a href="#" class="text-blue-600 hover:underline">Procédure_${tr.dataset.name || 'Process'}.pdf</a></li>
            <li><a href="#" class="text-blue-600 hover:underline">FicheProcess_${tr.dataset.name || 'Process'}.docx</a></li>
        `;
        document.getElementById('detailHistory').innerHTML = `
            <div class="text-xs text-gray-500">12/06/2025 — Création (Jean Dupont)</div>
            <div class="text-xs text-gray-500">20/07/2025 — Mise à jour KPI (Sophie Martin)</div>
        `;
        document.getElementById('detailsModal').classList.remove('hidden');
    }));

    row.querySelectorAll('.btn-delete').forEach(btn => btn.addEventListener('click', () => {
        const tr = btn.closest('tr');
        if (confirm('Confirmez-vous la suppression de ce processus ?')) {
            tr.remove();
            generateMermaidFromTable();
            updateSummary();
        }
    }));

    row.querySelectorAll('.btn-edit').forEach(btn => btn.addEventListener('click', () => {
        const tr = btn.closest('tr');
        // prefill inline form
        document.getElementById('processName').value = tr.dataset.name || '';
        document.getElementById('processOwner').value = tr.dataset.owner || '';
        document.getElementById('processClause').value = tr.dataset.clause ? `${tr.dataset.clause} - ` : '4.4 - Processus';
        document.getElementById('processKpi').value = tr.dataset.kpi || '';
        document.getElementById('processInputs').value = tr.dataset.inputs || '';
        document.getElementById('processOutputs').value = tr.dataset.outputs || '';
        tr.remove(); // remove and let user re-save (simple edit approach)
        processFormPanel.classList.remove('hidden');
        updateSummary();
    }));
}

/* attach for existing rows */
document.querySelectorAll('#processTable tbody tr').forEach(r => attachRowHandlers(r));

/* details modal close */
document.getElementById('closeDetails')?.addEventListener('click', ()=>document.getElementById('detailsModal').classList.add('hidden'));
document.getElementById('closeDetailsBottom')?.addEventListener('click', ()=>document.getElementById('detailsModal').classList.add('hidden'));

/* Export PDF (both buttons) */
function exportPdfFrom(element) {
    const opt = {
      margin:       0.5,
      filename:     'SMQ_Processus.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 2, useCORS: true },
      jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(element).save();
}
document.getElementById('exportPdfBtn')?.addEventListener('click', ()=>exportPdfFrom(document.getElementById('printArea')));
document.getElementById('exportPdfBtnBottom')?.addEventListener('click', ()=>exportPdfFrom(document.getElementById('printArea')));

/* keyboard accessibility */
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        document.getElementById('detailsModal')?.classList.add('hidden');
        processFormPanel?.classList.add('hidden');
    }
});
</script>

<!-- STYLES PREMIUM -->
<style>
/* === STYLE PREMIUM QMS === */
body { background: linear-gradient(to bottom right, #f8fafc, #eef2ff); }

/* Table */
#processTable { border-radius: 12px; overflow: hidden; }
#processTable thead { background: linear-gradient(to right, #dbeafe, #eff6ff); font-weight: 600; }
#processTable tbody tr { transition: all 0.18s ease; }
#processTable tbody tr:hover { background-color: #f9fafb; transform: translateY(-2px); box-shadow: 0 2px 8px rgba(0,0,0,0.04); }

/* Buttons */
button { transition: all 0.18s ease-in-out; }
button:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(59,130,246,0.10); }
button:active { transform: scale(0.99); }

/* Modals */
#detailsModal { animation: fadeIn .22s ease-out; }
@keyframes fadeIn { from { opacity: 0; transform: scale(0.98); } to { opacity:1; transform: scale(1); } }
#detailsModal .bg-white { background: rgba(255,255,255,0.95); backdrop-filter: blur(6px); border: 1px solid rgba(229,231,235,0.7); }

/* Mermaid */
.mermaid { background: linear-gradient(to bottom right, #f9fafb, #f3f4f6); border-radius: 1rem; padding: 1rem; box-shadow: inset 0 0 10px rgba(0,0,0,0.03); }

/* Input focus */
input:focus, textarea:focus, select:focus { box-shadow: 0 0 0 3px rgba(59,130,246,0.12); border-color: #3b82f6; }

/* Buttons in table */
.btn-edit:hover { color: #1d4ed8 !important; transform: scale(1.08); }
.btn-delete:hover { color: #dc2626 !important; transform: scale(1.08); }
.btn-details:hover { color: #374151 !important; transform: scale(1.06); }

/* Smalls */
.prose { margin-bottom: 0; }
</style>

@endsection
