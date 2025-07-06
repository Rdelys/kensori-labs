<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f7fafc;
      font-family: system-ui, sans-serif;
    }
    .login-box {
      max-width: 400px;
      margin: 100px auto;
      background: white;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    h2 {
      font-size: 1.6rem;
      color: #0d2b47;
      text-align: center;
      margin-bottom: 25px;
    }
    .btn-primary {
      background-color: #0d2b47;
      border: none;
    }
    .btn-primary:hover {
      background-color: #0b2237;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Connexion Admin</h2>
    @if($errors->any())
      <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="{{ route('admin.login.submit') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">Login</label>
        <input type="text" name="login" class="form-control" required autofocus>
      </div>
      <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="remember" id="remember">
        <label class="form-check-label" for="remember">Se souvenir de moi</label>
        </div>

      <button type="submit" class="btn btn-primary w-100">Connexion</button>
    </form>
  </div>
</body>
</html>
