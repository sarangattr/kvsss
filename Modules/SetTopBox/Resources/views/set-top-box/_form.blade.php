
<p class="sub-header" style="padding-bottom:10px;">
Set Top Box Information
</p>
<div class="row">
    <div class="col-md-4">
        <x-application::textBox label="Lco code" name="lco_id" placeholder="enter lco id" id="lco_id" autofocus required/>
    </div>
    <div class="col-md-4">
        <x-application::textBox label="Serial No." name="serial_no" placeholder="Serial No" class="number-only" required/>
    </div>
    <div class="col-md-4">
        <x-application::textBox label="VC Number." name="vc_no" placeholder="VC No" class="number-only" required/>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-3">
        <x-application::appSelectBox label="Conditional Access System" name="cas" :options="$casdropdown" placeholder="-select-" id="cas" autofocus required/>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('model','Select Model' , ['class' => 'required form-label']) !!}
            <select name = "model" id="model-id" class="form-control">
                <option value="">-Select-</option>
                @foreach($modeldropdown as $data)
                    @if(isset($result -> model))
                        @if($result -> model == $data -> name )
                            <option selected=true >{{ $data -> name }}</option>
                        @else
                            <option>{{ $data -> name }}</option>
                        @endif
                    @else
                        <option>{{ $data -> name }}</option>
                    @endif
                @endforeach
            </select>
            @if ($errors->has('model')) <div class="text-danger">{{ $errors->first('model') }}</div> @endif
        </div>
    </div>
    <div class="col-md-3">
        <x-application::appSelectBox label="STB Type" name="stb_type" :options="$stbdropdown" placeholder="-select-" id="stb_type" autofocus required/>
    </div>
    <div class="col-md-3">
        <x-application::appSelectBox label="Status" name="stb_status" :options="['Active'=>'Active','Deactive'=>'Deactive']" placeholder="select" required/>
    </div>
</div> 
<div class="row mt-2">
    <div class="col-md-4">
        <x-application::appSelectBox label="Supplier" name="supplier" :options="$supplier" placeholder="select" id="supplier" autofocus required/> 
    </div>
    <div class="col-md-4">
        <x-application::textBox label="Batch No" name="batch" placeholder="Enter Batch Number" required/>
    </div>
    <div class="col-md-4">
        <x-application::appDatePicker label="Assigned Date" name="assign_date" placeholder="select assigned date" id="assigndate" required/>
    </div>
    
</div>
<div class="row mt-2">
    
</div>

<div class="mt-4">
    <div class="float-end">
        @if($method == 'POST')
            <button class="btn btn-md btn-success" type="submit" >Create</button>
        @else
            <button class="btn btn-md btn-success" type="submit" >Update</button>
        @endif
    </div>
</div>
<!-- </div> -->
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js" ></script>
    <script>
       $('#lco-id').select2({
            placeholder: 'select LCO/Sub Dis/Dis',
            multiple: false,
            class: 'form-control',
       })
       $('#cas').select2({
            placeholder: 'select CAS',
            multiple: false,
            class: 'form-control',
       })
       $('#model-id').select2({
            placeholder: 'select STB Model',
            multiple: false,
            class: 'form-control',
       })
       $('#stb_type').select2({
            placeholder: 'select STB Type',
            multiple: false,
            class: 'form-control',
       })
    </script>
@endpush