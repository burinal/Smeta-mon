jQuery(document).ready(function () {

    jQuery('.edit').height(jQuery(window).height() - 40);

    jQuery('form').on('submit', function () {
        var form = jQuery(this);
        var title = form.find('input[name="jform[title]"]').val();
        if (title == '') {
            KMShowMessage(Joomla.JText._('KSR_FORMS_FORM_INVALID_TITLE_LBL'));
            return false;
        }
        form.unbind('submit');
        form.submit();
        return true;
    });

	jQuery('.row-hidden-content .sh').on('click', function(e){
		e.preventDefault();
		
		jQuery(this).closest('.row-hidden-content').toggleClass('active');
	});
	
});