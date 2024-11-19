<!DOCTYPE html>
<html lang="en">
<head>
    
    <title> @yield('title') </title>
   </head>
 <body>
    <header>
     </header>
     @include('includes.nav')
    <main>
 @yield('content')
    </main>
</body>
</html>