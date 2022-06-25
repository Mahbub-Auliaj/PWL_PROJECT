@extends('layouts')

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
    <a>hello</a>
    </section>               
    
</div>
@endsection
