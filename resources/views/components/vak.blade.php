<div class="column">
    <div class="vak-nummer">
        {{ $index + 1 }}
    </div>

    <div class="vak-image-container">
        @if ($vak->product)
            <img src="{{ asset($vak->product->afbeelding_met_product) }}"
                class="card-img-automaat vak-product-afbeelding {{ $vak->status === 'leeg' ? 'verborgen' : '' }}"
                data-vak-id="{{ $vak->id }}"
                alt="Product afbeelding">
        @endif

            <img src="{{ asset('images/deur_dicht.png') }}"
                class="card-img-automaat vak-deur-afbeelding"
                data-vak-id="{{ $vak->id }}"
                alt="Deur afbeelding">
    </div>
</div>
