<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>IOM Dashboard — Glassmorphism</title>

    <!-- Tailwind (with forms + container queries) -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#28a745",
                        "primary-600": "#22c55e",
                        glass: "rgba(255,255,255,0.06)",
                        "glass-2": "rgba(255,255,255,0.10)",
                        bgLight: "#f6f8fa",
                        bgDark: "#081016"
                    },
                    fontFamily: {
                        display: ["Inter", "ui-sans-serif", "system-ui", "sans-serif"]
                    },
                    boxShadow: {
                        glass: "0 8px 30px rgba(15, 23, 42, 0.08)",
                        glassDark: "0 8px 30px rgba(2, 6, 23, 0.6)"
                    },
                    animation: {
                        "fade-up": "fadeUp .45s ease-out both",
                        float: "float 3s ease-in-out infinite"
                    },
                    keyframes: {
                        fadeUp: {
                            "0%": {
                                opacity: 0,
                                transform: "translateY(14px)"
                            },
                            "100%": {
                                opacity: 1,
                                transform: "translateY(0)"
                            }
                        },
                        float: {
                            "0%": {
                                transform: "translateY(0px)"
                            },
                            "50%": {
                                transform: "translateY(-6px)"
                            },
                            "100%": {
                                transform: "translateY(0px)"
                            }
                        }
                    }
                }
            }
        };
    </script>

    <style>
        /* Small helper to make glass hover smoother */
        .glass-card {
            transition: transform .28s cubic-bezier(.2, .9, .2, 1), box-shadow .28s;
            -webkit-backdrop-filter: saturate(120%) blur(8px);
            backdrop-filter: saturate(120%) blur(8px);
        }

        .glass-card:focus-within {
            transform: translateY(-6px) scale(1.01);
        }

        /* Accessibility fallback for browsers that don't support backdrop-filter */
        @supports not ((-webkit-backdrop-filter: blur(1px)) or (backdrop-filter: blur(1px))) {
            .glass-card {
                background-color: rgba(255, 255, 255, 0.85) !important;
            }

            .dark .glass-card {
                background-color: rgba(8, 16, 22, 0.92) !important;
            }
        }
    </style>
</head>

