@if (session('success'))

    <div class="alert alert-success w-50 mb-4 py-2">
        {{ session('success') }}
    </div>
    
@endif