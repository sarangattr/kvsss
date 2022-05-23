<div class="row">
    <div class="col-md-6">
        <x-application::textBox label="Use" name="use" placeholder="Use" id="use" autofocus required/>
    </div> 
    <div class="col-md-6">
        <x-application::textBox label="Number" name="number" placeholder="Number" id="number" autofocus required/>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-4">
        <x-application::appSelectBox label="Model" name="model_no" :options="$models" placeholder="Model Number" id="model_no" autofocus required/>
    </div>
    <div class="col-md-4">
        <x-application::textBox label="Comment" name="komment" placeholder="Comment" id="comment" autofocus/>
    </div>
    <div class="col-md-4">
        <x-application::select2Component label="Location" name="location_no"   id="location_no" multiple autofocus required/>
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
       $('#location_no').select2({
            placeholder: 'Enter Locations',
            multiple: true,
            tags: true,
       })
    </script>
@endpush