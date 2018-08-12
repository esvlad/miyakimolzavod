<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Miyakimolzavod
 */

get_header(); 
?>
<?
$my_site_static = new WP_Query('name=site-static');
$my_site_static_id = $my_site_static->post->ID;
?>
<? if(wpmd_is_phone() === true) : ?>
<div class="menu">
  <div class="modal_close pad768"></div>
  <ul class="menu_list">
    <li><a class="link link_gray" href="#company">Компания</a></li>
    <li><a class="link link_gray" href="#production">Производство</a></li>
    <li><a class="link link_gray" href="#production_list">Продукция</a></li>
    <li><a class="link link_gray" href="#docs">Документы</a></li>
    <li><a class="link link_gray" href="#partners">Сотрудничество</a></li>
    <li><a class="link link_gray" href="#news">Новости</a></li>
    <li><a class="link link_gray" href="#vakansii">Вакансии</a></li>
    <li><a class="link link_gray" href="#contacts">Контакты</a></li>
  </ul>
</div>
<? endif; ?>
<header class="sect header">
  <div class="wrapper">
    <div class="header_top clearfix">
      <div class="header_top_logo">
      	<img src="<?=get_stylesheet_directory_uri()?>/img/other/logotype.png"/>
        <h1>Миякимолзавод</h1>
      </div>
      <div class="header_top_info">
        <div class="hamburger pad mob">
        	<span class="hamburger_line hl1"></span>
        	<span class="hamburger_line hl2"></span>
        	<span class="hamburger_line hl3"></span>
        </div>
        <div class="header_top_info_contacts">
          <p><span class="phone" data-class="link link_blue_light"><?=get_field('site-phone', $my_site_static_id);?></span></p>
          <p><a class="link link_blue_light" href="mailto:<?=get_field('site-mail', $my_site_static_id);?>"><?=get_field('site-mail', $my_site_static_id);?></a></p>
        </div>
      </div>
    </div>
    <div class="menu">
      <div class="modal_close pad768"></div>
      <ul class="menu_list">
        <li><a class="link link_gray" href="#company">Компания</a></li>
        <li><a class="link link_gray" href="#production">Производство</a></li>
        <li><a class="link link_gray" href="#production_list">Продукция</a></li>
        <li><a class="link link_gray" href="#docs">Документы</a></li>
        <li><a class="link link_gray" href="#partners">Сотрудничество</a></li>
        <li><a class="link link_gray" href="#news">Новости</a></li>
        <li><a class="link link_gray" href="#vakansii">Вакансии</a></li>
        <li><a class="link link_gray" href="#contacts">Контакты</a></li>
      </ul>
    </div>
  </div>
  <div class="wrapall">
  	<img class="paralax1 paralax1_1" src="<?=get_stylesheet_directory_uri()?>/images/clouds/100.png" alt=""/>
  	<img class="paralax1 paralax1_2" src="<?=get_stylesheet_directory_uri()?>/images/clouds/101.png" alt=""/>
  	<img class="paralax1 paralax1_3" src="<?=get_stylesheet_directory_uri()?>/images/clouds/104.png" alt=""/>
  	<img class="paralax1 paralax1_4" src="<?=get_stylesheet_directory_uri()?>/images/clouds/102.png" alt=""/>
  	<img class="head is_pc" src="<?=get_stylesheet_directory_uri()?>/images/other/001.png" alt=""/>
    <img class="head pad768" src="<?=get_stylesheet_directory_uri()?>/images/other/001pad.png" alt=""/>
  </div>
</header>
<?
	$about_post = new WP_Query('name=about');
	$about_hidden_field = get_field('text-hidden', $about_post->post->ID);
?>
<section class="sect about" id="company">
  <div class="wrapper">
    <div class="content">
      <div class="sect_icon about_icon about_paralax">
      	<img class="sect_icon_img" src="<?=get_stylesheet_directory_uri()?>/images/sect_icon/icon_about.png"/>
      	<img class="paralax2 paralax2_1" src="<?=get_stylesheet_directory_uri()?>/images/clouds/200.png"/>
      	<img class="paralax2 paralax2_2" src="<?=get_stylesheet_directory_uri()?>/images/clouds/101.png"/>
      </div>
      <div class="about_block">
        <h2>О заводе</h2>
        <div class="content_block_view">
        	<?=$about_post->post->post_content;?>
        </div>
        <div class="content_block_view hidden">
        	<?=$about_hidden_field;?>
        </div>
      </div>
    </div>
  </div>
  <img class="paralax21 paralax21_0" src="<?=get_stylesheet_directory_uri()?>/img/other/01k.png" alt=""/>
