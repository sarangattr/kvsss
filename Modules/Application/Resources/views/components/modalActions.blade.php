<div class="mt-3 text-end">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
    <button id="{{isset($id) ? $id : rand()}}" class="btn btn-{{isset($buttonLayout) ? $buttonLayout : 'primary'}}" type="{{isset($type) ? $type : 'button'}}">{{isset($label) ? $label : 'Button'}}</button>
</div>
