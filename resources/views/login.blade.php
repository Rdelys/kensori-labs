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
            lightblue: '#e6f4f7',
            primarylight: '#1a7c8c',
          },
          boxShadow: {
            'glow': '0 0 35px rgba(30, 111, 134, 0.25)',
            'glow-strong': '0 0 45px rgba(30, 111, 134, 0.35)',
            'inner-glow': 'inset 0 2px 15px rgba(255, 255, 255, 0.15)',
            'card': '0 20px 60px rgba(15, 76, 92, 0.1)',
          },
          animation: {
            'float': 'float 6s ease-in-out infinite',
            'pulse-gentle': 'pulse 4s ease-in-out infinite',
            'slide-in': 'slideIn 0.8s ease-out forwards',
            'fade-in-up': 'fadeInUp 0.7s ease-out forwards',
            'scale-in': 'scaleIn 0.5s ease-out forwards',
            'shimmer': 'shimmer 3s infinite linear',
            'gradient-flow': 'gradientFlow 8s ease infinite',
            'particle-drift': 'particleDrift 20s linear infinite',
          },
          keyframes: {
            float: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-10px)' }
            },
            slideIn: {
              '0%': { opacity: '0', transform: 'translateX(-20px)' },
              '100%': { opacity: '1', transform: 'translateX(0)' }
            },
            fadeInUp: {
              '0%': { opacity: '0', transform: 'translateY(20px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' }
            },
            scaleIn: {
              '0%': { opacity: '0', transform: 'scale(0.95)' },
              '100%': { opacity: '1', transform: 'scale(1)' }
            },
            shimmer: {
              '0%': { backgroundPosition: '-1000px 0' },
              '100%': { backgroundPosition: '1000px 0' }
            },
            gradientFlow: {
              '0%, 100%': { backgroundPosition: '0% 50%' },
              '50%': { backgroundPosition: '100% 50%' }
            },
            particleDrift: {
              '0%': { transform: 'translateY(100vh) translateX(0) rotate(0deg)' },
              '100%': { transform: 'translateY(-100vh) translateX(100px) rotate(180deg)' }
            }
          },
          backgroundImage: {
            'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
            'gradient-subtle': 'linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%)',
            'gradient-mesh': 'linear-gradient(45deg, transparent 49%, rgba(30, 111, 134, 0.05) 50%, transparent 51%), linear-gradient(-45deg, transparent 49%, rgba(15, 76, 92, 0.05) 50%, transparent 51%)',
          }
        },
      },
    };
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="min-h-screen flex items-center justify-center font-sans text-gray-800 relative overflow-hidden">

  <!-- Top Background Elements -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none bg-gradient-subtle">
    <!-- Animated mesh pattern -->
    <div class="absolute inset-0 opacity-30" style="background-size: 60px 60px; background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%231e6f86" fill-opacity="0.05"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    
    <!-- Large gradient orbs -->
    <div class="absolute top-0 left-0 w-[800px] h-[800px] bg-gradient-to-br from-primary/10 via-accent/5 to-transparent rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 animate-gradient-flow"></div>
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-gradient-to-bl from-accent/10 via-primary/5 to-transparent rounded-full blur-3xl translate-x-1/3 -translate-y-1/3 animate-gradient-flow" style="animation-delay: 2s;"></div>
    
    <!-- Animated particles -->
    <div class="absolute inset-0">
      <div class="particle absolute w-2 h-2 bg-white/10 rounded-full blur-sm animate-particle-drift" style="top: 10%; left: 20%; animation-delay: 0s;"></div>
      <div class="particle absolute w-3 h-3 bg-accent/10 rounded-full blur-sm animate-particle-drift" style="top: 30%; left: 40%; animation-delay: 5s;"></div>
      <div class="particle absolute w-1 h-1 bg-primary/10 rounded-full blur-sm animate-particle-drift" style="top: 60%; left: 10%; animation-delay: 10s;"></div>
      <div class="particle absolute w-2 h-2 bg-white/8 rounded-full blur-sm animate-particle-drift" style="top: 80%; left: 60%; animation-delay: 15s;"></div>
      <div class="particle absolute w-4 h-4 bg-accent/8 rounded-full blur-sm animate-particle-drift" style="top: 40%; left: 80%; animation-delay: 8s;"></div>
    </div>
    
    <!-- Floating geometric shapes -->
    <div class="absolute top-20 left-1/4 w-40 h-40 border border-primary/5 rounded-3xl rotate-45 animate-float"></div>
    <div class="absolute bottom-40 right-1/4 w-32 h-32 border border-accent/5 rounded-full animate-float" style="animation-delay: 3s;"></div>
    <div class="absolute top-2/3 left-3/4 w-24 h-24 border border-primary/3 rounded-xl rotate-12 animate-float" style="animation-delay: 6s;"></div>
  </div>

  <div class="flex flex-col md:flex-row bg-white/95 backdrop-blur-2xl rounded-3xl shadow-glow overflow-hidden w-full max-w-5xl animate-scale-in border border-white/50 relative z-10 transform transition-all duration-300 hover:shadow-glow-strong">

    <!-- Section gauche (logo + présentation) -->
    <div class="flex flex-col justify-center items-center bg-gradient-to-br from-white via-lightblue/30 to-white text-gray-800 w-full md:w-1/2 relative p-10 md:p-12">
      <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/paper-fibers.png')] opacity-5"></div>
      
      <!-- Decorative elements -->
      <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary to-transparent opacity-30"></div>
      <div class="absolute -top-6 -right-6 w-32 h-32 bg-primary/5 rounded-full blur-xl"></div>
      
      <div class="relative z-10 text-center space-y-6 animate-fade-in-up">
        <!-- Animated logo container -->
        <div class="relative mb-4">
          <div class="absolute inset-0 bg-gradient-to-r from-primary to-accent rounded-2xl blur-lg opacity-30 animate-pulse-gentle"></div>
          <img src="/logo.png" alt="Kensori Labs" class="w-32 h-32 mx-auto drop-shadow-lg relative z-10 transform transition-transform duration-300 hover:scale-105">
        </div>
        
        <h1 class="text-4xl font-extrabold tracking-tight text-primary relative">
          Kensori Labs
          <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-gradient-to-r from-primary to-accent rounded-full"></span>
        </h1>
        
        <p class="text-gray-600 text-lg leading-relaxed max-w-md mx-auto relative">
          <i class="fas fa-quote-left text-primary/30 text-xl mr-2"></i>
          Plateforme QMS intelligente et intuitive pour optimiser vos processus qualité et piloter votre performance.
          <i class="fas fa-quote-right text-primary/30 text-xl ml-2"></i>
        </p>
        
        <!-- Features list -->
        <div class="pt-6 space-y-3 text-left max-w-sm">
          <div class="flex items-center gap-3 text-gray-700 group">
            <div class="w-8 h-8 bg-gradient-to-r from-primary/10 to-accent/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
              <i class="fas fa-shield-alt text-primary text-sm"></i>
            </div>
            <span class="text-sm">Sécurité & conformité ISO 9001</span>
          </div>
          <div class="flex items-center gap-3 text-gray-700 group">
            <div class="w-8 h-8 bg-gradient-to-r from-primary/10 to-accent/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
              <i class="fas fa-brain text-primary text-sm"></i>
            </div>
            <span class="text-sm">Intelligence Artificielle intégrée</span>
          </div>
          <div class="flex items-center gap-3 text-gray-700 group">
            <div class="w-8 h-8 bg-gradient-to-r from-primary/10 to-accent/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
              <i class="fas fa-chart-line text-primary text-sm"></i>
            </div>
            <span class="text-sm">Analyses temps réel</span>
          </div>
        </div>
        
        <div class="pt-4">
          <div class="w-24 h-1 bg-gradient-to-r from-primary to-accent mx-auto rounded-full animate-pulse-gentle"></div>
        </div>
      </div>
    </div>

    <!-- Section droite (formulaire sur fond coloré) -->
    <div class="w-full md:w-1/2 p-10 md:p-14 flex flex-col justify-center bg-gradient-to-br from-primary via-primarylight to-accent text-white relative overflow-hidden group">
      <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
      
      <!-- Animated gradient overlay -->
      <div class="absolute inset-0 bg-gradient-to-br from-primary/80 via-primarylight/80 to-accent/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
      
      <!-- Floating particles -->
      <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-4 h-4 bg-white/10 rounded-full animate-float"></div>
        <div class="absolute top-1/3 right-1/4 w-3 h-3 bg-white/10 rounded-full animate-float" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-1/4 left-1/3 w-2 h-2 bg-white/10 rounded-full animate-float" style="animation-delay: 2s;"></div>
      </div>
      
      <div class="relative z-10 animate-slide-in">

        <div class="flex flex-col items-center mb-8">
          <div class="relative mb-4 md:hidden">
            <div class="absolute inset-0 bg-white/20 rounded-xl blur-md"></div>
            <img src="/logo.png" alt="Kensori Labs" class="w-16 h-16 relative z-10">
          </div>
          <h2 class="text-2xl md:text-3xl font-bold text-white text-center relative">
            Connexion à votre compte
            <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-12 h-0.5 bg-white/50 rounded-full"></span>
          </h2>
          <p class="text-white/80 text-sm mt-3 text-center">Veuillez entrer vos identifiants pour accéder à votre espace</p>
        </div>

        @if(session('error'))
          <div class="bg-white/20 backdrop-blur-md border border-red-300/30 text-red-100 text-sm p-4 rounded-xl mb-6 text-center animate-fade-in-up shadow-inner-glow">
            <div class="flex items-center justify-center gap-2">
              <i class="fas fa-exclamation-circle"></i>
              <span>{{ session('error') }}</span>
            </div>
          </div>
        @endif

        <form method="POST" action="{{ route('user.login') }}" class="space-y-6">
          @csrf
          
          <!-- Email Field -->
          <div class="group">
            <label for="email" class="block text-sm font-medium text-white/90 mb-2 flex items-center gap-2">
              <i class="fas fa-envelope text-white/70 text-sm"></i>
              <span>Adresse e-mail</span>
            </label>
            <div class="relative">
              <input type="email" id="email" name="email" required
                class="w-full px-4 py-3.5 pl-12 rounded-xl border border-white/25 bg-white/12 text-white placeholder-white/60 focus:ring-4 focus:ring-white/25 focus:border-white/50 transition-all duration-300 outline-none shadow-inner backdrop-blur-sm group-hover:bg-white/15"
                placeholder="exemple@domaine.com">
              <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white/60 group-focus-within:text-white transition-colors">
                <i class="far fa-envelope"></i>
              </div>
            </div>
          </div>

          <!-- Password Field -->
          <div class="group">
            <label for="password" class="block text-sm font-medium text-white/90 mb-2 flex items-center gap-2">
              <i class="fas fa-lock text-white/70 text-sm"></i>
              <span>Mot de passe</span>
            </label>
            <div class="relative">
              <input type="password" id="password" name="password" required
                class="w-full px-4 py-3.5 pl-12 rounded-xl border border-white/25 bg-white/12 text-white placeholder-white/60 focus:ring-4 focus:ring-white/25 focus:border-white/50 transition-all duration-300 outline-none shadow-inner backdrop-blur-sm group-hover:bg-white/15 pr-12"
                placeholder="Votre mot de passe">
              <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white/60 group-focus-within:text-white transition-colors">
                <i class="fas fa-key"></i>
              </div>
              <button type="button" id="togglePassword" class="absolute inset-y-0 right-3 flex items-center text-white/60 hover:text-white transition-colors duration-200 p-2 rounded-lg hover:bg-white/10">
                <svg xmlns="http://www.w3.org/2000/svg" id="eyeIcon" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                </svg>
              </button>
            </div>
          </div>

          <!-- Submit Button -->
          <button type="submit" 
            class="w-full bg-white text-primary font-semibold py-3.5 rounded-xl shadow-lg hover:bg-gray-50 hover:shadow-xl hover:-translate-y-1 transform transition-all duration-300 relative overflow-hidden group">
            <span class="relative z-10 flex items-center justify-center gap-2">
              <i class="fas fa-sign-in-alt"></i>
              Se connecter
            </span>
            <div class="absolute inset-0 bg-gradient-to-r from-white to-gray-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </button>
        </form>

        <footer class="text-center text-white/70 text-sm mt-8 pt-6 border-t border-white/10">
          <div class="flex items-center justify-center gap-4 mb-2">
            <a href="#" class="text-white/70 hover:text-white transition-colors duration-200">
              <i class="fab fa-linkedin text-lg"></i>
            </a>
            <a href="#" class="text-white/70 hover:text-white transition-colors duration-200">
              <i class="fab fa-twitter text-lg"></i>
            </a>
            <a href="#" class="text-white/70 hover:text-white transition-colors duration-200">
              <i class="fas fa-question-circle text-lg"></i>
            </a>
          </div>
          © <span id="year"></span> Kensori Labs — Tous droits réservés.
          <div class="text-xs text-white/50 mt-1">Version 2.1.4</div>
        </footer>
      </div>
    </div>
  </div>

  <script>
    // Affichage de l'année
    document.getElementById("year").textContent = new Date().getFullYear();

    // Toggle mot de passe avec amélioration
    const togglePassword = document.getElementById("togglePassword");
    const password = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");
    
    togglePassword.addEventListener("click", () => {
      const isPassword = password.type === "password";
      password.type = isPassword ? "text" : "password";
      
      // Animation de l'icône
      eyeIcon.style.transform = 'scale(1.2)';
      setTimeout(() => {
        eyeIcon.style.transform = 'scale(1)';
      }, 200);
    });

    // Effet de focus amélioré sur les inputs
    document.querySelectorAll('input').forEach(input => {
      input.addEventListener('focus', function() {
        this.parentElement.classList.add('ring-2', 'ring-white/30');
      });
      
      input.addEventListener('blur', function() {
        this.parentElement.classList.remove('ring-2', 'ring-white/30');
      });
    });

    // Animation au chargement
    document.addEventListener('DOMContentLoaded', () => {
      const formElements = document.querySelectorAll('input, button');
      formElements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(10px)';
        
        setTimeout(() => {
          el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
          el.style.opacity = '1';
          el.style.transform = 'translateY(0)';
        }, 100 + (index * 100));
      });
    });

    // Background particle animation enhancement
    document.addEventListener('DOMContentLoaded', () => {
      const particles = document.querySelectorAll('.particle');
      particles.forEach(particle => {
        const randomX = Math.random() * 20 - 10;
        particle.style.setProperty('--random-x', `${randomX}px`);
      });
    });
  </script>

  <style>
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes scaleIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }
    
    .animate-fade-in-up {
      animation: fadeInUp 0.8s ease-out forwards;
    }
    
    .animate-scale-in {
      animation: scaleIn 0.7s ease-out forwards;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: rgba(15, 76, 92, 0.1);
      border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb {
      background: linear-gradient(to bottom, #0f4c5c, #1e6f86);
      border-radius: 4px;
    }
    
    /* Selection color */
    ::selection {
      background-color: rgba(30, 111, 134, 0.3);
      color: white;
    }
    
    /* Smooth transitions */
    * {
      transition: background-color 0.3s ease, border-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    /* Enhanced background animations */
    @keyframes particleDrift {
      0% {
        transform: translateY(100vh) translateX(0) rotate(0deg);
        opacity: 0;
      }
      10% {
        opacity: 0.5;
      }
      90% {
        opacity: 0.5;
      }
      100% {
        transform: translateY(-100vh) translateX(calc(100px + var(--random-x, 0))) rotate(180deg);
        opacity: 0;
      }
    }
    
    /* Glass morphism enhancement */
    .backdrop-blur-2xl {
      backdrop-filter: blur(24px);
      -webkit-backdrop-filter: blur(24px);
    }
    
    /* Gradient flow animation */
    @keyframes gradientFlow {
      0%, 100% {
        background-position: 0% 50%;
        filter: hue-rotate(0deg);
      }
      50% {
        background-position: 100% 50%;
        filter: hue-rotate(15deg);
      }
    }
    
    /* Floating shapes */
    .floating-shape {
      will-change: transform;
      transform: translateZ(0);
    }
  </style>
</body>
</html>