</section>
<?
	$action_posts = new WP_Query(array('category_name'=>'action', 'orderby'=>'date', 'order'=>'ASC'));
?>
<section class="sect action">
  <div class="wrapper">
    <div class="content">
      <h2>Деятельность</h2>
      <div class="action_view">
      	<? while ($action_posts->have_posts()) : ?>
      		<? $action_posts->the_post(); ?>
	        <div class="action_view_block">
	        	<img src="<?the_post_thumbnail_url();?>" alt=""/>
	          	<? the_content(); ?>
	        </div>
	    <? endwhile; ?>
      </div>
    </div>
  </div>
</section>
<?
	$comand_posts = new WP_Query(array('category_name'=>'command', 'orderby'=>'date', 'order'=>'ASC'));
?>
<section class="sect comand">
  <div class="wrapp1300">
    <div class="content">
      <div class="sect_icon_img comand_icon sect_icon_animate">
      	<img src="<?=get_stylesheet_directory_uri()?>/images/sect_icon/animate/commands.gif">
      </div>
      <h2>Команда завода</h2>
      <div class="comand_view">
      	<? while ($comand_posts->have_posts()) : ?>
      		<? $comand_posts->the_post(); ?>
      		<? $comand_post_id = get_the_ID(); ?>
	        <div class="comand_view_block">
	          <img class="comand_view_block_preview" src="<?the_post_thumbnail_url( 'thumbnail' );?>"/>
	          <div class="comand_view_block_caption">
	            <p class="comand_view_block__position"><?=get_field('position', $comand_post_id);?></p>
	            <p class="comand_view_block__name"><? the_title(); ?></p>
	            <? $comand__mail = get_field('mail', $comand_post_id);?>
	            <p class="comand_view_block__mail"><a href="mailto:<?=$comand__mail;?>"><?=$comand__mail;?></a></p>
	            <p class="comand_view_block__phone"><span class="tel"><?=get_field('phone', $comand_post_id);?></span></p>
	          </div>
	        </div>
	    <? endwhile; ?>
      </div>
    </div>
  </div>
</section>
<?
	$diploms_image = get_post_gallery(109, false);
	$dip_ids = explode(',', $diploms_image['ids']);
	$diploms_image_array = array();
	for($d = 0; $d < count($dip_ids); $d++){
		$diploms_image_array[] = array(
			'image' => $diploms_image['src'][$d],
			'caption' => wp_get_attachment_caption($dip_ids[$d]),
		);
	}
?>
<section class="sect diploms">
  <div class="bg_gradient bg_gradient1"></div>
  <div class="bg_gradient bg_gradient2"></div>
  <div class="bg_gradient bg_gradient3"></div>
  <div class="wrapper">
    <div class="content">
      <img class="diploms_image_logo" src="<?=get_stylesheet_directory_uri()?>/images/sect_icon/icon_diploms.png"/>
      <h2>Награды</h2>
      <div class="diploms_view gallery_slick">
      	<? if(wpmd_is_notdevice() === true) : ?>
	        <div id="modal" data-modal="gall" data-diplom-id="0" class="diploms_view_block big_100">
	        	<img src="<?=$diploms_image['src'][0];?>"/>
	        </div>
	        <div class="diploms_view_block_col">
	          <div id="modal" data-modal="gall" data-diplom-id="1" class="diploms_view_block big_25">
	          	<img src="<?=$diploms_image['src'][1];?>"/>
	          </div>
	          <div id="modal" data-modal="gall" data-diplom-id="2" class="diploms_view_block big_25">
	          	<img src="<?=$diploms_image['src'][2];?>"/>
	          </div>
	        </div>
	        <div id="modal" data-modal="gall" data-diplom-id="3" class="diploms_view_block big_50">
	        	<img src="<?=$diploms_image['src'][3];?>"/>
	        </div>
	        <div class="diploms_view_block_col">
	          <div id="modal" data-modal="gall" data-diplom-id="4" class="diploms_view_block big_25">
	          	<img src="<?=$diploms_image['src'][4];?>"/>
	          </div>
	          <div id="modal" data-modal="gall" data-diplom-id="5" class="diploms_view_block big_25">
	          	<img src="<?=$diploms_image['src'][5];?>"/>
	          </div>
	        </div>
	        <div class="diploms_view_block_col">
	          <div id="modal" data-modal="gall" data-diplom-id="6" class="diploms_view_block big_25">
	          	<img src="<?=$diploms_image['src'][0];?>"/>
	          </div>
	          <div id="modal" data-modal="gall" data-diplom-id="7" class="diploms_view_block big_25">
	          	<img src="<?=$diploms_image['src'][0];?>"/>
	          </div>
	        </div>
	        <div id="modal" data-modal="gall" data-diplom-id="8" class="diploms_view_block big_100">
	        	<img src="<?=$diploms_image['src'][0];?>"/>
	        </div>
	    <? else : ?>
	    	<? foreach($diploms_image_array as $value) : ?>
		    	<div class="diploms_view_block_gal">
		          <img src="<?=$value['image'];?>"/>
		          <p><?=$value['caption'];?></p>  
		        </div>
		    <? endforeach; ?>
		  <? endif; ?>
      </div>
    </div>
  </div>
