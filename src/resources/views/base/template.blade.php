<!DOCTYPE html>
<html lang="en">
    @include('library::base.head')
<body>
    @include('library::base.sidebar')
    <div class="box" id="app">
        @yield('content')
    </div>
</body>
</html>