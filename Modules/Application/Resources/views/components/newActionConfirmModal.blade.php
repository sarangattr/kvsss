<x-application::modal id="action-confirm-modal-popup" title="Action confirm">
    <div class="row">
        <div class="col-md-12 {{isset($center) ? 'text-center' : ''}}">
            @if(isset($defaultMesage))
                <h4>{{$defaultMesage}}</h4>
            @endif
            @if(isset($description))
                <div>{{$description}}</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <x-application::modalActions id="action-confirm-modal-popup-submit" buttonLayout="{{isset($primaryButtonLayout) ? $primaryButtonLayout : 'primary' }}" label="{{$actionConfirmButtonlabel}}"/>
        </div>
    </div>
</x-application::modal>
@push('script')
    <script>var dataTableReRender = ""; </script>
    @if(isset($reRenderDataTableId))
        <script>dataTableReRender = "{{$reRenderDataTableId}}";</script>
    @endif
    <script>
        $(document).on('click', '{{$actionAttribute}}', function() {
            let href = $(this).data('href');
            $('#action-confirm-modal-popup').modal('show');
            $('#action-confirm-modal-popup-submit').attr('request-href', href);
        })

        $(document).on('click', '#action-confirm-modal-popup-submit', function() {
            appRequest($('#action-confirm-modal-popup-submit').attr('request-href'), '', 'DELETE')
            .then(res => {
                $('#action-confirm-modal-popup').modal('hide');
                $('#action-confirm-modal-popup-submit').attr('request-href', "");
                appNotification('success', 'Action status', 'Successfully deleted');
                setTimeout(location.reload.bind(location),1000);
            })

        })
    </script>
@endpush
