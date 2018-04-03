/**
* --------------------------------------------------------------------------------------------------------------------
* KHAI BAO CAC THU VIEN Js DUNG CHO TOAN TRANG
* --------------------------------------------------------------------------------------------------------------------
*/
$(function() {
	$('input.js_price').keyup(function(event){
      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40 || event.which === 8){
         return false;
         event.preventDefault();
      }
      var $this = $(this);
      var num = $this.val().replace(/,/gi, "").split("").reverse().join("");

      var num2 = RemoveRougeChar(num.replace(/(.{3})/g,"$1,").split("").reverse().join(""));

      // the following line has been simplified. Revision history contains original.
      $this.val(num2);
   });
	// $('img').on('error', function() {
	// 	console.log("IMG ERROR!!");
	// 	var imgSize = $(this).data('size');
	// 	this.src = "http://placehold.it/" + imgSize;
	// });



	/*
	* Click event remove
	*/
	$('.js_remover').click(function(ev) {
		ev.preventDefault();
		var answer = confirm('Bạn có chắc chắn muốn xóa bản ghi này?');
		if (answer) return window.location.href = $(this).attr('href');
		else return false;
	});
});

var workspace = {};
workspace.tools = {};
workspace.tools.Base64 = {};
/**
 * Base64 toolkit
 * Đối tượng này dùng để hash 1 chuỗi thành dạng base64
 */
