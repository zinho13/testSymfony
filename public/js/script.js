$(document).ready(function() {

    $(document).on('change', '#selectForm', function(){
        var value = $(this).val();
        console.log(value);

        if (value == 'societe') {
            $('#formSocieteContent').removeClass('hide');
            $('#formDirigeantContent').addClass('hide');
        } else if(value == 'dirigeant') {
            $('#formDirigeantContent').removeClass('hide');
            $('#formSocieteContent').addClass('hide');
        } else {
            $('#formSocieteContent').addClass('hide');
            $('#formDirigeantContent').addClass('hide');
        }
    });

    $(document).on('change', '#societe_code_postal', function(){
        var value = $(this).val();
        var baseUrl = $('#baseUrl').val();
        console.log(baseUrl);

        $.ajax({
            type: "post",
            url: baseUrl+"ville/findVilleCode/"+value,

            success: function(data) {
                console.log(data);
                $('.kl_ville').html(data);
            
            }
        });
    });

    $(document).on('click', '.btn-abort', function(){
        $('#selectForm').val(0).change();
        $('#formSocieteContent').addClass('hide');
        $('#formDirigeantContent').addClass('hide');
    });

    $(document).on('click', '.btn-save-s', function(){
        var baseUrl = $('#baseUrl').val();

        var dataField = {
            nom : $('#nom_société').val(),
            description : $('#description').val(),
            type : $('#type').val(),
            code_postal : $('#code_postal').val(),
            ville : $('#ville').val()
        };
        console.log(dataField);

        // $.ajax({
        //     type: "post",
        //     url: baseUrl + "home",
        //     data: dataField,

        //     success: function(data) {
        //       console.log(data);
            
        //     }
        // });
    });

});