<body class="bg-bgLight dark:bg-bgDark text-slate-900 dark:text-slate-100 antialiased">
    <!-- Floating accents -->
    <div class="fixed inset-0 pointer-events-none -z-10">
        <div class="absolute -left-20 -top-20 w-96 h-96 bg-gradient-to-br from-primary/20 to-transparent rounded-full blur-3xl opacity-30 animate-float dark:opacity-20"></div>
        <div class="absolute -right-20 -bottom-10 w-80 h-80 bg-gradient-to-tr from-primary-600/15 to-transparent rounded-full blur-3xl opacity-30 dark:opacity-18"></div>
    </div>

    <!-- Header -->
    <header class="sticky top-0 z-40 backdrop-blur-sm bg-white/60 dark:bg-black/40 border-b border-white/40 dark:border-black/60">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-b from-primary to-primary-600 flex items-center justify-center text-white font-extrabold shadow glass-card"
                    title="IOM">
                    IOM
                </div>
                <div>
                    <h1 class="text-lg font-extrabold">IOM Dashboard</h1>
                    <p class="text-sm text-slate-600 dark:text-slate-300">Management tools & admin utilities</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="hidden sm:flex items-center gap-3 bg-white/40 dark:bg-white/5 rounded-full px-3 py-1.5 text-sm text-slate-700 dark:text-slate-200">
                    <svg class="w-4 h-4 text-primary" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zM4.22 4.22a1 1 0 011.415 0l.707.707A1 1 0 015.95 6.05l-.707-.707a1 1 0 010-1.122zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1z"></path>
                    </svg>
                    <span class="font-medium">Manage tools</span>
                </div>

                <button id="themeToggle" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition">
                    <svg id="sun" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zM4.22 4.22a1 1 0 011.415 0l.707.707A1 1 0 015.95 6.05l-.707-.707a1 1 0 010-1.122zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1z" />
                    </svg>
                    <svg id="moon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707 8 8 0 1017.293 13.293z" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <main class="max-w-7xl mx-auto px-6 py-12">
        <section class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-3">IOM Management Tools</h2>
            <p class="text-slate-600 dark:text-slate-300 max-w-2xl mx-auto">Choose a tool to manage your Islamic Online Madrasah — fast, clean, and modern UI.</p>
        </section>

        <!-- Tools grid -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Card: Feedback -->
            <article class="glass-card bg-white/60 dark:bg-black/40 border border-white/30 dark:border-white/5 rounded-2xl p-6 min-h-[320px] flex flex-col justify-between shadow-glass dark:shadow-glassDark animate-fade-up">
                <div>
                    <div class="w-14 h-14 rounded-lg bg-gradient-to-b from-primary to-primary-600 flex items-center justify-center mb-4 shadow">
                        <svg class="w-7 h-7 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-2">Feedback System</h3>
                    <p class="text-slate-600 dark:text-slate-300">Collect, analyze, and act on student feedback to improve quality.</p>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <a href="{{ route('feedback.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white font-semibold shadow hover:opacity-95 transition">
                        Access Tool
                    </a>
                    <span class="text-xs text-slate-500 dark:text-slate-400">v1.2</span>
                </div>
            </article>

            <!-- Card: Communications (example) -->
            <article class="glass-card bg-white/60 dark:bg-black/40 border border-white/30 dark:border-white/5 rounded-2xl p-6 min-h-[320px] flex flex-col justify-between shadow-glass dark:shadow-glassDark animate-fade-up" style="animation-delay:80ms">
                <div>
                    <div class="w-14 h-14 rounded-lg bg-primary/10 dark:bg-primary/20 flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-primary" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-2">Get Together Invitation</h3>
                    <p class="text-slate-600 dark:text-slate-300">Create and send invitations, manage RSVPs, and export attendee lists.</p>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <a href="{{ route('gettogether.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary/95 text-white font-semibold shadow hover:opacity-95 transition">
                        Access Tool
                    </a>
                    <span class="text-xs text-slate-500 dark:text-slate-400">Events</span>
                </div>
            </article>

            <!-- Card: Room Management (disabled example) -->
            <article class="glass-card bg-white/40 dark:bg-black/30 border border-white/20 dark:border-white/3 rounded-2xl p-6 min-h-[320px] flex flex-col justify-between shadow-glass dark:shadow-glassDark opacity-60 pointer-events-none select-none grayscale animate-fade-up" style="animation-delay:160ms">
                <div>
                    <div class="w-14 h-14 rounded-lg bg-slate-200/40 dark:bg-slate-700/30 flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-slate-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-2">Room Management</h3>
                    <p class="text-slate-600 dark:text-slate-400">Coming soon — schedule rooms, virtual class links, and resources.</p>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <button class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-slate-400 text-white font-semibold" disabled>Locked</button>
                    <span class="text-xs text-slate-500 dark:text-slate-400">Soon</span>
                </div>
            </article>

            <!-- Card: Financial Management -->
            <article class="glass-card bg-white/60 dark:bg-black/40 border border-white/30 dark:border-white/5 rounded-2xl p-6 min-h-[320px] flex flex-col justify-between shadow-glass dark:shadow-glassDark animate-fade-up" style="animation-delay:240ms">
                <div>
                    <div class="w-14 h-14 rounded-lg bg-gradient-to-b from-primary to-primary-600 flex items-center justify-center mb-4 shadow">
                        <svg class="w-7 h-7 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-2">Financial Management</h3>
                    <p class="text-slate-600 dark:text-slate-300">Invoices, payments and transparent accounting for your madrasah.</p>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <a href="#" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white font-semibold shadow hover:opacity-95 transition">Open</a>
                    <span class="text-xs text-slate-500 dark:text-slate-400">Finance</span>
                </div>
            </article>

            <!-- Card: User Management -->
            <article class="glass-card bg-white/60 dark:bg-black/40 border border-white/30 dark:border-white/5 rounded-2xl p-6 min-h-[320px] flex flex-col justify-between shadow-glass dark:shadow-glassDark animate-fade-up" style="animation-delay:320ms">
                <div>
                    <div class="w-14 h-14 rounded-lg bg-primary/10 dark:bg-primary/20 flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-primary" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.533 1.533 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.533 1.533 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-2">User Management</h3>
                    <p class="text-slate-600 dark:text-slate-300">Roles, permissions, and secure access control for staff and teachers.</p>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <a href="#" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white font-semibold shadow hover:opacity-95 transition">Manage</a>
                    <span class="text-xs text-slate-500 dark:text-slate-400">Admin</span>
                </div>
            </article>

        </section>

        <!-- Optional footer row / stats -->
        <section class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="glass-card bg-white/55 dark:bg-black/40 border border-white/30 dark:border-white/5 rounded-2xl p-5 shadow-glass dark:shadow-glassDark">
                <h4 class="text-slate-600 dark:text-slate-300 text-sm">Active Students</h4>
                <p class="text-2xl font-bold mt-2">1,284</p>
            </div>
            <div class="glass-card bg-white/55 dark:bg-black/40 border border-white/30 dark:border-white/5 rounded-2xl p-5 shadow-glass dark:shadow-glassDark">
                <h4 class="text-slate-600 dark:text-slate-300 text-sm">Open Tasks</h4>
                <p class="text-2xl font-bold mt-2">24</p>
            </div>
            <div class="glass-card bg-white/55 dark:bg-black/40 border border-white/30 dark:border-white/5 rounded-2xl p-5 shadow-glass dark:shadow-glassDark">
                <h4 class="text-slate-600 dark:text-slate-300 text-sm">Pending Payments</h4>
                <p class="text-2xl font-bold mt-2">৳ 52,400</p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="max-w-7xl mx-auto px-6 py-8 text-center text-slate-600 dark:text-slate-400">
        <div class="text-sm">© 2025 Islamic Online Madrasah — Designed by <strong class="text-primary">Soaib</strong></div>
    </footer>

    <!-- Theme toggling -->
    <script>
        const html = document.documentElement;
        const toggle = document.getElementById('themeToggle');
        const sun = document.getElementById('sun');
        const moon = document.getElementById('moon');

        const initial = localStorage.getItem('theme') || 'light';
        html.classList.toggle('dark', initial === 'dark');
        if (initial === 'dark') {
            sun.classList.add('hidden');
            moon.classList.remove('hidden');
        }

        toggle.addEventListener('click', () => {
            const dark = html.classList.toggle('dark');
            localStorage.setItem('theme', dark ? 'dark' : 'light');
            sun.classList.toggle('hidden', dark);
            moon.classList.toggle('hidden', !dark);
        });
    </script>
</body>

</html>