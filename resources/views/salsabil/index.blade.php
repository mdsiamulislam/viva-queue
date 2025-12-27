<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Salsabil App</title>
    <link rel="icon" type="image/png" href="{{ asset('images/salsabil/fab_icon.png') }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Salsabil is a beautifully designed mobile app that helps you stay connected with daily duas, azkar, and essential Islamic resources.">
    <meta name="keywords" content="Salsabil, Islamic App, Duas, Azkar, Islamic Resources, Mobile App">
    <meta name="author" content="Salsabil Team">

    <!-- Tailwind CDN -->
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

<body class="bg-white text-gray-800">

    <!-- Navbar -->
    <header class="border-b">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <img src="{{ asset('images/salsabil/logo.png') }}" alt="Salsabil Logo" class="h-10">
            <nav class="space-x-6 text-sm">
                <a href="#features" class="hover:text-primary">Features</a>
                <a href="#screens" class="hover:text-primary">Screens</a>
                <a href="#download" class="hover:text-primary">Download</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">
        <!-- Left -->
        <div>
            <h2 class="text-4xl md:text-5xl font-bold leading-tight">
                Your Daily
                <span class="text-primary">Islamic Companion</span>
            </h2>

            <p class="mt-6 text-lg text-gray-600">
                Salsabil is a beautifully designed mobile app that helps you
                stay connected with daily duas, azkar, and essential Islamic resources.
            </p>

            <div class="mt-8 flex gap-4">
                <a href="#download"
                    class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-green-700 transition">
                    Download App
                </a>

                <a href="#features"
                    class="border border-primary text-primary px-6 py-3 rounded-lg font-medium hover:bg-green-50 transition">
                    Explore Features
                </a>
            </div>
        </div>

        <!-- Right (Mobile Mockup) -->
        <div class="flex justify-center">
            <div class="w-[260px] bg-gray-100 rounded-3xl shadow-lg p-4">
                <img
                    src="https://placehold.co/300x600?text=Salsabil+App+Demo"
                    alt="Salsabil App Demo"
                    class="rounded-2xl">
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-6">
            <h3 class="text-3xl font-semibold text-center mb-12">
                What You’ll Get in Salsabil
            </h3>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8">
                <!-- Blog -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h4 class="font-semibold text-lg mb-2 text-primary">
                        Islamic Blogs
                    </h4>
                    <p class="text-gray-600 text-sm">
                        Read well-written Islamic articles and reflections anytime.
                    </p>
                </div>

                <!-- Audio -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h4 class="font-semibold text-lg mb-2 text-primary">
                        Audio Content
                    </h4>
                    <p class="text-gray-600 text-sm">
                        Listen to duas, lectures, and reminders on the go.
                    </p>
                </div>

                <!-- Video -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h4 class="font-semibold text-lg mb-2 text-primary">
                        Video Library
                    </h4>
                    <p class="text-gray-600 text-sm">
                        Watch Islamic videos and short reminders inside the app.
                    </p>
                </div>

                <!-- News -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h4 class="font-semibold text-lg mb-2 text-primary">
                        Islamic News
                    </h4>
                    <p class="text-gray-600 text-sm">
                        Stay updated with authentic and relevant Islamic news.
                    </p>
                </div>

                <!-- Posters -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h4 class="font-semibold text-lg mb-2 text-primary">
                        Islamic Posters
                    </h4>
                    <p class="text-gray-600 text-sm">
                        Beautiful posters with ayahs, hadith, and reminders.
                    </p>
                </div>

                <!-- Offline -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h4 class="font-semibold text-lg mb-2 text-primary">
                        Offline Access
                    </h4>
                    <p class="text-gray-600 text-sm">
                        Save content and access it even without internet.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- App Screens -->
    <section id="screens" class="py-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-semibold mb-10">
                App Preview
            </h3>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <img src="https://placehold.co/200x400?text=Home" class="rounded-xl shadow">
                <img src="https://placehold.co/200x400?text=Azkars" class="rounded-xl shadow">
                <img src="https://placehold.co/200x400?text=Hadith" class="rounded-xl shadow">
                <img src="https://placehold.co/200x400?text=Profile" class="rounded-xl shadow">
            </div>
        </div>
    </section>

    <!-- Download -->
    <section id="download" class="bg-primary py-20">
        <div class="max-w-7xl mx-auto px-6 text-center text-white">
            <h3 class="text-3xl font-semibold mb-4">
                Download Salsabil App
            </h3>
            <p class="mb-10 text-green-100">
                Available on official app stores for Android and iOS.
            </p>

            <div class="flex justify-center gap-6 flex-wrap">
                <!-- Google Play -->
                <a href="#" class="transition hover:scale-105">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                        alt="Get it on Google Play"
                        class="h-14">
                </a>

                <!-- App Store -->
                <a href="#" class="transition hover:scale-105">
                    <img
                        src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                        alt="Download on the App Store"
                        class="h-14">
                </a>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="border-t py-6">
        <div class="max-w-7xl mx-auto px-6 text-center text-sm text-gray-500">
            © {{ date('Y') }} Salsabil App. All rights reserved.
        </div>
    </footer>

</body>

</html>