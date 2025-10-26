@extends('layouts.clients')

@section('title', 'Matrice RACI')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Tailwind (déjà fourni par ton projet normalement; inclus ici si besoin) -->
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<!-- =========================
     MODERNE DYNAMIQUE - Matrice RACI
     - Ton code original est conservé intégralement.
     - J'ai ajouté des améliorations visuelles et JS fonctionnel côté client.
     ========================= -->

<div class="space-y-10 p-6 bg-gradient-to-b from-gray-50 to-white min-h-screen fade-in">

    <!-- HEADER -->
    <div class="text-center max-w-5xl mx-auto">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-2 flex items-center justify-center gap-3">
            <span class="inline-flex items-center justify-center w-12 h-12 rounded-lg bg-gradient-to-br from-green-500 to-emerald-400 text-white shadow-lg">
                <i class="fa-solid fa-sitemap text-xl"></i>
            </span>
            <span>Matrice RACI – Système Qualité</span>
        </h1>
        <p class="text-gray-500 max-w-2xl mx-auto">Responsabilités, autorités et diffusion automatique selon le QMS — conforme ISO 9001:2015 (Clause 5.3).</p>
    </div>

    <!-- MATRICE RACI -->
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-200 max-w-7xl mx-auto">
        <div class="px-6 py-4 border-b bg-gradient-to-r from-emerald-600 to-green-500 text-white font-semibold flex justify-between items-center">
            <span class="flex items-center gap-2"><i class="fa-solid fa-table-list"></i> Matrice des rôles et responsabilités</span>
            <div class="flex items-center gap-3">
                <button id="btnAutoPush" class="text-white bg-green-700 hover:bg-green-800 px-4 py-1 rounded-full text-sm shadow transition">
                    <i class="fa-solid fa-cloud-arrow-up mr-1"></i> Diffusion auto
                </button>
                <div class="text-xs text-white/80">Dernière diffusion : <span id="lastPush" class="font-medium ml-1">12/10/2025 14:32</span></div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <!-- table wrapper with subtle shadow & spacing -->
            <div class="p-6">
                <!-- Responsive table: keep original structure exactly, only wrapped -->
                <table class="min-w-full text-sm text-gray-700 text-center rounded-lg overflow-hidden shadow-sm">
                    <thead class="bg-gray-100 uppercase text-gray-600">
                        <tr>
                            <th class="py-3 px-4 text-left">Processus / Activité</th>
                            <th class="py-3 px-4">Directeur Qualité</th>
                            <th class="py-3 px-4">Responsable Processus</th>
                            <th class="py-3 px-4">Auditeur Interne</th>
                            <th class="py-3 px-4">Opérateur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-green-50 transition">
                            <td class="py-3 px-4 font-medium text-left">Gestion des non-conformités</td>
                            <td class="py-3 px-4 text-green-600 font-bold">A</td>
                            <td class="py-3 px-4 text-blue-600 font-bold">R</td>
                            <td class="py-3 px-4 text-orange-500 font-bold">C</td>
                            <td class="py-3 px-4 text-gray-500 font-bold">I</td>
                        </tr>
                        <tr class="hover:bg-green-50 transition">
                            <td class="py-3 px-4 font-medium text-left">Audit interne qualité</td>
                            <td class="py-3 px-4 text-blue-600 font-bold">R</td>
                            <td class="py-3 px-4 text-gray-500 font-bold">I</td>
                            <td class="py-3 px-4 text-green-600 font-bold">A</td>
                            <td class="py-3 px-4 text-orange-500 font-bold">C</td>
                        </tr>
                        <tr class="hover:bg-green-50 transition">
                            <td class="py-3 px-4 font-medium text-left">Plan de formation</td>
                            <td class="py-3 px-4 text-green-600 font-bold">A</td>
                            <td class="py-3 px-4 text-blue-600 font-bold">R</td>
                            <td class="py-3 px-4 text-gray-500 font-bold">I</td>
                            <td class="py-3 px-4 text-gray-500 font-bold">I</td>
                        </tr>
                        <tr class="hover:bg-green-50 transition">
                            <td class="py-3 px-4 font-medium text-left">Revue de direction</td>
                            <td class="py-3 px-4 text-blue-600 font-bold">R</td>
                            <td class="py-3 px-4 text-green-600 font-bold">A</td>
                            <td class="py-3 px-4 text-gray-500 font-bold">I</td>
                            <td class="py-3 px-4 text-gray-500 font-bold">I</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- EXPORTATION -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-3 px-6 py-3 border-t bg-gradient-to-r from-white to-gray-50">
            <div class="text-sm text-gray-600">Les exports incluent la légende RACI et la version actuelle (statique).</div>
            <div class="flex gap-3">
                <button id="exportPdf" class="bg-green-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-green-600 shadow flex items-center gap-2">
                    <i class="fa-solid fa-file-pdf"></i> Exporter PDF
                </button>
                <button id="exportExcel" class="bg-blue-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-600 shadow flex items-center gap-2">
                    <i class="fa-solid fa-file-excel"></i> Exporter Excel
                </button>
            </div>
        </div>
    </div>

    <!-- LÉGENDE RACI -->
    <div class="max-w-7xl mx-auto px-4">
        <div class="bg-white rounded-xl p-4 shadow border text-sm text-gray-600 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h3 class="font-semibold mb-2 text-gray-800 flex items-center gap-2"><i class="fa-solid fa-circle-info text-green-600"></i> Légende RACI</h3>
                <ul class="grid grid-cols-2 md:grid-cols-4 gap-2 text-sm">
                    <li><span class="font-bold text-blue-600">R</span> : Responsable – Exécute la tâche</li>
                    <li><span class="font-bold text-green-600">A</span> : Approuve – Valide le résultat</li>
                    <li><span class="font-bold text-orange-500">C</span> : Consulté – Donne un avis</li>
                    <li><span class="font-bold text-gray-500">I</span> : Informé – Tient informé</li>
                </ul>
            </div>
            <div class="text-right text-xs text-gray-500">
                <div>Conforme CdC QMS — Rôles & responsabilités (ISO 9001:2015 §5.3).</div>
            </div>
        </div>
    </div>

    <!-- FORMULAIRE AJOUT RÔLE (CONSERVÉ) -->
    <div class="bg-white rounded-2xl p-6 shadow border max-w-7xl mx-auto">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-pen-to-square text-green-600"></i> Gestion des rôles et responsabilités
        </h3>
        <form id="addRaciForm" class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Processus / Activité</label>
                <input id="frmProcess" type="text" placeholder="Ex: Suivi des indicateurs" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-emerald-300">
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">Rôle concerné</label>
                <select id="frmRole" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-emerald-300">
                    <option>Directeur Qualité</option>
                    <option>Responsable Processus</option>
                    <option>Auditeur Interne</option>
                    <option>Opérateur</option>
                </select>
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">Attribution (R, A, C, I)</label>
                <select id="frmAttrib" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-emerald-300">
                    <option>R - Responsable</option>
                    <option>A - Approuve</option>
                    <option>C - Consulté</option>
                    <option>I - Informé</option>
                </select>
            </div>

            <div class="flex items-end justify-end">
                <button id="btnAddRaci" type="button" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow flex items-center gap-2">
                    <i class="fa-solid fa-plus mr-2"></i> Ajouter
                </button>
            </div>
        </form>
    </div>

    <!-- DIFFUSION AUTOMATIQUE -->
    <div class="bg-white rounded-2xl p-6 shadow border text-gray-700 max-w-7xl mx-auto">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-cloud-arrow-up text-green-600"></i> Diffusion automatique des rôles
        </h3>
        <p class="text-sm mb-3">Cette fonction simule la notification automatique des mises à jour de la matrice RACI vers les utilisateurs concernés (statique-demo).</p>

        <div class="flex items-center gap-3">
            <button id="btnSimulatePush" class="bg-gradient-to-br from-green-500 to-emerald-400 text-white px-4 py-2 rounded-lg shadow hover:from-green-600 hover:to-emerald-500 transition flex items-center gap-2">
                <i class="fa-solid fa-paper-plane mr-1"></i> Lancer la diffusion
            </button>
            <span class="text-sm text-gray-500">Dernière diffusion simulée : <b id="simPushTime">—</b></span>
        </div>
    </div>

    <!-- GRAPHIQUE RACI (TAILLE CONTROLÉE) -->
    <div class="bg-white rounded-2xl p-6 shadow border max-w-4xl mx-auto">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-chart-pie text-green-600"></i> Répartition des rôles dans la matrice
        </h3>

        <div class="flex justify-center">
            <!-- wrapper with controlled max size so chart never too large -->
            <div class="w-full max-w-md" role="img" aria-label="Graphique répartition RACI">
                <canvas id="raciChart" style="width:100%; height:320px;"></canvas>
            </div>
        </div>
    </div>

    <!-- FICHES DE POSTE QUALITÉ (CONSERVÉ) -->
    <div class="bg-white rounded-2xl p-6 shadow border max-w-7xl mx-auto">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-id-card-clip text-green-600"></i> Fiches de poste qualité liées
        </h3>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
            <a href="#" class="group block border border-gray-200 hover:border-green-500 rounded-xl p-4 transition shadow-sm hover:shadow-md">
                <i class="fa-solid fa-user-tie text-green-600 text-2xl mb-2"></i>
                <h4 class="font-semibold">Directeur Qualité</h4>
                <p class="text-gray-500 text-sm">Supervision du SMQ, approbation finale et gestion stratégique qualité.</p>
            </a>
            <a href="#" class="group block border border-gray-200 hover:border-green-500 rounded-xl p-4 transition shadow-sm hover:shadow-md">
                <i class="fa-solid fa-gears text-green-600 text-2xl mb-2"></i>
                <h4 class="font-semibold">Responsable Processus</h4>
                <p class="text-gray-500 text-sm">Assure la performance et la conformité des processus opérationnels.</p>
            </a>
            <a href="#" class="group block border border-gray-200 hover:border-green-500 rounded-xl p-4 transition shadow-sm hover:shadow-md">
                <i class="fa-solid fa-user-check text-green-600 text-2xl mb-2"></i>
                <h4 class="font-semibold">Auditeur Interne</h4>
                <p class="text-gray-500 text-sm">Évalue le respect des procédures et propose des actions d'amélioration.</p>
            </a>
        </div>
    </div>

    <!-- ORGANIGRAMME INTERACTIF -->
    <div class="bg-white rounded-2xl p-6 shadow border max-w-7xl mx-auto">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-diagram-project text-green-600"></i> Organigramme interactif
        </h3>

        <div id="organigramme" class="flex flex-col items-center space-y-4">
            <div class="p-4 bg-gradient-to-r from-emerald-600 to-green-500 text-white rounded-xl shadow-lg font-semibold">Directeur Général</div>
            <div class="flex flex-col md:flex-row md:space-x-8 space-y-3 md:space-y-0">
                <div class="p-4 bg-gradient-to-br from-green-500 to-emerald-400 text-white rounded-lg shadow-md">Directeur Qualité</div>
                <div class="p-4 bg-gradient-to-br from-emerald-400 to-lime-400 text-white rounded-lg shadow-md">Responsable Processus</div>
                <div class="p-4 bg-gradient-to-br from-lime-400 to-amber-400 text-white rounded-lg shadow-md">Auditeur Interne</div>
            </div>
            <div class="flex space-x-6">
                <div class="p-3 bg-green-400 text-white rounded-lg shadow-sm text-sm">Opérateurs</div>
                <div class="p-3 bg-green-400 text-white rounded-lg shadow-sm text-sm">Assistants Qualité</div>
            </div>
        </div>

        <!-- FORMULAIRE AJOUT VISUEL -->
        <div class="mt-6 border-t pt-4">
            <h4 class="font-semibold text-gray-700 mb-3 flex items-center gap-2"><i class="fa-solid fa-plus text-green-600"></i> Ajouter un poste</h4>
            <form id="addPostForm" class="grid md:grid-cols-3 gap-4">
                <input id="newRole" type="text" placeholder="Ex : Superviseur Maintenance" class="border rounded-lg p-2 focus:ring-2 focus:ring-emerald-300">
                <select id="roleLevel" class="border rounded-lg p-2 focus:ring-2 focus:ring-emerald-300">
                    <option value="haut">Niveau Haut (Direction)</option>
                    <option value="moyen">Niveau Moyen (Encadrement)</option>
                    <option value="bas">Niveau Bas (Opérationnel)</option>
                </select>
                <button type="button" id="addRole" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow flex items-center justify-center gap-2">
                    <i class="fa-solid fa-user-plus"></i> Ajouter
                </button>
            </form>
        </div>
    </div>

    <!-- VALIDATION -->
    <div class="bg-white rounded-2xl p-6 shadow border max-w-7xl mx-auto">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-check-double text-green-600"></i> Validation et remarques qualité
        </h3>
        <textarea id="validationComment" rows="3" placeholder="Commentaires du Directeur Qualité..." class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-emerald-300"></textarea>
        <div class="text-right mt-3">
            <button id="btnValidate" class="bg-gradient-to-br from-green-600 to-emerald-500 text-white px-5 py-2 rounded-lg hover:from-green-700 hover:to-emerald-600 shadow">
                <i class="fa-solid fa-save mr-1"></i> Valider la matrice
            </button>
        </div>
    </div>
