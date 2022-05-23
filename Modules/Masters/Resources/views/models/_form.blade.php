<div class="row mt-2">
    <div class="col-md-6">
        <x-application::formLabel name="name" label="Name" required />
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Model name', 'required', 'maximumLength' => 100, 'minimumLength' => 2]) !!}
        <x-application::validationError name="name" />
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-6">
        <x-application::formLabel name="model_id" label="Model" required />
        {!! Form::text('model_id',  null, ['class' => 'form-control', 'placeholder' => 'Model ID','required', 'maximumLength' => 100, 'minimumLength' => 2]) !!}
        <x-application::validationError name="model_id" />
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-6">
        <x-application::formLabel name="brand_id" label="Brand" required />
        {!! Form::select('brand_id',  $brands, null,['class' => 'form-control', 'placeholder' => '-Select-']) !!}
        <x-application::validationError name="brand_id" />
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