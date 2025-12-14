<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kensori Labs - Révolutionnez Votre SMQ avec l'Intelligence Artificielle</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    /* Effet étoiles animées */
    .star-field { position: absolute; inset: 0; overflow: hidden; z-index: 0; }
    .star { position: absolute; width: 3px; height: 3px; background: white; border-radius: 50%; animation: moveStar linear infinite; opacity: 0.8; }
    @keyframes moveStar {
      0% { transform: translateY(0); opacity: .3; }
      100% { transform: translateY(800px); opacity: 1; }
    }

    /* Animation glow douce sur la navbar */
    @keyframes navGlow {
      0% { box-shadow: 0 0 15px rgba(0, 180, 216, .2); }
      50% { box-shadow: 0 0 25px rgba(0, 180, 216, .4); }
      100% { box-shadow: 0 0 15px rgba(0, 180, 216, .2); }
    }

    /* Effet underline-slide pour les liens */
    .nav-link {
      position: relative;
      padding-bottom: 4px;
    }
    .nav-link::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      width: 0;
      height: 2px;
      background: #0ea5e9;
      transition: 0.3s ease;
    }
    .nav-link:hover::after {
      width: 100%;
    }

    /* Glow pulse sur les boutons */
    .glow-btn {
      animation: pulseGlow 2.5s infinite ease-in-out;
    }
    @keyframes pulseGlow {
      0% { box-shadow: 0 0 10px rgba(14, 165, 233, 0.3); }
      50% { box-shadow: 0 0 20px rgba(14, 165, 233, 0.6); }
      100% { box-shadow: 0 0 10px rgba(14, 165, 233, 0.3); }
    }

    /* Animation card hover */
    .card-hover {
      transition: all 0.3s ease;
    }
    .card-hover:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    /* Gradient text */
    .gradient-text {
      background: linear-gradient(90deg, #0ea5e9 0%, #3b82f6 50%, #8b5cf6 100%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    /* Section background */
    .section-bg {
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    /* Stat counter animation */
    .stat-counter {
      transition: all 0.5s ease;
    }

    /* Logo styles */
    .logo {
      font-weight: 800;
      letter-spacing: -0.5px;
    }
  </style>

  <!-- Configuration Tailwind -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#0ea5e9',
            secondary: '#3b82f6',
            accent: '#8b5cf6',
            dark: '#0f172a',
            light: '#f8fafc'
          },
          animation: {
            'float': 'float 6s ease-in-out infinite',
            'pulse-slow': 'pulse 3s ease-in-out infinite',
          }
        }
      }
    }
  </script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">


<!-- NAVBAR PREMIUM + ANIMATIONS -->
<nav class="w-full backdrop-blur-xl bg-white/95 border-b border-gray-200
     px-6 md:px-12 py-4 flex justify-between items-center sticky top-0 z-50 shadow-md
     animate-[navGlow_6s_infinite]">

  <div class="flex items-center gap-2">
    <div class="w-10 h-10 to-accent rounded-xl flex items-center justify-center shadow-md">
<img src="{{ asset('logo.png') }}" alt="Logo QualiSmart" class="w-full h-full object-contain">
</div>

    <div class="text-dark text-2xl font-bold tracking-tight logo">
      <span class="gradient-text">KENSORI LABS</span>
    </div>
  </div>

  <div class="hidden md:flex gap-8 text-base font-medium">
    <a href="#" class="text-gray-700 nav-link hover:text-primary transition">Accueil</a>
    <a href="#" class="text-gray-700 nav-link hover:text-primary transition">Fonctionnalités</a>
    <a href="#" class="text-gray-700 nav-link hover:text-primary transition">Modules</a>
    <a href="#" class="text-gray-700 nav-link hover:text-primary transition">Tarifs</a>
    <a href="#" class="text-gray-700 nav-link hover:text-primary transition">Ressources</a>
  </div>

  <div class="flex gap-3 items-center">
    <a href="{{ route('login') }}" 
       class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg shadow-sm flex items-center gap-2 
              hover:bg-gray-200 transition font-medium
              hover:shadow-gray-300/40 border border-gray-200">
      <i class="fa-solid fa-key text-primary"></i>
      <span class="hidden sm:inline">Connexion</span>
    </a>

    <a href="#" 
       class="px-4 py-2 rounded-lg shadow-md flex items-center gap-2 bg-gradient-to-r from-primary to-secondary text-white 
              hover:opacity-90 transition font-semibold
              hover:shadow-primary/40">
      <i class="fa-solid fa-rocket"></i>
      <span class="hidden sm:inline">Essai Gratuit</span>
      <span class="sm:hidden">Essai</span>
    </a>
  </div>
