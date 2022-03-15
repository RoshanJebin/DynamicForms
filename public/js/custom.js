var BASE_URL = $('meta[name="base-url"]').attr('content');
$(document).ready(function () {
    $('#dataTable').DataTable();
});

function check_html_field(id) {
    if ($('#html_field' + id).val() == 'select') {
        $('#custom_value' + id).show();
    } else {
        $('#custom_value' + id).hide();
    }
}

function addField() {
    var SlRow = $('#SlRowField').val();
    var NewSl = parseInt(SlRow) + 1;
    $('#SlRowField').val(NewSl);

    var Appenddata = '<tr id="rowField' + NewSl + '">\n' +
        '<td><input type="text" class="form-control" name="label[]" required></td>\n' +
        '<td><select name="html_field[]" class="form-control" onchange="check_html_field(' + NewSl + ')" id="html_field' + NewSl + '">\n' +
        '<option value="text">Text</option>\n' +
        '<option value="number">Number</option>\n' +
        '<option value="select">Select</option>\n' +
        '</select></td>\n' +
        '<td><textarea rows="1" class="form-control" id="custom_value' + NewSl + '" name="custom_value[]" style="display:none;"></textarea></td>\n' +
        '<td><button type="button" class="btn btn-danger btn-sm" onclick="DeleteRow(' + NewSl + ')" ><i class="fa fa-trash"></i></button></td>\n' +
        '<input type="hidden" name="field_id[]" value="">\n' +
        '</tr>';
    $.getScript(BASE_URL + "/js/custom.js");
    // check_html_field(' + NewSl + ');
    $('#appendField').append(Appenddata);
}

function DeleteRow(id) {
    $('#rowField' + id).remove();
}


function deleteField(id) {
    url = BASE_URL + '/field/delete/' + id;
    $('#link').attr('href', url);
    $('#confirmationPopup').modal('show');

}
function deleteForm(id) {
    url = BASE_URL + '/forms/delete/' + id;
    $('#link').attr('href', url);
    $('#confirmationPopup').modal('show');

}