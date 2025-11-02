@extends('layouts.clients')

@section('title', 'Documentation Qualité')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<style>
body{background:#f8fafc}
.card{background:rgba(255,255,255,.9);backdrop-filter:blur(8px);border-radius:16px;box-shadow:0 8px 20px rgba(0,0,0,.06);padding:1.8rem;transition:.3s}
.card:hover{transform:translateY(-3px)}
.section-header{font-size:1.35rem;font-weight:700;color:#1e3a8a;display:flex;align-items:center;gap:8px;margin-bottom:1rem}
.btn-main{background:#2563eb;color:#fff;padding:10px 18px;border-radius:10px;font-weight:600;box-shadow:0 3px 10px rgba(37,99,235,.3);transition:.25s}
.btn-main:hover{background:#1d4ed8;transform:translateY(-2px)}
canvas{max-width:100%;height:180px!important;margin:auto;display:block}
.info-box{background:linear-gradient(to right,#eff6ff,#fff);border:1px solid #dbeafe;border-radius:14px;padding:1rem 1.5rem;color:#374151;font-size:.9rem}
#ficheFormContainer,#newDocFormContainer{display:none;animation:fadeIn .3s ease}
@keyframes fadeIn{from{opacity:0;transform:translateY(-6px)}to{opacity:1;transform:translateY(0)}}
</style>

<div class="space-y-10 fade-in">

    {{-- EN-TÊTE --}}
    <div class="flex items-center justify-between border-b pb-4">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-folder-open text-blue-600"></i> Documentation Qualité
        </h1>
        <button id="addDocBtn" class="btn-main flex items-center gap-2"><i class="fa-solid fa-plus"></i> Nouveau Document</button>
    </div>

    {{-- 🌟 FORMULAIRE NOUVEAU DOCUMENT (AJOUTÉ ICI) --}}
    <div id="newDocFormContainer" class="card border border-blue-100 shadow-inner">
        <h2 class="section-header"><i class="fa-solid fa-file-circle-plus text-blue-600"></i> Nouveau Document</h2>
        <form id="newDocForm" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Nom du document</label>
                <input type="text" class="w-full p-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Type</label>
                <select class="w-full p-2 border rounded-lg" required>
                    <option>Procédure</option>
                    <option>Instruction</option>
                    <option>Fiche</option>
                    <option>Manuel</option>
                    <option>Autre</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Auteur</label>
                <input type="text" class="w-full p-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Approbateur</label>
                <input type="text" class="w-full p-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Version initiale</label>
                <input type="text" placeholder="ex: V1.0" class="w-full p-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Statut</label>
                <select class="w-full p-2 border rounded-lg">
                    <option>Brouillon</option>
                    <option>En révision</option>
                    <option>Approuvé</option>
                    <option>Archivé</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-medium mb-1">Description / Objectif</label>
                <textarea rows="3" class="w-full p-2 border rounded-lg" placeholder="Décrire l’objet et le but du document..."></textarea>
            </div>
            <div class="text-right md:col-span-2 space-x-2">
                <button type="button" id="cancelNewDocBtn" class="btn-main bg-gray-400 hover:bg-gray-500">
                    <i class="fa-solid fa-xmark"></i> Annuler
                </button>
                <button type="submit" class="btn-main">
                    <i class="fa-solid fa-check"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>

    {{-- RECHERCHE / FILTRES --}}
    <div class="card bg-gradient-to-r from-blue-50 to-blue-100 shadow">
        <h2 class="section-header"><i class="fa-solid fa-magnifying-glass"></i> Recherche & Filtres</h2>
        <form class="grid grid-cols-1 md:grid-cols-4 gap-3">
            <input type="text" placeholder="Nom du document" class="p-2 border rounded-lg">
            <select class="p-2 border rounded-lg">
                <option>Type</option><option>Procédure</option><option>Instruction</option><option>Fiche</option><option>Manuel</option>
            </select>
            <select class="p-2 border rounded-lg">
                <option>Statut</option><option>Brouillon</option><option>En révision</option><option>Approuvé</option><option>Archivé</option>
            </select>
            <button type="button" class="btn-main"><i class="fa-solid fa-search"></i> Rechercher</button>
        </form>
    </div>

    {{-- REGISTRE DES DOCUMENTS --}}
    <div class="card">
        <h2 class="section-header"><i class="fa-solid fa-table text-blue-600"></i> Registre des Documents</h2>
        <span class="text-sm text-gray-500 mb-3 block">Contrôle des versions & traçabilité complète (ISO 9001 §7.5.3)</span>

        <table id="registreDocs" class="w-full border-collapse text-sm">
            <thead class="bg-blue-50 text-gray-700 uppercase">
                <tr><th class="p-3 text-left">Nom</th><th class="p-3 text-left">Type</th><th class="p-3 text-left">Version</th><th class="p-3 text-left">Auteur</th><th class="p-3 text-left">Approbateur</th><th class="p-3 text-left">Statut</th><th class="p-3 text-center">Actions</th></tr>
            </thead>
            <tbody>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">Manuel Qualité</td><td class="p-3">Manuel</td><td class="p-3">V2.1</td>
                    <td class="p-3">J. Dupont</td><td class="p-3">D. Martin</td>
                    <td class="p-3"><span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Approuvé</span></td>
                    <td class="p-3 text-center space-x-2">
                        <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-eye"></i></button>
                        <button class="text-yellow-500 hover:text-yellow-700"><i class="fa-solid fa-clock-rotate-left"></i></button>
                        <button class="text-red-600 hover:text-red-800"><i class="fa-solid fa-archive"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="text-right mt-4">
            <button id="exportPdfBtn" class="btn-main bg-indigo-600"><i class="fa-solid fa-file-pdf"></i> Exporter PDF</button>
        </div>
    </div>

    {{-- GESTION DES VERSIONS --}}
    <div class="card bg-gray-50">
        <h2 class="section-header"><i class="fa-solid fa-code-branch text-blue-600"></i> Gestion des Versions & Workflows</h2>
        <div class="grid md:grid-cols-2 gap-6 text-gray-700 text-sm">
            <ul class="list-disc pl-6 space-y-1">
                <li>Cycle : Brouillon → Révision → Approbation → Publication → Archivage.</li>
                <li>Historique automatique (auteur, date, commentaire).</li>
                <li>Archivage après nouvelle version (QMS §7.5.3.2).</li>
                <li>Notification automatique aux approbateurs.</li>
            </ul>
            <ul class="list-disc pl-6 space-y-1">
                <li>Workflow personnalisable par type.</li>
                <li>Droits d’accès par rôle (ISO 9001 §5.3).</li>
                <li>Recherche par métadonnées et clause ISO.</li>
            </ul>
        </div>
    </div>

    {{-- MANUEL QUALITÉ --}}
    <div class="card">
        <h2 class="section-header"><i class="fa-solid fa-book text-blue-600"></i> Manuel Qualité</h2>
        <p class="text-gray-700 mb-3">Le Manuel Qualité décrit la politique, les objectifs et l’organisation du SMQ conformément à la norme ISO 9001 : 2015 (§4 à 10).</p>
        <a href="#" class="btn-main"><i class="fa-solid fa-download mr-2"></i> Télécharger</a>
    </div>

    {{-- FICHES PROCESSUS --}}
    <div class="card bg-gray-100">
        <h2 class="section-header"><i class="fa-solid fa-diagram-project text-blue-600"></i> Fiches Processus (Clause 4.4)</h2>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach (['Achats'=>'Suivi fournisseurs et contrôle qualité','Production'=>'Gestion des opérations','Qualité'=>'Audits et amélioration continue'] as $titre=>$desc)
            <div class="bg-white p-5 rounded-lg shadow hover:shadow-md transition">
                <h3 class="font-semibold text-gray-800 mb-2">{{ $titre }}</h3>
                <p class="text-sm text-gray-600">{{ $desc }}</p>
                <button class="btn-main mt-3 text-sm px-3 py-1.5 open-form" data-title="{{ $titre }}">
                    <i class="fa-solid fa-pen-to-square mr-1"></i> Remplir la fiche
                </button>
            </div>
            @endforeach
        </div>

        {{-- Formulaire intégré (apparition/disparition) --}}
        <div id="ficheFormContainer" class="bg-white border border-blue-100 rounded-lg p-6 mt-4 shadow-inner">
            <h3 id="ficheFormTitle" class="text-xl font-semibold text-blue-700 mb-4">Remplir la fiche</h3>
            <form id="ficheForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Responsable</label>
                    <input type="text" class="w-full p-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" class="w-full p-2 border rounded-lg" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Commentaire</label>
                    <textarea rows="3" class="w-full p-2 border rounded-lg" placeholder="Ajouter un commentaire..."></textarea>
                </div>
                <div class="text-right md:col-span-2 space-x-2">
                    <button type="button" id="cancelFormBtn" class="btn-main bg-gray-400 hover:bg-gray-500"><i class="fa-solid fa-xmark"></i> Annuler</button>
                    <button type="submit" class="btn-main"><i class="fa-solid fa-check"></i> Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    {{-- RECHERCHE FULL-TEXT --}}
    <div class="card">
        <h2 class="section-header"><i class="fa-solid fa-database text-blue-600"></i> Indexation & Recherche Full-Text</h2>
        <div class="grid md:grid-cols-2 gap-6 text-sm text-gray-700">
            <div>
                <input type="text" placeholder="🔍 Mot-clé..." class="w-full p-2 border rounded-lg mb-3">
                <ul class="list-disc pl-6 space-y-1">
                    <li>Indexation automatique à chaque mise à jour.</li>
                    <li>Recherche dans PDF / DOCX / formulaires.</li>
                    <li>Filtres : date, auteur, statut, clause ISO.</li>
                </ul>
            </div>
            <div class="flex justify-center"><canvas id="rechercheChart"></canvas></div>
        </div>
    </div>

    {{-- ACCUSÉ DE LECTURE --}}
    <div class="card bg-gray-50">
        <h2 class="section-header"><i class="fa-solid fa-envelope-open-text text-blue-600"></i> Accusé de Lecture</h2>
        <table class="w-full text-sm border-collapse mb-6">
            <thead class="bg-blue-50 text-gray-700"><tr><th class="p-3 text-left">Utilisateur</th><th class="p-3 text-left">Document</th><th class="p-3 text-left">Date</th><th class="p-3 text-left">Statut</th></tr></thead>
            <tbody>
                <tr class="border-b hover:bg-gray-50"><td class="p-3">Jean Dupont</td><td class="p-3">Manuel Qualité</td><td class="p-3">22/10/2025</td><td class="p-3 text-green-600 font-semibold">Lu</td></tr>
                <tr class="border-b hover:bg-gray-50"><td class="p-3">Sophie Martin</td><td class="p-3">Procédure Contrôle</td><td class="p-3">—</td><td class="p-3 text-red-500 font-semibold">Non lu</td></tr>
            </tbody>
        </table>
        <div class="grid md:grid-cols-2 gap-6 items-center">
            <div class="flex justify-center"><canvas id="lectureChart"></canvas></div>
            <div class="info-box">
                <ul class="list-disc pl-5 space-y-1">
                    <li>Accusé de lecture obligatoire par utilisateur.</li>
                    <li>Rappels automatiques aux retardataires.</li>
                    <li>Indicateur de taux de lecture global : 75 %.</li>
                </ul>
            </div>
        </div>
    </div>

</div>

<script>
// Export PDF
document.getElementById('exportPdfBtn').addEventListener('click',()=>{
    const el=document.getElementById('registreDocs');
    html2pdf().set({margin:0.5,filename:'Registre_Documents_QMS.pdf',jsPDF:{unit:'in',format:'a4',orientation:'landscape'}}).from(el).save();
});

// Charts
new Chart(document.getElementById('rechercheChart'),{
    type:'bar',
    data:{labels:['Docs trouvés','Temps (ms)','Pertinence (%)'],datasets:[{data:[42,180,92],backgroundColor:['#2563eb','#10b981','#f59e0b'],borderRadius:8}]},
    options:{plugins:{legend:{display:false}},scales:{y:{beginAtZero:true}}}
});
new Chart(document.getElementById('lectureChart'),{
    type:'doughnut',
    data:{labels:['Lu','Non lu'],datasets:[{data:[75,25],backgroundColor:['#10b981','#ef4444']}]},
    options:{cutout:'72%',plugins:{legend:{position:'bottom'}}}
});

// Apparition/disparition du formulaire intégré
const formContainer=document.getElementById('ficheFormContainer');
const formTitle=document.getElementById('ficheFormTitle');
const cancelBtn=document.getElementById('cancelFormBtn');

document.querySelectorAll('.open-form').forEach(btn=>{
    btn.addEventListener('click',()=>{
        formTitle.textContent='Remplir la fiche : '+btn.dataset.title;
        formContainer.style.display='block';
        formContainer.scrollIntoView({behavior:'smooth'});
    });
});

cancelBtn.addEventListener('click',()=>{
    formContainer.style.display='none';
});

document.getElementById('ficheForm').addEventListener('submit',e=>{
    e.preventDefault();
    alert('Fiche enregistrée avec succès (simulation)');
    formContainer.style.display='none';
    e.target.reset();
});

// Apparition/disparition du formulaire "Nouveau Document"
const newDocForm = document.getElementById('newDocFormContainer');
document.getElementById('addDocBtn').addEventListener('click',()=>{
    newDocForm.style.display='block';
    newDocForm.scrollIntoView({behavior:'smooth'});
});
document.getElementById('cancelNewDocBtn').addEventListener('click',()=>{
    newDocForm.style.display='none';
});
document.getElementById('newDocForm').addEventListener('submit',e=>{
    e.preventDefault();
    alert('Nouveau document ajouté (simulation)');
    newDocForm.style.display='none';
    e.target.reset();
});

</script>
@endsection
