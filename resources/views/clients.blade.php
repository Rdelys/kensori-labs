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
  </style>
</head>
<body>
  <div class="sidebar">
    <h5>Bienvenue, {{ $user->name }}</h5>
    <p>Entreprise : <strong>{{ $user->client->company ?? 'Inconnue' }}</strong></p>
    <hr>

    <a href="#" class="nav-link"><i class="bi bi-house-door me-2"></i>Tableau de bord</a>

    <hr class="my-3">
    <p class="text-muted small mb-1">Modules QMS</p>
<a href="{{ route('modules.parties') }}" class="nav-link"><i class="bi bi-people me-2"></i>Parties intéressées</a>
    <a href="#" class="nav-link"><i class="bi bi-bar-chart-line me-2"></i>Analyse SWOT / PESTEL</a>
    <a href="#" class="nav-link"><i class="bi bi-award me-2"></i>Politique Qualité</a>
    <a href="#" class="nav-link"><i class="bi bi-diagram-3 me-2"></i>Matrice RACI</a>
    <a href="#" class="nav-link"><i class="bi bi-exclamation-triangle me-2"></i>Risques & Opportunités</a>
    <a href="#" class="nav-link"><i class="bi bi-bullseye me-2"></i>Objectifs Qualité</a>
    <a href="#" class="nav-link"><i class="bi bi-file-earmark-text me-2"></i>Documents & Versions</a>
    <a href="#" class="nav-link"><i class="bi bi-gear-wide-connected me-2"></i>Équipements & Maintenance</a>
    <a href="#" class="nav-link"><i class="bi bi-shield-check me-2"></i>Audits internes</a>
    <a href="#" class="nav-link"><i class="bi bi-lightbulb me-2"></i>CAPA / Non-conformités</a>
    <a href="#" class="nav-link"><i class="bi bi-cpu me-2"></i>Analyse prédictive</a>

    <hr class="my-3">
    <a href="{{ route('user.logout') }}" class="btn btn-sm btn-outline-danger mt-2 w-100">
      <i class="bi bi-box-arrow-right me-1"></i> Se déconnecter
    </a>
  </div>

  <div class="content">
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
</body>
</html>
