@extends('base')

@section('titre', 'Catégories')

@section('content')
<h1>Catégories</h1>

@forelse ($categories as $categorie)
    @if ($loop->first)<ul class="liste">@endif
        <li>
            {{ $categorie->categorie }}
            <span class="meta">{{ $categorie->questions_count }} question{{ $categorie->questions_count > 1 ? 's' : '' }}</span>
        </li>
    @if ($loop->last)</ul>@endif
@empty
    <p class="vide">Aucune catégorie pour le moment.</p>
@endforelse
@endsection
