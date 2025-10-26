@extends('layouts.clients')

@section('title', 'Documentation Qualité')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body {
        background: #f8fafc;
    }


    .card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        padding: 1.8rem;
        transition: all 0.3s ease;
    }
    .card:hover { transform: translateY(-3px); }

    h1, h2 {
        letter-spacing: 0.3px;
    }

    table th {
        font-weight: 600;
        color: #374151;
    }

    .btn-main {
        background: #2563eb;
        color: #fff;
        padding: 10px 18px;
        border-radius: 10px;
        font-weight: 600;
        box-shadow: 0 3px 10px rgba(37, 99, 235, 0.3);
        transition: 0.25s;
    }
    .btn-main:hover {
        background: #1d4ed8;
        transform: translateY(-2px);
    }

    canvas {
        max-width: 100%;
        height: 180px !important;
        margin: auto;
        display: block;
    }

    .section-header {
        font-size: 1.35rem;
        font-weight: 700;
        color: #1e3a8a;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 1rem;
    }

    .info-box {
        background: linear-gradient(to right, #eff6ff, #ffffff);
        border: 1px solid #dbeafe;
        border-radius: 14px;
        padding: 1rem 1.5rem;
        color: #374151;
        font-size: 0.9rem;
    }

    .highlight {
        background-color: #2563eb;
        color: white;
        padding: 0.2rem 0.6rem;
        border-radius: 6px;
        font-size: 0.75rem;
    }
</style>

<div class="space-y-10 fade-in">

    <!-- ======== En-tête ======== -->
    <div class="flex items-center justify-between border-b pb-4">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-folder-open text-blue-600"></i> Documentation Qualité
        </h1>
        <button class="btn-main flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Nouveau Document
        </button>
    </div>

    <!-- ======== Recherche et Filtres ======== -->
    <div class="card bg-gradient-to-r from-blue-50 to-blue-100 shadow">
        <h2 class="section-header"><i class="fa-solid fa-magnifying-glass"></i> Recherche et Filtres avancés</h2>
        <form class="grid grid-cols-1 md:grid-cols-4 gap-3">
            <input type="text" placeholder="Nom du document" class="p-2 border rounded-lg">
            <select class="p-2 border rounded-lg">
                <option value="">Type</option>
                <option>Procédure</option>
                <option>Instruction</option>
                <option>Fiche</option>
                <option>Manuel</option>
            </select>
            <select class="p-2 border rounded-lg">
                <option value="">Statut</option>
                <option>Brouillon</option>
                <option>En révision</option>
                <option>Approuvé</option>
                <option>Archivé</option>
            </select>
            <button class="btn-main">Rechercher</button>
        </form>
    </div>

    <!-- ======== Registre des documents ======== -->
    <div class="card">
        <h2 class="section-header"><i class="fa-solid fa-table text-blue-600"></i> Registre des Documents</h2>
        <span class="text-sm text-gray-500 mb-3 block">Contrôle des versions et traçabilité complète</span>

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
    <div class="card bg-gray-50">
        <h2 class="section-header"><i class="fa-solid fa-code-branch text-blue-600"></i> Gestion des versions & Workflows</h2>
        <div class="grid md:grid-cols-2 gap-6 text-gray-700">
            <ul class="list-disc pl-6 space-y-1">
                <li><strong>Cycle documentaire :</strong> Brouillon → Révision → Approbation → Publication → Archivage.</li>
                <li>Historique automatique des modifications (auteur, date, commentaire).</li>
                <li>Archivage automatique après publication d’une nouvelle version.</li>
                <li>Notifications automatiques aux approbateurs et utilisateurs concernés.</li>
            </ul>
            <ul class="list-disc pl-6 space-y-1">
                <li>Workflow personnalisable selon le type de document.</li>
                <li>Gestion des droits d’accès par rôle.</li>
                <li>Recherche par métadonnées, date, statut, clause ISO, ou responsable.</li>
            </ul>
        </div>
    </div>

    <!-- ======== Manuel de Qualité ======== -->
    <div class="card">
        <h2 class="section-header"><i class="fa-solid fa-book text-blue-600"></i> Manuel de Qualité</h2>
        <p class="text-gray-700 leading-relaxed mb-3">
            Le Manuel de Qualité présente la politique qualité, les objectifs stratégiques et la structure du SMQ.
            Il garantit la conformité à la norme ISO 9001:2015 et sert de référence à tous les processus.
        </p>
        <a href="#" class="btn-main inline-block"><i class="fa-solid fa-download mr-2"></i> Télécharger le Manuel</a>
    </div>

    <!-- ======== Fiches Processus avec Modal ======== -->
    <div class="card bg-gray-100">
        <h2 class="section-header"><i class="fa-solid fa-diagram-project text-blue-600"></i> Fiches Processus (ISO 9001 - Clause 4.4)</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach (['Achats' => 'Suivi des fournisseurs, validation et contrôle qualité.',
                        'Production' => 'Gestion des opérations et suivi de la performance.',
                        'Qualité' => 'Évaluations, audits internes et amélioration continue.'] as $titre => $desc)
            <div class="bg-white p-5 rounded-lg shadow hover:shadow-md transition">
                <h3 class="font-semibold text-gray-800 mb-2">{{ $titre }}</h3>
                <p class="text-sm text-gray-600">{{ $desc }}</p>
                <button class="btn-main mt-3 text-sm px-3 py-1.5 open-modal" data-title="{{ $titre }}">
                    <i class="fa-solid fa-pen-to-square mr-1"></i> Remplir la fiche
                </button>
            </div>
            @endforeach
        </div>
    </div>

    <!-- ======== Modal ======== -->
    <div id="ficheModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-lg p-6 relative">
            <button id="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
            <h3 class="text-xl font-semibold mb-4" id="modalTitle">Remplir la fiche</h3>
            <form id="ficheForm" class="space-y-4">
                <div>
                    <label for="responsable" class="block text-sm font-medium text-gray-700">Responsable</label>
                    <input type="text" id="responsable" name="responsable" class="w-full p-2 border rounded-lg" required>
                </div>
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" id="date" name="date" class="w-full p-2 border rounded-lg" required>
                </div>
                <div>
                    <label for="commentaire" class="block text-sm font-medium text-gray-700">Commentaire</label>
                    <textarea id="commentaire" name="commentaire" rows="4" class="w-full p-2 border rounded-lg" placeholder="Ajouter un commentaire"></textarea>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn-main px-4 py-2">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ======== Indexation / Recherche Full-Text ======== -->
    <div class="card">
        <h2 class="section-header"><i class="fa-solid fa-database text-blue-600"></i> Indexation & Recherche Full-Text</h2>
        <p class="text-gray-700 mb-3">Moteur de recherche indexé pour retrouver instantanément tout document selon son contenu, ses métadonnées ou son historique de version.</p>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <input type="text" placeholder="🔍 Rechercher un mot-clé dans les documents..." class="w-full p-2 border rounded-lg mb-3">
                <ul class="list-disc pl-6 text-sm text-gray-600 space-y-1">
                    <li>Indexation automatique à chaque mise à jour</li>
                    <li>Recherche plein texte dans le contenu PDF, DOCX et formulaires</li>
                    <li>Filtres avancés par date, auteur, statut et clause ISO</li>
                </ul>
            </div>
            <div class="flex items-center justify-center">
                <canvas id="rechercheChart"></canvas>
            </div>
        </div>
    </div>

    <!-- ======== Accusé de Lecture ======== -->
    <div class="card bg-gray-50">
        <h2 class="section-header"><i class="fa-solid fa-envelope-open-text text-blue-600"></i> Accusé de Lecture des Documents</h2>
        <p class="text-gray-700 mb-3">Suivi des lectures et confirmations de prise de connaissance des documents qualité.</p>

        <table class="w-full text-sm border-collapse mb-6">
            <thead class="bg-blue-50 text-gray-700">
                <tr>
                    <th class="p-3 text-left">Utilisateur</th>
                    <th class="p-3 text-left">Document</th>
                    <th class="p-3 text-left">Date de lecture</th>
                    <th class="p-3 text-left">Statut</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">Jean Dupont</td>
                    <td class="p-3">Manuel Qualité</td>
                    <td class="p-3">22/10/2025</td>
                    <td class="p-3 text-green-600 font-semibold">Lu</td>
                </tr>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">Sophie Martin</td>
                    <td class="p-3">Procédure Contrôle Versions</td>
                    <td class="p-3">—</td>
                    <td class="p-3 text-red-500 font-semibold">Non lu</td>
                </tr>
            </tbody>
        </table>

        <div class="grid md:grid-cols-2 gap-6 items-center">
            <div class="flex justify-center"><canvas id="lectureChart"></canvas></div>
            <div class="info-box">
                <ul class="list-disc pl-5 space-y-1">
                    <li>Accusé de lecture obligatoire pour chaque employé.</li>
                    <li>Suivi automatisé avec rappels e-mail aux retardataires.</li>
                    <li>Indicateurs de taux de lecture par service.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    // Graphique recherche full-text
    new Chart(document.getElementById('rechercheChart'), {
        type: 'bar',
        data: {
            labels: ['Docs trouvés', 'Temps moyen (ms)', 'Pertinence (%)'],
            datasets: [{
                label: 'Performance',
                data: [42, 180, 92],
                backgroundColor: ['#2563eb', '#10b981', '#f59e0b'],
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Graphique accusé de lecture
    new Chart(document.getElementById('lectureChart'), {
        type: 'doughnut',
        data: {
            labels: ['Lu', 'Non lu'],
            datasets: [{
                data: [75, 25],
                backgroundColor: ['#10b981', '#ef4444']
            }]
        },
        options: {
            cutout: '72%',
            plugins: {
                legend: { position: 'bottom' },
                title: { display: false }
            }
        }
    });

     // Gestion ouverture et fermeture du modal
    const modal = document.getElementById('ficheModal');
    const modalTitle = document.getElementById('modalTitle');
    const openButtons = document.querySelectorAll('.open-modal');
    const closeModal = document.getElementById('closeModal');

    openButtons.forEach(button => {
        button.addEventListener('click', () => {
            const titre = button.getAttribute('data-title');
            modalTitle.textContent = `Remplir la fiche : ${titre}`;
            modal.classList.remove('hidden');
        });
    });

    closeModal.addEventListener('click', () => modal.classList.add('hidden'));
    modal.addEventListener('click', e => {
        if (e.target === modal) modal.classList.add('hidden');
    });

    // Soumission du formulaire (exemple)
    const ficheForm = document.getElementById('ficheForm');
    ficheForm.addEventListener('submit', e => {
        e.preventDefault();
        alert('Fiche enregistrée !'); // Remplacer par votre traitement réel
        modal.classList.add('hidden');
        ficheForm.reset();
    });
</script>
@endsection
