@extends('layouts.master')

@section('title')
          Blog Index
@endsection

@section('styles')
 <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
@endsection

@section('content')

   @include('includes.info-box')

@foreach( $posts as $post)

   <article class="blog-post">

  	 <h3> {{ $post->title }} </h3>

  	 <span class="subtitle"> {{ $post->author }} |{{ $post->created_at }} </span>

  	 <p> {{ $post->body }}</p>

  	 <a href="{{ route('blog.single', ['end' => 'frontend', 'post_id' => $post->id ])}}"> Read more</a>

   </article>

  @endforeach

  @if($posts->lastPage() > 1)

   <section class="pagination">

       @if($posts->currentPage() !== 1)
          <a href="{{ $posts->previousPageUrl() }}"> <i class="fa fa-caret-left"></i> </a>
       @endif

       @if($posts->currentPage() !== $posts-> lastPage())

           <a href="{{ $posts->nextPageUrl() }}"> <i class="fa fa-caret-right"></i></a>

         @endif  

   </section>

 @endif

@endsection


