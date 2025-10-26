<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kensori Labs — Connexion</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#0f4c5c',
            accent: '#1e6f86',
            soft: '#f8fafc',
            dark: '#1b1b1b',
          },
          boxShadow: {
            glow: '0 0 25px rgba(30, 111, 134, 0.2)',
          }
        },
      },
    };
  </script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-soft via-white to-soft font-sans text-gray-800">

  <div class="flex flex-col md:flex-row bg-white/90 backdrop-blur-2xl rounded-3xl shadow-glow overflow-hidden w-full max-w-5xl animate-fadeIn border border-gray-100">

    <!-- Section gauche (logo + présentation) -->
    <div class="flex flex-col justify-center items-center bg-white text-gray-800 w-full md:w-1/2 relative p-10">
      <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/paper-fibers.png')] opacity-5"></div>
      <div class="relative z-10 text-center space-y-6">
        <img src="/logo.png" alt="Kensori Labs" class="w-28 h-28 mx-auto drop-shadow-md mb-4">
        <h1 class="text-4xl font-extrabold tracking-tight text-primary">Kensori Labs</h1>
        <p class="text-gray-600 text-lg leading-relaxed max-w-md mx-auto">
          Plateforme QMS intelligente et intuitive pour optimiser vos processus qualité et piloter votre performance.
        </p>
        <div class="mt-8">
          <div class="w-20 h-1 bg-gradient-to-r from-primary to-accent mx-auto rounded-full"></div>
        </div>
      </div>
    </div>

    <!-- Section droite (formulaire sur fond coloré) -->
    <div class="w-full md:w-1/2 p-10 md:p-14 flex flex-col justify-center bg-gradient-to-br from-primary to-accent text-white relative overflow-hidden">
      <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
      <div class="relative z-10">

        <div class="flex flex-col items-center mb-8">
          <img src="/logo.png" alt="Kensori Labs" class="w-14 h-14 mb-3 md:hidden">
          <h2 class="text-2xl font-bold text-white">Connexion à votre compte</h2>
          <p class="text-white/70 text-sm mt-1">Veuillez entrer vos identifiants</p>
        </div>

        @if(session('error'))
          <div class="bg-white/20 border border-red-200 text-red-100 text-sm p-3 rounded-xl mb-4 text-center backdrop-blur-md">
            {{ session('error') }}
          </div>
        @endif

        <form method="POST" action="{{ route('user.login') }}" class="space-y-5">
          @csrf
          <div>
            <label for="email" class="block text-sm font-medium text-white/80 mb-1">Adresse e-mail</label>
            <input type="email" id="email" name="email" required
              class="w-full px-4 py-3 rounded-xl border border-white/20 bg-white/10 text-white placeholder-white/70 focus:ring-4 focus:ring-white/20 focus:border-white/40 transition duration-200 outline-none" 
              placeholder="exemple@domaine.com">
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-white/80 mb-1">Mot de passe</label>
            <div class="relative">
              <input type="password" id="password" name="password" required
                class="w-full px-4 py-3 rounded-xl border border-white/20 bg-white/10 text-white placeholder-white/70 focus:ring-4 focus:ring-white/20 focus:border-white/40 transition duration-200 outline-none pr-10" 
                placeholder="Votre mot de passe">
              <button type="button" id="togglePassword" class="absolute inset-y-0 right-3 flex items-center text-white/60 hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" id="eyeIcon" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                </svg>
              </button>
            </div>
          </div>

          <button type="submit" 
            class="w-full bg-white text-primary font-semibold py-3 rounded-xl shadow-md hover:bg-gray-100 hover:shadow-xl hover:-translate-y-0.5 transform transition-all duration-200">
            Se connecter
          </button>
        </form>

        <footer class="text-center text-white/70 text-sm mt-8">
          © <span id="year"></span> Kensori Labs — Tous droits réservés.
        </footer>
      </div>
    </div>
  </div>

  <script>
    // Affichage de l'année
    document.getElementById("year").textContent = new Date().getFullYear();

    // Toggle mot de passe
    const togglePassword = document.getElementById("togglePassword");
    const password = document.getElementById("password");
    togglePassword.addEventListener("click", () => {
      password.type = password.type === "password" ? "text" : "password";
    });
  </script>

  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
      animation: fadeIn 0.8s ease-out;
    }
  </style>
</body>
</html>
