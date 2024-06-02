@extends('layout')

@section('content')
<style>
    .welcome-heading2 {
            font-size: 1.25em;
            color: #0F2649;
            font-weight: bold;
        }
        .welcome-heading3 {
            font-size: 3em;
            color: #0F2649;
            font-weight: bold;
        }
        
        </style>

<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-8" >
            <div class="card border-1 shadow">
                <div class="card-body p-5" style = "background-color: #B0C9CD">
                    <h1 class="card-title text-center mb-5 welcome-heading3">Contact us</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li> <!--liste d'erreurs--> 
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="post" action="{{ route('contact.submit') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label class = "welcome-heading2" for="nom">Name :</label>
                            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label class = "welcome-heading2" for="email">E-mail :</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label class = "welcome-heading2" for="message">Message :</label>
                            <textarea name="message" id="message" class="form-control">{{ old('message') }}</textarea>
                        </div>
                        <div class="form-group text-center">
                            <button class = "welcome-heading2" type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
