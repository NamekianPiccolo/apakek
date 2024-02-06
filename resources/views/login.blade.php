<!DOCTYPE html>
<html lang="id">
<head>
  <title>Form Login Bootstrap</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
  @if (session()->has(['key' => 'customer']))
      {{ redirect()->route('customer.index') }}
  @endif
    <div class="row justify-content-center">
        <div class="col-md-5" >

          @if(session()->has('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
         
            <main class="form-signin">
                <h1 class="h3 mb-3 fw-normal text-center">Login</h1>
              
                  
        <form action="/login" method="post">
          @csrf
              <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror " name="email" id="email" placeholder="Email" autofocus value="{{ old('email') }}">
                <label for="Email">Email</label>
              @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
                  
              @enderror
              </div>
                  <div class="form-floating">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                    <label for="password">Password</label>
            @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
                  
              @enderror
                  </div>
              
                 
                  <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                  
                </form>
                <small class="d-block text-center mt-3">Not Registered <a href="/register">Register Now</a> </small>
              </main>
        </div>
    </div>
</body>
</html>