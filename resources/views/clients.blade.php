<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Tableau de bord</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>


  <style>

    /* Conteneur calendrier */
#maintenanceCalendar {
  background: #fff;
  border-radius: 12px;
  padding: 1rem;
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  font-family: 'Segoe UI', Roboto, sans-serif;
}

/* En-tête (mois, boutons) */
.fc .fc-toolbar-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: #0d6efd; /* bleu Bootstrap */
}

.fc .fc-button {
  background: #0d6efd;
  border: none;
  border-radius: 6px !important;
  padding: 0.4rem 0.8rem;
  font-size: 0.85rem;
  font-weight: 500;
}
.fc .fc-button:hover {
  background: #0b5ed7;
}
.fc .fc-button:disabled {
  background: #adb5bd;
}

/* Grille */
.fc .fc-daygrid-day-frame {
  padding: 6px;
}
.fc .fc-daygrid-day-top {
  font-size: 0.8rem;
  font-weight: 500;
  color: #495057;
}

/* Evénements */
.fc-event {
  border: none;
  border-radius: 6px;
  padding: 4px 6px;
  font-size: 0.75rem;
  font-weight: 500;
  color: #fff !important;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.fc-event:hover {
  opacity: 0.9;
  transform: scale(1.02);
  transition: 0.2s ease;
}

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
  <h2 class="mb-4">Tableau de bord Qualité</h2>

  <!-- KPIs globaux -->
  <div class="row mb-4 g-3">
    <div class="col-md-3">
      <div class="card p-3 shadow-sm text-center">
        <h6 class="text-muted">Non-conformités ouvertes</h6>
        <h3 class="text-danger mb-0">4</h3>
        <small class="text-muted">dont 2 critiques</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3 shadow-sm text-center">
        <h6 class="text-muted">CAPA en cours</h6>
        <h3 class="text-warning mb-0">3</h3>
        <small class="text-muted">1 clôturée ce mois</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3 shadow-sm text-center">
        <h6 class="text-muted">Satisfaction client</h6>
        <h3 class="text-success mb-0">87%</h3>
        <small class="text-muted">objectif : 90%</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3 shadow-sm text-center">
        <h6 class="text-muted">Confiance IA</h6>
        <h3 class="text-primary mb-0">87%</h3>
        <small class="text-muted">prédictions fiables</small>
      </div>
    </div>
  </div>

  <!-- Graphiques de synthèse -->
  <div class="row mb-4">
    <div class="col-md-6">
      <div class="card p-4 shadow-sm">
        <h6 class="mb-3"><i class="bi bi-bar-chart-line me-2 text-info"></i> Avancement des modules</h6>
        <canvas id="modulesProgressChart" height="200"></canvas>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-4 shadow-sm">
        <h6 class="mb-3"><i class="bi bi-pie-chart me-2 text-success"></i> Répartition des statuts</h6>
        <canvas id="modulesStatusChart" height="200"></canvas>
      </div>
    </div>
  </div>

  <!-- Liste des modules -->
  <div class="row g-4">
    @php
      $modules = [
        [
          'name' => 'Contexte & Parties Intéressées',
          'status' => 'Terminé',
          'status_color' => 'success',
          'desc' => '5 enjeux internes ajoutés, 3 analyses SWOT réalisées.'
        ],
        [
          'name' => 'Leadership & Gouvernance',
          'status' => 'En cours',
          'status_color' => 'warning',
          'desc' => 'Politique qualité en révision, 2 fiches de poste manquantes.'
        ],
        [
          'name' => 'Planification & Risques',
          'status' => 'À faire',
          'status_color' => 'secondary',
          'desc' => 'Aucun objectif qualité défini, analyse des risques à compléter.'
        ],
        [
          'name' => 'Soutien & Ressources',
          'status' => 'En cours',
          'status_color' => 'info',
          'desc' => '3 formations en attente, 1 équipement en maintenance.'
        ],
        [
          'name' => 'Opérations & Audits',
          'status' => 'Terminé',
          'status_color' => 'success',
          'desc' => '4 audits réalisés, aucun écart majeur détecté.'
        ],
        [
          'name' => 'CAPA / Non-conformités',
          'status' => 'En cours',
          'status_color' => 'danger',
          'desc' => '4 NC actives, 3 CAPA en cours de traitement.'
        ],
        [
          'name' => 'Amélioration & IA',
          'status' => 'À faire',
          'status_color' => 'secondary',
          'desc' => '1 prévision IA disponible, 4 recommandations générées.'
        ]
      ];
    @endphp

    @foreach ($modules as $module)
      <div class="col-md-6 col-lg-4">
        <div class="card p-4 shadow-sm h-100">
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
 <h2 class="mb-3">Contexte & Parties intéressées</h2>
  <p class="text-muted">
    Définir les enjeux internes/externes, analyser PESTEL et cartographier les parties intéressées avec leur influence/impact.
  </p>

  <!-- Cartographie Parties intéressées -->
  <div class="card mb-4">
    <div class="card-body">
      <h5 class="card-title">Cartographie des parties intéressées</h5>
      <form class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Partie intéressée</label>
          <input type="text" class="form-control" placeholder="Ex : Clients B2B">
        </div>
        <div class="col-md-3">
          <label class="form-label">Type</label>
          <select class="form-select">
            <option>Interne</option>
            <option selected>Externe</option>
          </select>
        </div>
        <div class="col-md-5">
          <label class="form-label">Attentes principales</label>
          <input type="text" class="form-control" placeholder="Ex : Qualité conforme, délais tenus">
        </div>
        <div class="col-md-3">
          <label class="form-label">Influence</label>
          <select class="form-select">
            <option>1 - Faible</option>
            <option>2</option>
            <option selected>3 - Moyenne</option>
            <option>4</option>
            <option>5 - Forte</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">Impact</label>
          <select class="form-select">
            <option>1 - Faible</option>
            <option>2</option>
            <option>3 - Moyen</option>
            <option selected>4</option>
            <option>5 - Fort</option>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Exigences réglementaires (si applicable)</label>
          <input type="text" class="form-control" placeholder="Ex : Normes sectorielles, habilitations">
        </div>
        <div class="col-12">
          <button type="button" class="btn btn-primary">Ajouter (statique)</button>
        </div>
      </form>

      <div class="mt-4">
        <canvas id="chartPIInfluenceImpact" height="180"></canvas>
        <div class="form-text">Matrice Influence (X) / Impact (Y) – données statiques de démonstration.</div>
      </div>
    </div>
  </div>

  <!-- Analyse PESTEL & Enjeux -->
  <div class="card mb-4">
    <div class="card-body">
      <h5 class="card-title">Analyse PESTEL & Enjeux</h5>

      <form class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Facteur PESTEL</label>
          <select class="form-select">
            <option>Politique</option>
            <option>Économique</option>
            <option selected>Socioculturel</option>
            <option>Technologique</option>
            <option>Environnemental</option>
            <option>Légal</option>
          </select>
        </div>
        <div class="col-md-8">
          <label class="form-label">Enjeu identifié</label>
          <input type="text" class="form-control" placeholder="Ex : Digitalisation des process qualité">
        </div>
        <div class="col-md-4">
          <label class="form-label">Probabilité</label>
          <select class="form-select">
            <option>1 - Rare</option>
            <option>2</option>
            <option selected>3 - Possible</option>
            <option>4</option>
            <option>5 - Fréquent</option>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Gravité (impact)</label>
          <select class="form-select">
            <option>1 - Mineur</option>
            <option>2</option>
            <option>3 - Significatif</option>
            <option selected>4</option>
            <option>5 - Critique</option>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Orientation</label>
          <select class="form-select">
            <option>Risques</option>
            <option selected>Opportunités</option>
          </select>
        </div>
        <div class="col-12">
          <button type="button" class="btn btn-secondary">Ajouter (statique)</button>
        </div>
      </form>

      <div class="row mt-4">
        <div class="col-md-6">
          <canvas id="chartPESTELRadar" height="200"></canvas>
          <div class="form-text">Radar d’exposition PESTEL (statique).</div>
        </div>
        <div class="col-md-6">
          <canvas id="chartEnjeuxSeverite" height="200"></canvas>
          <div class="form-text">% d’enjeux classés « élevés » par axe.</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Synthèse rapide -->
  <div class="card">
    <div class="card-body">
      <h6 class="mb-2">Synthèse</h6>
      <ul class="mb-0">
        <li>Parties prioritaires : <strong>Clients B2B</strong>, <strong>Autorités</strong></li>
        <li>Enjeux dominants : <strong>Technologique</strong> & <strong>Légal</strong></li>
        <li>Focus prochain trimestre : <strong>Conformité réglementaire</strong> & <strong>Digitalisation</strong></li>
      </ul>
    </div>
  </div>
