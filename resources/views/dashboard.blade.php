<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IOM Dashboard</title>
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
                        'bounce-subtle': 'bounceSubtle 2s ease-in-out infinite',
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
                        bounceSubtle: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            }
                        }
                    }
                }
            },
            darkMode: 'class'
        }
    </script>

    <style>
        .tool-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .tool-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(40, 167, 69, 0.15);
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
        }
    </style>
</head>

<body class="bg-backgroundLight dark:bg-backgroundDark font-display text-gray-800 dark:text-gray-200 min-h-screen">

    <!-- Floating Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-primary opacity-5 rounded-full blur-3xl dark:opacity-10"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-primary opacity-5 rounded-full blur-3xl dark:opacity-10"></div>
    </div>

    <!-- Header -->
    <header class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50 backdrop-blur-sm bg-opacity-80 dark:bg-opacity-80">
        <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-xl">IOM</span>
                </div>
                <h1 class="text-2xl font-bold text-primary hidden sm:inline">Dashboard</h1>
            </div>
            <button id="themeToggle" class="p-2 rounded-lg bg-gray-200 dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-700 transition">
                <svg class="w-5 h-5" id="sunIcon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.536l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.121-10.607a1 1 0 010 1.414l-.707.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 19a1 1 0 01-1-1v-1a1 1 0 112 0v1a1 1 0 01-1 1zm-4-14.464l-.707-.707a1 1 0 00-1.414 1.414l.707.707a1 1 0 001.414-1.414zM2.05 6.464a1 1 0 010-1.414l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0z" />
                </svg>
                <svg class="w-5 h-5 hidden" id="moonIcon" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-16 relative z-10">
        <div class="text-center mb-16 animate-fade-in">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">IOM Management Tools</h2>
            <p class="text-gray-600 dark:text-gray-400 text-lg">Choose a tool to manage your Islamic Online Madrasah</p>
        </div>

        <!-- Tools Grid -->
        <div class="card-grid">
            <!-- Student Management -->
            <div class="tool-card bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-8 animate-slide-up" style="animation-delay: 0s">
                <div class="w-14 h-14 bg-primary bg-opacity-20 rounded-lg flex items-center justify-center mb-6 animate-bounce-subtle">
                    <svg class="w-7 h-7 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v4h8v-4zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Student Management</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Efficiently manage student records, enrollment, progress tracking, and academic performance.</p>
                <a href="#" class="inline-block bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-lg font-semibold transition transform hover:scale-105">
                    Access Tool
                </a>
            </div>

            <!-- Feedback System -->
            <div class="tool-card bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-8 animate-slide-up" style="animation-delay: 0.1s">
                <div class="w-14 h-14 bg-primary bg-opacity-20 rounded-lg flex items-center justify-center mb-6 animate-bounce-subtle" style="animation-delay: 0.2s">
                    <svg class="w-7 h-7 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Feedback System</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Collect and analyze detailed feedback from students, parents, and instructors to improve quality.</p>
                <a href="#" class="inline-block bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-lg font-semibold transition transform hover:scale-105">
                    Access Tool
                </a>
            </div>

            <!-- Room Management -->
            <div class="tool-card bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-8 animate-slide-up" style="animation-delay: 0.2s">
                <div class="w-14 h-14 bg-primary bg-opacity-20 rounded-lg flex items-center justify-center mb-6 animate-bounce-subtle" style="animation-delay: 0.4s">
                    <svg class="w-7 h-7 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Room Management</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Organize and manage virtual classrooms, schedule sessions, and coordinate resources effectively.</p>
                <a href="#" class="inline-block bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-lg font-semibold transition transform hover:scale-105">
                    Access Tool
                </a>
            </div>

            <!-- Communications -->
            <div class="tool-card bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-8 animate-slide-up" style="animation-delay: 0.3s">
                <div class="w-14 h-14 bg-primary bg-opacity-20 rounded-lg flex items-center justify-center mb-6 animate-bounce-subtle" style="animation-delay: 0.6s">
                    <svg class="w-7 h-7 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Communications</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Enable seamless communication between instructors, students, and parents through messaging and notifications.</p>
                <a href="#" class="inline-block bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-lg font-semibold transition transform hover:scale-105">
                    Access Tool
                </a>
            </div>

            <!-- Financial Management -->
            <div class="tool-card bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-8 animate-slide-up" style="animation-delay: 0.4s">
                <div class="w-14 h-14 bg-primary bg-opacity-20 rounded-lg flex items-center justify-center mb-6 animate-bounce-subtle" style="animation-delay: 0.8s">
                    <svg class="w-7 h-7 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Financial Management</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Track fees, payments, invoices, and financial reports with a transparent and secure billing system.</p>
                <a href="#" class="inline-block bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-lg font-semibold transition transform hover:scale-105">
                    Access Tool
                </a>
            </div>

            <!-- User Management -->
            <div class="tool-card bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-8 animate-slide-up" style="animation-delay: 0.5s">
                <div class="w-14 h-14 bg-primary bg-opacity-20 rounded-lg flex items-center justify-center mb-6 animate-bounce-subtle" style="animation-delay: 1s">
                    <svg class="w-7 h-7 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.533 1.533 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.533 1.533 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">User Management</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Define and manage multiple user roles with specific permissions for administrators, teachers, and staff.</p>
                <a href="#" class="inline-block bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-lg font-semibold transition transform hover:scale-105">
                    Access Tool
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 py-8 text-center mt-16 relative z-10">
        <p class="text-gray-600 dark:text-gray-400 font-medium">&copy; 2025 Islamic Online Madrasah. All rights reserved.</p>
        <p class="text-gray-500 dark:text-gray-500 text-sm mt-2">
            Developed by <a href="https://github.com/yourgithub" class="text-primary hover:underline font-semibold">Soaib</a>
        </p>
    </footer>

    <!-- Theme Toggle Script -->
    <script>
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
    </script>

</body>

</html>