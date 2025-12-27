<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Salsabil Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('images/salsabil/fab_icon.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#16a34a',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r hidden md:block">
            <div class="p-6 font-semibold text-xl text-primary">
                Salsabil
            </div>

            <nav class="px-4 space-y-2 text-sm">
                <a href="#" class="block px-4 py-2 rounded bg-green-50 text-primary font-medium">
                    Dashboard
                </a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
                    Blogs
                </a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
                    Audio
                </a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
                    Videos
                </a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
                    News
                </a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100">
                    Posters
                </a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100 text-red-500">
                    Logout
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">

            <!-- Topbar -->
            <header class="bg-white border-b px-6 py-4 flex justify-between items-center">
                <h1 class="text-lg font-semibold">
                    Dashboard
                </h1>

                <div class="text-sm text-gray-600">
                    Admin
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>

        </div>
    </div>

</body>

</html>