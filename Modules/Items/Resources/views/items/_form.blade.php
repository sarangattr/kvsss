<div class="row">
    <div class="col-md-5">
        <x-application::textBox label="Name" name="name" placeholder="Name" id="name" autofocus required/>
    </div>
    <div class="col-md-5">
        <x-application::textBox label="Serial No" name="serial_no" placeholder="Serial No" id="serial_no" autofocus required/>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-5">
        <x-application::textBox label="Company" name="company" placeholder="Company Name" id="name" autofocus required/>
    </div>
    <div class="col-md-5">
        <x-application::select2Component label="Location" name="location"   id="location" multiple autofocus required/>
    </div>
    
</div>
<div class="row mt-2">
    <div class="col-md-6">
        @if($method == 'POST')
            <button class="btn btn-md btn-success" type="submit" >Create</button>
        @else
            <button class="btn btn-md btn-success" type="submit" >Update</button>
        @endif
    </div>
</div>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js" ></script>
    <script>
       $('#location').select2({
            placeholder: 'Enter Locations',
            multiple: true,
            tags: true,
       })
    </script>
@endpush