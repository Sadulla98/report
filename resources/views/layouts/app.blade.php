<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <!-- Scripts -->
{{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
{{--            <header class="bg-white shadow">--}}
{{--                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
{{--                    {{ $header }}--}}
{{--                </div>--}}
{{--            </header>--}}

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"> </script>
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

        <script src="{{asset('js/app.js')}}"></script>
        <script src="{{asset('js/custom.js')}}"></script>

        <script>
            $(document).ready(function () {

                let sessionSuccess ="{{session('success')}}";
                if(sessionSuccess){
                    toastr.success(sessionSuccess)
                }
                let sessionWarning = "{{session('warning')}}";
                if(sessionWarning){
                    toastr.success(sessionWarning)
                }
                let sessionError = "{{session('error')}}";
                if(sessionError){
                    toastr.success(sessionError)
                }

                // Enable pusher logging - don't include this in production
                Pusher.logToConsole = true;

                var pusher = new Pusher('e34714d50c0b6a19a70c', {
                    cluster: 'ap2',
                    forceTLS: false,
                });

                var channel = pusher.subscribe('task');
                channel.bind('notice', function(data) {
                    alert(JSON.stringify(data));
                });

            });
        </script>

    </body>
</html>
