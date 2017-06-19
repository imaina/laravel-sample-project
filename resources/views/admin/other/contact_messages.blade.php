@extends('layouts.admin-master')

@section('styles')
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('src/css/modal.css')}}">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
@endsection

@section('content')

 <div class="container">
        <section class="list">

        @if(count($contact_messages)==0)
            No Messages
        @endif

            @foreach($contact_messages as $contact_message)

                <article data-message="{{ $contact_message->body }}" data-id= "{{ $contact_message->id}}" class="contact-message">
                    <div class= "message-info">
                        <h3>{{ $contact_message->subject }}</h3>
                        <span>Sender:{{ $contact_message->sender }} | {{ $contact_message->created_at }} </span>
                    </div>

                    <div class="edit">
                        <nav>
                            <ul>
                                <li><a href="#"> Show Message </a></li>
                                <li><a href="#" class="danger"> Delete </a></li>
                            </ul>
                        </nav>

                    </div>
                </article>

            @endforeach
        </section>

   <div class="modal" id="contact-message-info"> 
           <button class="btn" id="modal-close">Close</button>
 </div>   


        @if($contact_messages->lastPage() > 1)
            <section class="pagination">
                @if($contact_messages->currentPage() !== 1)
                    <a href="{{ $contact_messages->previousPageUrl() }}"><i class="fa fa-caret-left"></i></a>
                @endif

                @if($contact_messages->currentPage() !== $categories->lastPage())
                    <a href="{{ $contact_messages->nextPageUrl() }}"><i class="fa fa-caret-right"></i></a>
                @endif
            </section>
        @endif
    </div>

  
@endsection

@section('scripts')
<script type="text/javascript">
	var token = "{{ Session::token() }}";
</script>
<script type="text/javascript" src="{{ URL::asset('src/js/modal.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('src/js/contact_messages.js')}}"></script>
@endsection