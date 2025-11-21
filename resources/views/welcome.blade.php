<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IOM Management Helper Tool</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="https://iom.edu.bd/wp-content/uploads/2023/05/cropped-iom.jpg" />
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
                        bounceSubtle: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
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
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(40, 167, 69, 0.15);
        }

        .gradient-text {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .pulse-ring {
            animation: pulseRing 2s infinite;
        }

        @keyframes pulseRing {
            0% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
            }

            70% {
                box-shadow: 0 0 0 20px rgba(40, 167, 69, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
            }
        }
    </style>
</head>

<body class="bg-backgroundLight dark:bg-backgroundDark font-display text-gray-800 dark:text-gray-200 min-h-screen flex flex-col">

    <!-- Floating Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-primary opacity-5 rounded-full blur-3xl dark:opacity-10"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-primary opacity-5 rounded-full blur-3xl dark:opacity-10"></div>
    </div>

    <!-- Header/Navigation -->
    <header class="border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 sticky top-0 z-50 backdrop-blur-sm bg-opacity-80 dark:bg-opacity-80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-center items-center">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center pulse-ring">
                    <img src="https://iom.edu.bd/wp-content/uploads/2023/05/cropped-iom.jpg" alt="IOM Logo" class="w-8 h-8 rounded-lg">
                </div>
                <div class="ml-3">
                    <a href="/" class="flex flex-col sm:flex-row sm:items-baseline gap-0 no-underline">
                        <span class="text-lg sm:text-2xl font-extrabold gradient-text leading-tight">Islamic Online Madrasah</span>
                        <span class="hidden sm:inline-block w-2"></span>
                        <span class="text-sm sm:text-base text-gray-600 dark:text-gray-400 font-medium mt-0.5 sm:mt-0 sm:ml-2">Largest online Madrasah in Asia</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="flex-grow flex flex-col justify-center items-center text-center px-4 py-20 relative z-10">
        <div class="animate-fade-in">
            <h1 class="text-6xl md:text-7xl font-bold mb-6 animate-slide-up">
                <span class="gradient-text">Management Tools Hub</span>
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto animate-slide-up" style="animation-delay: 0.1s">
                Streamline your Islamic Online Madrasah management with our comprehensive suite of tools designed for modern educational excellence.
            </p>
            <a href="/auth/login" class="inline-block bg-primary hover:bg-primary-dark text-white px-10 py-4 rounded-lg font-semibold transition transform hover:scale-105 hover:shadow-lg animate-slide-up" style="animation-delay: 0.2s">
                Go to Dashboard
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 px-4 relative z-10">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center mb-16 text-gray-900 dark:text-white">Our Tools</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div class="card-hover bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-8">
                    <div class="w-14 h-14 bg-primary bg-opacity-20 rounded-lg flex items-center justify-center mb-4 animate-bounce-subtle">
                        <svg class="w-7 h-7 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.5 1.5H5.75A2.25 2.25 0 003.5 3.75v12.5A2.25 2.25 0 005.75 18.5h8.5a2.25 2.25 0 002.25-2.25V6.5m-11-5v5h5m-5 4h8m-8 3h8" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Student Management</h3>
                    <p class="text-gray-600 dark:text-gray-400">Efficiently manage student records, enrollment, progress tracking, and academic performance in one centralized platform.</p>
                </div>

                <!-- Feature Card 2 -->
                <div class="card-hover bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-8">
                    <div class="w-14 h-14 bg-primary bg-opacity-20 rounded-lg flex items-center justify-center mb-4 animate-bounce-subtle" style="animation-delay: 0.2s">
                        <svg class="w-7 h-7 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Feedback System</h3>
                    <p class="text-gray-600 dark:text-gray-400">Collect and analyze detailed feedback from students, parents, and instructors to continuously improve your institute.</p>
                </div>

                <!-- Feature Card 3 -->
                <div class="card-hover bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-8">
                    <div class="w-14 h-14 bg-primary bg-opacity-20 rounded-lg flex items-center justify-center mb-4 animate-bounce-subtle" style="animation-delay: 0.4s">
                        <svg class="w-7 h-7 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Room Management</h3>
                    <p class="text-gray-600 dark:text-gray-400">Organize and manage virtual classrooms, schedule sessions, and coordinate resources for seamless learning experiences.</p>
                </div>

                <!-- Feature Card 4 -->
                <div class="card-hover bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-8">
                    <div class="w-14 h-14 bg-primary bg-opacity-20 rounded-lg flex items-center justify-center mb-4 animate-bounce-subtle" style="animation-delay: 0.6s">
                        <svg class="w-7 h-7 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v4h8v-4zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">User Roles</h3>
                    <p class="text-gray-600 dark:text-gray-400">Define and manage multiple user roles with specific permissions for administrators, teachers, students, and staff.</p>
                </div>

                <!-- Feature Card 5 -->
                <div class="card-hover bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-8">
                    <div class="w-14 h-14 bg-primary bg-opacity-20 rounded-lg flex items-center justify-center mb-4 animate-bounce-subtle" style="animation-delay: 0.8s">
                        <svg class="w-7 h-7 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm3.293 1.293a1 1 0 011.414 0L10 9.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Communications</h3>
                    <p class="text-gray-600 dark:text-gray-400">Enable seamless communication between instructors, students, and parents through integrated messaging and notifications.</p>
                </div>

                <!-- Feature Card 6 -->
                <div class="card-hover bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-8">
                    <div class="w-14 h-14 bg-primary bg-opacity-20 rounded-lg flex items-center justify-center mb-4 animate-bounce-subtle" style="animation-delay: 1s">
                        <svg class="w-7 h-7 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Financial Management</h3>
                    <p class="text-gray-600 dark:text-gray-400">Track fees, payments, invoices, and financial reports with a transparent and secure billing system.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 relative z-10">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-900 border-2 border-primary border-opacity-20 rounded-2xl p-12 text-center">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Ready to Get Started?</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-8 text-lg">Access all your management tools and simplify your Islamic Online Madrasah operations today.</p>
            <a href="/dashboard" class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-lg font-semibold transition transform hover:scale-105">
                Launch Dashboard
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 py-8 text-center mt-auto relative z-10">
        <p class="text-gray-600 dark:text-gray-400 font-medium">&copy; 2025 Islamic Online Madrasah. All rights reserved.</p>
        <p class="text-gray-500 dark:text-gray-500 text-sm mt-2">
            Developed by <a href="https://github.com/mdsiamulislam" class="text-primary hover:underline font-semibold">Siam | Contract for more info </a>
        </p>
    </footer>

</body>

</html>