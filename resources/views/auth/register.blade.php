@extends('layouts.auth')

@section('content')

<form action="{{route('register')}}" method="post">
  @csrf
    <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

    <x-errors />

    <div class="form-floating">
        <input name="name" type="type" class="form-control" id="name" placeholder="Fullname">
        <label for="name">Fullname</label>
      </div>

    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="form-floating">
        <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Password Confirmation">
        <label for="password_confirmation">Password Confirmation</label>
      </div>


    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
  </form>

@endsection


