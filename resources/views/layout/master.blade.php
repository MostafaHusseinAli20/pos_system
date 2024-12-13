<!DOCTYPE html>
<html lang="en" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    @include('layout.head')
</head>
<body>
    <div class="wrapper"> 
        @include('layout.main-headbar')
        @include('layout.main-sidebar')

        @section('main-content')
        @show

        @include('partials._sessions')

        @include('layout.footer')
    </div>
    @include('layout.scripts')
    @stack('scripts')

</body>
</html>