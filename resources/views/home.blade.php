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
            primary: '#1e6f86',
            accent: '#0f4c5c',
            bg1: '#cfdee9',
            bg2: '#f1f5fb',
          },
        },
      },
    };
  </script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-bg1 to-bg2 font-sans">

  <div class="flex flex-col md:flex-row bg-white/90 backdrop-blur-lg shadow-2xl rounded-3xl overflow-hidden w-full max-w-5xl animate-fadeIn">
    
    <!-- Section gauche -->
    <div class="hidden md:flex flex-col justify-center items-start bg-gradient-to-br from-primary to-accent text-white p-12 w-1/2 relative">
      <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
      <div class="relative z-10">
        <div class="flex items-center mb-6">
          <div class="bg-white/20 rounded-xl p-4 mr-3 animate-pulse">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="white" class="w-10 h-10">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12h18M3 6h18M3 18h18"/>
            </svg>
          </div>
          <h1 class="text-3xl font-extrabold tracking-wide">Kensori Labs</h1>
        </div>
        <p class="text-white/90 text-lg leading-relaxed">
          Plateforme QMS moderne pour la gestion de la qualité et le suivi des processus d'entreprise.
        </p>
      </div>
    </div>

    <!-- Section droite : formulaire -->
    <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
      <h2 class="text-2xl font-bold text-gray-800 mb-2 text-center">Connexion à votre compte</h2>
      <p class="text-gray-500 text-center mb-6">Veuillez entrer vos identifiants</p>

      @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-600 text-sm p-3 rounded-xl mb-4 text-center">
          {{ session('error') }}
        </div>
      @endif

      <form method="POST" action="{{ route('user.login') }}" class="space-y-5">
        @csrf
        <div>
          <label for="email" class="block text-sm font-medium text-gray-600 mb-1">Adresse e-mail</label>
          <input type="email" id="email" name="email" required
            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-primary/20 focus:border-primary transition duration-200 outline-none" 
            placeholder="exemple@domaine.com">
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-600 mb-1">Mot de passe</label>
          <div class="relative">
            <input type="password" id="password" name="password" required
              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-4 focus:ring-primary/20 focus:border-primary transition duration-200 outline-none pr-10" 
              placeholder="Votre mot de passe">
            <button type="button" id="togglePassword" class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-primary transition">
              <svg xmlns="http://www.w3.org/2000/svg" id="eyeIcon" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
              </svg>
            </button>
          </div>
        </div>

        <button type="submit" 
          class="w-full bg-gradient-to-r from-accent to-primary text-white font-semibold py-3 rounded-xl shadow-md hover:shadow-xl transition transform hover:-translate-y-0.5">
          Se connecter
        </button>
      </form>

      <footer class="text-center text-gray-400 text-sm mt-8">
        © <span id="year"></span> Kensori Labs — Tous droits réservés.
      </footer>
    </div>
  </div>

  <script>
    // Affichage de l'année actuelle
    document.getElementById("year").textContent = new Date().getFullYear();

    // Toggle mot de passe
    const togglePassword = document.getElementById("togglePassword");
    const password = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");

    togglePassword.addEventListener("click", () => {
      const isHidden = password.type === "password";
      password.type = isHidden ? "text" : "password";
      eyeIcon.setAttribute("d", isHidden 
        ? "M3 3l18 18M10.73 6.73a9 9 0 0110.29 5.27 9 9 0 01-16.5 0A9 9 0 0110.73 6.73z" 
        : "M15 12a3 3 0 11-6 0 3 3 0 016 0z"
      );
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
