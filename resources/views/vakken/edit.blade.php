<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vak bijwerken</title>
</head>
<body>
    @include('components.header')
    <main>
        <h1>Vak bijwerken: {{ $vak->id }}</h1>
        <form method="POST" action="{{ route('vakken.update', $vak->id)}}" required>
            @csrf
            @method('PUT')
            <h3>Kies een nieuw product</h3>
            <select name="product_id" class="form-control" required>
                @foreach ($producten as $product)
                    <option value="{{ $product->id }}" {{ $product->id == $vak->product_id ? 'selected' : '' }}>
                        {{ $product->product_naam }}
                    </option>
                @endforeach
            </select>

            <h3>Kies een vaktype</h3>
            <select name="vak_type_id" class="form-control" required>
                @foreach ($vakTypes as $vakType)
                    <option value="{{ $vakType->id }}" 
                        {{ $vak->vak_type_id  == $vakType->id ? 'selected' : '' }}>
                        {{ $vakType->naam }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-warning">Bijwerken</button>
        </form>
    </main>

</body>