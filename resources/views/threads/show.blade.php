@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <h2 class="card-header">
                    <a href="/profiles/{{ $thread->creator->id }}">
                        {{ $thread->creator->name }}
                    </a> posted: {{ $thread->title }}
                </h2>
    
                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>
        </div>
    </div>

    
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            @if(auth()->check())
                <form method="POST" action="{{ $thread->path('replies') }}">
                    @csrf
                    <textarea name="body" id="body" class="form-control" placeholder="Have something to say?"></textarea>

                    <button type="submit" class="btn btn-primary mt-3">Post</button>
                </form>
            @else
                <p class="text-center">Please, <a href="{{ route('login') }}">sign in </a>to leave a reply</p>
            @endif
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <hr>
            @foreach($thread->replies as $reply)
                @include('threads.reply')
            @endforeach
        </div>
    </div>


</div>
@endsection
