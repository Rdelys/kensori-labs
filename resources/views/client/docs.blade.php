@extends('layouts.clients')

@section('title', 'Documentation Qualité')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="space-y-10 fade-in">

    <!-- ======== En-tête ======== -->
    <div class="flex items-center justify-between border-b pb-4">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-folder-open text-blue-600"></i>
            Documentation Qualité
        </h1>
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Nouveau Document
        </button>
    </div>

    <!-- ======== Recherche et Filtres ======== -->
    <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-5 rounded-xl shadow">
        <h2 class="text-lg font-semibold mb-3 flex items-center gap-2 text-gray-700">
            <i class="fa-solid fa-magnifying-glass"></i> Recherche et Filtres avancés
        </h2>
        <form class="grid grid-cols-1 md:grid-cols-4 gap-3">
            <input type="text" placeholder="Nom du document" class="p-2 border rounded">
            <select class="p-2 border rounded">
                <option value="">Type</option>
                <option>Procédure</option>
                <option>Instruction</option>
                <option>Fiche</option>
                <option>Manuel</option>
            </select>
            <select class="p-2 border rounded">
                <option value="">Statut</option>
                <option>Brouillon</option>
                <option>En révision</option>
                <option>Approuvé</option>
                <option>Archivé</option>
            </select>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Rechercher</button>
        </form>
    </div>

    <!-- ======== Tableau principal ======== -->
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="flex items-center justify-between p-4 border-b bg-gray-50">
            <h2 class="text-xl font-semibold flex items-center gap-2">
                <i class="fa-solid fa-table text-blue-600"></i> Registre des Documents
            </h2>
            <span class="text-sm text-gray-500">Contrôle des versions et traçabilité complète</span>
        </div>
        <table class="w-full border-collapse">
            <thead class="bg-blue-50 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="p-3 text-left">Nom</th>
                    <th class="p-3 text-left">Type</th>
                    <th class="p-3 text-left">Version</th>
                    <th class="p-3 text-left">Auteur</th>
                    <th class="p-3 text-left">Approbateur</th>
                    <th class="p-3 text-left">Statut</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3">Manuel Qualité</td>
                    <td class="p-3">Manuel</td>
                    <td class="p-3">V2.1</td>
                    <td class="p-3">J. Dupont</td>
                    <td class="p-3">D. Martin</td>
                    <td class="p-3"><span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Approuvé</span></td>
                    <td class="p-3 text-center space-x-2">
                        <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-eye"></i></button>
                        <button class="text-yellow-500 hover:text-yellow-700"><i class="fa-solid fa-clock-rotate-left"></i></button>
                        <button class="text-red-600 hover:text-red-800"><i class="fa-solid fa-archive"></i></button>
                    </td>
                </tr>
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3">Procédure Gestion Versions</td>
                    <td class="p-3">Procédure</td>
                    <td class="p-3">V1.3</td>
                    <td class="p-3">A. Leroy</td>
                    <td class="p-3">S. Petit</td>
                    <td class="p-3"><span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full">En révision</span></td>
                    <td class="p-3 text-center space-x-2">
                        <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-eye"></i></button>
                        <button class="text-green-600 hover:text-green-800"><i class="fa-solid fa-pen"></i></button>
                        <button class="text-red-600 hover:text-red-800"><i class="fa-solid fa-archive"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- ======== Gestion des versions ======== -->
    <div class="bg-gray-50 p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-3 flex items-center gap-2">
            <i class="fa-solid fa-code-branch text-blue-600"></i> Gestion des versions & Workflows
        </h2>
        <div class="grid md:grid-cols-2 gap-5 text-gray-700">
            <ul class="list-disc pl-6 space-y-1">
                <li><strong>Cycle documentaire :</strong> Brouillon → Révision → Approbation → Publication → Archivage.</li>
                <li>Historique automatique des modifications (auteur, date, commentaire).</li>
                <li>Archivage automatique après publication d’une nouvelle version.</li>
                <li>Notifications automatiques aux approbateurs et utilisateurs concernés.</li>
            </ul>
            <ul class="list-disc pl-6 space-y-1">
                <li>Workflow personnalisable selon le type de document.</li>
                <li>Gestion des droits d’accès par rôle : auteur, réviseur, approbateur, lecteur.</li>
                <li>Recherche par métadonnées, date, statut, clause ISO, ou responsable.</li>
            </ul>
        </div>
    </div>

    <!-- ======== Manuel de Qualité ======== -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-3 flex items-center gap-2">
            <i class="fa-solid fa-book text-blue-600"></i> Manuel de Qualité
        </h2>
        <p class="text-gray-700 leading-relaxed mb-3">
            Le Manuel de Qualité présente la politique qualité, les objectifs stratégiques et la structure du SMQ.
            Il garantit la conformité à la norme ISO 9001:2015 et sert de référence à tous les processus.
        </p>
        <a href="#" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            <i class="fa-solid fa-download mr-2"></i> Télécharger le Manuel
        </a>
    </div>

    <!-- ======== Fiches Processus ======== -->
    <div class="bg-gray-100 p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-diagram-project text-blue-600"></i> Fiches Processus (ISO 9001 - Clause 4.4)
        </h2>
        <div class="grid md:grid-cols-3 gap-5">
            @foreach (['Achats' => 'Suivi des fournisseurs, validation et contrôle qualité.',
                        'Production' => 'Gestion des opérations et suivi de la performance.',
                        'Qualité' => 'Évaluations, audits internes et amélioration continue.'] as $titre => $desc)
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transition">
                <h3 class="font-semibold text-gray-800 mb-2">{{ $titre }}</h3>
                <p class="text-sm text-gray-600">{{ $desc }}</p>
                <button class="mt-3 bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-blue-700">
                    <i class="fa-solid fa-pen-to-square mr-1"></i> Remplir la fiche
                </button>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