</section>
<section class="sect production" id="production">
  <div class="wrapper">
    <div class="content">
      <h2>Производство<small>Этапы производства</small></h2>
      <div class="production_view">
        <div class="production_view_stages stages1">
        	<span class="st" data-text="1"></span>
        	<img class="stage" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/animation/01.gif"/>
          <img class="step step_mb_1 mob" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/step/m/01.png"/>
        	<p class="stage_caption">Тщательный отбор<br/>входного сырья</p>
        </div>
        <div class="production_view_stages stages2">
        	<span class="st" data-text="2"></span>
        	<img class="stage" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/animation/02.gif"/>
          <img class="step step_mb_2 mob" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/step/m/02.png"/>
        	<img class="step step_1" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/step/01.png"/>
        	<img class="step step_2" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/step/02.png"/>
        	<p class="stage_caption">Пастеризация</p>
        </div>
        <div class="production_view_stages stages3">
        	<span class="st" data-text="3"></span>
        	<img class="stage" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/animation/03.gif"/>
        	<img class="step step_3" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/step/03.png"/>
          <img class="step step_mb_3 mob" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/step/m/03.png"/>
        	<p class="stage_caption">Заквашивание</p>
        </div>
        <div class="production_view_stages stages4">
        	<span class="st" data-text="4"></span>
        	<img class="stage" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/animation/04.gif"/>
        	<img class="step step_4" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/step/04.png"/>
          <img class="step step_mb_4 mob" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/step/m/04.png"/>
        	<p class="stage_caption">Сквашивание</p>
        </div>
        <div class="production_view_stages stages5">
        	<span class="st" data-text="5"></span>
        	<img class="stage" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/animation/05.gif"/>
        	<img class="step step_5" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/step/05.png"/>
          <img class="step step_mb_5 mob" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/step/m/05.png"/>
        	<p class="stage_caption">Охлаждение</p>
        </div>
        <div class="production_view_stages stages6">
        	<span class="st" data-text="6"></span>
        	<img class="stage" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/animation/06.gif"/>
        	<img class="step step_6" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/step/06.png"/>
          <img class="step step_mb_6 mob" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/step/m/06.png"/>
        	<p class="stage_caption">Фасовка</p>
        </div>
        <div class="production_view_stages stages7">
        	<span class="st" data-text="7"></span>
        	<img class="stage" src="<?=get_stylesheet_directory_uri()?>/images/production_stages/animation/07.gif"/>
        	<p class="stage_caption">Созревание</p>
        </div>
      </div>
    </div>
  </div>
  <img class="paralax3 paralax3_1" src="<?=get_stylesheet_directory_uri()?>/images/clouds/301.png">
  <img class="paralax3 paralax3_2" src="<?=get_stylesheet_directory_uri()?>/images/clouds/302.png">
  <img class="paralax3 paralax3_3" src="<?=get_stylesheet_directory_uri()?>/images/clouds/303.png">
  <img class="cloud_mb cloud_mb_1 mob" src="<?=get_stylesheet_directory_uri()?>/images/clouds/301m.png">
  <img class="cloud_mb cloud_mb_2 mob" src="<?=get_stylesheet_directory_uri()?>/images/clouds/302m.png">
  <img class="cloud_mb cloud_mb_3 mob" src="<?=get_stylesheet_directory_uri()?>/images/clouds/303m.png">
  <img class="cloud_mb cloud_mb_4 mob" src="<?=get_stylesheet_directory_uri()?>/images/clouds/304m.png">
  <img class="cloud_mb cloud_mb_5 mob" src="<?=get_stylesheet_directory_uri()?>/images/clouds/305m.png">
