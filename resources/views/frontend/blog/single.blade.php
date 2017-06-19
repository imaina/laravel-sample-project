@extends('layouts.master')

@section('title')
       {{ $post->title }}
@endsection

@section('content')
 <article>
 	<h2>{{ $post->title }}</h2>
 	<span class="subtitle">{{ $post->author }} | {{ $post->created_at }}</span>
 	<p>{{ $post->body }} </p>

 </article>

@endsection