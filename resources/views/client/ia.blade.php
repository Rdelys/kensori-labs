@extends('layouts.clients')

@section('title', 'IA Prédictive')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="space-y-8 fade-in">
    <!-- En-tête de la page -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800"><i class="fa-solid fa-robot text-blue-500 mr-3"></i>IA Prédictive - Tableaux de Bord Intelligents</h1>
            <p class="text-gray-600 mt-2">Analyse prédictive et prescriptions intelligentes pour l'amélioration continue du SMQ</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <button class="btn-primary flex items-center">
                <i class="fa-solid fa-arrows-rotate mr-2"></i>Actualiser les analyses
            </button>
            <button class="btn-secondary flex items-center">
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
                <p class="card-value">14</p>
            </div>
            <div class="card-icon red">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
        </div>
        <div class="card-bottom red">
            <span>Élevé: 6</span>
            <span>Moyen: 5</span>
            <span>Faible: 3</span>
        </div>
    </div>

    <!-- Carte : NC Potentielles -->
    <div class="card card-orange">
        <div class="card-top">
            <div>
                <p class="card-title">NC Potentielles</p>
                <p class="card-value">9</p>
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
                <p class="card-value">7</p>
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
                <p class="card-value">5</p>
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
            <div class="card-header bg-gray-50 border-gray-200">
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
            <div class="card-header bg-purple-50 border-purple-200">
                <i class="fa-regular fa-face-smile text-purple-600 mr-2"></i>
                <h3 class="text-lg font-semibold text-purple-700">Satisfaction Client Prédictive</h3>
            </div>
            <div class="p-6">
                <div class="text-center mb-6">
                    <div class="text-4xl font-bold text-purple-700">82%</div>
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
            </div>
        </div>
    </div>

    <!-- Section : Recommandations Intelligentes -->
    <div class="card">
        <div class="card-header bg-gradient-to-r from-purple-50 to-indigo-50 border-purple-200">
            <i class="fa-solid fa-lightbulb text-purple-600 mr-2"></i>
            <h3 class="text-lg font-semibold text-purple-700">Recommandations Intelligentes de l'IA</h3>
        </div>
        <div class="p-6">
            <div class="space-y-6">
                <!-- Recommandation 1 -->
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
                            L'IA détecte une augmentation de 85% de la probabilité de non-conformités dans le processus de production 
                            suite à l'analyse des données de maintenance préventive et des indicateurs de performance.
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
                            <button class="btn-primary btn-sm flex items-center">
                                <i class="fa-solid fa-play mr-1"></i>Appliquer la recommandation
                            </button>
                            <button class="btn-secondary btn-sm flex items-center">
                                <i class="fa-solid fa-chart-line mr-1"></i>Voir l'analyse détaillée
                            </button>
                            <button class="btn-secondary btn-sm flex items-center">
                                <i class="fa-solid fa-clock mr-1"></i>Planifier pour plus tard
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Recommandation 2 -->
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
                            Analyse des compétences et des résultats d'audit indique un besoin de formation sur les nouvelles 
                            exigences réglementaires. L'IA recommande un programme de formation ciblé avec un ROI estimé à 215%.
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
                            <button class="btn-primary btn-sm flex items-center">
                                <i class="fa-solid fa-play mr-1"></i>Appliquer la recommandation
                            </button>
                            <button class="btn-secondary btn-sm flex items-center">
                                <i class="fa-solid fa-chart-line mr-1"></i>Voir l'analyse détaillée
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Recommandation 3 -->
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
                            L'analyse des données de processus identifie une opportunité d'optimisation dans le circuit d'approbation 
                            des documents. Automatisation possible avec gain de temps estimé à 12 heures/semaine.
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
                            <button class="btn-primary btn-sm flex items-center">
                                <i class="fa-solid fa-play mr-1"></i>Appliquer la recommandation
                            </button>
                            <button class="btn-secondary btn-sm flex items-center">
                                <i class="fa-solid fa-calculator mr-1"></i>Calculer le ROI
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section : Actions Correctives Auto-suggérées -->
    <div class="card">
        <div class="card-header bg-gradient-to-r from-orange-50 to-amber-50 border-orange-200">
            <i class="fa-solid fa-wand-magic-sparkles text-orange-600 mr-2"></i>
            <h3 class="text-lg font-semibold text-orange-700">Actions Correctives et Préventives Auto-suggérées</h3>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full min-w-full">
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
                    <tbody class="bg-white divide-y divide-gray-200">
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
                                <button class="btn-primary btn-sm flex items-center">
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
                                <button class="btn-primary btn-sm flex items-center">
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
                                <button class="btn-primary btn-sm flex items-center">
                                    <i class="fa-solid fa-rocket mr-1"></i>Lancer projet
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Section : Intégration avec les Modules du SMQ -->
    <div class="card">
        <div class="card-header bg-gradient-to-r from-indigo-50 to-purple-50 border-indigo-200">
            <i class="fa-solid fa-puzzle-piece text-indigo-600 mr-2"></i>
            <h3 class="text-lg font-semibold text-indigo-700">Intégration Complète avec les Modules du SMQ</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Module Contexte -->
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

                <!-- Module Risques & Opportunités -->
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

                <!-- Module CAPA -->
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

                <!-- Module Satisfaction Client -->
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

                <!-- Module Audits -->
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

                <!-- Module Compétences -->
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

<style>
.cards-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 1.5rem;
}

@media(min-width: 768px) {
    .cards-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media(min-width: 1024px) {
    .cards-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

.card {
    background: #fff;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
}

.card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.card-title {
    font-size: 0.875rem;
    font-weight: 500;
    margin: 0;
}

.card-value {
    font-size: 1.5rem;
    font-weight: 700;
    margin-top: 0.25rem;
}

.card-icon {
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.25rem;
    color: white;
}

.card-bottom {
    display: flex;
    justify-content: space-between;
    font-size: 0.875rem;
    font-weight: 500;
}

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

</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cartes au chargement
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });

    // Gestion des interactions des boutons
    const buttons = document.querySelectorAll('.btn-primary, .btn-secondary');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
});
</script>
@endsection