/**
 * Selects all sighting tuples from database
 * Returns string of JSON file using JSON.stringify
 */

    
function selectAll() {
    var mooseData = document.getElementById("mooseData");
    $.ajax({
        url: 'https://kyleluoma.com/mooze/php/CRUD/selectAll.php',
        type: 'post',
        data: {},
        dataType: 'json',
        cache: false,
        success: function (json) {
            mooseData.innerHTML = JSON.stringify(json);
        },
        error: function () {
            //TODO: add error handling;
        }
    });
}