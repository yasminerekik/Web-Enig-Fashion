@extends('layout')
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
    .welcome-heading1 {
        font-size: 4.5em;
        color: #0F2649;
        font-weight: bold;
    }
    .emoji-icon {
        font-size: 2em;
        cursor: pointer;
        margin-right: 10px;
    }
</style>
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-1 shadow">
                <div class="card-body p-5" style="background-color: #B0C9CD">
                    <h1 class="welcome-heading1"><center>Place order</center></h1>
                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf
                        <div class="form-group">
                            <label class="welcome-heading2" for="nom">Last name</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label class="welcome-heading2" for="prenom">First name</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                        </div>
                        <div class="form-group">
                            <label class="welcome-heading2" for="adresse">Address</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" required>
                        </div>
                        <div class="form-group">
                            <label class="welcome-heading2" for="contact">Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact" required>
                        </div>
                        <div class="form-group">
                            <label class="welcome-heading2" for="feedback">Feedback</label>
                            <textarea class="form-control" id="feedback" name="feedback" rows="3" placeholder="Give your feedback about our stock!"></textarea>
                        </div>
                        <div class="form-group">
                            <label><pre class="welcome-heading2">Give us ratings : </pre></label>
                            <label class="emoji-icon"><input type="checkbox" name="emoji" value="😞"> 😞</label>
                            <label class="emoji-icon"><input type="checkbox" name="emoji" value="❤️"> ❤️</label>
                            <label class="emoji-icon"><input type="checkbox" name="emoji" value="👍"> 👍</label>
                            <!-- Add more emojis as needed -->
                        </div>
                        <br>
                        <center><button class ="welcome-heading2" type="submit" class="btn btn-primary">Send</button></center>
                    </form>
                    <!-- Message de confirmation qui est définie prés le clé de session qui est 'success' définie dans class store dans OrderController -->
                    @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
