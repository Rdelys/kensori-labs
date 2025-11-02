@extends('layouts.clients')

@section('title', 'Satisfaction client')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<style>
#newSurveyForm, #newReclamForm, #newActionForm {display:none;animation:fadeIn .3s ease;}
@keyframes fadeIn {from{opacity:0;transform:translateY(-6px)}to{opacity:1;transform:none}}
</style>

<div class="space-y-10 fade-in">

  <!-- ENTÊTE -->
  <div class="flex items-center justify-between border-b pb-4">
    <h1 class="text-3xl font-semibold text-gray-800 flex items-center gap-2">
      <i class="fa-solid fa-face-smile text-yellow-500"></i>
      Satisfaction client
    </h1>
    <div class="flex gap-3">
      <button id="btnExportPDF" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow flex items-center gap-2">
        <i class="fa-solid fa-file-pdf"></i> Exporter PDF
      </button>
      <button id="btnNewSurvey" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl shadow">
        <i class="fa-solid fa-plus mr-2"></i> Nouvelle enquête
      </button>
    </div>
  </div>

  <!-- INDICATEURS -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white shadow rounded-2xl p-4 text-center"><p class="text-gray-500 text-sm">Taux satisfaction global</p><h3 class="text-3xl font-bold text-green-600">87%</h3></div>
    <div class="bg-white shadow rounded-2xl p-4 text-center"><p class="text-gray-500 text-sm">Score NPS</p><h3 class="text-3xl font-bold text-blue-600">+42</h3></div>
    <div class="bg-white shadow rounded-2xl p-4 text-center"><p class="text-gray-500 text-sm">Réclamations reçues</p><h3 class="text-3xl font-bold text-red-600">6</h3></div>
    <div class="bg-white shadow rounded-2xl p-4 text-center"><p class="text-gray-500 text-sm">Enquêtes clôturées</p><h3 class="text-3xl font-bold text-purple-600">4</h3></div>
  </div>

  <!-- FORMULAIRE NOUVELLE ENQUÊTE -->
  <div id="newSurveyForm" class="bg-white shadow p-6 rounded-2xl border border-blue-100">
    <h2 class="text-xl font-semibold mb-4 text-blue-700 flex items-center gap-2"><i class="fa-solid fa-poll"></i> Créer une enquête</h2>
    <form id="surveyForm" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
      <div><label class="block text-gray-700 mb-1">Titre</label><input id="surveyTitle" type="text" class="w-full border rounded-lg p-2" required></div>
      <div><label class="block text-gray-700 mb-1">Canal</label><select id="surveyCanal" class="w-full border rounded-lg p-2"><option>Email</option><option>QR Code</option><option>Portail client</option></select></div>
      <div><label class="block text-gray-700 mb-1">Date de lancement</label><input id="surveyDate" type="date" class="w-full border rounded-lg p-2" required></div>
      <div class="md:col-span-2"><label class="block text-gray-700 mb-1">Objectif</label><textarea id="surveyObjectif" rows="2" class="w-full border rounded-lg p-2"></textarea></div>
      <div class="md:col-span-2 text-right space-x-2"><button type="button" id="cancelSurvey" class="bg-gray-400 text-white px-3 py-2 rounded">Annuler</button><button type="submit" class="bg-blue-600 text-white px-3 py-2 rounded">Créer</button></div>
    </form>
  </div>

  <!-- TABLEAU ENQUÊTES -->
  <div class="bg-white shadow rounded-2xl p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2"><i class="fa-solid fa-clipboard-list text-blue-500"></i> Historique des enquêtes</h2>
    <table class="w-full border-collapse text-sm">
      <thead class="bg-gray-100 text-gray-600 uppercase">
        <tr><th class="py-3 px-3 text-left">Date</th><th class="py-3 px-3 text-left">Campagne</th><th class="py-3 px-3 text-left">Canal</th><th class="py-3 px-3 text-left">Taux satisfaction</th><th class="py-3 px-3 text-left">Score NPS</th></tr>
      </thead>
      <tbody id="surveyTable" class="divide-y text-gray-700">
        <tr><td class="py-2 px-3">10/09/2025</td><td class="py-2 px-3">Livraison T3</td><td>Email</td><td class="py-2 px-3 text-green-600">89%</td><td class="py-2 px-3 text-blue-600">+44</td></tr>
      </tbody>
    </table>
  </div>

  <!-- FORMULAIRE RÉCLAMATION CLIENT -->
  <div id="newReclamForm" class="bg-white shadow p-6 rounded-2xl border border-red-100">
    <h2 class="text-xl font-semibold mb-4 text-red-700 flex items-center gap-2"><i class="fa-solid fa-envelope"></i> Nouvelle réclamation client</h2>
    <form id="reclamForm" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
      <div><label class="block text-gray-700 mb-1">Client</label><input id="reclamClient" type="text" class="w-full border rounded-lg p-2"></div>
      <div><label class="block text-gray-700 mb-1">Date</label><input id="reclamDate" type="date" class="w-full border rounded-lg p-2"></div>
      <div class="md:col-span-2"><label class="block text-gray-700 mb-1">Objet</label><input id="reclamObjet" type="text" class="w-full border rounded-lg p-2"></div>
      <div class="md:col-span-2"><label class="block text-gray-700 mb-1">Détail</label><textarea id="reclamDetail" rows="2" class="w-full border rounded-lg p-2"></textarea></div>
      <div class="md:col-span-2 text-right"><button type="button" id="cancelReclam" class="bg-gray-400 text-white px-3 py-2 rounded">Annuler</button><button type="submit" class="bg-red-600 text-white px-3 py-2 rounded">Enregistrer</button></div>
    </form>
  </div>

  <!-- FORMULAIRE ACTION D’AMÉLIORATION -->
  <div id="newActionForm" class="bg-white shadow p-6 rounded-2xl border border-green-100">
    <h2 class="text-xl font-semibold mb-4 text-green-700 flex items-center gap-2"><i class="fa-solid fa-lightbulb"></i> Nouvelle action d’amélioration</h2>
    <form id="actionForm" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
      <div><label class="block text-gray-700 mb-1">Origine</label><select id="actionOrigine" class="w-full border rounded-lg p-2"><option>Enquête</option><option>Réclamation</option><option>Suggestion</option></select></div>
      <div><label class="block text-gray-700 mb-1">Responsable</label><input id="actionResp" type="text" class="w-full border rounded-lg p-2"></div>
      <div><label class="block text-gray-700 mb-1">Échéance</label><input id="actionDate" type="date" class="w-full border rounded-lg p-2"></div>
      <div class="md:col-span-2"><label class="block text-gray-700 mb-1">Description</label><textarea id="actionDesc" rows="2" class="w-full border rounded-lg p-2"></textarea></div>
      <div class="md:col-span-2 text-right"><button type="button" id="cancelAction" class="bg-gray-400 text-white px-3 py-2 rounded">Annuler</button><button type="submit" class="bg-green-600 text-white px-3 py-2 rounded">Valider</button></div>
    </form>
  </div>

  <!-- BOUTONS D’AJOUT -->
  <div class="flex justify-end gap-3">
    <button id="btnNewReclam" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded"><i class="fa-solid fa-envelope"></i> Réclamation</button>
    <button id="btnNewAction" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"><i class="fa-solid fa-lightbulb"></i> Action</button>
  </div>

  <!-- GRAPHIQUES -->
  <div class="bg-white shadow rounded-2xl p-6">
    <h2 class="text-xl font-semibold mb-6 text-gray-700 flex items-center gap-2"><i class="fa-solid fa-chart-line text-blue-500"></i> Analyse</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div class="text-center"><canvas id="npsChart"></canvas><p class="text-sm text-gray-600 mt-2">Évolution du NPS</p></div>
      <div class="text-center"><canvas id="satisfactionChart"></canvas><p class="text-sm text-gray-600 mt-2">Répartition satisfaction</p></div>
    </div>
  </div>
