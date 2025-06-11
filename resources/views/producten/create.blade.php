<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product aanmaken</title>
    </head>
    <body>
        @include('components.header')
        <main>
            <h1>Product toevoegen:</h1>
            <form method="POST" action="{{ route('producten.store')}}" enctype="multipart/form-data">
            @csrf
                <label for="product_naam">Product naam:</label>
                <input type="text" id="product_naam" name="product_naam" required>

                <label for="prijs">Prijs:</label>
                <input type="text" id="prijs" name="prijs" required>

                <label for="categorie_id">Categorie:</label>
                <select name="categorie_id" id="categorie_id" required>
                    <option value="" selected>Kies een categorie</option>
                    @foreach ($categorieen as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->naam }}</option>
                    @endforeach
                </select>

                <label for="voorraad">Huidige voorraad:</label>
                <input type="text" id="voorraad" name="voorraad" required>

                <label for="afbeelding_met_product">Afbeelding:</label>
                <input type="file" name="afbeelding_met_product" accept="image/*" required>

                <button type="submit" class="btn">Opslaan</button>
            </form>
        </main>
    </body>
</html>