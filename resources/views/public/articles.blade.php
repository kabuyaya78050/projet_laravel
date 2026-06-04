{{--
    EXERCICE — Questions 1 & 7 : Liste des articles (route articles.index)
    Contenu statique ; les liens vers le détail utilisent route('articles.show', $slug).
--}}
@extends('app')

@section('title', 'Articles — Le Blog')

@section('content')
@foreach ($articles as $article)
    
<div>
    <h2> {{$article->title}}</h2>
    <p> {{$article->category->name}}</p>
    <p> {{$article->created_at->format('d/m/Y')}}</p>

</div>
@endforeach

@endsection
