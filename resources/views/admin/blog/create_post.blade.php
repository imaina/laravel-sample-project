@extends('layouts.admin-master')

@section('styles')
 <link rel="stylesheet" type="text/css" href="{{ URL::asset('src/css/form.css') }}">
@endsection

@section('content')

 <div class="container">
 	  @include('includes.info-box')

   	<form action="{{ route('admin.blog.post.create') }}" method="post">

 	   <div class="input-group">
 	      <label for="title"> Title </label>
 	      <input type="text" name="title" id="title" value="{{ Request::old('title') }}" {{ $errors->has('title') ? 'class=has-error' : '' }} >
 	   </div>

 	   <div class="input-group">
 	      <label for="author"> Author </label>
 	      <input type="text" name="author" id="author" value="{{ Request::old('author') }}" {{ $errors->has('author') ? 'class=has-error' : '' }} >
 	   </div>

 	   <div class="input-group">

 	      <label for="category_select"> Add categories</label>

 	      <select name="category_select" id="category_select">
 	      	
 	      	    @foreach ($categories as $category)

 	      	    <option value="{{ $category->id }}" > {{ $category->name }} </option>

 	      	    @endforeach 

 	      </select>	    

 	       <button type="button" class="btn" >Add Category </button>
 	      
 	      	<div class="added-categories">
 	      	     <ul> </ul>	
 	      	</div>
 	      	<input type="hidden" name="categories" id="categories"> 
 	   </div>

 	   <div class="input-group">
 	      <label for="body"> Body </label>
 	     <textarea name="body" id="body" rows="12" value="{{ Request::old('body') }}" {{ $errors->has('body') ? 'class=has-error' : '' }} > </textarea>
 	   </div>

 	   <button type="submit" class="btn">Create Post </button>
 	   <input type="hidden" name="_token" value="{{ Session::token() }}">
 		
 	</form>
 </div>

@endsection

@section('scripts')
 <script type="text/javascript" src="{{ URL::asset('src/js/posts.js') }}"></script>
@endsection
