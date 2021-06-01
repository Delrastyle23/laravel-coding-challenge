@if(session('alert'))
            <div class="container">
                <div class="alert alert-{{ session('alert.context', 'info') }} alert-dismissible fade show" role="alert">
                    @if(session('alert.title'))
                        <strong>{{ session('alert.title') }}</strong>
                    @endif

                    {{ session('alert.message') }}

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
@endif