workspace.tools.Base64 = {
	// private property
	_keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

	// public method for encoding
	encode: function (input) {
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0;

		input = workspace.tools.Base64._utf8_encode(input);

		while (i < input.length) {

			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);

			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;

			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)) {
				enc4 = 64;
			}

			output = output +
				this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
				this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

		}

		return output;
	},

	// public method for decoding
	decode: function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;

		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

		while (i < input.length) {

			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));

			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;

			output = output + String.fromCharCode(chr1);

			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}

		}

		output = workspace.tools.Base64._utf8_decode(output);

		return output;

	},

	// private method for UTF-8 encoding
	_utf8_encode: function (string) {
		string = string.replace(/\r\n/g, "\n");
		var utftext = "";

		for (var n = 0; n < string.length; n++) {

			var c = string.charCodeAt(n);

			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if ((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}

		}

		return utftext;
	},

	// private method for UTF-8 decoding
	_utf8_decode: function (utftext) {
		var string = "";
		var i = 0;
		var c = 0, c1 = 0, c2 = 0;

		while (i < utftext.length) {

			c = utftext.charCodeAt(i);

			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if ((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i + 1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i + 1);
				c3 = utftext.charCodeAt(i + 2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}

		}

		return string;
	}
};



/**
 * Call box modal ( status, message )
 */
var BugModal = {

	init : function(options) {
		var default_options = {
			status : 'success',
			title : 'Thông báo',
			message : ''
		}

		var stt = ["success", "error", "warning"];

		var options = $.extend(default_options, options);

		if(stt.indexOf(options.status) <= 0) {
			options.status = "success";
		}

		this.getHtmlModal().success(function(html) {
			if($('#jt-modal').length <= 0) {
				$('body').append(html);
			}
			var $modal = $('#jt-modal');

			$modal.find('.icon-info')
					.removeClass('error')
					.removeClass('success')
					.removeClass('warning')
					.addClass(options.status);

			$modal.find('.modal-ctitle .text').html(options.title);

			$modal.find('.modal-message').html(options.message);

			$modal.modal();

		});

	},

	getHtmlModal : function() {
		return $.get('/templates_html/bug_modal.html');
	},

	close : function() {
		$('#jt-modal').modal('hide');
	}
}


$.fn.serializeObject = function(){
	var o = {};
	var a = this.serializeArray();

	$.each(a, function() {
	  	if (o[this.name] !== undefined) {
	      if (!o[this.name].push) {
	         o[this.name] = [o[this.name]];
	      }
	      o[this.name].push(this.value || '');
	  	} else {
	      o[this.name] = this.value || '';
	  	}
	});

	return o;
};


try {

	/**
	 * CONFIG TINY-MCE
	 */
	tinymce.init({
		selector: "textarea.content",
		width: 595,
	 	height: 150,
		// ===========================================
		// INCLUDE THE PLUGIN
		// ===========================================

	  	plugins: [
	    	"advlist autolink lists link image charmap print preview anchor",
	    	"searchreplace visualblocks code fullscreen",
	    	"insertdatetime media table contextmenu paste jbimages"
	  	],

	  	// ===========================================
	  	// PUT PLUGIN'S BUTTON on the toolbar
	  	// ===========================================

	  	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",

	  	// ===========================================
	  	// SET RELATIVE_URLS to FALSE (This is required for images to display properly)
	  	// ===========================================

	  	style_formats: [
			{title: 'Bold text', inline: 'b'},
			{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			{title: 'Example 1', inline: 'span', classes: 'example1'},
			{title: 'Example 2', inline: 'span', classes: 'example2'},
			{title: 'Table styles'},
			{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
	   ],

	  	relative_urls: false
	});

}catch(error) {
	console.log(error);
}


// LAZY LOAD
try {
	$('.lazy').lazyload();
} catch(err) {
	console.log('Error: ' + err);
}

// FANCYBOX
try{
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none',
		helpers	: {
			title	: {
				type: 'outside'
			},
			thumbs	: {
				width	: 50,
				height	: 50
			}
		}
	});
} catch(err) {
	console.log('Error:' + err);
}

// Ajax setup
$.ajaxSetup({
  	beforeSend : function() {
  		$('.loading').show();
  	},
  	complete : function() {
  		$('.loading').hide();
  	}
});

$(document).ready(function(){
   $('input.js_price').keyup(function(event){
      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40 || event.which === 8){
         return false;
         event.preventDefault();
      }
      var $this = $(this);
      var num = $this.val().replace(/,/gi, "").split("").reverse().join("");

      var num2 = RemoveRougeChar(num.replace(/(.{3})/g,"$1,").split("").reverse().join(""));

      // the following line has been simplified. Revision history contains original.
      $this.val(num2);
   });

    $('.menu_title').click(function() {
      var spanArrow = $(this).find('.arrow_icon');
      var parent = $(this).parent();
      if(spanArrow.hasClass('expand')){
         spanArrow.removeClass('expand');
         spanArrow.addClass('unexpand');
         parent.find('.ul_sub_menu').slideToggle('fast');
      } else {
         spanArrow.removeClass('unexpand');
         spanArrow.addClass('expand');
         parent.find('.ul_sub_menu').slideToggle('fast');
      }
   });

   // Init datepicker
   // ---------------
   // var now = new Date();
   $.datepicker.regional['vi'] = {
      closeText: 'Đóng',
      prevText: '&#x3c;Trước',
      nextText: 'Tiếp&#x3e;',
      currentText: 'Hôm nay',
      monthNames: ['Tháng Một', 'Tháng Hai', 'Tháng Ba', 'Tháng Tư', 'Tháng Năm', 'Tháng Sáu',
      'Tháng Bảy', 'Tháng Tám', 'Tháng Chín', 'Tháng Mười', 'Thg Mười Một', 'Tháng Mười Hai'],
      monthNamesShort: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
      'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
      dayNames: ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'],
      dayNamesShort: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
      dayNamesMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
      weekHeader: 'Tu',
      dateFormat: 'dd/mm/yy',
      firstDay: 0,
      isRTL: false,
      showMonthAfterYear: false,
      yearSuffix: '',
      // minDate: new Date(),
      // maxDate: new Date(now.getFullYear(), now.getMonth() + 3, now. getDate())
   };
   $.datepicker.setDefaults($.datepicker.regional['vi']);

   var date_current  = new Date();
   var current = new Date((date_current.getMonth() + 1) + "/" + date_current.getDate() + "/" + date_current.getFullYear());
   var maxdate = new Date("12/01/" + (date_current.getFullYear() + 3));
   $(".datepicker").datepicker({
      gotoCurrent: true,
      changeMonth:true,
      changeYear:true,
      minDate: current,
      maxDate: maxdate,
      numberOfMonths: 2
   });

   setDateTimeTo(30, true);

   //SLIDER TOUR IMAGES
   if($('#slider_tour_image_container').length){
       var options = {
           $AutoPlay: false,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
           $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
           //$AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
           $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

           $ArrowKeyNavigation: true,                       //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
           $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
           $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
           //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
           //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
           $SlideSpacing: 0,                              //[Optional] Space between each slide in pixels, default value is 0
           $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
           $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
           $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
           $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
           $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

           $ArrowNavigatorOptions: {
               $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
               $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
               $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
               $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
           },

           $ThumbnailNavigatorOptions: {
               $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
               $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

               $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
               $AutoCenter: 3,                                 //[Optional] Auto center thumbnail items in the thumbnail navigator container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 3
               $Lanes: 1,                                      //[Optional] Specify lanes to arrange thumbnails, default value is 1
               $SpacingX: 3,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
               $SpacingY: 3,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
               $DisplayPieces: 9,                              //[Optional] Number of pieces to display, default value is 1
               $ParkingPosition: 260,                          //[Optional] The offset position to park thumbnail
               $Orientation: 1,                                //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
               $DisableDrag: false                            //[Optional] Disable drag or not, default value is false
           }
       };

       if($('#slider_tour_image_container').length){
         var jssor_slider2 = new $JssorSlider$("slider_tour_image_container", options);
          function ScaleSlider() {
           var parentWidth = jssor_slider2.$Elmt.parentNode.clientWidth;
           if (parentWidth)
               jssor_slider2.$ScaleWidth(Math.min(parentWidth, 500));
           else
            window.setTimeout(ScaleSlider, 30);
          }

          ScaleSlider();

          if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
              $(window).bind('resize', ScaleSlider);
          }
       }

   }
   //------------------------------------------

   $("div.box_right_title").click(function(){
      var spanArrow = $(this).find('.arrow_icon');
      if(spanArrow.hasClass("dropdown")){
         spanArrow.removeClass('dropdown');
         spanArrow.addClass('dropup');
         $(this).css({'border-bottom':'none','border-radius':'5px'});
         $(this).attr({
            title: 'click để mở ra'
         });
         $(this).next('div.box_right_container').slideToggle('fast');
      } else {
         spanArrow.removeClass('dropup');
         spanArrow.addClass('dropdown');
         $(this).next('div.box_right_container').slideToggle('fast');
         $(this).css({'border-bottom':'1px solid lightgray','border-radius':'5px 5px 0 0'});
         $(this).attr({
            title: 'click để thu gọn'
         });
      }
   });

});


