jQuery(document).ready( function($) {

    jQuery('input#media_manager_btn').click(function(e) {

           e.preventDefault();
           var image_frame;
           if(image_frame){
               image_frame.open();
           }
           // Define image_frame as wp.media object
           image_frame = wp.media({
                         title: 'Select Media',
                         multiple : false,
                         library : {
                              type : 'image',
                          }
                     });

                     image_frame.on('close',function() {
                        // On close, get selections and save to the hidden input
                        // plus other AJAX stuff to refresh the image preview
                        var selection =  image_frame.state().get('selection');
                        var gallery_ids = new Array();
                        var my_index = 0;
                        selection.each(function(attachment) {
                           gallery_ids[my_index] = attachment['id'];
                           my_index++;
                        });
                        var ids = gallery_ids.join(",");
                        jQuery('input.caixa_com_id').val(ids);
                        Refresh_Image(ids);
                     });

                    image_frame.on('open',function() {
                      // On open, get the id from the hidden input
                      // and select the appropiate images in the media manager
                      var selection =  image_frame.state().get('selection');
                      var ids = Array( jQuery('input.caixa_com_id').val());

                      ids.forEach(function(id) {
                        var attachment = wp.media.attachment(id);
                        attachment.fetch();
                        selection.add( attachment ? [ attachment ] : [] );
                      });

                    });

                  image_frame.open();
   });

});

// Ajax request to refresh the image preview
function Refresh_Image(the_id){
      var data = {
          action: 'get_brand_image',
          id: the_id
      };

      jQuery.get(ajaxurl, data, function(response) {

          if(response.success === true) {
            console.log("FOI");
              jQuery('.caixa_com_id').replaceWith( response.data.image );
          }
      });
}