</div>

   <!-- SECTION 2 : SWOT & PESTEL -->
<div id="module-swot" class="content-section d-none">
  <h2 class="mb-4">Analyse SWOT & PESTEL</h2>
  <p class="text-muted mb-4">
    Identifiez vos forces, faiblesses, opportunités et menaces pour le système qualité, puis évaluez les facteurs externes (PESTEL).
  </p>

  <!-- Tableau SWOT -->
  <div class="row g-4 mb-5">
    <div class="col-md-6">
      <div class="card p-4 h-100 border-success">
        <h5 class="text-success"><i class="bi bi-check2-circle me-2"></i>Forces (interne)</h5>
        <ul id="swot-forces" class="mb-3">
          <li>Équipe qualité certifiée ISO</li>
          <li>Procédures documentées et maîtrisées</li>
        </ul>
        <form class="d-flex">
          <input type="text" class="form-control form-control-sm me-2" placeholder="Ajouter une force...">
          <button type="button" class="btn btn-sm btn-success"><i class="bi bi-plus-circle"></i></button>
        </form>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card p-4 h-100 border-danger">
        <h5 class="text-danger"><i class="bi bi-x-circle me-2"></i>Faiblesses (interne)</h5>
        <ul id="swot-faiblesses" class="mb-3">
          <li>Dépendance à un fournisseur unique</li>
          <li>Manque de formation continue</li>
        </ul>
        <form class="d-flex">
          <input type="text" class="form-control form-control-sm me-2" placeholder="Ajouter une faiblesse...">
          <button type="button" class="btn btn-sm btn-danger"><i class="bi bi-plus-circle"></i></button>
        </form>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card p-4 h-100 border-primary">
        <h5 class="text-primary"><i class="bi bi-lightbulb me-2"></i>Opportunités (externe)</h5>
        <ul id="swot-opportunites" class="mb-3">
          <li>Marché en croissance sur la qualité durable</li>
          <li>Nouvelle réglementation favorisant la traçabilité</li>
        </ul>
        <form class="d-flex">
          <input type="text" class="form-control form-control-sm me-2" placeholder="Ajouter une opportunité...">
          <button type="button" class="btn btn-sm btn-primary"><i class="bi bi-plus-circle"></i></button>
        </form>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card p-4 h-100 border-warning">
        <h5 class="text-warning"><i class="bi bi-exclamation-triangle me-2"></i>Menaces (externe)</h5>
        <ul id="swot-menaces" class="mb-3">
          <li>Pression concurrentielle accrue</li>
          <li>Évolutions réglementaires strictes</li>
        </ul>
        <form class="d-flex">
          <input type="text" class="form-control form-control-sm me-2" placeholder="Ajouter une menace...">
          <button type="button" class="btn btn-sm btn-warning"><i class="bi bi-plus-circle"></i></button>
        </form>
      </div>
    </div>
  </div>

  <!-- Graphique SWOT -->
  <div class="card p-4 mb-5">
    <h5 class="mb-3"><i class="bi bi-pie-chart me-2"></i> Poids relatif SWOT</h5>
    <canvas id="swotChart" height="200"></canvas>
    <div class="form-text">Répartition statique des éléments SWOT.</div>
  </div>

  <!-- Formulaire PESTEL -->
  <div class="card p-4 mb-4">
    <h5 class="mb-3"><i class="bi bi-bar-chart-line me-2"></i> Analyse PESTEL</h5>
    <p class="text-muted">Évaluez l’influence de chaque facteur (0 à 10).</p>

    <form class="row g-3">
      <div class="col-md-4">
        <label class="form-label">Politique</label>
        <input type="number" class="form-control" min="0" max="10" value="6">
      </div>
      <div class="col-md-4">
        <label class="form-label">Économique</label>
        <input type="number" class="form-control" min="0" max="10" value="8">
      </div>
      <div class="col-md-4">
        <label class="form-label">Socioculturel</label>
        <input type="number" class="form-control" min="0" max="10" value="5">
      </div>
      <div class="col-md-4">
        <label class="form-label">Technologique</label>
        <input type="number" class="form-control" min="0" max="10" value="9">
      </div>
      <div class="col-md-4">
        <label class="form-label">Environnemental</label>
        <input type="number" class="form-control" min="0" max="10" value="7">
      </div>
      <div class="col-md-4">
        <label class="form-label">Légal</label>
        <input type="number" class="form-control" min="0" max="10" value="8">
      </div>
    </form>

    <canvas id="pestelChart" class="mt-4" height="300"></canvas>
  </div>
</div>


    <!-- SECTION 3 : POLITIQUE QUALITÉ -->
