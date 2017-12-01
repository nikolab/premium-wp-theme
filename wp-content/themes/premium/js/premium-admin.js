jQuery(document).ready(function ($)  {

var mediaUploader;

    $( '#upload-button' ).click(function(e){
        e.preventDefault();
        if( mediaUploader ) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Upload a Profile picture',
            button: {
                text: 'Choose Picture'
            },
            multiple: false
        });

        mediaUploader.on('select', function () {
            attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#profile-picture').val(attachment.url);
            $('#profile-picture-preview').css('background-image', 'url(' + attachment.url + ')');
        });

        mediaUploader.open();

    });

    $('#remove-picture').on('click',function(e){
        e.preventDefault();
        var answer = confirm("Are you sure you want to remove your Profile Picture?");
        if( answer == true ){
            $('#profile-picture').val('');
            $('.premium-general-form').submit();
        }
        return;
    });

});