<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    /* ======== BACKGROUND ======== */
    body {
      background: radial-gradient(circle at top left, #0d2b47, #112f54, #193d67, #102c49);
      min-height: 100vh;
      font-family: "Inter", system-ui, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      margin: 0;
      position: relative;
      color: #fff;
    }

    /* Cercles de lumière décoratifs */
    body::before, body::after {
      content: "";
      position: absolute;
      border-radius: 50%;
      filter: blur(120px);
      opacity: 0.5;
      z-index: 0;
    }
    body::before {
      width: 400px;
      height: 400px;
      top: -100px;
      left: -100px;
      background: #00b4db;
    }
    body::after {
      width: 450px;
      height: 450px;
      bottom: -120px;
      right: -100px;
      background: #0083b0;
    }

    /* ======== BOX ======== */
    .login-box {
      width: 100%;
      max-width: 420px;
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(18px);
      border: 1px solid rgba(255, 255, 255, 0.15);
      padding: 45px 40px;
      border-radius: 22px;
      box-shadow: 0 15px 60px rgba(0, 0, 0, 0.25);
      animation: fadeIn 1s ease;
      z-index: 2;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }

    /* ======== TITLE ======== */
    .login-icon {
      text-align: center;
      font-size: 60px;
      color: #00b4db;
      margin-bottom: 15px;
      text-shadow: 0 0 15px rgba(0,180,219,0.5);
    }

    h2 {
      font-size: 1.9rem;
      font-weight: 700;
      text-align: center;
      margin-bottom: 35px;
      letter-spacing: 0.5px;
      color: #fff;
    }

    /* ======== INPUTS ======== */
    .form-label {
      font-weight: 600;
      color: #cfd9e5;
      margin-bottom: 6px;
    }

    .form-control {
      border-radius: 12px;
      padding: 11px 14px;
      background: rgba(255,255,255,0.12);
      border: 1px solid rgba(255,255,255,0.2);
      color: #fff;
      transition: all 0.3s ease;
    }

    .form-control::placeholder {
      color: #cfd9e5;
      opacity: 0.7;
    }

    .form-control:focus {
      border-color: #00b4db;
      background: rgba(255,255,255,0.18);
      box-shadow: 0 0 0 0.25rem rgba(0,180,219,0.25);
    }

    .form-check-label {
      color: #cfd9e5;
      font-size: 0.9rem;
    }

    /* ======== BUTTON ======== */
    .btn-primary {
      background: linear-gradient(135deg, #00b4db, #0083b0);
      border: none;
      border-radius: 12px;
      font-weight: 600;
      letter-spacing: 0.4px;
      padding: 11px 0;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0,180,219,0.35);
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, #00c6ff, #0072ff);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,180,219,0.45);
    }

    .alert {
      border-radius: 10px;
      font-weight: 500;
      text-align: center;
      margin-bottom: 20px;
      background: rgba(255,0,0,0.1);
      border: 1px solid rgba(255,0,0,0.3);
      color: #ff7f7f;
    }

    /* ======== FOOTER ======== */
    .footer-text {
      text-align: center;
      margin-top: 25px;
      font-size: 0.85rem;
      color: #a8b4c9;
    }

    .footer-text a {
      color: #00b4db;
      text-decoration: none;
      font-weight: 500;
    }

    .footer-text a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <div class="login-icon">
      <i class="fa-solid fa-user-shield"></i>
    </div>
    <h2>Connexion Admin</h2>
    @if($errors->any())
      <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">Login</label>
        <input type="text" name="login" class="form-control" placeholder="Entrez votre identifiant" required autofocus>
      </div>
      <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" name="password" class="form-control" placeholder="••••••••••" required>
      </div>
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="remember" id="remember">
        <label class="form-check-label" for="remember">Se souvenir de moi</label>
      </div>

      <button type="submit" class="btn btn-primary w-100">
        <i class="fa-solid fa-lock me-2"></i>Connexion
      </button>
    </form>

    <div class="footer-text mt-4">
      © 2025 Kensori Labs — <a href="#">Tous droits réservés</a>
    </div>
  </div>
</body>
</html>
