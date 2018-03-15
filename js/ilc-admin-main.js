(function($) {
	"use strict";
	var ilcObj = {
		
		icl_admin_media_lib_config_url:function(){
			var _config_link = $('.ilc_custom_field_link');
			
			if( _config_link.length === 0 ) return;
			_config_link.on('click', function(e){
				e.preventDefault();
				alert("Hello world!");
			});
		},
		/*Ajax URL and Data*/
		ilc_post:function(action, data){
			data = {
					'action': 'ilc_'+action,
					'data': data
				};
			return $.post(the_ajax_script.ajaxurl, data );
		},
		ilc_save_checkbox:function(){
			$("input[type='checkbox']").each(function(){
				$(this).on('change',function() {
					var _this = $(this);
					var _is_checked = _this.prop('checked');
					var data = {};
					data.value = _is_checked;
					data.id = _this.data('id');
					ilcObj.ilc_post( 'save_checkbox', data ).done( function(data){
						data = $.parseJSON(data);
						if( data == 'false'){
							_this_this.prop('checked', !_is_checked);
						}
					});
				});
			});
		}
	};
	
	$(document).ready(function() {
		ilcObj.icl_admin_media_lib_config_url();
		ilcObj.ilc_save_checkbox();
	});
    /* Every time the window is scrolled ... */
})(window.jQuery)