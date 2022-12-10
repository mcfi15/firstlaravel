@if (session()->has('success'))
    <div class="alert alert-success text-center">
        {{ session()->pull('success') }}
    </div>
@endif
