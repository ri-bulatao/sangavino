@if (Route::is('login') || Route::is('register'))

    @if (session('success') || session('warning') || session('error'))
        <div class="alert @if (session('success')) alert-success @endif @if (session('warning')) alert-warning @endif @if (session('error')) alert-danger @endif  alert-dismissible fade show p-3"
            role="alert">
            {{ session('success') ?? session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert bg-danger alert-dismissible fade show p-3" role="alert"">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
@else
    @if (session('success') || session('warning') || session('error'))
        <div class="alert @if (session('success')) alert-success @endif @if (session('warning')) alert-warning @endif @if (session('error')) alert-danger @endif  alert-dismissible fade show p-3"
            role="alert">
            {{ session('success') ?? session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show p-3" role="alert"">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


@endif
