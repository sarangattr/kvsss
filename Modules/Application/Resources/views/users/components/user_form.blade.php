@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" />
@endpush

<div class="row mt-2">
    <div class="mb-2 col-md-6">
        <x-application::textBox label="User Name:" name="name" placeholder="user name"  autofocus required/>
    </div>
</div>
<div class="row mt-2">
    <div class="mb-2 col-md-6">
        <x-application::textBox label="Email:" name="email" type="email" placeholder="email address"  autofocus required/>
    </div>
</div>

<div class="row mt-2">
    <div class="mb-2 col-md-6">
        <label class="required form-label" for="Password">Password:</label>
        <input type="password" class="form-control" name="password" placeholder="Enter password" >
        @if ($errors->has('password')) <div class="text-danger">{{ $errors->first('password') }}</div> @endif
    </div>
</div>

<div class="row mt-2">
    <div class="mb-2 col-md-6">
        <label class="required form-label" for="Password">Re-Enter Password:</label>
        <input type="password" class="form-control" name="password_confirmation" placeholder="Enter password">
        @if ($errors->has('password_confirmation')) <div class="text-danger">{{ $errors->first('password_confirmation') }}</div> @endif
    </div>
</div>

<div class="row mt-2">
    <div class="mb-2 col-md-6">
        <x-application::textBox label="Phone" name="mobile" placeholder="95X0X0XXXX" class="number-only" maxlength="10" required/> 
    </div>
</div>

<div class="row mt-2">
    <div class="mb-2 col-md-6">
        <x-application::appSelectBox label="Role:" name="role" :options="$role" placeholder="role" required/>
    </div>
</div>
   
<div class="row mt-2">
    <div class="mb-2 col-md-6">
        <x-application::button label="{{$type}}" type="submit" class="button-next" />
    </div>
</div>

@push('script')
    <script src="{{ Module::asset('application:js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js" ></script>
    <script type="text/javascript">
        $('#role').select2({
            placeholder:"select role",
            allowClear: true,
        });
    </script>
@endpush