<?php
/**
 * Miyakimolzavod functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Miyakimolzavod
 */

if ( ! function_exists( 'miyakimolzavod_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function miyakimolzavod_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Miyakimolzavod, use a find and replace
	 * to change 'miyakimolzavod' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'miyakimolzavod', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'miyakimolzavod' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'miyakimolzavod_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );
}
endif;
add_action( 'after_setup_theme', 'miyakimolzavod_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function miyakimolzavod_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'miyakimolzavod_content_width', 640 );
}
add_action( 'after_setup_theme', 'miyakimolzavod_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function miyakimolzavod_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'miyakimolzavod' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'miyakimolzavod' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'miyakimolzavod_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function miyakimolzavod_scripts() {
	wp_enqueue_style( 'miyakimolzavod-style', get_stylesheet_uri() );

	wp_enqueue_script( 'miyakimolzavod-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'miyakimolzavod-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'miyakimolzavod_scripts' );

function true_load_posts(){
	$args = unserialize(stripslashes($_POST['query']));
	$args['paged'] = $_POST['page'] + 1; // следующая страница
	$args['post_status'] = 'publish';
	$q = new WP_Query($args);
	$npt = get_extended($q->post->post_content);
	if( $q->have_posts() ):
		while($q->have_posts()){
			$q->the_post();

			$image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
			if(!empty($image)) {
			   	$class_news_img = ' is_image';
			} else {
			   	$class_news_img = null;
			}

			$html = '';

		    $html .= '<div class="news_block_view'.$class_news_img.'" data-news-id="'.get_the_ID().'">';
		    	$html .= '<div class="news_block_view_content">';
		    		$html .= '<p class="news_block_view__date">'.get_the_time('d.m.Y').'</p>';
		    		$html .= '<h3 class="news_block_view__title">'.get_the_title().'</h3>';
		    		$html .= '<div class="news_block_view__caption">';
			    		$html .= $npt['main'];
			    		$html .= '<div class="display_none">';
			    		$html .= $npt['extended'];
		    		$html .= '</div>';
		    	$html .= '</div>';
		    
		    if(!empty($image)){
		    	$html .= '<img class="news_block_view__images" src="'.$image.'"/>';
		    }

		    $html .= '</div>';

		    echo $html;
		}
	endif;
	wp_reset_postdata();
	die();
}

add_action('wp_ajax_loadpost', 'true_load_posts');
add_action('wp_ajax_nopriv_loadpost', 'true_load_posts');

function true_pagination_reload(){
	$news_pag_args = array(
		'base' => '%_%',
		'format' => '?page=%#%',
		'current' => $_POST['is_page'],
		'total'=> $_POST['count_page'],
		'mid_size' => 2,
		'prev_next' => true,
		'prev_text' => '&nbsp;',
		'next_text' => '&nbsp;',
		'type' => 'list',
	);
	
	echo paginate_links($news_pag_args);
	#echo '<pre>'.print_r($news_pag_args).'</pre>';
}

add_action('wp_ajax_repagination', 'true_pagination_reload');
add_action('wp_ajax_nopriv_loadpost', 'true_pagination_reload');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load TGM Plugin.
 */
require get_template_directory() . '/tgm/miyakimolzavod.php';
