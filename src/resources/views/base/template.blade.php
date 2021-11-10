<!DOCTYPE html>
<html lang="en">
    @include('library::base.head')
    <body>
        @include('library::base.sidebar')
        <div class="library-content v-cloak" id="app">
            @yield('content')
        </div>
        @include('library::base.scripts')
    </body>
</html>