@if (session()->has('message') || session()->has('error'))
    <div class="alert mt20 {{ session()->has('message') ? 'alert-success' : 'alert-danger' }}" id="alert-message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @if (session()->has('message'))
            <p>{{ session('message') }}</p>
        @endif
        @if (session()->has('error'))
            <p>{{ session('error') }}</p>
        @endif
    </div>
@endif