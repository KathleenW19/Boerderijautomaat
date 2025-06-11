<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Boerderij Automaat</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        @include('components.header')
        <main>
            <section class="automaat-container">
                <!-- Vakken automaat -->
                <div class="producten">
                    <!-- Row 1 -->
                    <div class="row row-1">
                        @foreach ($vakken->take(3) as $index => $vak) <!-- drie vakken -->
                            @component('components.vak', ['vak'=> $vak, 'index' => $index]) @endcomponent
                        @endforeach
                    </div>

                    <!-- Row 2 -->
                    <div class="row row-2">
                        @foreach ($vakken->slice(3, 4) as $index => $vak) <!-- vier vakken -->
                            @component('components.vak', ['vak'=> $vak, 'index' => $index]) @endcomponent
                        @endforeach
                    </div>

                    <!-- Row 3 -->
                    <div class="row row-3">
                        @foreach ($vakken->slice(7, 2) as $index => $vak) <!-- twee vakken -->
                            @component('components.vak', ['vak'=> $vak, 'index' => $index]) @endcomponent
                        @endforeach
                    </div>
                </div>

                <!-- Betaal scherm -->
                <div class="betalen-container">
                    <h2>Kies een product</h2>
                    <div id="product-lijst">
                        <!-- Toon product lijst van vakken die vol zijn -->
                        @foreach ($vakken->whereNotIn('status', ['leeg']) as $vak)
                            @if ($vak->product)
                                <div class="product-keuze" data-vak-id="{{ $vak->id }}" data-product-id="{{ $vak->product->id }}" data-product-naam="{{ $vak->product->product_naam }}" data-prijs="{{ $vak->product->prijs }}">
                                    Vak {{ $vak->id }}: {{ $vak->product->product_naam }} - €{{ number_format($vak->product->prijs, 2) }}
                                    <button onclick="bevestigKeuze({{ $vak->id }})" class="btn">Kies</button>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- bevestig product keuze -->
                    <div id="bevestiging" style="display:none;">
                        <p id="bevestiging-tekst"></p>
                        <button onclick="toonBetaalopties()">Ja, kopen</button>
                        <button onclick="annuleerKeuze()">Nee</button>
                    </div>

                    <!-- kies betaalmethoden -->
                    <div id="betaalopties" style="display:none;">
                        <p>Kies uw betaalmethode:</p>
                        <button onclick="betaal('contant')">Contant</button>
                        <button onclick="betaal('contactloos')">Contactloos</button>
                    </div>

                    <!-- instructies tonen na betaling -->
                    <div id="instructies" style="display:none;">
                        <p>Uw vak is geopend. Haal uw product eruit.</p>
                        <p>Klik op het vak om het product mee te nemen.</p>
                    </div>
                </div>
            </section>
        </main>

        <script>
            let gekozenVakId = null;

            // Toon bevesteging vraag of correct product is gekozen
            function bevestigKeuze(vakId) {
                gekozenVakId = vakId;
                const div = document.querySelector(`.product-keuze[data-vak-id="${vakId}"]`);
                const naam = div.dataset.productNaam;
                const prijs = div.dataset.prijs;

                document.getElementById('product-lijst').style.display = 'none';
                document.getElementById('bevestiging').style.display = 'block';
                document.getElementById('bevestiging-tekst').innerText = `Wilt u "${naam}" kopen voor €${prijs}?`;
            }

            function annuleerKeuze() {
                gekozenVakId = null;
                document.getElementById('bevestiging').style.display = 'none';
                document.getElementById('product-lijst').style.display = 'block';
            }

            function toonBetaalopties() {
                document.getElementById('bevestiging').style.display = 'none';
                document.getElementById('betaalopties').style.display = 'block';
            }

            function betaal(methode) {
                fetch(`/vak/${gekozenVakId}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ status: 'vak geopend' })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Eerste fetch response:', data);
                    if (data.success) {
                        const vakElement = document.querySelector(`.product-keuze[data-vak-id="${gekozenVakId}"]`);
                        const gekozenProductId = vakElement ? vakElement.getAttribute('data-product-id') : null;
                        const gekozenAantal = 1; 

                        /*console.log('gekozenVakId:', gekozenVakId);
                        console.log('vakElement:', vakElement);
                        console.log('gekozenProductId:', gekozenProductId);*/

                        // Transactie aanmaken
                        fetch(`/transactie`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                product_id: gekozenProductId,
                                aantal: gekozenAantal,
                                betaal_methode: methode
                            })
                        })
                        .then(res => res.json())
                        .then(transactieData => {
                            if (transactieData.success) {
                                // Succesmelding of verdere afhandeling
                                alert('Transactie succesvol!');
                            } else {
                                alert('Transactie mislukt!');
                            }
                        })
                        .catch(error => {
                            alert('Fout bij het aanmaken van de verkooptransactie: ' + error.message);
                        });

                        // UI updates
                        document.getElementById('betaalopties').style.display = 'none';
                        document.getElementById('instructies').style.display = 'block';

                        // Toon productafbeelding
                        const productImage = document.querySelector(`img.vak-product-afbeelding[data-vak-id="${gekozenVakId}"]`);
                        if (productImage) {
                            productImage.classList.remove('verborgen');
                        }

                        // Verberg deur-afbeelding
                        const deurAfbeelding = document.querySelector(`img.vak-deur-afbeelding[data-vak-id="${gekozenVakId}"]`);
                        if (deurAfbeelding) {
                            deurAfbeelding.classList.add('verborgen');
                        }
                    }
                });
            }

            // Event delegation voor click op vak images
            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('vak-deur-afbeelding')) {
                    const vakId = e.target.dataset.vakId;

                    if (vakId == gekozenVakId) {
                        // Product eruit halen (vak leeg maken)
                        fetch(`/vak/${vakId}/update-status`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ status: 'leeg' })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                // Verberg product afbeelding
                                const productImage = document.querySelector(`img.vak-product-afbeelding[data-vak-id="${vakId}"]`);
                                if (productImage) {
                                    productImage.style.display = 'none';
                                }

                                // Maak de deur afbeelding weer zichtbaar
                                const deurAfbeelding = document.querySelector(`img.vak-deur-afbeelding[data-vak-id="${vakId}"]`);
                                if (deurAfbeelding) {
                                    deurAfbeelding.classList.remove('verborgen'); // Deur wordt zichtbaar
                                }

                                gekozenVakId = null;

                                // Terug naar startscherm
                                document.getElementById('instructies').style.display = 'none';
                                document.getElementById('product-lijst').style.display = 'block';
                            }
                        });
                    } else {
                        alert("U kunt dit vak nu niet openen.");
                    }
                }
            });

        </script>
    </body>
</html>