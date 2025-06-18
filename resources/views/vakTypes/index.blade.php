<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vakken types</title>
    </head>
    <body>
        @include('components.header')
        <main>
            <section>
                <h1>Vakken types lijst:</h1>
                <a href="{{ route('vakTypes.create')}}" class="btn">Niew vaktype</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Vak id</th>
                            <th>Vak type</th>
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- status van alle vakken types tonen en mogelijkheid om te verwijderen, bijwerken -->
                        @foreach ($vakTypes as $index => $vakType)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ ucfirst($vakType->naam)}}</td>
                                <td>
                                    <a href="{{ route('vakTypes.edit', ['id' => $vakType->id]) }}" class="btn">Bijwerken</a>
                                    <form action="{{ route('vakTypes.delete', ['id' => $vakType->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn">Verwijderen</button>
                                    </form>
                                </td>
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
