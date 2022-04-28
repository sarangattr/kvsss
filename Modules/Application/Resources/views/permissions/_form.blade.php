<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                @include('application::permissions.components.permissions_form')
            </div>
        </div>
    </div>
<div>
@push('script')
    <script src="{{ Module::asset('application:js/app.js') }}"></script>
@endpush