<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Producten transacties</title>
    </head>
    <body>
        @include('components.header')
        <main>
        <section>
            <h1>Verkoop transacties</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Aantal</th>
                        <th>Betaal methode</th>
                        <th>Totaal Bedrag</th>
                        <th>Tijd</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transacties as $transactie)
                        <tr>
                            <td>{{ $transactie->id }}</td>
                            <td>
                                @foreach($transactie->verkochteProducten as $verkocht)
                                    {{$verkocht->product->product_naam}}
                                @endforeach
                            </td>
                            <td>
                                @foreach($transactie->verkochteProducten as $verkocht)
                                    {{$verkocht->aantal}}
                                @endforeach
                            </td>
                            <td>{{ $transactie->betaal_methode}}</td>
                            <td>{{ $transactie->totaalbedrag}}</td>
                            <td>{{ $transactie->transactie_tijd}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <!-- Foutmelding -->
        @component('components.foutmelding') @endcomponent
        </main>
    </body>
</html>