</section>
<?
	$plist_posts = new WP_Query(array('category_name'=>'production_list', 'orderby'=>'date', 'order'=>'ASC'));
?>
<section class="sect production_list" id="production_list">
  <div class="bg_gradient bg_gradient1"></div>
  <div class="bg_gradient bg_gradient2"></div>
  <div class="bg_gradient bg_gradient3"></div>
  <div class="wrapper">
    <div class="content">
      <h2 class="text_center">Продукция</h2>
      <div class="production_list_view gallery_slick2">
      	<? while ($plist_posts->have_posts()) : ?>
      		<? $plist_posts->the_post(); ?>
	        <div class="production_list_view_block">
	        	<img src="<?the_post_thumbnail_url();?>"/>
	          	<p><? the_title(); ?></p>
	        </div>
	    <? endwhile; ?>
      </div>
      <p class="production_list_all">подробнее о&nbsp;продукции на&nbsp;сайте <a class="link link_blue link_solid" href="http://ecoblaco.ru/" target="_blank">Белого облака</a></p>
    </div>
  </div>
</section>
<?
	$declarations_posts = new WP_Query(array('category_name'=>'declarations', 'orderby'=>'date', 'order'=>'DESC', 'posts_per_page' => 3));
	$declarations_posts_hidden = new WP_Query(array('category_name'=>'declarations', 'orderby'=>'date', 'order'=>'DESC', 'offset' => 3));
	$certificate_posts = new WP_Query(array('category_name'=>'certificate', 'orderby'=>'date', 'order'=>'DESC', 'posts_per_page' => 3));
	$certificate_posts_hidden = new WP_Query(array('category_name'=>'certificate', 'orderby'=>'date', 'order'=>'DESC', 'offset' => 3));
?>
<section class="sect docs" id="docs">
  <div class="wrapper">
    <div class="content">
      <div class="sect_icon_img docs_icon sect_icon_animate">
      	<img src="<?=get_stylesheet_directory_uri()?>/images/sect_icon/animate/docs.gif">
      </div>
      <h2>Документы</h2>
      <ul class="switch pad768 mob">
        <li class="active" data-switch-id="declarations">Декларации </li>
        <li data-switch-id="certificate">Сертификаты</li>
      </ul>
      <div class="docs_content">
        <div class="docs_content_block docs_content_block__left switch_block active" data-switch-id="declarations">
          <ul class="docs_list">
	        <? while ($declarations_posts->have_posts()) : ?>
          		<?	$declarations_posts->the_post(); 
          			$docs_file = get_field('docs',get_the_ID()); ?>
	            <li>
	              <p><a class="link link_docs" href="<?=$docs_file['url'];?>"><? the_title(); ?></a></p>
	              <p>PDF <?=size_format(filesize(get_attached_file($docs_file['id'])));?></p>
	            </li>
	        <? endwhile; ?>
          </ul>
          <ul class="docs_list hidden">
            <? while ($declarations_posts_hidden->have_posts()) : ?>
          		<?	$declarations_posts_hidden->the_post(); 
          			$docs_file = get_field('docs',get_the_ID()); ?>
	            <li>
	              <p><a class="link link_docs" href="<?=$docs_file['url'];?>"><? the_title(); ?></a></p>
	              <p>PDF <?=size_format(filesize(get_attached_file($docs_file['id'])));?></p>
	            </li>
	        <? endwhile; ?>
          </ul>
          <div class="docs_all link link_blue_light link_dashed" data-docs-type="declarations">Посмотреть все</div>
        </div>
        <div class="docs_content_block docs_content_block__right switch_block" data-switch-id="certificate">
          <ul class="docs_list">
            <? while ($certificate_posts->have_posts()) : ?>
          		<?	$certificate_posts->the_post(); 
          			$docs_file = get_field('docs',get_the_ID()); ?>
	            <li>
	              <p><a class="link link_docs" href="<?=$docs_file['url'];?>"><? the_title(); ?></a></p>
	              <p>PDF <?=size_format(filesize(get_attached_file($docs_file['id'])));?></p>
	            </li>
	        <? endwhile; ?>
          </ul>
          <ul class="docs_list hidden">
            <? while ($certificate_posts_hidden->have_posts()) : ?>
          		<?	$certificate_posts_hidden->the_post(); 
          			$docs_file = get_field('docs',get_the_ID()); ?>
	            <li>
	              <p><a class="link link_docs" href="<?=$docs_file['url'];?>"><? the_title(); ?></a></p>
	              <p>PDF <?=size_format(filesize(get_attached_file($docs_file['id'])));?></p>
	            </li>
	        <? endwhile; ?>
          </ul>
          <div class="docs_all link link_blue_light link_dashed" data-docs-type="certificate">Посмотреть все</div>
        </div>
      </div>
    </div>
  </div>
