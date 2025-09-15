<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Campus Hub - Your Academic Success Platform</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Connect with peers, share study materials, find affordable textbooks, and discover tutoring opportunities on your campus.">
    <meta name="keywords" content="campus, student, textbooks, tutoring, study materials, academic success">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        accent: {
                            400: '#f59e0b',
                            500: '#d97706',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-in-out',
                        'fade-in-up': 'fadeInUp 0.6s ease-out',
                        'bounce-slow': 'bounce 3s infinite',
                        'pulse-slow': 'pulse 4s infinite',
                        'gradient': 'gradient 8s linear infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        gradient: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' }
                        }
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                        'gradient-conic': 'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
                    }
                }
            }
        }
    </script>
    
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-size: 400% 400%;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        }
        
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        
        .particle {
            position: absolute;
            background: rgba(59, 130, 246, 0.3);
            border-radius: 50%;
            pointer-events: none;
            animation: particle-float 15s infinite linear;
        }
        
        @keyframes particle-float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
        }
    </style>
</head>
<body class="font-sans bg-gray-50 text-gray-900 overflow-x-hidden">
    <!-- Floating Particles -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="particle w-2 h-2" style="left: 10%; animation-delay: 0s;"></div>
        <div class="particle w-3 h-3" style="left: 20%; animation-delay: 2s;"></div>
        <div class="particle w-1 h-1" style="left: 30%; animation-delay: 4s;"></div>
        <div class="particle w-2 h-2" style="left: 40%; animation-delay: 6s;"></div>
        <div class="particle w-1 h-1" style="left: 50%; animation-delay: 8s;"></div>
        <div class="particle w-3 h-3" style="left: 60%; animation-delay: 10s;"></div>
        <div class="particle w-2 h-2" style="left: 70%; animation-delay: 12s;"></div>
        <div class="particle w-1 h-1" style="left: 80%; animation-delay: 14s;"></div>
        <div class="particle w-2 h-2" style="left: 90%; animation-delay: 16s;"></div>
    </div>

    <!-- Navigation -->
    <nav class="fixed top-0 w-full bg-white/90 backdrop-blur-md shadow-sm border-b border-gray-200 z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-bold gradient-text">Campus Hub</h1>
                    </div>
                    <div class="hidden md:block ml-10">
                        <div class="flex items-baseline space-x-6">
                            <a href="#features" class="nav-link text-gray-600 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Features</a>
                            <a href="#about" class="nav-link text-gray-600 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">About</a>
                            <a href="#tech" class="nav-link text-gray-600 hover:text-primary-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Technology</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 py-2 rounded-lg hover:from-primary-700 hover:to-primary-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 py-2 rounded-lg hover:from-primary-700 hover:to-primary-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                Log in
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center hero-gradient animate-gradient overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 text-center">
            <div class="animate-fade-in-up">
                <div class="inline-block p-2 bg-white/20 backdrop-blur-sm rounded-full mb-6">
                    <span class="bg-white text-primary-600 px-4 py-1 rounded-full text-sm font-semibold">🚀 Now Live on Campus</span>
                </div>
                <h1 class="text-6xl md:text-8xl font-extrabold text-white mb-8 leading-tight">
                    Empowering Students Through
                    <span class="block text-yellow-300 animate-pulse-slow">Community</span>
                </h1>
                <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-4xl mx-auto leading-relaxed">
                    Connect with peers, share study materials, find affordable textbooks, and discover tutoring opportunities—all in one powerful platform designed by students, for students.
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="group bg-white text-primary-600 px-10 py-4 rounded-xl text-lg font-bold hover:bg-gray-100 transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105 min-w-[200px]">
                                Go to Dashboard
                                <span class="inline-block ml-2 group-hover:translate-x-1 transition-transform">→</span>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="group bg-white text-primary-600 px-10 py-4 rounded-xl text-lg font-bold hover:bg-gray-100 transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105 min-w-[200px]">
                                Start Your Journey
                                <span class="inline-block ml-2 group-hover:translate-x-1 transition-transform">→</span>
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 floating opacity-20">
            <div class="w-20 h-20 bg-white/30 rounded-full"></div>
        </div>
        <div class="absolute top-40 right-20 floating opacity-20" style="animation-delay: 2s;">
            <div class="w-16 h-16 bg-yellow-300/40 rounded-full"></div>
        </div>
        <div class="absolute bottom-32 left-1/4 floating opacity-20" style="animation-delay: 4s;">
            <div class="w-12 h-12 bg-white/40 rounded-full"></div>
        </div>
    </section>

    <!-- Why Campus Hub -->
    <section id="about" class="bg-gradient-to-br from-gray-50 to-blue-50 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-5xl font-bold text-gray-900 mb-6">Why Campus Hub Makes a Difference</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Real-world problem-solving meets cutting-edge technology to create meaningful impact in student communities
                </p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="card-hover bg-white p-8 rounded-2xl shadow-lg text-center">
                    <div class="text-6xl mb-6 animate-bounce-slow">🤝</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Community Impact</h3>
                    <p class="text-gray-600 leading-relaxed">Directly helps students succeed academically and financially through peer collaboration</p>
                </div>
                <div class="card-hover bg-white p-8 rounded-2xl shadow-lg text-center" style="animation-delay: 0.1s;">
                    <div class="text-6xl mb-6 animate-bounce-slow">💻</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Technical Excellence</h3>
                    <p class="text-gray-600 leading-relaxed">Full-stack development showcasing modern web technologies and best practices</p>
                </div>
                <div class="card-hover bg-white p-8 rounded-2xl shadow-lg text-center" style="animation-delay: 0.2s;">
                    <div class="text-6xl mb-6 animate-bounce-slow">📈</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Scalable Growth</h3>
                    <p class="text-gray-600 leading-relaxed">Built to grow from campus to campus, expanding impact across student communities</p>
                </div>
                <div class="card-hover bg-white p-8 rounded-2xl shadow-lg text-center" style="animation-delay: 0.3s;">
                    <div class="text-6xl mb-6 animate-bounce-slow">🎓</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Academic Excellence</h3>
                    <p class="text-gray-600 leading-relaxed">Bridges technology innovation with real academic needs and student success</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="bg-white py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-5xl font-bold text-gray-900 mb-6">Everything Students Need</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    A comprehensive ecosystem designed to support every aspect of your academic journey
                </p>
            </div>
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div class="feature-item bg-gradient-to-r from-blue-50 to-indigo-50 p-8 rounded-2xl card-hover">
                        <div class="flex items-start space-x-6">
                            <div class="text-5xl">📚</div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">Smart Study Materials</h3>
                                <p class="text-gray-600 text-lg leading-relaxed">AI-powered organization of notes, exams, and study guides with intelligent search and recommendation systems</p>
                            </div>
                        </div>
                    </div>
                    <div class="feature-item bg-gradient-to-r from-green-50 to-emerald-50 p-8 rounded-2xl card-hover">
                        <div class="flex items-start space-x-6">
                            <div class="text-5xl">👩‍🏫</div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">Expert Peer Tutoring</h3>
                                <p class="text-gray-600 text-lg leading-relaxed">Connect with verified student tutors, schedule sessions, and track your academic progress in real-time</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-8">
                    <div class="feature-item bg-gradient-to-r from-yellow-50 to-orange-50 p-8 rounded-2xl card-hover">
                        <div class="flex items-start space-x-6">
                            <div class="text-5xl">💰</div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">Textbook Marketplace</h3>
                                <p class="text-gray-600 text-lg leading-relaxed">Smart price comparison, condition verification, and secure transactions for maximum savings</p>
                            </div>
                        </div>
                    </div>
                    <div class="feature-item bg-gradient-to-r from-purple-50 to-pink-50 p-8 rounded-2xl card-hover">
                        <div class="flex items-start space-x-6">
                            <div class="text-5xl">🎯</div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">Campus Events Hub</h3>
                                <p class="text-gray-600 text-lg leading-relaxed">Discover study groups, academic workshops, and networking events tailored to your interests</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technology Stack -->
    <section id="tech" class="bg-gray-50 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-5xl font-bold text-gray-900 mb-6">Built with Modern Technology</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Industry-leading tools and frameworks powering a seamless, scalable experience
                </p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-10 rounded-2xl shadow-lg text-center card-hover group">
                    <div class="text-6xl mb-6 group-hover:scale-110 transition-transform duration-300">⚡</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Laravel</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">Robust PHP framework with elegant syntax, powerful ORM, and comprehensive ecosystem</p>
                    <div class="mt-6 flex flex-wrap gap-2 justify-center">
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">MVC</span>
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">Eloquent</span>
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">Artisan</span>
                    </div>
                </div>
                <div class="bg-white p-10 rounded-2xl shadow-lg text-center card-hover group">
                    <div class="text-6xl mb-6 group-hover:scale-110 transition-transform duration-300">🔄</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Livewire</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">Dynamic frontend interactions with real-time updates and seamless user experience</p>
                    <div class="mt-6 flex flex-wrap gap-2 justify-center">
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">Real-time</span>
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">Alpine.js</span>
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">SPA-like</span>
                    </div>
                </div>
                <div class="bg-white p-10 rounded-2xl shadow-lg text-center card-hover group">
                    <div class="text-6xl mb-6 group-hover:scale-110 transition-transform duration-300">🗄️</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">MySQL</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">Reliable, high-performance database with advanced indexing and optimization</p>
                    <div class="mt-6 flex flex-wrap gap-2 justify-center">
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">ACID</span>
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">Scaling</span>
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">Security</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="relative bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 py-24 overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-5xl md:text-6xl font-bold text-white mb-8 leading-tight">Ready to Transform Your Academic Experience?</h2>
            <p class="text-2xl text-white/90 mb-12 max-w-3xl mx-auto leading-relaxed">Join thousands of students who are already saving money, building connections, and achieving academic excellence together.</p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="group bg-white text-purple-600 px-12 py-5 rounded-xl text-xl font-bold hover:bg-gray-100 transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105 min-w-[250px]">
                            Go to Dashboard
                            <span class="inline-block ml-2 group-hover:translate-x-1 transition-transform">🚀</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="group bg-white text-purple-600 px-12 py-5 rounded-xl text-xl font-bold hover:bg-gray-100 transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105 min-w-[250px]">
                            Start Now
                            <span class="inline-block ml-2 group-hover:translate-x-1 transition-transform">🚀</span>
                        </a>
                    @endauth
                @endif
            </div>
            <div class="mt-8 text-white/80">
                <p class="text-lg">✨ No credit card required • 🎓 Student-verified accounts • 🔒 100% secure</p>
            </div>
        </div>
    </section>

    <!-- Enhanced Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12">
                <div class="col-span-2">
                    <h3 class="text-3xl font-bold gradient-text mb-6">Campus Hub</h3>
                    <p class="text-gray-400 text-lg leading-relaxed mb-6">Empowering students through technology, community, and shared success. Built by students, for students.</p>
                    <div class="flex space-x-4">
                        <button class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center hover:bg-primary-500 transition-colors">📧</button>
                        <button class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center hover:bg-primary-500 transition-colors">🐦</button>
                        <button class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center hover:bg-primary-500 transition-colors">📱</button>
                    </div>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-6">Quick Links</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Features</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-6">Support</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Student Resources</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center">
                <p class="text-gray-400">© 2024 Campus Hub. Made with ❤️ for students everywhere.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript for Interactions -->
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Counter animation
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 100;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current);
            }, 20);
        }

        // Intersection Observer for counter animation
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px'
        };

        const observer = new IntersectionObserver