</nav>


<!-- HERO SECTION AVEC EFFET ÉTOILES -->
<section class="relative mx-4 md:mx-8 mt-6 md:mt-8 rounded-2xl overflow-hidden text-white px-6 md:px-16 py-16 md:py-24 
                bg-gradient-to-br from-gray-900 via-dark to-gray-900 shadow-2xl">

  <div class="star-field" id="stars"></div>

  <div class="relative z-10 max-w-6xl mx-auto">
    <div class="flex flex-col lg:flex-row items-center gap-8">
      <!-- Left Content -->
      <div class="lg:w-1/2">
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full text-sm mb-6">
          <i class="fa-solid fa-medal text-yellow-300"></i>
          <span>Solution certifiée ISO 9001:2015</span>
        </div>
        
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight">
          Optimisez Votre Qualité avec <span class="gradient-text">l'Intelligence ISO 9001</span>
        </h1>

        <p class="mt-6 text-lg opacity-90 max-w-xl">
          Votre plateforme intégrée pour une gestion agile, performante et conforme de votre Système de Management de la Qualité.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 mt-8">
          <a href="#" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-primary to-secondary 
                         text-white font-semibold text-lg rounded-xl shadow-lg transition glow-btn gap-2">
            <i class="fa-solid fa-play"></i> Commencer l'Essai Gratuit
          </a>
          
          <a href="#" class="inline-flex items-center justify-center px-6 py-3 bg-white/10 backdrop-blur-sm 
                         text-white font-medium text-lg rounded-xl border border-white/20 hover:bg-white/20 transition gap-2">
            <i class="fa-solid fa-circle-play"></i> Voir la Démo
          </a>
        </div>

        <!-- Stats -->
        <div class="flex flex-wrap gap-6 mt-10">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center">
              <i class="fa-solid fa-shield-halved text-primary"></i>
            </div>
            <div>
              <div class="text-2xl font-bold">100%</div>
              <div class="text-sm opacity-80">Conforme ISO 9001</div>
            </div>
          </div>
          
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
              <i class="fa-solid fa-bolt text-green-400"></i>
            </div>
            <div>
              <div class="text-2xl font-bold">+65%</div>
              <div class="text-sm opacity-80">Gain de temps</div>
            </div>
          </div>
          
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center">
              <i class="fa-solid fa-users text-purple-400"></i>
            </div>
            <div>
              <div class="text-2xl font-bold">500+</div>
              <div class="text-sm opacity-80">Clients satisfaits</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Image/Illustration -->
      <div class="lg:w-1/2 flex justify-center">
        <div class="relative w-full max-w-lg">
          <div class="absolute -top-6 -right-6 w-40 h-40 bg-primary/10 rounded-full blur-3xl"></div>
          <div class="absolute -bottom-6 -left-6 w-40 h-40 bg-accent/10 rounded-full blur-3xl"></div>
          
          <div class="relative bg-gradient-to-br from-white/5 to-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-8 shadow-2xl">
            <div class="flex justify-center mb-6">
              <div class="w-20 h-20 bg-gradient-to-br from-primary to-accent rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fa-solid fa-brain text-white text-3xl"></i>
              </div>
            </div>
            <h3 class="text-2xl font-bold text-center mb-4">Solution Smart Complète</h3>
            <div class="space-y-3">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center">
                  <i class="fa-solid fa-check text-green-400"></i>
                </div>
                <span>Audits automatisés</span>
              </div>
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center">
                  <i class="fa-solid fa-robot text-blue-400"></i>
                </div>
                <span>IA prédictive</span>
              </div>
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-purple-500/20 rounded-lg flex items-center justify-center">
                  <i class="fa-solid fa-chart-bar text-purple-400"></i>
                </div>
                <span>Tableaux de bord temps réel</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- SECTION RÉVOLUTIONNEZ VOTRE SMQ -->