<div id="module-politique" class="content-section d-none">
  <h2 class="mb-4">Politique Qualité</h2>
  <p class="text-muted mb-4">
    Déclaration officielle de l’entreprise concernant son engagement envers la qualité, la satisfaction client et l’amélioration continue.
  </p>

  <!-- Carte affichage politique actuelle -->
  <div class="card p-4 mb-4 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5><i class="bi bi-award me-2 text-primary"></i> Politique Qualité actuelle</h5>
      <span class="badge bg-info">Version 1.2 – 15/08/2023</span>
    </div>
    <blockquote class="blockquote">
      <p>
        Notre entreprise s’engage à fournir des produits et services conformes aux exigences clients et réglementaires, 
        à améliorer continuellement l’efficacité de notre système de management de la qualité (SMQ), 
        et à favoriser le développement des compétences de nos collaborateurs.
      </p>
    </blockquote>
    <p class="text-muted small mb-0">Validée par la Direction Générale</p>
  </div>

  <!-- Indicateur de diffusion -->
  <div class="card p-4 mb-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-people me-2 text-secondary"></i> Diffusion de la politique qualité</h5>
    <p class="info-text">Pourcentage d’employés ayant lu et validé la politique (statique).</p>
    
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
    <canvas id="politiqueChart" height="150"></canvas>
  </div>

  <!-- Historique des versions -->
  <div class="card p-4 mb-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-clock-history me-2 text-secondary"></i> Historique des versions</h5>
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><strong>v1.2</strong> – 15/08/2023 : Mise à jour des engagements environnementaux</li>
      <li class="list-group-item"><strong>v1.1</strong> – 10/03/2022 : Ajout de l’objectif satisfaction client</li>
      <li class="list-group-item"><strong>v1.0</strong> – 01/01/2021 : Première publication officielle</li>
    </ul>
  </div>

  <!-- Formulaire de soumission nouvelle politique -->
  <div class="card p-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-pencil-square me-2 text-success"></i> Proposer une nouvelle version</h5>
    <form>
      <div class="mb-3">
        <label class="form-label">Texte de la politique qualité</label>
        <textarea class="form-control" rows="5" placeholder="Saisir la nouvelle politique qualité..."></textarea>
      </div>
      <div class="row">
        <div class="col-md-4 mb-3">
          <label class="form-label">Numéro de version</label>
          <input type="text" class="form-control" placeholder="Ex : 1.3">
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Date de révision</label>
          <input type="date" class="form-control">
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Responsable</label>
          <input type="text" class="form-control" placeholder="Ex : Directeur Qualité">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">
        <i class="bi bi-upload me-2"></i> Soumettre pour validation
      </button>
    </form>
  </div>
</div>


    <!-- SECTION : MATRICE RACI -->
<div id="module-raci" class="content-section d-none">
  <h2 class="mb-4">Matrice RACI</h2>
  <p class="text-muted mb-4">
    Structure des rôles et responsabilités pour chaque processus du Système de Management de la Qualité (SMQ).
  </p>

  <!-- Tableau RACI -->
  <div class="card p-4 mb-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-diagram-3 me-2 text-primary"></i> Matrice des responsabilités</h5>
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
            <td>Formation & Compétences</td>
            <td>RH</td>
            <td>Direction</td>
            <td>Manager</td>
            <td>Employés</td>
          </tr>
          <tr>
            <td>Non-conformités & CAPA</td>
            <td>Responsable Qualité</td>
            <td>Direction</td>
            <td>Manager Processus</td>
            <td>Collaborateurs</td>
          </tr>
          <tr>
            <td>Revue de direction</td>
            <td>Direction</td>
            <td>Comité Exécutif</td>
            <td>Responsable Qualité</td>
            <td>Managers</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Formulaire d'ajout -->
  <div class="card p-4 mb-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-plus-circle me-2 text-success"></i> Ajouter un nouveau processus</h5>
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
      <button type="button" class="btn btn-primary btn-sm mt-3">
        <i class="bi bi-upload me-1"></i> Ajouter
      </button>
    </form>
  </div>

  <!-- Graphique RACI -->
  <div class="card p-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-bar-chart-line me-2 text-secondary"></i> Répartition des rôles</h5>
    <canvas id="raciChart" height="180"></canvas>
    <p class="form-text">Nombre d’occurrences par rôle dans la matrice (statique).</p>
  </div>
</div>


    <div id="module-risques" class="content-section d-none">
  <h2 class="mb-4">Risques & Opportunités</h2>
  <p class="info-text mb-4">
    Identification, évaluation et plans d’action liés aux risques/opportunités qualité, en lien avec les objectifs stratégiques.
  </p>

  <!-- Tableau des risques -->
  <div class="card p-4 mb-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-exclamation-triangle text-danger me-2"></i> Registre des risques/opportunités</h5>
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Type</th>
            <th>Risque / Opportunité</th>
            <th>Processus impacté</th>
            <th>Probabilité</th>
            <th>Impact</th>
            <th>Criticité</th>
            <th>Plan d’action</th>
            <th>Statut</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><span class="badge bg-danger">Risque</span></td>
            <td>Panne d’équipement critique</td>
            <td>Production</td>
            <td>Élevée</td>
            <td>Élevé</td>
            <td><span class="badge bg-danger">9 (Critique)</span></td>
            <td>Plan de maintenance préventive</td>
            <td><span class="badge bg-warning text-dark">En cours</span></td>
          </tr>
          <tr>
            <td><span class="badge bg-danger">Risque</span></td>
            <td>Non-conformité fournisseur</td>
            <td>Achats</td>
            <td>Moyenne</td>
            <td>Élevé</td>
            <td><span class="badge bg-warning text-dark">6 (Modéré)</span></td>
            <td>Audit fournisseurs + suivi qualité</td>
            <td><span class="badge bg-info">À traiter</span></td>
          </tr>
          <tr>
            <td><span class="badge bg-success">Opportunité</span></td>
            <td>Accès à de nouveaux marchés</td>
            <td>Commercial</td>
            <td>Faible</td>
            <td>Élevé</td>
            <td><span class="badge bg-success">3 (Faible)</span></td>
            <td>Déploiement commercial ciblé</td>
            <td><span class="badge bg-success">Accepté</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Formulaire ajout -->
  <div class="card p-4 mb-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-plus-circle me-2"></i> Ajouter un risque / opportunité</h5>
    <form>
      <div class="row g-3">
        <div class="col-md-2">
          <select class="form-select">
            <option>Risque</option>
            <option>Opportunité</option>
          </select>
          <small class="text-muted">Type</small>
        </div>
        <div class="col-md-3">
          <input type="text" class="form-control" placeholder="Description">
        </div>
        <div class="col-md-2">
          <select class="form-select">
            <option>Faible</option>
            <option>Moyenne</option>
            <option>Élevée</option>
          </select>
          <small class="text-muted">Probabilité</small>
        </div>
        <div class="col-md-2">
          <select class="form-select">
            <option>Faible</option>
            <option>Moyen</option>
            <option>Élevé</option>
          </select>
          <small class="text-muted">Impact</small>
        </div>
        <div class="col-md-3">
          <input type="text" class="form-control" placeholder="Plan d’action">
        </div>
      </div>
      <button type="button" class="btn btn-sm btn-primary mt-3">
        <i class="bi bi-save me-1"></i> Enregistrer
      </button>
    </form>
  </div>

  <!-- Graphiques -->
  <div class="row">
    <div class="col-md-6">
      <div class="card p-4 mb-4 shadow-sm">
        <h5 class="mb-3"><i class="bi bi-bar-chart-line me-2"></i> Criticité des risques</h5>
        <canvas id="risquesChart"></canvas>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-4 mb-4 shadow-sm">
        <h5 class="mb-3"><i class="bi bi-grid-3x3-gap me-2"></i> Matrice Probabilité / Impact</h5>
        <canvas id="riskMatrixChart"></canvas>
      </div>
    </div>
  </div>
