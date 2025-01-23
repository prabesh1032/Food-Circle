
@extends('Layouts.master')

@section('title', 'Contact Us')

@section('content')
<!-- Hero Section -->
<div class="bg-cover bg-center h-96" style="background-image: url('{{ asset('foodcircle.jpg') }}');">
    <div class="flex items-center justify-center h-full bg-black bg-opacity-50">
        <div class="text-center text-white">
            <h1 class="text-6xl font-bold mb-4">Contact Us</h1>
            <p class="text-2xl">We'd love to hear from you. Get in touch today!</p>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="py-16 bg-black">
    <div class="container mx-auto">
        <h2 class="text-4xl font-bold text-center text-cyan-400 mb-12">Get in Touch</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Contact Information -->
            <div class="bg-gray-900 shadow-lg rounded-lg p-8 text-white">
                <h3 class="text-2xl font-bold mb-6 text-cyan-400">Contact Information</h3>
                <p class="text-lg mb-6">Reach out to us using the following details:</p>
                <ul>
                    <li class="flex items-center mb-6 text-lg">
                        <i class="ri-map-pin-line text-cyan-400 text-2xl mr-4"></i>
                        <span>123 FoodCircle Avenue, Kathmandu, Nepal</span>
                    </li>
                    <li class="flex items-center mb-6 text-lg">
                        <i class="ri-phone-fill text-cyan-400 text-2xl mr-4"></i>
                        <a href="tel:+9812965119" class="hover:text-yellow-500">+9812965119</a>
                    </li>
                    <li class="flex items-center mb-6 text-lg">
                        <i class="ri-mail-line text-cyan-400 text-2xl mr-4"></i>
                        <a href="mailto:foodcircle@gmail.com" class="hover:text-yellow-500">foodcircle@gmail.com</a>
                    </li>
                </ul>
                <div class="mt-6 flex space-x-4">
                    <a href="#" class="text-2xl text-cyan-400 hover:text-yellow-500"><i class="ri-facebook-fill"></i></a>
                    <a href="#" class="text-2xl text-cyan-400 hover:text-yellow-500"><i class="ri-twitter-fill"></i></a>
                    <a href="#" class="text-2xl text-cyan-400 hover:text-yellow-500"><i class="ri-instagram-fill"></i></a>
                    <a href="#" class="text-2xl text-cyan-400 hover:text-yellow-500"><i class="ri-linkedin-box-fill"></i></a>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-gray-900 shadow-lg rounded-lg p-8">
                <h3 class="text-2xl font-bold mb-6 text-cyan-400">Send Us a Message</h3>
                <form action="" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-lg font-medium text-white mb-2">Your Name</label>
                        <input type="text" name="name" id="name" class="w-full border border-gray-700 rounded-lg py-3 px-4 bg-gray-800 text-white focus:outline-none focus:border-cyan-400" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-lg font-medium text-white mb-2">Your Email</label>
                        <input type="email" name="email" id="email" class="w-full border border-gray-700 rounded-lg py-3 px-4 bg-gray-800 text-white focus:outline-none focus:border-cyan-400" required>
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-lg font-medium text-white mb-2">Your Message</label>
                        <textarea name="message" id="message" rows="5" class="w-full border border-gray-700 rounded-lg py-3 px-4 bg-gray-800 text-white focus:outline-none focus:border-cyan-400" required></textarea>
                    </div>
                    <button type="submit" class="bg-cyan-400 hover:bg-yellow-500 text-black font-bold py-3 px-6 rounded-lg text-lg">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

