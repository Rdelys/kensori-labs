@extends('layouts.clients')

@section('title', 'Compétences')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<style>
#newEmployeeFormContainer, #newTrainingFormContainer {display:none;animation:fadeIn .3s ease}
@keyframes fadeIn {from{opacity:0;transform:translateY(-6px)}to{opacity:1;transform:none}}
</style>

<div class="space-y-10 fade-in">

    <!-- ======== En-tête ======== -->
    <div class="flex items-center justify-between border-b pb-4">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-user-graduate text-blue-600"></i>
            Gestion des Compétences
        </h1>
        <div class="flex gap-3">
            <button id="btnExportPDF" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow flex items-center gap-2">
                <i class="fa-solid fa-file-pdf"></i> Exporter PDF
            </button>
            <button id="btnNewEmployee" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Ajouter un employé
            </button>
        </div>
    </div>

    <!-- ======== 🌟 FORMULAIRE NOUVEL EMPLOYÉ ======== -->
    <div id="newEmployeeFormContainer" class="bg-white p-6 rounded-xl shadow border border-blue-100">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-blue-700">
            <i class="fa-solid fa-circle-plus"></i> Ajouter un nouvel employé
        </h2>
        <form id="newEmployeeForm" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Nom complet</label>
                <input type="text" id="empName" class="w-full p-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Poste</label>
                <input type="text" id="empPoste" class="w-full p-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Niveau</label>
                <select id="empNiveau" class="w-full p-2 border rounded-lg" required>
                    <option>Débutant</option>
                    <option>Intermédiaire</option>
                    <option>Avancé</option>
                    <option>Expert</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Dernière formation</label>
                <input type="text" id="empDerniere" class="w-full p-2 border rounded-lg" placeholder="Ex: Sécurité (03/2025)">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Prochaine formation</label>
                <input type="text" id="empProchaine" class="w-full p-2 border rounded-lg" placeholder="Ex: Audit interne (09/2025)">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Responsable RH</label>
                <input type="text" id="empResp" class="w-full p-2 border rounded-lg" placeholder="Nom du responsable RH">
            </div>
            <div class="md:col-span-2 text-right space-x-2">
                <button type="button" id="cancelNewEmployee" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                    <i class="fa-solid fa-xmark"></i> Annuler
                </button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    <i class="fa-solid fa-check"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>

    <!-- ======== Indicateurs Clés ======== -->
    <div class="grid md:grid-cols-4 gap-5">
        <div class="bg-white p-5 rounded-xl shadow text-center">
            <p class="text-gray-500 text-sm mb-1">Taux global de compétence</p>
            <p class="text-3xl font-bold text-green-600">92%</p>
        </div>
        <div class="bg-white p-5 rounded-xl shadow text-center">
            <p class="text-gray-500 text-sm mb-1">Formations à venir</p>
            <p class="text-3xl font-bold text-blue-600">5</p>
        </div>
        <div class="bg-white p-5 rounded-xl shadow text-center">
            <p class="text-gray-500 text-sm mb-1">Écarts détectés</p>
            <p class="text-3xl font-bold text-red-600">3</p>
        </div>
        <div class="bg-white p-5 rounded-xl shadow text-center">
            <p class="text-gray-500 text-sm mb-1">Taux d’efficacité des formations</p>
            <p class="text-3xl font-bold text-yellow-600">88%</p>
        </div>
    </div>

    <!-- ======== Graphiques ======== -->
    <div class="grid md:grid-cols-2 gap-5">
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-lg font-semibold mb-3 flex items-center gap-2 text-gray-700">
                <i class="fa-solid fa-chart-pie text-blue-600"></i> Répartition des niveaux de compétence
            </h2>
            <canvas id="competenceChart"></canvas>
        </div>
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-lg font-semibold mb-3 flex items-center gap-2 text-gray-700">
                <i class="fa-solid fa-chart-line text-blue-600"></i> Évolution de l’efficacité des formations
            </h2>
            <canvas id="formationChart"></canvas>
        </div>
    </div>

    <!-- ======== Liste du Personnel ======== -->
    <div id="employeeSection" class="bg-white rounded-xl shadow overflow-hidden">
        <div class="flex items-center justify-between p-4 border-b bg-gray-50">
            <h2 class="text-xl font-semibold flex items-center gap-2">
                <i class="fa-solid fa-users text-blue-600"></i> Liste du personnel
            </h2>
        </div>

        <table class="w-full border-collapse">
            <thead class="bg-blue-50 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="p-3 text-left">Nom</th>
                    <th class="p-3 text-left">Poste</th>
                    <th class="p-3 text-left">Niveau</th>
                    <th class="p-3 text-left">Dernière formation</th>
                    <th class="p-3 text-left">Prochaine formation</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="employeeTableBody">
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3">Julie Martin</td>
                    <td class="p-3">Technicienne Qualité</td>
                    <td class="p-3"><span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Avancé</span></td>
                    <td class="p-3">Audit Interne (08/2025)</td>
                    <td class="p-3">Communication (12/2025)</td>
                    <td class="p-3 text-center space-x-2">
                        <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-eye"></i></button>
                        <button class="text-green-600 hover:text-green-800"><i class="fa-solid fa-pen"></i></button>
                        <button class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- ======== 🌟 FORMULAIRE NOUVELLE FORMATION ======== -->
    <div id="newTrainingFormContainer" class="bg-white p-6 rounded-xl shadow border border-green-100">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-green-700">
            <i class="fa-solid fa-chalkboard-user"></i> Ajouter une nouvelle formation
        </h2>
        <form id="newTrainingForm" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Intitulé de la formation</label>
                <input type="text" id="trainTitle" class="w-full p-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Employé concerné</label>
                <input type="text" id="trainEmp" class="w-full p-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Date</label>
                <input type="date" id="trainDate" class="w-full p-2 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Statut</label>
                <select id="trainStatus" class="w-full p-2 border rounded-lg">
                    <option>Planifiée</option>
                    <option>Réalisée</option>
                    <option>Annulée</option>
                </select>
            </div>
            <div class="md:col-span-2 text-right space-x-2">
                <button type="button" id="cancelNewTraining" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                    <i class="fa-solid fa-xmark"></i> Annuler
                </button>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    <i class="fa-solid fa-check"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>

    <!-- ======== Plan de Formation ======== -->
    <div id="trainingSection" class="bg-white p-6 rounded-xl shadow">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xl font-semibold flex items-center gap-2">
                <i class="fa-solid fa-chalkboard-user text-blue-600"></i> Plan de formation
            </h2>
            <button id="btnNewTraining" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                <i class="fa-solid fa-plus"></i> Nouvelle formation
            </button>
        </div>

        <table class="w-full border-collapse">
            <thead class="bg-blue-50 border-b text-gray-700 text-sm uppercase">
                <tr>
                    <th class="p-2 text-left">Intitulé</th>
                    <th class="p-2 text-left">Employé</th>
                    <th class="p-2 text-left">Date</th>
                    <th class="p-2 text-left">Statut</th>
                    <th class="p-2 text-left">Évaluation</th>
                </tr>
            </thead>
            <tbody id="trainingTableBody">
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2">Formation Audit Interne</td>
                    <td class="p-2">Julie Martin</td>
                    <td class="p-2">08/2025</td>
                    <td class="p-2"><span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Réalisée</span></td>
                    <td class="p-2">Excellente (95%)</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
