<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Viva Queue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tailwind CDN (simple setup) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#16a34a', // green
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
            <h1 class="text-xl font-semibold text-primary">
                Viva Queue
            </h1>

            <nav class="space-x-6 text-sm">
                <a href="#features" class="hover:text-primary">Features</a>
                <a href="#about" class="hover:text-primary">About</a>
                <a href="#contact" class="hover:text-primary">Contact</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-24 text-center">
        <h2 class="text-4xl md:text-5xl font-bold leading-tight">
            Smart & Simple
            <span class="text-primary">Queue Management</span>
        </h2>

        <p class="mt-6 text-lg text-gray-600 max-w-2xl mx-auto">
            Viva Queue helps organizations manage queues efficiently,
            reduce waiting time, and improve customer experience.
        </p>

        <div class="mt-10 flex justify-center gap-4">
            <a href="#contact"
                class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-green-700 transition">
                Get Started
            </a>

            <a href="#about"
                class="border border-primary text-primary px-6 py-3 rounded-lg font-medium hover:bg-green-50 transition">
                Learn More
            </a>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-6">
            <h3 class="text-3xl font-semibold text-center mb-12">
                Key Features
            </h3>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h4 class="font-semibold text-lg mb-2 text-primary">
                        Live Queue Tracking
                    </h4>
                    <p class="text-gray-600 text-sm">
                        Monitor queue status in real-time with accurate updates.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h4 class="font-semibold text-lg mb-2 text-primary">
                        Token System
                    </h4>
                    <p class="text-gray-600 text-sm">
                        Issue digital tokens and manage customer flow easily.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h4 class="font-semibold text-lg mb-2 text-primary">
                        Admin Dashboard
                    </h4>
                    <p class="text-gray-600 text-sm">
                        Control queues, users, and analytics from one place.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="max-w-7xl mx-auto px-6 py-20">
        <div class="max-w-3xl mx-auto text-center">
            <h3 class="text-3xl font-semibold mb-6">
                About Viva Queue
            </h3>
            <p class="text-gray-600 leading-relaxed">
                Viva Queue is a modern queue management system designed for
                hospitals, institutions, and service centers.
                Our goal is to simplify operations and deliver a smooth experience
                for both admins and customers.
            </p>
        </div>
    </section>

    <!-- Contact / CTA -->
    <section id="contact" class="bg-primary py-16">
        <div class="max-w-7xl mx-auto px-6 text-center text-white">
            <h3 class="text-3xl font-semibold mb-4">
                Ready to Get Started?
            </h3>
            <p class="mb-6 text-green-100">
                Contact us today and transform the way you manage queues.
            </p>

            <a href="mailto:info@vivaqueue.com"
                class="bg-white text-primary px-6 py-3 rounded-lg font-medium hover:bg-green-100 transition">
                Contact Us
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t py-6">
        <div class="max-w-7xl mx-auto px-6 text-center text-sm text-gray-500">
            © {{ date('Y') }} Viva Queue. All rights reserved.
        </div>
    </footer>

</body>

</html>