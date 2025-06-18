<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Boerderijautomaat header</title>
        
        @vite('resources/css/app.css')
    </head>
    <body>
        <header>
            <h1>Boerderijautomaat</h1>
            <nav>
                <div class="nav-left">
                    <ul>
                        @auth
                            @if(Auth::user()->role === 'medewerker' || Auth::user()->role === 'beheerder')
                                <li><a href="{{ route('boerderijautomaat.index')}}">Home</a></li>
                                <li><a href="{{ route('vakken.index')}}">Voorraad Vakken</a></li>
                                <li><a href="{{ route('producten.index')}}">Voorraad Producten</a></li>
                                <li><a href="{{ route('transactie.index')}}">Transacties</a></li>
                                <li><a href="{{ route('productCategorie.index')}}">Product categoriën</a></li>
                                <li><a href="{{ route('vakTypes.index')}}">Vak type</a></li>
                            @endif
                        @endauth
                    </ul>
                </div>
                
                <!-- Kijk na of gebruiker is ingelogd -->
                <div class="nav-right">
                    <ul>
                        @auth
                            <li class="welcome-text">Welkom, {{ Auth::user()->naam }}</li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="logout-button">Logout</button>
                            </form>
                        @endauth

                        <!-- Als gebruiker niet is ingelogd -->
                        @guest
                            <a href="{{ route('login.form')}}">Log in</a>
                        @endguest
                    </ul>
                </div>
            </nav>
        </header>
    </body>
</html>
