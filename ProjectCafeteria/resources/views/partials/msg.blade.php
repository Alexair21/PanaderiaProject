@if(\Session::get('success'))
    <div class="alert alert-success text-center" style="background: #00362f; color: #fff; border-color: #fefefe">
        <p>{{ Session::get('success') }}</p>
    </div>
@endif
