@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vérifiez votre adresse e-mail</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
                        </div>
                    @endif

                    Avant de continuer, veuillez vérifier votre e-mail pour un lien de vérification.
                    
                    <form method="POST" action="{{ route('verification.resend') }}" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Renvoyer le lien de vérification
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection