@extends('layouts.clients')

@section('title', 'Audits internes')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<style>
#newAuditFormContainer, #newActionFormContainer, #newOutilFormContainer {display:none;animation:fadeIn .3s ease}
@keyframes fadeIn {from{opacity:0;transform:translateY(-6px)}to{opacity:1;transform:none}}
</style>

<div class="space-y-10 fade-in">

  <!-- ===== ENTÊTE ===== -->
  <div class="flex items-center justify-between border-b pb-4">
    <h1 class="text-3xl font-semibold text-gray-800 flex items-center gap-2">
      <i class="fa-solid fa-clipboard-check text-blue-600"></i>
      Audits internes
    </h1>
    <div class="flex gap-3">
      <button id="btnExportPDF" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow flex items-center gap-2">
        <i class="fa-solid fa-file-pdf"></i> Exporter PDF
      </button>
      <button id="btnNewAudit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl shadow flex items-center gap-2">
        <i class="fa-solid fa-plus"></i> Nouvel audit
      </button>
    </div>
  </div>

  <!-- ===== INDICATEURS ===== -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white shadow rounded-2xl p-4 text-center"><p class="text-gray-500 text-sm">Audits planifiés</p><h3 class="text-3xl font-bold text-blue-600">8</h3></div>
    <div class="bg-white shadow rounded-2xl p-4 text-center"><p class="text-gray-500 text-sm">Audits réalisés</p><h3 class="text-3xl font-bold text-green-600">5</h3></div>
    <div class="bg-white shadow rounded-2xl p-4 text-center"><p class="text-gray-500 text-sm">Non-conformités</p><h3 class="text-3xl font-bold text-red-600">3</h3></div>
    <div class="bg-white shadow rounded-2xl p-4 text-center"><p class="text-gray-500 text-sm">Taux d’achèvement</p><h3 class="text-3xl font-bold text-purple-600">62%</h3></div>
  </div>

  <!-- ===== PLANNING ===== -->
  <div id="auditSection" class="bg-white shadow rounded-2xl p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
      <i class="fa-solid fa-calendar-days text-blue-500"></i> Planning des audits
    </h2>
    <table class="w-full border-collapse text-sm">
      <thead class="bg-gray-100 text-gray-600 uppercase">
        <tr>
          <th class="py-3 px-3 text-left">Date</th>
          <th class="py-3 px-3 text-left">Processus</th>
          <th class="py-3 px-3 text-left">Auditeur</th>
          <th class="py-3 px-3 text-left">Statut</th>
          <th class="py-3 px-3 text-left">Outils utilisés</th>
          <th class="py-3 px-3 text-left">Constats</th>
        </tr>
      </thead>
      <tbody id="auditTableBody" class="divide-y text-gray-700">
        <tr>
          <td class="py-2 px-3">05/10/2025</td>
          <td class="py-2 px-3">Production</td>
          <td class="py-2 px-3">A. Razafy</td>
          <td class="py-2 px-3"><span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Planifié</span></td>
          <td class="py-2 px-3">Check-list ISO / Enregistrements</td>
          <td class="py-2 px-3">RAS</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- ===== FORM NOUVEL AUDIT ===== -->
  <div id="newAuditFormContainer" class="bg-white p-6 rounded-2xl shadow border border-blue-100">
    <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-blue-700">
      <i class="fa-solid fa-plus"></i> Créer un nouvel audit
    </h2>
    <form id="newAuditForm" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
      <div>
        <label class="block text-gray-700 mb-1 font-medium">Date d’audit</label>
        <input type="date" id="auditDate" class="w-full p-2 border rounded-lg" required>
      </div>
      <div>
        <label class="block text-gray-700 mb-1 font-medium">Processus</label>
        <input type="text" id="auditProcess" class="w-full p-2 border rounded-lg" placeholder="Ex: RH, Production..." required>
      </div>
      <div>
        <label class="block text-gray-700 mb-1 font-medium">Auditeur</label>
        <input type="text" id="auditAuditeur" class="w-full p-2 border rounded-lg" placeholder="Nom auditeur">
      </div>
      <div>
        <label class="block text-gray-700 mb-1 font-medium">Statut</label>
        <select id="auditStatut" class="w-full p-2 border rounded-lg">
          <option>Planifié</option>
          <option>En cours</option>
          <option>Clôturé</option>
        </select>
      </div>
      <div class="md:col-span-2">
        <label class="block text-gray-700 mb-1 font-medium">Outils utilisés</label>
        <input type="text" id="auditOutils" class="w-full p-2 border rounded-lg" placeholder="Ex: Check-list, ISO Doc, Application mobile">
      </div>
      <div class="md:col-span-2">
        <label class="block text-gray-700 mb-1 font-medium">Constats / Observations</label>
        <textarea id="auditConstats" rows="3" class="w-full border rounded-lg p-2"></textarea>
      </div>
      <div class="md:col-span-2 text-right">
        <button type="button" id="cancelAudit" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Annuler</button>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Enregistrer</button>
      </div>
    </form>
  </div>

  <!-- ===== FORM ACTION ===== -->
  <div id="newActionFormContainer" class="bg-white p-6 rounded-2xl shadow border border-red-100">
    <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-red-700">
      <i class="fa-solid fa-triangle-exclamation"></i> Ajouter une action corrective / préventive
    </h2>
    <form id="newActionForm" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
      <div>
        <label class="block text-gray-700 font-medium mb-1">Audit concerné</label>
        <input type="text" id="actionAudit" class="w-full p-2 border rounded-lg" placeholder="Ex: Audit Production du 05/10/2025">
      </div>
      <div>
        <label class="block text-gray-700 font-medium mb-1">Type d’action</label>
        <select id="actionType" class="w-full p-2 border rounded-lg"><option>Corrective</option><option>Préventive</option></select>
      </div>
      <div>
        <label class="block text-gray-700 font-medium mb-1">Responsable</label>
        <input type="text" id="actionResp" class="w-full p-2 border rounded-lg">
      </div>
      <div>
        <label class="block text-gray-700 font-medium mb-1">Échéance</label>
        <input type="date" id="actionDate" class="w-full p-2 border rounded-lg">
      </div>
      <div class="md:col-span-2">
        <label class="block text-gray-700 font-medium mb-1">Description</label>
        <textarea id="actionDesc" rows="3" class="w-full border rounded-lg p-2"></textarea>
      </div>
      <div class="md:col-span-2 text-right">
        <button type="button" id="cancelAction" class="bg-gray-400 text-white px-4 py-2 rounded">Annuler</button>
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Enregistrer</button>
      </div>
    </form>
  </div>

  <!-- ===== FORM OUTIL ===== -->
  <div id="newOutilFormContainer" class="bg-white p-6 rounded-2xl shadow border border-green-100">
    <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-green-700">
      <i class="fa-solid fa-toolbox"></i> Ajouter un outil / moyen d’audit
    </h2>
    <form id="newOutilForm" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
      <div><label class="block text-gray-700 mb-1 font-medium">Nom de l’outil</label><input type="text" id="outilNom" class="w-full p-2 border rounded-lg"></div>
      <div><label class="block text-gray-700 mb-1 font-medium">Type</label><select id="outilType" class="w-full p-2 border rounded-lg"><option>Formulaire</option><option>Application</option><option>Instrument</option></select></div>
      <div class="md:col-span-2"><label class="block text-gray-700 mb-1 font-medium">Utilisation</label><textarea id="outilUsage" rows="2" class="w-full border rounded-lg p-2"></textarea></div>
      <div class="md:col-span-2 text-right"><button type="button" id="cancelOutil" class="bg-gray-400 text-white px-4 py-2 rounded">Annuler</button><button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Enregistrer</button></div>
    </form>
  </div>

  <!-- ===== BOUTONS D’AJOUT ===== -->
  <div class="flex justify-end gap-3">
    <button id="btnNewAction" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded"><i class="fa-solid fa-plus"></i> Nouvelle action</button>
    <button id="btnNewOutil" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"><i class="fa-solid fa-wrench"></i> Nouvel outil</button>
  </div>

  <!-- ===== GRAPHIQUES ===== -->
  <div class="bg-white shadow rounded-2xl p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2"><i class="fa-solid fa-chart-pie text-blue-500"></i> Synthèse des audits</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div class="text-center"><canvas id="auditStatusChart"></canvas><p class="text-sm text-gray-600 mt-2">Répartition des audits</p></div>
      <div class="text-center"><canvas id="ncProcessChart"></canvas><p class="text-sm text-gray-600 mt-2">Non-conformités par processus</p></div>
    </div>
  </div>
