<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten Voorraad</title>
</head>
<body>
    @include('components.header')
    <main>
        <h1>Product bijwerken: {{ $product->product_naam }}</h1>
        <form method="POST" action="{{ route('voorraad.update', $product->id)}}" required>
        @csrf
        @method('PUT')
            <label for="productname">Product naam:</label>
            <input type="text" id="productname" name="productname" value="{{ old('productname', $product->product_naam) }}" required>

            <label for="prijs">Prijs:</label>
            <input type="text" id="prijs" name="prijs" value="{{ old('prijs', $product->prijs) }}" required>

            <label for="categorie_id">Categorie:</label>
            <select name="categorie_id" id="categorie_id" required>
                <option value="{{ $product->categorie->id }}" selected>{{ $product->categorie->naam }}</option>
                @foreach ($categorieen as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->naam }}</option>
                @endforeach
            </select>

            <label for="voorraad">Huidige voorraad:</label>
            <input type="text" id="voorraad" name="voorraad" value="{{ old('voorraad', $product->voorraad->sum('aantal')) }}" required>

            <button type="submit" class="btn">Bijwerken</button>
        </form>
    </main>

</body>