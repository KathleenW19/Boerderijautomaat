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
        <!-- Vooraad tonen van producten, producten die al in de machine zitten niet mee gerekend-->
        <section>
            <h1>Producten voorraad exclusief machine.</h1>
            <div class="card-grid">
                @foreach ($producten as $product)
                    <div class="card">
                        <img src="{{ asset($product->afbeelding_met_product) }}" class="card-img" alt="Vak met product en deur open">
                        <div class="card-body">
                            <h4 class="card-title">{{ $product->product_naam }}</h4>
                            <p class="card-text">Voorraad: {{ $product->voorraad->sum('aantal') }}</p>
                            <a href="{{ route('producten.edit', ['id' => $product->id])}}" class="btn">Bijwerken</a>
                            <form action="{{ route('producten.delete', ['id' => $product->id]) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn">Verwijder</button>
                            </form>
                        </div>
                    </div>
                @endforeach
                    <div class="card">
                        <a href="{{ route('producten.create')}}" class="add-btn">+</a>
                        <p>Voeg nieuw product toe.</p>
                    </div>
            </div>
        </section>

    <!-- Foutmelding -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    </main>
</body>
</html>
