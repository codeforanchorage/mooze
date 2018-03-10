/**
 * Created by Desktop on 3/9/2018.
 */

function selectAll() {
    return $.ajax({
        url: 'https://kyleluoma.com/mooze/php/CRUD/selectAll.php',
        type: 'post',
        data: {},
        dataType: 'json',
        cache: false,
        success: function(json) {
            return json;
        },
        error: function() {
            //TODO: add error handling;
        }
    });
}