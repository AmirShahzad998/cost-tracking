@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endforeach
@endif