</div>

<script>
// --- Gestion affichage
const auditForm=document.getElementById('newAuditFormContainer');
const actionForm=document.getElementById('newActionFormContainer');
const outilForm=document.getElementById('newOutilFormContainer');
document.getElementById('btnNewAudit').onclick=()=>{auditForm.style.display='block';auditForm.scrollIntoView({behavior:'smooth'});}
document.getElementById('cancelAudit').onclick=()=>{auditForm.style.display='none';}
document.getElementById('btnNewAction').onclick=()=>{actionForm.style.display='block';actionForm.scrollIntoView({behavior:'smooth'});}
document.getElementById('cancelAction').onclick=()=>{actionForm.style.display='none';}
document.getElementById('btnNewOutil').onclick=()=>{outilForm.style.display='block';outilForm.scrollIntoView({behavior:'smooth'});}
document.getElementById('cancelOutil').onclick=()=>{outilForm.style.display='none';}

// --- Nouvel audit
document.getElementById('newAuditForm').onsubmit=e=>{
  e.preventDefault();
  const date=auditDate.value,process=auditProcess.value,auditeur=auditAuditeur.value,statut=auditStatut.value,outils=auditOutils.value,constats=auditConstats.value;
  const tbody=document.getElementById('auditTableBody');
  const tr=document.createElement('tr');
  tr.innerHTML=`<td class='py-2 px-3'>${date}</td><td class='py-2 px-3'>${process}</td><td class='py-2 px-3'>${auditeur}</td><td class='py-2 px-3'><span class='px-2 py-1 rounded-full text-xs ${statut==='Clôturé'?'bg-green-100 text-green-700':statut==='Planifié'?'bg-yellow-100 text-yellow-700':'bg-blue-100 text-blue-700'}'>${statut}</span></td><td class='py-2 px-3'>${outils}</td><td class='py-2 px-3'>${constats}</td>`;
  tbody.appendChild(tr);
  alert("✅ Nouvel audit ajouté (simulation QMS)");
  e.target.reset();auditForm.style.display='none';
};

// --- Actions et Outils simulés
document.getElementById('newActionForm').onsubmit=e=>{e.preventDefault();alert("✅ Action enregistrée");e.target.reset();actionForm.style.display='none';}
document.getElementById('newOutilForm').onsubmit=e=>{e.preventDefault();alert("✅ Outil enregistré");e.target.reset();outilForm.style.display='none';}

// --- Export PDF
btnExportPDF.onclick=()=>{html2pdf().set({margin:0.5,filename:'Registre_Audits_QMS.pdf',jsPDF:{unit:'in',format:'a4'}}).from(document.body).save();};

// --- Graphiques
new Chart(auditStatusChart,{type:'doughnut',data:{labels:['Planifiés','Clôturés','En retard'],datasets:[{data:[3,5,1],backgroundColor:['#FACC15','#22C55E','#EF4444']}]},options:{plugins:{legend:{position:'bottom'}}}});
new Chart(ncProcessChart,{type:'bar',data:{labels:['Production','Achats','RH'],datasets:[{label:'NC',data:[2,1,0],backgroundColor:'#3B82F6'}]},options:{scales:{y:{beginAtZero:true}}}});
</script>
@endsection
