Notify = function(text, callback, close_callback, style) {

	var time = '10000';
	var jQuerycontainer = jQuery('#notifications');
	var icon = '<i class="fa fa-info-circle "></i>';

	if (typeof style == 'undefined' ) style = 'warning'

	var html = jQuery('<div class="alert alert-' + style + '  hide">' + icon +  " " + text + '</div>');

	jQuery('<a>',{
		text: '×',
		class: 'button close',
		style: 'padding-left: 10px;',
		href: '#',
		click: function(e){
			e.preventDefault()
			close_callback && close_callback()
			remove_notice()
		}
	}).prependTo(html)

	jQuerycontainer.prepend(html)
	html.removeClass('hide').hide().fadeIn('slow')

	function remove_notice() {
		html.stop().fadeOut('slow').remove()
	}

	var timer =  setInterval(remove_notice, time);

	jQuery(html).hover(function(){
		clearInterval(timer);
	}, function(){
		timer = setInterval(remove_notice, time);
	});

	html.on('click', function () {
		clearInterval(timer)
		callback && callback()
		remove_notice()
	});


}
/*Url from where we downloaded the plugin*/
/*https://github.com/msroot/Notify.js/ */
