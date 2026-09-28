@extends('base')

@section('titre', 'Questions')

@section('content')
<h1>Questions</h1>

@forelse ($questions as $question)
    @if ($loop->first)<ul class="liste">@endif
        <li>
            {{ $question->question }}
            <span class="meta">
                {{ $question->categorie->categorie ?? 'Sans catégorie' }} ·
                bonne réponse : <span class="bonne">{{ $question->reponse1 }}</span>
            </span>
        </li>
    @if ($loop->last)</ul>@endif
@empty
    <p class="vide">Aucune question pour le moment.</p>
@endforelse
@endsection