</div>


    <div id="module-objectifs" class="content-section d-none">
  <h2 class="mb-4">Objectifs Qualité</h2>
  <p class="info-text mb-4">
    Définis en lien avec la politique qualité et les enjeux stratégiques. Suivis régulièrement et évalués lors des revues de direction.
  </p>

  <!-- Tableau des objectifs -->
  <div class="card p-4 mb-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-bullseye text-primary me-2"></i> Suivi des objectifs qualité</h5>
    <div class="table-responsive">
      <table class="table table-striped align-middle">
        <thead class="table-light">
          <tr>
            <th>Objectif</th>
            <th>Indicateur</th>
            <th>Cible</th>
            <th>Réalisation</th>
            <th>Périodicité</th>
            <th>Statut</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Satisfaction client</td>
            <td>Enquêtes trimestrielles</td>
            <td>90%</td>
            <td>82%</td>
            <td>Trimestriel</td>
            <td><span class="badge bg-warning text-dark">🟡 En cours</span></td>
          </tr>
          <tr>
            <td>Taux de non-conformités</td>
            <td>NC / Produits livrés</td>
            <td>< 2%</td>
            <td>1.5%</td>
            <td>Mensuel</td>
            <td><span class="badge bg-success">✅ Atteint</span></td>
          </tr>
          <tr>
            <td>Formation des employés</td>
            <td>% formés / total</td>
            <td>100%</td>
            <td>65%</td>
            <td>Annuel</td>
            <td><span class="badge bg-danger">🔴 À renforcer</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Formulaire ajout objectif -->
  <div class="card p-4 mb-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-plus-circle me-2"></i> Ajouter un objectif qualité</h5>
    <form>
      <div class="row g-3">
        <div class="col-md-3">
          <input type="text" class="form-control" placeholder="Nom de l’objectif">
        </div>
        <div class="col-md-3">
          <input type="text" class="form-control" placeholder="Indicateur">
        </div>
        <div class="col-md-2">
          <input type="text" class="form-control" placeholder="Cible">
        </div>
        <div class="col-md-2">
          <input type="text" class="form-control" placeholder="Réalisation">
        </div>
        <div class="col-md-2">
          <select class="form-select">
            <option>À faire</option>
            <option>En cours</option>
            <option>Atteint</option>
          </select>
          <small class="text-muted">Statut</small>
        </div>
      </div>
      <button type="button" class="btn btn-sm btn-primary mt-3">
        <i class="bi bi-save me-1"></i> Enregistrer
      </button>
    </form>
  </div>

  <!-- Graphiques -->
  <div class="row">
    <div class="col-md-6">
      <div class="card p-4 mb-4 shadow-sm">
        <h5 class="mb-3"><i class="bi bi-bar-chart-line me-2"></i> Cible vs Réalisation</h5>
        <canvas id="objectifsChart"></canvas>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-4 mb-4 shadow-sm">
        <h5 class="mb-3"><i class="bi bi-speedometer2 me-2"></i> Avancement global</h5>
        <canvas id="objectifGauge"></canvas>
      </div>
    </div>
  </div>
</div>



    <div id="module-docs" class="content-section d-none">
  <h2 class="mb-4">Documents & Versions</h2>
  <p class="info-text mb-4">
    Gestion centralisée des documents du SMQ : identification, versionnage, statut et diffusion.
  </p>

  <!-- Tableau documents -->
  <div class="card p-4 mb-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-file-earmark-text text-primary me-2"></i> Gestion documentaire</h5>
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Nom</th>
            <th>Type</th>
            <th>Version</th>
            <th>Date</th>
            <th>Auteur</th>
            <th>Approbateur</th>
            <th>Statut</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Procédure Audit interne</td>
            <td>Procédure</td>
            <td>v2.0</td>
            <td>15/08/2023</td>
            <td>R. Qualité</td>
            <td>Direction</td>
            <td><span class="badge bg-success">Validé</span></td>
            <td>
              <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
              <button class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i></button>
            </td>
          </tr>
          <tr>
            <td>Politique Qualité</td>
            <td>Politique</td>
            <td>v1.2</td>
            <td>01/07/2023</td>
            <td>DG</td>
            <td>DG</td>
            <td><span class="badge bg-info">Diffusé</span></td>
            <td>
              <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
              <button class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i></button>
            </td>
          </tr>
          <tr>
            <td>Mode opératoire production</td>
            <td>Mode opératoire</td>
            <td>v3.1</td>
            <td>20/06/2023</td>
            <td>Chef Prod</td>
            <td>R. Qualité</td>
            <td><span class="badge bg-warning text-dark">En révision</span></td>
            <td>
              <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
              <button class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i></button>
            </td>
          </tr>
          <tr>
            <td>Rapport Audit externe</td>
            <td>Rapport</td>
            <td>v1.0</td>
            <td>10/05/2023</td>
            <td>Auditeur Ext.</td>
            <td>DG</td>
            <td><span class="badge bg-danger">Obsolète</span></td>
            <td>
              <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
              <button class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Formulaire ajout document -->
  <div class="card p-4 mb-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-plus-circle me-2"></i> Ajouter un document</h5>
    <form>
      <div class="row g-3">
        <div class="col-md-3">
          <input type="text" class="form-control" placeholder="Nom du document">
        </div>
        <div class="col-md-2">
          <select class="form-select">
            <option>Procédure</option>
            <option>Politique</option>
            <option>Mode opératoire</option>
            <option>Rapport</option>
          </select>
        </div>
        <div class="col-md-2">
          <input type="text" class="form-control" placeholder="Version">
        </div>
        <div class="col-md-2">
          <input type="date" class="form-control">
        </div>
        <div class="col-md-3">
          <input type="text" class="form-control" placeholder="Auteur">
        </div>
      </div>
      <button type="button" class="btn btn-sm btn-primary mt-3">
        <i class="bi bi-upload me-1"></i> Ajouter
      </button>
    </form>
  </div>

  <!-- Graphiques -->
  <div class="row">
    <div class="col-md-6">
      <div class="card p-4 mb-4 shadow-sm">
        <h5 class="mb-3"><i class="bi bi-pie-chart me-2"></i> Répartition des documents par type</h5>
        <canvas id="docsChart"></canvas>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-4 mb-4 shadow-sm">
        <h5 class="mb-3"><i class="bi bi-bar-chart-line me-2"></i> Statut des documents</h5>
        <canvas id="docsStatusChart"></canvas>
      </div>
    </div>
  </div>
