<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vakken voorraad</title>
    </head>
    <body>
        @include('components.header')
        <main>
        <section>
            <h1>Status vakken</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Vak</th>
                        <th>Vak type</th>
                        <th>Status</th>
                        <th>Product</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- status van vakken tonen en mogelijkheid geven om te vullen of leegmaken -->
                    @foreach ($vakken as $index => $vak)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ ucfirst($vak->vakType->naam ?? 'Geen type') }}</td>
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
                                    <form action="{{ route('vakken.bijvullen') }}" method="POST">
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
                                @else
                                    <!-- Als het vak niet leeg is, geef de mogelijkheid om bij te werken of leeg te maken -->
                                    <a href="{{route('vakken.edit', $vak->id)}}" class="btn">Bijwerken</a>
                                    <form action="{{route('vakken.empty', $vak->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn">Vak leegmaken</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
