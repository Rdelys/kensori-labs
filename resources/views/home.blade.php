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
            'float-slow': 'float 8s ease-in-out infinite',
            'pulse-slow': 'pulse 4s ease-in-out infinite',
            'fade-in': 'fadeIn 1s ease-out forwards',
            'slide-up': 'slideUp 0.8s ease-out forwards',
            'scale-in': 'scaleIn 0.6s ease-out forwards',
            'shimmer': 'shimmer 3s infinite linear',
            'gradient-flow': 'gradientFlow 8s ease infinite',
            'particle-float': 'particleFloat 20s linear infinite',
            'glow-pulse': 'glowPulse 4s ease-in-out infinite',
            'rotate-slow': 'rotate 20s linear infinite',
            'bounce-subtle': 'bounceSubtle 3s ease-in-out infinite',
            'wave': 'wave 12s ease-in-out infinite',
            'neon-glow': 'neonGlow 2s ease-in-out infinite'
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
              '0%': { opacity: '0', transform: 'translateY(40px)' },
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
              '0%, 100%': { 
                backgroundPosition: '0% 50%',
                filter: 'hue-rotate(0deg)'
              },
              '50%': { 
                backgroundPosition: '100% 50%',
                filter: 'hue-rotate(20deg)'
              }
            },
            particleFloat: {
              '0%': { transform: 'translateY(100vh) translateX(0) rotate(0deg)' },
              '100%': { transform: 'translateY(-100vh) translateX(100px) rotate(360deg)' }
            },
            glowPulse: {
              '0%, 100%': { opacity: '0.6', transform: 'scale(1)' },
              '50%': { opacity: '1', transform: 'scale(1.05)' }
            },
            rotate: {
              '0%': { transform: 'rotate(0deg)' },
              '100%': { transform: 'rotate(360deg)' }
            },
            bounceSubtle: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-10px)' }
            },
            wave: {
              '0%, 100%': { transform: 'translateX(0) translateY(0)' },
              '25%': { transform: 'translateX(-5px) translateY(-5px)' },
              '75%': { transform: 'translateX(5px) translateY(5px)' }
            },
            neonGlow: {
              '0%, 100%': { 
                boxShadow: '0 0 20px rgba(14, 165, 233, 0.5), 0 0 40px rgba(59, 130, 246, 0.3), 0 0 60px rgba(139, 92, 246, 0.1)'
              },
              '50%': { 
                boxShadow: '0 0 30px rgba(14, 165, 233, 0.8), 0 0 60px rgba(59, 130, 246, 0.5), 0 0 90px rgba(139, 92, 246, 0.2)'
              }
            }
          },
          backgroundImage: {
            'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
            'gradient-shine': 'linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent)',
            'gradient-subtle': 'linear-gradient(135deg, #f8fafc 0%, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%, #f8fafc 100%)',
            'gradient-mesh': 'linear-gradient(45deg, transparent 49%, rgba(14, 165, 233, 0.03) 50%, transparent 51%), linear-gradient(-45deg, transparent 49%, rgba(59, 130, 246, 0.03) 50%, transparent 51%)'
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
      scroll-padding-top: 80px;
    }

    body {
      font-family: 'Inter', sans-serif;
      overflow-x: hidden;
      background: linear-gradient(160deg, #0f172a 0%, #1e293b 30%, #334155 70%, #475569 100%);
      background-attachment: fixed;
      min-height: 100vh;
      position: relative;
      color: #f1f5f9;
    }

    /* Premium background overlay with particles */
    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: 
        radial-gradient(circle at 20% 30%, rgba(14, 165, 233, 0.15) 0%, transparent 40%),
        radial-gradient(circle at 80% 70%, rgba(139, 92, 246, 0.15) 0%, transparent 40%),
        radial-gradient(circle at 40% 50%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
        linear-gradient(45deg, rgba(14, 165, 233, 0.05) 1px, transparent 1px),
        linear-gradient(-45deg, rgba(59, 130, 246, 0.05) 1px, transparent 1px);
      background-size: 100% 100%, 100% 100%, 100% 100%, 60px 60px, 60px 60px;
      pointer-events: none;
      z-index: -2;
      animation: gradientFlow 15s ease infinite;
    }

    /* Animated particles */
    .particles {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: -1;
    }

    .particle {
      position: absolute;
      background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
      border-radius: 50%;
      animation: particleFloat linear infinite;
    }

    /* Hero section specific background */
    .hero-bg {
      background: linear-gradient(135deg, 
        rgba(15, 23, 42, 0.9) 0%,
        rgba(30, 41, 59, 0.85) 50%,
        rgba(51, 65, 85, 0.8) 100%
      );
      position: relative;
      overflow: hidden;
    }

    .hero-bg::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: 
        radial-gradient(circle at 20% 80%, rgba(14, 165, 233, 0.2) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.2) 0%, transparent 50%);
      animation: wave 15s ease-in-out infinite;
      z-index: 0;
    }

    /* Responsive background adjustments */
    @media (max-width: 768px) {
      body::before {
        background-size: 100% 100%, 100% 100%, 100% 100%, 40px 40px, 40px 40px;
      }
      
      .hero-bg::before {
        background: 
          radial-gradient(circle at 10% 90%, rgba(14, 165, 233, 0.15) 0%, transparent 60%),
          radial-gradient(circle at 90% 10%, rgba(139, 92, 246, 0.15) 0%, transparent 60%);
      }
    }

    h1, h2, h3, h4, h5, h6 {
      font-family: 'Outfit', sans-serif;
      font-weight: 700;
    }

    /* Enhanced star field */
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
      background: radial-gradient(circle, white 30%, transparent 70%);
      border-radius: 50%;
      animation: moveStar linear infinite;
      opacity: 0;
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
    }
    
    .star:nth-child(3n) {
      background: radial-gradient(circle, #0ea5e9 30%, transparent 70%);
      box-shadow: 0 0 15px rgba(14, 165, 233, 0.8);
    }
    
    .star:nth-child(3n+1) {
      background: radial-gradient(circle, #8b5cf6 30%, transparent 70%);
      box-shadow: 0 0 15px rgba(139, 92, 246, 0.8);
    }
    
    @keyframes moveStar {
      0% {
        transform: translateY(100vh) translateX(0) rotate(0deg);
        opacity: 0;
      }
      10% {
        opacity: 1;
      }
      90% {
        opacity: 1;
      }
      100% {
        transform: translateY(-100vh) translateX(200px) rotate(720deg);
        opacity: 0;
      }
    }

    /* Enhanced Navigation */
    .navbar {
      backdrop-filter: blur(20px);
      background: rgba(15, 23, 42, 0.85);
      border-bottom: 1px solid rgba(14, 165, 233, 0.2);
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .navbar.scrolled {
      background: rgba(15, 23, 42, 0.95);
      box-shadow: 0 8px 40px rgba(0, 0, 0, 0.4);
      border-bottom: 1px solid rgba(14, 165, 233, 0.3);
    }

    .nav-link {
      position: relative;
      padding: 8px 0;
      font-weight: 600;
      color: #cbd5e1;
      transition: all 0.3s ease;
    }

    .nav-link::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
      transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border-radius: 2px;
    }

    .nav-link:hover {
      color: white;
      transform: translateY(-2px);
    }

    .nav-link:hover::after {
      width: 100%;
    }

    /* Enhanced Gradient text */
    .gradient-text {
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      background-size: 200% 200%;
      animation: gradientFlow 8s ease infinite;
      position: relative;
    }

    .gradient-text::after {
      content: attr(data-text);
      position: absolute;
      top: 0;
      left: 0;
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      filter: blur(10px);
      opacity: 0.5;
      z-index: -1;
    }

    /* Enhanced Boutons */
    .btn-primary {
      background: linear-gradient(135deg, var(--primary), var(--secondary), var(--accent));
      color: white;
      padding: 14px 32px;
      border-radius: 12px;
      font-weight: 600;
      position: relative;
      overflow: hidden;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border: none;
      box-shadow: 0 8px 25px rgba(14, 165, 233, 0.4);
      animation: neonGlow 3s ease-in-out infinite;
    }

    .btn-primary::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      transition: left 0.7s ease;
    }

    .btn-primary:hover {
      transform: translateY(-3px) scale(1.02);
      box-shadow: 0 15px 35px rgba(14, 165, 233, 0.6);
      animation: none;
    }

    .btn-primary:hover::before {
      left: 100%;
    }

    .btn-secondary {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      color: white;
      padding: 14px 32px;
      border-radius: 12px;
      font-weight: 600;
      border: 2px solid rgba(14, 165, 233, 0.3);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
      position: relative;
      overflow: hidden;
    }

    .btn-secondary::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(14, 165, 233, 0.2), rgba(139, 92, 246, 0.2));
      opacity: 0;
      transition: opacity 0.3s ease;
      z-index: -1;
    }

    .btn-secondary:hover {
      transform: translateY(-3px);
      border-color: var(--primary);
      box-shadow: 0 10px 30px rgba(14, 165, 233, 0.3);
    }

    .btn-secondary:hover::before {
      opacity: 1;
    }

    /* Enhanced Cards */
    .card {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
      border-radius: 24px;
      padding: 36px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
      border: 1px solid rgba(255, 255, 255, 0.1);
      transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      position: relative;
      overflow: hidden;
      color: #f1f5f9;
    }

    .card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.6s ease;
    }

    .card::after {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
      transform: rotate(45deg);
      transition: transform 0.6s ease;
      opacity: 0;
    }

    .card:hover {
      transform: translateY(-12px) scale(1.02);
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
      border-color: rgba(14, 165, 233, 0.3);
    }

    .card:hover::before {
      transform: scaleX(1);
    }

    .card:hover::after {
      opacity: 1;
      transform: rotate(45deg) translate(20%, 20%);
    }

    .card-icon {
      width: 70px;
      height: 70px;
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 28px;
      font-size: 28px;
      color: white;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
      transition: all 0.4s ease;
      position: relative;
      overflow: hidden;
    }

    .card-icon::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent);
      transform: translateX(-100%);
      transition: transform 0.4s ease;
    }

    .card:hover .card-icon {
      transform: rotateY(180deg);
    }

    .card:hover .card-icon::before {
      transform: translateX(100%);
    }

    /* Section backgrounds */
    .section-light {
      background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95));
      position: relative;
      overflow: hidden;
    }

    .section-light::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: 
        radial-gradient(circle at 10% 20%, rgba(14, 165, 233, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 90% 80%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
      pointer-events: none;
      animation: wave 20s ease-in-out infinite;
    }

    .section-dark {
      background: linear-gradient(135deg, var(--dark) 0%, #1e293b 100%);
      color: white;
      position: relative;
      overflow: hidden;
    }

    .section-dark::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: 
        radial-gradient(circle at 30% 30%, rgba(14, 165, 233, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 70% 70%, rgba(139, 92, 246, 0.15) 0%, transparent 50%);
      pointer-events: none;
      animation: wave 25s ease-in-out infinite reverse;
    }

    /* Enhanced Stats counter */
    .stat-number {
      font-size: 4rem;
      font-weight: 800;
      background: linear-gradient(135deg, var(--primary), var(--accent));
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      line-height: 1;
      text-shadow: 0 5px 15px rgba(14, 165, 233, 0.3);
      position: relative;
    }

    .stat-number::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 50%;
      transform: translateX(-50%);
      width: 60%;
      height: 3px;
      background: linear-gradient(90deg, transparent, var(--primary), transparent);
      opacity: 0.7;
    }

    /* Enhanced Testimonial card */
    .testimonial-card {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 28px;
      padding: 48px;
      position: relative;
      overflow: hidden;
    }

    .testimonial-card::before {
      content: '"';
      position: absolute;
      top: -40px;
      left: 30px;
      font-size: 160px;
      color: rgba(255, 255, 255, 0.05);
      font-family: serif;
      line-height: 1;
      z-index: 0;
    }

    .testimonial-card::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg, transparent, rgba(14, 165, 233, 0.1), transparent);
      transform: translateX(-100%);
      transition: transform 0.6s ease;
    }

    .testimonial-card:hover::after {
      transform: translateX(100%);
    }

    /* Enhanced Loading animations */
    .animate-on-scroll {
      opacity: 0;
      transform: translateY(40px);
      transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .animate-on-scroll.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .animate-on-scroll.delay-1 {
      transition-delay: 0.1s;
    }

    .animate-on-scroll.delay-2 {
      transition-delay: 0.2s;
    }

    .animate-on-scroll.delay-3 {
      transition-delay: 0.3s;
    }

    /* Enhanced Mobile menu */
    .mobile-menu {
      transform: translateX(100%);
      transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
      background: rgba(15, 23, 42, 0.98);
      backdrop-filter: blur(20px);
    }

    .mobile-menu.open {
      transform: translateX(0);
    }

    /* Enhanced scrollbar */
    ::-webkit-scrollbar {
      width: 12px;
    }

    ::-webkit-scrollbar-track {
      background: rgba(15, 23, 42, 0.8);
      backdrop-filter: blur(10px);
    }

    ::-webkit-scrollbar-thumb {
      background: linear-gradient(to bottom, var(--primary), var(--secondary), var(--accent));
      border-radius: 6px;
      border: 2px solid rgba(15, 23, 42, 0.8);
    }

    ::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(to bottom, var(--secondary), var(--accent));
    }

    /* Enhanced Shimmer effect */
    .shimmer {
      background: linear-gradient(90deg, 
        transparent 0%, 
        rgba(255, 255, 255, 0.1) 50%, 
        transparent 100%);
      background-size: 200% 100%;
      animation: shimmer 3s infinite ease-in-out;
    }

    /* Floating shapes */
    .floating-shape {
      position: absolute;
      border-radius: 50%;
      background: linear-gradient(135deg, rgba(14, 165, 233, 0.1), rgba(139, 92, 246, 0.1));
      filter: blur(40px);
      animation: float 15s ease-in-out infinite;
      z-index: 0;
    }

    /* Enhanced hover effects */
    .hover-lift {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    /* Responsive improvements */
    @media (max-width: 1024px) {
      .card {
        padding: 32px;
      }
      
      .stat-number {
        font-size: 3.5rem;
      }
      
      .testimonial-card {
        padding: 40px 32px;
      }
    }

    @media (max-width: 768px) {
      .navbar {
        padding: 16px;
      }
      
      .stat-number {
        font-size: 3rem;
      }
      
      .card {
        padding: 28px;
        border-radius: 20px;
      }
      
      .card-icon {
        width: 60px;
        height: 60px;
        font-size: 24px;
      }
      
      .testimonial-card {
        padding: 32px 24px;
      }
      
      .testimonial-card::before {
        font-size: 120px;
        top: -30px;
      }
      
      .btn-primary,
      .btn-secondary {
        padding: 12px 24px;
        font-size: 15px;
        width: 100%;
        text-align: center;
      }
      
      h1 {
        font-size: 2.5rem;
      }
      
      h2 {
        font-size: 2rem;
      }
      
      .gradient-text {
        font-size: 2rem;
      }
    }

    @media (max-width: 480px) {
      .stat-number {
        font-size: 2.5rem;
      }
      
      .card {
        padding: 24px;
      }
      
      .btn-primary,
      .btn-secondary {
        padding: 14px 20px;
        font-size: 14px;
      }
      
      h1 {
        font-size: 2rem;
      }
      
      h2 {
        font-size: 1.75rem;
      }
      
      .gradient-text {
        font-size: 1.75rem;
      }
      
      .testimonial-card::before {
        font-size: 100px;
        top: -20px;
        left: 20px;
      }
    }

    /* Touch device optimizations */
    @media (hover: none) and (pointer: coarse) {
      .card:hover {
        transform: none;
      }
      
      .btn-primary:hover,
      .btn-secondary:hover {
        transform: none;
      }
      
      .nav-link:hover::after {
        width: 0;
      }
      
      .card:hover::after {
        opacity: 0;
      }
      
      .testimonial-card:hover::after {
        transform: translateX(-100%);
      }
    }

    /* Tablet optimizations */
    @media (min-width: 769px) and (max-width: 1024px) {
      .lg\:grid-cols-3 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
      
      .lg\:grid-cols-5 {
        grid-template-columns: repeat(3, minmax(0, 1fr));
      }
    }

    /* Large desktop optimizations */
    @media (min-width: 1536px) {
      .max-w-7xl {
        max-width: 1400px;
      }
      
      .card {
        padding: 40px;
      }
      
      .stat-number {
        font-size: 4.5rem;
      }
    }

    /* Print styles */
    @media print {
      .navbar,
      .btn-primary,
      .btn-secondary,
      .star-field,
      .mobile-menu-button,
      .particles,
      .floating-shape {
        display: none;
      }
      
      body {
        background: white !important;
        color: black !important;
      }
      
      .card {
        box-shadow: none;
        border: 1px solid #ddd;
        background: white !important;
        color: black !important;
      }
      
      .gradient-text {
        background: black !important;
        color: black !important;
        -webkit-background-clip: initial !important;
        background-clip: initial !important;
      }
    }
  </style>
</head>
<body class="font-sans antialiased">

<!-- Particles Background -->
<div class="particles" id="particles"></div>

<!-- Navigation -->
<nav class="navbar fixed top-0 left-0 right-0 z-50 py-3 px-4 md:px-8">
  <div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between">
      <!-- Logo -->
      <div class="flex items-center gap-3 animate-on-scroll">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-lg bg-gradient-to-br from-primary to-accent animate-neon-glow">
          <img src="/logo.png" alt="Kensori Labs Logo" class="w-8 h-8">
        </div>
        <span class="text-2xl font-bold tracking-tight">
          <span class="gradient-text" data-text="KENSORI">KENSORI</span>
          <span class="text-white">LABS</span>
        </span>
      </div>

      <!-- Desktop Menu -->
      <div class="hidden md:flex items-center gap-8">
        <a href="#accueil" class="nav-link animate-on-scroll">Accueil</a>
        <a href="#fonctionnalites" class="nav-link animate-on-scroll delay-1">Fonctionnalités</a>
        <a href="#modules" class="nav-link animate-on-scroll delay-2">Modules</a>
        <a href="#temoignages" class="nav-link animate-on-scroll delay-3">Témoignages</a>
        <a href="#tarifs" class="nav-link animate-on-scroll delay-1">Tarifs</a>
        
        <div class="flex items-center gap-4">
          <a href="{{ route('login') }}" class="btn-secondary text-sm px-4 py-2 animate-on-scroll delay-2">
            <i class="fa-solid fa-key mr-2"></i>
            Connexion
          </a>
          <a href="#essai" class="btn-primary text-sm animate-on-scroll delay-3">
            <i class="fa-solid fa-rocket mr-2"></i>
            Essai Gratuit
          </a>
        </div>
      </div>

      <!-- Mobile Menu Button -->
      <button id="mobileMenuButton" class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white/10 transition-colors animate-on-scroll">
        <i class="fa-solid fa-bars text-xl text-white"></i>
      </button>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobileMenu" class="mobile-menu md:hidden fixed inset-0 z-40 pt-20 px-6">
    <div class="flex flex-col gap-6">
      <a href="#accueil" class="nav-link text-lg py-3 border-b border-white/10">Accueil</a>
      <a href="#fonctionnalites" class="nav-link text-lg py-3 border-b border-white/10">Fonctionnalités</a>
      <a href="#modules" class="nav-link text-lg py-3 border-b border-white/10">Modules</a>
      <a href="#temoignages" class="nav-link text-lg py-3 border-b border-white/10">Témoignages</a>
      <a href="#tarifs" class="nav-link text-lg py-3 border-b border-white/10">Tarifs</a>
      
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
<section id="accueil" class="relative pt-24 pb-20 md:pt-32 md:pb-28 px-4 md:px-8 overflow-hidden hero-bg">
  <!-- Enhanced Star background -->
  <div class="star-field" id="stars"></div>
  
  <!-- Floating shapes -->
  <div class="floating-shape w-96 h-96 -top-48 -right-48 opacity-30"></div>
  <div class="floating-shape w-80 h-80 -bottom-40 -left-40 opacity-40" style="animation-delay: 2s;"></div>
  <div class="floating-shape w-64 h-64 top-1/4 left-1/4 opacity-20" style="animation-delay: 4s;"></div>
  
  <!-- Animated gradient orbs -->
  <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-primary/20 to-accent/20 rounded-full blur-3xl animate-glow-pulse"></div>
  <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-secondary/20 to-accent/20 rounded-full blur-3xl animate-glow-pulse" style="animation-delay: 1s;"></div>
  
  <div class="max-w-7xl mx-auto relative z-10">
    <div class="flex flex-col lg:flex-row items-center gap-12">
      <!-- Left content -->
      <div class="lg:w-1/2 animate-on-scroll">
        <!-- Enhanced Badge -->
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium mb-8 border border-white/20 shadow-lg hover-lift">
          <i class="fa-solid fa-medal text-primary animate-bounce-subtle"></i>
          <span class="text-white">Conforme ISO 9001:2015</span>
        </div>
        
        <!-- Enhanced Title -->
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
          Révolutionnez Votre SMQ avec 
          <span class="gradient-text block mt-2" data-text="l'Intelligence Artificielle">l'Intelligence Artificielle</span>
        </h1>
        
        <!-- Enhanced Description -->
        <p class="text-lg text-gray-300 mb-8 max-w-xl">
          La plateforme intelligente qui transforme votre gestion de la qualité grâce à l'IA et l'automatisation. Conforme, performant, innovant.
        </p>
        
        <!-- Enhanced CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 mb-12">
          <a href="#essai" class="btn-primary inline-flex items-center justify-center animate-on-scroll">
            <i class="fa-solid fa-play mr-2 animate-pulse-slow"></i>
            Commencer l'Essai Gratuit
          </a>
          <a href="#demo" class="btn-secondary inline-flex items-center justify-center animate-on-scroll delay-1">
            <i class="fa-solid fa-circle-play mr-2"></i>
            Voir la Démo
          </a>
        </div>
        
        <!-- Enhanced Stats -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
          <div class="text-center animate-on-scroll">
            <div class="stat-number mb-2">100%</div>
            <div class="text-sm text-gray-300">Conforme ISO 9001</div>
          </div>
          <div class="text-center animate-on-scroll delay-1">
            <div class="stat-number mb-2">+65%</div>
            <div class="text-sm text-gray-300">Gain de temps</div>
          </div>
          <div class="text-center animate-on-scroll delay-2">
            <div class="stat-number mb-2">500+</div>
            <div class="text-sm text-gray-300">Clients satisfaits</div>
          </div>
        </div>
      </div>
      
      <!-- Right content -->
      <div class="lg:w-1/2 animate-on-scroll delay-3">
        <div class="relative">
          <!-- Enhanced Main card -->
          <div class="card max-w-md mx-auto hover-lift">
            <div class="flex justify-center mb-6">
              <div class="w-24 h-24 rounded-2xl flex items-center justify-center shadow-xl bg-gradient-to-br from-primary to-accent animate-rotate-slow">
                <img src="/logo.png" alt="Kensori Labs Logo" class="w-20 h-20 animate-rotate-slow" style="animation-direction: reverse;">
              </div>
            </div>
            
            <h3 class="text-2xl font-bold text-center mb-6">Solution Smart Complète</h3>
            
            <div class="space-y-4">
              <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-white/5 transition-all duration-300 hover-lift">
                <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center flex-shrink-0 animate-pulse-slow">
                  <i class="fa-solid fa-check text-green-400"></i>
                </div>
                <div>
                  <div class="font-semibold">Audits automatisés</div>
                  <div class="text-sm text-gray-400">Gestion intelligente des audits</div>
                </div>
              </div>
              
              <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-white/5 transition-all duration-300 hover-lift">
                <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center flex-shrink-0 animate-pulse-slow" style="animation-delay: 0.5s;">
                  <i class="fa-solid fa-robot text-blue-400"></i>
                </div>
                <div>
                  <div class="font-semibold">IA prédictive</div>
                  <div class="text-sm text-gray-400">Analyses et recommandations</div>
                </div>
              </div>
              
              <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-white/5 transition-all duration-300 hover-lift">
                <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center flex-shrink-0 animate-pulse-slow" style="animation-delay: 1s;">
                  <i class="fa-solid fa-chart-bar text-purple-400"></i>
                </div>
                <div>
                  <div class="font-semibold">Dashboard temps réel</div>
                  <div class="text-sm text-gray-400">KPI et indicateurs clés</div>
                </div>
              </div>
            </div>
            
            <div class="mt-8 pt-6 border-t border-white/10">
              <a href="#fonctionnalites" class="text-primary font-semibold inline-flex items-center hover:gap-3 transition-all group">
                Découvrir toutes les fonctionnalités
                <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
              </a>
            </div>
          </div>
          
          <!-- Enhanced Floating elements -->
          <div class="absolute -top-6 -right-6 w-32 h-32 bg-gradient-to-br from-primary/30 to-accent/30 rounded-2xl blur-xl animate-float"></div>
          <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-gradient-to-br from-secondary/30 to-accent/30 rounded-2xl blur-xl animate-float" style="animation-delay: 2s;"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Features Section -->
<section id="fonctionnalites" class="py-20 px-4 md:px-8 section-light">
  <div class="max-w-7xl mx-auto relative">
    <!-- Floating shapes -->
    <div class="floating-shape w-64 h-64 top-20 -left-32 opacity-20"></div>
    <div class="floating-shape w-48 h-48 bottom-20 -right-32 opacity-15" style="animation-delay: 3s;"></div>
    
    <!-- Section header -->
    <div class="text-center mb-16 animate-on-scroll">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
        <span class="gradient-text" data-text="Fonctionnalités Avancées">Fonctionnalités Avancées</span> pour Votre Excellence
      </h2>
      <p class="text-lg text-gray-300 max-w-3xl mx-auto">
        Découvrez comment notre plateforme intelligente optimise chaque aspect de votre gestion de la qualité
      </p>
    </div>
    
    <!-- Features grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Feature 1 -->
      <div class="card animate-on-scroll hover-lift">
        <div class="card-icon bg-gradient-to-br from-blue-500 to-cyan-400">
          <i class="fa-solid fa-robot"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">IA & Automatisation</h3>
        <p class="text-gray-300 mb-4">
          Automatisez vos processus qualité avec notre intelligence artificielle avancée. Optimisez vos décisions en temps réel.
        </p>
        <ul class="space-y-2 mb-6">
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-400 text-sm animate-pulse-slow"></i>
            <span class="text-sm">Recommandations intelligentes</span>
          </li>
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-400 text-sm animate-pulse-slow" style="animation-delay: 0.2s;"></i>
            <span class="text-sm">Automatisation des workflows</span>
          </li>
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-400 text-sm animate-pulse-slow" style="animation-delay: 0.4s;"></i>
            <span class="text-sm">Analyses prédictives</span>
          </li>
        </ul>
        <a href="#" class="text-primary font-semibold inline-flex items-center text-sm group">
          Explorer cette fonction
          <i class="fa-solid fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"></i>
        </a>
      </div>
      
      <!-- Feature 2 -->
      <div class="card animate-on-scroll delay-1 hover-lift">
        <div class="card-icon bg-gradient-to-br from-green-500 to-emerald-400">
          <i class="fa-solid fa-file-shield"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Conformité Simplifiée</h3>
        <p class="text-gray-300 mb-4">
          Maintenez votre conformité ISO 9001 sans effort avec notre système de suivi intelligent et automatisé.
        </p>
        <ul class="space-y-2 mb-6">
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-400 text-sm animate-pulse-slow"></i>
            <span class="text-sm">Audits automatisés</span>
          </li>
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-400 text-sm animate-pulse-slow" style="animation-delay: 0.2s;"></i>
            <span class="text-sm">Documentation centralisée</span>
          </li>
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-400 text-sm animate-pulse-slow" style="animation-delay: 0.4s;"></i>
            <span class="text-sm">Alertes de conformité</span>
          </li>
        </ul>
        <a href="#" class="text-primary font-semibold inline-flex items-center text-sm group">
          Explorer cette fonction
          <i class="fa-solid fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"></i>
        </a>
      </div>
      
      <!-- Feature 3 -->
      <div class="card animate-on-scroll delay-2 hover-lift">
        <div class="card-icon bg-gradient-to-br from-purple-500 to-pink-400">
          <i class="fa-solid fa-chart-line"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Analyses Avancées</h3>
        <p class="text-gray-300 mb-4">
          Tableaux de bord interactifs et analyses en temps réel pour une prise de décision éclairée.
        </p>
        <ul class="space-y-2 mb-6">
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-400 text-sm animate-pulse-slow"></i>
            <span class="text-sm">KPI personnalisables</span>
          </li>
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-400 text-sm animate-pulse-slow" style="animation-delay: 0.2s;"></i>
            <span class="text-sm">Rapports automatiques</span>
          </li>
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-400 text-sm animate-pulse-slow" style="animation-delay: 0.4s;"></i>
            <span class="text-sm">Visualisations dynamiques</span>
          </li>
        </ul>
        <a href="#" class="text-primary font-semibold inline-flex items-center text-sm group">
          Explorer cette fonction
          <i class="fa-solid fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"></i>
        </a>
      </div>
    </div>
    
    <!-- CTA -->
    <div class="text-center mt-16 animate-on-scroll delay-3">
      <a href="#modules" class="btn-primary inline-flex items-center hover-lift">
        <i class="fa-solid fa-eye mr-2"></i>
        Voir Toutes les Fonctionnalités
      </a>
    </div>
  </div>
</section>

<!-- Modules Section -->
<section id="modules" class="py-20 px-4 md:px-8">
  <div class="max-w-7xl mx-auto relative">
    <!-- Floating shapes -->
    <div class="floating-shape w-96 h-96 -top-48 right-1/4 opacity-10"></div>
    
    <!-- Section header -->
    <div class="text-center mb-16 animate-on-scroll">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
        Modules <span class="gradient-text" data-text="Spécialisés">Spécialisés</span> pour Votre SMQ
      </h2>
      <p class="text-lg text-gray-300 max-w-3xl mx-auto">
        Une suite complète d'outils conçus pour optimiser chaque processus de votre système de management de la qualité
      </p>
    </div>
    
    <!-- Modules grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Module 1 -->
      <div class="card animate-on-scroll hover-lift">
        <div class="flex items-start justify-between mb-6">
          <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-xl flex items-center justify-center shadow-lg animate-rotate-slow">
            <i class="fa-solid fa-diagram-project text-white text-2xl"></i>
          </div>
          <span class="bg-blue-500/20 text-blue-300 text-xs font-semibold px-3 py-1 rounded-full animate-pulse-slow">POPULAIRE</span>
        </div>
        <h3 class="text-2xl font-bold mb-4">Gestion Documentaire IA</h3>
        <p class="text-gray-300 mb-6">
          Centralisez, versionnez et partagez tous vos documents qualité avec un système de gestion intelligent et sécurisé.
        </p>
        <ul class="space-y-3 mb-8">
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-400 animate-pulse-slow"></i>
            <span>Versionning automatique</span>
          </li>
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-400 animate-pulse-slow" style="animation-delay: 0.2s;"></i>
            <span>Workflows d'approbation</span>
          </li>
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-400 animate-pulse-slow" style="animation-delay: 0.4s;"></i>
            <span>Recherche sémantique</span>
          </li>
        </ul>
        <a href="#" class="btn-secondary w-full text-center hover-lift">
          <i class="fa-solid fa-arrow-right mr-2 group-hover:translate-x-1 transition-transform"></i>
          Explorer le module
        </a>
      </div>
      
      <!-- Module 2 -->
      <div class="card animate-on-scroll delay-1 hover-lift">
        <div class="flex items-start justify-between mb-6">
          <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-400 rounded-xl flex items-center justify-center shadow-lg animate-rotate-slow">
            <i class="fa-solid fa-clipboard-check text-white text-2xl"></i>
          </div>
          <span class="bg-purple-500/20 text-purple-300 text-xs font-semibold px-3 py-1 rounded-full animate-pulse-slow" style="animation-delay: 0.5s;">ESSENTIEL</span>
        </div>
        <h3 class="text-2xl font-bold mb-4">Audits & Actions Correctives</h3>
        <p class="text-gray-300 mb-6">
          Planifiez, exécutez et suivez vos audits internes et externes avec un système de gestion des actions correctives intégré.
        </p>
        <ul class="space-y-3 mb-8">
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-400 animate-pulse-slow"></i>
            <span>Audits programmables</span>
          </li>
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-400 animate-pulse-slow" style="animation-delay: 0.2s;"></i>
            <span>Suivi des actions correctives</span>
          </li>
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-400 animate-pulse-slow" style="animation-delay: 0.4s;"></i>
            <span>Rapports automatiques</span>
          </li>
        </ul>
        <a href="#" class="btn-secondary w-full text-center hover-lift">
          <i class="fa-solid fa-arrow-right mr-2 group-hover:translate-x-1 transition-transform"></i>
          Explorer le module
        </a>
      </div>
      
      <!-- Module 3 -->
      <div class="card animate-on-scroll delay-2 hover-lift">
        <div class="flex items-start justify-between mb-6">
          <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-400 rounded-xl flex items-center justify-center shadow-lg animate-rotate-slow">
            <i class="fa-solid fa-chart-pie text-white text-2xl"></i>
          </div>
          <span class="bg-green-500/20 text-green-300 text-xs font-semibold px-3 py-1 rounded-full animate-pulse-slow" style="animation-delay: 1s;">NOUVEAU</span>
        </div>
        <h3 class="text-2xl font-bold mb-4">Dashboard Personnalisable</h3>
        <p class="text-gray-300 mb-6">
          Visualisez vos indicateurs clés de performance (KPI) avec des dashboards interactifs et personnalisables en temps réel.
        </p>
        <ul class="space-y-3 mb-8">
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-400 animate-pulse-slow"></i>
            <span>KPI personnalisables</span>
          </li>
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-400 animate-pulse-slow" style="animation-delay: 0.2s;"></i>
            <span>Alertes intelligentes</span>
          </li>
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-check text-green-400 animate-pulse-slow" style="animation-delay: 0.4s;"></i>
            <span>Export multi-formats</span>
          </li>
        </ul>
        <a href="#" class="btn-secondary w-full text-center hover-lift">
          <i class="fa-solid fa-arrow-right mr-2 group-hover:translate-x-1 transition-transform"></i>
          Explorer le module
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section id="temoignages" class="py-20 px-4 md:px-8 section-dark">
  <div class="max-w-7xl mx-auto relative">
    <!-- Floating shapes -->
    <div class="floating-shape w-64 h-64 -bottom-32 left-1/4 opacity-15"></div>
    
    <!-- Section header -->
    <div class="text-center mb-16 animate-on-scroll">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
        Ils <span class="gradient-text" data-text="Nous Font Confiance">Nous Font Confiance</span>
      </h2>
      <p class="text-lg opacity-80 max-w-3xl mx-auto">
        Découvrez comment des centaines d'entreprises optimisent leur SMQ avec Kensori Labs
      </p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
      <!-- Stats -->
      <div class="animate-on-scroll">
        <div class="grid grid-cols-2 gap-6">
          <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover-lift">
            <div class="text-4xl font-bold text-primary mb-2 stat-counter" data-target="98">0</div>
            <div class="text-lg font-medium">Satisfaction client</div>
            <div class="flex mt-2">
              <i class="fa-solid fa-star text-yellow-400 animate-pulse-slow"></i>
              <i class="fa-solid fa-star text-yellow-400 animate-pulse-slow" style="animation-delay: 0.1s;"></i>
              <i class="fa-solid fa-star text-yellow-400 animate-pulse-slow" style="animation-delay: 0.2s;"></i>
              <i class="fa-solid fa-star text-yellow-400 animate-pulse-slow" style="animation-delay: 0.3s;"></i>
              <i class="fa-solid fa-star text-yellow-400 animate-pulse-slow" style="animation-delay: 0.4s;"></i>
            </div>
          </div>
          
          <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover-lift">
            <div class="text-4xl font-bold text-green-400 mb-2 stat-counter" data-target="65">0</div>
            <div class="text-lg font-medium">Gain de temps moyen</div>
            <div class="text-sm opacity-80 mt-1">sur les processus qualité</div>
          </div>
          
          <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover-lift">
            <div class="text-4xl font-bold text-purple-400 mb-2 stat-counter" data-target="500">0</div>
            <div class="text-lg font-medium">Entreprises</div>
            <div class="text-sm opacity-80 mt-1">nous font confiance</div>
          </div>
          
          <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover-lift">
            <div class="text-4xl font-bold text-cyan-400 mb-2 stat-counter" data-target="100">0</div>
            <div class="text-lg font-medium">Conformité ISO</div>
            <div class="text-sm opacity-80 mt-1">garantie</div>
          </div>
        </div>

        <div class="mt-8 bg-gradient-to-r from-primary/20 to-accent/20 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover-lift animate-on-scroll delay-1">
          <h4 class="text-xl font-bold mb-4">Secteurs d'activité</h4>
          <div class="flex flex-wrap gap-3">
            <span class="bg-white/10 rounded-lg px-4 py-2 text-sm hover:bg-white/20 transition-colors">Industrie</span>
            <span class="bg-white/10 rounded-lg px-4 py-2 text-sm hover:bg-white/20 transition-colors">Santé</span>
            <span class="bg-white/10 rounded-lg px-4 py-2 text-sm hover:bg-white/20 transition-colors">Technologie</span>
            <span class="bg-white/10 rounded-lg px-4 py-2 text-sm hover:bg-white/20 transition-colors">Services</span>
            <span class="bg-white/10 rounded-lg px-4 py-2 text-sm hover:bg-white/20 transition-colors">Construction</span>
          </div>
        </div>
      </div>

      <!-- Testimonial -->
      <div class="animate-on-scroll delay-2">
        <div class="testimonial-card hover-lift">
          <div class="flex items-center mb-6">
            <div class="w-16 h-16 rounded-full bg-gradient-to-r from-primary to-secondary flex items-center justify-center text-white text-2xl font-bold mr-4 animate-rotate-slow">
              ML
            </div>
            <div>
              <div class="text-xl font-bold">Marie Lambert</div>
              <div class="opacity-80">Directrice Qualité, Groupe Innovatech</div>
            </div>
          </div>
          
          <div class="text-lg mb-6 relative z-10">
            "Kensori Labs a révolutionné notre gestion de la qualité. En 6 mois, nous avons réduit de 70% le temps consacré aux audits et amélioré notre conformité ISO 9001 de manière significative. L'interface intuitive et les fonctionnalités IA font toute la différence."
          </div>
          
          <div class="flex items-center justify-between relative z-10">
            <div class="flex text-yellow-400">
              <i class="fa-solid fa-star animate-pulse-slow"></i>
              <i class="fa-solid fa-star animate-pulse-slow" style="animation-delay: 0.1s;"></i>
              <i class="fa-solid fa-star animate-pulse-slow" style="animation-delay: 0.2s;"></i>
              <i class="fa-solid fa-star animate-pulse-slow" style="animation-delay: 0.3s;"></i>
              <i class="fa-solid fa-star animate-pulse-slow" style="animation-delay: 0.4s;"></i>
            </div>
            <div class="text-sm opacity-80">Depuis 2 ans avec Kensori Labs</div>
          </div>
        </div>
        
        <!-- Additional testimonial -->
        <div class="mt-6 p-6 bg-white/5 rounded-2xl border border-white/10 hover-lift animate-on-scroll delay-3">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-400 rounded-full flex items-center justify-center text-white font-bold animate-pulse-slow">
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
<section id="essai" class="py-20 px-4 md:px-8 relative">
  <!-- Floating shapes -->
  <div class="floating-shape w-80 h-80 top-1/2 -left-40 opacity-10"></div>
  <div class="floating-shape w-64 h-64 bottom-20 -right-32 opacity-15" style="animation-delay: 2s;"></div>
  
  <div class="max-w-4xl mx-auto relative z-10">
    <div class="bg-gradient-to-br from-primary/20 via-white/10 to-secondary/20 rounded-3xl p-8 md:p-12 shadow-2xl border border-white/20 animate-on-scroll hover-lift">
      <div class="text-center">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
          Prêt à <span class="gradient-text" data-text="Transformer">Transformer</span> Votre Qualité ?
        </h2>
        <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
          Commencez votre essai gratuit de 30 jours et découvrez comment Kensori Labs peut optimiser votre SMQ.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-10">
          <a href="#" class="btn-primary inline-flex items-center justify-center px-8 py-4 text-lg animate-on-scroll">
            <i class="fa-solid fa-rocket mr-2 animate-bounce-subtle"></i> 
            Démarrer l'Essai Gratuit
          </a>
          
          <a href="#" class="btn-secondary inline-flex items-center justify-center px-8 py-4 text-lg animate-on-scroll delay-1">
            <i class="fa-solid fa-calendar-check mr-2"></i> 
            Réserver une Démo
          </a>
        </div>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-6 text-gray-300 text-sm">
          <div class="flex items-center gap-2 animate-on-scroll">
            <i class="fa-solid fa-check-circle text-green-400 animate-pulse-slow"></i>
            <span>Aucune carte bancaire requise</span>
          </div>
          <div class="flex items-center gap-2 animate-on-scroll delay-1">
            <i class="fa-solid fa-check-circle text-green-400 animate-pulse-slow" style="animation-delay: 0.3s;"></i>
            <span>Support inclus pendant l'essai</span>
          </div>
          <div class="flex items-center gap-2 animate-on-scroll delay-2">
            <i class="fa-solid fa-check-circle text-green-400 animate-pulse-slow" style="animation-delay: 0.6s;"></i>
            <span>Annulation à tout moment</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white py-16 px-4 md:px-8 relative">
  <!-- Floating shapes -->
  <div class="floating-shape w-96 h-96 -top-48 left-1/4 opacity-5"></div>
  
  <div class="max-w-7xl mx-auto relative z-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-12">
      <!-- Logo & Description -->
      <div class="lg:col-span-2 animate-on-scroll">
        <div class="flex items-center gap-3 mb-6">
          <div class="w-10 h-10 bg-gradient-to-br from-primary to-accent rounded-xl flex items-center justify-center shadow-md animate-rotate-slow">
            <img src="/logo.png" alt="Kensori Labs Logo" class="w-8 h-8">
          </div>
          <div class="text-2xl font-bold">
            <span class="gradient-text" data-text="Kensori">Kensori</span>
            <span class="text-white">Labs</span>
          </div>
        </div>
        <p class="opacity-80 mb-6 max-w-md">
          La plateforme intelligente qui révolutionne la gestion de la qualité grâce à l'IA et l'automatisation. Conforme ISO 9001 et bien plus encore.
        </p>
        <div class="flex gap-4">
          <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary transition-all hover:scale-110">
            <i class="fa-brands fa-linkedin-in"></i>
          </a>
          <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary transition-all hover:scale-110">
            <i class="fa-brands fa-twitter"></i>
          </a>
          <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary transition-all hover:scale-110">
            <i class="fa-brands fa-youtube"></i>
          </a>
          <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-primary transition-all hover:scale-110">
            <i class="fa-brands fa-facebook-f"></i>
          </a>
        </div>
      </div>

      <!-- Produit -->
      <div class="animate-on-scroll delay-1">
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
      <div class="animate-on-scroll delay-2">
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
      <div class="animate-on-scroll delay-3">
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

    <div class="pt-8 border-t border-white/20 flex flex-col md:flex-row justify-between items-center animate-on-scroll">
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

  // Generate enhanced stars
  const starContainer = document.getElementById('stars');
  const starCount = window.innerWidth < 768 ? 60 : 150;

  for (let i = 0; i < starCount; i++) {
    const star = document.createElement('div');
    star.classList.add('star');
    
    const size = Math.random() * 4 + 1;
    star.style.width = `${size}px`;
    star.style.height = `${size}px`;
    star.style.left = `${Math.random() * 100}%`;
    star.style.top = `${Math.random() * 100}%`;
    star.style.opacity = Math.random() * 0.8 + 0.2;
    star.style.animationDuration = `${Math.random() * 8 + 4}s`;
    star.style.animationDelay = `${Math.random() * 3}s`;
    
    starContainer.appendChild(star);
  }

  // Generate particles
  const particlesContainer = document.getElementById('particles');
  const particleCount = window.innerWidth < 768 ? 20 : 40;

  for (let i = 0; i < particleCount; i++) {
    const particle = document.createElement('div');
    particle.classList.add('particle');
    
    const size = Math.random() * 100 + 50;
    particle.style.width = `${size}px`;
    particle.style.height = `${size}px`;
    particle.style.left = `${Math.random() * 100}%`;
    particle.style.top = `${Math.random() * 100}%`;
    particle.style.opacity = Math.random() * 0.1 + 0.05;
    particle.style.animationDuration = `${Math.random() * 30 + 20}s`;
    particle.style.animationDelay = `${Math.random() * 10}s`;
    
    particlesContainer.appendChild(particle);
  }

  // Enhanced animated counters
  function animateCounter(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);
    const timer = setInterval(() => {
      start += increment;
      if (start >= target) {
        element.textContent = target + (element.getAttribute('data-target') === '100' ? '%' : '+');
        clearInterval(timer);
        // Add subtle pulse effect when counter completes
        element.style.animation = 'pulse 0.5s ease';
        setTimeout(() => {
          element.style.animation = '';
        }, 500);
      } else {
        element.textContent = Math.floor(start) + (element.getAttribute('data-target') === '100' ? '%' : '+');
      }
    }, 16);
  }

  // Enhanced Intersection Observer for animations
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
            if (!counter.classList.contains('animated')) {
              counter.classList.add('animated');
              const target = parseInt(counter.getAttribute('data-target'));
              setTimeout(() => {
                animateCounter(counter, target);
              }, 300);
            }
          });
        }
      }
    });
  }, observerOptions);

  // Observe all animate-on-scroll elements
  document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));

  // Enhanced smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;
      
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        // Add scroll animation
        window.scrollTo({
          top: targetElement.offsetTop - 80,
          behavior: 'smooth'
        });
        
        // Add visual feedback for the clicked link
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
          this.style.transform = '';
        }, 200);
      }
    });
  });

  // Set current year in footer
  document.getElementById('currentYear').textContent = new Date().getFullYear();

  // Enhanced Navbar scroll effect
  let lastScroll = 0;
  const navbar = document.querySelector('nav');
  
  window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    
    if (currentScroll <= 0) {
      navbar.classList.remove('scrolled');
      navbar.style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.3)';
    } else if (currentScroll > lastScroll && currentScroll > 100) {
      // Scrolling down
      navbar.style.transform = 'translateY(-100%)';
      navbar.classList.add('scrolled');
    } else {
      // Scrolling up
      navbar.style.transform = 'translateY(0)';
      navbar.classList.add('scrolled');
      navbar.style.boxShadow = '0 8px 40px rgba(0, 0, 0, 0.4)';
    }
    
    lastScroll = currentScroll;
    
    // Parallax effect for hero section
    const heroSection = document.querySelector('#accueil');
    if (heroSection && currentScroll < heroSection.offsetHeight) {
      const scrolled = currentScroll / heroSection.offsetHeight;
      heroSection.style.transform = `translateY(${scrolled * 50}px)`;
      heroSection.style.opacity = 1 - scrolled * 0.5;
    }
  });

  // Enhanced responsive touch handling
  if ('ontouchstart' in window) {
    // Add touch feedback for cards
    document.querySelectorAll('.card, .btn-primary, .btn-secondary').forEach(element => {
      element.addEventListener('touchstart', function() {
        this.style.transition = 'transform 0.1s ease, opacity 0.1s ease';
        this.style.opacity = '0.9';
        this.style.transform = 'scale(0.98)';
      });
      
      element.addEventListener('touchend', function() {
        this.style.transition = 'transform 0.3s ease, opacity 0.3s ease';
        this.style.opacity = '1';
        this.style.transform = 'scale(1)';
      });
    });
  }

  // Enhanced image loading with fade-in
  function handleImageLoading() {
    const images = document.querySelectorAll('img');
    images.forEach(img => {
      if (!img.complete) {
        img.style.opacity = '0';
        img.style.transform = 'scale(0.95)';
        img.addEventListener('load', () => {
          img.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
          img.style.opacity = '1';
          img.style.transform = 'scale(1)';
        });
      }
    });
  }

  // Initialize on load
  document.addEventListener('DOMContentLoaded', () => {
    handleImageLoading();
    
    // Add initial animation for hero elements
    setTimeout(() => {
      document.querySelectorAll('.animate-on-scroll').forEach((el, index) => {
        setTimeout(() => {
          el.classList.add('visible');
        }, index * 100);
      });
    }, 500);
  });

  // Enhanced window resize handling
  let resizeTimer;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      handleImageLoading();
    }, 250);
  });

  // Add cursor trail effect
  document.addEventListener('mousemove', (e) => {
    const cursorTrail = document.createElement('div');
    cursorTrail.className = 'cursor-trail';
    cursorTrail.style.cssText = `
      position: fixed;
      width: 8px;
      height: 8px;
      background: radial-gradient(circle, var(--primary), transparent);
      border-radius: 50%;
      pointer-events: none;
      z-index: 9999;
      left: ${e.clientX - 4}px;
      top: ${e.clientY - 4}px;
      opacity: 0.7;
    `;
    document.body.appendChild(cursorTrail);
    
    setTimeout(() => {
      cursorTrail.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
      cursorTrail.style.opacity = '0';
      cursorTrail.style.transform = 'scale(0)';
      setTimeout(() => {
        document.body.removeChild(cursorTrail);
      }, 300);
    }, 50);
  });

  // Add keyboard navigation
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && mobileMenu.classList.contains('open')) {
      mobileMenu.classList.remove('open');
      document.body.style.overflow = '';
    }
  });
</script>

</body>
</html>