@extends('layouts.clients')

@section('title', 'Planification des Changements')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<style>
body { background-color: #f8fafc; }
.page-container { display: flex; flex-direction: column; gap: 3rem; padding: 1rem 0; }
.card { background: #fff; border-radius: 16px; box-shadow: 0 6px 14px rgba(0,0,0,0.06); padding: 2rem; transition: all 0.25s ease; }
.card:hover { transform: translateY(-4px); }
.section-title { font-size: 1.6rem; font-weight: 700; color: #1d4ed8; display: flex; align-items: center; gap: 10px; border-left: 6px solid #1d4ed8; padding-left: 10px; margin-bottom: 1.4rem; }
.form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem; }
.form-group { display: flex; flex-direction: column; gap: 0.4rem; }
.form-group label { font-weight: 600; color: #374151; font-size: 0.9rem; }
.form-group input, .form-group select, .form-group textarea { border: 1px solid #d1d5db; border-radius: 8px; padding: 8px 10px; font-size: 0.9rem; background: #f9fafb; }
.form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: #2563eb; background: white; box-shadow: 0 0 0 2px rgba(37,99,235,0.1); outline: none; }
.btn-submit { background: #2563eb; color: white; font-weight: 600; padding: 10px 18px; border-radius: 8px; border: none; cursor: pointer; transition: 0.2s ease; }
.btn-submit:hover { background: #1e3a8a; }
.table { width: 100%; border-collapse: collapse; overflow: hidden; border-radius: 12px; margin-top: 0.5rem; }
.table th, .table td { padding: 12px 14px; text-align: center; border-bottom: 1px solid #e5e7eb; }
.table th { background-color: #f1f5f9; font-weight: 600; color: #1f2937; }
.table tr:nth-child(even) { background: #f9fafb; }
.alert { background: #fef3c7; color: #92400e; border-left: 6px solid #f59e0b; padding: 12px 16px; border-radius: 10px; margin-bottom: 1rem; }
canvas { max-height: 320px !important; }
</style>

<div class="page-container">

    {{-- SECTION 1 : Nouvelle Demande de Changement --}}
    <div class="card">
        <h2 class="section-title"><i class="fa-solid fa-pen-to-square"></i> Nouvelle Demande de Changement</h2>

        <form id="changeForm">
            <div class="form-grid">
                <div class="form-group">
                    <label>Titre du Changement</label>
                    <input id="changeTitle" type="text" placeholder="Ex : Amélioration du processus de contrôle qualité">
                </div>

                <div class="form-group">
                    <label>Type de Changement</label>
                    <select id="changeType">
                        <option selected>Processus</option>
                        <option>Organisationnel</option>
                        <option>Documentaire</option>
                        <option>Équipement</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Demandeur</label>
                    <input id="changeOwner" type="text" placeholder="Ex : Jean Dupont">
                </div>

                <div class="form-group">
                    <label>Date de Demande</label>
                    <input id="changeDate" type="date">
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <label>Description du Changement</label>
                    <textarea id="changeDesc" rows="3" placeholder="Décrire la nature du changement et son objectif."></textarea>
                </div>
            </div>

            <div class="mt-5 text-right">
                <button type="button" id="submitChange" class="btn-submit">
                    <i class="fa-solid fa-paper-plane"></i> Soumettre
                </button>
            </div>
        </form>
    </div>

    {{-- SECTION 2 : Évaluation d’Impact --}}
    <div class="card">
        <h2 class="section-title"><i class="fa-solid fa-scale-balanced"></i> Évaluation d’Impact</h2>

        <table id="impactTable" class="table">
            <thead>
                <tr>
                    <th>Élément Impacté</th>
                    <th>Niveau d’Impact</th>
                    <th>Description</th>
                    <th>Mesure Atténuante</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Système Qualité (SMQ)</td>
                    <td>Élevé</td>
                    <td>Modification du flux documentaire</td>
                    <td>Formation des auditeurs internes</td>
                </tr>
                <tr>
                    <td>Produits / Services</td>
                    <td>Moyen</td>
                    <td>Changement du mode de contrôle</td>
                    <td>Période de double contrôle</td>
                </tr>
                <tr>
                    <td>Ressources</td>
                    <td>Faible</td>
                    <td>Léger besoin en formation</td>
                    <td>Brief interne de 2h</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-6"><canvas id="impactRadarChart"></canvas></div>
        <div class="text-right mt-4">
            <button id="exportImpactPdf" class="btn-submit bg-indigo-600">
                <i class="fa-solid fa-file-pdf"></i> Exporter PDF
            </button>
        </div>
    </div>

    {{-- SECTION 3 : Planification de la Mise en Œuvre --}}
    <div class="card">
        <h2 class="section-title"><i class="fa-solid fa-calendar-check"></i> Planification de la Mise en Œuvre</h2>
        <table class="table">
            <thead>
                <tr><th>Action</th><th>Responsable</th><th>Échéance</th><th>Statut</th></tr>
            </thead>
            <tbody id="planTableBody">
                <tr>
                    <td>Validation du changement</td>
                    <td>Responsable Qualité</td>
                    <td>25/10/2025</td>
                    <td><span class="text-yellow-600 font-semibold">En cours</span></td>
                </tr>
                <tr>
                    <td>Mise à jour des procédures</td>
                    <td>Chargé Qualité</td>
                    <td>28/10/2025</td>
                    <td><span class="text-gray-600 font-semibold">Prévu</span></td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- SECTION 4 : Workflow d’Approbation --}}
    <div class="card">
        <h2 class="section-title"><i class="fa-solid fa-diagram-project"></i> Workflow d’Approbation</h2>
        <div class="alert"><i class="fa-solid fa-info-circle"></i> Étapes : <strong>Soumission → Évaluation → Approbation → Mise en œuvre → Vérification</strong></div>
        <canvas id="workflowChart"></canvas>
    </div>

    {{-- SECTION 5 : Validation et Vérification QMS --}}
    <div class="card">
        <h2 class="section-title"><i class="fa-solid fa-user-check"></i> Validation & Vérification QMS</h2>
        <form id="validateForm" class="form-grid">
            <div class="form-group">
                <label>Validé par</label>
                <input id="validName" type="text" placeholder="Responsable Qualité">
            </div>
            <div class="form-group">
                <label>Date</label>
                <input id="validDate" type="date">
            </div>
            <div class="form-group" style="grid-column: span 2;">
                <label>Commentaire</label>
                <textarea id="validComment" rows="3" placeholder="Observation ou conclusion sur l’efficacité."></textarea>
            </div>
            <div class="text-right" style="grid-column: span 2;">
                <button id="btnValidate" type="button" class="btn-submit bg-emerald-600">
                    <i class="fa-solid fa-save"></i> Valider
                </button>
            </div>
        </form>
    </div>

    {{-- SECTION 6 : Vérification de l’Efficacité --}}
    <div class="card">
        <h2 class="section-title"><i class="fa-solid fa-chart-pie"></i> Vérification de l’Efficacité</h2>
        <p class="text-gray-700 mb-4">Suivi : 70 % des changements efficaces, 20 % partiels, 10 % inefficaces.</p>
        <canvas id="efficaciteChart"></canvas>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    // Soumission du changement
    document.getElementById('submitChange').addEventListener('click', () => {
        const title = document.getElementById('changeTitle').value.trim();
        const owner = document.getElementById('changeOwner').value.trim();
        if (!title || !owner) return alert('Veuillez compléter les champs requis.');
        alert(`Demande "${title}" soumise par ${owner} (simulation statique).`);
        document.getElementById('changeForm').reset();
    });

    // Validation QMS
    document.getElementById('btnValidate').addEventListener('click', () => {
        const name = document.getElementById('validName').value.trim();
        const date = document.getElementById('validDate').value;
        if(!name || !date) return alert('Nom et date requis pour validation.');
        alert(`Validation effectuée par ${name} le ${date}.`);
    });

    // Export PDF de l'évaluation d'impact
    document.getElementById('exportImpactPdf').addEventListener('click', () => {
        const element = document.getElementById('impactTable');
        html2pdf().set({
            margin: 0.5,
            filename: 'Evaluation_Impact_QMS.pdf',
            jsPDF: { unit: 'in', format: 'a4', orientation: 'landscape' }
        }).from(element).save();
    });

    // Graphique radar Impact
    new Chart(document.getElementById('impactRadarChart'), {
        type: 'radar',
        data: {
            labels: ['SMQ', 'Produits', 'Ressources', 'Clients', 'Processus'],
            datasets: [{
                label: 'Niveau d’Impact',
                data: [90, 70, 40, 50, 80],
                backgroundColor: 'rgba(59,130,246,0.2)',
                borderColor: '#2563eb',
                pointBackgroundColor: '#1d4ed8',
                fill: true
            }]
        },
        options: { responsive: true, plugins: { title: { display: true, text: 'Analyse d’impact global sur le SMQ', font: { size: 16 } } } }
    });

    // Workflow Chart
    new Chart(document.getElementById('workflowChart'), {
        type: 'bar',
        data: {
            labels: ['Soumis', 'Évalué', 'Approuvé', 'Mis en œuvre', 'Vérifié'],
            datasets: [{ label: 'Nombre de changements', data: [10, 8, 6, 4, 3],
                backgroundColor: ['#3b82f6','#f59e0b','#10b981','#6366f1','#22c55e'], borderRadius:8 }]
        },
        options: { plugins:{ title:{display:true,text:'Suivi du Workflow des Changements',font:{size:16,weight:'bold'}}, legend:{display:false} }, scales:{ y:{ beginAtZero:true,ticks:{stepSize:2}}}}
    });

    // Efficacité
    new Chart(document.getElementById('efficaciteChart'), {
        type: 'doughnut',
        data: { labels:['Efficace','Partiellement efficace','Inefficace'], datasets:[{ data:[70,20,10], backgroundColor:['#16a34a','#facc15','#ef4444'] }] },
        options: { cutout:'70%', plugins:{ title:{display:true,text:'Évaluation de l’Efficacité des Changements',font:{size:16,weight:'bold'}}, legend:{position:'bottom'} } }
    });
});
</script>
@endsection
