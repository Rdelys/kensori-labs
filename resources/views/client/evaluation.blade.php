@extends('layouts.clients')

@section('title', 'Évaluation fournisseurs')

@section('content')
<div class="container">
    <!-- En-tête avec bouton d'ajout -->
    <div class="page-header">
        <h1>Évaluation des fournisseurs</h1>
        <button class="btn btn-primary" id="btnNouvelleEvaluation">
            <i class="bi bi-plus-circle"></i> Nouvelle évaluation
        </button>
    </div>

    <!-- Cartes de synthèse -->
    <div class="cards-summary">
        <div class="summary-card">
            <div class="card-header primary-border">
                <i class="bi bi-building"></i>
            </div>
            <div class="card-content">
                <div class="card-title">Fournisseurs évalués</div>
                <div class="card-value">24</div>
                <div class="card-trend positive">+3 ce mois</div>
            </div>
        </div>

        <div class="summary-card">
            <div class="card-header success-border">
                <i class="bi bi-graph-up"></i>
            </div>
            <div class="card-content">
                <div class="card-title">Score moyen</div>
                <div class="card-value">8.4/10</div>
                <div class="card-trend neutral">+0.2 vs mois dernier</div>
            </div>
        </div>

        <div class="summary-card">
            <div class="card-header warning-border">
                <i class="bi bi-clock-history"></i>
            </div>
            <div class="card-content">
                <div class="card-title">En attente</div>
                <div class="card-value">5</div>
                <div class="card-link">
                    <a href="#" class="warning-link">Voir les détails</a>
                </div>
            </div>
        </div>

        <div class="summary-card">
            <div class="card-header danger-border">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
            <div class="card-content">
                <div class="card-title">Sous surveillance</div>
                <div class="card-value">3</div>
                <div class="card-badge danger-badge">Action requise</div>
            </div>
        </div>
    </div>

    <!-- Formulaire d'évaluation (caché par défaut) -->
    <div class="evaluation-form" id="formEvaluation">
        <div class="form-header">
            <div class="form-title">
                <i class="bi bi-clipboard-check"></i>
                <h2>Nouvelle évaluation de fournisseur</h2>
            </div>
            <button class="close-form-btn" id="btnFermerForm">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        
        <div class="form-body">
            <form id="evaluationForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="fournisseur" class="form-label">Fournisseur *</label>
                        <select class="form-control" id="fournisseur" required>
                            <option value="">Sélectionner un fournisseur</option>
                            <option value="1">ABC Technologies</option>
                            <option value="2">XYZ Materials</option>
                            <option value="3">Global Logistics</option>
                            <option value="4">Precision Parts Inc.</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="dateEvaluation" class="form-label">Date d'évaluation *</label>
                        <input type="date" class="form-control" id="dateEvaluation" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <!-- Section Critères d'évaluation -->
                <div class="form-section">
                    <h3 class="section-title">Critères d'évaluation</h3>
                    
                    <div class="table-container">
                        <table class="evaluation-table">
                            <thead>
                                <tr>
                                    <th>Critère</th>
                                    <th>Poids</th>
                                    <th>Note (0-10)</th>
                                    <th>Commentaire</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Qualité des produits/services</td>
                                    <td>30%</td>
                                    <td>
                                        <select class="form-control-sm note-critere" data-critere="qualite">
                                            <option value="0">0 - Non conforme</option>
                                            <option value="2">2</option>
                                            <option value="4">4</option>
                                            <option value="6">6 - Satisfaisant</option>
                                            <option value="8" selected>8 - Bon</option>
                                            <option value="10">10 - Excellent</option>
                                        </select>
                                    </td>
                                    <td>
                                        <textarea class="form-control-sm" rows="1" placeholder="Commentaire..."></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Délais de livraison</td>
                                    <td>25%</td>
                                    <td>
                                        <select class="form-control-sm note-critere" data-critere="delais">
                                            <option value="0">0 - Non conforme</option>
                                            <option value="2">2</option>
                                            <option value="4">4</option>
                                            <option value="6" selected>6 - Satisfaisant</option>
                                            <option value="8">8 - Bon</option>
                                            <option value="10">10 - Excellent</option>
                                        </select>
                                    </td>
                                    <td>
                                        <textarea class="form-control-sm" rows="1" placeholder="Commentaire..."></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Prix et compétitivité</td>
                                    <td>20%</td>
                                    <td>
                                        <select class="form-control-sm note-critere" data-critere="prix">
                                            <option value="0">0 - Non conforme</option>
                                            <option value="2">2</option>
                                            <option value="4">4</option>
                                            <option value="6">6 - Satisfaisant</option>
                                            <option value="8" selected>8 - Bon</option>
                                            <option value="10">10 - Excellent</option>
                                        </select>
                                    </td>
                                    <td>
                                        <textarea class="form-control-sm" rows="1" placeholder="Commentaire..."></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Service client et réactivité</td>
                                    <td>15%</td>
                                    <td>
                                        <select class="form-control-sm note-critere" data-critere="service">
                                            <option value="0">0 - Non conforme</option>
                                            <option value="2">2</option>
                                            <option value="4">4</option>
                                            <option value="6">6 - Satisfaisant</option>
                                            <option value="8">8 - Bon</option>
                                            <option value="10" selected>10 - Excellent</option>
                                        </select>
                                    </td>
                                    <td>
                                        <textarea class="form-control-sm" rows="1" placeholder="Commentaire..."></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Conformité réglementaire</td>
                                    <td>10%</td>
                                    <td>
                                        <select class="form-control-sm note-critere" data-critere="conformite">
                                            <option value="0">0 - Non conforme</option>
                                            <option value="2">2</option>
                                            <option value="4">4</option>
                                            <option value="6">6 - Satisfaisant</option>
                                            <option value="8" selected>8 - Bon</option>
                                            <option value="10">10 - Excellent</option>
                                        </select>
                                    </td>
                                    <td>
                                        <textarea class="form-control-sm" rows="1" placeholder="Commentaire..."></textarea>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-right">Note globale :</td>
                                    <td colspan="2">
                                        <div class="global-score">
                                            <span id="noteGlobale" class="score-value">0.0</span>
                                            <span id="noteSur10" class="score-max">/10</span>
                                            <span id="categorie" class="score-badge">Non évalué</span>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Section Recommandation -->
                <div class="form-section">
                    <h3 class="section-title">Recommandation</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Statut recommandé</label>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="statut" value="approuve" checked>
                                    <span class="status-badge success-badge">Approuvé</span>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="statut" value="conditionnel">
                                    <span class="status-badge warning-badge">Conditionnel</span>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="statut" value="rejete">
                                    <span class="status-badge danger-badge">Rejeté</span>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="statut" value="surveillance">
                                    <span class="status-badge info-badge">Sous surveillance</span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="prochaineEvaluation" class="form-label">Prochaine évaluation recommandée</label>
                            <select class="form-control" id="prochaineEvaluation">
                                <option value="3">3 mois</option>
                                <option value="6" selected>6 mois</option>
                                <option value="12">12 mois</option>
                                <option value="24">24 mois</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Section Commentaires -->
                <div class="form-section">
                    <div class="form-group">
                        <label for="commentaires" class="form-label">Commentaires et observations</label>
                        <textarea class="form-control" id="commentaires" rows="3" placeholder="Observations générales, points forts, axes d'amélioration..."></textarea>
                    </div>
                </div>

                <!-- Actions du formulaire -->
                <div class="form-actions">
                    <button type="reset" class="btn btn-secondary" id="btnAnnuler">Annuler</button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Enregistrer l'évaluation
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="charts-container">
        <div class="chart-wrapper">
            <div class="chart-card">
                <div class="chart-header">
                    <h3>Évolution des scores par fournisseur</h3>
                </div>
                <div class="chart-body">
                    <canvas id="evolutionChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="chart-wrapper">
            <div class="chart-card">
                <div class="chart-header">
                    <h3>Répartition par statut</h3>
                </div>
                <div class="chart-body">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des évaluations -->
    <div class="data-table-card">
        <div class="table-header">
            <h3>Historique des évaluations</h3>
            <div class="table-search">
                <input type="text" placeholder="Rechercher un fournisseur...">
                <button class="search-btn">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
        
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Fournisseur</th>
                        <th>Date évaluation</th>
                        <th>Score</th>
                        <th>Statut</th>
                        <th>Évaluateur</th>
                        <th>Prochaine évaluation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="supplier-info">
                                <div class="supplier-icon">
                                    <i class="bi bi-building"></i>
                                </div>
                                <div>
                                    <div class="supplier-name">ABC Technologies</div>
                                    <div class="supplier-desc">Fournisseur principal</div>
                                </div>
                            </div>
                        </td>
                        <td>15/06/2025</td>
                        <td>
                            <div class="score-display">
                                <div class="progress-bar">
                                    <div class="progress-fill success-fill" style="width: 88%"></div>
                                </div>
                                <span class="score-value">8.8</span>
                            </div>
                        </td>
                        <td><span class="status-badge success-badge">Approuvé</span></td>
                        <td>Marie Dubois</td>
                        <td>15/12/2025</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-icon">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="supplier-info">
                                <div class="supplier-icon">
                                    <i class="bi bi-truck"></i>
                                </div>
                                <div>
                                    <div class="supplier-name">Global Logistics</div>
                                    <div class="supplier-desc">Transport</div>
                                </div>
                            </div>
                        </td>
                        <td>10/06/2025</td>
                        <td>
                            <div class="score-display">
                                <div class="progress-bar">
                                    <div class="progress-fill warning-fill" style="width: 65%"></div>
                                </div>
                                <span class="score-value">6.5</span>
                            </div>
                        </td>
                        <td><span class="status-badge warning-badge">Conditionnel</span></td>
                        <td>Jean Martin</td>
                        <td>10/09/2025</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-icon">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="supplier-info">
                                <div class="supplier-icon">
                                    <i class="bi bi-gear"></i>
                                </div>
                                <div>
                                    <div class="supplier-name">Precision Parts Inc.</div>
                                    <div class="supplier-desc">Pièces mécaniques</div>
                                </div>
                            </div>
                        </td>
                        <td>05/06/2025</td>
                        <td>
                            <div class="score-display">
                                <div class="progress-bar">
                                    <div class="progress-fill danger-fill" style="width: 42%"></div>
                                </div>
                                <span class="score-value">4.2</span>
                            </div>
                        </td>
                        <td><span class="status-badge danger-badge">Rejeté</span></td>
                        <td>Sophie Leroy</td>
                        <td>05/12/2025</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-icon">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="supplier-info">
                                <div class="supplier-icon">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <div>
                                    <div class="supplier-name">XYZ Materials</div>
                                    <div class="supplier-desc">Matériaux bruts</div>
                                </div>
                            </div>
                        </td>
                        <td>01/06/2025</td>
                        <td>
                            <div class="score-display">
                                <div class="progress-bar">
                                    <div class="progress-fill info-fill" style="width: 72%"></div>
                                </div>
                                <span class="score-value">7.2</span>
                            </div>
                        </td>
                        <td><span class="status-badge info-badge">Sous surveillance</span></td>
                        <td>Pierre Bernard</td>
                        <td>01/09/2025</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-icon">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="pagination">
            <button class="pagination-btn disabled">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="pagination-btn active">1</button>
            <button class="pagination-btn">2</button>
            <button class="pagination-btn">3</button>
            <button class="pagination-btn">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
    </div>
