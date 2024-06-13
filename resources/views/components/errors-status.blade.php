@if (session()->has('error'))
    <div class="alert alert-danger">
        <p class="mb-0">{{ session('error') }}</p>
    </div>
@endif