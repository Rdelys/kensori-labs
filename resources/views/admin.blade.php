<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel Responsive</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: system-ui, sans-serif;
      background-color: #f7fafc;
      margin: 0;
    }

    .sidebar {
      width: 250px;
      height: 100vh;
      position: fixed;
      background-color: #ffffff;
      box-shadow: 2px 0 15px rgba(0, 0, 0, 0.05);
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 30px 0;
      border-right: 1px solid #e4e9f0;
      z-index: 1030;
    }

    .sidebar img {
      width: 110px;
      margin-bottom: 40px;
      border-radius: 12px;
    }

    .nav-links {
      display: flex;
      flex-direction: column;
      gap: 15px;
      width: 100%;
      padding: 0 30px;
      flex-grow: 1;
    }

    .nav-link {
      color: #0d2b47;
      background-color: #edf3f9;
      border-radius: 12px;
      padding: 12px 15px;
      font-size: 0.95rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 12px;
      transition: 0.3s ease;
      text-decoration: none;
    }

    .nav-link:hover,
    .nav-link.active {
      background-color: #0d2b47;
      color: white;
    }

    .logout-form {
      padding: 0 30px 30px 30px;
      width: 100%;
      border-top: 1px solid #e4e9f0;
    }

    .logout-button {
      width: 100%;
      background-color: #e03e2f;
      color: white;
      border: none;
      border-radius: 12px;
      padding: 12px 15px;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      transition: background-color 0.3s ease;
    }

    .logout-button:hover {
      background-color: #b73027;
    }

    .main {
      margin-left: 250px;
      padding: 40px;
      min-height: 100vh;
      background-color: #f7fafc;
    }

    @media (max-width: 767px) {
      .sidebar {
        position: fixed;
        top: 0;
        left: -250px;
        transition: left 0.3s ease;
      }

      .sidebar.open {
        left: 0;
      }

      .main {
        margin-left: 0;
        padding: 80px 20px 20px 20px;
      }
    }

    .section {
      display: none;
    }

    .section.active {
      display: block;
      animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h2 {
      color: #0d2b47;
      font-size: 1.6rem;
      margin-bottom: 20px;
      border-bottom: 2px solid #dbe6f2;
      padding-bottom: 10px;
    }

    table {
      background: white;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    th, td {
      font-size: 0.95rem;
    }

    .mobile-nav-toggle {
      position: fixed;
      top: 15px;
      left: 15px;
      z-index: 1040;
      background: #0d2b47;
      color: white;
      border: none;
      padding: 10px 12px;
      border-radius: 8px;
      display: none;
    }

    @media (max-width: 767px) {
      .mobile-nav-toggle {
        display: block;
      }
    }
  </style>
</head>
<body>

  <!-- Bouton Toggle mobile -->
  <button class="mobile-nav-toggle" onclick="toggleSidebar()">
    <i class="bi bi-list"></i>
  </button>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <img src="logo.png" alt="Logo">
    <div class="nav-links">
      <a href="#" class="nav-link active" onclick="switchTab('dashboard')"><i class="bi bi-speedometer2"></i> Dashboard</a>
      <a href="#" class="nav-link" onclick="switchTab('clients')"><i class="bi bi-building"></i> Clients</a>
      <a href="#" class="nav-link" onclick="switchTab('users')"><i class="bi bi-people"></i> Utilisateurs</a>
      <a href="#" class="nav-link" onclick="switchTab('billing')"><i class="bi bi-receipt"></i> Abonnements</a>
      <a href="#" class="nav-link" onclick="switchTab('metrics')"><i class="bi bi-bar-chart"></i> Métriques</a>
      <a href="#" class="nav-link" onclick="switchTab('health')"><i class="bi bi-activity"></i> Système</a>
      <a href="#" class="nav-link" onclick="switchTab('support')"><i class="bi bi-chat-dots"></i> Support</a>
      <a href="#" class="nav-link" onclick="switchTab('settings')"><i class="bi bi-gear"></i> Paramètres</a>
    </div>
    
    <!-- Formulaire de déconnexion -->
    <form method="POST" action="{{ route('admin.logout') }}" class="logout-form">
      @csrf
      <button type="submit" class="logout-button">
        <i class="bi bi-box-arrow-right"></i> Déconnexion
      </button>
    </form>
  </div>

  <!-- Contenu principal -->
  <div class="main">
    <div id="dashboard" class="section active">
      <h2>Dashboard</h2>
      <p>Bienvenue dans le panneau d'administration.</p>
    </div>

    <div id="clients" class="section">
      <h2>Clients</h2>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Entreprise</th>
              <th>Email</th>
              <th>Contact</th>
              <th>Utilisateurs</th>
              <th>Plan</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Acme Corp</td>
              <td>contact@acme.com</td>
              <td>+261 32 12 345 67</td>
              <td>12</td>
              <td>Enterprise</td>
            </tr>
            <tr>
              <td>StartUp X</td>
              <td>hello@startupx.io</td>
              <td>+261 34 56 789 01</td>
              <td>3</td>
              <td>Pro</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div id="users" class="section">
      <h2>Utilisateurs</h2>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Email</th>
              <th>Inscription</th>
              <th>Connexion</th>
              <th>Plan</th>
              <th>Statut</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>Jean Dupont</td><td>jean@example.com</td><td>01/01/2024</td><td>06/07/2025</td><td>Pro</td><td>Actif</td></tr>
            <tr><td>Alice Martin</td><td>alice@example.com</td><td>03/03/2024</td><td>05/07/2025</td><td>Free</td><td>Essai</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <div id="billing" class="section">
      <h2>Abonnements</h2>
      <ul>
        <li>Plan : Pro</li>
        <li>Renouvellement : 01/08/2025</li>
        <li>Derniers paiements : Juin, Mai</li>
        <li>Statut : Payé</li>
      </ul>
    </div>

    <div id="metrics" class="section">
      <h2>Métriques</h2>
      <ul>
        <li><strong>MRR :</strong> 1 200 €</li>
        <li><strong>ARR :</strong> 14 400 €</li>
        <li><strong>Churn :</strong> 3.2%</li>
        <li><strong>Utilisateurs actifs :</strong> 234/mois</li>
      </ul>
    </div>

    <div id="health" class="section">
      <h2>Système</h2>
      <ul>
        <li>API : ✅</li>
        <li>Base de données : ✅</li>
        <li>Jobs : ✅</li>
        <li>Temps de réponse : 120ms</li>
      </ul>
    </div>

    <div id="support" class="section">
      <h2>Support</h2>
      <p>Aucun ticket actif.</p>
    </div>

    <div id="settings" class="section">
      <h2>Paramètres</h2>
      <ul>
        <li>Feature Flags : ✅ BETA-DASH</li>
        <li>Plans modifiables</li>
        <li>FAQ : 12 articles</li>
      </ul>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    function switchTab(id) {
      document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
      document.getElementById(id).classList.add('active');

      document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
      const activeLink = Array.from(document.querySelectorAll('.nav-link')).find(a => a.onclick.toString().includes(id));
      if (activeLink) activeLink.classList.add('active');

      if (window.innerWidth < 768) {
        document.getElementById('sidebar').classList.remove('open');
      }
    }

    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('open');
    }
  </script>

</body>
</html>