</div>

<!-- CSS -->
<style>
/* Variables */
:root {
    --primary-color: #4e73df;
    --primary-light: rgba(78, 115, 223, 0.1);
    --success-color: #1cc88a;
    --success-light: rgba(28, 200, 138, 0.1);
    --warning-color: #f6c23e;
    --warning-light: rgba(246, 194, 62, 0.1);
    --danger-color: #e74a3b;
    --danger-light: rgba(231, 74, 59, 0.1);
    --info-color: #36b9cc;
    --info-light: rgba(54, 185, 204, 0.1);
    --secondary-color: #858796;
    --light-color: #f8f9fc;
    --dark-color: #5a5c69;
    --border-color: #e3e6f0;
    --shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    --border-radius: 0.35rem;
}

/* Reset et base */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fc;
    color: #5a5c69;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
}

/* En-tête de page */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 1px solid var(--border-color);
}

.page-header h1 {
    color: var(--primary-color);
    font-size: 1.75rem;
    font-weight: 600;
}

/* Cartes de synthèse */
.cards-summary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.summary-card {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    transition: transform 0.3s ease;
}

.summary-card:hover {
    transform: translateY(-5px);
}

.card-header {
    padding: 20px;
    border-left-width: 4px;
    border-left-style: solid;
    background-color: var(--light-color);
}

