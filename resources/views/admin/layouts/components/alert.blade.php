@if (session('error'))
    <div class="alert alert-danger">
        <strong>[Fail] {{ session('error') }}</strong>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        <strong>[Success] {{ session('success') }}</strong>
    </div>
@endif
