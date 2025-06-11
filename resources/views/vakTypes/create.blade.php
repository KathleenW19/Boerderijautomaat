<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vak type toevoegen</title>
    </head>
    <body>
        @include('components.header')
        <main>
            <h1>Vak type veranderen:</h1>
            <form method="POST" action="{{ route('vakTypes.store') }}">
                @csrf
                <h3>Voeg vaktype toe</h3>
                <label for="naam">Naam:</label>
                <input type="text" id="naam" name="naam" required>

                <button type="submit" class="btn btn-warning">Toevoegen</button>
            </form>
        </main>
    </body>
</html>