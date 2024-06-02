@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center"> <!--aligner des éléments au centre de la page-->
        <div class="col-md-8"> <!--définir la largeur d'une colonne -->
            <div class="card"> <!--conteneurs rectangulaires-->
                <div class="card-header">{{ __('Confirm Password') }}</div>
                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <div class="row mb-3"> <!--séparer visuellement la ligne des autres contenus sur la page-->
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <!--password ecrite comme ca (mot clé) pour la multilangue-->
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a><!-- la balise a hiya elli tasnaali el lien w classe t5arrajli heki ejomla elli msattra-->
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
