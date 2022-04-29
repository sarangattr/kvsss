<?php

    $activeClass = "btn btn-primary waves-effect ";
    $activeStyle = "color: white !important;text-align: left";

?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="inbox-leftbar">
                    <div class="d-grid">
                        <a href="{{$submitUrl}}" type="button" class="btn btn-danger waves-effect waves-light">
                            <i class="mdi mdi-plus-circle me-1"></i>Add {{isset($title) ? $title : ''}}
                        </a>
                    </div>
                    <div class="mail-list mt-4">
                        <a href="{{route('categories.index')}}" class="{{$title=='Category' ? $activeClass : ''}}" style="{{ $title=='Category' ? $activeStyle : '' }}">Categories</a>
                        <hr style="margin: 0;">
                        <a href="{{route('brands.index')}}" class="{{$title=='Brands' ? $activeClass : ''}}" style="{{$title=='Brands' ? $activeStyle : ''}}">Brands</a>
                        <hr style="margin: 0;">
                    </div>
                </div>
                <div class="inbox-rightbar">
                    {{$slot}}
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).on('click', '#{{$actionButtonId}}', function() {
            $('#{{$modalId}} [type=submit]').text('Submit');
            $('#{{$modalId}}').modal('show');
            let create = $('#{{$modalId}} form').data('create');
            $('#{{$modalId}} form').attr('action', create).attr('method', 'POST');
            $('#{{$modalId}} input, #{{$modalId}} select, #{{$modalId}} textarea').val('');
            $('#append-script-form-method-type').remove();
            let csrf = $('meta[name="csrf-token"]').attr('content');
            $('#append-script-form-method-token').remove();
            $('#{{$modalId}} form [name=_token]').val(csrf)
        })

        $(document).on('click', '.edit-data-table-data', function() {
            let href = $(this).data('href');
            let update = $(this).data('update');
            $('#{{$modalId}} [type=submit]').text('Update');
            $('#{{$modalId}} form').attr('action', update);
            $('#{{$modalId}} form').append('<input id="append-script-form-method-type" type="hidden" name="_method" value="PUT" />')
            // alert('#{{$modalId}} form')
            appRequest(href, '', 'GET')
            .then(res => {
                $('#{{$modalId}}').modal('show');
                // $('#{{$modalId}} input').val('show');
                let key = Object.keys(res.result)
                for (let i = 0; i < key.length; i++) {
                    const element = key[i];
                    $('#{{$modalId}} input[name='+element+']').val(res.result[element])
                }
            })
        });
    </script>
@endpush
