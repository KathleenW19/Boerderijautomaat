<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product categorie aanpassen</title>
    </head>
    <body>
        @include('components.header')
        <main>
            <h1>Vak type veranderen: {{ $categorie->id }}</h1>
            <form method="POST" action="{{ route('productCategorie.update', $categorie->id) }}">
                @csrf
                @method('PUT')
                <h3>Verander de categorie</h3>
                <label for="naam">Naam:</label>
                <input type="text" id="naam" name="naam" value="{{ old('naam', $categorie->naam) }}" required>

                <button type="submit" class="btn btn-warning">Bijwerken</button>
            </form>
        </main>

    </body>
</html>
