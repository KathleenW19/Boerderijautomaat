<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vak type aanpassen</title>
</head>
<body>
    @include('components.header')
    <main>
        <h1>Vak type veranderen: {{ $vakType->id }}</h1>
        <form method="POST" action="{{ route('vakTypes.update', $vakType->id) }}">
            @csrf
            @method('PUT')
            <h3>Verander het vaktype</h3>
            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" value="{{ old('naam', $vakType->naam) }}" required>

            <button type="submit" class="btn btn-warning">Bijwerken</button>
        </form>
    </main>

</body>
</html>