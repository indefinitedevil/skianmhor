<?php

class Avada_Scripts {

    /**
     * The class construction
     */
    public function __construct() {

        if ( ! is_admin() && ! in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ) {
        	add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        	add_action( 'script_loader_tag', array( $this, 'add_async' ), 10, 2 );
        }

        add_action( 'admin_head', array( $this, 'admin_css' ) );

    }

    public function enqueue_scripts() {

		global $wp_styles, $woocommerce;

		$theme_info = wp_get_theme();

		wp_enqueue_script( 'jquery', false, array(), $theme_info->get( 'Version' ), true );

        // the comment-reply script
		if ( is_singular() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

        if ( function_exists( 'novagallery_shortcode' ) ) {
			wp_deregister_script( 'novagallery_modernizr' );
		}

		if ( function_exists( 'ccgallery_shortcode' ) ) {
			wp_deregister_script( 'ccgallery_modernizr' );
		}

		if ( ! Avada()->settings->get( 'status_gmap' ) ) {
			$map_api = 'http' . ( ( is_ssl() ) ? 's' : '' ) . '://maps.googleapis.com/maps/api/js?key=AIzaSyC9T9XQgPq2mKksW0zY5mJ8ZvMsHLv_NfQ&sensor=false&amp;language=' . substr( get_locale(), 0, 2 );
			wp_register_script( 'google-maps-api', $map_api, array(), $theme_info->get( 'Version' ), false );
            wp_register_script( 'google-maps-infobox', get_template_directory_uri() . '/assets/js/infobox_packed.js', array(), $theme_info->get( 'Version' ), false );
			wp_register_script( 'google-maps-fusion', get_template_directory_uri() . '/assets/js/jquery.fusion_maps.js', array(), $theme_info->get( 'Version' ), false );
		}

		// Fix for WPML + Woocommerce
		// https://gist.github.com/mharis/8555367b1be5c2247a44
		if( class_exists( 'WooCommerce' ) && class_exists( 'SitePress' ) ) {
			wp_deregister_script( 'wc-cart-fragments' );
			wp_register_script( 'wc-cart-fragments', get_template_directory_uri() . '/assets/js/wc-cart-fragments.js', array( 'jquery', 'jquery-cookie' ), $theme_info->get( 'Version' ), true );
		}

		if ( Avada()->settings->get( 'dev_mode' ) ) {

			$main_js = get_template_directory_uri() . '/assets/js/theme.js';
			wp_deregister_script( 'bootstrap' );
			wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'bootstrap' );

			wp_deregister_script( 'cssua' );
			wp_register_script( 'cssua', get_template_directory_uri() . '/assets/js/cssua.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'cssua' );

			wp_deregister_script( 'easyPieChart' );
			wp_register_script( 'easyPieChart', get_template_directory_uri() . '/assets/js/easyPieChart.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'easyPieChart' );

			wp_deregister_script( 'excanvas' );
			wp_register_script( 'excanvas', get_template_directory_uri() . '/assets/js/excanvas.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'excanvas' );

			wp_deregister_script( 'Froogaloop' );
			wp_register_script( 'Froogaloop', get_template_directory_uri() . '/assets/js/Froogaloop.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'Froogaloop' );

			wp_deregister_script( 'imagesLoaded' );
			wp_register_script( 'imagesLoaded', get_template_directory_uri() . '/assets/js/imagesLoaded.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'imagesLoaded' );

			wp_deregister_script( 'jquery.infinitescroll' );
			wp_register_script( 'jquery.infinitescroll', get_template_directory_uri() . '/assets/js/jquery.infinitescroll.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.infinitescroll' );

			wp_deregister_script( 'isotope' );
			wp_register_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'isotope' );

			wp_deregister_script( 'jquery.appear' );
			wp_register_script( 'jquery.appear', get_template_directory_uri() . '/assets/js/jquery.appear.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.appear' );

			wp_deregister_script( 'jquery.touchSwipe' );
			wp_register_script( 'jquery.touchSwipe', get_template_directory_uri() . '/assets/js/jquery.touchSwipe.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.touchSwipe' );

			wp_deregister_script( 'jquery.carouFredSel' );
			wp_register_script( 'jquery.carouFredSel', get_template_directory_uri() . '/assets/js/jquery.carouFredSel.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.carouFredSel' );

			wp_deregister_script( 'jquery.countTo' );
			wp_register_script( 'jquery.countTo', get_template_directory_uri() . '/assets/js/jquery.countTo.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.countTo' );

			wp_deregister_script( 'jquery.countdown' );
			wp_register_script( 'jquery.countdown', get_template_directory_uri() . '/assets/js/jquery.countdown.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.countdown' );

			wp_deregister_script( 'jquery.cycle' );
			wp_register_script( 'jquery.cycle', get_template_directory_uri() . '/assets/js/jquery.cycle.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.cycle' );

			wp_deregister_script( 'jquery.easing' );
			wp_register_script( 'jquery.easing', get_template_directory_uri() . '/assets/js/jquery.easing.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.easing' );

			wp_deregister_script( 'jquery.elasticslider' );
			wp_register_script( 'jquery.elasticslider', get_template_directory_uri() . '/assets/js/jquery.elasticslider.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.elasticslider' );

			wp_deregister_script( 'jquery.fitvids' );
			wp_register_script( 'jquery.fitvids', get_template_directory_uri() . '/assets/js/jquery.fitvids.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.fitvids' );

			wp_deregister_script( 'jquery.flexslider' );
			wp_register_script( 'jquery.flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.flexslider' );

			wp_deregister_script( 'jquery.fusion_maps' );
			wp_register_script( 'jquery.fusion_maps', get_template_directory_uri() . '/assets/js/jquery.fusion_maps.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.fusion_maps' );

			wp_deregister_script( 'jquery.hoverflow' );
			wp_register_script( 'jquery.hoverflow', get_template_directory_uri() . '/assets/js/jquery.hoverflow.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.hoverflow' );

			wp_deregister_script( 'jquery.hoverIntent' );
			wp_register_script( 'jquery.hoverIntent', get_template_directory_uri() . '/assets/js/jquery.hoverIntent.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.hoverIntent' );

			wp_deregister_script( 'jquery.placeholder' );
			wp_register_script( 'jquery.placeholder', get_template_directory_uri() . '/assets/js/jquery.placeholder.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.placeholder' );

			wp_deregister_script( 'jquery.toTop' );
			wp_register_script( 'jquery.toTop', get_template_directory_uri() . '/assets/js/jquery.toTop.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.toTop' );

			wp_deregister_script( 'jquery.waypoints' );
			wp_register_script( 'jquery.waypoints', get_template_directory_uri() . '/assets/js/jquery.waypoints.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.waypoints' );

			wp_deregister_script( 'modernizr' );
			wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'modernizr' );

			wp_deregister_script( 'jquery.requestAnimationFrame' );
			wp_register_script( 'jquery.requestAnimationFrame', get_template_directory_uri() . '/assets/js/jquery.requestAnimationFrame.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.requestAnimationFrame' );

			wp_deregister_script( 'jquery.mousewheel' );
			wp_register_script( 'jquery.mousewheel', get_template_directory_uri() . '/assets/js/jquery.mousewheel.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.mousewheel' );

			if ( ! Avada()->settings->get('status_lightbox' ) ) {
				wp_deregister_script( 'ilightbox.packed' );
				wp_register_script( 'ilightbox.packed', get_template_directory_uri() . '/assets/js/ilightbox.js', array(), $theme_info->get( 'Version' ), true );
				wp_enqueue_script( 'ilightbox.packed' );
			}

			wp_deregister_script( 'avada-lightbox' );
			wp_register_script( 'avada-lightbox', get_template_directory_uri() . '/assets/js/avada-lightbox.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'avada-lightbox' );

			wp_deregister_script( 'avada-header' );
			wp_register_script( 'avada-header', get_template_directory_uri() . '/assets/js/avada-header.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'avada-header' );

			wp_deregister_script( 'avada-select' );
			wp_register_script( 'avada-select', get_template_directory_uri() . '/assets/js/avada-select.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'avada-select' );

			wp_deregister_script( 'avada-parallax' );
			wp_register_script( 'avada-parallax', get_template_directory_uri() . '/assets/js/avada-parallax.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'avada-parallax' );

			wp_deregister_script( 'avada-video-bg' );
			wp_register_script( 'avada-video-bg', get_template_directory_uri() . '/assets/js/avada-video-bg.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'avada-video-bg' );

			if ( class_exists( 'WooCommerce' ) ) {
				wp_dequeue_script('avada-woocommerce');
				wp_register_script( 'avada-woocommerce', get_template_directory_uri() . '/assets/js/avada-woocommerce.js' , array( 'jquery' ), $theme_info->get( 'Version' ), true );
				wp_enqueue_script( 'avada-woocommerce' );
			}
			if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
				wp_dequeue_script('avada-bbpress');
				wp_register_script( 'avada-bbpress', get_template_directory_uri() . '/assets/js/avada-bbpress.js' , array( 'jquery' ), $theme_info->get( 'Version' ), true );
				wp_enqueue_script( 'avada-bbpress' );
			}

			if ( class_exists( 'Tribe__Events__Main' ) && ( tribe_is_event() || is_events_archive() ) ) {
				wp_dequeue_script('avada-events');
				wp_register_script( 'avada-events', get_template_directory_uri() . '/assets/js/avada-events.js' , array( 'jquery' ), $theme_info->get( 'Version' ), true );
				wp_enqueue_script( 'avada-events' );
			}

			if ( ! Avada()->settings->get( 'smooth_scrolling' ) ) {
				wp_dequeue_script('jquery.nicescroll');
				wp_register_script( 'jquery.nicescroll', get_template_directory_uri() . '/assets/js/jquery.nicescroll.js' , array( 'jquery' ), $theme_info->get( 'Version' ), true );
				wp_enqueue_script( 'jquery.nicescroll' );

				wp_dequeue_script('avada-nicescroll');
				wp_register_script( 'avada-nicescroll', get_template_directory_uri() . '/assets/js/avada-nicescroll.js' , array( 'jquery' ), $theme_info->get( 'Version' ), true );
				wp_enqueue_script( 'avada-nicescroll' );
			}

		} else {

			$main_js = get_template_directory_uri() . '/assets/js/main.min.js';

		}

		wp_deregister_script( 'avada' );
		wp_register_script( 'avada', $main_js, array(), $theme_info->get( 'Version' ), true );
		wp_enqueue_script( 'avada' );

		$smoothHeight = ( 'auto' == get_post_meta( $this->page_id(), 'pyre_fimg_width', true ) && 'half' == get_post_meta( $this->page_id(), 'pyre_width', true ) ) ? 'true' : 'false';

		if ( get_post_meta( 'auto' == $this->page_id(), 'pyre_fimg_width', true ) && 'half' == get_post_meta( $this->page_id(), 'pyre_width', true ) ) {
			$flex_smoothHeight = 'true';
		} else {
			$flex_smoothHeight = ( Avada()->settings->get( 'slideshow_smooth_height' ) ) ? 'true' : 'false';
		}

		$db_vars = Avada()->settings->get_all();

		$db_vars['slideshow_autoplay'] = ( ! Avada()->settings->get( 'slideshow_autoplay' ) ) ? false : true;
		$db_vars['slideshow_speed']    = ( ! Avada()->settings->get( 'slideshow_speed' ) ) ? 7000 : Avada()->settings->get( 'slideshow_speed' );

		$language_code = ( defined( 'ICL_SITEPRESS_VERSION' ) && defined('ICL_LANGUAGE_CODE' ) ) ? ICL_LANGUAGE_CODE : '';

		$current_page_template = get_page_template_slug( $this->page_id() );
		$portfolio_image_size  = avada_get_portfolio_image_size( $this->page_id() );
		$isotope_type          = ( $portfolio_image_size == 'full' ) ? 'masonry' : 'fitRows';

		if( is_archive() ) {

			$portfolio_layout_setting = strtolower( Avada()->settings->get( 'portfolio_archive_layout' ) );
            $isotope_type = ( Avada()->settings->get( 'portfolio_featured_image_size' ) == 'full' || strpos( $portfolio_layout_setting, 'grid' ) ) ? 'masonry' : 'fitRows';

		}

        $layout = ( get_post_meta($this->page_id(), 'pyre_page_bg_layout', true) == 'boxed' || get_post_meta($this->page_id(), 'pyre_page_bg_layout', true) == 'wide' ) ? get_post_meta( $this->page_id(), 'pyre_page_bg_layout', true ) : Avada()->settings->get( 'layout' );

        $avada_rev_styles = ( 'no' == get_post_meta( $this->page_id(), 'pyre_avada_rev_styles', true ) || ( ! Avada()->settings->get( 'avada_rev_styles' ) && 'yes' != get_post_meta( $this->page_id(), 'pyre_avada_rev_styles', true ) ) ) ? 1 : 0;

		$local_variables = array(
			'admin_ajax'					=> admin_url( 'admin-ajax.php' ),
			'admin_ajax_nonce'				=> wp_create_nonce( 'avada_admin_ajax' ),
			'protocol'						=> is_ssl(),
			'theme_url' 					=> get_template_directory_uri(),
			'dropdown_goto' 				=> __( 'Go to...', 'Avada' ),
			'mobile_nav_cart' 				=> __( 'Shopping Cart', 'Avada' ),
			'page_smoothHeight' 			=> $smoothHeight,
			'flex_smoothHeight' 			=> $flex_smoothHeight,
			'language_flag' 				=> $language_code,
			'infinite_blog_finished_msg' 	=> '<em>' . __( 'All posts displayed.', 'Avada' ) . '</em>',
			'infinite_finished_msg'			=> '<em>' . __( 'All items displayed.', 'Avada' ) . '</em>',
			'infinite_blog_text' 			=> '<em>' . __( 'Loading the next set of posts...', 'Avada' ) . '</em>',
			'portfolio_loading_text' 		=> '<em>' . __( 'Loading Portfolio Items...', 'Avada' ) . '</em>',
			'faqs_loading_text' 			=> '<em>' . __( 'Loading FAQ Items...', 'Avada' ) . '</em>',
			'order_actions' 				=>  __( 'Details' , 'Avada' ),
			'avada_rev_styles'				=> $avada_rev_styles,
			'avada_styles_dropdowns'		=> Avada()->settings->get( 'avada_styles_dropdowns' ),
			'blog_grid_column_spacing'		=> Avada()->settings->get( 'blog_grid_column_spacing' ),
			'blog_pagination_type'			=> Avada()->settings->get( 'blog_pagination_type' ),
			'body_font_size'				=> Avada()->settings->get( 'body_font_size' ),
			'carousel_speed'				=> Avada()->settings->get( 'carousel_speed' ),
			'custom_icon_image_retina'		=> Avada()->settings->get( 'custom_icon_image_retina' ),
			'disable_mobile_animate_css'	=> Avada()->settings->get( 'disable_mobile_animate_css' ),
			'disable_mobile_image_hovers'	=> Avada()->settings->get( 'disable_mobile_image_hovers' ),
			'portfolio_pagination_type'		=> Avada()->settings->get( 'grid_pagination_type' ),
			'form_bg_color'					=> Avada()->settings->get( 'form_bg_color' ),
			'header_transparency'			=> ( ( ( 1 > Avada()->settings->get( 'header_bg_color', 'opacity' ) && ! get_post_meta( $this->page_id(), 'pyre_header_bg_opacity', true ) ) || ( '' != get_post_meta( $this->page_id(), 'pyre_header_bg_opacity', true ) && 1 > get_post_meta( $this->page_id(), 'pyre_header_bg_opacity', true ) ) ) ) ? 1 : 0,
			'header_padding_bottom'			=> Avada()->settings->get( 'margin_header_bottom' ),
			'header_padding_top'			=> Avada()->settings->get( 'margin_header_top' ),
			'header_position'				=> Avada()->settings->get( 'header_position' ),
			'header_sticky'					=> Avada()->settings->get( 'header_sticky' ),
			'header_sticky_tablet'			=> Avada()->settings->get( 'header_sticky_tablet' ),
			'header_sticky_mobile'			=> Avada()->settings->get( 'header_sticky_mobile' ),
			'header_sticky_type2_layout'	=> Avada()->settings->get( 'header_sticky_type2_layout' ),
			'is_responsive' 				=> Avada()->settings->get( 'responsive' ),
			'is_ssl'						=> is_ssl() ? 'true' : 'false',
			'isotope_type'					=> $isotope_type,
			'layout_mode'					=> strtolower( $layout ),
			'lightbox_animation_speed'		=> Avada()->settings->get( 'lightbox_animation_speed' ),
			'lightbox_arrows'				=> Avada()->settings->get( 'lightbox_arrows' ),
			'lightbox_autoplay'				=> Avada()->settings->get( 'lightbox_autoplay' ),
			'lightbox_behavior'				=> Avada()->settings->get( 'lightbox_behavior' ),
			'lightbox_desc'					=> Avada()->settings->get( 'lightbox_desc' ),
			'lightbox_deeplinking'			=> Avada()->settings->get( 'lightbox_deeplinking' ),
			'lightbox_gallery'				=> Avada()->settings->get( 'lightbox_gallery' ),
			'lightbox_opacity'				=> Avada()->settings->get( 'lightbox_opacity' ),
			'lightbox_path'					=> Avada()->settings->get( 'lightbox_path' ),
			'lightbox_post_images'			=> Avada()->settings->get( 'lightbox_post_images' ),
			'lightbox_skin'					=> Avada()->settings->get( 'lightbox_skin' ),
			'lightbox_slideshow_speed'		=> Avada()->settings->get( 'lightbox_slideshow_speed' ),
			'lightbox_social'				=> Avada()->settings->get( 'lightbox_social' ),
			'lightbox_title'				=> Avada()->settings->get( 'lightbox_title' ),
			'lightbox_video_height'			=> fusion_strip_unit( Avada()->settings->get( 'lightbox_video_height' ) ),
			'lightbox_video_width'			=> fusion_strip_unit( Avada()->settings->get( 'lightbox_video_width' ) ),
			'logo_alignment'				=> Avada()->settings->get( 'logo_alignment' ),
			'logo_margin_bottom'			=> Avada()->settings->get( 'margin_logo_bottom' ),
			'logo_margin_top'				=> Avada()->settings->get( 'margin_logo_top' ),
			'megamenu_max_width'			=> Avada()->settings->get( 'megamenu_max_width' ),
			'mobile_menu_design'			=> Avada()->settings->get( 'mobile_menu_design' ),
			'nav_height'					=> Avada()->settings->get( 'nav_height' ),
			'nav_highlight_border'			=> Avada()->settings->get( 'nav_highlight_border' ),
			'page_title_fading'				=> Avada()->settings->get( 'page_title_fading' ),
			'pagination_video_slide'		=> Avada()->settings->get( 'pagination_video_slide' ),
			'related_posts_speed'			=> Avada()->settings->get( 'related_posts_speed' ),
			'retina_icon_height'			=> Avada()->settings->get( 'retina_icon_height' ),
			'retina_icon_width'				=> Avada()->settings->get( 'retina_icon_width' ),
			'submenu_slideout'				=> Avada()->settings->get( 'mobile_nav_submenu_slideout' ),
			'side_header_break_point'		=> fusion_strip_unit( Avada()->settings->get( 'side_header_break_point' ) ),
			'sidenav_behavior'				=> Avada()->settings->get( 'sidenav_behavior' ),
			'site_width'					=> Avada()->settings->get( 'site_width' ),
			'slider_position'				=> strtolower( Avada()->settings->get( 'slider_position' ) ),
			'slideshow_autoplay'			=> Avada()->settings->get( 'slideshow_autoplay' ),
			'slideshow_speed'				=> Avada()->settings->get( 'slideshow_speed' ),
			'smooth_scrolling'				=> Avada()->settings->get( 'smooth_scrolling' ),
			'status_lightbox'				=> Avada()->settings->get( 'status_lightbox' ),
			'status_totop_mobile'			=> Avada()->settings->get( 'status_totop_mobile' ),
			'status_vimeo'					=> Avada()->settings->get( 'status_vimeo' ),
			'status_yt'						=> Avada()->settings->get( 'status_yt' ),
			'submenu_slideout' 				=> Avada()->settings->get( 'mobile_nav_submenu_slideout' ),
			'testimonials_speed' 			=> Avada()->settings->get( 'testimonials_speed' ),
			'tfes_animation' 				=> Avada()->settings->get( 'tfes_animation' ),
			'tfes_autoplay' 				=> Avada()->settings->get( 'tfes_autoplay' ),
			'tfes_interval' 				=> Avada()->settings->get( 'tfes_interval' ),
			'tfes_speed' 					=> Avada()->settings->get( 'tfes_speed' ),
			'tfes_width' 					=> Avada()->settings->get( 'tfes_width' ),
			'title_style_type'				=> Avada()->settings->get( 'title_style_type' ),
			'typography_responsive'			=> Avada()->settings->get( 'typography_responsive' ),
			'typography_sensitivity'		=> Avada()->settings->get( 'typography_sensitivity' ),
			'typography_factor'				=> Avada()->settings->get( 'typography_factor' ),
			'woocommerce_shop_page_columns'	=> Avada()->settings->get( 'woocommerce_shop_page_columns' ),
			'sticky_header_shrinkage'		=> Avada()->settings->get( 'header_sticky_shrinkage' )
		);

		if ( class_exists( 'WooCommerce' ) ) {
			if ( version_compare( $woocommerce->version, '2.3', '>=' ) ) {
				$local_variables['woocommerce_23'] = true;
			}
		}

		$local_variables['side_header_width'] = ( 'Top' != Avada()->settings->get( 'header_position' ) ) ? str_replace( 'px', '', Avada()->settings->get( 'side_header_width' ) ) : '0';

		wp_localize_script( 'avada', 'js_local_vars', $local_variables );

        $header_demo = ( is_page( 'header-2' ) || is_page( 'header-3' ) || is_page( 'header-4' ) || is_page( 'header-5' ) ) ? true : false;

		if ( 'None' != Avada()->settings->get( 'google_body' ) && Avada()->settings->get( 'google_body' ) ) {
			$gfont[urlencode( Avada()->settings->get( 'google_body' ) )] = urlencode( Avada()->settings->get( 'google_body' ) );
		}

		if ( 'None' != Avada()->settings->get( 'google_nav' ) && Avada()->settings->get( 'google_nav' ) && Avada()->settings->get( 'google_nav' ) != Avada()->settings->get( 'google_body' ) ) {
			$gfont[urlencode( Avada()->settings->get( 'google_nav' ) )] = urlencode( Avada()->settings->get( 'google_nav' ) );
		}

		if ( 'None' != Avada()->settings->get( 'google_headings' ) && Avada()->settings->get( 'google_headings' ) && Avada()->settings->get( 'google_headings' ) != Avada()->settings->get( 'google_body' ) && Avada()->settings->get( 'google_headings' ) != Avada()->settings->get( 'google_nav' ) ) {
			$gfont[urlencode( Avada()->settings->get( 'google_headings' ) )] = urlencode( Avada()->settings->get( 'google_headings' ) );
		}

		if ( 'None' != Avada()->settings->get( 'google_footer_headings' ) && Avada()->settings->get( 'google_footer_headings' ) && Avada()->settings->get( 'google_footer_headings' ) != Avada()->settings->get( 'google_body' ) && Avada()->settings->get( 'google_footer_headings' ) != Avada()->settings->get( 'google_nav' ) && Avada()->settings->get( 'google_footer_headings' ) != Avada()->settings->get( 'google_headings' ) ) {
			$gfont[urlencode( Avada()->settings->get( 'google_footer_headings' ) )] = urlencode( Avada()->settings->get( 'google_footer_headings' ) );
		}

		if ( 'None' != Avada()->settings->get( 'google_footer_headings' ) && Avada()->settings->get( 'google_footer_headings' ) && Avada()->settings->get( 'google_footer_headings' ) != Avada()->settings->get( 'google_body' ) && Avada()->settings->get( 'google_footer_headings' ) != Avada()->settings->get( 'google_nav' ) && Avada()->settings->get( 'google_footer_headings' ) != Avada()->settings->get( 'google_headings' ) ) {
			$gfont[urlencode( Avada()->settings->get( 'google_footer_headings' ) )] = urlencode( Avada()->settings->get( 'google_footer_headings' ) );
		}

		if ( 'None' != Avada()->settings->get( 'google_button' ) && Avada()->settings->get( 'google_button' ) && Avada()->settings->get( 'google_button' ) != Avada()->settings->get( 'google_body' ) && Avada()->settings->get( 'google_button' ) != Avada()->settings->get( 'google_nav' ) && Avada()->settings->get( 'google_button' ) != Avada()->settings->get( 'google_headings' ) && Avada()->settings->get( 'google_button' ) != Avada()->settings->get( 'google_footer_headings' ) ) {
			$gfont[ urlencode( Avada()->settings->get( 'google_button' ) ) ] = urlencode( Avada()->settings->get( 'google_button' ) );
		}

		if ( isset( $gfont ) && $gfont ) {

			$font_families = '';
			$font_settings = explode( '&', Avada()->settings->get( 'gfont_settings' ) );
			$font_styles   = $font_subsets = '';

			if ( is_array( $font_settings ) ) {
				$font_styles = $font_settings[0];

				if ( 1 < count( $font_settings ) ) {
					$font_subsets = $font_settings[1];
				}
			}
			foreach( $gfont as $g_font ) {
				$font_families .= sprintf( '%s:%s|', $g_font, urlencode( $font_styles ) );
			}

			$font_families = ( $font_subsets ) ? sprintf( '%s&%s', rtrim( $font_families, '|' ), $font_subsets ) : $font_families = rtrim( $font_families, '|' );

			wp_enqueue_style( 'avada-google-fonts', 'http' . ( ( is_ssl() ) ? 's' : '' ) . '://fonts.googleapis.com/css?family=' . $font_families, array(), '' );

		}

		wp_enqueue_style( 'avada-stylesheet', get_stylesheet_uri(), array(), $theme_info->get( 'Version' ) );

		wp_enqueue_style( 'avada-shortcodes', get_template_directory_uri() . '/shortcodes.css', array(), $theme_info->get( 'Version' ) );
		$wp_styles->add_data( 'avada-shortcodes', 'conditional', 'lte IE 9' );

		if ( ! Avada()->settings->get( 'status_fontawesome' ) ) {
			wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/fonts/fontawesome/font-awesome.css', array(), $theme_info->get( 'Version' ) );
			wp_enqueue_style( 'avada-IE-fontawesome', get_template_directory_uri() . '/assets/fonts/fontawesome/font-awesome.css', array(), $theme_info->get( 'Version' ) );
			$wp_styles->add_data( 'avada-IE-fontawesome', 'conditional', 'lte IE 9' );
		}

		wp_enqueue_style( 'avada-IE8', get_template_directory_uri() . '/assets/css/ie8.css', array(), $theme_info->get( 'Version' ) );
		$wp_styles->add_data( 'avada-IE8', 'conditional', 'lte IE 8' );

		wp_enqueue_style( 'avada-IE', get_template_directory_uri() . '/assets/css/ie.css', array(), $theme_info->get( 'Version' ) );
		$wp_styles->add_data( 'avada-IE', 'conditional', 'IE' );

		wp_deregister_style( 'woocommerce-layout' );
		wp_deregister_style( 'woocommerce-smallscreen' );
		wp_deregister_style( 'woocommerce-general' );

		if ( ! Avada()->settings->get( 'status_lightbox' ) ) {
			wp_enqueue_style( 'avada-iLightbox', get_template_directory_uri() . '/ilightbox.css', array(), $theme_info->get( 'Version' ) );
		}

		if ( ! Avada()->settings->get( 'use_animate_css' ) ) {
			wp_enqueue_style( 'avada-animations', get_template_directory_uri() . '/animations.css', array(), $theme_info->get( 'Version' ) );
		}

		if ( class_exists( 'WooCommerce' ) ) {
			wp_enqueue_style( 'avada-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), $theme_info->get( 'Version' ) );
		}

		if ( class_exists( 'bbPress' ) ) {
			wp_enqueue_style( 'avada-bbpress', get_template_directory_uri() . '/assets/css/bbpress.css', array(), $theme_info->get( 'Version' ) );
		}

		if ( ! Avada()->settings->get( 'status_lightbox' ) && class_exists( 'WooCommerce' ) ) {
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
		}

		if ( is_rtl() ) {
			wp_enqueue_style( 'avada-rtl', get_template_directory_uri() . '/assets/css/rtl.css', array(), $theme_info->get( 'Version' ) );
		}

    }

    /**
     * Add admin CSS
     */
    public function admin_css() {

        $theme_info = wp_get_theme();
        echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/framework/assets/css/admin_css.css?vesion=' . $theme_info->get( 'Version' ) . '">';
        echo '<style type="text/css">.widget input { border-color: #DFDFDF !important; }</style>';

    }

    /**
     * Get the current page ID
     */
    public function page_id() {

        $id = get_queried_object_id();

        if ( ( get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) && is_home()) || ( get_option( 'page_for_posts' ) && is_archive() && ! is_post_type_archive() ) ) {
            $id = get_option('page_for_posts');
        } elseif ( class_exists( 'WooCommerce' ) && ( is_shop() || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) ) {
            $id = get_option( 'woocommerce_shop_page_id' );
		}

        return $id;

    }

    /**
     * Add async to avada javascript file for performance
     */
    function add_async( $tag, $handle ) {
		if( $handle == 'avada' ) {
			return preg_replace( "/(><\/[a-zA-Z][^0-9](.*)>)$/", " async $1 ", $tag );
		} else {
			return $tag;
		}
    }

}

// Omit closing PHP tag to avoid "Headers already sent" issues.