</section>
<?
	$partners_post = new WP_Query('name=partners');
	$partners_post__subtitle = get_post_meta($partners_post->post->ID, 'subtitle', true);
?>
<section class="sect partners" id="partners">
  <div class="wrapper">
    <div class="content">
      <div class="partners_block">
        <div class="sect_icon sect_icon__partners">
        	<img class="sect_icon__partners_img" src="<?=get_stylesheet_directory_uri()?>/images/sect_icon/icon_partners.png"/>
        </div>
        <h2><?=$partners_post->post->post_title;?></h2>
        <? if(isset($partners_post__subtitle)) : ?>
        	<p><?=$partners_post__subtitle;?></p>
        <? endif; ?>
        <div class="partners_block_caption">
          <?=$partners_post->post->post_content;?>
        </div>
        <img class="paralax4 paralax4_1" src="<?=get_stylesheet_directory_uri()?>/images/clouds/401.png" alt=""/>
        <img class="paralax4 paralax4_2" src="<?=get_stylesheet_directory_uri()?>/images/clouds/402.png" alt=""/>
      </div>
    </div>
  </div>
</section>
<?
	$news_post = new WP_Query(array('category_name'=>'news', 'orderby'=>'date', 'order'=>'DESC', 'posts_per_page' => 1));
	$news_post_text = get_extended($news_post->post->post_content);
	$news_category = get_category_by_slug('news');
?>
<section class="sect news" id="news">
  <div class="wrapper">
    <div class="content">
      <div class="sect_icon_img sect_icon_img__news news_icon sect_icon_animate">
      	<img src="<?=get_stylesheet_directory_uri()?>/images/sect_icon/animate/news.gif">
      </div>
      <h2>Новости</h2>
	    <div class="news_block">
		    <? while($news_post->have_posts()) : ?>
	      	<? $news_post->the_post(); ?>
		      	<?
			      	$image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
			      	if(!empty($image)) {
			      		$class_news_img = ' is_image';
			      	} else {
			      		$class_news_img = null;
			      	} 
		      	?>
		        <div class="news_block_view<?=$class_news_img?>" data-news-id="<? the_ID(); ?>">
		          <div class="news_block_view_content">
		            <p class="news_block_view__date"><? the_time('d.m.Y'); ?></p>
		            <h3 class="news_block_view__title"><? the_title(); ?></h3>
		            <div class="news_block_view__caption">
		              <?= $news_post_text['main']; ?>
		              <div class="display_none">
		              	<?= $news_post_text['extended']; ?>
		              </div>
		            </div>
		          </div>
		          <? if(!empty($image)) : ?>
		          	<img class="news_block_view__images" src="<?= $image; ?>"/>
		          <? endif; ?>
		        </div>
	        <? endwhile; ?>
	    </div>
	    <?
		  	$news_pag_args = array(
		  		'base' => '%_%',
		  		'format' => '?page=%#%',
		  		'current' => 1,
		  		'total'=>$news_post->max_num_pages,
		  		'mid_size' => 2,
		  		'prev_next' => true,
		  		'prev_text' => '&nbsp;',
		  		'next_text' => '&nbsp;',
		  		'type' => 'list',
		  	);
		  	$news_pagination = paginate_links($news_pag_args);
	  	?>
	  	<div class="pagination" data-pagination-count="<?=$news_post->max_num_pages;?>">
        	<?=$news_pagination;?>
      	</div>
      	<!--<div class="pagination" data-pagination-count="<?=$news_post->max_num_pages;?>">
	        <ul class="pagination_list">
	          	<li class="prev" data-pagination-page="1"></li>
	          	<li class="active" data-pagination-page="1">1</li>
	          	<li data-pagination-page="2">2</li>
	          	<li data-pagination-page="3">3</li>
	          	<li class="dt">...</li>
	          	<li data-pagination-page="7">7</li>
	          	<li class="next" data-pagination-page="2"></li>
	        </ul>
      	</div>-->
    </div>
  </div>