</div>


    <div id="module-equipements" class="content-section d-none">
  <h2 class="mb-4">Équipements & Maintenance</h2>
  <p class="info-text mb-4">
    Suivi des équipements, leur disponibilité, et les maintenances planifiées (préventives, correctives, calibrations).
  </p>

  <!-- Timeline interventions -->
  <div class="card p-4 mb-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-clock-history text-primary me-2"></i> Historique & planning des maintenances</h5>
    <ul class="timeline list-unstyled">
      <li class="mb-4">
        <div class="d-flex align-items-center">
          <span class="badge bg-success me-3">Préventive</span>
          <div>
            <strong>11/09/2023</strong> – Machine de production A  
            <small class="text-muted d-block">Maintenance préventive réalisée avec succès</small>
          </div>
        </div>
      </li>
      <li class="mb-4">
        <div class="d-flex align-items-center">
          <span class="badge bg-warning text-dark me-3">Calibration</span>
          <div>
            <strong>03/09/2023</strong> – Balance de précision  
            <small class="text-muted d-block">Calibration annuelle effectuée</small>
          </div>
        </div>
      </li>
      <li class="mb-4">
        <div class="d-flex align-items-center">
          <span class="badge bg-danger me-3">Corrective</span>
          <div>
            <strong>19/09/2023</strong> – Compresseur  
            <small class="text-muted d-block">Réparation suite à une panne</small>
          </div>
        </div>
      </li>
    </ul>
  </div>

  <!-- Calendrier mensuel simplifié -->
  <div class="card p-4 mb-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-calendar-event text-info me-2"></i> Calendrier des maintenances</h5>
    <div id="maintenanceCalendar"></div>
  </div>

  <!-- Inventaire équipements -->
  <div class="card p-4 mb-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-gear-wide-connected text-secondary me-2"></i> Inventaire</h5>
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Équipement</th>
            <th>Référence</th>
            <th>État</th>
            <th>Criticité</th>
            <th>Dernière maintenance</th>
            <th>Prochaine maintenance</th>
            <th>Responsable</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Machine de production A</td>
            <td>EQP-001</td>
            <td><span class="badge bg-success">Opérationnel</span></td>
            <td><span class="badge bg-danger">Haute</span></td>
            <td>01/08/2023</td>
            <td>11/09/2023</td>
            <td>Jean Dupont</td>
          </tr>
          <tr>
            <td>Balance de précision</td>
            <td>EQP-002</td>
            <td><span class="badge bg-warning text-dark">En calibration</span></td>
            <td><span class="badge bg-warning">Moyenne</span></td>
            <td>15/07/2023</td>
            <td>03/09/2023</td>
            <td>Claire Martin</td>
          </tr>
          <tr>
            <td>Compresseur</td>
            <td>EQP-003</td>
            <td><span class="badge bg-danger">En panne</span></td>
            <td><span class="badge bg-danger">Haute</span></td>
            <td>20/06/2023</td>
            <td>19/09/2023</td>
            <td>Marc Leroy</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

   <div id="module-audits" class="content-section d-none">
  <h2 class="mb-4">Audits internes</h2>
  <p class="info-text mb-4">
    Planification, suivi et constats des audits internes conformément au SMQ.
  </p>

  <!-- Tableau planning audits -->
  <div class="card p-4 mb-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-calendar-check text-primary me-2"></i> Planning des audits</h5>
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Date</th>
            <th>Processus</th>
            <th>Type</th>
            <th>Référentiel</th>
            <th>Auditeur</th>
            <th>Constats</th>
            <th>Statut</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>05/09/2023</td>
            <td>Production</td>
            <td>Interne</td>
            <td>ISO 9001</td>
            <td>Jean Dupont</td>
            <td>
              <span class="badge bg-danger">2 NC majeures</span><br>
              <span class="badge bg-warning text-dark">1 mineure</span>
            </td>
            <td><span class="badge bg-warning text-dark">Planifié</span></td>
          </tr>
          <tr>
            <td>12/09/2023</td>
            <td>RH & Formation</td>
            <td>Interne</td>
            <td>ISO 9001</td>
            <td>Claire Martin</td>
            <td><span class="badge bg-info">0 constat</span></td>
            <td><span class="badge bg-info">En cours</span></td>
          </tr>
          <tr>
            <td>20/09/2023</td>
            <td>Achats & Fournisseurs</td>
            <td>Fournisseur</td>
            <td>IATF 16949</td>
            <td>Marc Leroy</td>
            <td>
              <span class="badge bg-danger">1 majeure</span><br>
              <span class="badge bg-success">2 pistes</span>
            </td>
            <td><span class="badge bg-success">Clôturé</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Formulaire ajout audit -->
  <div class="card p-4 mb-4 shadow-sm">
    <h5 class="mb-3"><i class="bi bi-plus-circle me-2"></i> Planifier un audit</h5>
    <form>
      <div class="row g-3">
        <div class="col-md-2">
          <input type="date" class="form-control">
        </div>
        <div class="col-md-2">
          <input type="text" class="form-control" placeholder="Processus audité">
        </div>
        <div class="col-md-2">
          <select class="form-select">
            <option>Interne</option>
            <option>Fournisseur</option>
            <option>Processus</option>
          </select>
          <small class="text-muted">Type</small>
        </div>
        <div class="col-md-2">
          <select class="form-select">
            <option>ISO 9001</option>
            <option>IATF 16949</option>
            <option>ISO 13485</option>
          </select>
          <small class="text-muted">Référentiel</small>
        </div>
        <div class="col-md-2">
          <input type="text" class="form-control" placeholder="Auditeur">
        </div>
        <div class="col-md-2">
          <select class="form-select">
            <option>Planifié</option>
            <option>En cours</option>
            <option>Clôturé</option>
          </select>
          <small class="text-muted">Statut</small>
        </div>
      </div>
      <button type="button" class="btn btn-sm btn-primary mt-3">
        <i class="bi bi-save me-1"></i> Ajouter
      </button>
    </form>
  </div>

  <!-- Graphiques constats -->
  <div class="row">
    <div class="col-md-6">
      <div class="card p-4 mb-4 shadow-sm">
        <h5 class="mb-3"><i class="bi bi-bar-chart-line me-2"></i> Constats par audit</h5>
        <canvas id="auditsChart"></canvas>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-4 mb-4 shadow-sm">
        <h5 class="mb-3"><i class="bi bi-pie-chart me-2"></i> Répartition des constats</h5>
        <canvas id="auditsPieChart"></canvas>
      </div>
    </div>
  </div>
