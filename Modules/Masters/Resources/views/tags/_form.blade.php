<div class="row mt-2">
    <div class="col-md-6">
        <x-application::formLabel name="name" label="Name" required/>
        {!! Form::text('tag', null, ['class' => 'form-control', 'placeholder' => 'Tag name', 'required', 'maximumLength' => 100, 'minimumLength' => 2]) !!}
        <x-application::validationError name="tag" />
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-6">
        <x-application::formLabel name="description" label="Description"/>
        {!! Form::textarea('description',  null, ['class' => 'form-control', 'placeholder' => 'Tag Description']) !!}
        <x-application::validationError name="description" />
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