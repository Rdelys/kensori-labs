<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Kensori Labs révolutionne votre Système de Management de la Qualité avec l'Intelligence Artificielle. Solution conforme ISO 9001:2015.">
  <title>Kensori Labs - Révolutionnez Votre SMQ avec l'Intelligence Artificielle</title>

  <!-- Tailwind CSS avec plugins -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#0ea5e9',
            secondary: '#3b82f6',
            accent: '#8b5cf6',
            dark: '#0f172a',
            light: '#f8fafc',
            success: '#10b981',
            warning: '#f59e0b',
            gradientStart: '#0ea5e9',
            gradientMid: '#3b82f6',
            gradientEnd: '#8b5cf6'
          },
          fontFamily: {
            'sans': ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
            'display': ['Outfit', 'Inter', 'system-ui', 'sans-serif']
          },
          animation: {
            'float': 'float 6s ease-in-out infinite',
            'pulse-slow': 'pulse 3s ease-in-out infinite',
            'fade-in': 'fadeIn 0.8s ease-out forwards',
            'slide-up': 'slideUp 0.6s ease-out forwards',
            'scale-in': 'scaleIn 0.5s ease-out forwards',
            'shimmer': 'shimmer 2s infinite linear'
          },
          keyframes: {
            float: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-20px)' }
            },
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' }
            },
            slideUp: {
              '0%': { opacity: '0', transform: 'translateY(30px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' }
            },
            scaleIn: {
              '0%': { opacity: '0', transform: 'scale(0.9)' },
              '100%': { opacity: '1', transform: 'scale(1)' }
            },
            shimmer: {
              '0%': { backgroundPosition: '-1000px 0' },
              '100%': { backgroundPosition: '1000px 0' }
            }
          },
          backgroundImage: {
            'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
            'gradient-shine': 'linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent)'
          }
        }
      }
    }
  </script>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

  <style>
    /* Variables CSS */
    :root {
      --primary: #0ea5e9;
      --secondary: #3b82f6;
      --accent: #8b5cf6;
      --dark: #0f172a;
      --light: #f8fafc;
    }

    /* Base styles */
    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Inter', sans-serif;
      overflow-x: hidden;
    }

    h1, h2, h3, h4, h5, h6 {
      font-family: 'Outfit', sans-serif;
      font-weight: 700;
    }

    /* Effet étoiles animées amélioré */
    .star-field {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 0;
    }
    
    .star {
      position: absolute;
      width: 3px;
      height: 3px;
      background: white;
      border-radius: 50%;
      animation: moveStar linear infinite;
      opacity: 0;
    }
    
    @keyframes moveStar {
      0% {
        transform: translateY(0) translateX(0);
        opacity: 0;
      }
      10% {
        opacity: 1;
      }
      90% {
        opacity: 1;
      }
      100% {
        transform: translateY(100vh) translateX(100px);
        opacity: 0;
      }
    }

    /* Navigation premium */
    .navbar {
      backdrop-filter: blur(12px);
      background: rgba(255, 255, 255, 0.92);
      border-bottom: 1px solid rgba(14, 165, 233, 0.1);
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
    }

    .nav-link {
      position: relative;
      padding: 8px 0;
      font-weight: 500;
      color: #334155;
      transition: all 0.3s ease;
    }

    .nav-link::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border-radius: 2px;
    }

    .nav-link:hover {
      color: var(--primary);
    }

    .nav-link:hover::after {
      width: 100%;
    }

    /* Gradient text premium */
    .gradient-text {
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      background-size: 200% 200%;
      animation: gradientShift 8s ease infinite;
    }

    @keyframes gradientShift {
      0%, 100% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
    }

    /* Boutons premium */
    .btn-primary {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      padding: 12px 28px;
      border-radius: 12px;
      font-weight: 600;
      position: relative;
      overflow: hidden;
      transition: all 0.3s ease;
      border: none;
      box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3);
    }

    .btn-primary::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.7s ease;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 25px rgba(14, 165, 233, 0.4);
    }

    .btn-primary:hover::before {
      left: 100%;
    }

    .btn-secondary {
      background: white;
      color: var(--dark);
      padding: 12px 28px;
      border-radius: 12px;
      font-weight: 600;
      border: 2px solid rgba(14, 165, 233, 0.2);
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .btn-secondary:hover {
      transform: translateY(-2px);
      border-color: var(--primary);
      box-shadow: 0 8px 20px rgba(14, 165, 233, 0.15);
    }

    /* Cards premium */
    .card {
      background: white;
      border-radius: 20px;
      padding: 32px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      border: 1px solid rgba(0, 0, 0, 0.05);
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      position: relative;
      overflow: hidden;
    }

    .card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.4s ease;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .card:hover::before {
      transform: scaleX(1);
    }

    .card-icon {
      width: 64px;
      height: 64px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 24px;
      font-size: 24px;
      color: white;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    /* Section backgrounds */
    .section-light {
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .section-dark {
      background: linear-gradient(135deg, var(--dark) 0%, #1e293b 100%);
      color: white;
    }

    /* Stats counter */
    .stat-number {
      font-size: 3.5rem;
      font-weight: 800;
      background: linear-gradient(135deg, var(--primary), var(--accent));
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      line-height: 1;
    }

    /* Testimonial card */
    .testimonial-card {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 24px;
      padding: 40px;
      position: relative;
    }

    .testimonial-card::before {
      content: '"';
      position: absolute;
      top: -20px;
      left: 30px;
      font-size: 120px;
      color: rgba(255, 255, 255, 0.1);
      font-family: serif;
      line-height: 1;
    }

    /* Loading animations */
    .animate-on-scroll {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.8s ease, transform 0.8s ease;
    }

    .animate-on-scroll.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* Mobile menu */
    .mobile-menu {
      transform: translateX(100%);
      transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .mobile-menu.open {
      transform: translateX(0);
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 10px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f5f9;
    }

    ::-webkit-scrollbar-thumb {
      background: linear-gradient(to bottom, var(--primary), var(--secondary));
      border-radius: 5px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(to bottom, var(--secondary), var(--accent));
    }

    /* Shimmer effect */
    .shimmer {
      background: linear-gradient(90deg, 
        transparent 0%, 
        rgba(255, 255, 255, 0.2) 50%, 
        transparent 100%);
      background-size: 1000px 100%;
      animation: shimmer 2s infinite linear;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .stat-number {
        font-size: 2.5rem;
      }
      
      .card {
        padding: 24px;
      }
      
      .testimonial-card {
        padding: 30px 20px;
      }
      
      .testimonial-card::before {
        font-size: 80px;
        top: -10px;
        left: 20px;
      }
    }

    @media (max-width: 480px) {
      .btn-primary,
      .btn-secondary {
        padding: 10px 20px;
        font-size: 14px;
      }
      
      .card-icon {
        width: 56px;
        height: 56px;
        font-size: 20px;
      }
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">

<!-- Navigation -->
<nav class="navbar fixed top-0 left-0 right-0 z-50 py-3 px-4 md:px-8">
  <div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between">
      <!-- Logo -->
      <!-- Logo -->
<div class="flex items-center gap-3">
  <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-lg bg-white">
    <img src="/logo.png" alt="Kensori Labs Logo" class="w-8 h-8">
  </div>
  <span class="text-2xl font-bold tracking-tight">
    <span class="gradient-text">KENSORI</span>
    <span class="text-dark">LABS</span>
  </span>
</div>

      <!-- Desktop Menu -->
      <div class="hidden md:flex items-center gap-8">
        <a href="#accueil" class="nav-link">Accueil</a>
        <a href="#fonctionnalites" class="nav-link">Fonctionnalités</a>
        <a href="#modules" class="nav-link">Modules</a>
        <a href="#temoignages" class="nav-link">Témoignages</a>
        <a href="#tarifs" class="nav-link">Tarifs</a>
        
        <div class="flex items-center gap-4">
          <a href="{{ route('login') }}" class="btn-secondary text-sm px-4 py-2">
            <i class="fa-solid fa-key mr-2"></i>
            Connexion
          </a>
          <a href="#essai" class="btn-primary text-sm">
            <i class="fa-solid fa-rocket mr-2"></i>
            Essai Gratuit
          </a>
        </div>
      </div>

      <!-- Mobile Menu Button -->
      <button id="mobileMenuButton" class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg hover:bg-gray-100">
        <i class="fa-solid fa-bars text-xl"></i>
      </button>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobileMenu" class="mobile-menu md:hidden fixed inset-0 bg-white z-40 pt-20 px-6">
    <div class="flex flex-col gap-6">
      <a href="#accueil" class="nav-link text-lg py-3 border-b">Accueil</a>
      <a href="#fonctionnalites" class="nav-link text-lg py-3 border-b">Fonctionnalités</a>
      <a href="#modules" class="nav-link text-lg py-3 border-b">Modules</a>
      <a href="#temoignages" class="nav-link text-lg py-3 border-b">Témoignages</a>
      <a href="#tarifs" class="nav-link text-lg py-3 border-b">Tarifs</a>
      
      <div class="pt-6 flex flex-col gap-4">
        <a href="{{ route('login') }}" class="btn-secondary text-center">
          <i class="fa-solid fa-key mr-2"></i>
          Connexion
        </a>
        <a href="#essai" class="btn-primary text-center">
          <i class="fa-solid fa-rocket mr-2"></i>
          Essai Gratuit
        </a>
      </div>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section id="accueil" class="relative pt-24 pb-20 md:pt-32 md:pb-28 px-4 md:px-8 overflow-hidden">
  <!-- Star background -->
  <div class="star-field" id="stars"></div>
  
  <!-- Gradient orbs -->
  <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary/10 rounded-full blur-3xl"></div>
  <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-accent/10 rounded-full blur-3xl"></div>
  
  <div class="max-w-7xl mx-auto relative z-10">
    <div class="flex flex-col lg:flex-row items-center gap-12">
      <!-- Left content -->
      <div class="lg:w-1/2 animate-on-scroll">
        <!-- Badge -->
        <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium mb-8 border border-gray-200 shadow-sm">
          <i class="fa-solid fa-medal text-primary"></i>
          <span class="text-gray-700">Conforme ISO 9001:2015</span>
        </div>
        
        <!-- Title -->
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
          Révolutionnez Votre SMQ avec 
          <span class="gradient-text block mt-2">l'Intelligence Artificielle</span>
        </h1>
        
        <!-- Description -->
        <p class="text-lg text-gray-600 mb-8 max-w-xl">
          La plateforme intelligente qui transforme votre gestion de la qualité grâce à l'IA et l'automatisation. Conforme, performant, innovant.
        </p>
        
        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 mb-12">
          <a href="#essai" class="btn-primary inline-flex items-center justify-center">
            <i class="fa-solid fa-play mr-2"></i>
            Commencer l'Essai Gratuit
          </a>
          <a href="#demo" class="btn-secondary inline-flex items-center justify-center">
            <i class="fa-solid fa-circle-play mr-2"></i>
            Voir la Démo
          </a>
        </div>
        
        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
          <div class="text-center">
            <div class="stat-number mb-2">100%</div>
            <div class="text-sm text-gray-600">Conforme ISO 9001</div>
          </div>
          <div class="text-center">
            <div class="stat-number mb-2">+65%</div>
            <div class="text-sm text-gray-600">Gain de temps</div>
          </div>
          <div class="text-center">
            <div class="stat-number mb-2">500+</div>
            <div class="text-sm text-gray-600">Clients satisfaits</div>
          </div>
        </div>
      </div>
      
      <!-- Right content -->
      <div class="lg:w-1/2 animate-on-scroll" style="animation-delay: 0.2s;">
        <div class="relative">
          <!-- Main card -->
          <div class="card max-w-md mx-auto">
            <div class="flex justify-center mb-6">
              <div class="w-24 h-24  from-primary to-accent rounded-2xl flex items-center justify-center shadow-xl">
    <img src="/logo.png" alt="Kensori Labs Logo" class="w-30 h-30">
              </div>
            </div>
            
            <h3 class="text-2xl font-bold text-center mb-6">Solution Smart Complète</h3>
            
            <div class="space-y-4">
              <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-gray-50 transition">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                  <i class="fa-solid fa-check text-green-600"></i>
                </div>
                <div>
                  <div class="font-semibold">Audits automatisés</div>
                  <div class="text-sm text-gray-500">Gestion intelligente des audits</div>
                </div>
              </div>
              
              <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-gray-50 transition">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                  <i class="fa-solid fa-robot text-blue-600"></i>
                </div>
                <div>
                  <div class="font-semibold">IA prédictive</div>
                  <div class="text-sm text-gray-500">Analyses et recommandations</div>
                </div>
              </div>
              
              <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-gray-50 transition">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                  <i class="fa-solid fa-chart-bar text-purple-600"></i>
                </div>
                <div>
                  <div class="font-semibold">Dashboard temps réel</div>
                  <div class="text-sm text-gray-500">KPI et indicateurs clés</div>
                </div>
              </div>
            </div>
            
            <div class="mt-8 pt-6 border-t border-gray-100">
              <a href="#fonctionnalites" class="text-primary font-semibold inline-flex items-center hover:gap-3 transition-all">
                Découvrir toutes les fonctionnalités
                <i class="fa-solid fa-arrow-right ml-2"></i>
              </a>
            </div>
          </div>
          
          <!-- Floating elements -->
          <div class="absolute -top-6 -right-6 w-32 h-32 bg-gradient-to-br from-primary/20 to-accent/20 rounded-2xl blur-xl animate-float"></div>
          <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-gradient-to-br from-secondary/20 to-accent/20 rounded-2xl blur-xl animate-float" style="animation-delay: 2s;"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Features Section -->
<section id="fonctionnalites" class="py-20 px-4 md:px-8 section-light">
  <div class="max-w-7xl mx-auto">
    <!-- Section header -->
    <div class="text-center mb-16 animate-on-scroll">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
        <span class="gradient-text">Fonctionnalités Avancées</span> pour Votre Excellence
      </h2>
      <p class="text-lg text-gray-600 max-w-3xl mx-auto">
        Découvrez comment notre plateforme intelligente optimise chaque aspect de votre gestion de la qualité
      </p>
    </div>
    
    <!-- Features grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Feature 1 -->
      <div class="card animate-on-scroll">
        <div class="card-icon bg-gradient-to-br from-blue-500 to-cyan-400">
          <i class="fa-solid fa-robot"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">IA & Automatisation</h3>
        <p class="text-gray-600 mb-4">
          Automatisez vos processus qualité avec notre intelligence artificielle avancée. Optimisez vos décisions en temps réel.
        </p>
        <ul class="space-y-2 mb-6">
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-500 text-sm"></i>
            <span class="text-sm">Recommandations intelligentes</span>
          </li>
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-500 text-sm"></i>
            <span class="text-sm">Automatisation des workflows</span>
          </li>
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-500 text-sm"></i>
            <span class="text-sm">Analyses prédictives</span>
          </li>
        </ul>
        <a href="#" class="text-primary font-semibold inline-flex items-center text-sm">
          Explorer cette fonction
          <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
        </a>
      </div>
      
      <!-- Feature 2 -->
      <div class="card animate-on-scroll" style="animation-delay: 0.1s;">
        <div class="card-icon bg-gradient-to-br from-green-500 to-emerald-400">
          <i class="fa-solid fa-file-shield"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Conformité Simplifiée</h3>
        <p class="text-gray-600 mb-4">
          Maintenez votre conformité ISO 9001 sans effort avec notre système de suivi intelligent et automatisé.
        </p>
        <ul class="space-y-2 mb-6">
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-500 text-sm"></i>
            <span class="text-sm">Audits automatisés</span>
          </li>
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-500 text-sm"></i>
            <span class="text-sm">Documentation centralisée</span>
          </li>
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-500 text-sm"></i>
            <span class="text-sm">Alertes de conformité</span>
          </li>
        </ul>
        <a href="#" class="text-primary font-semibold inline-flex items-center text-sm">
          Explorer cette fonction
          <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
        </a>
      </div>
      
      <!-- Feature 3 -->
      <div class="card animate-on-scroll" style="animation-delay: 0.2s;">
        <div class="card-icon bg-gradient-to-br from-purple-500 to-pink-400">
          <i class="fa-solid fa-chart-line"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Analyses Avancées</h3>
        <p class="text-gray-600 mb-4">
          Tableaux de bord interactifs et analyses en temps réel pour une prise de décision éclairée.
        </p>
        <ul class="space-y-2 mb-6">
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-500 text-sm"></i>
            <span class="text-sm">KPI personnalisables</span>
          </li>
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-500 text-sm"></i>
            <span class="text-sm">Rapports automatiques</span>
          </li>
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-500 text-sm"></i>
            <span class="text-sm">Visualisations dynamiques</span>
          </li>
        </ul>
        <a href="#" class="text-primary font-semibold inline-flex items-center text-sm">
          Explorer cette fonction
          <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
        </a>
      </div>
    </div>
    
    <!-- CTA -->
    <div class="text-center mt-16 animate-on-scroll">
      <a href="#modules" class="btn-primary inline-flex items-center">
        <i class="fa-solid fa-eye mr-2"></i>
        Voir Toutes les Fonctionnalités
      </a>
    </div>
  </div>
</section>

<!-- Modules Section -->
<section id="modules" class="py-20 px-4 md:px-8">
  <div class="max-w-7xl mx-auto">
    <!-- Section header -->
    <div class="text-center mb-16 animate-on-scroll">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
        Modules <span class="gradient-text">Spécialisés</span> pour Votre SMQ
      </h2>
      <p class="text-lg text-gray-600 max-w-3xl mx-auto">
        Une suite complète d'outils conçus pour optimiser chaque processus de votre système de management de la qualité
      </p>
    </div>
    
    <!-- Modules grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Module 1 -->
      <div class="card animate-on-scroll">
        <div class="flex items-start justify-between mb-6">
          <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-xl flex items-center justify-center shadow-lg">
            <i class="fa-solid fa-diagram-project text-white text-2xl"></i>
          </div>
          <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">POPULAIRE</span>
        </div>
        <h3 class="text-2xl font-bold mb-4">Gestion Documentaire IA</h3>
        <p class="text-gray-600 mb-6">
          Centralisez, versionnez et partagez tous vos documents qualité avec un système de gestion intelligent et sécurisé.
        </p>
        <ul class="space-y-3 mb-8">
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-500"></i>
            <span>Versionning automatique</span>
          </li>
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-500"></i>
            <span>Workflows d'approbation</span>
          </li>
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-500"></i>
            <span>Recherche sémantique</span>
          </li>
        </ul>
        <a href="#" class="btn-secondary w-full text-center">
          <i class="fa-solid fa-arrow-right mr-2"></i>
          Explorer le module
        </a>
      </div>
      
      <!-- Module 2 -->
      <div class="card animate-on-scroll" style="animation-delay: 0.1s;">
        <div class="flex items-start justify-between mb-6">
          <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-400 rounded-xl flex items-center justify-center shadow-lg">
            <i class="fa-solid fa-clipboard-check text-white text-2xl"></i>
          </div>
          <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-3 py-1 rounded-full">ESSENTIEL</span>
        </div>
        <h3 class="text-2xl font-bold mb-4">Audits & Actions Correctives</h3>
        <p class="text-gray-600 mb-6">
          Planifiez, exécutez et suivez vos audits internes et externes avec un système de gestion des actions correctives intégré.
        </p>
        <ul class="space-y-3 mb-8">
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-500"></i>
            <span>Audits programmables</span>
          </li>
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-500"></i>
            <span>Suivi des actions correctives</span>
          </li>
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-500"></i>
            <span>Rapports automatiques</span>
          </li>
        </ul>
        <a href="#" class="btn-secondary w-full text-center">
          <i class="fa-solid fa-arrow-right mr-2"></i>
          Explorer le module
        </a>
      </div>
      
      <!-- Module 3 -->
      <div class="card animate-on-scroll" style="animation-delay: 0.2s;">
        <div class="flex items-start justify-between mb-6">
          <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-400 rounded-xl flex items-center justify-center shadow-lg">
            <i class="fa-solid fa-chart-pie text-white text-2xl"></i>
          </div>
          <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">NOUVEAU</span>
        </div>
        <h3 class="text-2xl font-bold mb-4">Dashboard Personnalisable</h3>
        <p class="text-gray-600 mb-6">
          Visualisez vos indicateurs clés de performance (KPI) avec des dashboards interactifs et personnalisables en temps réel.
        </p>
        <ul class="space-y-3 mb-8">
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-500"></i>
            <span>KPI personnalisables</span>
          </li>
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-500"></i>
            <span>Alertes intelligentes</span>
          </li>
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-500"></i>
            <span>Export multi-formats</span>
          </li>
        </ul>
        <a href="#" class="btn-secondary w-full text-center">
          <i class="fa-solid fa-arrow-right mr-2"></i>
          Explorer le module
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section id="temoignages" class="py-20 px-4 md:px-8 section-dark">
  <div class="max-w-7xl mx-auto">
    <!-- Section header -->
    <div class="text-center mb-16 animate-on-scroll">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
        Ils <span class="gradient-text">Nous Font Confiance</span>
      </h2>
      <p class="text-lg opacity-80 max-w-3xl mx-auto">
        Découvrez comment des centaines d'entreprises optimisent leur SMQ avec Kensori Labs
      </p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
      <!-- Stats -->
      <div class="animate-on-scroll">
        <div class="grid grid-cols-2 gap-6">
          <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
            <div class="text-4xl font-bold text-primary mb-2 stat-counter" data-target="98">0</div>
            <div class="text-lg font-medium">Satisfaction client</div>
            <div class="flex mt-2">
              <i class="fa-solid fa-star text-yellow-400"></i>
              <i class="fa-solid fa-star text-yellow-400"></i>
              <i class="fa-solid fa-star text-yellow-400"></i>
              <i class="fa-solid fa-star text-yellow-400"></i>
              <i class="fa-solid fa-star text-yellow-400"></i>
            </div>
          </div>
          
          <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
            <div class="text-4xl font-bold text-green-400 mb-2 stat-counter" data-target="65">0</div>
            <div class="text-lg font-medium">Gain de temps moyen</div>
            <div class="text-sm opacity-80 mt-1">sur les processus qualité</div>
          </div>
          
          <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
            <div class="text-4xl font-bold text-purple-400 mb-2 stat-counter" data-target="500">0</div>
            <div class="text-lg font-medium">Entreprises</div>
            <div class="text-sm opacity-80 mt-1">nous font confiance</div>
          </div>
          
          <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
            <div class="text-4xl font-bold text-cyan-400 mb-2 stat-counter" data-target="100">0</div>
            <div class="text-lg font-medium">Conformité ISO</div>
            <div class="text-sm opacity-80 mt-1">garantie</div>
          </div>
        </div>

        <div class="mt-8 bg-gradient-to-r from-primary/20 to-accent/20 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
          <h4 class="text-xl font-bold mb-4">Secteurs d'activité</h4>
          <div class="flex flex-wrap gap-3">
            <span class="bg-white/10 rounded-lg px-4 py-2 text-sm">Industrie</span>
            <span class="bg-white/10 rounded-lg px-4 py-2 text-sm">Santé</span>
            <span class="bg-white/10 rounded-lg px-4 py-2 text-sm">Technologie</span>
            <span class="bg-white/10 rounded-lg px-4 py-2 text-sm">Services</span>
            <span class="bg-white/10 rounded-lg px-4 py-2 text-sm">Construction</span>
          </div>
        </div>
      </div>

      <!-- Testimonial -->
      <div class="animate-on-scroll" style="animation-delay: 0.1s;">
        <div class="testimonial-card">
          <div class="flex items-center mb-6">
            <div class="w-16 h-16 rounded-full bg-gradient-to-r from-primary to-secondary flex items-center justify-center text-white text-2xl font-bold mr-4">
              ML
            </div>
            <div>
              <div class="text-xl font-bold">Marie Lambert</div>
              <div class="opacity-80">Directrice Qualité, Groupe Innovatech</div>
            </div>
          </div>
          
          <div class="text-lg mb-6">
            "Kensori Labs a révolutionné notre gestion de la qualité. En 6 mois, nous avons réduit de 70% le temps consacré aux audits et amélioré notre conformité ISO 9001 de manière significative. L'interface intuitive et les fonctionnalités IA font toute la différence."
          </div>
          
          <div class="flex items-center justify-between">
            <div class="flex text-yellow-400">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <div class="text-sm opacity-80">Depuis 2 ans avec Kensori Labs</div>
          </div>
        </div>
        
        <!-- Additional testimonial -->
        <div class="mt-6 p-6 bg-white/5 rounded-2xl border border-white/10">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-400 rounded-full flex items-center justify-center text-white font-bold">
              PT
            </div>
            <div>
              <div class="font-bold">Pierre Thibault</div>
              <div class="text-sm opacity-80">Responsable Qualité, TechSolutions</div>
            </div>
          </div>
          <div class="mt-4 text-sm">
            "L'automatisation des audits et la gestion documentaire ont transformé notre façon de travailler. Une solution indispensable pour toute entreprise sérieuse."
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section id="essai" class="py-20 px-4 md:px-8">
  <div class="max-w-4xl mx-auto">
    <div class="bg-gradient-to-br from-primary/10 via-white to-secondary/10 rounded-3xl p-8 md:p-12 shadow-2xl border border-gray-200 animate-on-scroll">
      <div class="text-center">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
          Prêt à <span class="gradient-text">Transformer</span> Votre Qualité ?
        </h2>
        <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto">
          Commencez votre essai gratuit de 30 jours et découvrez comment Kensori Labs peut optimiser votre SMQ.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-10">
          <a href="#" class="btn-primary inline-flex items-center justify-center px-8 py-4 text-lg">
            <i class="fa-solid fa-rocket mr-2"></i> 
            Démarrer l'Essai Gratuit
          </a>
          
          <a href="#" class="btn-secondary inline-flex items-center justify-center px-8 py-4 text-lg">
            <i class="fa-solid fa-calendar-check mr-2"></i> 
            Réserver une Démo
          </a>
        </div>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-6 text-gray-600 text-sm">
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-check-circle text-green-500"></i>
            <span>Aucune carte bancaire requise</span>
          </div>
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-check-circle text-green-500"></i>
            <span>Support inclus pendant l'essai</span>
          </div>
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-check-circle text-green-500"></i>
            <span>Annulation à tout moment</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white py-16 px-4 md:px-8">
  <div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-12">
      <!-- Logo & Description -->
      <div class="lg:col-span-2">
        <div class="flex items-center gap-3 mb-6">
          <div class="w-10 h-10 bg-gradient-to-br from-primary to-accent rounded-xl flex items-center justify-center shadow-md">
    <img src="/logo.png" alt="Kensori Labs Logo" class="w-8 h-8">
          </div>
          <div class="text-2xl font-bold">
            <span class="gradient-text">Kensori</span>
            <span class="text-white">Labs</span>
          </div>
        </div>
        <p class="opacity-80 mb-6 max-w-md">
          La plateforme intelligente qui révolutionne la gestion de la qualité grâce à l'IA et l'automatisation. Conforme ISO 9001 et bien plus encore.
        </p>
        <div class="flex gap-4">
          <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary transition">
            <i class="fa-brands fa-linkedin-in"></i>
          </a>
          <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary transition">
            <i class="fa-brands fa-twitter"></i>
          </a>
          <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary transition">
            <i class="fa-brands fa-youtube"></i>
          </a>
          <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary transition">
            <i class="fa-brands fa-facebook-f"></i>
          </a>
        </div>
      </div>

      <!-- Produit -->
      <div>
        <h4 class="text-lg font-bold mb-6">Produit</h4>
        <ul class="space-y-3 opacity-80">
          <li><a href="#fonctionnalites" class="hover:text-primary transition hover:pl-2 block">Fonctionnalités</a></li>
          <li><a href="#modules" class="hover:text-primary transition hover:pl-2 block">Modules</a></li>
          <li><a href="#tarifs" class="hover:text-primary transition hover:pl-2 block">Tarifs</a></li>
          <li><a href="#essai" class="hover:text-primary transition hover:pl-2 block">Essai Gratuit</a></li>
          <li><a href="#" class="hover:text-primary transition hover:pl-2 block">Nouveautés</a></li>
        </ul>
      </div>

      <!-- Entreprise -->
      <div>
        <h4 class="text-lg font-bold mb-6">Entreprise</h4>
        <ul class="space-y-3 opacity-80">
          <li><a href="#" class="hover:text-primary transition hover:pl-2 block">À propos</a></li>
          <li><a href="#" class="hover:text-primary transition hover:pl-2 block">Carrières</a></li>
          <li><a href="#" class="hover:text-primary transition hover:pl-2 block">Blog</a></li>
          <li><a href="#" class="hover:text-primary transition hover:pl-2 block">Presse</a></li>
          <li><a href="#" class="hover:text-primary transition hover:pl-2 block">Partenaires</a></li>
        </ul>
      </div>

      <!-- Ressources -->
      <div>
        <h4 class="text-lg font-bold mb-6">Ressources</h4>
        <ul class="space-y-3 opacity-80">
          <li><a href="#" class="hover:text-primary transition hover:pl-2 block">Centre d'aide</a></li>
          <li><a href="#" class="hover:text-primary transition hover:pl-2 block">Documentation</a></li>
          <li><a href="#" class="hover:text-primary transition hover:pl-2 block">Webinaires</a></li>
          <li><a href="#" class="hover:text-primary transition hover:pl-2 block">Formations</a></li>
          <li><a href="#" class="hover:text-primary transition hover:pl-2 block">Mentions légales</a></li>
        </ul>
      </div>
    </div>

    <div class="pt-8 border-t border-white/20 flex flex-col md:flex-row justify-between items-center">
      <div class="text-sm opacity-80 mb-4 md:mb-0">
        © <span id="currentYear"></span> Kensori Labs. Tous droits réservés.
      </div>
      
      <div class="flex flex-wrap gap-6 text-sm opacity-80">
        <a href="#" class="hover:text-primary transition">Politique de confidentialité</a>
        <a href="#" class="hover:text-primary transition">Conditions d'utilisation</a>
        <a href="#" class="hover:text-primary transition">Cookies</a>
        <a href="#" class="hover:text-primary transition">Contact</a>
      </div>
    </div>
  </div>
</footer>

<script>
  // Mobile menu toggle
  const mobileMenuButton = document.getElementById('mobileMenuButton');
  const mobileMenu = document.getElementById('mobileMenu');
  
  mobileMenuButton.addEventListener('click', () => {
    mobileMenu.classList.toggle('open');
    document.body.style.overflow = mobileMenu.classList.contains('open') ? 'hidden' : '';
  });

  // Close mobile menu when clicking a link
  document.querySelectorAll('#mobileMenu a').forEach(link => {
    link.addEventListener('click', () => {
      mobileMenu.classList.remove('open');
      document.body.style.overflow = '';
    });
  });

  // Generate stars
  const starContainer = document.getElementById('stars');
  const starCount = window.innerWidth < 768 ? 40 : 100;

  for (let i = 0; i < starCount; i++) {
    const star = document.createElement('div');
    star.classList.add('star');
    
    const size = Math.random() * 3 + 1;
    star.style.width = `${size}px`;
    star.style.height = `${size}px`;
    star.style.left = `${Math.random() * 100}%`;
    star.style.top = `${Math.random() * 100}%`;
    star.style.opacity = Math.random() * 0.7 + 0.3;
    star.style.animationDuration = `${Math.random() * 5 + 3}s`;
    star.style.animationDelay = `${Math.random() * 2}s`;
    
    starContainer.appendChild(star);
  }

  // Animated counters
  function animateCounter(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);
    const timer = setInterval(() => {
      start += increment;
      if (start >= target) {
        element.textContent = target + (element.getAttribute('data-target') === '100' ? '%' : '+');
        clearInterval(timer);
      } else {
        element.textContent = Math.floor(start) + (element.getAttribute('data-target') === '100' ? '%' : '+');
      }
    }, 16);
  }

  // Intersection Observer for animations
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        
        // Animate counters if in testimonials section
        if (entry.target.closest('section.section-dark')) {
          const counters = entry.target.querySelectorAll('.stat-counter');
          counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            animateCounter(counter, target);
          });
        }
      }
    });
  }, observerOptions);

  // Observe all animate-on-scroll elements
  document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;
      
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        window.scrollTo({
          top: targetElement.offsetTop - 80,
          behavior: 'smooth'
        });
      }
    });
  });

  // Set current year in footer
  document.getElementById('currentYear').textContent = new Date().getFullYear();

  // Navbar scroll effect
  let lastScroll = 0;
  const navbar = document.querySelector('nav');
  
  window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    
    if (currentScroll <= 0) {
      navbar.style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.08)';
    } else if (currentScroll > lastScroll) {
      navbar.style.transform = 'translateY(-100%)';
    } else {
      navbar.style.transform = 'translateY(0)';
      navbar.style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.15)';
    }
    
    lastScroll = currentScroll;
  });

  // Add hover effect to cards on mobile
  if ('ontouchstart' in window) {
    document.querySelectorAll('.card').forEach(card => {
      card.addEventListener('touchstart', function() {
        this.classList.add('hover:translate-y-[-10px]');
      });
      
      card.addEventListener('touchend', function() {
        setTimeout(() => {
          this.classList.remove('hover:translate-y-[-10px]');
        }, 150);
      });
    });
  }
</script>

</body>
</html>