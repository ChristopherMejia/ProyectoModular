@extends('layouts.app')
@section('content')
<div class="main-container">
    <div class="row justify-content-center">
        <div class=" col-md-12">
            <div class="card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                <div class="card-header header-table"><h4>Formulario de Usuarios<h4></div>
                <div class="card-body">

                <form action="" method="post">
                    
                </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection