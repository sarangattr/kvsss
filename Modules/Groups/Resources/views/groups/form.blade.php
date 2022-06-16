<div class="row">
    <div class="col-md-4">
        <x-application::textBox label="Cluster Name" name="name" placeholder="Name" id="name" autofocus required/>
    </div>
    <div class="col-md-4">
        <label class="form-label required" >Cluster Lead Sub Distributor</label>
        <select name="lead_id" class="form-control" id="lead-id">
            <option value="" >-Select Lead-</option>
            @foreach($lead as $data)
                @if(isset($result -> id))
                    @if($result -> lead_id != $data -> id)
                    <option value="{{ $data -> id }}">{{ $data -> lco_code }} {{ $data -> name }}</option>
                    @else
                    <option selected value="{{ $data -> id }}">{{ $data -> lco_code }} {{ $data -> name }}</option>
                    @endif
                @else
                    <option value="{{ $data -> id }}">{{ $data -> lco_code }} {{ $data -> name }}</option>
                @endif
            @endforeach
        </select>
        @if ($errors->has('lead_id')) <div class="text-danger">{{ $errors->first('lead_id') }}</div> @endif
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-8">
        <label class="form-label required" >Enter Members Lco Id </label>
        <select name="members[]" class="form-control" id="members" multiple>
            @if(isset($result -> id))
                @foreach($members as $data)
                <option selected="true" value="{{ $data -> lco_code }}">{{ $data -> lco_code }}</option>
                @endforeach
            @endif
        </select>
        @if ($errors->has('members')) <div class="text-danger">{{ $errors->first('members') }}</div> @endif
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
        $(document).ready(function(){
            $('#lead_id').val('');
        })


       $('#members').select2({
            placeholder: 'select LCO',
            multiple: true,
            tags: true,
            class: 'form-control',
       })

       $(document).on('change','#lead-id',function(){
            let subId = $(this).val();
            $('#members').html('');
            appRequest(script_url + '/admin/append-subdis-members', { sub_id: subId}, 'GET')
            .then(res => {
               let obj = res.result;
               let str ='';
               for(let i=0;i<obj.length;i++)
               {
                   str = str +'<option value="'+obj[i].lco_code+'">'+obj[i].lco_code+'</option>';
               }
               $('#members').append(str);

            })
            .catch(er => {
                
            })
       })
    </script>
@endpush