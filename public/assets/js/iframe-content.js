$(function() {

	// Init datepicker
	// ---------------
	var now = new Date();
	$('.date-picker').datepicker();
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

	// TinyMCE - Config
	tinymce.init({
		selector: ".content",
		width: 750,
	 	height: 150,
		// ===========================================
		// INCLUDE THE PLUGIN
		// ===========================================

	  	plugins: [
	    	"advlist autolink lists link image charmap print preview anchor",
	    	"searchreplace visualblocks code fullscreen",
	    	"insertdatetime media table contextmenu paste jbimages responsivefilemanager"
	  	],

	  	// ===========================================
	  	// PUT PLUGIN'S BUTTON on the toolbar
	  	// ===========================================

	  	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
	  	toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
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

	  	relative_urls: false,

	  	image_advtab: true ,

	   external_filemanager_path:"/filemanager/",
	   filemanager_title:"Responsive Filemanager" ,
	   external_plugins: { "filemanager" : "/assets/js/tinymce4x/plugins/responsivefilemanager/plugin.min.js"}
	});

	//replace tieng viet
	 function friendlyLink(s){
	 	if (typeof s === "undefined") {
         return;
      }
      var i = 0, uni1, arr1;
      var newclean = s;
      uni1 = 'à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|A';
      arr1 = uni1.split('|');
      for (i = 0; i < uni1.length; i++)
          newclean = newclean.replace(uni1[i], 'a');
      uni1 = 'è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|E';
      arr1 = uni1.split('|');
      for (i = 0; i < uni1.length; i++)
          newclean = newclean.replace(uni1[i], 'e');
      uni1 = 'ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ|I';
      arr1 = uni1.split('|');
      for (i = 0; i < uni1.length; i++)
          newclean = newclean.replace(uni1[i], 'i');
      uni1 = 'ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|O';
      arr1 = uni1.split('|');
      for (i = 0; i < uni1.length; i++)
          newclean = newclean.replace(uni1[i], 'o');
      uni1 = 'ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|U';
      arr1 = uni1.split('|');
      for (i = 0; i < uni1.length; i++)
          newclean = newclean.replace(uni1[i], 'u');

      uni1 = 'ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ|Y';
      arr1 = uni1.split('|');
      for (i = 0; i < uni1.length; i++)
          newclean = newclean.replace(uni1[i], 'y');
      uni1 = 'd|Đ|D';
      arr1 = uni1.split('|');
      for (i = 0; i < uni1.length; i++)
          newclean = newclean.replace(uni1[i], 'd');
      newclean = newclean.toLowerCase();
      ret = newclean.replace(/[\&]/g, '-').replace(/[^a-zA-Z0-9.-\/]/g, '-').replace(/[-]+/g, '-').replace(/-$/, '');
      return ret;
	 }

	/**
	 * Format price
	 */
	$(document).on('keyup', '.price' , function(e) {
      var that = $(this);
      var price = that.val().replace(/\,/g, '');
      that.val(addCommas(price));
      // $this.next().text(accounting.formatMoney($this.val()));
   });

   $(document).on('keyup', '.title', function(e){
   	var title = $(this).val();
   	$('.slug').val(friendlyLink(title));
   });

   // Handle when hover on active button
   //
   $('.btn-active-action')
   	.hover(toggleStyleEditBtn, toggleStyleEditBtn)
   	.click(function(e) {
   		e.preventDefault();
   		var $this = $(this);
   		$.ajax({
   			url : $this.attr('href'),
   			type : 'GET',
   			dataType : 'json',
   			success : function(data) {
   				if(data.code === 1) {
   					var _btn = $this.find('i');
   					if(data.status == 1) {
   						$this.html('<i class="fa fa-check-square"></i>');
   					}else{
   						$this.html('<i class="fa fa-square-o"></i>');
   					}
   				}else{
   					alert(data.message);
   				}
   			}
   		})
   	});

   // Warning when delete an item
   //
   $('.btn-delete-action').click(function(ev) {
      ev.preventDefault();
      var answer = confirm('Bạn có chắc chắn muốn xóa bản ghi này?');
      if (answer) return window.location.href = $(this).attr('href');
      else return false;
   });

   $(".fancybox").fancybox();
});

/**
 * Hàm thay đổi style class cho nút active
 */
function toggleStyleEditBtn () {
   var _btn = $(this).find('i');
   if (_btn.hasClass('fa-check-square')) {
      _btn.removeClass('fa-check-square').addClass('fa-square-o');
   } else {
      _btn.removeClass('fa-square-o').addClass('fa-check-square');
   }
}