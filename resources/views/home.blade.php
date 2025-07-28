<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion utilisateur</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #2c3e50, #34495e); /* dégradé de gris et noir */
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      color: #fff;
    }
    .card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 380px;
      padding: 40px;
      animation: fadeInUp 0.8s ease-out forwards;
    }
    h4 {
      font-size: 1.8rem;
      text-align: center;
      margin-bottom: 30px;
      color: #333;
      font-weight: 700;
    }
    .form-control {
      border-radius: 8px;
      border: 1px solid #ccc;
      padding: 12px 18px;
      font-size: 1rem;
      transition: all 0.3s ease;
    }
    .form-control:focus {
      border-color: #444;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    }
    .btn-primary {
      background-color: #34495e; /* Gris foncé */
      border: none;
      padding: 14px;
      font-size: 1.1rem;
      border-radius: 8px;
      width: 100%;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
      background-color: #2c3e50; /* Gris plus foncé au survol */
    }
    .alert-danger {
      font-size: 0.875rem;
      background-color: rgba(255, 0, 0, 0.1);
      color: #ff4d4d;
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    /* Animation */
    @keyframes fadeInUp {
      0% {
        transform: translateY(100px);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }
  </style>
</head>
<body>
  <div class="card shadow">
    <h4>Connexion utilisateur</h4>

    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('user.login') }}">
      @csrf
      <div class="mb-4">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email" required>
      </div>
      <div class="mb-4">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" name="password" class="form-control" id="password" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Se connecter</button>
    </form>
  </div>
</body>
</html>
