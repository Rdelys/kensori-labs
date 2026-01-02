@extends('layouts.clients')

@section('title', 'Risques & Opportunités')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<style>
.card { background: white; border-radius: 1rem; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 1.5rem; transition: 0.3s; border: 1px solid #e5e7eb; }
.card:hover { transform: translateY(-4px); box-shadow: 0 8px 20px rgba(0,0,0,0.12); }
.grid { display: grid; gap: 2rem; }
.matrix { border-collapse: collapse; width: 100%; border-radius: 0.5rem; overflow: hidden; }
.matrix th, .matrix td { border: 1px solid #e5e7eb; text-align: center; padding: 0.75rem; }
.matrix th { background-color: #f8fafc; font-weight: 700; color: #374151; }
.critical-high { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
.critical-medium { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
.critical-low { background: linear-gradient(135deg, #10b981, #059669); color: white; }
.badge { padding: 0.4rem 0.8rem; border-radius: 0.5rem; font-size: 0.8rem; font-weight: 600; color: white; display: inline-block; }
.badge-risk { background: linear-gradient(135deg, #ef4444, #dc2626); }
.badge-opportunity { background: linear-gradient(135deg, #10b981, #059669); }
.badge-event { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
.badge-situation { background: linear-gradient(135deg, #0ea5e9, #0284c7); }
.badge-trend { background: linear-gradient(135deg, #f97316, #ea580c); }
.fade-in { animation: fadeIn 0.4s ease-out both; }
@keyframes fadeIn { from {opacity:0; transform:translateY(6px);} to {opacity:1; transform:none;} }
.process-step { border-left: 3px solid #3b82f6; padding-left: 1rem; margin-bottom: 1rem; }
.impact-high { background-color: #fee2e2; border-left: 4px solid #dc2626; }
.impact-medium { background-color: #fef3c7; border-left: 4px solid #d97706; }
.impact-low { background-color: #dcfce7; border-left: 4px solid #16a34a; }
.cloud-point { width: 100%; height: 400px; border: 1px solid #e5e7eb; border-radius: 0.5rem; }
.step-indicator { display: flex; align-items: center; margin-bottom: 1rem; }
.step-number { width: 28px; height: 28px; border-radius: 50%; background: #3b82f6; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; margin-right: 0.75rem; }
.step-title { font-weight: 600; color: #1f2937; }
</style>

<div class="space-y-10 fade-in">

    {{-- EN-TÊTE AVEC OBJECTIF CLAIR --}}
    <div class="card bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200">
        <h2 class="text-3xl font-bold text-gray-800 mb-4 flex items-center gap-3">
            <i class="fa-solid fa-triangle-exclamation text-red-500"></i>
            Gestion des Risques & Opportunités - ISO 9001:2015 Clause 6.1
        </h2>
        <div class="grid md:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <h3 class="font-semibold text-blue-700 mb-2"><i class="fa-solid fa-bullseye mr-2"></i>Objectif Principal</h3>
                <p class="text-gray-700 text-sm">Identifier, évaluer et traiter les risques et opportunités liés au contexte de l'organisation pour assurer la conformité ISO 9001:2015 et améliorer la performance du SMQ.</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <h3 class="font-semibold text-blue-700 mb-2"><i class="fa-solid fa-sitemap mr-2"></i>Conformité Normative</h3>
                <p class="text-gray-700 text-sm">Clause 6.1 : "L'organisation doit déterminer les risques et opportunités pouvant affecter la conformité des produits/services et l'aptitude à augmenter la satisfaction client."</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <h3 class="font-semibold text-blue-700 mb-2"><i class="fa-solid fa-chart-line mr-2"></i>Impact sur le SMQ</h3>
                <p class="text-gray-700 text-sm">Évaluation de l'impact des risques/opportunités sur l'intégrité du Système de Management de la Qualité et les objectifs stratégiques.</p>
            </div>
        </div>
    </div>

    {{-- PROCESSUS DE GESTION DES RISQUES/OPPORTUNITÉS --}}
    <div class="card">
        <h3 class="text-xl font-semibold mb-6 text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-diagram-project text-indigo-600"></i> Processus de Gestion des Risques & Opportunités
        </h3>
        
        <div class="grid md:grid-cols-6 gap-4 mb-6">
            <div class="text-center">
                <div class="step-indicator justify-center">
                    <div class="step-number">1</div>
                </div>
                <h4 class="step-title text-sm">Identification</h4>
                <p class="text-xs text-gray-600 mt-1">Contexte interne/externe</p>
            </div>
            <div class="text-center">
                <div class="step-indicator justify-center">
                    <div class="step-number">2</div>
                </div>
                <h4 class="step-title text-sm">Classification</h4>
                <p class="text-xs text-gray-600 mt-1">Thème & Catégorie</p>
            </div>
            <div class="text-center">
                <div class="step-indicator justify-center">
                    <div class="step-number">3</div>
                </div>
                <h4 class="step-title text-sm">Catégorisation</h4>
                <p class="text-xs text-gray-600 mt-1">Risque vs Opportunité</p>
            </div>
            <div class="text-center">
                <div class="step-indicator justify-center">
                    <div class="step-number">4</div>
                </div>
                <h4 class="step-title text-sm">Dispositifs</h4>
                <p class="text-xs text-gray-600 mt-1">Mesures de maîtrise</p>
            </div>
            <div class="text-center">
                <div class="step-indicator justify-center">
                    <div class="step-number">5</div>
                </div>
                <h4 class="step-title text-sm">Planification</h4>
                <p class="text-xs text-gray-600 mt-1">Actions spécifiques</p>
            </div>
            <div class="text-center">
                <div class="step-indicator justify-center">
                    <div class="step-number">6</div>
                </div>
                <h4 class="step-title text-sm">Évaluation</h4>
                <p class="text-xs text-gray-600 mt-1">Résultats & Efficacité</p>
            </div>
        </div>

        {{-- FORMULAIRE COMPLET D'IDENTIFICATION --}}
        <div class="bg-gray-50 p-5 rounded-lg mb-6">
            <h4 class="text-lg font-semibold mb-4 text-gray-800"><i class="fa-solid fa-magnifying-glass mr-2"></i>Identification des Contextes - Analyse PESTEL/SWOT</h4>
            <form id="contextForm" class="grid md:grid-cols-2 gap-4 text-sm">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Source d'Identification</label>
                    <select id="sourceType" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Sélectionner --</option>
                        <option value="PESTEL">Analyse PESTEL</option>
                        <option value="SWOT">Analyse SWOT</option>
                        <option value="Audit">Audit Interne/Externe</option>
                        <option value="PartieInteressee">Partie Intéressée</option>
                        <option value="Processus">Analyse des Processus</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Thème de Classification</label>
                    <select id="themeType" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Sélectionner --</option>
                        <option value="evenement">Événement</option>
                        <option value="situation">Situation</option>
                        <option value="tendance">Tendance</option>
                        <option value="changement">Changement</option>
                        <option value="menace">Menace Émergente</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-medium mb-1">Description du Contexte</label>
                    <textarea id="contextDesc" rows="2" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Décrire le contexte interne ou externe identifié..."></textarea>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Catégorisation</label>
                    <select id="categorieType" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="risque">Risque</option>
                        <option value="opportunite">Opportunité</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Impact sur le SMQ</label>
                    <select id="impactSMQ" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="faible">Faible</option>
                        <option value="moyen">Moyen</option>
                        <option value="eleve">Élevé</option>
                        <option value="critique">Critique</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Probabilité</label>
                    <select id="probabilite" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="faible">Faible</option>
                        <option value="moyenne">Moyenne</option>
                        <option value="elevee">Élevée</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Gravité</label>
                    <select id="gravite" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="faible">Faible</option>
                        <option value="moyenne">Moyenne</option>
                        <option value="elevee">Élevée</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-medium mb-1">Dispositif de Maîtrise</label>
                    <textarea id="dispositif" rows="2" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Mesures de contrôle existantes ou à mettre en place..."></textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-medium mb-1">Actions Planifiées</label>
                    <textarea id="actionsPlanifiees" rows="2" class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Actions correctives/préventives planifiées..."></textarea>
                </div>
                <div class="md:col-span-2 text-right">
                    <button type="button" id="btnAnalyseContext" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-5 py-2.5 rounded-lg shadow">
                        <i class="fa-solid fa-chart-simple mr-2"></i>Analyser l'Impact SMQ
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- SECTION 1 - VISUALISATION DES RISQUES ET OPPORTUNITÉS --}}
    <div class="grid md:grid-cols-2 gap-6">
        <div class="card">
            <h3 class="text-xl font-semibold mb-3 text-gray-700 flex items-center justify-between">
                <span><i class="fa-solid fa-chart-pie text-red-500 mr-2"></i>Répartition des Risques</span>
                <span class="text-sm font-normal bg-red-100 text-red-800 px-2 py-1 rounded">Impact SMQ</span>
            </h3>
            <canvas id="risquesChart"></canvas>
            <div class="mt-4 grid grid-cols-2 gap-2 text-sm">
                <div class="bg-red-50 p-2 rounded">
                    <div class="font-semibold text-red-700">Risques Élevés</div>
                    <div class="text-lg font-bold">4</div>
                    <div class="text-xs text-gray-600">Impact critique sur SMQ</div>
                </div>
                <div class="bg-yellow-50 p-2 rounded">
                    <div class="font-semibold text-yellow-700">Risques Moyens</div>
                    <div class="text-lg font-bold">7</div>
                    <div class="text-xs text-gray-600">Impact modéré sur SMQ</div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <h3 class="text-xl font-semibold mb-3 text-gray-700 flex items-center justify-between">
                <span><i class="fa-solid fa-chart-pie text-green-500 mr-2"></i>Répartition des Opportunités</span>
                <span class="text-sm font-normal bg-green-100 text-green-800 px-2 py-1 rounded">Potentiel SMQ</span>
            </h3>
            <canvas id="opportunitesChart"></canvas>
            <div class="mt-4 grid grid-cols-2 gap-2 text-sm">
                <div class="bg-green-50 p-2 rounded">
                    <div class="font-semibold text-green-700">Opportunités Élevées</div>
                    <div class="text-lg font-bold">5</div>
                    <div class="text-xs text-gray-600">Fort potentiel d'amélioration</div>
                </div>
                <div class="bg-blue-50 p-2 rounded">
                    <div class="font-semibold text-blue-700">À Étudier</div>
                    <div class="text-lg font-bold">2</div>
                    <div class="text-xs text-gray-600">Analyse en cours</div>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION 2 - NUAGE DE POINTS (RISQUES vs OPPORTUNITÉS) --}}
    <div class="card">
        <h3 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
            <i class="fa-solid fa-cloud text-purple-500"></i> Carte des Risques & Opportunités - Impact vs Probabilité
        </h3>
        <div class="cloud-point" id="scatterChartContainer">
            <canvas id="scatterChart"></canvas>
        </div>
        <div class="mt-4 grid grid-cols-4 gap-2 text-sm">
            <div class="text-center p-2 bg-red-50 rounded">
                <div class="font-bold text-red-700">Zone Critique</div>
                <div class="text-xs">Risques Élevés</div>
            </div>
            <div class="text-center p-2 bg-yellow-50 rounded">
                <div class="font-bold text-yellow-700">Zone de Vigilance</div>
                <div class="text-xs">Risques Moyens</div>
            </div>
            <div class="text-center p-2 bg-green-50 rounded">
                <div class="font-bold text-green-700">Zone Opportunités</div>
                <div class="text-xs">Potentiel d'Amélioration</div>
            </div>
            <div class="text-center p-2 bg-blue-50 rounded">
                <div class="font-bold text-blue-700">Zone Neutre</div>
                <div class="text-xs">Impact Faible</div>
            </div>
        </div>
    </div>

    {{-- SECTION 3 - MATRICE DE CRITICITÉ ET CALCUL BRUT/NET --}}
    <div class="grid md:grid-cols-2 gap-6">
        <div class="card">
            <h3 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
                <i class="fa-solid fa-table-cells-large text-indigo-500"></i> Matrice de Criticité (Probabilité × Gravité)
            </h3>
            <table class="matrix text-sm">
                <thead>
                    <tr>
                        <th>Probabilité \ Gravité</th>
                        <th>Faible (1)</th>
                        <th>Moyenne (2)</th>
                        <th>Élevée (3)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Élevée (3)</th>
                        <td class="critical-medium">Modérée (6)</td>
                        <td class="critical-high">Élevée (9)</td>
                        <td class="critical-high">Critique (12)</td>
                    </tr>
                    <tr>
                        <th>Moyenne (2)</th>
                        <td class="critical-low">Faible (4)</td>
                        <td class="critical-medium">Modérée (6)</td>
                        <td class="critical-high">Élevée (9)</td>
                    </tr>
                    <tr>
                        <th>Faible (1)</th>
                        <td class="critical-low">Faible (2)</td>
                        <td class="critical-low">Faible (4)</td>
                        <td class="critical-medium">Modérée (6)</td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-4 text-sm text-gray-600">
                <p><i class="fa-solid fa-circle-info text-blue-500 mr-1"></i> <strong>Score = Probabilité × Gravité</strong> • Vert: Acceptable • Orange: Surveillance • Rouge: Action Requise</p>
            </div>
        </div>

        <div class="card">
            <h3 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
                <i class="fa-solid fa-scale-balanced text-green-600"></i> Calcul Brut vs Net et Impact SMQ
            </h3>
            <canvas id="riskEvalChart"></canvas>
            <div class="mt-4 grid grid-cols-3 gap-2 text-sm">
                <div class="bg-red-50 p-2 rounded text-center">
                    <div class="font-bold text-red-700">Réduction Moyenne</div>
                    <div class="text-lg">45%</div>
                </div>
                <div class="bg-blue-50 p-2 rounded text-center">
                    <div class="font-bold text-blue-700">Risques Résiduels</div>
                    <div class="text-lg">12</div>
                </div>
                <div class="bg-green-50 p-2 rounded text-center">
                    <div class="font-bold text-green-700">Efficacité Actions</div>
                    <div class="text-lg">78%</div>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION 4 - LISTE DES RISQUES/OPPORTUNITÉS AVEC IMPACT SMQ --}}
    <div class="card">
        <h3 class="text-xl font-semibold mb-4 text-gray-700 flex items-center justify-between">
            <span><i class="fa-solid fa-list-check text-blue-500"></i> Registre des Risques & Opportunités</span>
            <span class="text-sm font-normal bg-gray-100 text-gray-700 px-3 py-1 rounded">ISO 9001:2015 - Clause 6.1</span>
        </h3>
        
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-sm">
                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="p-3 font-semibold">Type</th>
                        <th class="p-3 font-semibold">Description</th>
                        <th class="p-3 font-semibold">Source</th>
                        <th class="p-3 font-semibold">Thème</th>
                        <th class="p-3 font-semibold">Impact SMQ</th>
                        <th class="p-3 font-semibold">Criticité</th>
                        <th class="p-3 font-semibold">Actions</th>
                        <th class="p-3 font-semibold">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3"><span class="badge badge-risk">Risque</span></td>
                        <td class="p-3">Modification réglementaire environnementale affectant les processus de production</td>
                        <td class="p-3"><span class="badge badge-event">PESTEL Légal</span></td>
                        <td class="p-3">Changement Réglementaire</td>
                        <td class="p-3">
                            <div class="impact-high p-2 rounded text-center font-semibold">Élevé</div>
                            <div class="text-xs text-gray-500 mt-1">Conformité SMQ</div>
                        </td>
                        <td class="p-3">
                            <div class="text-center">
                                <span class="inline-block w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center">9</span>
                                <div class="text-xs text-gray-500 mt-1">Prob: 3 × Grav: 3</div>
                            </div>
                        </td>
                        <td class="p-3">
                            <ul class="list-disc pl-4 text-xs space-y-1">
                                <li>Mise à jour procédures</li>
                                <li>Formation équipe</li>
                            </ul>
                        </td>
                        <td class="p-3">
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-semibold">En traitement</span>
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3"><span class="badge badge-opportunity">Opportunité</span></td>
                        <td class="p-3">Adoption de nouvelles technologies d'automatisation pour améliorer l'efficacité</td>
                        <td class="p-3"><span class="badge badge-trend">PESTEL Tech</span></td>
                        <td class="p-3">Innovation Technologique</td>
                        <td class="p-3">
                            <div class="impact-medium p-2 rounded text-center font-semibold">Moyen</div>
                            <div class="text-xs text-gray-500 mt-1">Performance Processus</div>
                        </td>
                        <td class="p-3">
                            <div class="text-center">
                                <span class="inline-block w-6 h-6 bg-green-500 text-white rounded-full flex items-center justify-center">4</span>
                                <div class="text-xs text-gray-500 mt-1">Prob: 2 × Grav: 2</div>
                            </div>
                        </td>
                        <td class="p-3">
                            <ul class="list-disc pl-4 text-xs space-y-1">
                                <li>Étude de faisabilité</li>
                                <li>Benchmark solutions</li>
                            </ul>
                        </td>
                        <td class="p-3">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-semibold">Planifiée</span>
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3"><span class="badge badge-risk">Risque</span></td>
                        <td class="p-3">Perte de compétences clés due au départ à la retraite</td>
                        <td class="p-3"><span class="badge badge-situation">SWOT Faiblesse</span></td>
                        <td class="p-3">Ressources Humaines</td>
                        <td class="p-3">
                            <div class="impact-high p-2 rounded text-center font-semibold">Élevé</div>
                            <div class="text-xs text-gray-500 mt-1">Compétences & Conformité</div>
                        </td>
                        <td class="p-3">
                            <div class="text-center">
                                <span class="inline-block w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center">8</span>
                                <div class="text-xs text-gray-500 mt-1">Prob: 4 × Grav: 2</div>
                            </div>
                        </td>
                        <td class="p-3">
                            <ul class="list-disc pl-4 text-xs space-y-1">
                                <li>Programme mentorat</li>
                                <li>Documentation savoir-faire</li>
                            </ul>
                        </td>
                        <td class="p-3">
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">En cours</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 text-right">
            <button id="exportPdf" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-5 py-2.5 rounded-lg shadow flex items-center gap-2">
                <i class="fa-solid fa-file-pdf"></i> Exporter Rapport ISO 9001
            </button>
        </div>
    </div>

    {{-- SECTION 5 - ÉVALUATION DES RÉSULTATS DES ACTIONS --}}
    <div class="card">
        <h3 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
            <i class="fa-solid fa-chart-line text-green-600"></i> Évaluation des Résultats des Actions - Efficacité
        </h3>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h4 class="text-gray-700 font-semibold mb-2"><i class="fa-solid fa-gauge-high text-blue-500 mr-2"></i>Suivi de l'Efficacité des Actions</h4>
                <canvas id="efficaciteChart"></canvas>
            </div>
            <div>
                <h4 class="text-gray-700 font-semibold mb-2"><i class="fa-solid fa-check-double text-green-500 mr-2"></i>Statut des Actions Planifiées</h4>
                <div class="space-y-3">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <div class="flex justify-between items-center">
                            <span class="font-medium">Mise à jour procédures réglementaires</span>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Terminé</span>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">Impact SMQ: Réduction risque de 9 à 4</div>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <div class="flex justify-between items-center">
                            <span class="font-medium">Programme transfert compétences</span>
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">En cours</span>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">Impact SMQ: Amélioration compétences 65% → 85%</div>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <div class="flex justify-between items-center">
                            <span class="font-medium">Étude automatisation processus</span>
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Planifié</span>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">Impact SMQ: Potentiel gain efficacité 15-20%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION 6 - VALIDATION CONFORMITÉ ISO --}}
    <div class="card bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200">
        <h3 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
            <i class="fa-solid fa-certificate text-green-600"></i> Validation Conformité ISO 9001:2015 - Clause 6.1
        </h3>
        <form id="validateForm" class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-700 font-medium mb-1">Validé par (Responsable Qualité)</label>
                <input id="validName" type="text" class="border rounded-lg p-2.5 w-full focus:ring-2 focus:ring-emerald-300" placeholder="Directeur Qualité" value="RAZAFY ASSANI">
            </div>
            <div>
                <label class="block text-sm text-gray-700 font-medium mb-1">Date de validation</label>
                <input id="validDate" type="date" class="border rounded-lg p-2.5 w-full focus:ring-2 focus:ring-emerald-300" value="2025-06-24">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm text-gray-700 font-medium mb-1">Évaluation de conformité ISO 9001:2015</label>
                <textarea id="validComment" rows="3" class="border rounded-lg p-3 w-full focus:ring-2 focus:ring-emerald-300">Le système de gestion des risques et opportunités est conforme aux exigences de la clause 6.1 de l'ISO 9001:2015. Tous les risques et opportunités significatifs ont été identifiés, évalués et des actions appropriées ont été planifiées. L'impact sur le SMQ est maîtrisé et les dispositifs de surveillance sont en place.</textarea>
            </div>
            <div class="md:col-span-2">
                <div class="flex items-center gap-2 mb-3">
                    <input type="checkbox" id="conformiteISO" checked class="h-4 w-4 text-green-600">
                    <label for="conformiteISO" class="text-sm text-gray-700">Le système satisfait aux exigences de l'ISO 9001:2015 concernant la gestion des risques et opportunités</label>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="actionsEfficaces" checked class="h-4 w-4 text-green-600">
                    <label for="actionsEfficaces" class="text-sm text-gray-700">Les actions planifiées sont appropriées et leur efficacité sera évaluée</label>
                </div>
            </div>
            <div class="text-right md:col-span-2">
                <button id="btnValidate" type="button" class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-6 py-3 rounded-lg shadow font-semibold">
                    <i class="fa-solid fa-file-certificate mr-2"></i> Valider la Conformité ISO
                </button>
            </div>
        </form>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    // Graphiques de répartition
    new Chart(document.getElementById('risquesChart'), {
        type: 'doughnut',
        data: { 
            labels: ['Critiques (Impact Élevé)', 'Modérés (Impact Moyen)', 'Faibles (Impact Faible)'], 
            datasets: [{ 
                data: [4, 7, 3], 
                backgroundColor: ['#dc2626','#d97706','#059669'],
                borderWidth: 2,
                borderColor: '#fff'
            }] 
        },
        options: { 
            plugins: { 
                legend: { position: 'bottom', labels: { padding: 20 } },
                tooltip: { callbacks: { label: function(context) { return context.label + ': ' + context.raw + ' risques'; } } }
            },
            cutout: '60%'
        }
    });
    
    new Chart(document.getElementById('opportunitesChart'), {
        type: 'doughnut',
        data: { 
            labels: ['Implémentées', 'Planifiées', 'À étudier', 'Abandonnées'], 
            datasets: [{ 
                data: [5, 3, 2, 1], 
                backgroundColor: ['#059669','#3b82f6','#a855f7','#6b7280'],
                borderWidth: 2,
                borderColor: '#fff'
            }] 
        },
        options: { 
            plugins: { 
                legend: { position: 'bottom', labels: { padding: 20 } },
                tooltip: { callbacks: { label: function(context) { return context.label + ': ' + context.raw + ' opportunités'; } } }
            },
            cutout: '60%'
        }
    });

    // Graphique nuage de points (Scatter)
    const scatterCtx = document.getElementById('scatterChart').getContext('2d');
    new Chart(scatterCtx, {
        type: 'scatter',
        data: {
            datasets: [
                {
                    label: 'Risques',
                    data: [
                        {x: 8, y: 9, r: 12},
                        {x: 6, y: 7, r: 10},
                        {x: 4, y: 6, r: 8},
                        {x: 7, y: 8, r: 11},
                        {x: 5, y: 5, r: 7},
                        {x: 9, y: 7, r: 13}
                    ],
                    backgroundColor: 'rgba(239, 68, 68, 0.7)',
                    borderColor: '#dc2626',
                    borderWidth: 1
                },
                {
                    label: 'Opportunités',
                    data: [
                        {x: 3, y: 8, r: 9},
                        {x: 2, y: 6, r: 7},
                        {x: 4, y: 7, r: 8},
                        {x: 1, y: 5, r: 6},
                        {x: 2, y: 9, r: 10}
                    ],
                    backgroundColor: 'rgba(16, 185, 129, 0.7)',
                    borderColor: '#059669',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: Impact=${context.parsed.x}, Probabilité=${context.parsed.y}`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    title: { display: true, text: 'Impact sur le SMQ (1-10)', font: { weight: 'bold' } },
                    min: 0,
                    max: 10,
                    grid: { color: 'rgba(0,0,0,0.05)' }
                },
                y: {
                    title: { display: true, text: 'Probabilité (1-10)', font: { weight: 'bold' } },
                    min: 0,
                    max: 10,
                    grid: { color: 'rgba(0,0,0,0.05)' }
                }
            }
        }
    });

    // Graphique calcul brut/net
    new Chart(document.getElementById('riskEvalChart'), {
        type: 'bar',
        data: { 
            labels: ['Réglementaire', 'Compétences', 'Technologique', 'Fournisseurs', 'Processus'], 
            datasets: [
                { 
                    label: 'Niveau Brut', 
                    data: [9, 8, 7, 6, 5], 
                    backgroundColor: '#ef4444',
                    borderColor: '#dc2626',
                    borderWidth: 1
                },
                { 
                    label: 'Niveau Net (après actions)', 
                    data: [4, 3, 4, 3, 2], 
                    backgroundColor: '#10b981',
                    borderColor: '#059669',
                    borderWidth: 1
                }
            ]
        },
        options: { 
            responsive: true, 
            plugins: { 
                legend: { position: 'top' },
                tooltip: { callbacks: { label: function(context) { return context.dataset.label + ': ' + context.raw; } } }
            }, 
            scales: { 
                y: { 
                    beginAtZero: true, 
                    max: 10,
                    title: { display: true, text: 'Niveau de criticité (1-10)' }
                },
                x: {
                    title: { display: true, text: 'Catégories de risques/opportunités' }
                }
            } 
        }
    });

    // Graphique efficacité
    new Chart(document.getElementById('efficaciteChart'), {
        type: 'line',
        data: { 
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'], 
            datasets: [
                { 
                    label: 'Efficacité Actions (%)', 
                    data: [60, 70, 78, 82, 85, 88], 
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 3,
                    tension: 0.3,
                    fill: true
                },
                { 
                    label: 'Risques Résiduels', 
                    data: [18, 15, 12, 10, 9, 8], 
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: false
                }
            ]
        },
        options: { 
            responsive: true,
            plugins: { 
                legend: { position: 'top' }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Valeur' }
                }
            }
        }
    });

    // Analyse de l'impact SMQ
    document.getElementById('btnAnalyseContext').addEventListener('click', () => {
        const source = document.getElementById('sourceType').value;
        const theme = document.getElementById('themeType').value;
        const desc = document.getElementById('contextDesc').value.trim();
        const categorie = document.getElementById('categorieType').value;
        const impact = document.getElementById('impactSMQ').value;
        const probabilite = document.getElementById('probabilite').value;
        const gravite = document.getElementById('gravite').value;
        const dispositif = document.getElementById('dispositif').value;
        const actions = document.getElementById('actionsPlanifiees').value;
        
        if(!source || !theme || !desc) {
            alert('Veuillez remplir les champs obligatoires : Source, Thème et Description.');
            return;
        }
        
        // Calcul de la criticité
        const probScore = {faible: 1, moyenne: 2, elevee: 3}[probabilite] || 1;
        const gravScore = {faible: 1, moyenne: 2, elevee: 3}[gravite] || 1;
        const criticite = probScore * gravScore;
        
        let niveau = 'Faible';
        let couleur = 'green';
        if(criticite >= 7) { niveau = 'Élevé'; couleur = 'red'; }
        else if(criticite >= 4) { niveau = 'Moyen'; couleur = 'orange'; }
        
        // Évaluation impact SMQ
        let impactSMQ = '';
        let impactColor = '';
        switch(impact) {
            case 'critique': impactSMQ = 'Critique - Remise en cause du SMQ'; impactColor = 'red'; break;
            case 'eleve': impactSMQ = 'Élevé - Affecte significativement le SMQ'; impactColor = 'orange'; break;
            case 'moyen': impactSMQ = 'Moyen - Affecte partiellement le SMQ'; impactColor = 'yellow'; break;
            case 'faible': impactSMQ = 'Faible - Impact limité sur le SMQ'; impactColor = 'green'; break;
        }
        
        const message = `
ANALYSE IMPACT SMQ - ISO 9001:2015

• Source: ${source}
• Thème: ${theme}
• Catégorie: ${categorie === 'risque' ? 'RISQUE' : 'OPPORTUNITÉ'}
• Description: ${desc}

ÉVALUATION:
• Impact sur le SMQ: ${impactSMQ}
• Probabilité: ${probabilite} (score: ${probScore})
• Gravité: ${gravite} (score: ${gravScore})
• Criticité calculée: ${criticite} → Niveau: ${niveau}

DISPOSITIFS:
${dispositif || 'Aucun dispositif spécifié'}

ACTIONS PLANIFIÉES:
${actions || 'Aucune action planifiée'}

RECOMMANDATION: ${couleur === 'red' ? 'ACTION IMMÉDIATE REQUISE' : couleur === 'orange' ? 'SURVEILLANCE RENFORCÉE' : 'SUIVI STANDARD'}
        `;
        
        alert(message);
        
        // Ajout à la table (simulation)
        const table = document.querySelector('table tbody');
        const newRow = document.createElement('tr');
        newRow.className = 'border-b hover:bg-gray-50';
        newRow.innerHTML = `
            <td class="p-3"><span class="badge ${categorie === 'risque' ? 'badge-risk' : 'badge-opportunity'}">${categorie === 'risque' ? 'Risque' : 'Opportunité'}</span></td>
            <td class="p-3">${desc.substring(0, 60)}${desc.length > 60 ? '...' : ''}</td>
            <td class="p-3"><span class="badge badge-${source === 'PESTEL' ? 'event' : source === 'SWOT' ? 'situation' : 'trend'}">${source}</span></td>
            <td class="p-3">${theme}</td>
            <td class="p-3">
                <div class="impact-${impact} p-2 rounded text-center font-semibold">${impact.charAt(0).toUpperCase() + impact.slice(1)}</div>
                <div class="text-xs text-gray-500 mt-1">${impactSMQ.split(' - ')[1]}</div>
            </td>
            <td class="p-3">
                <div class="text-center">
                    <span class="inline-block w-6 h-6 bg-${couleur}-500 text-white rounded-full flex items-center justify-center">${criticite}</span>
                    <div class="text-xs text-gray-500 mt-1">Prob: ${probScore} × Grav: ${gravScore}</div>
                </div>
            </td>
            <td class="p-3">
                <div class="text-xs">${actions ? 'Actions définies' : 'À planifier'}</div>
            </td>
            <td class="p-3">
                <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs font-semibold">Nouveau</span>
            </td>
        `;
        table.insertBefore(newRow, table.firstChild);
        
        // Réinitialisation du formulaire
        document.getElementById('contextForm').reset();
    });

    // Validation conformité ISO
    document.getElementById('btnValidate').addEventListener('click', () => {
        const name = document.getElementById('validName').value.trim();
        const date = document.getElementById('validDate').value;
        const comment = document.getElementById('validComment').value;
        
        if(!name || !date) {
            alert('Veuillez remplir le nom du responsable et la date.');
            return;
        }
        
        const conformite = document.getElementById('conformiteISO').checked;
        const actionsEfficaces = document.getElementById('actionsEfficaces').checked;
        
        if(!conformite || !actionsEfficaces) {
            alert('Veuillez cocher toutes les cases de validation de conformité.');
            return;
        }
        
        alert(`✅ CONFORMITÉ ISO 9001:2015 VALIDÉE\n\nValidé par: ${name}\nDate: ${date}\n\n${comment}\n\nCette validation a été enregistrée dans le système QMS.`);
        
        // Mise à jour visuelle
        document.getElementById('btnValidate').innerHTML = '<i class="fa-solid fa-check mr-2"></i> Conformité Validée';
        document.getElementById('btnValidate').classList.remove('from-green-600', 'to-emerald-600', 'hover:from-green-700', 'hover:to-emerald-700');
        document.getElementById('btnValidate').classList.add('from-gray-600', 'to-gray-700');
        document.getElementById('btnValidate').disabled = true;
    });

    // Export PDF
    document.getElementById('exportPdf').addEventListener('click', () => {
        const element = document.querySelector('.card:has(.grid-cols-6)');
        const opt = {
            margin: 1,
            filename: `Rapport_Risques_Opportunites_ISO9001_${new Date().toISOString().slice(0,10)}.pdf`,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true },
            jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
        };
        
        html2pdf().set(opt).from(element).save();
    });
});
</script>

@endsection