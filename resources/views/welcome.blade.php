<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aanmelden</title>

        @vite('resources/css/app.css')
    </head>
    <body>
        <header>
            <h1>Welkom bij de boerderijautomaat</h1>
        </header>
        <main>
            <section class="login">
                <h2>Log in:</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <label for="uname">Username:</label><br>
                    <input type="text" name="uname" id="uname"><br>

                    <label for="pwd">password:</label><br>
                    <input type="password" name="pwd" id="pwd"><br><br>

                    <button>Log in</button>
                </form>

                <!-- Algemene foutmelding als login niet lukt -->
                @if(session('error'))
                    <div class="error">{{ session('error') }}</div>
                @endif
            </section>
        </main>
    </body>
</html>
