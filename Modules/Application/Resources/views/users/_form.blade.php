<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">{{$type}} User</div>
            <div class="card-body">
                @include('application::users.components.user_form')
            </div>
        </div>
    </div>
<div>
@push('script')
    <script src="{{ Module::asset('application:js/app.js') }}"></script>
@endpush