@extends('base')

@section('titre', 'Nouvelle question')

@section('content')
<h1>Ajouter une question</h1>

<form method="POST" action="{{ route('storequestion') }}" class="card">
    @csrf

    <div class="champ">
        <label for="categorie_id">Catégorie</label>
        <select name="categorie_id" id="categorie_id" required>
            @foreach ($categories as $categorie)
                <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                    {{ $categorie->categorie }}
                </option>
            @endforeach
        </select>
        @error('categorie_id')
            <span class="erreur">{{ $message }}</span>
        @enderror
    </div>

    <div class="champ">
        <label for="question">Question</label>
        <input type="text" name="question" id="question" value="{{ old('question') }}" required>
        @error('question')
            <span class="erreur">{{ $message }}</span>
        @enderror
    </div>

    {{-- reponse1 est toujours la bonne réponse : l'API tire 3 mauvaises
         réponses au hasard parmi les neuf autres avant de tout mélanger. --}}
    @foreach (range(1, 10) as $numero)
        <div class="champ">
            <label for="reponse{{ $numero }}">
                Réponse {{ $numero }}@if ($numero === 1) (bonne réponse)@endif
            </label>
            <input type="text" name="reponse{{ $numero }}" id="reponse{{ $numero }}"
                   value="{{ old('reponse' . $numero) }}" required>
            @error('reponse' . $numero)
                <span class="erreur">{{ $message }}</span>
            @enderror
        </div>
    @endforeach

    <button type="submit" class="btn">Ajouter</button>
</form>
@endsection