</div>



 <div id="module-capa" class="content-section d-none">
  <h2 class="mb-4">CAPA / Non-conformités</h2>
  <p class="info-text mb-4">
    Gestion complète des actions correctives et préventives (CAPA) et traitement des non-conformités : 
    enregistrement, analyse des causes, suivi et clôture.
  </p>

  <!-- Indicateurs clés -->
  <div class="row mb-4">
    <div class="col-md-3">
      <div class="card p-3 shadow-sm text-center">
        <h6 class="text-muted mb-2">NC Ouvertes</h6>
        <h3 class="text-danger mb-0">4</h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3 shadow-sm text-center">
        <h6 class="text-muted mb-2">CAPA en cours</h6>
        <h3 class="text-warning mb-0">3</h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3 shadow-sm text-center">
        <h6 class="text-muted mb-2">Clôturées</h6>
        <h3 class="text-success mb-0">5</h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3 shadow-sm text-center">
        <h6 class="text-muted mb-2">Taux de clôture</h6>
        <h3 class="text-primary mb-0">56%</h3>
      </div>
    </div>
  </div>

  <!-- Registre CAPA -->
  <div class="card p-4 mb-4">
    <h5 class="mb-3"><i class="bi bi-journal-text text-danger me-2"></i> Registre CAPA / NC</h5>
    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead class="table-light">
          <tr>
            <th>Réf</th>
            <th>Description</th>
            <th>Type</th>
            <th>Cause racine</th>
            <th>Responsable</th>
            <th>Échéance</th>
            <th>Statut</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>NC-001</td>
            <td>Produit non conforme détecté en production</td>
            <td><span class="badge bg-danger">Corrective</span></td>
            <td>Mauvais réglage machine</td>
            <td>Jean Dupont</td>
            <td>20/09/2023</td>
            <td><span class="badge bg-warning text-dark">En analyse</span></td>
          </tr>
          <tr>
            <td>NC-002</td>
            <td>Audit interne : procédure non respectée</td>
            <td><span class="badge bg-danger">Corrective</span></td>
            <td>Manque de formation</td>
            <td>Claire Martin</td>
            <td>05/09/2023</td>
            <td><span class="badge bg-success">Clôturée</span></td>
          </tr>
          <tr>
            <td>CAPA-003</td>
            <td>Amélioration traçabilité documentaire</td>
            <td><span class="badge bg-info">Préventive</span></td>
            <td>Absence de check-list</td>
            <td>Marc Leroy</td>
            <td>30/09/2023</td>
            <td><span class="badge bg-secondary">Planifiée</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Déclaration d'une nouvelle NC -->
  <div class="card p-4 mb-4">
    <h5 class="mb-3"><i class="bi bi-plus-circle text-success me-2"></i> Déclarer une nouvelle NC / CAPA</h5>
    <form>
      <div class="row g-3">
        <div class="col-md-3">
          <input type="text" class="form-control" placeholder="Référence (ex: NC-004)">
        </div>
        <div class="col-md-5">
          <input type="text" class="form-control" placeholder="Description du problème">
        </div>
        <div class="col-md-2">
          <select class="form-select">
            <option>Corrective</option>
            <option>Préventive</option>
          </select>
        </div>
        <div class="col-md-2">
          <input type="text" class="form-control" placeholder="Responsable">
        </div>
        <div class="col-md-12">
          <textarea class="form-control" rows="2" placeholder="Cause racine / Remarques"></textarea>
        </div>
      </div>
      <button type="button" class="btn btn-primary btn-sm mt-3">
        <i class="bi bi-save me-1"></i> Enregistrer
      </button>
    </form>
  </div>

  <!-- Graphiques -->
  <div class="row">
    <div class="col-md-6">
      <div class="card p-4 mb-4">
        <h5 class="mb-3"><i class="bi bi-graph-up-arrow me-2 text-primary"></i> Avancement des CAPA</h5>
        <canvas id="capaChart" height="200"></canvas>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-4 mb-4">
        <h5 class="mb-3"><i class="bi bi-pie-chart me-2 text-info"></i> Répartition par type</h5>
        <canvas id="capaTypeChart" height="200"></canvas>
      </div>
    </div>
  </div>
</div>


    <div id="module-ia" class="content-section d-none">
  <h2 class="mb-4">Analyse prédictive</h2>
  <p class="info-text mb-4">
    Simulation d’analyse prédictive pour anticiper les tendances, détecter les risques émergents et recommander des actions 
    d’amélioration continue.
  </p>

  <!-- Indicateurs clés IA -->
  <div class="row mb-4">
    <div class="col-md-3">
      <div class="card p-3 shadow-sm text-center">
        <h6 class="text-muted mb-2">Risque projeté</h6>
        <h3 class="text-danger mb-0">↑ 18%</h3>
        <small class="text-muted">Non-conformités prévues</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3 shadow-sm text-center">
        <h6 class="text-muted mb-2">Tendance satisfaction</h6>
        <h3 class="text-success mb-0">+12%</h3>
        <small class="text-muted">Prochaine période</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3 shadow-sm text-center">
        <h6 class="text-muted mb-2">CAPA prévues</h6>
        <h3 class="text-warning mb-0">5</h3>
        <small class="text-muted">Actions recommandées</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3 shadow-sm text-center">
        <h6 class="text-muted mb-2">Confiance IA</h6>
        <h3 class="text-primary mb-0">87%</h3>
        <small class="text-muted">Fiabilité du modèle</small>
      </div>
    </div>
  </div>

  <!-- Formulaire simulation IA -->
  <div class="card p-4 mb-4">
    <h5 class="mb-3"><i class="bi bi-cpu me-2 text-primary"></i> Lancer une simulation</h5>
    <form>
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Type de données</label>
          <select class="form-select">
            <option>Satisfaction client</option>
            <option>Non-conformités</option>
            <option>Objectifs qualité</option>
            <option>Audits internes</option>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Période analysée</label>
          <select class="form-select">
            <option>6 derniers mois</option>
            <option>12 derniers mois</option>
            <option>24 derniers mois</option>
          </select>
        </div>
        <div class="col-md-4 d-flex align-items-end">
          <button type="button" class="btn btn-primary w-100">
            <i class="bi bi-robot me-1"></i> Lancer la prédiction
          </button>
        </div>
      </div>
    </form>
  </div>

  <!-- Graphiques prédictifs -->
  <div class="row">
    <div class="col-md-8">
      <div class="card p-4 mb-4">
        <h5 class="mb-3"><i class="bi bi-line-chart me-2 text-success"></i> Prévision des tendances</h5>
        <canvas id="iaForecastChart" height="200"></canvas>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4 mb-4">
        <h5 class="mb-3"><i class="bi bi-bar-chart-line me-2 text-info"></i> Risques prédits par catégorie</h5>
        <canvas id="iaRiskChart" height="200"></canvas>
      </div>
    </div>
  </div>

  <!-- Recommandations IA -->
  <div class="card p-4">
    <h5 class="mb-3"><i class="bi bi-lightbulb me-2 text-warning"></i> Recommandations automatiques</h5>
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><strong>Action 1 :</strong> Augmenter le suivi des formations sur les processus critiques.</li>
      <li class="list-group-item"><strong>Action 2 :</strong> Mettre en place un contrôle renforcé sur les fournisseurs sensibles.</li>
      <li class="list-group-item"><strong>Action 3 :</strong> Déployer un audit flash ciblé sur la production.</li>
      <li class="list-group-item"><strong>Action 4 :</strong> Automatiser le reporting mensuel des objectifs qualité.</li>
    </ul>
  </div>
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
    // ---- Parties intéressées : Matrice Influence / Impact (Bubble) ----
