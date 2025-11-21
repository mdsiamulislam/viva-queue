<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IOM Management Helper Tool')</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="https://iom.edu.bd/wp-content/uploads/2023/05/cropped-iom.jpg" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: 'class',
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
                    borderRadius: {
                        DEFAULT: '0.375rem',
                        lg: '0.5rem',
                        xl: '0.75rem',
                        '2xl': '1rem',
                        full: '9999px'
                    },
                    boxShadow: {
                        'soft': '0 2px 8px rgba(0, 0, 0, 0.04)',
                        'soft-lg': '0 4px 16px rgba(0, 0, 0, 0.06)',
                    }
                }
            }
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24;
        }

        /* Smooth transitions */
        * {
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #374151;
        }

        .dark ::-webkit-scrollbar-thumb:hover {
            background: #4b5563;
        }
    </style>
</head>

<body class="bg-backgroundLight dark:bg-backgroundDark font-display text-gray-800 dark:text-gray-200 min-h-screen antialiased">

    <!-- Header -->
    <header class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50 shadow-soft">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Brand -->
                <div class="flex items-center gap-4">
                    <a href="/" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 rounded-lg overflow-hidden bg-white shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 group-hover:ring-primary transition-all">
                            <img src="https://iom.edu.bd/wp-content/uploads/2023/05/cropped-iom.jpg"
                                alt="IOM Logo"
                                class="w-full h-full object-contain">
                        </div>
                        <div class="hidden sm:block">
                            <h1 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-primary transition-colors">
                                {{ $title ?? 'IOM Management Helper Tool' }}
                            </h1>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Islamic Online Madrasah
                            </p>
                        </div>
                    </a>
                </div>

                <!-- Navigation -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('feedback.index') }}"
                        class="text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        Manage Feedback
                    </a>
                </div>


            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-auto border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                    <img src="https://iom.edu.bd/wp-content/uploads/2023/05/cropped-iom.jpg"
                        alt="IOM"
                        class="w-6 h-6 object-contain opacity-75">
                    <span>© 2025 Islamic Online Madrasah. All rights reserved.</span>
                </div>
                <div class="flex items-center gap-4 text-sm">
                    <a href="https://iom.edu.bd" target="_blank" rel="noopener noreferrer" class="text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary transition-colors">
                        Visit IOM Website
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Theme Toggle Script -->
    <script>
        // Initialize theme
        function initTheme() {
            const theme = localStorage.getItem('theme') || 'light';
            document.documentElement.classList.toggle('dark', theme === 'dark');
        }

        function toggleTheme() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }

        // Run on load
        initTheme();
    </script>

</body>

</html>