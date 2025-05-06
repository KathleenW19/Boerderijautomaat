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
    <section>
        <h1>Status vakken</h1>
        <table>
            <thead>
                <tr>
                    <th>Vak</th>
                    <th>Status</th>
                    <th>Product</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <!-- status van vakken tonen en mogelijkheid geven om te vullen -->
                @foreach ($vakken as $index => $vak)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ ucfirst($vak->status) }}</td>
                        <td>
                            @if ($vak->status == 'leeg')
                                Geen product geselecteerd
                            @elseif ($vak->product)
                                {{ $vak->product->product_naam }}
                            @else
                                Geen product in dit vak
                            @endif
                        </td>
                        <td>
                            <!-- Alleen de mogelijkheid geven om vakken bij te vullen als deze leeg is -->
                            @if ($vak->status == 'leeg')
                                <form action="{{ route('bijvullen') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="vak_id" value="{{ $vak->id }}">
                                    <select name="product_id" class="form-control" required>
                                        <option value="">Kies een product</option>
                                        @foreach ($producten as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_naam }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn">Vullen</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <!-- Vooraad tonen van producten, producten die al in de machine zitten niet mee gerekend-->
    <section>
        <h1>Producten voorraad exclusief machine.</h1>
        <div class="card-grid">
            @foreach ($producten as $product)
                <div class="card">
                    <img src="{{ asset($product->deur_afbeelding) }}" class="card-img-top" alt="Vak met product en deur open">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->product_naam }}</h4>
                        <p class="card-text">Voorraad: {{ $product->voorraad->sum('aantal') }}</p>
                        <a href="{{ route('voorraad.edit', ['id' => $product->id])}}" class="btn">Bijwerken</a>
                    </div>
                </div>
            @endforeach
                <div class="card">
                    <a href="#" class="add-btn">+</a>
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
