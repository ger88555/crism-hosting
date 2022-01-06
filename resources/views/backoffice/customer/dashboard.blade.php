<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de Administración del Sitio
        </h2>
        <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    </x-slot>

    <main class="flex bg-gray-100">
        <aside class="bg-blue-500 relative h-screen w-72 md:w-64 hidden sm:block shadow-xl">
            <nav class="text-white text-base font-semibold pt-3">
                <a href="#" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item"><i class="icon ion-ios-at"></i> Correos</a>
                <br/>
                <a href="#" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item"><i class="icon ion-ios-link"></i> Dominios</a>
                <br/>
                <a href="#" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item"><i class="icon ion-md-cloud"></i> Hosting</a>
                <br/>
                <a href="#" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item"><i class="icon ion-md-aperture"></i> Wiregards</a>
            </nav>
        </aside>
    </main>
    
    <!--<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    (Sin implementar)
                </div>
            </div>
        </div>
    </div>-->
</x-app-layout>
