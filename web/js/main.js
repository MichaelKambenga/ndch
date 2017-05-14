
$(function () {
    $('#btnApproveRecords').click(function () {
        $('#modalApproveRecords').modal('show')
                .find('#modalApproveRecordsContent')
                .load($(this).attr('value'));
    });
});

//FOR DATA SOURCE SETUP
$(document).ready(function () {
    source_type = $('#datasources-datasourcetype').val();
    if (source_type == 1) {  //file based data source
        $('#awsvendor, #datalocation').show()
    } else {
        $('#awsvendor, #datalocation').hide();
        $('#awsvendor #datasources-awsvendor, #datalocation #datasources-datalocation').val(null);
    }
//when  data source changes
    $('#datasources-datasourcetype').change(function () {
        source_type = $('#datasources-datasourcetype').val();
        if (source_type == 1) {  //file based data source
            $('#awsvendor, #datalocation').show()
        } else {
            $('#awsvendor, #datalocation').hide();
            $('#awsvendor #datasources-awsvendor, #datalocation #datasources-datalocation').val(null);
        }
    });
});

//FOR   USER CREATION
$(document).ready(function () {
    user_role = $('#user-user_role').val();
    if (user_role.indexOf('Station') > -1) {  //file based data source
        $('#user-station, #user-stationid').show()
    } else {
        $('#user-station, #user-stationid').hide();
    }
//when  role changes
    $('#user-user_role').change(function () {
        user_role = $('#user-user_role').val();
        if (user_role.indexOf('Station') > -1) {  //file based data source
            $('#user-station, #user-stationid').show()
        } else {
            $('#user-station, #user-stationid').hide();
        }
    });
});

