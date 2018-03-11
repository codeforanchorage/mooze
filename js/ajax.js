/**
 * Created by Desktop on 3/9/2018.
 */

    
function selectAll() {
    var moose_data = document.getElementById("moose_data");
    $.ajax({
        url: 'https://kyleluoma.com/mooze/php/CRUD/selectAll.php',
        type: 'post',
        data: {},
        dataType: 'json',
        cache: false,
        success: function (json) {
            moose_data.innerHTML = JSON.stringify(json);
        },
        error: function () {
            //TODO: add error handling;
        }
    });
}