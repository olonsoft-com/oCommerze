<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Chaad Raat Mela</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <style>
        body {
            background-image: url('/assets/images/Islamic-Mosque-Backgrounds.jpg');
            background-color: #cccccc;
            background-size: cover;
        }
    </style>
</head>
<body>
<div class="container">
    <form method="POST" action="{{ route('guest.user.otp') }}" class="form-signin">
        @csrf


        @if(session('errors'))
            <div class="alert alert-success">
                {{ session('errors') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="h3 mb-3 font-weight-normal">user confirmation form</h1>
        <div class="form-group">
            <label for="user_otp_verify" class="sr-only">Confirmation code</label>
            <input type="text" name="user_otp_verify" id="user_otp_verify" class="form-control" pattern="^[0-9]{4}$" placeholder="code: (5555)" required autofocus>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
        <p class="mt-5 mb-3 text-muted">&copy; Chad Rat Mela</p>
    </form>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>