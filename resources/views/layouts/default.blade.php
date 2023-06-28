<!doctype html>
<html>
<head>
   @include('includes.head')
</head>
<body>
<div>
    @isset($message)
        @include('includes.error')
    @endisset    
   <header class="row">
       @include('includes.header')
   </header>
   <div>
           @yield('content')
   </div>
   <footer class="row">
       @include('includes.footer')
   </footer>

    <div class="backImg"></div>
</div>
</body>
</html>