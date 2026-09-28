@extends('base')

@section('titre', 'Connexion')

@section('content')
<h1>Connexion</h1>

<form method="POST" action="{{ route('login.store') }}" class="card">
    @csrf

    <div class="champ">
        <label for="email">Adresse email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <span class="erreur">{{ $message }}</span>
        @enderror
    </div>

    <div class="champ">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required>
        @error('password')
            <span class="erreur">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn">Se connecter</button>
</form>
@endsection
