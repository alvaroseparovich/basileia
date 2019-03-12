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
                        var gallery_urls = new Array();
                        var my_index = 0;
                        selection.each(function(attachment) {
                           gallery_ids[my_index] = attachment['id'];
                           gallery_urls[my_index] = attachment.attributes.url;
                           my_index++;
                        });
                        var ids = gallery_ids.join(",");
                        var urls = gallery_urls.join(",");
                        jQuery('input.caixa_com_id').val(ids);
                        jQuery('img#attribute-preview-image').attr("src",urls);
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

   //Return URL of Iten selected on gallery
   jQuery('button.custom_media_upload').click(function(e) {

    e.preventDefault();
    console.log(e.currentTarget.id);

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
                    gallery_ids[my_index] = attachment.attributes.url;
                    my_index++;
                 });
                 var Urls = gallery_ids.join(",");
                 jQuery('input#'+ e.currentTarget.id ).val(Urls);
                 jQuery('img#'+ e.currentTarget.id ).attr("src",Urls);
                 Refresh_Image(Urls);
              });

             image_frame.on('open',function() {
               // On open, get the id from the hidden input
               // and select the appropiate images in the media manager
               var selection =  image_frame.state().get('selection');
              var ids = Array( jQuery('input#'+ e.currentTarget.id ).val());
              

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
              jQuery('.caixa_com_id').replaceWith( response.data.image );
          }
      });
}