.card-header i {
    font-size: 2rem;
    color: var(--dark-color);
}

.primary-border { border-left-color: var(--primary-color); }
.success-border { border-left-color: var(--success-color); }
.warning-border { border-left-color: var(--warning-color); }
.danger-border { border-left-color: var(--danger-color); }

.card-content {
    padding: 20px;
}

.card-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--dark-color);
    text-transform: uppercase;
    margin-bottom: 10px;
}

.card-value {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--dark-color);
    margin-bottom: 10px;
}

.card-trend {
    font-size: 0.875rem;
    font-weight: 500;
    padding: 4px 8px;
    border-radius: 12px;
    display: inline-block;
}

.positive { background-color: var(--success-light); color: var(--success-color); }
.neutral { background-color: var(--info-light); color: var(--info-color); }
.negative { background-color: var(--danger-light); color: var(--danger-color); }

.card-link {
    margin-top: 10px;
}

.warning-link {
    color: var(--warning-color);
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
}

.warning-link:hover {
    text-decoration: underline;
}

.card-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 0.875rem;
    font-weight: 500;
    margin-top: 10px;
}

.danger-badge {
    background-color: var(--danger-light);
    color: var(--danger-color);
}

/* Formulaire d'évaluation */
.evaluation-form {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    margin-bottom: 30px;
    display: none;
}

