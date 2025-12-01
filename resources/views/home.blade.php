<!-- Version améliorée avec navbar animée + features premium + effet étoiles -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kensori Labs - Optimisez Votre Qualité</title>

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
      0% { box-shadow: 0 0 15px rgba(0, 255, 255, .2); }
      50% { box-shadow: 0 0 25px rgba(0, 255, 255, .4); }
      100% { box-shadow: 0 0 15px rgba(0, 255, 255, .2); }
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
      background: #2dd4bf;
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
      0% { box-shadow: 0 0 10px rgba(45, 212, 191, 0.3); }
      50% { box-shadow: 0 0 20px rgba(45, 212, 191, 0.6); }
      100% { box-shadow: 0 0 10px rgba(45, 212, 191, 0.3); }
    }

    /* Styles des Features */
    .features {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 2rem;
      padding: 60px 20px;
      margin-top: 60px;
    }
    .feature {
      background: white;
      padding: 25px;
      border-radius: 18px;
      text-align: center;
      transition: 0.3s;
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }
    .feature:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 25px rgba(0,0,0,0.12);
    }
    .feature img {
      width: 80px;
      margin: auto;
    }
  </style>

</head>
<body class="bg-gray-50 text-gray-900">


<!-- NAVBAR PREMIUM + ANIMATIONS -->
<nav class="w-full backdrop-blur-xl bg-[#0a2a43]/90 border-b border-white/10
     px-10 py-5 flex justify-between items-center sticky top-0 z-50 shadow-xl
     animate-[navGlow_6s_infinite]">

  <div class="text-white text-2xl font-bold tracking-wide flex items-center gap-2">
    <i class="fa-solid fa-flask text-teal-300"></i> Kensori Labs
  </div>

  <div class="flex gap-8 text-lg font-medium">
    <a href="#" class="text-white nav-link hover:text-teal-300 transition">Accueil</a>
    <a href="#" class="text-white nav-link hover:text-teal-300 transition">Fonctionnalités</a>
    <a href="#" class="text-white nav-link hover:text-teal-300 transition">Tarifs</a>
  </div>

  <div class="flex gap-4 items-center">
  <a href="#" 
     class="px-5 py-2 bg-[#0d2338] text-white rounded-lg shadow-lg flex items-center gap-2 
            hover:bg-[#12314d] transition font-medium
            hover:shadow-teal-500/40">
      <i class="fa-solid fa-key text-teal-300"></i>
      Login
  </a>

  <a href="#" 
     class="px-6 py-2 rounded-lg shadow-lg flex items-center gap-2 bg-teal-500 text-white 
            hover:bg-teal-400 transition font-semibold
            hover:shadow-teal-500/40">
      <i class="fa-solid fa-user-plus"></i>
      Inscription
  </a>
</div>

</nav>


<!-- HERO SECTION AVEC EFFET ÉTOILES -->
<section class="relative mx-6 mt-6 rounded-2xl overflow-hidden text-white px-10 py-24 
                bg-gradient-to-r from-cyan-800/90 to-teal-500/80 shadow-2xl">

  <div class="star-field" id="stars"></div>

  <div class="relative z-10">
    <h1 class="text-4xl md:text-5xl font-extrabold max-w-2xl leading-tight">
      Optimisez Votre Qualité avec l’Intelligence ISO 9001
    </h1>

    <p class="mt-4 text-lg opacity-90 max-w-xl">
      Une plateforme intelligente pour une gestion agile, performante et conforme.
    </p>

    <a href="#" class="inline-block mt-6 px-6 py-3 bg-teal-400 hover:bg-teal-300 
                       text-gray-900 font-semibold text-lg rounded-xl shadow-lg transition glow-btn">
      Commencer l'Essai Gratuit
    </a>

    <!-- Stars -->
    <div class="flex gap-1 mt-6 text-yellow-300 text-xl">
      <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
      <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
    </div>

    <!-- Icons -->
    <div class="mt-6 flex flex-col md:flex-row gap-6 text-white/90 text-base">
      <div class="flex items-center gap-3">
        <i class="fa-solid fa-shield-halved text-teal-300"></i> Conforme ISO 9001
      </div>
      <div class="flex items-center gap-3">
        <i class="fa-solid fa-bolt text-teal-300"></i> Gain de temps significatif
      </div>
    </div>
  </div>
</section>


<!-- ⭐ SMART FEATURES BLOCK -->
<section class="features">
  <div class="feature">
    <img src="https://cdn-icons-png.flaticon.com/512/4712/4712100.png">
    <h3 class="text-xl font-semibold mt-4">Intelligence Artificielle & Automatisation</h3>
    <p class="text-gray-600 mt-2">Automatisez vos tâches et décuplez votre efficacité.</p>
  </div>

  <div class="feature">
    <img src="https://cdn-icons-png.flaticon.com/512/1828/1828640.png">
    <h3 class="text-xl font-semibold mt-4">Conformité Simplifiée</h3>
    <p class="text-gray-600 mt-2">Restez totalement conforme aux normes ISO sans effort.</p>
  </div>

  <div class="feature">
    <img src="https://cdn-icons-png.flaticon.com/512/3590/3590417.png">
    <h3 class="text-xl font-semibold mt-4">Prise de Décision Éclairée</h3>
    <p class="text-gray-600 mt-2">Appuyez-vous sur des analyses intelligentes pour décider mieux.</p>
  </div>

  <div class="feature">
    <img src="https://cdn-icons-png.flaticon.com/512/993/993707.png">
    <h3 class="text-xl font-semibold mt-4">Collaboration Optimisée</h3>
    <p class="text-gray-600 mt-2">Travaillez efficacement avec toutes vos équipes.</p>
  </div>
</section>



<script>
  // Génération dynamique d'étoiles animées
  const starContainer = document.getElementById("stars");
  const starCount = 60;

  for (let i = 0; i < starCount; i++) {
    const star = document.createElement("div");
    star.classList.add("star");

    const size = Math.random() * 4 + 2;
    star.style.width = size + "px";
    star.style.height = size + "px";
    star.style.left = Math.random() * 100 + "%";
    star.style.top = Math.random() * -200 + "px";
    star.style.animationDuration = Math.random() * 6 + 4 + "s";

    starContainer.appendChild(star);
  }
</script>

</body>
</html>
