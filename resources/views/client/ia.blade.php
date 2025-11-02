@extends('layouts.clients')

@section('title', 'IA Prédictive')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="space-y-8 fade-in p-6">
    <!-- En-tête de la page -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800"><i class="fa-solid fa-robot text-blue-500 mr-3"></i>IA Prédictive - Tableaux de Bord Intelligents</h1>
            <p class="text-gray-600 mt-2">Analyse prédictive et prescriptions intelligentes pour l'amélioration continue du SMQ</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <button id="btnRefresh" class="btn-primary flex items-center">
                <i class="fa-solid fa-arrows-rotate mr-2"></i>Actualiser les analyses
            </button>
            <button id="btnExportReport" class="btn-secondary flex items-center">
                <i class="fa-solid fa-download mr-2"></i>Exporter le rapport
            </button>
        </div>
    </div>

    <!-- KPI et Métriques Prédictives -->
    <div class="cards-grid">
        <!-- Carte : Risques Prédits -->
        <div class="card card-red">
            <div class="card-top">
                <div>
                    <p class="card-title">Risques Prédits</p>
                    <p class="card-value" id="riskCount">14</p>
                </div>
                <div class="card-icon red">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
            </div>
            <div class="card-bottom red">
                <span>Élevé: <strong id="riskHigh">6</strong></span>
                <span>Moyen: <strong id="riskMedium">5</strong></span>
                <span>Faible: <strong id="riskLow">3</strong></span>
            </div>
        </div>

        <!-- Carte : NC Potentielles -->
        <div class="card card-orange">
            <div class="card-top">
                <div>
                    <p class="card-title">NC Potentielles</p>
                    <p class="card-value" id="ncPot">9</p>
                </div>
                <div class="card-icon orange">
                    <i class="fa-solid fa-bug"></i>
                </div>
            </div>
            <div class="card-bottom orange">
                <span><i class="fa-solid fa-arrow-up"></i> +12% vs dernier mois</span>
            </div>
        </div>

        <!-- Carte : Opportunités -->
        <div class="card card-green">
            <div class="card-top">
                <div>
                    <p class="card-title">Opportunités</p>
                    <p class="card-value" id="oppsCount">7</p>
                </div>
                <div class="card-icon green">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
            </div>
            <div class="card-bottom green">
                <span>Gain potentiel: 45k€/an</span>
            </div>
        </div>

        <!-- Carte : Alertes Actives -->
        <div class="card card-blue">
            <div class="card-top">
                <div>
                    <p class="card-title">Alertes Actives</p>
                    <p class="card-value" id="alertsCount">5</p>
                </div>
                <div class="card-icon blue">
                    <i class="fa-solid fa-bell"></i>
                </div>
            </div>
            <div class="card-bottom blue">
                <span>3 nécessitent action immédiate</span>
            </div>
        </div>
    </div>

    <!-- Section : Analyse Prédictive et Détection de Tendances -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Graphique : Tendances des Non-Conformités -->
        <div class="card">
            <div class="card-header bg-gray-50 border-gray-200 flex items-center gap-2 p-4 rounded-t-lg">
                <i class="fa-solid fa-chart-line text-gray-600 mr-2"></i>
                <h3 class="text-lg font-semibold text-gray-700">Tendances des Non-Conformités Prédites</h3>
            </div>
            <div class="p-6">
                <div class="relative h-64 bg-gray-50 rounded-lg border border-gray-200 flex items-center justify-center">
                    <!-- Graphique simulé -->
                    <div class="text-center">
                        <i class="fa-solid fa-chart-bar text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-500">Graphique des tendances prédictives</p>
                        <div class="mt-4 space-y-2 text-sm text-gray-600">
                            <div class="flex items-center justify-between">
                                <span>Processus Production:</span>
                                <span class="text-red-600 font-semibold">↑ +18%</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Fournisseurs:</span>
                                <span class="text-orange-500">↑ +8%</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Documentation:</span>
                                <span class="text-green-600">↓ -5%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulaire d'ajout d'analyse (visible directement) -->
                <div class="mt-4 bg-white border rounded-lg p-4">
                    <h4 class="font-semibold text-gray-800 mb-2">Ajouter une analyse prédictive</h4>
                    <form id="addAnalysisForm" class="grid grid-cols-1 gap-3 text-sm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <input id="analysisProcess" type="text" class="w-full border rounded-lg p-2" placeholder="Processus (ex: Production)" required>
                            <select id="analysisSeverity" class="w-full border rounded-lg p-2">
                                <option value="Faible">Faible</option>
                                <option value="Moyen">Moyen</option>
                                <option value="Élevé">Élevé</option>
                            </select>
                        </div>
                        <textarea id="analysisDesc" rows="2" class="w-full border rounded-lg p-2" placeholder="Description courte (cause, indicateur, seuil)"></textarea>
                        <div class="flex items-center gap-3">
                            <input id="analysisProb" type="number" min="0" max="100" value="50" class="w-28 border rounded-lg p-2 text-sm" placeholder="Probabilité (%)">
                            <input id="analysisImpact" type="text" class="w-full border rounded-lg p-2 text-sm" placeholder="Impact (ex: Élevé)">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Ajouter</button>
                            <button type="button" id="clearAnalysisForm" class="px-4 py-2 border rounded-lg text-gray-600">Effacer</button>
                        </div>
                        <div id="addAnalysisMessage" class="text-xs text-green-600 hidden">Analyse ajoutée (simulation).</div>
                    </form>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                    <div class="bg-red-50 p-3 rounded-lg">
                        <div class="font-semibold text-red-700">Point de vigilance</div>
                        <div class="text-red-600">Augmentation prévue des NC production</div>
                    </div>
                    <div class="bg-green-50 p-3 rounded-lg">
                        <div class="font-semibold text-green-700">Amélioration</div>
                        <div class="text-green-600">Baisse des NC documentation</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte : Satisfaction Client Prédictive -->
        <div class="card">
            <div class="card-header bg-purple-50 border-purple-200 p-4 rounded-t-lg flex items-center gap-2">
                <i class="fa-regular fa-face-smile text-purple-600 mr-2"></i>
                <h3 class="text-lg font-semibold text-purple-700">Satisfaction Client Prédictive</h3>
            </div>
            <div class="p-6">
                <div class="text-center mb-6">
                    <div class="text-4xl font-bold text-purple-700" id="predictedSatisfaction">82%</div>
                    <div class="text-sm text-gray-600">Score de satisfaction prévu (30 jours)</div>
                    <div class="flex items-center justify-center mt-2 text-orange-600">
                        <i class="fa-solid fa-arrow-down mr-1"></i>
                        <span class="text-sm">-3% vs période précédente</span>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Délais de livraison</span>
                            <span class="text-red-600">-8% prévu</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 65%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Qualité produit</span>
                            <span class="text-green-600">+2% prévu</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Support client</span>
                            <span class="text-orange-500">-5% prévu</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-orange-500 h-2 rounded-full" style="width: 72%"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 bg-purple-50 p-4 rounded-lg">
                    <div class="flex items-start">
                        <i class="fa-solid fa-lightbulb text-purple-500 mt-1 mr-3"></i>
                        <div>
                            <div class="font-semibold text-purple-700">Recommandation IA</div>
                            <div class="text-sm text-purple-600">Renforcer la formation de l'équipe support client</div>
                        </div>
                    </div>
                </div>

                <!-- Formulaire d'ajout de recommandation IA (visible) -->
                <div class="mt-4 bg-white border rounded-lg p-4">
                    <h4 class="font-semibold text-gray-800 mb-2">Ajouter une recommandation IA</h4>
                    <form id="addRecommendationForm" class="grid grid-cols-1 gap-3 text-sm">
                        <input id="recTitle" type="text" class="w-full border rounded-lg p-2" placeholder="Titre (ex: Formation support client)" required>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <select id="recPriority" class="w-full border rounded-lg p-2">
                                <option value="Opportunité">Opportunité</option>
                                <option value="Moyenne">Priorité Moyenne</option>
                                <option value="Élevée">Priorité Élevée</option>
                            </select>
                            <input id="recModule" type="text" class="w-full border rounded-lg p-2" placeholder="Module concerné (ex: Compétences)">
                        </div>
                        <textarea id="recDesc" rows="2" class="w-full border rounded-lg p-2" placeholder="Description/raison"></textarea>
                        <div class="flex items-center gap-3">
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg">Ajouter recommandation</button>
                            <button type="button" id="clearRecForm" class="px-4 py-2 border rounded-lg text-gray-600">Effacer</button>
                        </div>
                        <div id="addRecMessage" class="text-xs text-green-600 hidden">Recommandation ajoutée (simulation).</div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Section : Recommandations Intelligentes -->
    <div class="card">
        <div class="card-header bg-gradient-to-r from-purple-50 to-indigo-50 border-purple-200 p-4 rounded-t-lg flex items-center gap-2">
            <i class="fa-solid fa-lightbulb text-purple-600 mr-2"></i>
            <h3 class="text-lg font-semibold text-purple-700">Recommandations Intelligentes de l'IA</h3>
        </div>
        <div class="p-6">
            <div class="space-y-6" id="recommendationsList">
                <!-- Recommendation 1 (statique initiale) -->
                <div class="flex items-start gap-4 p-4 bg-white border border-purple-200 rounded-lg shadow-sm">
                    <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-semibold text-gray-800">Action Corrective Préventive - Processus Production</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Priorité Élevée
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-3">
                            L'IA détecte une augmentation de 85% de la probabilité de non-conformités dans le processus de production.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-blue-100 text-blue-700">
                                <i class="fa-solid fa-link mr-1"></i>Module CAPA
                            </span>
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-green-100 text-green-700">
                                <i class="fa-solid fa-chart-simple mr-1"></i>KPI Production
                            </span>
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-orange-100 text-orange-700">
                                <i class="fa-solid fa-screwdriver-wrench mr-1"></i>Équipements
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <button class="btn-primary btn-sm flex items-center create-capa-inline" data-title="Réglage machine + formation" data-source="IA" data-prob="85" data-impact="Élevé">
                                <i class="fa-solid fa-play mr-1"></i>Appliquer la recommandation
                            </button>
                            <button class="btn-secondary btn-sm flex items-center show-analysis" data-analysis="detailed-1">
                                <i class="fa-solid fa-chart-line mr-1"></i>Voir l'analyse détaillée
                            </button>
                            <button class="btn-secondary btn-sm flex items-center schedule-action" data-action-type="Planifier">
                                <i class="fa-solid fa-clock mr-1"></i>Planifier pour plus tard
                            </button>
                        </div>

                        <!-- Formulaire inline pour créer CAPA (s'affiche quand on clique) -->
                        <div class="mt-3 hidden inline-form create-capa-form border p-3 rounded bg-gray-50">
                            <h5 class="font-semibold text-gray-700 mb-2">Créer CAPA depuis recommandation</h5>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-2">
                                <input type="text" class="border rounded p-2 text-sm capa-nc" placeholder="NC associée (ex: NC-XXX)">
                                <input type="text" class="border rounded p-2 text-sm capa-resp" placeholder="Responsable">
                            </div>
                            <textarea class="w-full border rounded p-2 text-sm capa-action" rows="2" placeholder="Action corrective ..."></textarea>
                            <div class="flex items-center gap-2 mt-2">
                                <button class="px-3 py-2 bg-blue-600 text-white rounded create-capa-do">Créer CAPA</button>
                                <button class="px-3 py-2 border rounded cancel-capa">Annuler</button>
                                <div class="text-sm text-green-600 ml-2 capa-created hidden">CAPA créé (simulation)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recommendation 2 -->
                <div class="flex items-start gap-4 p-4 bg-white border border-blue-200 rounded-lg shadow-sm">
                    <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-people-group text-blue-600"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-semibold text-gray-800">Optimisation Formation - Équipe Qualité</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Priorité Moyenne
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-3">
                            L'IA recommande un programme de formation ciblé avec un ROI estimé à 215%.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-blue-100 text-blue-700">
                                <i class="fa-solid fa-id-badge mr-1"></i>Compétences
                            </span>
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-green-100 text-green-700">
                                <i class="fa-solid fa-shield-check mr-1"></i>Audits
                            </span>
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-purple-100 text-purple-700">
                                <i class="fa-solid fa-graduation-cap mr-1"></i>Formation
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <button class="btn-primary btn-sm flex items-center create-training-inline">
                                <i class="fa-solid fa-play mr-1"></i>Appliquer la recommandation
                            </button>
                            <button class="btn-secondary btn-sm flex items-center show-analysis" data-analysis="detailed-2">
                                <i class="fa-solid fa-chart-line mr-1"></i>Voir l'analyse détaillée
                            </button>
                        </div>

                        <!-- Formulaire inline pour planifier formation -->
                        <div class="mt-3 hidden inline-form training-form border p-3 rounded bg-gray-50">
                            <h5 class="font-semibold text-gray-700 mb-2">Planifier formation</h5>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-2">
                                <input type="text" class="border rounded p-2 text-sm training-title" placeholder="Titre formation">
                                <input type="date" class="border rounded p-2 text-sm training-date">
                            </div>
                            <textarea class="w-full border rounded p-2 text-sm training-desc" rows="2" placeholder="Détails / objectifs"></textarea>
                            <div class="flex items-center gap-2 mt-2">
                                <button class="px-3 py-2 bg-green-600 text-white rounded plan-training-do">Planifier</button>
                                <button class="px-3 py-2 border rounded cancel-training">Annuler</button>
                                <div class="text-sm text-green-600 ml-2 training-saved hidden">Plan enregistré (simulation)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recommendation 3 -->
                <div class="flex items-start gap-4 p-4 bg-white border border-green-200 rounded-lg shadow-sm">
                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-chart-line text-green-600"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-semibold text-gray-800">Amélioration Processus - Réduction des Délais</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Opportunité
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-3">
                            Automatisation possible avec gain de temps estimé à 12 heures/semaine.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-blue-100 text-blue-700">
                                <i class="fa-solid fa-diagram-project mr-1"></i>Processus
                            </span>
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-green-100 text-green-700">
                                <i class="fa-solid fa-file-lines mr-1"></i>Documentation
                            </span>
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-orange-100 text-orange-700">
                                <i class="fa-solid fa-arrows-rotate mr-1"></i>Efficacité
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <button class="btn-primary btn-sm flex items-center launch-project-inline">
                                <i class="fa-solid fa-play mr-1"></i>Appliquer la recommandation
                            </button>
                            <button class="btn-secondary btn-sm flex items-center show-analysis" data-analysis="detailed-3">
                                <i class="fa-solid fa-calculator mr-1"></i>Calculer le ROI
                            </button>
                        </div>

                        <!-- Formulaire inline pour lancer projet -->
                        <div class="mt-3 hidden inline-form project-form border p-3 rounded bg-gray-50">
                            <h5 class="font-semibold text-gray-700 mb-2">Lancer projet d'amélioration</h5>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-2">
                                <input type="text" class="border rounded p-2 text-sm project-name" placeholder="Nom du projet">
                                <input type="date" class="border rounded p-2 text-sm project-start">
                            </div>
                            <textarea class="w-full border rounded p-2 text-sm project-desc" rows="2" placeholder="Objectifs / ROI attendu"></textarea>
                            <div class="flex items-center gap-2 mt-2">
                                <button class="px-3 py-2 bg-blue-600 text-white rounded start-project-do">Lancer</button>
                                <button class="px-3 py-2 border rounded cancel-project">Annuler</button>
                                <div class="text-sm text-green-600 ml-2 project-started hidden">Projet lancé (simulation)</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Section : Actions Correctives Auto-suggérées -->
    <div class="card">
        <div class="card-header bg-gradient-to-r from-orange-50 to-amber-50 border-orange-200 p-4 rounded-t-lg flex items-center gap-2">
            <i class="fa-solid fa-wand-magic-sparkles text-orange-600 mr-2"></i>
            <h3 class="text-lg font-semibold text-orange-700">Actions Correctives et Préventives Auto-suggérées</h3>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full min-w-full text-sm" id="autoActionsTable">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Module Source</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Probabilité</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Impact</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="autoActionsBody">
                        <!-- Ligne 1 -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <i class="fa-solid fa-bug mr-1"></i>Corrective
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                <div class="font-medium">Défauts récurrents sur ligne production B</div>
                                <div class="text-gray-500 text-xs mt-1">Basé sur l'analyse des données de contrôle qualité</div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                <a href="{{ route('client.capa') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                                    <i class="fa-solid fa-link mr-1"></i>Module CAPA
                                </a>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                <span class="font-medium text-red-600">85%</span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Élevé
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm font-medium">
                                <button class="btn-primary btn-sm flex items-center open-inline-action" data-type="capa">
                                    <i class="fa-solid fa-plus mr-1"></i>Créer CAPA
                                </button>
                            </td>
                        </tr>

                        <!-- Ligne 2 -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <i class="fa-solid fa-shield-check mr-1"></i>Préventive
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                <div class="font-medium">Risque de non-conformité fournisseur principal</div>
                                <div class="text-gray-500 text-xs mt-1">Détection basée sur l'analyse des performances</div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                <a href="{{ route('client.risques') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                                    <i class="fa-solid fa-triangle-exclamation mr-1"></i>Module Risques
                                </a>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                <span class="font-medium text-orange-500">72%</span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                    Moyen
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm font-medium">
                                <button class="btn-primary btn-sm flex items-center open-inline-action" data-type="plan">
                                    <i class="fa-solid fa-play mr-1"></i>Planifier action
                                </button>
                            </td>
                        </tr>

                        <!-- Ligne 3 -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fa-solid fa-chart-line mr-1"></i>Amélioration
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                <div class="font-medium">Optimisation processus approbation documents</div>
                                <div class="text-gray-500 text-xs mt-1">Identification de goulots d'étranglement</div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                <a href="{{ route('client.processus') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                                    <i class="fa-solid fa-diagram-project mr-1"></i>Processus SMQ
                                </a>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                <span class="font-medium text-green-600">68%</span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Faible
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm font-medium">
                                <button class="btn-primary btn-sm flex items-center open-inline-action" data-type="project">
                                    <i class="fa-solid fa-rocket mr-1"></i>Lancer projet
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Zone inline forms container (réutilisé) -->
                <div id="inlineFormContainer" class="mt-4"></div>
            </div>
        </div>
    </div>

    <!-- Section : Intégration avec les Modules du SMQ (inchangée) -->
    <div class="card">
        <div class="card-header bg-gradient-to-r from-indigo-50 to-purple-50 border-indigo-200 p-4 rounded-t-lg flex items-center gap-2">
            <i class="fa-solid fa-puzzle-piece text-indigo-600 mr-2"></i>
            <h3 class="text-lg font-semibold text-indigo-700">Intégration Complète avec les Modules du SMQ</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Module cards (identiques à ton original) -->
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-all duration-200 bg-white">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-earth-europe text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Contexte de l'Organisation</h4>
                            <p class="text-xs text-gray-500">Modules 4.1, 4.2, 4.3</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">
                        Analyse PESTEL et SWOT automatisée avec détection des tendances émergentes et recommandations stratégiques.
                    </p>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Analyses réalisées:</span>
                            <span class="font-semibold text-blue-600">24</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Recommandations:</span>
                            <span class="font-semibold text-green-600">8</span>
                        </div>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('client.swot') }}" class="btn-primary btn-sm flex-1 text-center">
                            <i class="fa-solid fa-arrow-right mr-1"></i>Accéder
                        </a>
                    </div>
                </div>

                <!-- ... autres modules inchangés (Risques, CAPA, Satisfaction, Audits, Compétences) -->
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-all duration-200 bg-white">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-triangle-exclamation text-red-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Risques & Opportunités</h4>
                            <p class="text-xs text-gray-500">Clause 6.1</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">
                        Prédiction des risques émergents et identification des opportunités basée sur l'analyse des données historiques.
                    </p>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Risques prédits:</span>
                            <span class="font-semibold text-red-600">14</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Opportunités:</span>
                            <span class="font-semibold text-green-600">7</span>
                        </div>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('client.risques') }}" class="btn-primary btn-sm flex-1 text-center">
                            <i class="fa-solid fa-arrow-right mr-1"></i>Accéder
                        </a>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-all duration-200 bg-white">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-bug text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Actions Correctives/Préventives</h4>
                            <p class="text-xs text-gray-500">Clause 10.2</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">
                        Suggestions automatiques d'actions basées sur l'analyse des causes racines et l'historique des NC.
                    </p>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">CAPA suggérés:</span>
                            <span class="font-semibold text-orange-600">9</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Efficacité moyenne:</span>
                            <span class="font-semibold text-green-600">87%</span>
                        </div>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('client.capa') }}" class="btn-primary btn-sm flex-1 text-center">
                            <i class="fa-solid fa-arrow-right mr-1"></i>Accéder
                        </a>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-all duration-200 bg-white">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fa-regular fa-face-smile text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Satisfaction Client</h4>
                            <p class="text-xs text-gray-500">Clause 9.1.2</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">
                        Analyse prédictive de la satisfaction et détection proactive des tendances négatives.
                    </p>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tendances détectées:</span>
                            <span class="font-semibold text-purple-600">5</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Score prédit:</span>
                            <span class="font-semibold text-blue-600">82%</span>
                        </div>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('client.satisfaction') }}" class="btn-primary btn-sm flex-1 text-center">
                            <i class="fa-solid fa-arrow-right mr-1"></i>Accéder
                        </a>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-all duration-200 bg-white">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-shield-check text-orange-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Audits Internes</h4>
                            <p class="text-xs text-gray-500">Clause 9.2</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">
                        Optimisation du planning d'audit basée sur l'analyse des risques et l'historique des constats.
                    </p>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Audits optimisés:</span>
                            <span class="font-semibold text-orange-600">12</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Efficacité:</span>
                            <span class="font-semibold text-green-600">+23%</span>
                        </div>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('client.audits') }}" class="btn-primary btn-sm flex-1 text-center">
                            <i class="fa-solid fa-arrow-right mr-1"></i>Accéder
                        </a>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-all duration-200 bg-white">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-id-badge text-teal-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Compétences & Formation</h4>
                            <p class="text-xs text-gray-500">Clause 7.2</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">
                        Identification proactive des besoins de formation basée sur l'analyse des écarts de compétences.
                    </p>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Besoins identifiés:</span>
                            <span class="font-semibold text-teal-600">8</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">ROI moyen:</span>
                            <span class="font-semibold text-green-600">185%</span>
                        </div>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('client.competences') }}" class="btn-primary btn-sm flex-1 text-center">
                            <i class="fa-solid fa-arrow-right mr-1"></i>Accéder
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Styles (inchangés + quelques classes utilitaires) -->
<style>
.cards-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 1.5rem;
}
@media(min-width: 768px) { .cards-grid { grid-template-columns: repeat(2, 1fr); } }
@media(min-width: 1024px) { .cards-grid { grid-template-columns: repeat(4, 1fr); } }