</section>
<script>
	var ajaxurl = '<?= site_url() ?>/wp-admin/admin-ajax.php';
	var true_posts = '<?= serialize($news_post->query_vars); ?>';
</script>
<?
$vacancy_category = get_category_by_slug('vacancy');
$vacancy_posts = new WP_Query('category_name=vacancy');
?>
<section class="sect vacancy" id="vakansii">
  <div class="bg_gradient bg_gradient1"></div>
  <div class="bg_gradient bg_gradient2"></div>
  <div class="bg_gradient bg_gradient3"></div>
  <div class="bg_gradient bg_gradient4"></div>
  <div class="wrapper">
    <div class="content">
      <div class="sect_icon_img sect_icon_img__vacancy vacancy_icon sect_icon_animate">
      	<img src="<?=get_stylesheet_directory_uri()?>/images/sect_icon/animate/vakansii.gif">
      </div>
      <h2><?=$vacancy_category->name;?></h2>
      <div class="vacancy_block_caption">
        <p><?=$vacancy_category->description;?></p>
      </div>
      <div class="vacancy_view">
        <ul class="vacancy_view_list">
        	<? while ($vacancy_posts->have_posts()) : ?>
        		<? $vacancy_posts->the_post(); ?>
        		<li id="modal" data-modal="vac<?=get_the_ID();?>">
          			<span class="link link_blue link_dashed"><? the_title(); ?></span>
          		</li>
          	<? endwhile; ?>
        </ul>
      </div>
    </div>
  </div>
</section>
<?
	$contacts_post = new WP_Query('name=contact_us');
	$contacts_post_id = $contacts_post->post->ID;
?>
<section class="sect contacts" id="contacts">
  <div class="wrapper">
    <div class="content">
      <div class="sect_icon_img sect_icon_img__contacts contacts_icon sect_icon_animate">
      	<img src="<?=get_stylesheet_directory_uri()?>/images/sect_icon/animate/contacts.gif">
      </div>
      <h2>Контакты</h2>
    </div>
  </div>
  <div class="wrappall clearfix">
    <div class="contacts_maps">
      <div id="yaMap" class="maps"></div>
    </div>
    <div class="contacts_text">
      <div class="contacts_text_row title">
        <h3><?=$contacts_post->post->post_title;?></h3>
      </div>
      <div class="contacts_text_row addr">
        <p class="small">Адрес</p>
        <?=get_field('caddress', $contacts_post_id);?>
      </div>
      <div class="contacts_text_row tel">
        <p class="small">Телефон</p>
        <?=get_field('cphone', $contacts_post_id);?>
      </div>
      <div class="contacts_text_row mail">
        <p class="small">Корпоративная почта</p>
        <p><a class="link link_black" href="mailto:<?=get_field('cemail', $contacts_post_id);?>"><?=get_field('cemail', $contacts_post_id);?></a></p>
      </div>
      <a class="btn btn_cards" href="<?=get_field('cards_p', $contacts_post_id);?>" target="_blank">Скачать карту партнера</a>
    </div>
  </div>
