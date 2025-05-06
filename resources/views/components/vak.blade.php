<div class="column">
    <div class="vak-nummer">
        {{ $index + 1 }}
    </div>

    <div class="vak-image-container">
        @if($vak->product)
            <img src="{{ asset($vak->product->afbeelding_met_product) }}"
                 class="card-img vak-product-afbeelding"
                 data-vak-id="{{ $vak->id }}"
                 alt="Product afbeelding">
        @endif

        <!--<img src="{{ asset('images/deur_dicht.png') }}"
             class="card-img vak-deur-afbeelding"
             alt="Deur afbeelding"
             data-vak-id="{{ $vak->id }}">-->
    </div>
</div>
