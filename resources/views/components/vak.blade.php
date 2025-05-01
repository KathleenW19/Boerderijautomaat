<div class="column">
                            <div class="vak-nummer">
                                {{ $index + 1 }}
                            </div>
                            <!-- kijk vak status na voor correct afbeelding -->
                            <img src="{{ $vak->afbeelding_src }}" 
                                class="card-img vak-image" 
                                alt="{{ $vak->afbeelding_alt }}"
                                data-vak-id="{{ $vak->id }}"
                                @if(isset($vak->product)) data-product-id="{{ $vak->product->id }}" @endif
                                onclick="{{ $vak->afbeelding_on_click }}">
                        </div>