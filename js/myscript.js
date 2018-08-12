window.winWidth = $(window).width();

$(document).ready(function() {
	if(winWidth <= 768 && winWidth > 640){
		$('.about_icon > .paralax2_2').appendTo($('.about_block'));

		$('.action_view_block').eq(1).appendTo($('.action_view'));
	}

	if(winWidth <= 640){
		$('.header .menu').detach();
	}

	var news_id = $('.news_block_view').data('news-id');
	$('.news_block_view__caption > p:last').append('<span class="link link_blue_light link_dashed link_view_news" onclick="view_news('+news_id+');">Подробнее</span>');
});

var onloaded_time;
setTimeout(function(){
	$('#onloaded').fadeOut(500, function(){
		$(this).detach();
		$('body').removeClass('modal_bg');
	});
},3000);

function prepare_paginations(){
	$('.pagination a').each(function(){
		var href_pg = $(this).attr('href');
		$(this).removeAttr('href')
		href_pg = href_pg.split('=');
		var curr_page = href_pg[1];

		$(this).attr({'data-pagination-page':curr_page, 'onclick':'clicked_page('+curr_page+')'});
	});
}

prepare_paginations();

var pagination_count = $('.pagination').data('pagination-count');
function clicked_page(paged){
	var data = {
		'action': 'loadpost',
		'query': true_posts,
		'page' : paged
	};

	$.ajax({
		url: ajaxurl, // обработчик
		data: data, // данные
		type: 'post', // тип запроса
		success:function(data){
			if(data) { 
				$('.news_block').html(data);

				var data_pagination = {
					'action': 'repagination',
					'count_page': pagination_count,
					'is_page' : paged
				};

				$.ajax({
					url: ajaxurl, // обработчик
					data: data_pagination, // данные
					type: 'post', // тип запроса
					success:function(data){
						if(data) { 
							$('.news .pagination').html(data);
							prepare_paginations();
						}
					}
				});
			}
		}
	});
}

var top_scroll = 0;
$('.menu_list > li > a[href^="#"]').click(function(e){
	e = e || event;
	e.preventDefault();
	
	var sect_id  = $(this).attr('href');
	
	$('body,html').animate({scrollTop: ($(sect_id).offset().top - top_scroll)}, 1000);

	if(winWidth <= 768){
		$('.hamburger').trigger('click');
	}
});

$('.docs_content_block').hover(
	function(){
		if(!$(this).hasClass('active')){
			$('.docs_content_block').removeClass('active');
			$(this).addClass('active');
		}
	}
);

$('.hamburger').click(function(){
	if(!$('.menu').hasClass('open')){
		$('.menu').fadeIn(500).addClass('open');
		$('body').addClass('modal_bg');
	} else {
		$('.menu').fadeOut(400).removeClass('open');
		$('body').removeClass('modal_bg');
	}
});

$('.menu > .modal_close').click(function(){
	$('.hamburger').trigger('click');
});

var $c_block, $c_block_fid, $faq_id;
$('p#modal, span#modal, li#modal, div#modal, div#object').click(function(){
	
	$faq_id = $(this).attr('data-modal');
	$c_block = $('.modal[data-modal-id="'+$faq_id+'"]');

	if($c_block.css('display') == 'none'){
		$('body').addClass('modal_bg');
		
		$('.modal_block').addClass('open').fadeIn();
		$('.modal_fade').fadeIn(200);
		
		$('.modal').fadeOut(200);
		$c_block.delay(150).fadeIn(400);

		var c_block_height = $c_block.height();
		var c_w_height = $(window).height();
		if(c_block_height < (c_w_height - 60)){
			var c_block_top = (100 - (c_block_height / (c_w_height / 100))) / 2;
			$c_block.css('top',c_block_top+'%');
		}

		$c_block.addClass('in');

		console.log($c_block.height());
	} else {
		console.log('error');
		$('.modal_fade').fadeOut(400);
		$('.modal').fadeOut(400);
		$('body').removeClass('modal_bg');
		$('.modal_block').delay(350).fadeOut(200);
	}
});

$('.modal > .modal_close').click(function(){
	$('.modal_fade').fadeOut(400);
	$('.modal').fadeOut(400);
	$('body').removeClass('modal_bg');
	$('.modal_block').delay(350).fadeOut(200);
});

