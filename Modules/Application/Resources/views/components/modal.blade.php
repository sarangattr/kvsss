<?php

$cpId = $id;

?>

<div class="modal fade" id="{{$cpId}}" tabindex="-1" role="dialog" aria-labelledby="{{$cpId}}Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$cpId}}Title">{{isset($title) ? $title : 'Modal name'}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                {{$slot}}
            </div>
        </div>
    </div>
</div>
