<x-guest-layout>
    <div class="text-center">
        <header class="mb-4">
            <h1 class="text-3xl font-bold text-gray-600">{{config('app.name')}}</h1>
        </header>
        <div class="bg-white py-14 px-40 rounded shadow-md">
            <p class="text-gray-600 mb-4 text-2xl font-semibold">Login or Register to get started.</p>
            <div class="flex space-x-8 pt-6">
                <a href="{{route('register')}}" class="bg-white hover:bg-black text-black hover:text-white transition-colors duration-200 border border-black font-bold py-2 px-4 rounded flex-grow inline-block">
                    Register
                </a>
                <a href="{{route('login')}}" class="bg-black hover:bg-black/70 text-white font-bold py-2 px-4 rounded flex-grow inline-block transition-colors duration-200">
                    Login
                </a>
            </div>

        </div>
    </div>
</x-guest-layout>