function RemoveRougeChar(convertString){

	if(convertString.substring(0,1) == ","){

	  return convertString.substring(1, convertString.length)

	}

	return convertString;

}



function setDateTimeTo(max_day, check_set) {
   datepicker_regional = "vn";
   if(typeof(max_day)   ==='undefined') max_day = 29;
   if(typeof(check_set) ==='undefined') check_set = true;
   //console.log(check_set);
   if ($('.check_time_from').length) {

    $('.check_time_from').change(function(){
      var timeFrom  = $(this).val();
         var num_night = parseInt($('#num_night .putform').val());
         var date_time_format = "dd/mm/yy";
         $('.check_time_from').val(timeFrom);
      datePart = timeFrom.match(/(\d+)/g);
      realTime       = new Date(parseFloat(datePart[2]), parseFloat(datePart[1]) - 1 , parseFloat(datePart[0]) + 1);
         realTimeSet    = new Date(parseFloat(datePart[2]), parseFloat(datePart[1]) - 1 , parseFloat(datePart[0]) + num_night);
         datepicker_regional  =  datepicker_regional ? datepicker_regional : "vn";
         switch(datepicker_regional) {
            case "en":
               realTime         = new Date(parseFloat(datePart[2]) , parseFloat(datePart[0]) - 1, parseFloat(datePart[1]) + 1);
               realTimeSet      = new Date(parseFloat(datePart[2]) , parseFloat(datePart[0]) - 1, parseFloat(datePart[1]) + num_night);
               break;
         }
         //Max date allow select time to
         maxrealtime = realTime.getTime() + max_day * 86400000;
         maxrealtime = new Date(maxrealtime);
         //console.log(realTimeSet);
      //$('.check_time_to').datepicker('option', 'dateFormat', date_time_format);
      $('.check_time_to').datepicker('option', 'minDate', realTime);
         $('.check_time_to').datepicker('option', 'maxDate', maxrealtime);
      $('.check_time_to').datepicker('setDate',realTimeSet);

    });

    //Disable all day before date selected
      var timeTo = $('.check_time_from').val();
    if (timeTo != '') {
      datePartTo = timeTo.match(/(\d+)/g);
      realTimeTo = new Date(parseFloat(datePartTo[2]), parseFloat(datePartTo[1]) - 1 , parseFloat(datePartTo[0]) + 1);
         datepicker_regional  =  datepicker_regional ? datepicker_regional : "vn";
         switch(datepicker_regional) {
            case "en":
               realTimeTo = new Date(parseFloat(datePartTo[2]) , parseFloat(datePartTo[0]) - 1, parseFloat(datePartTo[1]) + 1);
               break;
         }
         //Max date allow select time to
         maxrealtimeTo = realTimeTo.getTime() + max_day * 86400000;
         maxrealtimeTo = new Date(maxrealtimeTo);
         $('.check_time_to').datepicker({
          gotoCurrent: true,
          changeMonth:true,
          changeYear:true,
          minDate: realTimeTo,
            maxDate: maxrealtimeTo,
          numberOfMonths: 2
        });
         if (check_set == true) {
            $('.check_time_to').datepicker('option', 'minDate', realTimeTo);
            $('.check_time_to').datepicker('option', 'maxDate', maxrealtimeTo);
         }
         //$('.check_time_to').datepicker('setDate',realTimeTo);
    }
   }
}

function addCommas(nStr) {
   nStr += '';
   x = nStr.split('.');
   x1 = x[0];
   x2 = x.length > 1 ? '.' + x[1] : '';
   var rgx = /(\d+)(\d{3})/;
   while (rgx.test(x1)) {
      x1 = x1.replace(rgx, '$1' + '.' + '$2');
   }
   return x1;
}

function changeMoneyTour() {
   $("#count_tour").change(function(){
      var quantity   = parseInt($(this).val());
      var price_tour = parseFloat($("#price_tour").attr('data'));
      var total_price = addCommas(quantity * price_tour);
      $("#stock").text(quantity);
      $(".total_money_tour").text(total_price);
   });
}