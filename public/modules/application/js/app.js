function pincodeDetails(event, {appendState = "", appendDistrict = "", appendPostOffic = ""}) {
    let errorDisplay = $('#' + event.target.id);
    if(appendState) $(appendState).val("");
    if(appendDistrict) $(appendDistrict).val("");
    if(appendPostOffic) $(appendPostOffic).empty().append('<option value="">- Post office -</option>');
    $('.pincode-error').remove();
    appRequest(script_url + '/application/pincode/' + event.target.value, '', 'GET')
    .then(res => {
        const { state, district, post_office } = res.result;
        if(appendState) $(appendState).val(state);
        if(appendDistrict) $(appendDistrict).val(district);
        if(appendPostOffic)  appendAjaxSelectBox(post_office, appendPostOffic, 'Post office', ['Name', 'Name'])
    })
    .catch(er => {
        let { error, message } = er;
        console.log(er)
        errorDisplay.after(`<div class="pincode-error text-danger">${message}</div>`);
    })
}

$(document).on('click','.change-active-inactive-status',function(){
    //$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
    var a = $(this).data('type');
    console.log(a);
    var url = $(this).data('url');
    appRequest( url,{ id : $(this).data('id') },'GET')
    .then(response => {
        if (response.status === true) {
            appNotification('success',response.message);
            resetDataTable('#' + $(this).closest('table').attr('id'), $(this).data('type'));
        }
    })
    .catch(error => {
        appNotification('success',responseJSON.message);
        resetDataTable('#' + $(this).closest('table').attr('id'), $(this).data('type'));
    })
    
})

function resetDataTable(attr, type) {
    if (type == 'datatable') {
        $(attr).DataTable().draw();
    }
}