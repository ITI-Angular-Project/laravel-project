@extends('layouts.main.app')
@section('content')
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Contact Us </title>


    </head>

    <body class="bg-white text-black dark:bg-gray-950 dark:text-gray-100 antialiased transition-colors duration-500">
        <main class="max-w-4xl mx-auto p-6 lg:p-12">




            @if (session('success'))
                <div style="color: green;">{{ session('success') }}</div>
            @endif




            <!-- Hero Section -->
            <section class="text-center mb-12">
                <h1 class="text-4xl font-extrabold mb-4 text-gray-900 dark:text-white">Contact Us</h1>
                <p class="text-gray-600 dark:text-gray-400 text-lg max-w-2xl mx-auto">We would love to hear from you! Fill
                    out the form below or reach us via email or phone.</p>
            </section>

            <!-- Contact Form -->
            <section>
                <form class="bg-gray-100 dark:bg-gray-900 rounded-3xl p-8 shadow-lg space-y-6"
                    action="{{ route('contact.send') }}" method="post">
                    @csrf
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Name</label>
                        <input type="text" name="name" placeholder="Your Name"
                            class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-black dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                            value="{{ old('name') }}" />
                        @error('name')
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Email</label>
                        <input type="email" placeholder="you@example.com" name="email"
                            class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-black dark:text-white focus:outline-none focus:ring-2 focus:ring-primary" />
                        @error('email')
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Message</label>
                        <textarea placeholder="Your message" rows="5" name="message"
                            class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-black dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                    </div>
                    @error('message')
                        <p style="color:red">{{ $message }}</p>
                    @enderror
                    <button type="submit"
                        class="w-full bg-primary text-gray font-semibold py-3 rounded-xl shadow hover:opacity-90 transition focus:outline-none focus:ring-2 focus:ring-secondary">Send
                        Message</button>
                </form>
            </section>

            <!-- Footer -->
            <footer class="mt-12 text-center text-gray-600 dark:text-gray-400 text-sm">© 2025 Creative Team — All Rights
                Reserved</footer>
        </main>


    </body>

    </html>
@endsection
