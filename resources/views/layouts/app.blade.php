<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IOM Management Helper Tool')</title>

    <link rel="icon" type="image/png" href="https://iom.edu.bd/wp-content/uploads/2023/05/cropped-iom.jpg" />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

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

        * {
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
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
    </style>
</head>

<body class="bg-backgroundLight dark:bg-backgroundDark font-display text-gray-800 dark:text-gray-200 min-h-screen antialiased flex flex-col">

    <!-- Header -->
    <header class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50 shadow-soft">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-lg overflow-hidden ring-1 ring-gray-200 dark:ring-gray-700 group-hover:ring-primary transition-all">
                        <img src="https://iom.edu.bd/wp-content/uploads/2023/05/cropped-iom.jpg" alt="IOM Logo" class="w-full h-full object-contain">
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="text-lg font-bold group-hover:text-primary transition-colors">
                            {{ $title ?? 'IOM Management Helper Tool' }}
                        </h1>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Islamic Online Madrasah</p>
                    </div>
                </a>

                <a href="{{ route('dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-primary px-3 py-2 text-sm font-medium">
                    Go to Dashboard
                </a>
            </div>
        </div>
    </header>

    <!-- Main -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        @yield('content')
    </main>



    <!-- Footer -->
    <footer class="border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                    <img src="https://iom.edu.bd/wp-content/uploads/2023/05/cropped-iom.jpg" class="w-6 h-6 opacity-75">
                    <span>© 2025 Islamic Online Madrasah. All rights reserved.</span>
                </div>

                <a href="https://iom.edu.bd" target="_blank" class="text-gray-600 dark:text-gray-400 hover:text-primary transition-colors">
                    Visit IOM Website
                </a>
            </div>
        </div>
    </footer>

    <script>
        function initTheme() {
            const theme = localStorage.getItem('theme') || 'light';
            document.documentElement.classList.toggle('dark', theme === 'dark');
        }
        initTheme();
    </script>

</body>

</html>