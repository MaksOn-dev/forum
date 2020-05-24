@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <h3 class="card-header">Forum threads</h3>
    
                <div class="card-body">
                   <form action="/threads" method="POST">
                       @csrf
                       <div class="form-group">
                           <label for="title">Title</label>
                           <input type="text" name="title" class="form-control" id="title" placeholder="title" required>
                       </div>

                       <div class="form-group">
                           <label for="body">Body</label>
                           <textarea name="body" id="body" cols="30" rows="10" class="form-control" required></textarea>
                       </div>

                       <button class="btn btn-primary" type="submit">Publish</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
