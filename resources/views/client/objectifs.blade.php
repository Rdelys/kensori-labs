@extends('layouts.clients')

@section('title', 'Objectifs Qualité & SMQ')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<style>
body { background-color: #f8fafc; }
.page-container { display: flex; flex-direction: column; gap: 2.5rem; padding: 1rem 0; }
.card { background: white; border-radius: 16px; box-shadow: 0 4px 14px rgba(0,0,0,0.06); padding: 2rem; transition: all 0.25s ease-in-out; }
.card:hover { transform: translateY(-4px); }
.section-title { font-size: 1.5rem; font-weight: 700; color: #1d4ed8; display: flex; align-items: center; gap: 10px; border-left: 5px solid #1d4ed8; padding-left: 10px; margin-bottom: 1.2rem; }
.charts-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; align-items: center; }
.table { width: 100%; border-collapse: collapse; overflow: hidden; border-radius: 12px; }
.table th, .table td { padding: 12px 14px; text-align: center; }
.table th { background-color: #f1f5f9; font-weight: 600; color: #1f2937; }
.table tr:nth-child(even) { background: #f9fafb; }
.alert { background: #fee2e2; color: #991b1b; border-left: 6px solid #dc2626; padding: 1rem 1.2rem; border-radius: 12px; margin-bottom: 1rem; font-size: 0.95rem; }
.alert-info { background: #dbeafe; color: #1e40af; border-left: 6px solid #3b82f6; }
.alert-success { background: #d1fae5; color: #065f46; border-left: 6px solid #10b981; }
ul li strong { color: #0f172a; }
.form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; }
.form-group { display: flex; flex-direction: column; gap: 0.4rem; }
.form-group label { font-weight: 600; font-size: 0.9rem; color: #374151; }
.form-group input, .form-group select, .form-group textarea { border: 1px solid #d1d5db; border-radius: 8px; padding: 8px 10px; font-size: 0.9rem; background-color: #f9fafb; }
.form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color: #2563eb; background: white; box-shadow: 0 0 0 2px rgba(37,99,235,0.1); }
.btn-submit { background: #2563eb; color: white; font-weight: 600; padding: 10px 18px; border-radius: 8px; border: none; cursor: pointer; transition: background 0.2s; }
.btn-submit:hover { background: #1e40af; }
.btn-secondary { background: #6b7280; color: white; font-weight: 600; padding: 10px 18px; border-radius: 8px; border: none; cursor: pointer; transition: background 0.2s; }
.btn-secondary:hover { background: #4b5563; }
.btn-success { background: #059669; color: white; font-weight: 600; padding: 10px 18px; border-radius: 8px; border: none; cursor: pointer; transition: background 0.2s; }
.btn-success:hover { background: #047857; }
.badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
.badge-process { background: #dbeafe; color: #1e40af; }
.badge-support { background: #f3e8ff; color: #7c3aed; }
.badge-management { background: #fef3c7; color: #d97706; }
canvas { max-height: 320px !important; }

/* Styles pour la demande SMQ */
.smq-request-card { 
    background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%);
    border: 2px solid #7dd3fc;
    border-radius: 16px;
}
.process-step { 
    display: flex; 
    align-items: center; 
    gap: 15px; 
    padding: 15px; 
    background: white; 
    border-radius: 12px; 
    margin-bottom: 12px; 
    border-left: 5px solid #3b82f6; 
}
.step-number { 
    width: 36px; 
    height: 36px; 
    background: #3b82f6; 
    color: white; 
    border-radius: 50%; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    font-weight: bold; 
    font-size: 1.1rem; 
}
.step-content h4 { 
    margin: 0 0 5px 0; 
    color: #1f2937; 
}
.step-content p { 
    margin: 0; 
    color: #6b7280; 
    font-size: 0.9rem; 
}

/* Section amélioration continue */
.improvement-cycle {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}
.cycle-step {
    text-align: center;
    padding: 1.5rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
.cycle-icon {
    width: 50px;
    height: 50px;
    background: #3b82f6;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.2rem;
}

/* Responsive */
@media (max-width: 768px) {
    .form-grid { grid-template-columns: 1fr; }
    .charts-container { grid-template-columns: 1fr; }
    .table { font-size: 0.85rem; }
    .table th, .table td { padding: 8px 10px; }
}
</style>

<div class="page-container">

    {{-- SECTION 1 : Objectifs Qualité & Performance --}}
    <div class="card">
        <h2 class="section-title"><i class="fa-solid fa-chart-line"></i> Objectifs Qualité & Performance</h2>
        <div class="charts-container">
            <div><canvas id="objectifsChart"></canvas></div>
            <div><canvas id="kpiChart"></canvas></div>
        </div>
    </div>

    {{-- SECTION 2 : Demande d'Application du Système de Management de la Qualité --}}
    <div class="card smq-request-card">
        <h2 class="section-title"><i class="fa-solid fa-clipboard-check"></i> Application du Système de Management de la Qualité (SMQ)</h2>
        
        <div class="alert-info mb-4">
            <i class="fa-solid fa-info-circle"></i>
            Cette section permet de formaliser et de suivre l'application du SMQ dans l'organisation selon les exigences normatives.
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3"><i class="fa-solid fa-list-check text-blue-600"></i> Éléments du SMQ à Appliquer</h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 p-3 bg-white rounded-lg border">
                        <i class="fa-solid fa-file-contract text-green-600"></i>
                        <div>
                            <h4 class="font-medium">Documentation Qualité</h4>
                            <p class="text-sm text-gray-600">Manuel qualité, procédures, instructions</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white rounded-lg border">
                        <i class="fa-solid fa-chart-bar text-purple-600"></i>
                        <div>
                            <h4 class="font-medium">Indicateurs de Performance</h4>
                            <p class="text-sm text-gray-600">KPI qualité, tableaux de bord</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white rounded-lg border">
                        <i class="fa-solid fa-user-check text-orange-600"></i>
                        <div>
                            <h4 class="font-medium">Compétences & Formation</h4>
                            <p class="text-sm text-gray-600">Matrice de compétences, plans de formation</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white rounded-lg border">
                        <i class="fa-solid fa-tools text-red-600"></i>
                        <div>
                            <h4 class="font-medium">Processus & Amélioration</h4>
                            <p class="text-sm text-gray-600">Cartographie processus, revues de direction</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3"><i class="fa-solid fa-calendar-check text-blue-600"></i> Plan d'Application SMQ</h3>
                <div class="space-y-4">
                    <div class="process-step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h4>Diagnostic Initial</h4>
                            <p>Analyse des écarts et besoins - <strong>Échéance : 15/11/2025</strong></p>
                        </div>
                    </div>
                    <div class="process-step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h4>Mise en Place</h4>
                            <p>Documentation et formation - <strong>Échéance : 30/11/2025</strong></p>
                        </div>
                    </div>
                    <div class="process-step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h4>Implémentation</h4>
                            <p>Application sur le terrain - <strong>Échéance : 15/12/2025</strong></p>
                        </div>
                    </div>
                    <div class="process-step">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <h4>Audit & Amélioration</h4>
                            <p>Vérification et ajustements - <strong>Échéance : 31/12/2025</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-3"><i class="fa-solid fa-file-alt text-blue-600"></i> Formaliser une Demande d'Application SMQ</h3>
            <form id="smqRequestForm">
                <div class="form-grid mb-4">
                    <div class="form-group">
                        <label>Type de Demande</label>
                        <select id="smqType" required>
                            <option value="">-- Sélectionner --</option>
                            <option value="new">Nouvelle Application</option>
                            <option value="extension">Extension du SMQ</option>
                            <option value="amélioration">Amélioration Processus</option>
                            <option value="audit">Préparation Audit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Service Demandeur</label>
                        <select id="smqDepartment" required>
                            <option value="">-- Sélectionner --</option>
                            <option value="production">Production</option>
                            <option value="qualite">Qualité</option>
                            <option value="commercial">Commercial</option>
                            <option value="logistique">Logistique</option>
                            <option value="rh">Ressources Humaines</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Priorité</label>
                        <select id="smqPriority" required>
                            <option value="haute">Haute</option>
                            <option value="moyenne" selected>Moyenne</option>
                            <option value="basse">Basse</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date Limite</label>
                        <input id="smqDeadline" type="date" required>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label>Description de la Demande</label>
                    <textarea id="smqDescription" rows="3" placeholder="Décrire en détail la demande d'application du SMQ, les objectifs visés et les besoins spécifiques..." required></textarea>
                </div>
                <div class="form-group mb-4">
                    <label>Ressources Nécessaires</label>
                    <textarea id="smqResources" rows="2" placeholder="Personnel, budget, équipements, formations nécessaires..."></textarea>
                </div>
                <div class="flex justify-between items-center">
                    <div>
                        <button type="submit" class="btn-success"><i class="fa-solid fa-paper-plane"></i> Soumettre la Demande</button>
                        <button type="button" onclick="resetSMQForm()" class="btn-secondary ml-2"><i class="fa-solid fa-rotate-left"></i> Réinitialiser</button>
                    </div>
                    <div class="text-sm text-gray-600">
                        <i class="fa-solid fa-clock"></i> Délai moyen de traitement : 5 jours ouvrés
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- SECTION 3 : Formulaire d'ajout d'objectif --}}
    <div class="card">
        <h2 class="section-title"><i class="fa-solid fa-pen-to-square"></i> Définir un Nouvel Objectif Qualité</h2>
        <form id="objectifForm">
            <div class="form-grid">
                <div class="form-group">
                    <label>Intitulé de l'objectif</label>
                    <input id="objName" type="text" placeholder="Ex : Améliorer la satisfaction client" required>
                </div>
                <div class="form-group">
                    <label>Processus associé</label>
                    <select id="objProcess">
                        <option>-- Sélectionner --</option>
                        <option>Commercial</option>
                        <option>Production</option>
                        <option>Contrôle Qualité</option>
                        <option>Support Client</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>KPI associé</label>
                    <select id="objKpi">
                        <option>-- Sélectionner --</option>
                        <option>NPS (Satisfaction Client)</option>
                        <option>Taux de Non-Conformités</option>
                        <option>Taux de Livraison à Temps</option>
                        <option>Taux de Productivité</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Responsable</label>
                    <input id="objResp" type="text" placeholder="Ex : Responsable Qualité">
                </div>
                <div class="form-group">
                    <label>Échéance</label>
                    <input id="objDate" type="date">
                </div>
                <div class="form-group">
                    <label>Valeur Cible (%)</label>
                    <input id="objTarget" type="number" placeholder="Ex : 90">
                </div>
                <div class="form-group">
                    <label>Statut</label>
                    <select id="objStatus">
                        <option>En cours</option>
                        <option>Atteint</option>
                        <option>En retard</option>
                    </select>
                </div>
                <div class="form-group" style="grid-column: span 2;">
                    <label>Description SMART</label>
                    <textarea id="objDesc" rows="3" placeholder="Décrire en quoi cet objectif est SMART."></textarea>
                </div>
            </div>
            <div class="mt-4 text-right">
                <button type="submit" class="btn-submit"><i class="fa-solid fa-check"></i> Enregistrer</button>
            </div>
        </form>
    </div>

    {{-- SECTION 4 : Suivi SMART --}}
    <div class="card">
        <h2 class="section-title"><i class="fa-solid fa-bullseye"></i> Suivi des Objectifs SMART</h2>
        <table id="smartTable" class="table">
            <thead>
                <tr>
                    <th>Objectif</th>
                    <th>Spécifique</th>
                    <th>Mesurable</th>
                    <th>Atteignable</th>
                    <th>Réaliste</th>
                    <th>Temporel</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Améliorer la satisfaction client</td>
                    <td>Note NPS > 85%</td>
                    <td>Suivi mensuel</td>
                    <td>Oui</td>
                    <td>Basé sur retours clients</td>
                    <td>Décembre 2025</td>
                    <td><span class="text-green-600 font-semibold">En bonne voie</span></td>
                </tr>
            </tbody>
        </table>
        <div class="text-right mt-4">
            <button id="exportPdf" class="btn-submit bg-indigo-600"><i class="fa-solid fa-file-pdf"></i> Exporter PDF</button>
        </div>
    </div>

    {{-- SECTION 5 : Cycle d'Amélioration Continue --}}
    <div class="card">
        <h2 class="section-title"><i class="fa-solid fa-arrows-rotate"></i> Cycle d'Amélioration Continue (PDCA)</h2>
        
        <div class="improvement-cycle">
            <div class="cycle-step">
                <div class="cycle-icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <h4 class="font-semibold mb-2">Planifier</h4>
                <p class="text-sm text-gray-600">Identifier les opportunités d'amélioration et planifier les actions</p>
            </div>
            <div class="cycle-step">
                <div class="cycle-icon">
                    <i class="fa-solid fa-play"></i>
                </div>
                <h4 class="font-semibold mb-2">Déployer</h4>
                <p class="text-sm text-gray-600">Mettre en œuvre les actions planifiées</p>
            </div>
            <div class="cycle-step">
                <div class="cycle-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <h4 class="font-semibold mb-2">Contrôler</h4>
                <p class="text-sm text-gray-600">Mesurer et surveiller les résultats</p>
            </div>
            <div class="cycle-step">
                <div class="cycle-icon">
                    <i class="fa-solid fa-arrow-up-right-dots"></i>
                </div>
                <h4 class="font-semibold mb-2">Améliorer</h4>
                <p class="text-sm text-gray-600">Ajuster et standardiser les améliorations</p>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Actions d'Amélioration en Cours</h3>
                <div class="space-y-3">
                    <div class="p-3 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-medium">Optimisation processus production</span>
                            <span class="badge badge-process">Production</span>
                        </div>
                        <p class="text-sm text-gray-600">Réduction des temps de cycle de 15%</p>
                        <div class="mt-2 text-xs text-gray-500">Progression: <span class="font-semibold">65%</span></div>
                    </div>
                    <div class="p-3 bg-purple-50 rounded-lg border border-purple-200">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-medium">Formation qualité opérationnelle</span>
                            <span class="badge badge-support">RH</span>
                        </div>
                        <p class="text-sm text-gray-600">100% du personnel formé d'ici décembre</p>
                        <div class="mt-2 text-xs text-gray-500">Progression: <span class="font-semibold">78%</span></div>
                    </div>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Prochaines Revues de Direction</h3>
                <div class="space-y-3">
                    <div class="p-3 bg-green-50 rounded-lg border border-green-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-medium">Revue Trimestrielle SMQ</h4>
                                <p class="text-sm text-gray-600">Analyse performance et décisions</p>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">15/12/2025</span>
                        </div>
                    </div>
                    <div class="p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-medium">Revue des Objectifs</h4>
                                <p class="text-sm text-gray-600">Évaluation objectifs qualité 2025</p>
                            </div>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">20/12/2025</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION 6 : Validation & Approbation Qualité --}}
    <div class="card">
        <h2 class="section-title"><i class="fa-solid fa-check-double"></i> Validation & Approbation Qualité</h2>
        <form id="validateForm" class="form-grid">
            <div class="form-group">
                <label>Validé par</label>
                <input id="validName" type="text" placeholder="Directeur Qualité">
            </div>
            <div class="form-group">
                <label>Date de validation</label>
                <input id="validDate" type="date">
            </div>
            <div class="form-group" style="grid-column: span 2;">
                <label>Commentaire</label>
                <textarea id="validComment" rows="3" placeholder="Observation, décision ou note de validation."></textarea>
            </div>
            <div class="text-right" style="grid-column: span 2;">
                <button id="btnValidate" type="button" class="btn-submit bg-emerald-600"><i class="fa-solid fa-save"></i> Valider</button>
            </div>
        </form>
    </div>

    {{-- SECTION 7 : Alertes & Analyse Prédictive --}}
    <div class="card">
        <h2 class="section-title"><i class="fa-solid fa-bell"></i> Alertes & Analyse Prédictive</h2>
        <div class="alert">
            <i class="fa-solid fa-triangle-exclamation"></i>
            Risque détecté : <strong>diminution prévue de 5%</strong> du taux de satisfaction client sur les 2 prochains mois.
        </div>
        <p class="text-gray-700 mb-4"><strong>Suggestion :</strong> renforcer la communication post-livraison et lancer une enquête ciblée.</p>
        <canvas id="predictionChart"></canvas>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    // Charts
    new Chart(document.getElementById('objectifsChart'), {
        type: 'bar',
        data: {
            labels: ['Satisfaction Client', 'Non-Conformités', 'Formation', 'Productivité'],
            datasets: [{ 
                label: 'Progression (%)', 
                data: [82, 65, 90, 75],
                backgroundColor: ['#3b82f6','#ef4444','#10b981','#f59e0b'], 
                borderRadius:8 
            }]
        },
        options: { 
            responsive:true, 
            plugins:{ 
                title:{
                    display:true,
                    text:'Progression des Objectifs Qualité',
                    font:{size:16,weight:'bold'}
                }, 
                legend:{display:false}
            }, 
            scales:{ 
                y:{
                    beginAtZero:true,
                    max:100,
                    ticks:{callback:v=>v+'%'}
                }
            }
        }
    });

    new Chart(document.getElementById('kpiChart'), {
        type:'doughnut',
        data:{ 
            labels:['Atteint','Restant'], 
            datasets:[{ 
                data:[72,28], 
                backgroundColor:['#16a34a','#e5e7eb'], 
                borderWidth:0 
            }] 
        },
        options:{
            cutout:'70%', 
            plugins:{
                title:{
                    display:true,
                    text:'Taux d\'Atteinte des KPIs',
                    font:{size:16,weight:'bold'}
                }, 
                legend:{position:'bottom'} 
            } 
        }
    });

    new Chart(document.getElementById('predictionChart'), {
        type:'line',
        data:{ 
            labels:['Juin','Juil','Août','Sept','Oct','Nov','Déc'],
            datasets:[{ 
                label:'Satisfaction Client (%)', 
                data:[88,87,85,83,82,80,78], 
                borderColor:'#1d4ed8', 
                backgroundColor:'rgba(29,78,216,0.1)', 
                fill:true, 
                tension:0.4, 
                borderWidth:3, 
                pointRadius:5, 
                pointBackgroundColor:'#1d4ed8' 
            }] 
        },
        options:{ 
            plugins:{ 
                title:{
                    display:true,
                    text:'Projection Prédictive de Satisfaction Client',
                    font:{size:16,weight:'bold'}
                }, 
                legend:{display:false} 
            }, 
            scales:{ 
                y:{
                    min:70,
                    max:100,
                    ticks:{callback:v=>v+'%'}
                }
            }
        }
    });

    // Gestion de la demande SMQ
    document.getElementById('smqRequestForm').addEventListener('submit', e => {
        e.preventDefault();
        
        const type = document.getElementById('smqType').value;
        const department = document.getElementById('smqDepartment').value;
        const priority = document.getElementById('smqPriority').value;
        const deadline = document.getElementById('smqDeadline').value;
        const description = document.getElementById('smqDescription').value.trim();
        
        if(!type || !department || !deadline || !description) {
            alert('Veuillez remplir tous les champs obligatoires.');
            return;
        }
        
        // Simulation d'envoi
        const requestData = {
            type: type,
            department: department,
            priority: priority,
            deadline: deadline,
            description: description,
            resources: document.getElementById('smqResources').value,
            date: new Date().toISOString().split('T')[0],
            reference: 'SMQ-' + Math.floor(Math.random() * 1000)
        };
        
        // Ajout visuel à la section des demandes
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert-success';
        alertDiv.innerHTML = `
            <i class="fa-solid fa-check-circle"></i>
            <strong>Demande SMQ enregistrée !</strong> Référence: ${requestData.reference}<br>
            <small>Type: ${type} | Service: ${department} | Priorité: ${priority} | Échéance: ${deadline}</small>
        `;
        
        // Insert après le formulaire
        const form = document.getElementById('smqRequestForm');
        form.parentNode.insertBefore(alertDiv, form.nextSibling);
        
        // Réinitialisation du formulaire
        resetSMQForm();
        
        // Message de confirmation
        setTimeout(() => {
            alert(`Demande d'application SMQ soumise avec succès.\n\nRéférence: ${requestData.reference}\nDélai de traitement estimé: 5 jours ouvrés`);
        }, 300);
    });

    // Réinitialisation du formulaire SMQ
    window.resetSMQForm = function() {
        document.getElementById('smqRequestForm').reset();
        const today = new Date();
        const nextWeek = new Date(today);
        nextWeek.setDate(today.getDate() + 14);
        document.getElementById('smqDeadline').value = nextWeek.toISOString().split('T')[0];
    };

    // Initialisation date limite SMQ (2 semaines)
    const today = new Date();
    const nextWeek = new Date(today);
    nextWeek.setDate(today.getDate() + 14);
    document.getElementById('smqDeadline').value = nextWeek.toISOString().split('T')[0];

    // Add Objective (static)
    document.getElementById('objectifForm').addEventListener('submit', e => {
        e.preventDefault();
        const obj = document.getElementById('objName').value.trim();
        if(!obj) return alert('Veuillez saisir un objectif.');
        const table = document.getElementById('smartTable').querySelector('tbody');
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${obj}</td><td>À définir</td><td>Oui</td><td>Oui</td><td>Oui</td><td>${document.getElementById('objDate').value || '—'}</td><td><span class='text-blue-600 font-semibold'>Nouveau</span></td>`;
        table.appendChild(tr);
        
        // Ajouter aux actions d'amélioration
        const improvementSection = document.querySelector('.improvement-cycle + .mt-6');
        if(improvementSection) {
            const actionsDiv = improvementSection.querySelector('.space-y-3');
            if(actionsDiv) {
                const newAction = document.createElement('div');
                newAction.className = 'p-3 bg-green-50 rounded-lg border border-green-200';
                newAction.innerHTML = `
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-medium">${obj}</span>
                        <span class="badge badge-management">Nouveau</span>
                    </div>
                    <p class="text-sm text-gray-600">Objectif qualité récemment défini</p>
                    <div class="mt-2 text-xs text-gray-500">Progression: <span class="font-semibold">0%</span></div>
                `;
                actionsDiv.prepend(newAction);
            }
        }
        
        alert('Objectif ajouté avec succès.');
        e.target.reset();
    });

    // Export PDF
    document.getElementById('exportPdf').addEventListener('click', ()=>{
        const el = document.querySelector('.card:nth-child(4)'); // Section Suivi SMART
        html2pdf().set({ 
            margin:0.5, 
            filename:'Objectifs_Qualite_SMQ.pdf', 
            jsPDF:{unit:'in',format:'a4',orientation:'landscape'} 
        }).from(el).save();
    });

    // Validation
    document.getElementById('btnValidate').addEventListener('click',()=>{
        const name=document.getElementById('validName').value.trim();
        const date=document.getElementById('validDate').value;
        if(!name||!date) return alert('Nom et date requis.');
        
        // Ajout de la validation au système
        const validationAlert = document.createElement('div');
        validationAlert.className = 'alert-success mt-4';
        validationAlert.innerHTML = `
            <i class="fa-solid fa-check-circle"></i>
            <strong>Validation enregistrée !</strong><br>
            <small>Validé par: ${name} | Date: ${date}</small>
        `;
        
        const form = document.getElementById('validateForm');
        form.parentNode.insertBefore(validationAlert, form.nextSibling);
        
        // Désactivation du bouton
        document.getElementById('btnValidate').disabled = true;
        document.getElementById('btnValidate').innerHTML = '<i class="fa-solid fa-check"></i> Validé';
        document.getElementById('btnValidate').classList.remove('bg-emerald-600');
        document.getElementById('btnValidate').classList.add('bg-gray-400');
        
        alert(`Validation effectuée par ${name} le ${date}.`);
    });

    // Initialisation date de validation
    document.getElementById('validDate').value = new Date().toISOString().split('T')[0];
});
</script>
@endsection