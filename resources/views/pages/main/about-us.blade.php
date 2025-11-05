@extends('layouts.main.app')
@section('content')
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>About Us</title>


    </head>

    <body class="bg-white text-black dark:bg-gray-950 dark:text-gray-100 antialiased transition-colors duration-500">
        <main class="max-w-6xl mx-auto p-6 lg:p-12">

            <!-- Hero Section -->
            <section class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-4 text-gray-900 dark:text-white">About Us</h1>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto text-lg">We are a team of creative
                    professionals building innovative, human-centered products that blend functionality and beauty.</p>
            </section>

            <!-- Decorative Line -->
            <div class="relative flex justify-center mb-16">
                <div class="h-1 w-32 bg-gradient-to-r from-primary to-secondary rounded-full"></div>
            </div>

            <!-- Team Section -->
            <section class="space-y-12">
                <!-- Member 1 -->
                <article
                    class="bg-gray-100 dark:bg-gray-900 rounded-3xl shadow-lg hover:shadow-primary/30 transition-all duration-300 flex flex-col md:flex-row items-center gap-8 p-8">
                    <img src="about_us/1.jpg" alt="Ahmed Alaa"
                        class="w-32 h-32 rounded-full object-cover border-4 border-primary shadow-md" />
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">Ahmed Alaa</h3>
                        <p class="text-secondary font-medium mb-3">Full-Stack Web Developer</p>
                        <p class="text-gray-600 dark:text-gray-400">Front-End developer using React js as a framewrork to
                            develope websites with the Tailwind framework for CSS and i'm looking for a jop this days.</p>
                    </div>
                </article>

                <!-- Member 2 -->
                <article
                    class="bg-gray-100 dark:bg-gray-900 rounded-3xl shadow-lg hover:shadow-secondary/30 transition-all duration-300 flex flex-col md:flex-row items-center gap-8 p-8">
                    <img src="about_us/2.jpg" alt="Lina Samir"
                        class="w-32 h-32 rounded-full object-cover border-4 border-secondary shadow-md" />
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">Ahmed Taha</h3>
                        <p class="text-secondary font-medium mb-3">Full-Stack Web Developer</p>
                        <p class="text-gray-600 dark:text-gray-400">I’m a motivated Front-End Developer and ITI Trainee with
                            a strong passion for creating modern, responsive, and user-friendly web applications.</p>
                    </div>
                </article>

                <!-- Member 3 -->
                <article
                    class="bg-gray-100 dark:bg-gray-900 rounded-3xl shadow-lg hover:shadow-emerald-400/30 transition-all duration-300 flex flex-col md:flex-row items-center gap-8 p-8">
                    <img src="about_us/3.jpg" alt="Marwan Abdullah"
                        class="w-32 h-32 rounded-full object-cover border-4 border-emerald-400 shadow-md" />
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">Saad Safwat</h3>
                        <p class="text-secondary font-medium mb-3">Full-Stack Web Developer</p>
                        <p class="text-gray-600 dark:text-gray-400">I am a Full Stack Developer with expertise in PHP,
                            Laravel, and Angular, building responsive and dynamic web applications.
                            I have strong skills in JavaScript, TypeScript, HTML, CSS, Bootstrap, and MySQL. </p>
                    </div>
                </article>

                <!-- Member 4 -->
                <article
                    class="bg-gray-100 dark:bg-gray-900 rounded-3xl shadow-lg hover:shadow-pink-500/30 transition-all duration-300 flex flex-col md:flex-row items-center gap-8 p-8">
                    <img src="about_us/4.jpg" alt="Reem Nader"
                        class="w-32 h-32 rounded-full object-cover border-4 border-pink-500 shadow-md" />
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">Tasneem Gaballah
                        </h3>
                        <p class="text-secondary font-medium mb-3">Full-Stack Web Developer</p>
                        <p class="text-gray-600 dark:text-gray-400">PHP Developer, PHP Web Developer and PHP Programmer
                            roles</p>
                    </div>
                </article>
            </section>

            <!-- Call to Action -->
            <section
                class="mt-16 bg-gradient-to-r from-primary to-secondary text-white rounded-3xl p-10 shadow-2xl text-center">
                <h3 class="text-3xl font-bold mb-3">Want to work with us?</h3>
                <p class="text-white/90 mb-6 max-w-2xl mx-auto">If you have an idea, project, or partnership in mind, reach
                    out to us — we’d love to collaborate and bring it to life.</p>
                <a href="{{ route('contact.form') }}"
                    class="bg-white text-gray-900 font-semibold px-6 py-3 rounded-xl shadow hover:opacity-90 transition">Contact
                    Us</a>
            </section>

            <!-- Footer -->
            <footer class="mt-12 text-center text-gray-600 dark:text-gray-500 text-sm">© 2025 Creative Team — All Rights
                Reserved</footer>
        </main>

    </body>

    </html>
@endsection
