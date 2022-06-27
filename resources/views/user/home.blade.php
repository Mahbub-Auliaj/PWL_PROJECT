
@extends('user.layouts')

@section('content')
<div class="container">


    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

    </div>

    <section class="content">
    <h2>Welcome, {{$user->name}}</h2>
    </section>               
    
</div>
@endsection