$(document).mouseup(function (e) {
	if($('.modal_fade').is('div')){
		var container = $(".modal");
	  if (container.has(e.target).length === 0){
	    $('.modal_fade').fadeOut(400);
		$('.modal').fadeOut(400);
	  	$('body').removeClass('modal_bg');
		$('.modal_block').delay(350).fadeOut(200)
	  }
	}
});

function find_file(array, value) {
	if (array.indexOf) { // если метод существует
		return array.indexOf(value);
	}
    
	for (var i = 0; i < array.length; i++) {
		console.log(array[i]);
		console.log(value);
		if (array[i] === value) return i;
	}
    
	return -1;
}

var file_r, r_error, region;
$('#f_resume').change(function(){
	file_r = this.files;
	console.log(file_r);

	region = $(this).next();

	region.children('.file_region_error').detach();

	var file_format = ['application/msword', 'application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

	$.each( $(this).prop('files') , function( key, value ){
        if(value.size > 5100000){
        	region.append('<p class="file_region_error">Файл: '+value.name+' слишком большой!</p>');
        } else {
        	if(find_file(file_format, value.type) != -1){
        		region.children('.file_region_name').empty();
        		region.children('.file_region_name').addClass('resume').text(value.name);
        	} else {
        		region.append('<p class="file_region_error"> Неверный формат файла: '+value.name+'</p>');
        	}
        }
    });
});

//ANIMATION - ICON
$('.sect h2').hover(
	function(){
		if($(this).prev().hasClass('sect_icon_animate')){
			$(this).prev().addClass('hover');
		}
	},
	function(){
		if($(this).prev().hasClass('sect_icon_animate')){
			$(this).prev().removeClass('hover');
		}
	}
);

function paralax(element, speed, position, start_position, left, right){
	step = (position / 200 * speed);
	
	//position_left = $(element).css('left');

	if(left && !right){
		new_left = parseInt(start_position) - step;
	} else if(left && right){
		new_left = parseInt(start_position) + step;
	} else {
		new_left = parseInt(start_position) + step;
	}	
	
	if(!right){
		$(element).css('left',new_left);
	} else {
		$(element).css('right',new_left);
	}

	//console.log(step);
	//console.log(parseInt(start_position));
	//console.log(new_left);
}

var paralax1_top, paralax2_top, paralax21_top, paralax3_top, paralax4_top, paralax5_top;
var position_Top = $(window).scrollTop();

var paralax_1_1, paralax_1_2, paralax_1_3, paralax_1_4, 
	paralax_2_1, paralax_2_2, paralax_21, 
	paralax_3_1, paralax_3_2, paralax_3_3, 
	paralax_4_1, paralax_4_2;

paralax_1_1 = $('.paralax1_1').css('left');
paralax_1_2 = $('.paralax1_2').css('left');
paralax_1_3 = $('.paralax1_3').css('left');
paralax_1_4 = $('.paralax1_4').css('left');
paralax_2_1 = $('.paralax2_1').css('left');
paralax_2_2 = $('.paralax2_2').css('left');
paralax_21 = $('.paralax21_0').css('right');
paralax_3_1 = $('.paralax3_1').css('left');
paralax_3_2 = $('.paralax3_2').css('left');
paralax_3_3 = $('.paralax3_3').css('left');
paralax_4_1 = $('.paralax4_1').css('left');
paralax_4_2 = $('.paralax4_2').css('left');

/*console.log(paralax_1_1+ ' - ' +paralax_1_2+ ' - ' +paralax_1_3+ ' - ' +paralax_1_4+ ' - ' +
		paralax_2_1+ ' - ' +paralax_2_2+ ' - ' +paralax_21+ ' - ' +paralax_3_1, paralax_3_2, paralax_3_3+ ' - ' +
		paralax_4_1+ ' - ' +paralax_4_2);*/

$(window).bind('load', function(){
	paralax1_top = $('.header').offset().top;
	paralax2_top = $('.about').offset().top;
	paralax21_top = $('.about').offset().top;
	paralax3_top = $('.production').offset().top;
	paralax4_top = $('.partners').offset().top;
	paralax5_top = $('.news').offset().top;
	//console.log(paralax1_top+ ' - ' +paralax2_top+ ' - ' +paralax21_top+ ' - ' +paralax3_top+ ' - ' +paralax4_top);

	/*if(paralax_1_1 != 'auto'){
		paralax_1_1 = $('.paralax1_1').css('left');
		paralax_1_2 = $('.paralax1_2').css('left');
		paralax_1_3 = $('.paralax1_3').css('left');
		paralax_1_4 = $('.paralax1_4').css('left');
		paralax_2_1 = $('.paralax2_1').css('left');
		paralax_2_2 = $('.paralax2_2').css('left');
		paralax_21 = $('.paralax21_0').css('right');
		paralax_3_1 = $('.paralax3_1').css('left');
		paralax_3_2 = $('.paralax3_2').css('left');
		paralax_3_3 = $('.paralax3_3').css('left');
		paralax_4_1 = $('.paralax4_1').css('left');
		paralax_4_2 = $('.paralax4_2').css('left');
	}*/
});

$(window).resize(function(){
	paralax1_top = $('.header').offset().top;
	paralax2_top = $('.about').offset().top;
	paralax21_top = $('.about').offset().top;
	paralax3_top = $('.production').offset().top;
	paralax4_top = $('.partners').offset().top;
	//console.log(paralax1_top+ ' - ' +paralax2_top+ ' - ' +paralax21_top+ ' - ' +paralax3_top+ ' - ' +paralax4_top);

	paralax_1_1 = $('.paralax1_1').css('left');
	paralax_1_2 = $('.paralax1_2').css('left');
	paralax_1_3 = $('.paralax1_3').css('left');
	paralax_1_4 = $('.paralax1_4').css('left');
	paralax_2_1 = $('.paralax2_1').css('left');
	paralax_2_2 = $('.paralax2_2').css('left');
	paralax_21 = $('.paralax21_0').css('right');
	paralax_3_1 = $('.paralax3_1').css('left');
	paralax_3_2 = $('.paralax3_2').css('left');
	paralax_3_3 = $('.paralax3_3').css('left');
	paralax_4_1 = $('.paralax4_1').css('left');
	paralax_4_2 = $('.paralax4_2').css('left');

	/*console.log(paralax_1_1+ ' - ' +paralax_1_2+ ' - ' +paralax_1_3+ ' - ' +paralax_1_4+ ' - ' +
		paralax_2_1+ ' - ' +paralax_2_2+ ' - ' +paralax_21+ ' - ' +paralax_3_1, paralax_3_2, paralax_3_3+ ' - ' +
		paralax_4_1+ ' - ' +paralax_4_2);*/
});

$('#about_spoiler').click(function(){
	$(this).removeClass('link link_blue_light');
	$('.content_block_view.hidden').slideDown();
});

var position_Top;
if(winWidth > 768){
	$(window).bind('scroll', function(){
		position_Top = $(window).scrollTop();

		paralax1_top = $('.header').offset().top;
		paralax2_top = $('.about').offset().top;
		paralax21_top = $('.about').offset().top;
		paralax3_top = $('.production').offset().top;
		paralax4_top = $('.partners').offset().top;
		paralax5_top = $('.news').offset().top;

		//PARALAX1
		if(position_Top > paralax1_top && position_Top < paralax2_top){
			paralax('.paralax1_1', 50, position_Top, paralax_1_1);
			paralax('.paralax1_2', 20, position_Top, paralax_1_2);
			paralax('.paralax1_3', 15, position_Top, paralax_1_3);
			paralax('.paralax1_4', 40, position_Top, paralax_1_4);
		}

		if(position_Top > ((paralax2_top - paralax1_top) / 2) && position_Top < paralax2_top){
			paralax('.paralax2_1', 30, (position_Top - ((paralax2_top - paralax1_top) / 2)), paralax_2_1, true);
			paralax('.paralax2_2', 20, (position_Top - paralax2_top), paralax_2_2);
		}

		if(position_Top > paralax2_top && position_Top < paralax3_top){
			
			//paralax('.paralax2_2', 100, (position_Top - paralax2_top), paralax_2_2, true);
			paralax('.paralax21_0', 20, (position_Top - paralax2_top - (-200)), paralax_21, true, true);
		}

		if(winWidth > 1024){
			if(position_Top > paralax3_top && position_Top < paralax4_top){
				paralax('.paralax3_1', 20, (position_Top - paralax3_top), paralax_3_1, true);
				paralax('.paralax3_2', 30, (position_Top - paralax3_top), paralax_3_2);
				paralax('.paralax3_3', 20, (position_Top - paralax3_top), paralax_3_3);
			}

			if(position_Top > paralax4_top && position_Top < paralax5_top){
				paralax('.paralax4_1', 35, (position_Top - paralax4_top), paralax_4_1);
				paralax('.paralax4_2', 30, (position_Top - paralax4_top), paralax_4_2);
			}
		}
	});
}

if(winWidth <= 1024){
	$('.about_block > .content_block_view br').detach();

	$('.diploms .gallery_slick').slick({
		infinite: true,
		//fade: true,
		speed: 300,
		slidesToShow: 1,
		adaptiveHeight: true,
		variableWidth: true
	});

	var lastScrollTop = 0;
	  $(window).scroll(function(event){
	    var st = $(this).scrollTop();
	    //console.log(st);
	    if (st > lastScrollTop) {
	      // downscroll code
	      if (screen.availHeight <= 768) {
	        if (st > 100)
	          $('.header > .wrapper').addClass('headerhidden');
	          /*$('.field-name-field-filterproject').addClass('fp_fixed').animate({'opacity':1},300);
	          console.log(2);*/
	      } else {
	        if (st > 70){
	          $('.header > .wrapper').addClass('headerhidden');
	        }
	      }
	    } else {
	      // upscroll code
	      $('.header > .wrapper').removeClass('headerhidden');
	    }
	    lastScrollTop = st;
	  });
} else {
	$('.gallery_slick_modal').slick({
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		adaptiveHeight: true
	});

	var diplom_id;
	$('.diploms_view_block').click(function(){
		diplom_id = $(this).data('diplom-id');
		console.log(diplom_id);
		$('.gallery_slick_modal').slick('slickGoTo',diplom_id);
	});
}

if(winWidth <= 640){
	$('.gallery_slick2').slick({
		dots: true,
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3
	});
}

var data_switch, data_switch_id;
$('.switch > li').click(function(){
	data_switch = $(this);
	data_switch_id = data_switch.data('switch-id');

	if(!data_switch.hasClass('active')){
		$('.switch > li').removeClass('active');
		data_switch.addClass('active');

		$('.docs_content_block').removeClass('active');
		$('.docs_content_block[data-switch-id="'+data_switch_id+'"]').addClass('active');
	}
});

//
var doc_type;
$('.docs_all').click(function(){
	doc_type = $(this).data('docs-type');
	$(this).fadeOut();
	$('.docs_content_block[data-switch-id="'+doc_type+'"]').find('.docs_list.hidden').slideDown();
});

function view_news(nid){
	$('.news_block_view[data-news-id="'+nid+'"]').find('.link_view_news').fadeOut();
	$('.news_block_view[data-news-id="'+nid+'"]').find('.display_none').slideDown(200);
}

ymaps.ready(function () {
	var myMap = new ymaps.Map("yaMap", {
		center: [53.642649, 54.785371],
		zoom: 16
	}),
	myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
		hintContent: '',
		balloonContent: ''
	}, {
		iconLayout: 'default#image',
		iconImageHref: location.href+'/wp-content/themes/miyakimolzavod/img/svg/pin.svg',
		iconImageSize: [40, 60],
		iconImageOffset: [-23, -54]
	});

	myMap.behaviors.disable(['scrollZoom']);
	myMap.geoObjects.add(myPlacemark);
});

$('.vacancy_modal_form').submit(function(e){
	e = e || event;
	
	this_form = $(this);
	errors = false;

	this_form.find('input').each(function(){
		$(this).removeClass('errors');
		my_text = $(this).val();

		if(my_text == '' || my_text == undefined){
			$(this).addClass('errors');
			errors = true;
		}
	});

	if(errors){
		e.preventDefault();
	} else {
		e.preventDefault();
		$('.modal > .modal_close').trigger('click');
		$('.vaks').trigger('click');
	}
});

$('input').bind('input',function(e){
	text_ = $(this).val();
	if(text_.length >= 1){
		$(this).removeClass('errors');
	} else {
		$(this).addClass('errors');
	}
});