// --- Apparition/disparition des formulaires
const empForm = document.getElementById('newEmployeeFormContainer');
const trainForm = document.getElementById('newTrainingFormContainer');

document.getElementById('btnNewEmployee').addEventListener('click',()=>{empForm.style.display='block';empForm.scrollIntoView({behavior:'smooth'});});
document.getElementById('cancelNewEmployee').addEventListener('click',()=>{empForm.style.display='none';});
document.getElementById('btnNewTraining').addEventListener('click',()=>{trainForm.style.display='block';trainForm.scrollIntoView({behavior:'smooth'});});
document.getElementById('cancelNewTraining').addEventListener('click',()=>{trainForm.style.display='none';});

// --- Ajout employé
document.getElementById('newEmployeeForm').addEventListener('submit',e=>{
    e.preventDefault();
    const name=document.getElementById('empName').value,poste=document.getElementById('empPoste').value,niveau=document.getElementById('empNiveau').value,derniere=document.getElementById('empDerniere').value||"—",prochaine=document.getElementById('empProchaine').value||"—";
    const tbody=document.getElementById('employeeTableBody');
    const tr=document.createElement('tr');
    tr.classList.add('border-b','hover:bg-gray-50');
    tr.innerHTML=`
        <td class="p-3">${name}</td>
        <td class="p-3">${poste}</td>
        <td class="p-3"><span class="text-xs px-2 py-1 rounded-full ${niveau==='Expert'?'bg-blue-100 text-blue-700':niveau==='Avancé'?'bg-green-100 text-green-700':niveau==='Intermédiaire'?'bg-yellow-100 text-yellow-700':'bg-red-100 text-red-700'}">${niveau}</span></td>
        <td class="p-3">${derniere}</td>
        <td class="p-3">${prochaine}</td>
        <td class="p-3 text-center"><i class="fa-solid fa-eye text-blue-600"></i></td>`;
    tbody.appendChild(tr);
    alert("✅ Employé ajouté au registre");
    e.target.reset();empForm.style.display='none';
});

// --- Ajout formation
document.getElementById('newTrainingForm').addEventListener('submit',e=>{
    e.preventDefault();
    const title=document.getElementById('trainTitle').value,emp=document.getElementById('trainEmp').value,date=document.getElementById('trainDate').value,status=document.getElementById('trainStatus').value;
    const tbody=document.getElementById('trainingTableBody');
    const tr=document.createElement('tr');
    tr.classList.add('border-b','hover:bg-gray-50');
    tr.innerHTML=`<td class="p-2">${title}</td><td class="p-2">${emp}</td><td class="p-2">${date}</td><td class="p-2"><span class="px-2 py-1 rounded text-xs ${status==='Réalisée'?'bg-green-100 text-green-700':status==='Planifiée'?'bg-yellow-100 text-yellow-700':'bg-red-100 text-red-700'}">${status}</span></td><td class="p-2">—</td>`;
    tbody.appendChild(tr);
    alert("✅ Formation ajoutée au plan");
    e.target.reset();trainForm.style.display='none';
});

// --- Export PDF
document.getElementById('btnExportPDF').addEventListener('click',()=>{
    const el=document.body;
    html2pdf().set({margin:0.5,filename:'Registre_Competences_QMS.pdf',jsPDF:{unit:'in',format:'a4',orientation:'portrait'}}).from(el).save();
});

// --- Graphiques
new Chart(document.getElementById('competenceChart'),{type:'doughnut',data:{labels:['Débutant','Intermédiaire','Avancé','Expert'],datasets:[{data:[5,8,12,4],backgroundColor:['#f87171','#facc15','#34d399','#3b82f6']}]},options:{plugins:{legend:{position:'bottom'}}}});
new Chart(document.getElementById('formationChart'),{type:'line',data:{labels:['Jan','Fév','Mar','Avr','Mai','Juin'],datasets:[{label:'Efficacité moyenne (%)',data:[70,75,80,85,90,88],borderWidth:3,fill:false,tension:0.4}]},options:{plugins:{legend:{position:'bottom'}},scales:{y:{min:0,max:100}}}});
</script>
@endsection
