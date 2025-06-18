<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product categoriëen</title>
    </head>
    <body>
        @include('components.header')
        <main>
        <section>
            <h1>Product categoriëen lijst:</h1>
            <a href="{{ route('productCategorie.create')}}" class="btn">Nieuwe categorie</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>categorie id</th>
                        <th>Categorie naam</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- alle categoriëen tonen -->
                    @foreach ($categorieen as $index => $categorie)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ ucfirst($categorie->naam)}}</td>
                            <td>
                                <a href="{{ route('productCategorie.edit', ['id' => $categorie->id]) }}" class="btn">Bijwerken</a>
                                <form action="{{ route('productCategorie.delete', ['id' => $categorie->id])}}" method="POST">
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