.card { background: #fff; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: transform 0.2s, box-shadow 0.2s; }
.card:hover { transform: translateY(-4px); box-shadow: 0 8px 20px rgba(0,0,0,0.12); }
.card-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
.card-title { font-size: 0.875rem; font-weight: 500; margin: 0; }
.card-value { font-size: 1.5rem; font-weight: 700; margin-top: 0.25rem; }
.card-icon { width: 3rem; height: 3rem; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 1.25rem; color: white; }
.card-bottom { display: flex; justify-content: space-between; font-size: 0.875rem; font-weight: 500; }

/* Couleurs */
.card-red { background: linear-gradient(135deg, #fee2e2, #fecaca); border: 1px solid #fca5a5; }
.card-red .card-bottom, .card-red .card-title { color: #b91c1c; }
.card-red .card-icon { background: #fca5a5; color: #b91c1c; }

.card-orange { background: linear-gradient(135deg, #fff7ed, #ffedd5); border: 1px solid #fdba74; }
.card-orange .card-bottom, .card-orange .card-title { color: #b45309; }
.card-orange .card-icon { background: #fdba74; color: #b45309; }

.card-green { background: linear-gradient(135deg, #ecfdf5, #d1fae5); border: 1px solid #34d399; }
.card-green .card-bottom, .card-green .card-title { color: #065f46; }
.card-green .card-icon { background: #34d399; color: #065f46; }

.card-blue { background: linear-gradient(135deg, #eff6ff, #dbeafe); border: 1px solid #60a5fa; }
.card-blue .card-bottom, .card-blue .card-title { color: #1e40af; }
.card-blue .card-icon { background: #60a5fa; color: #1e40af; }

/* Buttons utilitaires */
.btn-primary { background:#1f6feb;color:#fff;padding:0.5rem 0.75rem;border-radius:0.5rem;cursor:pointer;display:inline-flex;align-items:center;gap:.5rem;border:0; }
.btn-secondary { background:#eef2ff;color:#111;padding:0.5rem 0.75rem;border-radius:0.5rem;cursor:pointer;display:inline-flex;align-items:center;gap:.5rem;border:1px solid #e6e9f8; }
.btn-sm { padding:0.35rem 0.6rem;font-size:0.85rem;border-radius:0.5rem; }

/* inline form helpers */
.inline-form { display:none; }
.inline-form.active { display:block; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // petites interactions
    document.querySelectorAll('.btn-primary, .btn-secondary').forEach(button => {
        button.addEventListener('click', function(e) {
            // animation visuelle légère
            this.style.transform = 'scale(0.98)';
            setTimeout(()=> this.style.transform = '', 120);
        });
    });

    // Export fictif
    document.getElementById('btnExportReport').addEventListener('click', function(){
        alert('Export rapport (simulation) — implémentez backend pour génération réelle.');
    });

    // Refresh fictif
    document.getElementById('btnRefresh').addEventListener('click', function(){
        alert('Actualisation des analyses (simulation). Données statiques mises à jour localement.');
    });

    // =========================
    // Gestion ajout d'analyse
    // =========================
    const addAnalysisForm = document.getElementById('addAnalysisForm');
    addAnalysisForm.addEventListener('submit', function(e){
        e.preventDefault();
        const process = document.getElementById('analysisProcess').value.trim();
        const severity = document.getElementById('analysisSeverity').value;
        const desc = document.getElementById('analysisDesc').value.trim();
        const prob = parseInt(document.getElementById('analysisProb').value || '0', 10);
        const impact = document.getElementById('analysisImpact').value.trim() || severity;

        if(!process){ alert('Renseignez le processus.'); return; }

        // mettre à jour KPI statique (ex : NC Potentielles +1)
        const ncPotEl = document.getElementById('ncPot');
        ncPotEl.innerText = parseInt(ncPotEl.innerText,10) + 1;

        // message + clear
        const msg = document.getElementById('addAnalysisMessage');
        msg.classList.remove('hidden');
        setTimeout(()=> msg.classList.add('hidden'),2500);
        addAnalysisForm.reset();
    });

    document.getElementById('clearAnalysisForm').addEventListener('click', function(){
        addAnalysisForm.reset();
    });

    // =========================
    // Gestion ajout recommandation
    // =========================
    const addRecForm = document.getElementById('addRecommendationForm');
    addRecForm.addEventListener('submit', function(e){
        e.preventDefault();
        const title = document.getElementById('recTitle').value.trim();
        const priority = document.getElementById('recPriority').value;
        const module = document.getElementById('recModule').value.trim();
        const desc = document.getElementById('recDesc').value.trim();

        if(!title){ alert('Donnez un titre pour la recommandation.'); return; }

        // Ajouter visuellement à la liste des recommandations (en haut)
        const list = document.getElementById('recommendationsList');
        const wrapper = document.createElement('div');
        wrapper.className = 'flex items-start gap-4 p-4 bg-white border border-gray-200 rounded-lg shadow-sm';
        wrapper.innerHTML = `
            <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                <i class="fa-solid fa-lightbulb text-indigo-600"></i>
            </div>
            <div class="flex-1">
                <div class="flex items-center justify-between mb-2">
                    <h4 class="font-semibold text-gray-800">${escapeHtml(title)}</h4>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">${escapeHtml(priority)}</span>
                </div>
                <p class="text-sm text-gray-600 mb-3">${escapeHtml(desc)}</p>
                <div class="flex flex-wrap gap-2">
                    <button class="btn-primary btn-sm flex items-center create-capa-inline" data-title="${escapeHtml(title)}" data-source="IA" data-prob="--" data-impact="${escapeHtml(priority)}">
                        <i class="fa-solid fa-play mr-1"></i>Appliquer la recommandation
                    </button>
                    <button class="btn-secondary btn-sm flex items-center show-analysis" data-analysis="new-${Date.now()}">
                        <i class="fa-solid fa-chart-line mr-1"></i>Voir l'analyse détaillée
                    </button>
                </div>
            </div>
        `;
        list.prepend(wrapper);
        document.getElementById('addRecMessage').classList.remove('hidden');
        setTimeout(()=> document.getElementById('addRecMessage').classList.add('hidden'),2000);
        addRecForm.reset();
    });

    document.getElementById('clearRecForm').addEventListener('click', function(){ addRecForm.reset(); });

    // =========================
    // Inline actions in recommendations & auto actions table
    // =========================
    function hideAllInlineForms(container){
        container.querySelectorAll('.inline-form, .create-capa-form, .training-form, .project-form').forEach(el => el.classList.add('hidden'));
        container.querySelectorAll('.capa-created, .training-saved, .project-started').forEach(el => el.classList.add('hidden'));
    }

    // délégation : ouvrir formulaires inline (create CAPA, plan training, launch project)
    document.body.addEventListener('click', function(e){
        // ouvrir formulaire create-capa-inline
        if(e.target.closest('.create-capa-inline') || e.target.classList.contains('create-capa-inline')){
            const btn = e.target.closest('.create-capa-inline');
            const parent = btn.closest('.flex.items-start, .flex.items-start') || btn.closest('.recommendation') || btn.closest('.space-y-6');
            if(!parent) return;
            const form = parent.querySelector('.create-capa-form');
            if(!form) return;
            // basculer affichage
            const visible = !form.classList.contains('hidden');
            // cacher toutes les autres du document
            document.querySelectorAll('.create-capa-form').forEach(f=> f.classList.add('hidden'));
            if(!visible) form.classList.remove('hidden');
            return;
        }

        // boutton "open-inline-action" du tableau
        if(e.target.closest('.open-inline-action')){
            const btn = e.target.closest('.open-inline-action');
            const type = btn.dataset.type;
            // créer un formulaire inline sous le tableau (container dédié)
            const container = document.getElementById('inlineFormContainer');
            container.innerHTML = ''; // one at a time
            let html = '';
            if(type === 'capa'){
                html = `
                    <div class="border p-4 rounded bg-gray-50">
                        <h5 class="font-semibold mb-2">Créer CAPA (depuis suggestion)</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-2">
                            <input type="text" class="border rounded p-2 capa-nc-inline" placeholder="Référence NC (ex: NC-999)">
                            <input type="text" class="border rounded p-2 capa-resp-inline" placeholder="Responsable">
                        </div>
                        <textarea class="w-full border rounded p-2 capa-action-inline" rows="2" placeholder="Action corrective..."></textarea>
                        <div class="flex items-center gap-2 mt-2">
                            <button class="px-3 py-2 bg-blue-600 text-white rounded create-capa-inline-do">Créer CAPA</button>
                            <button class="px-3 py-2 border rounded cancel-inline">Annuler</button>
                            <div class="text-sm text-green-600 ml-2 create-capa-inline-done hidden">CAPA créé (simulation)</div>
                        </div>
                    </div>`;
            } else if(type === 'plan'){
                html = `
                    <div class="border p-4 rounded bg-gray-50">
                        <h5 class="font-semibold mb-2">Planifier Action Préventive</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-2">
                            <input type="text" class="border rounded p-2 plan-title-inline" placeholder="Titre action">
                            <input type="date" class="border rounded p-2 plan-date-inline">
                        </div>
                        <textarea class="w-full border rounded p-2 plan-desc-inline" rows="2" placeholder="Détails..."></textarea>
                        <div class="flex items-center gap-2 mt-2">
                            <button class="px-3 py-2 bg-green-600 text-white rounded plan-action-inline-do">Planifier</button>
                            <button class="px-3 py-2 border rounded cancel-inline">Annuler</button>
                            <div class="text-sm text-green-600 ml-2 plan-action-inline-done hidden">Action planifiée (simulation)</div>
                        </div>
                    </div>`;
            } else if(type === 'project'){
                html = `
                    <div class="border p-4 rounded bg-gray-50">
                        <h5 class="font-semibold mb-2">Lancer Projet d'Amélioration</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-2">
                            <input type="text" class="border rounded p-2 project-name-inline" placeholder="Nom projet">
                            <input type="date" class="border rounded p-2 project-start-inline">
                        </div>
                        <textarea class="w-full border rounded p-2 project-desc-inline" rows="2" placeholder="Objectifs/ROI"></textarea>
                        <div class="flex items-center gap-2 mt-2">
                            <button class="px-3 py-2 bg-blue-600 text-white rounded start-project-inline-do">Lancer</button>
                            <button class="px-3 py-2 border rounded cancel-inline">Annuler</button>
                            <div class="text-sm text-green-600 ml-2 start-project-inline-done hidden">Projet lancé (simulation)</div>
                        </div>
                    </div>`;
            }
            container.innerHTML = html;
            container.scrollIntoView({behavior:'smooth'});
            return;
        }

        // cancel-inline
        if(e.target.closest('.cancel-inline')){
            const container = document.getElementById('inlineFormContainer');
            container.innerHTML = '';
            return;
        }

        // create-capa-inline-do
        if(e.target.closest('.create-capa-inline-do')){
            const doBtn = e.target.closest('.create-capa-inline-do');
            const container = document.getElementById('inlineFormContainer');
            const ncRef = container.querySelector('.capa-nc-inline').value || 'NC-NEW';
            const resp = container.querySelector('.capa-resp-inline').value || 'Responsable';
            // show done
            const done = container.querySelector('.create-capa-inline-done');
            if(done) { done.classList.remove('hidden'); setTimeout(()=> { container.innerHTML=''; }, 1500); }
            return;
        }

        // plan-action-inline-do
        if(e.target.closest('.plan-action-inline-do')){
            const container = document.getElementById('inlineFormContainer');
            const done = container.querySelector('.plan-action-inline-done');
            if(done) { done.classList.remove('hidden'); setTimeout(()=> { container.innerHTML=''; }, 1200); }
            return;
        }

        // start-project-inline-do
        if(e.target.closest('.start-project-inline-do')){
            const container = document.getElementById('inlineFormContainer');
            const done = container.querySelector('.start-project-inline-done');
            if(done) { done.classList.remove('hidden'); setTimeout(()=> { container.innerHTML=''; }, 1200); }
            return;
        }
    });

    // handlers for inline forms in recommendations (create capa, training, project)
    document.body.addEventListener('click', function(e){
        // create-capa-do inside recommendation
        if(e.target.closest('.create-capa-do')){
            const btn = e.target.closest('.create-capa-do');
            const form = btn.closest('.create-capa-form');
            if(!form) return;
            const nc = form.querySelector('.capa-nc').value || 'NC-NEW';
            const resp = form.querySelector('.capa-resp').value || 'Resp';
            const action = form.querySelector('.capa-action').value || '';
            form.querySelector('.capa-created').classList.remove('hidden');
            setTimeout(()=> { form.classList.add('hidden'); form.querySelector('.capa-created').classList.add('hidden'); }, 1400);
            return;
        }
        if(e.target.closest('.cancel-capa')){
            const form = e.target.closest('.create-capa-form');
            if(form) form.classList.add('hidden');
            return;
        }

        // training plan
        if(e.target.closest('.plan-training-do')){
            const form = e.target.closest('.training-form');
            if(!form) return;
            form.querySelector('.training-saved').classList.remove('hidden');
            setTimeout(()=> { form.classList.add('hidden'); form.querySelector('.training-saved').classList.add('hidden'); }, 1200);
            return;
        }
        if(e.target.closest('.cancel-training')){
            const form = e.target.closest('.training-form');
            if(form) form.classList.add('hidden');
            return;
        }

        // project start
        if(e.target.closest('.start-project-do')){
            const form = e.target.closest('.project-form');
            if(!form) return;
            form.querySelector('.project-started').classList.remove('hidden');
            setTimeout(()=> { form.classList.add('hidden'); form.querySelector('.project-started').classList.add('hidden'); }, 1400);
            return;
        }
        if(e.target.closest('.cancel-project')){
            const form = e.target.closest('.project-form');
            if(form) form.classList.add('hidden');
            return;
        }
    });

    // =========================
    // Utility: escapeHtml for inserting user text safely
    // =========================
    function escapeHtml(unsafe) {
        return unsafe
             .replace(/&/g, "&amp;")
             .replace(/</g, "&lt;")
             .replace(/>/g, "&gt;")
             .replace(/"/g, "&quot;")
             .replace(/'/g, "&#039;");
    }

    // =========================
    // Simulation: show analysis detail alerts
    // =========================
    document.body.addEventListener('click', function(e){
        if(e.target.closest('.show-analysis')){
            alert('Affichage analyse détaillée (simulation). Intégrer panel détaillé ou chart.js si requis).');
        }
    });

    // Petites améliorations UX : focus dans forms
    document.querySelectorAll('.inline-form .capa-nc, .inline-form .project-name, .inline-form .training-title').forEach(inp=>{
        inp && inp.addEventListener('keydown', function(e){
            if(e.key === 'Enter') e.preventDefault();
        });
    });

}); // DOMContentLoaded
</script>
@endsection
