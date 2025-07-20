<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Tableau de bord</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background: #f5f7fb;
      display: flex;
      min-height: 100vh;
    }

    .sidebar {
      width: 260px;
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

    .sidebar a.btn {
      font-size: 14px;
      border-radius: 8px;
      padding: 10px 15px;
      text-align: center;
      transition: background-color 0.2s ease;
      display: block;
      width: 100%;
      margin-bottom: 10px;
    }

    .sidebar a.btn:hover {
      background-color: #2d4c73;
      color: white;
    }

    .sidebar a.btn-outline-primary {
      border: 1px solid #1d3557;
      background-color: transparent;
      color: #1d3557;
    }

    .sidebar a.btn-outline-primary:hover {
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
    <a href="#" class="btn btn-outline-primary">Nouvelle action</a>
    <hr>
    <a href="{{ route('user.logout') }}" class="btn btn-primary">Se déconnecter</a>

    <!-- Bouton secondaire d'exemple -->
  </div>

  <div class="content">
    <h2>Tableau de bord utilisateur</h2>
    <div class="row g-4">
      <div class="col-md-6 col-lg-4">
        <div class="card p-4">
          <h6 class="mb-2">Statut actuel</h6>
          <p class="info-text">Contenu réservé à l'utilisateur ici...</p>
        </div>
      </div>
      <!-- Vous pouvez ajouter d'autres cartes ici -->
    </div>
  </div>
</body>
</html>
