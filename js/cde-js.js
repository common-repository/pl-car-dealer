jQuery(document).ready( function() {

	jQuery("a[rel=gallery]").colorbox({slideshow:true, scalePhotos: true, maxHeight: "80%", maxWidth: "100%"});

	    /* initiate plugin */
   jQuery("div.holder").jPages({
      containerID: "cde_jpag",
      perPage : 10
    });

});