</section>
<footer class="sect footer">
  <div class="bg_gradient bg_gradient1"></div>
  <div class="bg_gradient bg_gradient2"></div>
  <div class="bg_gradient bg_gradient3"></div>
  <div class="bg_gradient bg_gradient4"></div>
  <div class="wrapper">
    <div class="content">
      <div class="footer_block">
        <p class="title">ОАО &laquo;Миякимолзавод&raquo;</p>
        <p class="phone"><span class="phone" data-class="link_gray"><?=get_field('site-phone', $my_site_static_id);?></span></p>
        <p class="inn"><?=get_field('inn-kpp', $my_site_static_id);?></p>
        <p class="ogrn"><?=get_field('ogrn', $my_site_static_id);?></p>
        <p class="address"><?=get_field('site-addr', $my_site_static_id);?></p>
        <p class="copyright">&copy;&nbsp;<?=get_field('copyright', $my_site_static_id);?></p>
        <p class="devel">Сайт разработан в&nbsp;<a class="link link_gray" href="https://promolink.su/" target="_blank">promolink</a></p>
      </div>
    </div>
  </div>
</footer>
<div class="modal_block">
	<? while ($vacancy_posts->have_posts()) : ?>
		<? $vacancy_posts->the_post(); ?>
		<? $vacancy_post_id = get_the_ID(); ?>

  		<div class="modal modal_view vacancy_modal" data-modal-id="vac<?=$vacancy_post_id;?>">
    		<div class="modal_close"></div>
    		<div class="modal_view_body">
      			<div class="modal_title">
        			<h3 class="vacancy_modal_title"><? the_title(); ?> <small><?=get_field('location', $vacancy_post_id);?></small></h3>
        			<p class="vacancy_modal_salary"><?=get_field('salary', $vacancy_post_id);?></p>
      			</div>
	      		<div class="vacancy_modal_caption">
		      		<div class="vacancy_modal_desc right">
			      		<p>Требования:</p>
			      		<?=get_field('requirements', $vacancy_post_id);?>
		      		</div>
		      		<div class="vacancy_modal_desc left">
			      		<p>Обязаности</p>
			      		<?=get_field('responsibilities', $vacancy_post_id);?>
		      		</div>
		      		<div class="vacancy_modal_desc left">
			      		<p>Условия</p>
			      		<?=get_field('conditions', $vacancy_post_id);?>
		      		</div>
			        <form class="vacancy_modal_form" action="" method="post">
			        	<label for="f_name" class="form_label form_label__input">
			        		<input id="f_name" class="form_input__text" type="text" name="name" value="" placeholder="Имя и фамилия">
			        	</label>
			        	<label for="f_phone" class="form_label form_label__input">
			        		<input id="f_phone" class="form_input__text" type="phone" name="phone" value="" placeholder="Телефон">
			        	</label>
			        	<label for="f_mail" class="form_label form_label__input">
			        		<input id="f_mail" class="form_input__text" type="mail" name="mail" value="" placeholder="E-mail">
			        	</label>
			        	<label for="f_resume" class="form_label form_label__input form_label__input_file">
			        		<input id="f_resume" class="opacity0" type="file" name="resume" value="" placeholder="Загрузить резюме">
			        		<div class="file_region">
			        			<p class="file_region_name" data-text="Загрузить резюме">Загрузить резюме</p>
			        			<p class="file_region_caption">в форматах PDF, DOC, DOCX</p>
			        		</div>
			        		<div class="btn btn_file">Обзор</div>
			        	</label>
			        	<input type="hidden" name="vac_name" value="<? the_title(); ?>">
			        	<button class="btn btn_cards btn_vacan">Отклинуться на вакансию</button>
			        </form>
	      		</div>
	      		<div id="modal" data-modal="success" class="vaks display_none"></div>
    		</div>
  		</div>
  	<? endwhile; ?>

	<div class="modal modal_view vacancy_modal vacancy_modal_success" data-modal-id="success">
    	<div class="modal_close"></div>
	    <div class="modal_view_body">
	      <div class="vacancy_modal_caption">
	        <p>Спасибо, мы обязательно свяжемся с вами в ближайшее время</p>
	      </div>
	    </div>
  	</div>

  	<? if(wpmd_is_notdevice() === true) : ?>
	  	<div class="modal modal_view gallery" data-modal-id="gall">
		    <div class="modal_close"></div>
		    <div class="modal_view_body">
		      <div class="gallery_slick_modal">
		      	<? foreach($diploms_image_array as $value) : ?>
			    	<div class="diploms_view_block_gal">
						<img src="<?=$value['image'];?>"/>
						<p><?=$value['caption'];?></p>  
			        </div>
			    <? endforeach; ?>
		      </div>
		    </div>
	  	</div>
  <? endif; ?>
</div>
<div class="modal_fade"></div>


<?php
get_footer();
