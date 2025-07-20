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

   .status-tag {
  padding: 5px 10px;
  font-size: 0.75rem;
  font-weight: 600;
  border-radius: 20px;
  display: inline-block;
}

.status-inactif {
  background-color: #ffe5e5; /* rouge clair */
  color: #d62c2c;           /* rouge foncé */
  border: 1px solid #d62c2c33;
}

.status-actif {
  background-color: #e6f4ea; /* vert clair */
  color: #2c7d32;            /* vert foncé */
  border: 1px solid #2c7d3233;
}

.card {
  border-radius: 15px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: default;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.15);
}

.card .card-body i {
  transition: transform 0.3s ease;
}

.card:hover .card-body i {
  transform: scale(1.2);
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

  <!-- Filtre client -->
  <div class="mb-4">
    <label for="clientFilter" class="form-label fw-bold">Filtrer par client :</label>
    <select id="clientFilter" class="form-select" onchange="filterDashboard()">
      <option value="all">Tous les clients</option>
      @foreach(\App\Models\Client::all() as $client)
        <option value="{{ $client->id }}">{{ $client->company }}</option>
      @endforeach
    </select>
  </div>

  <!-- Cards -->
  <div class="row" id="dashboardCards">
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm border-primary">
        <div class="card-body text-center text-primary">
          <i class="bi bi-building fs-1"></i>
          <h5 class="card-title mt-3">Clients</h5>
          <p class="card-text fs-2 fw-bold" id="totalClients">{{ $totalClients ?? 0 }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm border-success">
        <div class="card-body text-center text-success">
          <i class="bi bi-people fs-1"></i>
          <h5 class="card-title mt-3">Utilisateurs</h5>
          <p class="card-text fs-2 fw-bold" id="totalUsers">{{ $totalUsers ?? 0 }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm border-info">
        <div class="card-body text-center text-info">
          <i class="bi bi-receipt fs-1"></i>
          <h5 class="card-title mt-3">Abonnements</h5>
          <p class="card-text fs-2 fw-bold" id="totalSubscriptions">{{ $totalSubscriptions ?? 0 }}</p>
        </div>
      </div>
    </div>
  </div>
</div>



    <div id="clients" class="section">
      <h2>Clients</h2>
      <!-- Bouton Ajouter -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addClientModal">
  <i class="bi bi-plus-circle"></i> Ajouter un client
</button>

<!-- Modal -->
<div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('admin.clients.store') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addClientModalLabel">Ajouter un client</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Nom de l'entreprise</label>
            <input type="text" name="company" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Contact</label>
            <input type="text" name="phone" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Enregistrer</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        </div>
      </div>
    </form>
  </div>
</div>

      <div class="table-responsive">
        <table class="table table-striped">
         <thead class="table-light">
  <tr>
    <th>Entreprise</th>
    <th>Email</th>
    <th>Contact</th>
    <th>Statut</th>
    <th>Actions</th>
  </tr>
</thead>

<tbody>
@foreach(\App\Models\Client::all() as $client)
<tr>
  <td>{{ $client->company }}</td>
  <td>{{ $client->email }}</td>
  <td>{{ $client->phone }}</td>
  <td>
  @if ($client->status === 'Actif')
    <span class="status-tag status-actif">{{ $client->status }}</span>
  @else
    <span class="status-tag status-inactif">{{ $client->status }}</span>
  @endif
</td>

  <td>
    <!-- Bouton Modifier -->
    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editClientModal{{ $client->id }}">
      <i class="bi bi-pencil-square"></i>
    </button>

    <!-- Bouton Supprimer -->
    <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce client ?');">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-sm btn-danger">
        <i class="bi bi-trash"></i>
      </button>
    </form>
  </td>
</tr>

<!-- Modal Édition -->
<div class="modal fade" id="editClientModal{{ $client->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('admin.clients.update', $client) }}">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modifier le client</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Entreprise</label>
            <input type="text" name="company" class="form-control" value="{{ $client->company }}" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $client->email }}" required>
          </div>
          <div class="mb-3">
            <label>Contact</label>
            <input type="text" name="phone" class="form-control" value="{{ $client->phone }}" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Mettre à jour</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endforeach
</tbody>


        </table>
      </div>
    </div>

    <div id="users" class="section">
      <h2>Utilisateurs</h2>
      <!-- Bouton Ajouter -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
  <i class="bi bi-plus-circle"></i> Ajouter un utilisateur
</button>

<!-- Modal Ajout -->
<div class="modal fade" id="addUserModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('users.store') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajouter un utilisateur</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Entreprise</label>
            <select name="client_id" class="form-select" required>
              <option value="">-- Choisir --</option>
              @foreach(\App\Models\Client::all() as $client)
                <option value="{{ $client->id }}">{{ $client->company }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label>Nom complet</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Fonction</label>
            <input type="text" name="function" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" type="submit">Enregistrer</button>
        </div>
      </div>
    </form>
  </div>
</div>


      <div class="table-responsive">
        <table class="table table-striped">
  <thead class="table-light">
    <tr>
      <th>Nom</th>
      <th>Fonction</th>
      <th>Email</th>
      <th>Entreprise</th>
      <th>Dernière connexion</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach(\App\Models\User::with('client')->get() as $user)
    <tr>
      <td>{{ $user->name }}</td>
      <td>{{ $user->function }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->client->company ?? '-' }}</td>
      <td>
{{ $user->last_login_at ? \Carbon\Carbon::parse($user->last_login_at)->format('d/m/Y H:i') : 'Jamais' }}
</td>

      <td>
        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}"><i class="bi bi-pencil"></i></button>
        <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline" onsubmit="return confirm('Supprimer cet utilisateur ?')">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
        </form>
      </td>
      
    </tr>

    <!-- Modal Édition -->
    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
      <div class="modal-dialog">
        <form method="POST" action="{{ route('users.update', $user) }}">
          @csrf @method('PUT')
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modifier utilisateur</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label>Entreprise</label>
                <select name="client_id" class="form-select" required>
                  @foreach(\App\Models\Client::all() as $client)
                    <option value="{{ $client->id }}" {{ $client->id == $user->client_id ? 'selected' : '' }}>{{ $client->company }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label>Nom complet</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
              </div>
              <div class="mb-3">
                <label>Fonction</label>
                <input type="text" name="function" class="form-control" value="{{ $user->function }}" required>
              </div>
              <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" type="submit">Mettre à jour</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    @endforeach
  </tbody>
</table>

      </div>
    </div>

    <div id="billing" class="section">
      <h2>Abonnements</h2>

<!-- Bouton Ajouter -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addSubscriptionModal">
  <i class="bi bi-plus-circle"></i> Ajouter un abonnement
</button>

<!-- Modal Ajout -->
<div class="modal fade" id="addSubscriptionModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('subscriptions.store') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajouter un abonnement</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Client</label>
            <select name="client_id" class="form-select" required>
              @foreach(\App\Models\Client::all() as $client)
                <option value="{{ $client->id }}">{{ $client->company }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label>Plan</label>
            <input type="text" name="plan" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Début</label>
            <input type="date" name="start_date" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Fin</label>
            <input type="date" name="end_date" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success">Enregistrer</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Liste abonnements -->
<div class="table-responsive">
  <table class="table table-striped">
    <thead class="table-light">
      <tr>
        <th>Client</th>
        <th>Plan</th>
        <th>Début</th>
        <th>Fin</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach(\App\Models\Subscription::with('client')->get() as $sub)
        <tr>
          <td>{{ $sub->client->company }}</td>
          <td>{{ $sub->plan }}</td>
          <td>{{ $sub->start_date }}</td>
          <td>{{ $sub->end_date }}</td>
          <td>
            <!-- Modifier -->
            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editSubModal{{ $sub->id }}"><i class="bi bi-pencil"></i></button>

            <!-- Supprimer -->
            <form action="{{ route('subscriptions.destroy', $sub) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cet abonnement ?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
            </form>
          </td>
        </tr>

        <!-- Modal Modifier -->
        <div class="modal fade" id="editSubModal{{ $sub->id }}" tabindex="-1">
          <div class="modal-dialog">
            <form method="POST" action="{{ route('subscriptions.update', $sub) }}">
              @csrf @method('PUT')
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Modifier abonnement</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label>Plan</label>
                    <input type="text" name="plan" class="form-control" value="{{ $sub->plan }}">
                  </div>
                  <div class="mb-3">
                    <label>Début</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $sub->start_date }}">
                  </div>
                  <div class="mb-3">
                    <label>Fin</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $sub->end_date }}">
                  </div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-success">Mettre à jour</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      @endforeach
    </tbody>
  </table>
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

    function filterDashboard() {
  const clientId = document.getElementById('clientFilter').value;

  fetch(`/admin/dashboard-data?client_id=${clientId}`, {
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(response => response.json())
  .then(data => {
    document.getElementById('totalClients').textContent = data.totalClients;
    document.getElementById('totalUsers').textContent = data.totalUsers;
    document.getElementById('totalSubscriptions').textContent = data.totalSubscriptions;
  })
  .catch(error => {
    console.error('Erreur lors de la récupération des données:', error);
  });
}

document.addEventListener('DOMContentLoaded', () => {
  filterDashboard();
});



  </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
