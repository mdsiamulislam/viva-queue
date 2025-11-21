<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IOM Login</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#28a745',
                        'primary-dark': '#1e7e34',
                        backgroundLight: '#f8f9fa',
                        backgroundDark: '#0f1419',
                    },
                    fontFamily: {
                        display: ['Inter', 'sans-serif']
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.8s ease-in',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            }
                        },
                        slideUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(30px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            }
                        }
                    }
                }
            },
            darkMode: 'class'
        }
    </script>

    <style>
        .floating-shape {
            animation: float 3s ease-in-out infinite;
        }

        .login-card {
            backdrop-filter: blur(10px);
        }

        .google-btn {
            transition: all 0.3s ease;
        }

        .google-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(40, 167, 69, 0.2);
        }

        .logo-pulse {
            animation: logoPulse 2s ease-in-out infinite;
        }

        @keyframes logoPulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
            }
        }
    </style>
</head>

<body class="bg-backgroundLight dark:bg-backgroundDark font-display text-gray-800 dark:text-gray-200 min-h-screen flex flex-col">

    <!-- Floating Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-10 right-20 w-72 h-72 bg-primary opacity-5 rounded-full blur-3xl dark:opacity-10 floating-shape"></div>
        <div class="absolute bottom-10 left-20 w-96 h-96 bg-primary opacity-5 rounded-full blur-3xl dark:opacity-10 floating-shape" style="animation-delay: 1s"></div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center px-4 relative z-10">
        <div class="w-full max-w-md">
            <!-- Login Card -->
            <div class="login-card bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-10 animate-slide-up">

                <!-- Heading -->
                <div class="text-center mb-8 animate-fade-in">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Welcome Back</h1>
                    <p class="text-gray-600 dark:text-gray-400">Sign in to your IOM AdminSuite</p>
                </div>

                <!-- Divider -->
                <div class="relative mb-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200 dark:border-gray-800"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white dark:bg-gray-900 text-gray-500">Sign in with</span>
                    </div>
                </div>

                <!-- Google Login Button -->
                <button class="google-btn w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white font-semibold py-3 px-4 rounded-lg flex items-center justify-center gap-3 hover:bg-gray-50 dark:hover:bg-gray-700" onclick="handleGoogleLogin()">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>
                    <span>Continue with Google</span>
                </button>

                <!-- Features List -->
                <div class="mt-10 space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-5 h-5 bg-primary bg-opacity-20 rounded flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">Manage students and courses</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-5 h-5 bg-primary bg-opacity-20 rounded flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">Track feedback and analytics</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-5 h-5 bg-primary bg-opacity-20 rounded flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">Secure and reliable platform</span>
                    </div>
                </div>

            </div>

            <!-- Footer Text -->
            <div class="text-center mt-8 animate-fade-in">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    By signing in, you agree to our
                    <a href="https://iom.edu.bd/en/terms/" class="text-primary hover:underline">Terms of Service</a> and
                    <a href="https://iom.edu.bd/en/terms/" class="text-primary hover:underline">Privacy Policy</a>
                </p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 py-6 text-center relative z-10 mt-auto">
        <p class="text-gray-600 dark:text-gray-400 text-sm">&copy; 2025 Islamic Online Madrasah. All rights reserved.</p>
    </footer>

    <!-- Scripts -->
    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');
        const html = document.documentElement;

        const theme = localStorage.getItem('theme') || 'light';
        html.classList.toggle('dark', theme === 'dark');
        updateIcons(theme);

        themeToggle.addEventListener('click', () => {
            const isDark = html.classList.toggle('dark');
            const newTheme = isDark ? 'dark' : 'light';
            localStorage.setItem('theme', newTheme);
            updateIcons(newTheme);
        });

        function updateIcons(theme) {
            if (theme === 'dark') {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            } else {
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            }
        }

        // Google Login Handler
        function handleGoogleLogin() {
            // Replace with your actual Google OAuth implementation
            // For now, it redirects to dashboard
            alert('Google login would be implemented here.\nRedirecting to dashboard...');
            window.location.href = '/dashboard';
        }

        // You can implement actual Google OAuth like this:
        /*
        function handleGoogleLogin() {
            // Initialize Google Sign-In
            // This requires the Google Sign-In library to be loaded
            gapi.auth2.getAuthInstance().signIn().then(() => {
                window.location.href = '/dashboard';
            });
        }
        */
    </script>

</body>

</html>