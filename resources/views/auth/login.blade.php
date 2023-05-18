<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
</head>
<body>
  <form action="{{ route('login') }}" id="form-login" method="POST">
    @csrf
    <fieldset>
        <label for="email">Correo</label>
        <input type="email" name="email" id="email" placeholder="email@email.com" tabindex="1" class="@error('email') is-invalid @enderror" value="{{old('email')}}"/>
        @error('email')
          <span class="invalid-feedback badge alert-danger" role="alert">
            <strong style="color: #dc3545;">{{ $message }}</strong>
          </span>
        @enderror
        <br>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="********" tabindex="2" class="@error('password') is-invalid @enderror" value="{{old('password')}}"/>
        @error('password')
          <span class="invalid-feedback badge alert-danger" role="alert">
            <strong style="color: #dc3545;">{{ $message }}</strong>
          </span>
        @enderror
    </fieldset>
    <input type="submit" value="Enter" style="width: 150px;" tabindex="3"/>
  </form>
</body>
</html>