<section class="py-16 md:py-24 px-4 md:px-8 section-bg">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-16">
      <h2 class="text-4xl md:text-5xl font-bold mb-6">
        <span class="gradient-text">Révolutionnez Votre SMQ</span> avec Notre Solution Smart
      </h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        Une plateforme intelligente qui transforme votre gestion de la qualité grâce à l'IA et l'automatisation
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Card 1 -->
      <div class="bg-white rounded-2xl p-6 shadow-lg card-hover border border-gray-100">
        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-xl flex items-center justify-center mb-6 shadow-md">
          <i class="fa-solid fa-robot text-white text-2xl"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Intelligence Artificielle & Automatisation</h3>
        <p class="text-gray-600 mb-4">
          Automatisez vos processus qualité et laissez notre IA optimiser vos décisions.
        </p>
        <div class="flex items-center text-primary font-medium">
          <span>Découvrir</span>
          <i class="fa-solid fa-arrow-right ml-2"></i>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="bg-white rounded-2xl p-6 shadow-lg card-hover border border-gray-100">
        <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-400 rounded-xl flex items-center justify-center mb-6 shadow-md">
          <i class="fa-solid fa-file-shield text-white text-2xl"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Conformité Simplifiée</h3>
        <p class="text-gray-600 mb-4">
          Restez conforme aux normes ISO 9001 sans effort avec notre suivi intelligent.
        </p>
        <div class="flex items-center text-primary font-medium">
          <span>Explorer</span>
          <i class="fa-solid fa-arrow-right ml-2"></i>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="bg-white rounded-2xl p-6 shadow-lg card-hover border border-gray-100">
        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-400 rounded-xl flex items-center justify-center mb-6 shadow-md">
          <i class="fa-solid fa-lightbulb text-white text-2xl"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Prise de Décision Éclairée</h3>
        <p class="text-gray-600 mb-4">
          Des analyses prédictives et tableaux de bord intelligents pour mieux décider.
        </p>
        <div class="flex items-center text-primary font-medium">
          <span>En savoir plus</span>
          <i class="fa-solid fa-arrow-right ml-2"></i>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="bg-white rounded-2xl p-6 shadow-lg card-hover border border-gray-100">
        <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-yellow-400 rounded-xl flex items-center justify-center mb-6 shadow-md">
          <i class="fa-solid fa-users-gear text-white text-2xl"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Collaboration Optimisée</h3>
        <p class="text-gray-600 mb-4">
          Travaillez efficacement avec toutes vos équipes sur une plateforme unifiée.
        </p>
        <div class="flex items-center text-primary font-medium">
          <span>Découvrir</span>
          <i class="fa-solid fa-arrow-right ml-2"></i>
        </div>
      </div>
    </div>

    <div class="text-center mt-12">
      <a href="#" class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-primary to-secondary 
                     text-white font-semibold text-lg rounded-xl shadow-lg hover:shadow-xl transition gap-3">
        <i class="fa-solid fa-eye"></i> Voir Toutes les Fonctionnalités
      </a>
    </div>
  </div>
</section>


