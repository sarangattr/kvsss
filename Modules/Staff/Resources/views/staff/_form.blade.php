<div class="row">
    <div class="col-md-4">
        <x-application::textBox label="Name" name="name" placeholder="Name" id="name" autofocus required/>
    </div>
    <!-- <div class="col-md-3">
        <x-application::textBox label="Email" name="email" placeholder="Email" id="email" autofocus required/>
    </div> -->
    <div class="col-md-4">
        <x-application::textBox label="Mobile" name="mobile" placeholder="9XXXXXXXXX" id="name" autofocus required/>
    </div>
    <div class="col-md-4">
        <x-application::passwordBox label="Password" type="password" class="form-control" name="password" placeholder="enter password" id="password" autofocus required/>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-4">
        <x-application::textBox label="LCO CODE" name="lco_code" placeholder="enter id" id="staff_id" autofocus required/>
    </div> 
    <div class="col-md-3">
        <x-application::textBox label="Date of Join" type="date" name="date_of_join" placeholder="select date of joining" id="date_of_join" />
    </div>
    <div class="col-md-4">
        <x-application::appSelectBox label="Staff Role" name="user_type" :options="$usertype" placeholder="Select Staff Type" id="user_type" autofocus required/>
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

