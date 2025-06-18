<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Producten voorraad</title>
    </head>
    <body>
        @include('components.header')
        <main>
            <!-- Vooraad tonen van alle producten, producten die al in de machine zitten niet mee gerekend-->
            <section>
                <h1>Producten voorraad exclusief machine.</h1>
                <div class="card-grid">
                    @foreach ($producten as $product)
                        <div class="card">
                            <img src="{{ asset($product->afbeelding_met_product) }}" class="card-img" alt="Vak met product en deur open">
                            <div class="card-body">
                                <h4 class="card-title">{{ $product->product_naam }}</h4>
                                <p class="card-text">Voorraad: {{ $product->voorraad->sum('aantal') }}</p>
                                <p class="card-text">Prijs: {{ $product->prijs }}</p>
                                <p class="card-text">Categorie: {{ $product->categorie->naam }}</p>
                                <section class="button-container">
                                    <a href="{{ route('producten.edit', ['id' => $product->id])}}" class="btn">Bijwerken</a>
                                    <form action="{{ route('producten.delete', ['id' => $product->id]) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn">Verwijder</button>
                                    </form>
                                </section>
                            </div>
                        </div>
                    @endforeach
                        <div class="card add-card">
                            <a href="{{ route('producten.create')}}" class="add-btn">+</a>
                            <p>Voeg nieuw product toe.</p>
                        </div>
                </div>
            </section>

        <!-- Foutmelding -->
        @component('components.foutmelding') @endcomponent
        </main>
    </body>
</html>