(function(){
  const ctx = document.getElementById('chartPIInfluenceImpact');
  if(!ctx) return;
  new Chart(ctx, {
    type: 'bubble',
    data: {
      datasets: [
        {
          label: 'Clients B2B',
          data: [{ x: 4.5, y: 4.2, r: 18 }],
          backgroundColor: 'rgba(13,110,253,0.6)'
        },
        {
          label: 'Fournisseurs clés',
          data: [{ x: 3.6, y: 3.8, r: 14 }],
          backgroundColor: 'rgba(25,135,84,0.6)'
        },
        {
          label: 'Autorités',
          data: [{ x: 4.8, y: 4.9, r: 20 }],
          backgroundColor: 'rgba(220,53,69,0.6)'
        },
        {
          label: 'Employés',
          data: [{ x: 3.0, y: 3.5, r: 12 }],
          backgroundColor: 'rgba(255,193,7,0.6)'
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' },
        tooltip: { callbacks: { label: (ctx) => {
          const d = ctx.raw; return `${ctx.dataset.label} — Infl.: ${d.x.toFixed(1)} / Impact: ${d.y.toFixed(1)}`;
        }}}
      },
      scales: {
        x: { title: { display: true, text: 'Influence' }, min: 0, max: 5, grid: { color: 'rgba(0,0,0,0.05)' } },
        y: { title: { display: true, text: 'Impact' }, min: 0, max: 5, grid: { color: 'rgba(0,0,0,0.05)' } }
      }
    }
  });
})();

// ---- PESTEL : Radar d’exposition (statique) ----
(function(){
  const ctx = document.getElementById('chartPESTELRadar');
  if(!ctx) return;
  new Chart(ctx, {
    type: 'radar',
    data: {
      labels: ['Politique', 'Économique', 'Socioculturel', 'Technologique', 'Environnemental', 'Légal'],
      datasets: [
        {
          label: 'Exposition',
          data: [3, 2, 2, 5, 3, 4], // 1 à 5
          backgroundColor: 'rgba(13,110,253,0.2)',
          borderColor: 'rgba(13,110,253,1)',
          pointBackgroundColor: 'rgba(13,110,253,1)'
        }
      ]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'bottom' } },
      scales: {
        r: {
          suggestedMin: 0,
          suggestedMax: 5,
          angleLines: { color: 'rgba(0,0,0,0.05)' },
          grid: { color: 'rgba(0,0,0,0.05)' }
        }
      }
    }
  });
})();

// ---- Enjeux « élevés » par axe (Doughnut) ----
(function(){
  const ctx = document.getElementById('chartEnjeuxSeverite');
  if(!ctx) return;
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Politique', 'Économique', 'Socioculturel', 'Technologique', 'Environnemental', 'Légal'],
      datasets: [{
        data: [10, 8, 6, 22, 9, 18], // % d’enjeux élevés (statique)
        backgroundColor: [
          '#0d6efd','#20c997','#6c757d','#6610f2','#198754','#dc3545'
        ]
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'bottom' } },
      cutout: '55%'
    }
  });
})();


// Analyse PESTEL chart
// ---- SWOT : Répartition statique ----
(function(){
  const ctx = document.getElementById('swotChart');
  if(!ctx) return;
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Forces', 'Faiblesses', 'Opportunités', 'Menaces'],
      datasets: [{
        data: [6, 4, 5, 3], // statique
        backgroundColor: ['#198754','#dc3545','#0d6efd','#ffc107']
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' }
      },
      cutout: '55%'
    }
  });
})();

// ---- PESTEL : Radar ----
(function(){
  const ctx = document.getElementById('pestelChart');
  if(!ctx) return;
  new Chart(ctx, {
    type: 'radar',
    data: {
      labels: ['Politique','Économique','Socioculturel','Technologique','Environnemental','Légal'],
      datasets: [{
        label: 'Influence',
        data: [6, 8, 5, 9, 7, 8],
        backgroundColor: 'rgba(13,110,253,0.2)',
        borderColor: '#0d6efd',
        pointBackgroundColor: '#0d6efd'
      }]
    },
    options: {
      scales: {
        r: {
          suggestedMin: 0,
          suggestedMax: 10,
          ticks: { stepSize: 2 }
        }
      }
    }
  });
})();


// ---- Matrice Risques : Probabilité / Impact ----
(function(){
  const ctx = document.getElementById('riskMatrixChart');
  if(!ctx) return;

  new Chart(ctx, {
    type: 'bubble',
    data: {
      datasets: [
        {
          label: 'Panne équipement critique',
          data: [{ x: 5, y: 5, r: 15 }], // Impact 5, Probabilité 5
          backgroundColor: 'rgba(220,53,69,0.7)' // rouge
        },
        {
          label: 'Non-conformité fournisseur',
          data: [{ x: 4, y: 3, r: 12 }], // Impact 4, Probabilité 3
          backgroundColor: 'rgba(255,193,7,0.7)' // orange
        },
        {
          label: 'Opportunité : Nouveaux marchés',
          data: [{ x: 4, y: 2, r: 10 }], // Impact 4, Probabilité 2
          backgroundColor: 'rgba(25,135,84,0.7)' // vert
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' },
        tooltip: {
          callbacks: {
            label: (ctx) => {
              const d = ctx.raw;
              return `${ctx.dataset.label} — Impact: ${d.x}, Probabilité: ${d.y}`;
            }
          }
        }
      },
      scales: {
        x: {
          title: { display: true, text: 'Impact' },
          min: 0, max: 5, ticks: { stepSize: 1 },
          grid: { color: 'rgba(0,0,0,0.05)' }
        },
        y: {
          title: { display: true, text: 'Probabilité' },
          min: 0, max: 5, ticks: { stepSize: 1 },
          grid: { color: 'rgba(0,0,0,0.05)' }
        }
      }
    }
  });
})();



// ---- RACI : Répartition des rôles ----
(function(){
  const ctx = document.getElementById('raciChart');
  if(!ctx) return;
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Responsable (R)', 'Approbateur (A)', 'Consulté (C)', 'Informé (I)'],
      datasets: [{
        label: 'Occurrences',
        data: [5, 5, 5, 5], // statique pour l’exemple
        backgroundColor: ['#0d6efd','#198754','#ffc107','#dc3545']
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false }
      },
      scales: {
        y: { beginAtZero: true, ticks: { stepSize: 1 } }
      }
    }
  });
})();


// Risques chart
// Graphique Risques
const ctxRisques = document.getElementById('risquesChart').getContext('2d');
new Chart(ctxRisques, {
  type: 'bar',
  data: {
    labels: ['Panne équipement', 'Non-conformité fournisseur', 'Nouveaux marchés'],
    datasets: [{
      label: 'Criticité',
      data: [9, 6, 3],
      backgroundColor: ['#dc3545', '#ffc107', '#198754']
    }]
  },
  options: {
    responsive: true,
    scales: {
      y: { beginAtZero: true, max: 10 }
    }
  }
});

// ---- Objectifs : Cible vs Réalisation ----
(function(){
  const ctx = document.getElementById('objectifsChart');
  if(!ctx) return;
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Satisfaction client', 'Non-conformités', 'Formation employés'],
      datasets: [
        {
          label: 'Cible',
          data: [90, 2, 100],
          backgroundColor: 'rgba(13,110,253,0.5)'
        },
        {
          label: 'Réalisation',
          data: [82, 1.5, 65],
          backgroundColor: 'rgba(25,135,84,0.7)'
        }
      ]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true, max: 100 }
      }
    }
  });
})();

// ---- Objectifs : Jauge globale ----
(function(){
  const ctx = document.getElementById('objectifGauge');
  if(!ctx) return;
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Atteints', 'En cours', 'À renforcer'],
      datasets: [{
        data: [1, 1, 1], // exemple basé sur 3 objectifs
        backgroundColor: ['#198754', '#ffc107', '#dc3545']
      }]
    },
    options: {
      responsive: true,
      cutout: '70%',
      plugins: {
        legend: { position: 'bottom' },
        tooltip: { enabled: true }
      }
    }
  });
})();


