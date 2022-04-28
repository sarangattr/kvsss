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