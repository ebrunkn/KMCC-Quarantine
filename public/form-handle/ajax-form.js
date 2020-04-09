$(document).ready(function(){

    function showErrors(result){
        if( result.errors ){
            // console.log( result.errors );
            // Looping through each validation error response
            $.each(result.errors, function(general_key, general_value){
                /*==========
                In whole project field name is diffrerent (data['period'] , period etc) .
                Below lines just finding out the errored field on DOM
                =============*/
                console.log(`${general_key } - ${general_value}`);
                $targetField = $('[name="'+general_key+'"');
                // if(!$targetField.length){
                //     $targetField = $('[name="'+general_key+'"');
                // }
                // console.log(result.errors);

                /*==========
                Adding class for field for invalid highlight
                =============*/
                $targetField.addClass('is-invalid');
                $('#form-error-'+general_key).addClass('d-inline').html(general_value);
                if($targetField.length){
                    $('.nav-tabs').find('.nav-item a[href="#myconcierge_canned_general_tab_content"]').addClass('tab_has_error');
                }
            });
            // if(result.errors.hasOwnProperty('ml')){
            //     $.each(result.errors.ml, function(key, value) {
            //         $('.nav-tabs').find('.nav-item a[href="#myconcierge_form_language_tab_ml-'+key+'"]').addClass('tab_has_error');
            //         $.each(value, function(field, field_value){
            //             $targetField = $('[name="data[ml]['+key+']['+field+']"]');
            //             $targetField.addClass('is-invalid');
            //             $('#form-error-ml_'+key+'_'+field).html(field_value);
            //         });
            //     });
            // };
        }
    };


    function showAlert(type, message){
        $('#activity-message-alert').removeClass('alert-success alert-danger alert-warning d-none')
            .addClass('alert-'+type).find('.alert-text').html(message);
            if(type==='success'){
                $('#activity-message-alert').find('.alert-icon').html('<i class="flaticon2-check-mark"></i>');
            }else if(type==='warning'){
                $('#activity-message-alert').find('.alert-icon').html('<i class="flaticon-warning"></i>');
            }else{
                $('#activity-message-alert').find('.alert-icon').html('<i class="flaticon2-information"></i>');
            }
    }

    function formSave(form, url, callback){

        $('#activity-message-alert').removeClass('alert-success alert-danger alert-warning').addClass('d-none');
        form.find('.invalid-feedback').removeClass('d-inline').html('');
        form.find('.is-invalid').removeClass('is-invalid');
        $('.tab_has_error').removeClass('tab_has_error');

        // const editorData = editor.getData();
        // var content = $( 'textarea.html_editor' ).val();
        // console.log(content);

        sendData =  form.serializeArray();
        // var token = $('input[name="_token"]').val();
        // sendData.push({'name':'_token', value:token});

        // console.log($('input[name="_token"]').val());
        console.log(sendData);
        // return false;
        // showAlert('warning', 'core.loading.saving');
        var bactToUrl;

        if(callback){
            bactToUrl = callback;
        }else{
            bactToUrl = url;
        }

        $.ajax({
            type: "POST",
            url: url,
            data: sendData, // serializes the form's elements.
            dataType: 'json',
            success: function(result)
            {
                // console.log(result); // show response from the php script.
                if( result.status == 'OK' ) {
                    // showAlert('success', 'core.loading.saved');
                    // toastr.success('Saved');
                    window.location.href = bactToUrl;
                    
                }
                else if ( result.status == 'INVALID_DATA' ) {
                    // console.log(result);
                    // showAlert('danger', $trans.get( 'core.loading.invalid_data' ));
                    toastr.error('Error. Inavlid Data...!', 'Validation Error!')
                    showErrors(result);
                }
                else {
                    toastr.error('Something went wrong!', 'Error!')
                    showAlert('danger', 'Error');
                    // toastr.error($trans.get( 'core.loading.error' ));
                    console.log( result );
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                // console.log(url);
                // console.log(sendData);
                // console.log(XMLHttpRequest);
                // console.log(textStatus);
                console.error(errorThrown);
                // showAlert('danger', 'core.loading.error');
                // toastr.error($trans.get( 'core.loading.error' ));
                // showAlert('danger', 'Error');
             }
          });
    }

    $('.form').on('submit', function(e){
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var callback = form.attr('callback') ? form.attr('callback'): url;
        formSave(form, url, callback)
    });

    // ===========================Delete Items=============================



});