// ---- Répartition documents par type ----
(function(){
  const ctx = document.getElementById('docsChart');
  if(!ctx) return;
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Procédures', 'Politiques', 'Modes opératoires', 'Rapports'],
      datasets: [{
        data: [1, 1, 1, 1], // exemple
        backgroundColor: ['#0d6efd','#20c997','#ffc107','#dc3545']
      }]
    },
    options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
  });
})();

// ---- Répartition documents par statut ----
(function(){
  const ctx = document.getElementById('docsStatusChart');
  if(!ctx) return;
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Validé', 'Diffusé', 'En révision', 'Obsolète'],
      datasets: [{
        label: 'Nombre de documents',
        data: [1, 1, 1, 1], // exemple
        backgroundColor: ['#198754','#0dcaf0','#ffc107','#dc3545']
      }]
    },
    options: {
      responsive: true,
      scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
    }
  });
})();


// Graphique Équipements
document.addEventListener('DOMContentLoaded', function() {
  const calendarEl = document.getElementById('maintenanceCalendar');
  if(!calendarEl) return;

  const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'fr',
    height: 'auto',
    themeSystem: 'bootstrap5',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,listWeek'
    },
    buttonText: {
      today: 'Aujourd’hui',
      month: 'Mois',
      week: 'Semaine'
    },
    events: [
      { title: 'Maintenance préventive - Machine A', start: '2023-09-11', color: '#198754' },
      { title: 'Calibration - Balance précision', start: '2023-09-03', color: '#ffc107', textColor: '#000' },
      { title: 'Réparation - Compresseur', start: '2023-09-19', color: '#dc3545' }
    ]
  });

  calendar.render();
});



// Graphique Audits
// ---- Histogramme constats par audit ----
(function(){
  const ctx = document.getElementById('auditsChart');
  if(!ctx) return;
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Production', 'RH & Formation', 'Achats & Fournisseurs'],
      datasets: [
        { label: 'NC majeures', data: [2, 0, 1], backgroundColor: '#dc3545' },
        { label: 'NC mineures', data: [1, 0, 0], backgroundColor: '#ffc107' },
        { label: 'Pistes', data: [0, 0, 2], backgroundColor: '#20c997' }
      ]
    },
    options: { responsive: true, scales: { y: { beginAtZero: true } } }
  });
})();

// ---- Donut répartition constats ----
(function(){
  const ctx = document.getElementById('auditsPieChart');
  if(!ctx) return;
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['NC majeures', 'NC mineures', 'Pistes'],
      datasets: [{
        data: [3, 1, 2],
        backgroundColor: ['#dc3545','#ffc107','#20c997']
      }]
    },
    options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
  });
})();


// Graphique CAPA - avancement des actions
// ---- CAPA : Avancement des actions (barres horizontales) ----
(function(){
  const ctx = document.getElementById('capaChart');
  if(!ctx) return;
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['NC-001', 'NC-002', 'CAPA-003'],
      datasets: [{
        label: 'Avancement (%)',
        data: [30, 100, 20], // valeurs fictives (exemple)
        backgroundColor: ['#dc3545','#198754','#0d6efd']
      }]
    },
    options: {
      indexAxis: 'y',
      responsive: true,
      plugins: { legend: { display: false } },
      scales: {
        x: { beginAtZero: true, max: 100, ticks: { callback: v => v + "%" } }
      }
    }
  });
})();

// ---- CAPA : Répartition Correctives / Préventives ----
(function(){
  const ctx = document.getElementById('capaTypeChart');
  if(!ctx) return;
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Correctives', 'Préventives'],
      datasets: [{
        data: [2, 1], // ex: 2 correctives, 1 préventive
        backgroundColor: ['#dc3545','#0d6efd']
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' }
      },
      cutout: '60%'
    }
  });
})();


// Graphique Analyse prédictive
// ---- IA : Prévision des tendances ----
(function(){
  const ctx = document.getElementById('iaForecastChart');
  if(!ctx) return;
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Prévision Sept', 'Prévision Oct'],
      datasets: [
        {
          label: 'Taux de non-conformités (%)',
          data: [2.1, 1.9, 2.3, 1.8, 1.6, 1.5, 1.4, 1.3, 1.2, 1.1],
          borderColor: '#dc3545',
          backgroundColor: 'rgba(220, 53, 69, 0.2)',
          tension: 0.3,
          fill: true
        },
        {
          label: 'Prévision satisfaction client (%)',
          data: [78, 80, 81, 83, 85, 86, 87, 88, 90, 92],
          borderColor: '#0d6efd',
          backgroundColor: 'rgba(13,110,253,0.15)',
          tension: 0.3,
          fill: true
        }
      ]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'bottom' } },
      scales: {
        y: { beginAtZero: true, max: 100, ticks: { callback: v => v + "%" } }
      }
    }
  });
})();

// ---- IA : Répartition des risques prédits ----
(function(){
  const ctx = document.getElementById('iaRiskChart');
  if(!ctx) return;
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Processus', 'Fournisseurs', 'Clients', 'Ressources Humaines'],
      datasets: [{
        data: [35, 25, 20, 20], // % de risques prédits (exemple statique)
        backgroundColor: ['#dc3545','#ffc107','#0d6efd','#198754']
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' },
        tooltip: { callbacks: { label: ctx => ctx.label + ": " + ctx.parsed + "%" } }
      },
      cutout: '60%'
    }
  });
})();

// ---- Dashboard : Avancement des modules (barres horizontales) ----
(function(){
  const ctx = document.getElementById('modulesProgressChart');
  if(!ctx) return;

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        'Contexte & Parties Intéressées',
        'Leadership & Gouvernance',
        'Planification & Risques',
        'Soutien & Ressources',
        'Opérations & Audits',
        'CAPA / Non-conformités',
        'Amélioration & IA'
      ],
      datasets: [{
        label: 'Avancement (%)',
        data: [100, 60, 20, 50, 100, 40, 10], // valeurs fictives (à remplacer par données réelles)
        backgroundColor: [
          '#198754', // Contexte
          '#ffc107', // Leadership
          '#6c757d', // Planification
          '#0dcaf0', // Ressources
          '#198754', // Audits
          '#dc3545', // CAPA
          '#6c757d'  // IA
        ]
      }]
    },
    options: {
      indexAxis: 'y',
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: { callbacks: { label: ctx => ctx.parsed.x + "%" } }
      },
      scales: {
        x: { beginAtZero: true, max: 100, ticks: { callback: v => v + "%" } }
      }
    }
  });
})();

// ---- Dashboard : Répartition des statuts (doughnut) ----
(function(){
  const ctx = document.getElementById('modulesStatusChart');
  if(!ctx) return;

  // Exemple fictif basé sur la liste modules
  const data = {
    labels: ['Terminés', 'En cours', 'À faire'],
    datasets: [{
      data: [2, 3, 2], // nb modules par statut (exemple)
      backgroundColor: ['#198754','#ffc107','#6c757d']
    }]
  };

  new Chart(ctx, {
    type: 'doughnut',
    data: data,
    options: {
      responsive: true,
      cutout: '65%',
      plugins: {
        legend: { position: 'bottom' },
        tooltip: {
          callbacks: {
            label: ctx => ctx.label + ": " + ctx.parsed + " modules"
          }
        }
      }
    }
  });
})();

  </script>
</body>
</html>
