<?php
/*
 * Plugin Name:       Recent Posts Widget With Thumbnails
 * Plugin URI:        http://wordpress.org/plugins/recent-posts-widget-with-thumbnails/
 * Description:       Small and fast plugin to display in the sidebar a list of linked titles and thumbnails of the most recent postings
 * Version:           7.0.3
 * Requires at least: 2.9
 * Requires PHP:      5.2
 * Author:            Kybernetik Services
 * Author URI:        https://www.kybernetik-services.com/?utm_source=wordpress_org&utm_medium=plugin&utm_campaign=recent-posts-widget-with-thumbnails&utm_content=author
 * Text Domain:       recent-posts-widget-with-thumbnails
 * Domain Path:       /languages
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

/**
 * Recent_Posts_Widget_With_Thumbnails widget class
 *
 * @since 1.0
 */
class Recent_Posts_Widget_With_Thumbnails extends WP_Widget {

	var $defaults;		// default values
	var $bools_false;	// key names of bool variables of value 'false'
	var $bools_true;	// key names of bool variables of value 'true'
	var $ints;			// key names of integer variables of any value
	var $customs;		// user defined values
	var $use_inline_css;// class wide setting, bool type
	var $use_no_css;	// class wide setting, bool type

	function __construct() {
		$language_codes = explode( '_', get_locale() );
		switch ( $language_codes[ 0 ] ) {
			case 'ar':
				$widget_name = 'آخر المقالات مع الصوّر المصغّرة';
				$widget_desc = 'قائمة موقعك المشاركات الأخيرة، مع عنوان نقر والصور المصغرة';
				break;
			case 'fa':
				$widget_name = 'نوشته های اخیر با تصویر بندانگشتی';
				$widget_desc = 'فهرست سایت شما ارسال جدید، با عنوان قابل کلیک و عکسها';
				break;
			case 'de':
				$widget_name = 'Neueste Beitr&auml;ge mit Vorschaubildern';
				$widget_desc = 'Liste deiner aktuellsten Beitr&auml;ge, mit klickbaren &Uuml;berschriften und Vorschaubildern.';
				break;
			case 'pl':
				$widget_name = 'Ostatnie posty z miniaturami';
				$widget_desc = 'Lista ostatnich wpisów twojej strony z klikalnymi tytułami i miniaturami.';
				break;
			case 'ru':
				$widget_name = 'Последние записи с эскизами';
				$widget_desc = 'Список последних сообщений вашего сайта, с заголовком интерактивными и иконками.';
				break;
			case 'tr':
				$widget_name = 'Küçük Resimlerle Son Yazılar';
				$widget_desc = 'Başlık ve küçük resimleri tıklanabilir olan sitenizin en son yazıların listesi.';
				break;
			case 'ja':
				$widget_name = 'Recent Posts With Thumbnails';
				$widget_desc = 'サイトの最新の投稿を、クリック可能なタイトルとサムネイル付きで一覧表示します。';
				break;
			case 'ca':
				$widget_name = 'Publicacions recents amb miniatures';
				$widget_desc = 'Llista de les publicacions més recents del vostre lloc, amb títol i miniatures que es poden fer clic.';
				break;
			default:
				$widget_name = 'Recent Posts With Thumbnails';
				$widget_desc = 'List of your site&#8217;s most recent posts, with clickable title and thumbnails.';
		}
		$this->defaults[ 'author_label' ]		= __( 'By', 'recent-posts-widget-with-thumbnails' );
		$this->defaults[ 'category_ids' ]		= array( 0 ); // selected categories
		$this->defaults[ 'category_label' ]		= _x( 'In', 'In {categories}', 'recent-posts-widget-with-thumbnails' ); // label for category list
		$this->defaults[ 'css_file_path' ]		= dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'public.css'; // path of the public css file
		$this->defaults[ 'excerpt_length' ]		= absint( apply_filters( 'rpwwt_excerpt_length', 55 ) ); // default length: 55 characters
		$this->defaults[ 'excerpt_more' ]		= apply_filters( 'rpwwt_excerpt_more', ' ' . '[&hellip;]' ); // set ellipses as default 'more'
		$this->defaults[ 'is_nav_widget' ]		= current_theme_supports( 'html5', 'navigation-widgets' ); // available support of navigation in widgets (NAV element for more accessibility), since WP 5.5
		$this->defaults[ 'nav_label' ]			= __( 'Recent Posts With Thumbnails', 'recent-posts-widget-with-thumbnails' ); // ARIA label of the navigation list
		$this->defaults[ 'number_posts' ]		= 5; // number of posts to show in the widget
		$this->defaults[ 'plugin_slug' ]		= 'recent-posts-widget-with-thumbnails'; // identifier of this plugin for WP
		$this->defaults[ 'plugin_version' ]		= '7.0.2'; // current plugin version
		$this->defaults[ 'post_title_length' ] 	= 1000; // default length: 1000 characters
		$this->defaults[ 'thumb_alt' ]			= '';
		$this->defaults[ 'thumb_dimensions' ]	= 'custom'; // dimensions of the thumbnail
		$this->defaults[ 'thumb_height' ] 		= absint( round( get_option( 'thumbnail_size_h', 110 ) / 2 ) ); // custom height of the thumbnail
		$this->defaults[ 'thumb_url' ]			= plugins_url( 'default_thumb.gif', __FILE__ ); // URL of the default thumbnail
		$this->defaults[ 'thumb_width' ]		= absint( round( get_option( 'thumbnail_size_w', 110 ) / 2 ) ); // custom width of the thumbnail
		$this->defaults[ 'widget_title' ]		= ''; // title of the widget
		// Domain name and protocol of WP site
		$parsed_url = parse_url( home_url() );
		$this->defaults[ 'site_protocol' ]		= $parsed_url[ 'host' ];
		$this->defaults[ 'site_url' ]			= $parsed_url[ 'scheme' ];
		unset( $parsed_url );
		// other vars
		$this->bools_false						= array( 'hide_current_post', 'only_sticky_posts', 'hide_sticky_posts', 'hide_title', 'keep_aspect_ratio', 'keep_sticky', 'only_1st_img', 'random_order', 'show_author', 'show_categories', 'show_comments_number', 'show_date', 'show_excerpt', 'ignore_excerpt', 'ignore_post_content_excerpt', 'set_more_as_link', 'try_1st_img', 'use_default', 'use_default_only', 'open_new_window', 'print_post_categories', 'set_cats_as_links', 'use_inline_css', 'use_no_css', 'hide_alt_texts' );
		$this->bools_true						= array( 'show_thumb' );
		$this->ints 							= array( 'excerpt_length', 'number_posts', 'post_title_length', 'thumb_height', 'thumb_width' );
		$this->valid_excerpt_sources			= array( 'post_content', 'excerpt_field' );
		$this->optional_text_fields				= array( 'author_label', 'excerpt_more', 'category_label', 'thumb_alt' );
		$widget_ops 							= array( 'classname' => $this->defaults[ 'plugin_slug' ], 'description' => $widget_desc );
		parent::__construct( $this->defaults[ 'plugin_slug' ], $widget_name, $widget_ops );

		add_action( 'admin_init',				array( $this, 'load_plugin_textdomain' ) );
		add_action( 'save_post',				array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post',				array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme',				array( $this, 'flush_widget_cache' ) );
		add_action( 'wp_enqueue_scripts',		array( $this, 'enqueue_public_style' ) );
		add_action( 'admin_enqueue_scripts',	array( $this, 'enqueue_admin_style' ) );

		// not in use, just for the po-editor to display the translation on the plugins overview list
		$widget_name = __( 'Recent Posts With Thumbnails', 'recent-posts-widget-with-thumbnails' );
		$widget_desc = __( 'List of your site&#8217;s most recent posts, with clickable title and thumbnails.', 'recent-posts-widget-with-thumbnails' );

	}