<!-- SECTION MODULES INTUITIFS -->
<section class="py-16 md:py-24 px-4 md:px-8">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-16">
      <h2 class="text-4xl md:text-5xl font-bold mb-6">
        Des Modules <span class="gradient-text">Intuitifs</span> pour Chaque Aspect de Votre Qualité
      </h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        Une suite complète d'outils spécialement conçus pour optimiser chaque processus de votre SMQ
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Module 1 -->
      <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-8 shadow-xl border border-gray-200 card-hover">
        <div class="flex items-start justify-between mb-6">
          <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-xl flex items-center justify-center shadow-lg">
            <i class="fa-solid fa-diagram-project text-white text-2xl"></i>
          </div>
          <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">POPULAIRE</span>
        </div>
        <h3 class="text-2xl font-bold mb-4">Gestion Documentaire Intelligente</h3>
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
        <a href="#" class="inline-flex items-center text-primary font-semibold">
          Explorer le module <i class="fa-solid fa-arrow-right ml-2"></i>
        </a>
      </div>

      <!-- Module 2 -->
      <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-8 shadow-xl border border-gray-200 card-hover">
        <div class="flex items-start justify-between mb-6">
          <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-400 rounded-xl flex items-center justify-center shadow-lg">
            <i class="fa-solid fa-clipboard-check text-white text-2xl"></i>
          </div>
          <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-3 py-1 rounded-full">ESSENTIEL</span>
        </div>
        <h3 class="text-2xl font-bold mb-4">Audits & Non-Conformités</h3>
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
        <a href="#" class="inline-flex items-center text-primary font-semibold">
          Explorer le module <i class="fa-solid fa-arrow-right ml-2"></i>
        </a>
      </div>

      <!-- Module 3 -->
      <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-8 shadow-xl border border-gray-200 card-hover">
        <div class="flex items-start justify-between mb-6">
          <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-400 rounded-xl flex items-center justify-center shadow-lg">
            <i class="fa-solid fa-chart-line text-white text-2xl"></i>
          </div>
          <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">NOUVEAU</span>
        </div>
        <h3 class="text-2xl font-bold mb-4">Tableaux de Bord Personnalisés</h3>
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
        <a href="#" class="inline-flex items-center text-primary font-semibold">
          Explorer le module <i class="fa-solid fa-arrow-right ml-2"></i>
        </a>
      </div>
    </div>
  </div>
</section>


<!-- SECTION TÉMOIGNAGES ET TRANSFORMATION -->
<section class="py-16 md:py-24 px-4 md:px-8 bg-gradient-to-br from-dark to-gray-900 text-white">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-16">
      <h2 class="text-4xl md:text-5xl font-bold mb-6">
        Comment <span class="gradient-text">Kensori Labs Transforme</span> Votre Qualité ?
      </h2>
      <p class="text-xl opacity-80 max-w-3xl mx-auto">
        Rejoignez les entreprises qui optimisent leur SMQ avec notre solution intelligente
      </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <!-- Stats -->
      <div>
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
          <h4 class="text-xl font-bold mb-4">Les entreprises qui nous font confiance</h4>
          <div class="flex flex-wrap gap-4 items-center">
            <div class="bg-white/10 rounded-lg px-4 py-2">Industrie</div>
            <div class="bg-white/10 rounded-lg px-4 py-2">Santé</div>
            <div class="bg-white/10 rounded-lg px-4 py-2">Technologie</div>
            <div class="bg-white/10 rounded-lg px-4 py-2">Services</div>
            <div class="bg-white/10 rounded-lg px-4 py-2">Construction</div>
          </div>
        </div>
      </div>

      <!-- Témoignage -->
      <div class="bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
        <div class="flex items-center mb-6">
          <div class="w-16 h-16 rounded-full bg-gradient-to-r from-primary to-secondary flex items-center justify-center text-white text-2xl font-bold mr-4">
            ML
          </div>
          <div>
            <div class="text-xl font-bold">Marie Lambert</div>
            <div class="opacity-80">Directrice Qualité, Groupe Innovatech</div>
          </div>
        </div>
        
        <div class="text-lg italic mb-6">
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
    </div>
  </div>
</section>


<!-- SECTION APPEL À L'ACTION -->
<section class="py-16 md:py-24 px-4 md:px-8">
  <div class="max-w-4xl mx-auto">
    <div class="bg-gradient-to-br from-primary/10 via-white to-secondary/10 rounded-3xl p-8 md:p-12 shadow-2xl border border-gray-200">
      <div class="text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">
          Prêt à <span class="gradient-text">Transformer</span> Votre Gestion de la Qualité ?
        </h2>
        <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto">
          Commencez votre essai gratuit de 30 jours et découvrez comment Kensori Labs peut optimiser votre SMQ.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-10">
          <a href="#" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-primary to-secondary 
                         text-white font-bold text-lg rounded-xl shadow-xl hover:shadow-2xl transition gap-3">
            <i class="fa-solid fa-rocket"></i> Démarrer l'Essai Gratuit
          </a>
          
          <a href="#" class="inline-flex items-center justify-center px-8 py-4 bg-white text-gray-800 
                         font-semibold text-lg rounded-xl shadow-lg border border-gray-300 hover:bg-gray-50 transition gap-3">
            <i class="fa-solid fa-calendar-check"></i> Réserver une Démo
          </a>
        </div>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-8 text-gray-600">
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