.evaluation-form.show {
    display: block;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: var(--primary-color);
    color: white;
    border-radius: var(--border-radius) var(--border-radius) 0 0;
}

.form-title {
    display: flex;
    align-items: center;
    gap: 10px;
}

.form-title h2 {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
}

.close-form-btn {
    background: none;
    border: none;
    color: white;
    font-size: 1.25rem;
    cursor: pointer;
    padding: 5px;
    border-radius: 4px;
    transition: background-color 0.2s;
}

.close-form-btn:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.form-body {
    padding: 30px;
}

/* Formulaires */
.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-weight: 600;
    color: var(--dark-color);
    margin-bottom: 8px;
    font-size: 0.875rem;
}

.form-control {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    font-size: 0.875rem;
    transition: all 0.2s;
    background-color: white;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

.form-control-sm {
    padding: 6px 8px;
    font-size: 0.8125rem;
}

textarea.form-control-sm {
    min-height: 60px;
    resize: vertical;
}

/* Sections du formulaire */
.form-section {
    margin-bottom: 30px;
}

.section-title {
    color: var(--primary-color);
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--border-color);
}

/* Table d'évaluation */
.table-container {
    overflow-x: auto;
}

.evaluation-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.evaluation-table th,
.evaluation-table td {
    padding: 12px 15px;
    text-align: left;
    border: 1px solid var(--border-color);
}

