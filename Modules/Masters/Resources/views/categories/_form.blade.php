<div class="row mt-2">
    <div class="col-md-6">
        <x-application::formLabel name="name" label="Name" required/>
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Category name', 'required', 'maximumLength' => 100, 'minimumLength' => 2]) !!}
        <x-application::validationError name="name" />
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-6">
        <x-application::formLabel name="description" label="Description"/>
        {!! Form::textarea('description',  null, ['class' => 'form-control', 'placeholder' => 'Category Description']) !!}
        <x-application::validationError name="description" />
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-6">
        <x-application::formLabel name="parent_category" label="Parent Category"/>
        <select class="form-control" name="parent_category" id="parent_id">
            <option value="">- None -</option>
            @include('masters::categories._categories-hirearchy', ['categories' => $categories, 'dashes'=> '','id' => isset($result->parent_category) ? $result->parent_category : null])
        </select>
        <x-application::validationError name="parent_category" />
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