	function widget( $args, $instance ) {
		global $post;

		if ( ! isset( $args[ 'widget_id' ] ) ) {
			$args[ 'widget_id' ] = $this->id;
		}

		// get and sanitize values
		$title					= ( ! empty( $instance[ 'title' ] ) )				? $instance[ 'title' ]									: $this->defaults[ 'widget_title' ];
		$title					= apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$category_ids 			= ( ! empty( $instance[ 'category_ids' ] ) )		? array_map( 'absint', $instance[ 'category_ids' ] )	: $this->defaults[ 'category_ids' ];
		$default_url 			= ( ! empty( $instance[ 'default_url' ] ) )			? $instance[ 'default_url' ]							: $this->defaults[ 'thumb_url' ];
		$thumb_dimensions		= ( ! empty( $instance[ 'thumb_dimensions' ] ) )	? $instance[ 'thumb_dimensions' ]						: $this->defaults[ 'thumb_dimensions' ];
		// initialize integer variables
		$ints = array();
		foreach ( $this->ints as $key ) {
			$ints[ $key ] = ( ! empty( $instance[ $key ] ) ) ? absint( $instance[ $key ] ) : $this->defaults[ $key ];
		}
		// initialize bool variables
		$bools = array();
		foreach ( $this->bools_false as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : false;
		}
		foreach ( $this->bools_true as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : false;
		}
		// special case: class wide setting
		$this->use_inline_css = $bools[ 'use_inline_css' ];
		$this->use_no_css = $bools[ 'use_no_css' ];
		// if 'all categories' was selected ignore other selections of categories
		if ( in_array( 0, $category_ids ) ) {
			$category_ids = $this->defaults[ 'category_ids' ];
		}
		// if no URL take default URL
		if ( '' == esc_url_raw( $default_url ) ) {
			$default_url = $this->defaults[ 'thumb_url' ];
		}

		// standard params
		$query_args = array(
			'posts_per_page'      => $ints[ 'number_posts' ],
			'no_found_rows'       => true,
			'post_status'         => 'publish',
		);
		
		// set order of posts in widget
		$query_args[ 'orderby' ] = ( $bools[ 'random_order' ] ) ? 'rand' : 'date';
		//$query_args[ 'orderby' ] = ( $bools[ 'random_order' ] ) ? 'rand' : 'menu_order, post_date';
		$query_args[ 'order' ] = 'DESC';
		
		// add categories param only if 'all categories' was not selected
		if ( ! in_array( 0, $category_ids ) ) {
			$query_args[ 'category__in' ] = $category_ids;
		}
		
		// exclude current displayed post
		if ( $bools[ 'hide_current_post' ] ) {
			if ( isset( $post->ID ) and is_singular() ) {
				$query_args[ 'post__not_in' ] = array( $post->ID );
			}
		}

		// ignore sticky posts if desired, else show them on top
		$query_args[ 'ignore_sticky_posts' ] = ( $bools[ 'keep_sticky' ] ) ? false : true;
		
		// exclude sticky posts
		if ( $bools[ 'only_sticky_posts' ] ) {
			// set the filter with IDs of sticky posts
	        $query_args[ 'post__in' ] = get_option( 'sticky_posts', array() );
			// The next line appears illogical in comparison with the 
			// previous line, but is necessary to display the correct 
			// number of posts if the number of sticky posts is greater 
			// than the number of posts to be displayed.
			$query_args[ 'ignore_sticky_posts' ] = true;
		} elseif ( $bools[ 'hide_sticky_posts' ] ) {
			// get IDs of sticky posts
			$post_ids = get_option( 'sticky_posts', array() );
			// if there are sticky posts
			if ( $post_ids ) {
				// if argument 'post__not_in' is defined
				if ( isset( $query_args[ 'post__not_in' ] ) ) {
					// merge argument arrays
					$tmp1 = array_merge( $query_args[ 'post__not_in' ], $post_ids );
					// make post IDs in array unique by using a faster way than array_unique()
					$tmp2 = array(); 
					foreach( $tmp1 as $key => $val ) {    
						$tmp2[ $val ] = true; 
					}
					// set argument with cleaned array
					$query_args[ 'post__not_in' ] = array_keys( $tmp2 );
					// delete temporary variables
					unset( $tmp1, $tmp2 );
				} else {
					// set argument with array of post IDs
					$query_args[ 'post__not_in' ] = $post_ids;
				}
			}
			// delete temporary variable
			unset( $post_ids );
		}

		// apply correction function if query includes sticky posts and categories filter
		if ( isset( $query_args[ 'category__in' ] ) and $bools[ 'keep_sticky' ] ) {
			add_filter( 'the_posts', array( $this, 'get_stickies_on_top' ) );
		}
		
		// run the query: get the latest posts
		$r = new WP_Query( apply_filters( 'rpwwt_widget_posts_args', $query_args ) );

		// remove correction function if query includes sticky posts and categories filter
		if ( isset( $query_args[ 'category__in' ] ) and $bools[ 'keep_sticky' ] ) {
			remove_filter( 'the_posts', array( $this, 'get_stickies_on_top' ) );
		}
		
		if ( $r->have_posts() ) :
		
			// translate repeately used texts once (for more performance)
			$text = ', ';
			$this->defaults[ 'comma' ] = __( $text );
			$text = '&hellip;';
			$this->defaults[ 'ellipses' ] = __( $text );
			$text = '(no title)';
			$this->defaults[ 'no_title' ] = __( $text );
			$text = 'Post';
			$this->defaults[ 'Post' ] = _x( $text, 'post type singular name' );
			
			// get current post ID
			$queried_object_id = get_queried_object_id();

			// set the desired image dimensions
			if ( 'custom' == $thumb_dimensions ) {
				// set dimensions with specified size array
				$this->customs[ 'thumb_dimensions' ] = array( $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] );
			} else {
				// overwrite thumb_width and thumb_height with closest size
				list( $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] ) = $this->get_image_dimensions( $thumb_dimensions );
				// set dimensions with specified size name
				$this->customs[ 'thumb_dimensions' ] = $thumb_dimensions;
			}

			// for some text fields: let there be an empty fields if desired
			foreach ( $this->optional_text_fields as $field ) {
				if ( isset( $instance[ $field ] ) ) {
					if ( '' === $instance[ $field ] ) {
						$this->customs[ $field ] = '';
					} else {
						$this->customs[ $field ] = $instance[ $field ];
					}
				} else {
					$this->customs[ $field ] = $this->defaults[ $field ];
				}
			}

			// set other global vars
			$this->customs[ 'ignore_excerpt' ]		= $bools[ 'ignore_excerpt' ]; // whether to ignore post excerpt field or not
			$this->customs[ 'ignore_post_content_excerpt' ]		= $bools[ 'ignore_post_content_excerpt' ]; // whether to ignore post content or not
			$this->customs[ 'set_more_as_link' ]	= $bools[ 'set_more_as_link' ]; // whether to set 'more' signs as link or not
			$this->customs[ 'set_cats_as_links' ]	= $bools[ 'set_cats_as_links' ]; // whether to set category names as links or not
			$this->customs[ 'excerpt_length' ]		= $ints[ 'excerpt_length' ]; // number of characters of excerpt
			$this->customs[ 'post_title_length' ]	= $ints[ 'post_title_length' ]; // maximum number of characters of post title

			// set default image code
			$default_attr = array(
				'src'		=> esc_url( $default_url ),
				'class'		=> sprintf( "attachment-%dx%d", $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] ),
				'alt'		=> $bools[ 'hide_alt_texts' ] ? '' : esc_attr( $this->customs[ 'thumb_alt' ] ),
				'loading'	=> 'lazy',
			);
			$default_img = '<img ';
			$default_img .= rtrim( image_hwstring( $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] ) );
			foreach ( $default_attr as $name => $value ) {
				$default_img .= ' ' . $name . '="' . $value . '"';
			}
			$default_img .= ' />';
			
			// set link target
			if ( $bools[ 'open_new_window' ] ) {
				$this->customs[ 'link_target' ] = ' target="_blank"';
			} else {
				$this->customs[ 'link_target' ] = '';
			}
			
			//set image attributes
			$attr = '';
			if ( $bools[ 'hide_alt_texts' ] ) {
				$attr = array( 'alt' => '' );
			}
			
			// print list
			include 'includes/widget.php';

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

	}

	function update( $new_widget_settings, $old_widget_settings ) {
		$instance = $old_widget_settings;
		// sanitize user input before update
		$instance[ 'title' ] 				= ( isset( $new_widget_settings[ 'title' ] ) )					? strip_tags( $new_widget_settings[ 'title' ] )						: $this->defaults[ 'widget_title' ];
		$instance[ 'default_url' ] 			= ( isset( $new_widget_settings[ 'default_url' ] ) )			? esc_url_raw( $new_widget_settings[ 'default_url' ] )				: $this->defaults[ 'thumb_url' ];
		$instance[ 'thumb_dimensions' ] 	= ( isset( $new_widget_settings[ 'thumb_dimensions' ] ) )		? strip_tags( $new_widget_settings[ 'thumb_dimensions' ] )			: $this->defaults[ 'thumb_dimensions' ];
		$instance[ 'category_ids' ]   		= ( isset( $new_widget_settings[ 'category_ids' ] ) )			? array_map( 'absint', $new_widget_settings[ 'category_ids' ] )		: $this->defaults[ 'category_ids' ];
		// initialize integer variables
		foreach ( $this->ints as $key ) {
			$instance[ $key ] = ( isset( $new_widget_settings[ $key ] ) ) ? absint( $new_widget_settings[ $key ] ) : $this->defaults[ $key ];
		}
		// initialize bool variables
		foreach ( $this->bools_false as $key ) {
			$instance[ $key ] = ( isset( $new_widget_settings[ $key ] ) ) ? (bool) $new_widget_settings[ $key ] : false;
		}
		foreach ( $this->bools_true as $key ) {
			$instance[ $key ] = ( isset( $new_widget_settings[ $key ] ) ) ? (bool) $new_widget_settings[ $key ] : false;
		}

		// for some text fields: let there be an empty fields if desired
		foreach ( $this->optional_text_fields as $field ) {
			if ( isset( $new_widget_settings[ $field ] ) ) {
				if ( '' == $new_widget_settings[ $field ] ) {
					$instance[ $field ] = '';
				} else {
					$instance[ $field ] = $new_widget_settings[ $field ];
				}
			} else {
				$instance[ $field ] = $this->defaults[ $field ];
			}
		}

		// if 'all categories' was selected ignore other selections of categories
		if ( in_array( 0, $instance[ 'category_ids' ] ) ) {
			$instance[ 'category_ids' ] = $this->defaults[ 'category_ids' ];
		}
		
		// empty widget cache
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions[ $this->defaults[ 'plugin_slug' ] ] ) ) {
			delete_option( $this->defaults[ 'plugin_slug' ] );
		}

		// delete current css file to let make new one via $this->enqueue_public_style()
		if ( file_exists( $this->defaults[ 'css_file_path' ] ) ) {
			// remove the file
			unlink( $this->defaults[ 'css_file_path' ] );
		}

		// return sanitized current widget settings
		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( $this->defaults[ 'plugin_slug' ], 'widget' );
	}

	function form( $instance ) {
		// get and sanitize values
		$title					= ( isset( $instance[ 'title' ] ) ) 				? $instance[ 'title' ]				: $this->defaults[ 'widget_title' ];
		$thumb_dimensions		= ( isset( $instance[ 'thumb_dimensions' ] ) )		? $instance[ 'thumb_dimensions' ]	: $this->defaults[ 'thumb_dimensions' ];
		$default_url			= ( isset( $instance[ 'default_url' ] ) )			? $instance[ 'default_url' ]		: $this->defaults[ 'thumb_url' ];
		$category_ids			= ( isset( $instance[ 'category_ids' ] ) )			? $instance[ 'category_ids' ]		: $this->defaults[ 'category_ids' ];
		// initialize integer variables
		$ints = array();
		foreach ( $this->ints as $key ) {
			$ints[ $key ] = ( isset( $instance[ $key ] ) ) ? absint( $instance[ $key ] ) : $this->defaults[ $key ];
		}
		// initialize bool variables
		$bools = array();
		foreach ( $this->bools_false as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : false;
		}
		foreach ( $this->bools_true as $key ) {
			$bools[ $key ] = ( isset( $instance[ $key ] ) ) ? (bool) $instance[ $key ] : true;
		}

		// for some text fields: let there be an empty fields if desired
		foreach ( $this->optional_text_fields as $field ) {
			if ( isset( $instance[ $field ] ) ) {
				if ( '' == $instance[ $field ] ) {
					$optional_texts[ $field ] = '';
				} else {
					$optional_texts[ $field ] = $instance[ $field ];
				}
			} else {
				$optional_texts[ $field ] = $this->defaults[ $field ];
			}
		}

		// if 'all categories' was selected ignore other selections of categories
		if ( in_array( 0, $category_ids ) ) {
			$category_ids = $this->defaults[ 'category_ids' ];
		}
		// if no URL take default URL
		if ( '' == esc_url_raw( $default_url ) ) {
			$default_url = $this->defaults[ 'thumb_url' ];
		}

		// compute ids only once to improve performance
		$field_ids = array();
		$field_ids[ 'author_label' ]	= $this->get_field_id( 'author_label' );
		$field_ids[ 'category_ids' ]	= $this->get_field_id( 'category_ids' );
		$field_ids[ 'category_label' ]	= $this->get_field_id( 'category_label' );
		$field_ids[ 'default_url' ]		= $this->get_field_id( 'default_url' );
		$field_ids[ 'excerpt_more' ]	= $this->get_field_id( 'excerpt_more' );
		$field_ids[ 'thumb_alt' ]		= $this->get_field_id( 'thumb_alt' );
		$field_ids[ 'thumb_dimensions' ]= $this->get_field_id( 'thumb_dimensions' );
		$field_ids[ 'title' ]			= $this->get_field_id( 'title' );
		foreach ( array_merge( $this->ints, $this->bools_false, $this->bools_true ) as $key ) {
			$field_ids[ $key ] = $this->get_field_id( $key );
		}
		
		// get texts and values for image sizes dropdown
		global $_wp_additional_image_sizes;
		$wp_standard_image_size_labels = array();
		$label = 'Full Size';	$wp_standard_image_size_labels[ 'full' ]		= __( $label );
		$label = 'Large';		$wp_standard_image_size_labels[ 'large' ]		= __( $label );
		$label = 'Medium';		$wp_standard_image_size_labels[ 'medium' ]		= __( $label );
		$label = 'Thumbnail';	$wp_standard_image_size_labels[ 'thumbnail' ]	= __( $label );
		
		$wp_standard_image_size_names = array_keys( $wp_standard_image_size_labels );
		$size_options = array();
		foreach ( get_intermediate_image_sizes() as $size_name ) {
			// Don't take numeric sizes that appear
			if( is_integer( $size_name ) ) {
				continue;
			}
			$option_values = array();
			// Set technical name
			$option_values[ 'size_name' ] = $size_name;
			// Set name
			$option_values[ 'name' ] = in_array( $size_name, $wp_standard_image_size_names ) ? $wp_standard_image_size_labels[$size_name] : $size_name;
			// Set width
			$option_values[ 'width' ] = isset( $_wp_additional_image_sizes[$size_name]['width'] ) ? $_wp_additional_image_sizes[$size_name]['width'] : get_option( "{$size_name}_size_w" );
			// Set height
			$option_values[ 'height' ] = isset( $_wp_additional_image_sizes[$size_name]['height'] ) ? $_wp_additional_image_sizes[$size_name]['height'] : get_option( "{$size_name}_size_h" );
			// add option to options list
			$size_options[] = $option_values;
		}
		
		// create text to Media Settings page
		$text = 'Settings';	$label_settings	= __( $text );
		$text = 'Media';	$label_media	= _x( $text, 'post type general name' );
		$label = sprintf( '%s &rsaquo; %s', $label_settings, $label_media );
		$media_trail = ( current_user_can( 'manage_options' ) ) ? sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( admin_url( 'options-media.php' ) ), esc_html( $label ) ) : sprintf( '<em>%s</em>', esc_html( $label ) );

		// get texts and values for categories dropdown
		#$none_text = 'All Categories';
		$all_text = 'All Categories';
		$label_all_cats = __( $all_text );

		// get categories
		$categories = get_categories( array( 'hide_empty' => 0, 'hierarchical' => 1 ) );
		$number_of_cats = count( $categories );
		
		// get size (number of rows to display) of selection box: not more than 10
		$number_of_rows = ( 10 > $number_of_cats ) ? $number_of_cats + 1 : 10;

		// start selection box
		$selection_element = sprintf(
			'<select name="%s[]" id="%s" class="rpwwt-cat-select" multiple size="%d">',
			$this->get_field_name( 'category_ids' ),
			$field_ids[ 'category_ids' ],
			$number_of_rows
		);
		$selection_element .= "\n";

		// make selection box entries
		$cat_list = array();
		if ( 0 < $number_of_cats ) {

			// make a hierarchical list of categories
			while ( $categories ) {
				// go on with the first element in the categories list:
				// if there is no parent
				if ( '0' == $categories[ 0 ]->parent ) {
					// get and remove it from the categories list
					$current_entry = array_shift( $categories );
					// append the current entry to the new list
					$cat_list[] = array(
						'id'	=> absint( $current_entry->term_id ),
						'name'	=> esc_html( $current_entry->name ),
						'depth'	=> 0
					);
					// go on looping
					continue;
				}
				// if there is a parent:
				// try to find parent in new list and get its array index
				$parent_index = $this->get_cat_parent_index( $cat_list, $categories[ 0 ]->parent );
				// if parent is not yet in the new list: try to find the parent later in the loop
				if ( false === $parent_index ) {
					// get and remove current entry from the categories list
					$current_entry = array_shift( $categories );
					// append it at the end of the categories list
					$categories[] = $current_entry;
					// go on looping
					continue;
				}
				// if there is a parent and parent is in new list:
				// set depth of current item: +1 of parent's depth
				$depth = $cat_list[ $parent_index ][ 'depth' ] + 1;
				// set new index as next to parent index
				$new_index = $parent_index + 1;
				// find the correct index where to insert the current item
				foreach( $cat_list as $entry ) {
					// if there are items with same or higher depth than current item
					if ( $depth <= $entry[ 'depth' ] ) {
						// increase new index
						$new_index = $new_index + 1;
						// go on looping in foreach()
						continue;
					}
					// if the correct index is found:
					// get current entry and remove it from the categories list
					$current_entry = array_shift( $categories );
					// insert current item into the new list at correct index
					$end_array = array_splice( $cat_list, $new_index ); // $cat_list is changed, too
					$cat_list[] = array(
						'id'	=> absint( $current_entry->term_id ),
						'name'	=> esc_html( $current_entry->name ),
						'depth'	=> $depth
					);
					$cat_list = array_merge( $cat_list, $end_array );
					// quit foreach(), go on while-looping
					break;
				} // foreach( cat_list )
			} // while( categories )

			// make HTML of selection box
			$selected = ( in_array( 0, $category_ids ) ) ? ' selected="selected"' : '';
			$selection_element .= "\t";
			$selection_element .= '<option value="0"' . $selected . '>' . $label_all_cats . '</option>';
			$selection_element .= "\n";

			foreach ( $cat_list as $category ) {
				$cat_name = apply_filters( 'rpwwt_list_cats', $category[ 'name' ], $category );
				$pad = ( 0 < $category[ 'depth' ] ) ? str_repeat('&ndash;&nbsp;', $category[ 'depth' ] ) : '';
				$selection_element .= "\t";
				$selection_element .= '<option value="' . $category[ 'id' ] . '"';
				$selection_element .= ( in_array( $category[ 'id' ], $category_ids ) ) ? ' selected="selected"' : '';
				$selection_element .= '>' . $pad . $cat_name . '</option>';
				$selection_element .= "\n";
			}
			
		}

		// close selection box
		$selection_element .= "</select>\n";
		
		// print form in widgets page
		include 'includes/form.php';

	}
	
	/**
	 * Return the array index of a given ID
	 *
	 * @since 4.1
	 */
	private function get_cat_parent_index( $arr, $id ) {
		$len = count( $arr );
		if ( 0 == $len ) {
			return false;
		}
		$id = absint( $id );
		for ( $i = 0; $i < $len; $i++ ) {
			if ( $id == $arr[ $i ][ 'id' ] ) {
				return $i;
			}
		}
		return false; 
	}
	
	/**
	 * Load the widget's CSS in the HEAD section of the frontend
	 *
	 * @since 2.3
	 */
	public function enqueue_public_style () {
		
		$is_file = false;
		$css_code = '';
		// make sure the CSS file exists; if not available: generate it
		if ( file_exists( $this->defaults[ 'css_file_path' ] ) ) {
			$is_file = true;
		} else {
			// get stored settings
			$all_settings = $this->get_settings();
			// quit if at least 1 widget was set for no CSS at all
			foreach ( $all_settings as $id => $settings ) {
				if ( isset( $settings[ 'use_no_css' ] ) and $settings[ 'use_no_css' ] ) {
					return;
				}
			} // foreach ( $all_settings as $id => $settings )

			// get the CSS code
			list( $css_code, $use_inline_css ) = $this->generate_css_code( $all_settings );
			// if not to print the CSS as inline code in the HTML document
			if ( ! $use_inline_css ) {
				// write file safely
				if ( @file_put_contents( $this->defaults[ 'css_file_path' ], $css_code ) ) {
					// file writing was successfull, so change file permissions
					chmod( $this->defaults[ 'css_file_path' ], 0644 );
					$is_file = true;
				} // if CSS file successfully created
			} // if no inline CSS
		} // if CSS file exists
			
		// if there is a CSS file
		if ( $is_file ) {
			// enqueue the CSS file
			wp_enqueue_style(
				$this->defaults[ 'plugin_slug' ] . '-public-style',
				plugin_dir_url( __FILE__ ) . 'public.css',
				array(),
				$this->defaults[ 'plugin_version' ],
				'all' 
			);
		} else {
			// print inline CSS
			print "\n<!-- Recent Posts Widget With Thumbnails: inline CSS -->\n";
			printf( "<style type='text/css'>\n%s</style>\n", $css_code );
		} // if $is_file
	}

	/**
	 * Load the widget's CSS in the HEAD section of the backend
	 *
	 * @since 4.0
	 */
	public function enqueue_admin_style () {
		// load CSS file on Widgets page only
		$screen = get_current_screen();
		if ( 'widgets' == $screen->id ) {
			// enqueue the style
			wp_enqueue_style(
				$this->defaults[ 'plugin_slug' ] . '-admin-style',
				plugin_dir_url( __FILE__ ) . 'admin.css',
				array(),
				$this->defaults[ 'plugin_version' ],
				'all' 
			);
		}
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain( 'recent-posts-widget-with-thumbnails', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	}

	/**
	 * Returns the id of the first image in the content, else 0
	 *
	 * @access   private
	 * @since     2.0
	 *
	 * @return    integer    the post id of the first content image
	 */
	private function get_first_content_image_id () {
		// set variables
		global $wpdb;
		$post = get_post();
		if ( $post and isset( $post->post_content ) ) {
			// look for images in HTML code
			preg_match_all( '/<img[^>]+>/i', $post->post_content, $all_img_tags );
			if ( $all_img_tags ) {
				foreach ( $all_img_tags[ 0 ] as $img_tag ) {
					// find class attribute and catch its value
					preg_match( '/<img.*?class\s*=\s*[\'"]([^\'"]+)[\'"][^>]*>/i', $img_tag, $img_class );
					if ( $img_class ) {
						// Look for the WP image id
						preg_match( '/wp-image-([\d]+)/i', $img_class[ 1 ], $thumb_id );
						// if first image id found: check whether is image
						if ( $thumb_id ) {
							$img_id = absint( $thumb_id[ 1 ] );
							// if is image: return its id
							if ( wp_attachment_is_image( $img_id ) ) {
								return $img_id;
							}
						} // if(thumb_id)
					} // if(img_class)
					
					// else: try to catch image id by its url as stored in the database
					// find src attribute and catch its value
					preg_match( '/<img.*?src\s*=\s*[\'"]([^\'"]+)[\'"][^>]*>/i', $img_tag, $img_src );
					if ( $img_src ) {
						// delete optional query string in img src
						$url = preg_replace( '/([^?]+).*/', '\1', $img_src[ 1 ] );
						// delete image dimensions data in img file name, just take base name and extension
						$url = preg_replace( '/(.+)-\d+x\d+\.(\w+)/', '\1.\2', $url );
						// if path is protocol relative then set it absolute
						if ( 0 === strpos( $url, '//' ) ) {
							$url = $this->defaults[ 'site_protocol' ] . ':' . $url;
						// if path is domain relative then set it absolute
						} elseif ( 0 === strpos( $url, '/' ) ) {
							$url = $this->defaults[ 'site_url' ] . $url;
						}
						// look up its id in the db
						$thumb_id = $wpdb->get_var( $wpdb->prepare( "SELECT `ID` FROM $wpdb->posts WHERE `guid` = '%s'", $url ) );
						// if id is available: return it
						if ( $thumb_id ) {
							return absint( $thumb_id );
						} // if(thumb_id)
					} // if(img_src)
				} // foreach(img_tag)
			} // if(all_img_tags)
		} // if (post content)
		
		// if nothing found: return 0
		return 0;
	}

	/**
	 * Returns the thumbnail of first post's image or empty string on failure
	 *
	 * @access   private
	 * @since     2.0
	 *
	 * @return    bool    success on finding an image
	 */
	private function the_first_post_image ( $attr ) {
		// look for first image
		$thumb_id = $this->get_first_content_image_id();
		// if there is first image then show first image
		if ( $thumb_id ) :
			return wp_get_attachment_image( $thumb_id, $this->customs[ 'thumb_dimensions' ], $attr );
		else :
			return '';
		endif; // thumb_id
	}

	/**
	 * Returns the assigned categories of a post in a string
	 *
	 * @access   private
	 * @since     4.6
	 *
	 */
	private function get_the_categories ( $id ) {
		$terms = get_the_terms( $id, 'category' );

		if ( is_wp_error( $terms ) ) {
			return __( 'Error on listing categories', 'recent-posts-widget-with-thumbnails' );
		}

		if ( empty( $terms ) ) {
			$text = 'No categories';
			return __( $text );
		}

		$categories = array();

		if ( $this->customs[ 'set_cats_as_links' ] ) {
			foreach ( $terms as $term ) {
				// get link to category
				$categories[] = sprintf(
					'<a href="%s">%s</a>',
					get_category_link( $term->term_id ),
					esc_html( $term->name )
				);
			}
		} else {
			foreach ( $terms as $term ) {
				// get sanitized category name
				$categories[] = esc_html( $term->name );
			}
		}
		/*foreach ( $terms as $term ) {
			$categories[] = $term->name;
		}*/

		$string = '';
		if ( $this->customs[ 'category_label' ] ) {
			$string = $this->customs[ 'category_label' ] . ' ';
		}
		$string .= join( $this->defaults[ 'comma' ], $categories );
		
		return apply_filters( 'rpwwt_categories', $string );
	}

	/**
	 * Returns the assigned author of a post in a string
	 *
	 * @access   private
	 * @since     4.8
	 *
	 */
	private function get_the_author () {
		$author = get_the_author();

		if ( empty( $author ) ) {
			return '';
		} else {
			$string = '';
			if ( $this->customs[ 'author_label' ] ) {
				$string = $this->customs[ 'author_label' ] . ' ';
			}
			return $string . $author;
			
			//return sprintf( $this->defaults[ 'author_label' ], $author );
		}

	}

	/**
	 * Generate the css code with stored settings
	 *
	 * @since 2.3
	 */
	private function generate_css_code ( $all_instances ) {

		$set_default = true;
		$ints = array();
		$use_inline_css = false;

		// generate CSS
		$css_code  = ".rpwwt-widget ul { list-style: outside none none; margin-left: 0; margin-right: 0; padding-left: 0; padding-right: 0; }\n"; 
		$css_code .= ".rpwwt-widget ul li { overflow: hidden; margin: 0 0 1.5em; }\n"; 
		$css_code .= ".rpwwt-widget ul li:last-child { margin: 0; }\n"; 
		$css_code .= ".rpwwt-widget .screen-reader-text {border: 0; clip: rect(1px, 1px, 1px, 1px); -webkit-clip-path: inset(50%); clip-path: inset(50%); height: 1px; margin: -1px; overflow: hidden; padding: 0; position: absolute !important; width: 1px; word-wrap: normal !important; word-break: normal; }\n";
		$css_code .= ".rpwwt-widget .screen-reader-text:focus {background-color: #f1f1f1; border-radius: 3px; box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.6); clip: auto !important; -webkit-clip-path: none; clip-path: none; color: #21759b; display: block; font-size: 0.875rem; font-weight: 700; height: auto; right: 5px; line-height: normal; padding: 15px 23px 14px; text-decoration: none; top: 5px; width: auto; z-index: 100000; }\n";
		
		if ( is_rtl() ) {
			$css_code .= ".rpwwt-widget ul li img { display: inline; float: right; margin: .3em 0 .75em .75em; }\n";
		} else {
			$css_code .= ".rpwwt-widget ul li img { display: inline; float: left; margin: .3em .75em .75em 0; }\n";
		}

		foreach ( $all_instances as $number => $settings ) {
			// set width and height
			$ints[ 'thumb_width' ] = $this->defaults[ 'thumb_width' ];
			$ints[ 'thumb_height' ] = $this->defaults[ 'thumb_height' ];
			$thumb_dimensions = isset( $settings[ 'thumb_dimensions' ] ) ? $settings[ 'thumb_dimensions' ] : $this->defaults[ 'thumb_dimensions' ];
			if ( 'custom' == $thumb_dimensions ) {
				if ( isset( $settings[ 'thumb_width' ] ) ) {
					$ints[ 'thumb_width' ]  = absint( $settings[ 'thumb_width' ]  );
				}
				if ( isset( $settings[ 'thumb_height' ] ) ) {
					$ints[ 'thumb_height' ] = absint( $settings[ 'thumb_height' ] );
				}
			} else {
				list( $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] ) = $this->get_image_dimensions( $thumb_dimensions );
			} // $settings[ 'thumb_dimensions' ]
			// get aspect ratio option
			$bools[ 'keep_aspect_ratio' ] = false;
			if ( isset( $settings[ 'keep_aspect_ratio' ] ) ) {
				$bools[ 'keep_aspect_ratio' ] = (bool) $settings[ 'keep_aspect_ratio' ];
				// set CSS code
				if ( $bools[ 'keep_aspect_ratio' ] ) {
					$css_code .= sprintf( '#rpwwt-%s-%d img { max-width: %dpx; width: 100%%; height: auto; }', $this->defaults[ 'plugin_slug' ], $number, $ints[ 'thumb_width' ] );
					$css_code .= "\n"; 
				} else {
					$css_code .= sprintf( '#rpwwt-%s-%d img { width: %dpx; height: %dpx; }', $this->defaults[ 'plugin_slug' ], $number, $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] );
					$css_code .= "\n"; 
				}
			} else {
				$css_code .= sprintf( '#rpwwt-%s-%d img { width: %dpx; height: %dpx; }', $this->defaults[ 'plugin_slug' ], $number, $ints[ 'thumb_width' ], $ints[ 'thumb_height' ] );
				$css_code .= "\n"; 
			}
			// override default code
			$set_default = false;
			// inline CSS if at least 1 widget was set for that
			if ( isset( $settings[ 'use_inline_css' ] ) ) {
				$bools[ 'use_inline_css' ] = (bool) $settings[ 'use_inline_css' ];
				if ( $bools[ 'use_inline_css' ] ) {
					$use_inline_css = true;
				}
			}

		} // foreach ( $all_instances as $number => $settings )
		// set at least this statement if no settings are stored
		if ( $set_default ) {
			$css_code .= sprintf( '.rpwwt-widget ul li img { width: %dpx; height: %dpx; }', $this->defaults[ 'thumb_width' ], $this->defaults[ 'thumb_height' ] );
			$css_code .= "\n"; 
		}
		
		return array( $css_code, $use_inline_css );
	}

	/**
	 * Returns the shortened excerpt, must use in a loop.
	 *
	 * @since 3.0
	 */
	private function get_the_trimmed_excerpt () {
		
		$post = get_post();
								
		if ( empty( $post ) ) {
			return '';
		}

		$excerpt = '';
		
		if ( post_password_required( $post ) ) {
			$excerpt = 'There is no excerpt because this is a protected post.';
			return esc_html__( $excerpt );
		}

		// get excerpt from text field if desired
		if ( ! $this->customs[ 'ignore_excerpt' ] ) {
			$excerpt = apply_filters( 'rpwwt_the_excerpt', $post->post_excerpt, $post );
		}
		
		// text processings if no manual excerpt is available
		if ( empty( $excerpt ) and ! $this->customs[ 'ignore_post_content_excerpt' ] ) {

			// get excerpt from post content
			$excerpt = strip_shortcodes( get_the_content( '' ) );
			$excerpt = apply_filters( 'the_excerpt', $excerpt );
			$excerpt = str_replace( ']]>', ']]&gt;', $excerpt );
			$excerpt = wp_trim_words( $excerpt, $this->customs[ 'excerpt_length' ], $this->customs[ 'excerpt_more' ] );
			
			// if excerpt is longer than desired
			if ( mb_strlen( $excerpt ) > $this->customs[ 'excerpt_length' ] ) {
				// get excerpt in desired length
				$sub_excerpt = mb_substr( $excerpt, 0, $this->customs[ 'excerpt_length' ] );
				// get array of shortened excerpt words
				$excerpt_words = explode( ' ', $sub_excerpt );
				// get the length of the last word in the shortened excerpt
				$excerpt_cut = - ( mb_strlen( $excerpt_words[ count( $excerpt_words ) - 1 ] ) );
				// if there is no empty string
				if ( $excerpt_cut < 0 ) {
					// get the shorter excerpt until the last word
					$excerpt = mb_substr( $sub_excerpt, 0, $excerpt_cut );
				} else {
					// get the shortened excerpt
					$excerpt = $sub_excerpt;
				} // if ( $excerpt_cut < 0 )
			} // if ( mb_strlen( $excerpt ) > $this->customs[ 'excerpt_length' ] )
		} // if ( empty( $excerpt ) )
		
		if ( $excerpt ) {
			// append 'more' text, set 'more' signs as link if desired
			if ( $this->customs[ 'set_more_as_link' ] ) {
				$excerpt .= sprintf( '<a href="%s"%s>%s</a>', get_the_permalink( $post ), $this->customs[ 'link_target' ], $this->customs[ 'excerpt_more' ] );
			} else {
				$excerpt .= $this->customs[ 'excerpt_more' ];
			}
		}
		
		// return text
		return $excerpt;
	}

	/**
	 * Returns the shortened post title, must use in a loop.
	 *
	 * @since 4.5
	 */
	private function get_the_trimmed_post_title () {
		
		// get current post's post_title
		$post_title = get_the_title();

		// if post_title is longer than desired
		if ( mb_strlen( $post_title ) > $this->customs[ 'post_title_length' ] ) {
			// get post_title in desired length
			$post_title = mb_substr( $post_title, 0, $this->customs[ 'post_title_length' ] );
			// append ellipses
			$post_title .= $this->defaults[ 'ellipses' ];
		}
		// return text
		return $post_title;
	}

	/**
	 * Returns width and height of a image size name, else default sizes
	 *
	 * @since 4.0
	 */
	private function get_image_dimensions ( $size = 'thumbnail' ) {

		$width  = 0;
		$height = 0;
		// check if selected size is in registered images sizes
		if ( in_array( $size, get_intermediate_image_sizes() ) ) {
			// if in WordPress standard image sizes
			if ( in_array( $size, array( 'thumbnail', 'medium', 'large' ) ) ) {
				$width  = get_option( $size . '_size_w' );
				$height = get_option( $size . '_size_h' );
			} else {
				// custom image sizes, formerly added via add_image_size()
				global $_wp_additional_image_sizes;
				$width  = $_wp_additional_image_sizes[ $size ][ 'width' ];
				$height = $_wp_additional_image_sizes[ $size ][ 'height' ];
			}
		}
		// check if vars have true values, else use default size
		if ( ! $width )  $width  = $this->defaults[ 'thumb_width' ];
		if ( ! $height ) $height = $this->defaults[ 'thumb_height' ];
		
		// return sizes
		return array( $width, $height );
	}
	
	/**
	 * Shows sticky posts on top of categories list
	 *
	 * @since 6.2.1
	 */
	public function get_stickies_on_top( $posts ) {
		// get sticky post IDs
		$sticky_posts = get_option( 'sticky_posts' );
		// initialize variables for the correct number of posts in the result list
		$num_posts = count( $posts );
		$sticky_offset = 0;
		// loop over posts and relocate stickies to the front
		for( $i = 0; $i < $num_posts; $i++ ) {
			// if sticky post
			if ( in_array( $posts[ $i ]->ID, $sticky_posts ) ) {
				$sticky_post = $posts[ $i ];
				// remove sticky post from current position
				array_splice( $posts, $i, 1 );
				// move to front, after other stickies
				array_splice( $posts, $sticky_offset, 0, array( $sticky_post ) );
				// increment the sticky offset. the next sticky will be placed at this offset.
				$sticky_offset++;
				// remove post from sticky posts array
				//$offset = array_search( $sticky_post->ID, $sticky_posts );
				//unset( $sticky_posts[ $offset ] );
			} // if ( in_array( $posts[ $i ]->ID, $sticky_posts ) )
		} // for()
		// return new list
		return $posts;
	}
	
	/**
	 * Returns the ARIA label for the NAV element
	 *
	 * @since 6.7.1
	 */
	private function get_aria_nav_label( $title ) {
		// the title may be filtered: Strip out HTML
		$title = trim( strip_tags( $title ) );
		// and make sure the aria-label is never empty
		return $title ? $title : $this->defaults[ 'nav_label' ];
	}
	
}

/**
 * Register widget on init
 *
 * @since 1.0
 */
function register_recent_posts_widget_with_thumbnails () {
	register_widget( 'Recent_Posts_Widget_With_Thumbnails' );
}
add_action( 'widgets_init', 'register_recent_posts_widget_with_thumbnails', 1 );