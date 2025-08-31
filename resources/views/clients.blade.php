<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Tableau de bord</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background: #f5f7fb;
      display: flex;
      min-height: 100vh;
    }

    .sidebar {
      width: 280px;
      background-color: #e9f0f8;
      padding: 30px 20px;
      border-right: 1px solid #d6e0ec;
    }

    .sidebar h5 {
      font-weight: 600;
      margin-bottom: 20px;
      color: #1d3557;
    }

    .sidebar p, .sidebar strong {
      color: #3c4a60;
      font-size: 14px;
    }

    .sidebar hr {
      margin: 20px 0;
      border-color: #cdd7e1;
    }

    .sidebar a.btn, .sidebar .nav-link {
      font-size: 14px;
      border-radius: 8px;
      padding: 10px 15px;
      display: block;
      margin-bottom: 8px;
      color: #1d3557;
      text-decoration: none;
      transition: background 0.2s ease;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      background-color: #1d3557;
      color: white;
    }

    .content {
      flex: 1;
      padding: 40px;
    }

    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      background: white;
    }

    h2 {
      font-weight: 600;
      color: #2b2d42;
      margin-bottom: 30px;
    }

    .info-text {
      font-size: 15px;
      color: #5e6c84;
    }

    .d-none {
      display: none !important;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <h5>Bienvenue, {{ $user->name }}</h5>
    <p>Entreprise : <strong>{{ $user->client->company ?? 'Inconnue' }}</strong></p>
    <hr>

    <a href="#" class="nav-link active" data-target="dashboard"><i class="bi bi-house-door me-2"></i>Tableau de bord</a>

    <hr class="my-3">
    <p class="text-muted small mb-1">Modules QMS</p>
    <a href="#" class="nav-link" data-target="module-parties"><i class="bi bi-people me-2"></i>Parties intéressées</a>
    <a href="#" class="nav-link" data-target="module-swot"><i class="bi bi-bar-chart-line me-2"></i>Analyse SWOT / PESTEL</a>
    <a href="#" class="nav-link" data-target="module-politique"><i class="bi bi-award me-2"></i>Politique Qualité</a>
    <a href="#" class="nav-link" data-target="module-raci"><i class="bi bi-diagram-3 me-2"></i>Matrice RACI</a>
    <a href="#" class="nav-link" data-target="module-risques"><i class="bi bi-exclamation-triangle me-2"></i>Risques & Opportunités</a>
    <a href="#" class="nav-link" data-target="module-objectifs"><i class="bi bi-bullseye me-2"></i>Objectifs Qualité</a>
    <a href="#" class="nav-link" data-target="module-docs"><i class="bi bi-file-earmark-text me-2"></i>Documents & Versions</a>
    <a href="#" class="nav-link" data-target="module-equipements"><i class="bi bi-gear-wide-connected me-2"></i>Équipements & Maintenance</a>
    <a href="#" class="nav-link" data-target="module-audits"><i class="bi bi-shield-check me-2"></i>Audits internes</a>
    <a href="#" class="nav-link" data-target="module-capa"><i class="bi bi-lightbulb me-2"></i>CAPA / Non-conformités</a>
    <a href="#" class="nav-link" data-target="module-ia"><i class="bi bi-cpu me-2"></i>Analyse prédictive</a>

    <hr class="my-3">
    <a href="{{ route('user.logout') }}" class="btn btn-sm btn-outline-danger mt-2 w-100">
      <i class="bi bi-box-arrow-right me-1"></i> Se déconnecter
    </a>
  </div>

  <div class="content">
    {{-- Tableau de bord principal --}}
    <div id="dashboard" class="content-section">
      <h2>Tableau de bord Qualité</h2>
      <div class="row g-4">
        @php
          $modules = [
            ['name' => 'Contexte & Parties Intéressées', 'status' => 'Terminé', 'status_color' => 'success', 'desc' => '5 enjeux internes ajoutés. 3 analyses SWOT disponibles.'],
            ['name' => 'Leadership & Gouvernance', 'status' => 'En cours', 'status_color' => 'warning', 'desc' => '1 politique à relire. 2 fiches de poste manquantes.'],
            ['name' => 'Planification & Risques', 'status' => 'À faire', 'status_color' => 'secondary', 'desc' => 'Aucun objectif qualité défini.'],
            ['name' => 'Soutien & Ressources', 'status' => 'En cours', 'status_color' => 'info', 'desc' => '3 formations en attente. 1 étalonnage prévu.'],
            ['name' => 'Opérations & Audits', 'status' => 'Terminé', 'status_color' => 'success', 'desc' => '4 audits réalisés. Aucun écart détecté.'],
            ['name' => 'Amélioration & IA', 'status' => 'À faire', 'status_color' => 'secondary', 'desc' => 'Aucune non-conformité enregistrée.']
          ];
        @endphp

        @foreach ($modules as $module)
        <div class="col-md-6 col-lg-4">
          <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <h6 class="mb-0">{{ $module['name'] }}</h6>
              <span class="badge bg-{{ $module['status_color'] }}">{{ $module['status'] }}</span>
            </div>
            <p class="info-text">{{ $module['desc'] }}</p>
            <a href="#" class="btn btn-sm btn-outline-primary mt-2">
              <i class="bi bi-box-arrow-up-right me-1"></i> Voir le module
            </a>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    {{-- Sections par module (exemples à adapter) --}}
    <div id="module-parties" class="content-section d-none">
  <h2 class="mb-4">Parties intéressées</h2>
  <p class="info-text mb-4">Identification des principales parties prenantes, leur rôle, leur influence et impact sur le système de management de la qualité (QMS).</p>

  <!-- Tableau des parties prenantes -->
  <div class="card p-4 mb-5">
    <h5 class="mb-3">Tableau des parties prenantes</h5>
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Partie prenante</th>
            <th>Rôle</th>
            <th>Influence</th>
            <th>Impact</th>
            <th>Attentes principales</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><i class="bi bi-people me-2 text-primary"></i> Clients</td>
            <td>Destinataires des produits/services</td>
            <td><span class="badge bg-success">Élevée</span></td>
            <td><span class="badge bg-success">Élevé</span></td>
            <td>Qualité, fiabilité, conformité aux besoins</td>
          </tr>
          <tr>
            <td><i class="bi bi-truck me-2 text-warning"></i> Fournisseurs</td>
            <td>Apportent les ressources et intrants</td>
            <td><span class="badge bg-warning text-dark">Moyenne</span></td>
            <td><span class="badge bg-success">Élevé</span></td>
            <td>Stabilité des relations, délais respectés</td>
          </tr>
          <tr>
            <td><i class="bi bi-bank me-2 text-danger"></i> Autorités</td>
            <td>Régulateurs et organismes de contrôle</td>
            <td><span class="badge bg-danger">Très élevée</span></td>
            <td><span class="badge bg-danger">Très élevé</span></td>
            <td>Respect des normes et réglementations</td>
          </tr>
          <tr>
            <td><i class="bi bi-person-badge me-2 text-info"></i> Employés</td>
            <td>Acteurs du système qualité</td>
            <td><span class="badge bg-warning text-dark">Moyenne</span></td>
            <td><span class="badge bg-success">Élevé</span></td>
            <td>Clarté des rôles, formations, sécurité</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Graphique Influence vs Impact -->
  <div class="card p-4">
    <h5 class="mb-3">Matrice Influence / Impact</h5>
    <canvas id="partiesChart" height="300"></canvas>
  </div>
</div>

   <div id="module-swot" class="content-section d-none">
  <h2 class="mb-4">Analyse SWOT / PESTEL</h2>
  <p class="info-text mb-4">
    Complétez votre analyse en ajoutant les forces, faiblesses, opportunités et menaces, ainsi que l’évaluation PESTEL.
  </p>

  <!-- Tableau SWOT statique -->
  <div class="row g-4 mb-5">
    <div class="col-md-6">
      <div class="card p-4 h-100">
        <h5 class="text-success"><i class="bi bi-check2-circle me-2"></i>Forces</h5>
        <ul id="swot-forces" class="mb-3">
          <li>Réputation solide</li>
          <li>Équipe expérimentée</li>
        </ul>
        <!-- Formulaire ajout Force -->
        <form class="d-flex">
          <input type="text" class="form-control form-control-sm me-2" placeholder="Ajouter une force...">
          <button type="button" class="btn btn-sm btn-success"><i class="bi bi-plus-circle"></i></button>
        </form>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-4 h-100">
        <h5 class="text-danger"><i class="bi bi-x-circle me-2"></i>Faiblesses</h5>
        <ul id="swot-faiblesses" class="mb-3">
          <li>Dépendance fournisseurs clés</li>
        </ul>
        <form class="d-flex">
          <input type="text" class="form-control form-control-sm me-2" placeholder="Ajouter une faiblesse...">
          <button type="button" class="btn btn-sm btn-danger"><i class="bi bi-plus-circle"></i></button>
        </form>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-4 h-100">
        <h5 class="text-primary"><i class="bi bi-lightbulb me-2"></i>Opportunités</h5>
        <ul id="swot-opportunites" class="mb-3">
          <li>Digitalisation du secteur</li>
        </ul>
        <form class="d-flex">
          <input type="text" class="form-control form-control-sm me-2" placeholder="Ajouter une opportunité...">
          <button type="button" class="btn btn-sm btn-primary"><i class="bi bi-plus-circle"></i></button>
        </form>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-4 h-100">
        <h5 class="text-warning"><i class="bi bi-exclamation-triangle me-2"></i>Menaces</h5>
        <ul id="swot-menaces" class="mb-3">
          <li>Pression concurrentielle</li>
        </ul>
        <form class="d-flex">
          <input type="text" class="form-control form-control-sm me-2" placeholder="Ajouter une menace...">
          <button type="button" class="btn btn-sm btn-warning"><i class="bi bi-plus-circle"></i></button>
        </form>
      </div>
    </div>
  </div>

  <!-- Formulaire PESTEL -->
  <div class="card p-4 mb-4">
    <h5 class="mb-3"><i class="bi bi-bar-chart-line me-2"></i> Analyse PESTEL</h5>
    <p class="info-text">Évaluez l’influence de chaque facteur sur une échelle de 0 à 10.</p>

    <form>
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Politique</label>
          <input type="number" class="form-control" min="0" max="10" value="7">
        </div>
        <div class="col-md-4">
          <label class="form-label">Économique</label>
          <input type="number" class="form-control" min="0" max="10" value="8">
        </div>
        <div class="col-md-4">
          <label class="form-label">Socioculturel</label>
          <input type="number" class="form-control" min="0" max="10" value="6">
        </div>
        <div class="col-md-4">
          <label class="form-label">Technologique</label>
          <input type="number" class="form-control" min="0" max="10" value="9">
        </div>
        <div class="col-md-4">
          <label class="form-label">Environnemental</label>
          <input type="number" class="form-control" min="0" max="10" value="5">
        </div>
        <div class="col-md-4">
          <label class="form-label">Légal</label>
          <input type="number" class="form-control" min="0" max="10" value="8">
        </div>
      </div>
      <button type="button" class="btn btn-primary mt-3">
        <i class="bi bi-graph-up"></i> Mettre à jour le graphique
      </button>
    </form>

    <canvas id="pestelChart" class="mt-4" height="300"></canvas>
  </div>
</div>

    <div id="module-politique" class="content-section d-none">
  <h2 class="mb-4">Politique Qualité</h2>
  <p class="info-text mb-4">Déclaration officielle de l’entreprise concernant son engagement envers la qualité, la satisfaction client et l’amélioration continue.</p>

  <!-- Carte affichage politique actuelle -->
  <div class="card p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5><i class="bi bi-award me-2 text-primary"></i> Politique Qualité actuelle</h5>
      <span class="badge bg-info">Version 1.2 – 15/08/2023</span>
    </div>
    <p class="mb-2">
      Notre entreprise s’engage à fournir des produits et services conformes aux exigences clients et réglementaires, 
      à améliorer continuellement l’efficacité de notre système de management de la qualité (SMQ), 
      et à favoriser le développement des compétences de nos collaborateurs.
    </p>
    <p class="text-muted small mb-0">Validée par la Direction Générale</p>
  </div>

  <!-- Indicateur de diffusion -->
  <div class="card p-4 mb-4">
    <h5 class="mb-3"><i class="bi bi-people me-2 text-secondary"></i> Diffusion de la politique qualité</h5>
    <p class="info-text">Pourcentage d’employés ayant lu et validé la politique.</p>
    
    <!-- Progress bar -->
    <div class="mb-3">
      <div class="d-flex justify-content-between">
        <span>Statut de diffusion</span>
        <span><strong>78%</strong></span>
      </div>
      <div class="progress" style="height: 20px;">
        <div class="progress-bar bg-success" role="progressbar" style="width: 78%;" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
    </div>

    <!-- Graphique Chart.js -->
    <canvas id="politiqueChart" height="120"></canvas>
  </div>

  <!-- Historique des versions -->
  <div class="card p-4 mb-4">
    <h5 class="mb-3"><i class="bi bi-clock-history me-2 text-secondary"></i> Historique des versions</h5>
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><strong>v1.2</strong> – 15/08/2023 : Mise à jour des engagements environnementaux</li>
      <li class="list-group-item"><strong>v1.1</strong> – 10/03/2022 : Ajout de l’objectif satisfaction client</li>
      <li class="list-group-item"><strong>v1.0</strong> – 01/01/2021 : Première publication officielle</li>
    </ul>
  </div>

  <!-- Formulaire de soumission nouvelle politique -->
  <div class="card p-4">
    <h5 class="mb-3"><i class="bi bi-pencil-square me-2 text-success"></i> Proposer une nouvelle version</h5>
    <form>
      <div class="mb-3">
        <label class="form-label">Texte de la politique qualité</label>
        <textarea class="form-control" rows="5" placeholder="Saisir la nouvelle politique qualité..."></textarea>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Numéro de version</label>
          <input type="text" class="form-control" placeholder="Ex : 1.3">
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Date de révision</label>
          <input type="date" class="form-control">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">
        <i class="bi bi-upload me-2"></i> Soumettre pour validation
      </button>
    </form>
  </div>
</div>

    <div id="module-raci" class="content-section d-none">
  <h2>Matrice RACI</h2>
  <p>Structure des rôles et responsabilités pour chaque processus.</p>

  <!-- Tableau RACI -->
  <div class="card p-4 mb-4">
    <h6 class="mb-3">Exemple de Matrice RACI</h6>
    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead class="table-light">
          <tr>
            <th>Processus</th>
            <th>Responsable (R)</th>
            <th>Approbateur (A)</th>
            <th>Consulté (C)</th>
            <th>Informé (I)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Gestion documentaire</td>
            <td>Responsable Qualité</td>
            <td>Direction</td>
            <td>Équipe Projet</td>
            <td>Tous employés</td>
          </tr>
          <tr>
            <td>Audit interne</td>
            <td>Auditeur</td>
            <td>Direction</td>
            <td>Service Qualité</td>
            <td>Collaborateurs</td>
          </tr>
          <tr>
            <td>Formation</td>
            <td>RH</td>
            <td>Direction</td>
            <td>Manager</td>
            <td>Employés</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Formulaire d'ajout -->
  <div class="card p-4 mb-4">
    <h6 class="mb-3">Ajouter un nouveau processus</h6>
    <form>
      <div class="row g-3">
        <div class="col-md-4">
          <input type="text" class="form-control" placeholder="Nom du processus">
        </div>
        <div class="col-md-2">
          <input type="text" class="form-control" placeholder="R">
        </div>
        <div class="col-md-2">
          <input type="text" class="form-control" placeholder="A">
        </div>
        <div class="col-md-2">
          <input type="text" class="form-control" placeholder="C">
        </div>
        <div class="col-md-2">
          <input type="text" class="form-control" placeholder="I">
        </div>
      </div>
      <button type="button" class="btn btn-sm btn-primary mt-3">
        <i class="bi bi-plus-circle me-1"></i> Ajouter
      </button>
    </form>
  </div>

  <!-- Graphique -->
  <div class="card p-4">
    <h6 class="mb-3">Répartition des rôles</h6>
    <canvas id="raciChart" height="150"></canvas>
  </div>
</div>

    <div id="module-risques" class="content-section d-none">
      <h2>Risques & Opportunités</h2>
      <p>Identification, évaluation et plans d’action liés aux risques qualité.</p>
    </div>

    <div id="module-objectifs" class="content-section d-none">
      <h2>Objectifs Qualité</h2>
      <p>Liste des objectifs qualité en lien avec la politique et les enjeux.</p>
    </div>

    <div id="module-docs" class="content-section d-none">
      <h2>Documents & Versions</h2>
      <p>Liste des documents, procédures, et leurs versions.</p>
    </div>

    <div id="module-equipements" class="content-section d-none">
      <h2>Équipements & Maintenance</h2>
      <p>Équipements utilisés et calendrier de maintenance préventive.</p>
    </div>

    <div id="module-audits" class="content-section d-none">
      <h2>Audits internes</h2>
      <p>Planning des audits internes et état des constats.</p>
    </div>

    <div id="module-capa" class="content-section d-none">
      <h2>CAPA / Non-conformités</h2>
      <p>Actions correctives et préventives, traitement des non-conformités.</p>
    </div>

    <div id="module-ia" class="content-section d-none">
      <h2>Analyse prédictive</h2>
      <p>Utilisation de l’IA pour prédire les risques et optimiser la qualité.</p>
    </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    const links = document.querySelectorAll('.nav-link[data-target]');
    const sections = document.querySelectorAll('.content-section');

    links.forEach(link => {
      link.addEventListener('click', function (e) {
        e.preventDefault();

        // Enlever la classe active des autres liens
        links.forEach(l => l.classList.remove('active'));

        // Cacher toutes les sections
        sections.forEach(section => section.classList.add('d-none'));

        // Afficher la bonne section
        const targetId = this.getAttribute('data-target');
        document.getElementById(targetId).classList.remove('d-none');

        // Marquer comme actif
        this.classList.add('active');
      });
    });

    //Parties interessees chart
    // Parties intéressées chart
const ctxParties = document.getElementById('partiesChart').getContext('2d');
new Chart(ctxParties, {
  type: 'scatter',
  data: {
    datasets: [
      { label: 'Clients', data: [{ x: 9, y: 9 }], backgroundColor: 'green', pointRadius: 8 },
      { label: 'Fournisseurs', data: [{ x: 6, y: 8 }], backgroundColor: 'orange', pointRadius: 8 },
      { label: 'Autorités', data: [{ x: 10, y: 10 }], backgroundColor: 'red', pointRadius: 8 },
      { label: 'Employés', data: [{ x: 7, y: 9 }], backgroundColor: 'blue', pointRadius: 8 }
    ]
  },
  options: {
    scales: {
      x: { title: { display: true, text: 'Influence' }, min: 0, max: 10 },
      y: { title: { display: true, text: 'Impact' }, min: 0, max: 10 }
    }
  }
});

// Analyse PESTEL chart
const ctxPESTEL = document.getElementById('pestelChart').getContext('2d');
new Chart(ctxPESTEL, {
  type: 'radar',
  data: {
    labels: ['Politique', 'Économique', 'Socioculturel', 'Technologique', 'Environnemental', 'Légal'],
    datasets: [{
      label: 'Niveau d’impact',
      data: [7, 8, 6, 9, 5, 8],
      backgroundColor: 'rgba(29, 53, 87, 0.2)',
      borderColor: 'rgba(29, 53, 87, 1)',
      pointBackgroundColor: 'rgba(29, 53, 87, 1)'
    }]
  },
  options: { scales: { r: { min: 0, max: 10, ticks: { stepSize: 2 } } } }
});

// Politique Qualité chart
const ctxPolitique = document.getElementById('politiqueChart').getContext('2d');
new Chart(ctxPolitique, {
  type: 'doughnut',
  data: {
    labels: ['Validée', 'En attente'],
    datasets: [{
      data: [78, 22],
      backgroundColor: ['#198754', '#dee2e6'],
      borderWidth: 1
    }]
  },
  options: {
    plugins: { legend: { position: 'bottom' } }
  }
});

// Matrice RACI chart
const ctxRaci = document.getElementById('raciChart').getContext('2d');
new Chart(ctxRaci, {
  type: 'doughnut',
  data: {
    labels: ['Responsables (R)', 'Approbateurs (A)', 'Consultés (C)', 'Informés (I)'],
    datasets: [{
      data: [3, 3, 3, 3],
      backgroundColor: ['#4caf50', '#2196f3', '#ff9800', '#9c27b0']
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { position: 'bottom' } }
  }
});

  </script>
</body>
</html>
