$(function() {
	var log = console.log;

	Inputmask({"mask": "+7 (999) 999-99-99"}).mask('input[name="phone"]');

	$.loadScript = function(url, callback) {
		$.ajax({
			url: url,
			dataType: 'script',
			success: callback,
			async: true
		});
	}

	setTimeout(function() {
		$.loadScript("https://api-maps.yandex.ru/2.1/?lang=ru_RU", function(){
			ymaps.load(setMapContact);
		});
	}, 3000);

	$('#formTop input[name="weight"]').on("change keyup input click", function(){
		$(this).val($(this).val().replace(",", "."));
		if($(this).val().match(/[^0-9\.]/g)){
			$(this).val($(this).val().replace(/[^0-9\.]/g, ""));
		}
	});

	$('#formTop input[name="volume"]').on("change keyup input click", function(){
		$(this).val($(this).val().replace(",", "."));
		if($(this).val().match(/[^0-9\.]/g)){
			$(this).val($(this).val().replace(/[^0-9\.]/g, ""));
		}
	});

	$('input[name="terms"]').change(function() {
		var btn = $(this).closest('form').find('button.send-form-btn-js');

		if(btn.length <= 0){
			btn = $(this).closest('form').find('button.send-query-btn-js');
		}

		if($(this).prop('checked')){
			btn.prop('disabled', false);
			btn.removeAttr('style');
		}else{
			btn.prop('disabled', true);
			btn.css('color', 'grey');
		}
	});

});

function setMapContact() {
	if($('#contact-map').length > 0){
		ymaps.geocode("Санкт-Петербург, Гагарина 1", {results: 1}).then(function (res) {
			var GeoObject = res.geoObjects.get(0);
			var point = GeoObject.geometry.getCoordinates();

			contact_map = new ymaps.Map('contact-map', {
				center: point,
				zoom: 12
			});

			contact_map.behaviors.disable('scrollZoom');

			contact_map.geoObjects.add(new ymaps.Placemark(point,{
				balloonContent: "Санкт-Петербург, Гагарина 1"
			}));
		});
	}
}



function set_cookie ( name, value, exp_y, exp_m, exp_d, path, domain, secure ){
	var cookie_string = name + "=" + escape ( value );
	if ( exp_y ){
		var expires = new Date ( exp_y, exp_m, exp_d );
		cookie_string += "; expires=" + expires.toGMTString();
	}
	if ( path )
		cookie_string += "; path=" + escape ( path );
	if ( domain )
		cookie_string += "; domain=" + escape ( domain );
	if ( secure )
		cookie_string += "; secure";
	document.cookie = cookie_string;
}

function delete_cookie ( cookie_name ) {
	var cookie_date = new Date ( );  // Текущая дата и время
	cookie_date.setTime ( cookie_date.getTime() - 1 );
	document.cookie = cookie_name += "=; expires=" + cookie_date.toGMTString();
}

function get_cookie ( cookie_name ){
	var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );

	if ( results )
		return ( unescape ( results[2] ) );
	else
		return null;
}