@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" />
@endpush
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                @include('application::roles.components.roles_form')
            </div>
        </div>
    </div>
<div>
@push('script')
    <script src="{{ Module::asset('application:js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js" ></script>
    <script>
        $('#permissions').select2({
            placeholder:"Assign Permissions",
            allowClear: true,
            multiple: true,
            minimumResultsForSearch:0,
        });
    </script>
@endpush