.evaluation-table th {
    background-color: var(--light-color);
    font-weight: 600;
    color: var(--dark-color);
    font-size: 0.875rem;
}

.evaluation-table tbody tr:hover {
    background-color: var(--primary-light);
}

.evaluation-table tfoot {
    background-color: var(--light-color);
    font-weight: 600;
}

.text-right {
    text-align: right;
}

/* Score global */
.global-score {
    display: flex;
    align-items: center;
    gap: 10px;
}

.score-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-color);
}

.score-max {
    color: var(--secondary-color);
    font-size: 1rem;
}

.score-badge {
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.875rem;
    font-weight: 500;
    background-color: var(--light-color);
    color: var(--secondary-color);
}

/* Boutons radio pour statut */
.radio-group {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 10px;
}

.radio-label {
    display: flex;
    align-items: center;
    cursor: pointer;
}

.radio-label input[type="radio"] {
    margin-right: 8px;
}

/* Badges de statut */
.status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.success-badge { background-color: var(--success-light); color: var(--success-color); }
.warning-badge { background-color: var(--warning-light); color: var(--warning-color); }
.danger-badge { background-color: var(--danger-light); color: var(--danger-color); }
.info-badge { background-color: var(--info-light); color: var(--info-color); }

/* Boutons */
.btn {
    padding: 10px 20px;
    border: none;
    border-radius: var(--border-radius);
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary {
    background-color: var(--primary-color);
    color: white;
}

.btn-primary:hover {
    background-color: #2e59d9;
}

.btn-success {
    background-color: var(--success-color);
    color: white;
}

.btn-success:hover {
    background-color: #17a673;
}

.btn-secondary {
    background-color: var(--secondary-color);
    color: white;
}

.btn-secondary:hover {
    background-color: #6c757d;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 30px;
}

/* Graphiques */
.charts-container {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
    margin-bottom: 30px;
}

.chart-card {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    overflow: hidden;
}

.chart-header {
    padding: 20px;
    border-bottom: 1px solid var(--border-color);
}

.chart-header h3 {
    color: var(--primary-color);
    font-size: 1rem;
    font-weight: 600;
    margin: 0;
}

.chart-body {
    padding: 20px;
    height: 300px;
}

/* Tableau de données */
.data-table-card {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    overflow: hidden;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid var(--border-color);
}

.table-header h3 {
    color: var(--primary-color);
    font-size: 1rem;
    font-weight: 600;
    margin: 0;
}

.table-search {
    display: flex;
    align-items: center;
}

.table-search input {
    padding: 8px 12px;
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius) 0 0 var(--border-radius);
    border-right: none;
    font-size: 0.875rem;
    width: 250px;
}

.table-search input:focus {
    outline: none;
    border-color: var(--primary-color);
}

