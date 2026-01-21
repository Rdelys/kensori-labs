@extends('layouts.clients')

@section('title', 'Stock sortant')

@section('content')
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --gray-color: #95a5a6;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-title {
            font-size: 2rem;
            color: var(--primary-color);
            font-weight: 700;
        }

        .header-actions {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .btn-primary {
            background-color: var(--secondary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background-color: #219653;
            transform: translateY(-2px);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--secondary-color);
            border: 2px solid var(--secondary-color);
        }

        .btn-outline:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        /* KPI Section */
        .kpi-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .kpi-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--box-shadow);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: var(--transition);
        }

        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .kpi-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .kpi-info {
            flex: 1;
        }

        .kpi-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .kpi-label {
            font-size: 0.9rem;
            color: var(--gray-color);
            font-weight: 500;
        }

        .kpi-trend {
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .trend-up {
            color: var(--success-color);
        }

        .trend-down {
            color: var(--accent-color);
        }

        /* Charts Section */
        .charts-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .charts-container {
                grid-template-columns: 1fr;
            }
        }

        .chart-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        /* Form Section (Inline, not modal) */
        .form-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
            display: none; /* Hidden by default */
        }

        .form-section.active {
            display: block;
            animation: formSlideIn 0.5s ease-out;
        }

        @keyframes formSlideIn {
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
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .close-form {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gray-color);
            transition: var(--transition);
        }

        .close-form:hover {
            color: var(--accent-color);
        }

        /* Data Table */
        .data-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .search-filter {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .search-box {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            width: 200px;
        }

        .filter-select {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            background-color: white;
        }

        .table-container {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .data-table th {
            background-color: #f1f5f9;
            color: var(--primary-color);
            font-weight: 600;
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
        }

        .data-table td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        .data-table tr:hover {
            background-color: #f8fafc;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }

        .status-preparation {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-control {
            background-color: #cce5ff;
            color: #004085;
        }

        .status-expedition {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-delivered {
            background-color: #d4edda;
            color: #155724;
        }

        .action-icons {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--secondary-color);
            font-size: 1.1rem;
            transition: var(--transition);
        }

        .action-btn:hover {
            color: var(--primary-color);
        }

        /* Form Styles */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--primary-color);
        }

        .form-input {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-input:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .products-table th,
        .products-table td {
            padding: 12px;
            border: 1px solid #e2e8f0;
            text-align: left;
        }

        .products-table th {
            background-color: #f8fafc;
            font-weight: 600;
        }

        .add-product-btn {
            background-color: #f1f5f9;
            color: var(--secondary-color);
            border: 1px dashed #cbd5e1;
            width: 100%;
            padding: 12px;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            font-weight: 600;
            margin-bottom: 20px;
        }

        .add-product-btn:hover {
            background-color: #e2e8f0;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .header-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .btn {
                padding: 10px 15px;
                font-size: 0.9rem;
            }
            
            .kpi-container {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
            
            .kpi-card {
                padding: 15px;
            }
            
            .chart-card {
                padding: 15px;
            }
            
            .chart-container {
                height: 250px;
            }
            
            .form-section, .data-section {
                padding: 15px;
            }
            
            .search-box {
                width: 100%;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .form-row {
                flex-direction: column;
                gap: 15px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
            
            .kpi-container {
                grid-template-columns: 1fr;
            }
            
            .charts-container {
                gap: 15px;
            }
        }

        /* Animation for status */
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }

        .pulse {
            animation: pulse 1.5s infinite;
        }

        /* Form toggle button */
        .form-toggle-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .form-toggle-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            padding: 12px 24px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            color: var(--primary-color);
            transition: var(--transition);
        }

        .form-toggle-btn:hover {
            background-color: #e2e8f0;
            border-color: var(--secondary-color);
        }

        .form-toggle-btn i {
            transition: transform 0.3s ease;
        }

        .form-toggle-btn.collapsed i {
            transform: rotate(180deg);
        }
    </style>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 class="page-title">
                <i class="fas fa-box-open"></i> Gestion du Stock Sortant
            </h1>
            <div class="header-actions">
                <button class="btn btn-outline" id="refreshBtn">
                    <i class="fas fa-sync-alt"></i> Actualiser
                </button>
                <button class="btn btn-primary" id="newExpeditionBtn">
                    <i class="fas fa-plus-circle"></i> Nouvelle Expédition
                </button>
                <button class="btn btn-success" id="generateReportBtn">
                    <i class="fas fa-file-export"></i> Rapport
                </button>
            </div>
        </div>

        <!-- KPI Section -->
        <div class="kpi-container">
            <div class="kpi-card">
                <div class="kpi-icon" style="background-color: #3498db;">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <div class="kpi-info">
                    <div class="kpi-value">142</div>
                    <div class="kpi-label">Expéditions du Jour</div>
                    <div class="kpi-trend trend-up">
                        <i class="fas fa-arrow-up"></i> 12% vs hier
                    </div>
                </div>
            </div>
            
            <div class="kpi-card">
                <div class="kpi-icon" style="background-color: #2ecc71;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="kpi-info">
                    <div class="kpi-value">94%</div>
                    <div class="kpi-label">Taux de Complétude</div>
                    <div class="kpi-trend trend-up">
                        <i class="fas fa-arrow-up"></i> 3% vs hier
                    </div>
                </div>
            </div>
            
            <div class="kpi-card">
                <div class="kpi-icon" style="background-color: #e74c3c;">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="kpi-info">
                    <div class="kpi-value">8</div>
                    <div class="kpi-label">Commandes en Retard</div>
                    <div class="kpi-trend trend-down">
                        <i class="fas fa-arrow-down"></i> 2 vs hier
                    </div>
                </div>
            </div>
            
            <div class="kpi-card">
                <div class="kpi-icon" style="background-color: #f39c12;">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="kpi-info">
                    <div class="kpi-value">2.4h</div>
                    <div class="kpi-label">Temps Moyen de Préparation</div>
                    <div class="kpi-trend trend-down">
                        <i class="fas fa-arrow-down"></i> 0.3h vs hier
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Toggle Button -->
        <div class="form-toggle-container">
            <button class="form-toggle-btn collapsed" id="formToggleBtn">
                <i class="fas fa-chevron-down"></i>
                <span>Afficher le formulaire de nouvelle expédition</span>
            </button>
        </div>

        <!-- Form Section (Inline, not modal) -->
        <div class="form-section" id="expeditionFormSection">
            <div class="form-header">
                <h3 class="form-title">
                    <i class="fas fa-shipping-fast"></i> Nouvelle Expédition
                </h3>
                <button class="close-form" id="closeFormBtn">&times;</button>
            </div>
            <div class="form-body">
                <form id="expeditionForm">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="orderNumber">N° Commande Client</label>
                            <input type="text" class="form-input" id="orderNumber" placeholder="Ex: CMD-2023-0456" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="clientName">Client</label>
                            <select class="form-input" id="clientName" required>
                                <option value="">Sélectionner un client</option>
                                <option value="1">TechnoParts SA</option>
                                <option value="2">ElectroPlus Distribution</option>
                                <option value="3">MecaPro Industries</option>
                                <option value="4">AutoSolution France</option>
                                <option value="5">LogiTech Europe</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="orderDate">Date Commande</label>
                            <input type="date" class="form-input" id="orderDate" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="deliveryDate">Date Livraison Souhaitée</label>
                            <input type="date" class="form-input" id="deliveryDate" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group" style="flex: 1;">
                            <label class="form-label" for="contactPerson">Contact Client</label>
                            <input type="text" class="form-input" id="contactPerson" placeholder="Nom et coordonnées">
                        </div>
                        
                        <div class="form-group" style="flex: 1;">
                            <label class="form-label" for="specificRequirements">Exigences Spécifiques</label>
                            <input type="text" class="form-input" id="specificRequirements" placeholder="Emballage, livraison, etc.">
                        </div>
                    </div>
                    
                    <h4 style="margin: 25px 0 15px 0; color: var(--primary-color);">Produits à Expédier</h4>
                    
                    <button type="button" class="add-product-btn" id="addProductBtn">
                        <i class="fas fa-plus"></i> Ajouter un Produit
                    </button>
                    
                    <table class="products-table" id="productsTable">
                        <thead>
                            <tr>
                                <th>Référence</th>
                                <th>Désignation</th>
                                <th>Quantité</th>
                                <th>N° Lot/Série</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="productsTableBody">
                            <tr>
                                <td><input type="text" class="form-input" placeholder="REF-001" style="width: 100%;"></td>
                                <td><input type="text" class="form-input" placeholder="Moteur électrique 5kW" style="width: 100%;"></td>
                                <td><input type="number" class="form-input" value="1" min="1" style="width: 100%;"></td>
                                <td><input type="text" class="form-input" placeholder="LOT-2023-09" style="width: 100%;"></td>
                                <td style="text-align: center;">
                                    <button type="button" class="action-btn remove-product">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="form-actions">
                        <button type="button" class="btn btn-outline" id="cancelFormBtn">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer l'Expédition</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-container">
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Expéditions par Statut (7 derniers jours)</h3>
                    <select class="filter-select">
                        <option>7 jours</option>
                        <option>30 jours</option>
                        <option>90 jours</option>
                    </select>
                </div>
                <div class="chart-container">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
            
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Top 5 Clients (Volume d'expédition)</h3>
                    <select class="filter-select">
                        <option>Ce mois</option>
                        <option>Mois dernier</option>
                        <option>Cette année</option>
                    </select>
                </div>
                <div class="chart-container">
                    <canvas id="clientsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="data-section">
            <div class="section-header">
                <h2 class="section-title">Expéditions en Cours</h2>
                <div class="search-filter">
                    <input type="text" class="search-box" placeholder="Rechercher une commande...">
                    <select class="filter-select">
                        <option>Tous les statuts</option>
                        <option>En préparation</option>
                        <option>Contrôle qualité</option>
                        <option>Expédiée</option>
                        <option>Livrée</option>
                    </select>
                    <select class="filter-select">
                        <option>Aujourd'hui</option>
                        <option>Cette semaine</option>
                        <option>Ce mois</option>
                        <option>Toutes dates</option>
                    </select>
                </div>
            </div>
            
            <div class="table-container">
                <table class="data-table" id="expeditionsTable">
                    <thead>
                        <tr>
                            <th>N° Commande</th>
                            <th>Client</th>
                            <th>Date Commande</th>
                            <th>Produits</th>
                            <th>Statut</th>
                            <th>Date Livraison</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="expeditionsTableBody">
                        <!-- Data will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
                <div style="color: var(--gray-color); font-size: 0.9rem;">
                    Affichage de <span id="startRow">1</span> à <span id="endRow">10</span> sur <span id="totalRows">45</span> expéditions
                </div>
                <div style="display: flex; gap: 10px;">
                    <button class="btn btn-outline" id="prevPageBtn">
                        <i class="fas fa-chevron-left"></i> Précédent
                    </button>
                    <button class="btn btn-outline" id="nextPageBtn">
                        Suivant <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Sample data for expeditions
        const expeditionsData = [
            { id: 1, orderNumber: "CMD-2023-0456", client: "TechnoParts SA", orderDate: "2023-10-15", products: "3 produits", status: "expedition", deliveryDate: "2023-10-20", contact: "Jean Martin" },
            { id: 2, orderNumber: "CMD-2023-0457", client: "ElectroPlus Distribution", orderDate: "2023-10-15", products: "5 produits", status: "preparation", deliveryDate: "2023-10-19", contact: "Marie Dubois" },
            { id: 3, orderNumber: "CMD-2023-0458", client: "MecaPro Industries", orderDate: "2023-10-14", products: "2 produits", status: "control", deliveryDate: "2023-10-18", contact: "Pierre Lambert" },
            { id: 4, orderNumber: "CMD-2023-0459", client: "AutoSolution France", orderDate: "2023-10-14", products: "7 produits", status: "delivered", deliveryDate: "2023-10-17", contact: "Sophie Garnier" },
            { id: 5, orderNumber: "CMD-2023-0460", client: "LogiTech Europe", orderDate: "2023-10-13", products: "4 produits", status: "expedition", deliveryDate: "2023-10-18", contact: "Thomas Renault" },
            { id: 6, orderNumber: "CMD-2023-0461", client: "TechnoParts SA", orderDate: "2023-10-13", products: "1 produit", status: "preparation", deliveryDate: "2023-10-16", contact: "Jean Martin" },
            { id: 7, orderNumber: "CMD-2023-0462", client: "ElectroPlus Distribution", orderDate: "2023-10-12", products: "6 produits", status: "delivered", deliveryDate: "2023-10-15", contact: "Marie Dubois" },
            { id: 8, orderNumber: "CMD-2023-0463", client: "MecaPro Industries", orderDate: "2023-10-12", products: "3 produits", status: "control", deliveryDate: "2023-10-17", contact: "Pierre Lambert" },
            { id: 9, orderNumber: "CMD-2023-0464", client: "AutoSolution France", orderDate: "2023-10-11", products: "2 produits", status: "expedition", deliveryDate: "2023-10-16", contact: "Sophie Garnier" },
            { id: 10, orderNumber: "CMD-2023-0465", client: "LogiTech Europe", orderDate: "2023-10-11", products: "5 produits", status: "preparation", deliveryDate: "2023-10-14", contact: "Thomas Renault" },
            { id: 11, orderNumber: "CMD-2023-0466", client: "TechnoParts SA", orderDate: "2023-10-10", products: "4 produits", status: "delivered", deliveryDate: "2023-10-13", contact: "Jean Martin" },
            { id: 12, orderNumber: "CMD-2023-0467", client: "ElectroPlus Distribution", orderDate: "2023-10-10", products: "3 produits", status: "expedition", deliveryDate: "2023-10-15", contact: "Marie Dubois" },
            { id: 13, orderNumber: "CMD-2023-0468", client: "MecaPro Industries", orderDate: "2023-10-09", products: "2 produits", status: "control", deliveryDate: "2023-10-14", contact: "Pierre Lambert" },
            { id: 14, orderNumber: "CMD-2023-0469", client: "AutoSolution France", orderDate: "2023-10-09", products: "6 produits", status: "preparation", deliveryDate: "2023-10-13", contact: "Sophie Garnier" },
            { id: 15, orderNumber: "CMD-2023-0470", client: "LogiTech Europe", orderDate: "2023-10-08", products: "1 produit", status: "delivered", deliveryDate: "2023-10-12", contact: "Thomas Renault" }
        ];

        // Pagination variables
        let currentPage = 1;
        const rowsPerPage = 10;
        let filteredData = [...expeditionsData];

        // DOM Elements
        const newExpeditionBtn = document.getElementById('newExpeditionBtn');
        const refreshBtn = document.getElementById('refreshBtn');
        const generateReportBtn = document.getElementById('generateReportBtn');
        
        const expeditionFormSection = document.getElementById('expeditionFormSection');
        const formToggleBtn = document.getElementById('formToggleBtn');
        const closeFormBtn = document.getElementById('closeFormBtn');
        const expeditionForm = document.getElementById('expeditionForm');
        const addProductBtn = document.getElementById('addProductBtn');
        const productsTableBody = document.getElementById('productsTableBody');
        const expeditionsTableBody = document.getElementById('expeditionsTableBody');
        const searchBox = document.querySelector('.search-box');
        const statusFilter = document.querySelectorAll('.filter-select')[0];
        const dateFilter = document.querySelectorAll('.filter-select')[1];
        const prevPageBtn = document.getElementById('prevPageBtn');
        const nextPageBtn = document.getElementById('nextPageBtn');
        const startRowEl = document.getElementById('startRow');
        const endRowEl = document.getElementById('endRow');
        const totalRowsEl = document.getElementById('totalRows');

        // Initialize date fields with today's date
        document.getElementById('orderDate').valueAsDate = new Date();
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        document.getElementById('deliveryDate').valueAsDate = tomorrow;

        // Initialize charts
        let statusChart, clientsChart;

        // Function to initialize charts
        function initializeCharts() {
            // Status Chart
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            statusChart = new Chart(statusCtx, {
                type: 'bar',
                data: {
                    labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                    datasets: [
                        {
                            label: 'En préparation',
                            data: [12, 19, 8, 15, 12, 5, 2],
                            backgroundColor: '#ffc107',
                            borderColor: '#ffc107',
                            borderWidth: 1
                        },
                        {
                            label: 'Contrôle qualité',
                            data: [5, 8, 6, 10, 7, 3, 1],
                            backgroundColor: '#17a2b8',
                            borderColor: '#17a2b8',
                            borderWidth: 1
                        },
                        {
                            label: 'Expédiée',
                            data: [18, 22, 20, 25, 30, 12, 8],
                            backgroundColor: '#28a745',
                            borderColor: '#28a745',
                            borderWidth: 1
                        },
                        {
                            label: 'Livrée',
                            data: [25, 28, 30, 32, 35, 20, 15],
                            backgroundColor: '#007bff',
                            borderColor: '#007bff',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 10
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });

            // Clients Chart
            const clientsCtx = document.getElementById('clientsChart').getContext('2d');
            clientsChart = new Chart(clientsCtx, {
                type: 'doughnut',
                data: {
                    labels: ['TechnoParts SA', 'ElectroPlus Distribution', 'MecaPro Industries', 'AutoSolution France', 'LogiTech Europe'],
                    datasets: [{
                        data: [35, 25, 20, 15, 5],
                        backgroundColor: [
                            '#3498db',
                            '#2ecc71',
                            '#e74c3c',
                            '#f39c12',
                            '#9b59b6'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    }
                }
            });
        }

        // Function to render expeditions table
        function renderExpeditionsTable() {
            expeditionsTableBody.innerHTML = '';
            
            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = Math.min(startIndex + rowsPerPage, filteredData.length);
            
            for (let i = startIndex; i < endIndex; i++) {
                const expedition = filteredData[i];
                const row = document.createElement('tr');
                
                // Determine status badge class
                let statusClass, statusText;
                switch(expedition.status) {
                    case 'preparation':
                        statusClass = 'status-preparation';
                        statusText = 'En préparation';
                        break;
                    case 'control':
                        statusClass = 'status-control';
                        statusText = 'Contrôle qualité';
                        break;
                    case 'expedition':
                        statusClass = 'status-expedition';
                        statusText = 'Expédiée';
                        break;
                    case 'delivered':
                        statusClass = 'status-delivered';
                        statusText = 'Livrée';
                        break;
                    default:
                        statusClass = 'status-preparation';
                        statusText = 'En préparation';
                }
                
                // Format date
                const formattedOrderDate = new Date(expedition.orderDate).toLocaleDateString('fr-FR');
                const formattedDeliveryDate = new Date(expedition.deliveryDate).toLocaleDateString('fr-FR');
                
                row.innerHTML = `
                    <td>${expedition.orderNumber}</td>
                    <td>${expedition.client}</td>
                    <td>${formattedOrderDate}</td>
                    <td>${expedition.products}</td>
                    <td><span class="status-badge ${statusClass}">${statusText}</span></td>
                    <td>${formattedDeliveryDate}</td>
                    <td>
                        <div class="action-icons">
                            <button class="action-btn" title="Voir détails">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="action-btn" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="action-btn" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                expeditionsTableBody.appendChild(row);
            }
            
            // Update pagination info
            startRowEl.textContent = startIndex + 1;
            endRowEl.textContent = endIndex;
            totalRowsEl.textContent = filteredData.length;
            
            // Update button states
            prevPageBtn.disabled = currentPage === 1;
            nextPageBtn.disabled = endIndex >= filteredData.length;
        }

        // Function to filter expeditions
        function filterExpeditions() {
            const searchTerm = searchBox.value.toLowerCase();
            const statusFilterValue = statusFilter.value;
            const dateFilterValue = dateFilter.value;
            
            filteredData = expeditionsData.filter(expedition => {
                // Search filter
                const matchesSearch = expedition.orderNumber.toLowerCase().includes(searchTerm) || 
                                     expedition.client.toLowerCase().includes(searchTerm) ||
                                     expedition.contact.toLowerCase().includes(searchTerm);
                
                // Status filter
                let matchesStatus = true;
                if (statusFilterValue !== "Tous les statuts") {
                    const statusMap = {
                        "En préparation": "preparation",
                        "Contrôle qualité": "control",
                        "Expédiée": "expedition",
                        "Livrée": "delivered"
                    };
                    matchesStatus = expedition.status === statusMap[statusFilterValue];
                }
                
                // Date filter
                let matchesDate = true;
                const expeditionDate = new Date(expedition.orderDate);
                const today = new Date();
                
                if (dateFilterValue === "Aujourd'hui") {
                    matchesDate = expeditionDate.toDateString() === today.toDateString();
                } else if (dateFilterValue === "Cette semaine") {
                    const startOfWeek = new Date(today);
                    startOfWeek.setDate(today.getDate() - today.getDay() + 1); // Start from Monday
                    matchesDate = expeditionDate >= startOfWeek;
                } else if (dateFilterValue === "Ce mois") {
                    matchesDate = expeditionDate.getMonth() === today.getMonth() && 
                                  expeditionDate.getFullYear() === today.getFullYear();
                }
                
                return matchesSearch && matchesStatus && matchesDate;
            });
            
            currentPage = 1;
            renderExpeditionsTable();
        }

        // Function to toggle form visibility
        function toggleForm() {
            const isVisible = expeditionFormSection.classList.contains('active');
            
            if (isVisible) {
                // Hide form
                expeditionFormSection.classList.remove('active');
                formToggleBtn.classList.add('collapsed');
                formToggleBtn.innerHTML = '<i class="fas fa-chevron-down"></i><span>Afficher le formulaire de nouvelle expédition</span>';
            } else {
                // Show form
                expeditionFormSection.classList.add('active');
                formToggleBtn.classList.remove('collapsed');
                formToggleBtn.innerHTML = '<i class="fas fa-chevron-up"></i><span>Masquer le formulaire de nouvelle expédition</span>';
                
                // Scroll to form smoothly
                expeditionFormSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        // Function to add product row to form
        function addProductRow() {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><input type="text" class="form-input" placeholder="REF-001" style="width: 100%;"></td>
                <td><input type="text" class="form-input" placeholder="Moteur électrique 5kW" style="width: 100%;"></td>
                <td><input type="number" class="form-input" value="1" min="1" style="width: 100%;"></td>
                <td><input type="text" class="form-input" placeholder="LOT-2023-09" style="width: 100%;"></td>
                <td style="text-align: center;">
                    <button type="button" class="action-btn remove-product">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
            productsTableBody.appendChild(row);
            
            // Add event listener to the new remove button
            row.querySelector('.remove-product').addEventListener('click', function() {
                row.remove();
            });
        }

        // Function to reset form
        function resetForm() {
            expeditionForm.reset();
            
            // Reset products table to one row
            productsTableBody.innerHTML = `
                <tr>
                    <td><input type="text" class="form-input" placeholder="REF-001" style="width: 100%;"></td>
                    <td><input type="text" class="form-input" placeholder="Moteur électrique 5kW" style="width: 100%;"></td>
                    <td><input type="number" class="form-input" value="1" min="1" style="width: 100%;"></td>
                    <td><input type="text" class="form-input" placeholder="LOT-2023-09" style="width: 100%;"></td>
                    <td style="text-align: center;">
                        <button type="button" class="action-btn remove-product">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            
            // Reset dates
            document.getElementById('orderDate').valueAsDate = new Date();
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            document.getElementById('deliveryDate').valueAsDate = tomorrow;
        }

        // Event Listeners
        newExpeditionBtn.addEventListener('click', function() {
            // Show form when clicking "Nouvelle Expédition" button
            if (!expeditionFormSection.classList.contains('active')) {
                toggleForm();
            }
        });

        // Form toggle button
        formToggleBtn.addEventListener('click', toggleForm);

        // Close form button
        closeFormBtn.addEventListener('click', function() {
            toggleForm();
        });

        cancelFormBtn.addEventListener('click', function() {
            resetForm();
            toggleForm();
        });

        expeditionForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const orderNumber = document.getElementById('orderNumber').value;
            const clientName = document.getElementById('clientName').value;
            const orderDate = document.getElementById('orderDate').value;
            const deliveryDate = document.getElementById('deliveryDate').value;
            
            // In a real application, you would send this data to a server
            // For this demo, we'll just show an alert and reset the form
            alert(`Expédition ${orderNumber} enregistrée avec succès!`);
            
            // Reset form
            resetForm();
            
            // Refresh the table to show the new expedition
            setTimeout(() => {
                alert("Tableau actualisé avec la nouvelle expédition");
            }, 500);
        });

        addProductBtn.addEventListener('click', addProductRow);

        searchBox.addEventListener('input', filterExpeditions);
        statusFilter.addEventListener('change', filterExpeditions);
        dateFilter.addEventListener('change', filterExpeditions);

        refreshBtn.addEventListener('click', function() {
            // Add loading animation
            refreshBtn.querySelector('i').classList.add('fa-spin');
            
            // Simulate data refresh
            setTimeout(() => {
                refreshBtn.querySelector('i').classList.remove('fa-spin');
                
                // Show notification
                const notification = document.createElement('div');
                notification.textContent = "Données actualisées avec succès!";
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background-color: var(--success-color);
                    color: white;
                    padding: 15px 20px;
                    border-radius: var(--border-radius);
                    box-shadow: var(--box-shadow);
                    z-index: 1001;
                    animation: fadeInOut 3s ease-in-out;
                `;
                
                document.body.appendChild(notification);
                
                // Add CSS for animation
                const style = document.createElement('style');
                style.textContent = `
                    @keyframes fadeInOut {
                        0% { opacity: 0; transform: translateY(-20px); }
                        15% { opacity: 1; transform: translateY(0); }
                        85% { opacity: 1; transform: translateY(0); }
                        100% { opacity: 0; transform: translateY(-20px); }
                    }
                `;
                document.head.appendChild(style);
                
                // Remove notification after 3 seconds
                setTimeout(() => {
                    notification.remove();
                }, 3000);
                
            }, 1000);
        });

        generateReportBtn.addEventListener('click', function() {
            alert("Génération du rapport en cours...");
            // In a real application, this would generate and download a report
            setTimeout(() => {
                alert("Rapport généré avec succès! Téléchargement automatique lancé.");
            }, 1500);
        });

        prevPageBtn.addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                renderExpeditionsTable();
            }
        });

        nextPageBtn.addEventListener('click', function() {
            if (currentPage * rowsPerPage < filteredData.length) {
                currentPage++;
                renderExpeditionsTable();
            }
        });

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            initializeCharts();
            renderExpeditionsTable();
            
            // Add event listeners to existing remove product buttons
            document.querySelectorAll('.remove-product').forEach(button => {
                button.addEventListener('click', function() {
                    // Only remove if there's more than one row
                    if (productsTableBody.children.length > 1) {
                        button.closest('tr').remove();
                    } else {
                        alert("Au moins un produit est requis.");
                    }
                });
            });
        });

        // Simulate real-time updates
        setInterval(() => {
            // Randomly update KPI values for simulation
            const kpiValues = document.querySelectorAll('.kpi-value');
            if (kpiValues.length >= 4) {
                // Update expeditions count with small random variation
                const currentExpeditions = parseInt(kpiValues[0].textContent);
                const variation = Math.floor(Math.random() * 3) - 1; // -1, 0, or 1
                kpiValues[0].textContent = Math.max(0, currentExpeditions + variation);
                
                // Update completion rate with small random variation
                const currentRate = parseFloat(kpiValues[1].textContent);
                const rateVariation = (Math.random() * 0.5) - 0.25; // -0.25 to 0.25
                kpiValues[1].textContent = (Math.max(85, Math.min(99, currentRate + rateVariation))).toFixed(1) + '%';
                
                // Add pulse animation to status badges for orders in preparation
                const statusBadges = document.querySelectorAll('.status-badge.status-preparation');
                statusBadges.forEach(badge => {
                    badge.classList.toggle('pulse');
                });
            }
        }, 5000);
    </script>
@endsection