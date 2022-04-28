<div class="row mt-2">
    <div class="mb-2 col-md-12">
        <x-application::textBox label="Role:" name="name" placeholder="role name"  autofocus required/>
    </div>
</div>               
<div class="row mt-2">
    <div class="mb-2 col-md-12">
        <x-application::select2Component label="Permissions" name="permissions" :options="$permissions" placeholder="Assign Permissions" id="role" required/>
    </div>
</div>
<div class="row mt-2">
    <div class="mb-2 col-md-12">
        <x-application::button label="{{$type}}" type="submit" class="button-next" />
    </div>
</div>