

$(window).ready(function() {

    // @mfiedorowicz: WHY IS IT HERE ?! TO BE CHECKED.

    $(document).on('click', '#add-media, .edit-media', function() {
        return false;
    });

    $('#media-modal').on('show.bs.modal', function (e) {
        var triggerEl = $(e.relatedTarget);
        var url = triggerEl.attr("data-url");
        var title = triggerEl.attr("data-title");
        var modalBody = $(this).find(".modal-body");
        
        $(this).find(".modal-header h3").text(title);

        modalBody.html(modalBody);
        $.ajax(url).done(function(data) {
            modalBody.html(data);
        });
    });

    $(document).on('click', '#media-modal #media-type-buttons a', function() {
    	var id = $(this).attr('id');
    	$('#media-modal #media-type-buttons').hide();
    	if(id == "add-image-button") {
    		$('#media-modal #upload-image-container').show();
    	}
    	else {
    		$('#media-modal #add-video-url-container').show();
    	}
    	return false;
    });

})