</div>

<!-- =========================
     SCRIPTS : interactions client-side (statique)
     ========================= -->
<script>
document.addEventListener("DOMContentLoaded", () => {

    /* ---------- Graph Chart.js (taille contrôlée) ---------- */
    const ctx = document.getElementById('raciChart').getContext('2d');

    // responsive max size is handled by container CSS (max-w-md, height:320px)
    const raciChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Responsables (R)', 'Approuve (A)', 'Consulté (C)', 'Informé (I)'],
            datasets: [{
                data: [10, 6, 4, 8], // données statiques
                backgroundColor: ['#3B82F6', '#10B981', '#F97316', '#9CA3AF'],
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth:12, padding:12 } },
                tooltip: { callbacks: { label: ctx => `${ctx.label} : ${ctx.formattedValue}` } }
            }
        }
    });

    /* ---------- Simple organigram add (UI only) ---------- */
    document.getElementById('addRole').addEventListener('click', () => {
        const roleInput = document.getElementById('newRole');
        const role = roleInput.value.trim();
        if (!role) return alert("Veuillez entrer un nom de poste !");
        const container = document.getElementById('organigramme');
        const newDiv = document.createElement('div');
        newDiv.textContent = role;
        newDiv.className = "p-3 bg-gradient-to-br from-emerald-300 to-lime-300 text-white rounded-lg shadow-sm text-sm mt-2";
        container.appendChild(newDiv);
        roleInput.value = '';
        // micro-feedback
        newDiv.animate([{ transform: 'translateY(-6px)', opacity: 0 }, { transform: 'translateY(0)', opacity: 1 }], { duration: 300, easing: 'ease-out' });
    });

    /* ---------- Add RACI entry (client side - static) ---------- */
    document.getElementById('btnAddRaci').addEventListener('click', () => {
        const p = document.getElementById('frmProcess').value.trim();
        const r = document.getElementById('frmRole').value;
        const a = document.getElementById('frmAttrib').value;
        if (!p) return alert('Veuillez renseigner le processus / activité.');
        // Simple toast
        showToast(`Entrée ajoutée : ${p} — (${r} : ${a}) — (statique uniquement)`);
        // Reset
        document.getElementById('frmProcess').value = '';
        document.getElementById('frmAttrib').selectedIndex = 0;
    });

    /* ---------- Simulate diffusion push ---------- */
    document.getElementById('btnSimulatePush').addEventListener('click', () => {
        const now = new Date();
        const txt = now.toLocaleString();
        document.getElementById('simPushTime').textContent = txt;
        document.getElementById('lastPush').textContent = txt;
        showToast('Diffusion simulée envoyée aux responsables (statique).');
    });

    /* ---------- Validate matrix ---------- */
    document.getElementById('btnValidate').addEventListener('click', () => {
        const c = document.getElementById('validationComment').value.trim();
        showToast('Matrice validée. Commentaire enregistré (statique).');
        // small visual confirmation
        document.getElementById('btnValidate').classList.add('opacity-80');
        setTimeout(() => document.getElementById('btnValidate').classList.remove('opacity-80'), 900);
    });

    /* ---------- PDF Export (html2pdf) ---------- */
    document.getElementById('exportPdf').addEventListener('click', () => {
        const element = document.querySelector('.max-w-7xl') || document.body;
        const opt = {
            margin: 0.6,
            filename: 'Matrice_RACI_QMS.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true },
            jsPDF: { unit: 'in', format: 'a4', orientation: 'landscape' }
        };
        html2pdf().set(opt).from(element).save();
    });

    /* ---------- Excel Export (client-side) ---------- */
    document.getElementById('exportExcel').addEventListener('click', () => {
        // Build a simple workbook from the table
        const table = document.querySelector('table');
        const wb = XLSX.utils.table_to_book(table, { sheet: "MatriceRACI" });
        XLSX.writeFile(wb, 'Matrice_RACI_QMS.xlsx');
    });

    /* ---------- Auto push button (simulated) ---------- */
    document.getElementById('btnAutoPush').addEventListener('click', () => {
        // simulate small upload animation
        const btn = document.getElementById('btnAutoPush');
        btn.classList.add('opacity-80');
        setTimeout(() => btn.classList.remove('opacity-80'), 700);
        showToast('Diffusion automatique initialisée (statique).');
    });

    /* ---------- Small reusable toast ---------- */
    function showToast(message, timeout = 2500) {
        // create toast container if not exists
        let container = document.getElementById('toastContainer');
        if (!container) {
            container = document.createElement('div');
            container.id = 'toastContainer';
            container.className = 'fixed right-6 bottom-6 flex flex-col gap-2 z-50';
            document.body.appendChild(container);
        }
        const t = document.createElement('div');
        t.className = 'bg-gray-900 text-white px-4 py-2 rounded shadow-lg text-sm animate-pop';
        t.textContent = message;
        container.appendChild(t);
        setTimeout(() => { t.classList.add('opacity-0'); setTimeout(()=>t.remove(),300); }, timeout);
    }

    /* ---------- Simple accessibility: keyboard shortcut to open add form (Alt+N) ---------- */
    document.addEventListener('keydown', (e) => {
        if (e.altKey && e.key.toLowerCase() === 'n') {
            document.getElementById('frmProcess').focus();
            showToast('Raccourci : saisie processus activée');
        }
    });

}); // DOMContentLoaded
</script>

<!-- =========================
     STYLES additionnels (animations, responsiveness)
     ========================= -->
<style>
/* small entrance */
.fade-in { animation: fadeIn 0.32s ease-out both; }
@keyframes fadeIn { from {opacity:0; transform: translateY(6px);} to {opacity:1; transform:none;} }

/* toast animation */
@keyframes pop { 0% { transform: translateY(8px); opacity: 0 } 100% { transform: translateY(0); opacity: 1 } }
.animate-pop { animation: pop 220ms ease-out both; }

/* ensure table cells wrap nicely on very small screens */
table td, table th { word-break: break-word; }

/* control chart wrapper */
canvas { display: block; max-width: 100%; }

/* hover improvements */
table tbody tr:hover { transform: translateY(-4px); transition: transform .12s ease; }

/* mobile spacing */
@media (max-width: 640px) {
    .max-w-7xl { padding-left: 12px; padding-right: 12px; }
}
</style>

@endsection