<!-- FOOTER -->
<footer class="bg-dark text-white py-12 px-4 md:px-8">
  <div class="max-w-6xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-12">
      <!-- Logo & Description -->
      <div class="lg:col-span-2">
        <div class="flex items-center gap-2 mb-6">
          <div class="w-10 h-10 bg-gradient-to-br from-primary to-accent rounded-xl flex items-center justify-center shadow-md">
            <i class="fa-solid fa-chart-line text-white text-lg"></i>
          </div>
          <div class="text-2xl font-bold logo">
            <span class="gradient-text">Kensori Labs</span>
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
          <li><a href="#" class="hover:text-primary transition">Fonctionnalités</a></li>
          <li><a href="#" class="hover:text-primary transition">Modules</a></li>
          <li><a href="#" class="hover:text-primary transition">Tarifs</a></li>
          <li><a href="#" class="hover:text-primary transition">Essai Gratuit</a></li>
          <li><a href="#" class="hover:text-primary transition">Nouveautés</a></li>
        </ul>
      </div>

      <!-- Entreprise -->
      <div>
        <h4 class="text-lg font-bold mb-6">Entreprise</h4>
        <ul class="space-y-3 opacity-80">
          <li><a href="#" class="hover:text-primary transition">À propos</a></li>
          <li><a href="#" class="hover:text-primary transition">Carrières</a></li>
          <li><a href="#" class="hover:text-primary transition">Blog</a></li>
          <li><a href="#" class="hover:text-primary transition">Presse</a></li>
          <li><a href="#" class="hover:text-primary transition">Partenaires</a></li>
        </ul>
      </div>

      <!-- Ressources -->
      <div>
        <h4 class="text-lg font-bold mb-6">Ressources</h4>
        <ul class="space-y-3 opacity-80">
          <li><a href="#" class="hover:text-primary transition">Centre d'aide</a></li>
          <li><a href="#" class="hover:text-primary transition">Documentation</a></li>
          <li><a href="#" class="hover:text-primary transition">Webinaires</a></li>
          <li><a href="#" class="hover:text-primary transition">Formations</a></li>
          <li><a href="#" class="hover:text-primary transition">Mentions légales</a></li>
        </ul>
      </div>
    </div>

    <div class="pt-8 border-t border-white/20 flex flex-col md:flex-row justify-between items-center">
      <div class="text-sm opacity-80 mb-4 md:mb-0">
© <?= date('Y'); ?> Kensori. Tous droits réservés.
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
  // Génération dynamique d'étoiles animées
  const starContainer = document.getElementById("stars");
  const starCount = 80;

  for (let i = 0; i < starCount; i++) {
    const star = document.createElement("div");
    star.classList.add("star");

    const size = Math.random() * 4 + 2;
    star.style.width = size + "px";
    star.style.height = size + "px";
    star.style.left = Math.random() * 100 + "%";
    star.style.top = Math.random() * -200 + "px";
    star.style.animationDuration = Math.random() * 8 + 4 + "s";

    starContainer.appendChild(star);
  }

  // Animation des compteurs de statistiques
  function animateCounter(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);
    const timer = setInterval(() => {
      start += increment;
      if (start >= target) {
        element.textContent = target + (element.getAttribute("data-target") === "100" ? "%" : "+");
        clearInterval(timer);
      } else {
        element.textContent = Math.floor(start) + (element.getAttribute("data-target") === "100" ? "%" : "+");
      }
    }, 16);
  }

  // Lancer l'animation des compteurs quand la section est visible
  const observerOptions = {
    threshold: 0.5
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const counters = document.querySelectorAll('.stat-counter');
        counters.forEach(counter => {
          const target = parseInt(counter.getAttribute('data-target'));
          animateCounter(counter, target);
        });
        observer.disconnect();
      }
    });
  }, observerOptions);

  const statsSection = document.querySelector('section.bg-gradient-to-br.from-dark');
  if (statsSection) {
    observer.observe(statsSection);
  }

  // Animation pour les cartes au scroll
  const cardObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = 1;
        entry.target.style.transform = 'translateY(0)';
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.card-hover').forEach(card => {
    card.style.opacity = 0;
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    cardObserver.observe(card);
  });
</script>

</body>
</html>