</div>

<script>
// --- Ouverture / Fermeture formulaires
const sForm=document.getElementById('newSurveyForm'); const rForm=document.getElementById('newReclamForm'); const aForm=document.getElementById('newActionForm');
btnNewSurvey.onclick=()=>{sForm.style.display='block';sForm.scrollIntoView({behavior:'smooth'})};
cancelSurvey.onclick=()=>{sForm.style.display='none'};
btnNewReclam.onclick=()=>{rForm.style.display='block';rForm.scrollIntoView({behavior:'smooth'})};
cancelReclam.onclick=()=>{rForm.style.display='none'};
btnNewAction.onclick=()=>{aForm.style.display='block';aForm.scrollIntoView({behavior:'smooth'})};
cancelAction.onclick=()=>{aForm.style.display='none'};

// --- Soumissions simulées QMS
surveyForm.onsubmit=e=>{e.preventDefault();alert('✅ Enquête ajoutée (simulation QMS)');e.target.reset();sForm.style.display='none';}
reclamForm.onsubmit=e=>{e.preventDefault();alert('⚠️ Réclamation enregistrée');e.target.reset();rForm.style.display='none';}
actionForm.onsubmit=e=>{e.preventDefault();alert('💡 Action d’amélioration validée');e.target.reset();aForm.style.display='none';}

// --- Export PDF
btnExportPDF.onclick=()=>{html2pdf().set({margin:0.5,filename:'Satisfaction_Client_QMS.pdf',jsPDF:{unit:'in',format:'a4'}}).from(document.body).save();}

// --- Graphiques
new Chart(npsChart,{type:'line',data:{labels:['T1','T2','T3','T4'],datasets:[{label:'NPS',data:[36,40,42,44],borderColor:'#3B82F6',fill:false,tension:0.3}]},options:{plugins:{legend:{display:false}}}});
new Chart(satisfactionChart,{type:'doughnut',data:{labels:['Très satisfait','Satisfait','Neutre','Insatisfait'],datasets:[{data:[45,35,15,5],backgroundColor:['#16A34A','#60A5FA','#FBBF24','#EF4444']}]},options:{plugins:{legend:{position:'bottom'}}}});
</script>
@endsection