.search-btn {
    background-color: var(--primary-color);
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 0 var(--border-radius) var(--border-radius) 0;
    cursor: pointer;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th {
    padding: 15px 20px;
    background-color: var(--light-color);
    font-weight: 600;
    color: var(--dark-color);
    font-size: 0.875rem;
    text-align: left;
    border-bottom: 2px solid var(--border-color);
}

.data-table td {
    padding: 15px 20px;
    border-bottom: 1px solid var(--border-color);
}

.data-table tbody tr:hover {
    background-color: var(--primary-light);
}

/* Informations fournisseur */
.supplier-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.supplier-icon {
    width: 40px;
    height: 40px;
    background-color: var(--primary-light);
    color: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.supplier-name {
    font-weight: 600;
    color: var(--dark-color);
}

.supplier-desc {
    font-size: 0.75rem;
    color: var(--secondary-color);
}

/* Affichage du score */
.score-display {
    display: flex;
    align-items: center;
    gap: 10px;
}

.progress-bar {
    flex: 1;
    height: 6px;
    background-color: var(--light-color);
    border-radius: 3px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    border-radius: 3px;
}

.success-fill { background-color: var(--success-color); }
.warning-fill { background-color: var(--warning-color); }
.danger-fill { background-color: var(--danger-color); }
.info-fill { background-color: var(--info-color); }

.score-value {
    font-weight: 600;
    min-width: 30px;
}

/* Boutons d'action */
.action-buttons {
    display: flex;
    gap: 8px;
}

.btn-icon {
    background: none;
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: var(--secondary-color);
    transition: all 0.2s;
}

.btn-icon:hover {
    background-color: var(--primary-light);
    color: var(--primary-color);
    border-color: var(--primary-color);
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    padding: 20px;
    border-top: 1px solid var(--border-color);
}

.pagination-btn {
    width: 36px;
    height: 36px;
    border: 1px solid var(--border-color);
    background-color: white;
    color: var(--dark-color);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 0.875rem;
    transition: all 0.2s;
}

.pagination-btn:not(:last-child) {
    border-right: none;
}

.pagination-btn:first-child {
    border-radius: var(--border-radius) 0 0 var(--border-radius);
}

.pagination-btn:last-child {
    border-radius: 0 var(--border-radius) var(--border-radius) 0;
}

.pagination-btn:hover:not(.disabled):not(.active) {
    background-color: var(--light-color);
}

.pagination-btn.active {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.pagination-btn.disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Responsive */
@media (max-width: 1200px) {
    .charts-container {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 992px) {
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .table-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .table-search input {
        width: 100%;
    }
}

@media (max-width: 768px) {
    .container {
        padding: 15px;
    }
    
    .cards-summary {
        grid-template-columns: 1fr;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .form-body {
        padding: 20px;
    }
    
    .evaluation-table {
        font-size: 0.875rem;
    }
    
    .evaluation-table th,
    .evaluation-table td {
        padding: 8px 10px;
    }
    
    .data-table {
        font-size: 0.875rem;
    }
    
    .data-table th,
    .data-table td {
        padding: 10px 15px;
    }
}

@media (max-width: 576px) {
    .form-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .form-title h2 {
        font-size: 1rem;
    }
    
    .radio-group {
        flex-direction: column;
        gap: 10px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
}
</style>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion de l'affichage/masquage du formulaire
    const formEvaluation = document.getElementById('formEvaluation');
    const btnNouvelleEvaluation = document.getElementById('btnNouvelleEvaluation');
    const btnFermerForm = document.getElementById('btnFermerForm');
    const btnAnnuler = document.getElementById('btnAnnuler');
    
    btnNouvelleEvaluation.addEventListener('click', function() {
        formEvaluation.classList.add('show');
        formEvaluation.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
    
    btnFermerForm.addEventListener('click', function() {
        formEvaluation.classList.remove('show');
    });
    
    btnAnnuler.addEventListener('click', function() {
        if (confirm('Voulez-vous vraiment annuler ? Les modifications seront perdues.')) {
            formEvaluation.classList.remove('show');
            document.getElementById('evaluationForm').reset();
            updateGlobalScore();
        }
    });
    
    // Calcul de la note globale
    const poids = {
        'qualite': 0.30,
        'delais': 0.25,
        'prix': 0.20,
        'service': 0.15,
        'conformite': 0.10
    };
    
    function updateGlobalScore() {
        let total = 0;
        let hasSelection = false;
        
        document.querySelectorAll('.note-critere').forEach(select => {
            const note = parseInt(select.value) || 0;
            const critere = select.dataset.critere;
            
            if (note > 0) hasSelection = true;
            
            total += note * poids[critere];
        });
        
        const noteGlobale = document.getElementById('noteGlobale');
        const noteSur10 = document.getElementById('noteSur10');
        const categorie = document.getElementById('categorie');
        
        noteGlobale.textContent = total.toFixed(1);
        
        // Déterminer la catégorie
        let badgeClass = '';
        let badgeText = 'Non évalué';
        
        if (hasSelection) {
            if (total >= 8.5) {
                badgeClass = 'success-badge';
                badgeText = 'Excellent';
            } else if (total >= 7.0) {
                badgeClass = 'info-badge';
                badgeText = 'Bon';
            } else if (total >= 5.5) {
                badgeClass = 'warning-badge';
                badgeText = 'Satisfaisant';
            } else if (total > 0) {
                badgeClass = 'danger-badge';
                badgeText = 'Insuffisant';
            }
        }
        
        // Mettre à jour le badge
        categorie.className = 'status-badge ' + badgeClass;
        categorie.textContent = badgeText;
        
        // Mettre à jour la couleur de la note
        if (total >= 8.5) {
            noteGlobale.style.color = '#1cc88a';
        } else if (total >= 7.0) {
            noteGlobale.style.color = '#36b9cc';
        } else if (total >= 5.5) {
            noteGlobale.style.color = '#f6c23e';
        } else if (total > 0) {
            noteGlobale.style.color = '#e74a3b';
        } else {
            noteGlobale.style.color = '#4e73df';
        }
    }
    
    // Écouter les changements sur les sélecteurs de notes
    document.querySelectorAll('.note-critere').forEach(select => {
        select.addEventListener('change', updateGlobalScore);
    });
    
    // Initialiser le calcul
    updateGlobalScore();
    
    // Gestion de la soumission du formulaire
    document.getElementById('evaluationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Récupérer les données du formulaire
        const fournisseur = document.getElementById('fournisseur').value;
        const dateEvaluation = document.getElementById('dateEvaluation').value;
        const noteGlobale = document.getElementById('noteGlobale').textContent;
        const statut = document.querySelector('input[name="statut"]:checked').value;
        
        // Simulation d'enregistrement
        alert(`Évaluation enregistrée !\nFournisseur: ${fournisseur}\nDate: ${dateEvaluation}\nNote: ${noteGlobale}/10\nStatut: ${statut}`);
        
        // Réinitialiser et cacher le formulaire
        this.reset();
        formEvaluation.classList.remove('show');
        updateGlobalScore();
    });
    
    // Initialisation des graphiques
    function initCharts() {
        // Graphique d'évolution
        const ctxEvolution = document.getElementById('evolutionChart').getContext('2d');
        const evolutionChart = new Chart(ctxEvolution, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                datasets: [
                    {
                        label: 'ABC Technologies',
                        data: [8.2, 8.5, 8.3, 8.6, 8.7, 8.8],
                        borderColor: '#4e73df',
                        backgroundColor: 'rgba(78, 115, 223, 0.05)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Global Logistics',
                        data: [6.8, 6.5, 6.9, 6.7, 6.6, 6.5],
                        borderColor: '#f6c23e',
                        backgroundColor: 'rgba(246, 194, 62, 0.05)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'XYZ Materials',
                        data: [7.0, 7.2, 7.1, 7.3, 7.2, 7.2],
                        borderColor: '#36b9cc',
                        backgroundColor: 'rgba(54, 185, 204, 0.05)',
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 5,
                        max: 10,
                        title: {
                            display: true,
                            text: 'Score'
                        }
                    }
                }
            }
        });
        
        // Graphique de répartition par statut
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Approuvé', 'Conditionnel', 'Rejeté', 'Surveillance'],
                datasets: [{
                    data: [15, 5, 3, 1],
                    backgroundColor: [
                        '#1cc88a',
                        '#f6c23e',
                        '#e74a3b',
                        '#36b9cc'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                cutout: '70%'
            }
        });
    }
    
    // Initialiser les graphiques
    initCharts();
});
</script>
@endsection