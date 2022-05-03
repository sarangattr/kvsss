<div class="row mt-2">
    <div class="col-md-6">
        <x-application::formLabel name="name" label="Name" required />
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Store name', 'required', 'maximumLength' => 100, 'minimumLength' => 2]) !!}
        <x-application::validationError name="name" />
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-6">
        <x-application::appSelectBox label="Store Owner" name="store_owner" :options="$owners" placeholder="select" id="owner" autofocus required/>
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