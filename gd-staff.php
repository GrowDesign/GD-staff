<?php

/*
Plugin Name: GD Staff
Plugin URI: http://sussexschool.org/
Description: Used by millions, to make WP better.
Version: 1.0.5
Author: Grow Design
Author URI: http://www.growdesign.net/
License: GPLv2 or later
GitHub Plugin URI: https://github.com/GrowDesign/GD-staff
*/

add_action( 'init', 'register_cpt_staff' );

function register_cpt_staff() {

    $labels = array( 
        'name' => _x( 'Staff', 'staff' ),
        'singular_name' => _x( 'Staff', 'staff' ),
        'add_new' => _x( 'Add New', 'staff' ),
        'add_new_item' => _x( 'Add New Staff', 'staff' ),
        'edit_item' => _x( 'Edit Staff', 'staff' ),
        'new_item' => _x( 'New Staff', 'staff' ),
        'view_item' => _x( 'View Staff', 'staff' ),
        'search_items' => _x( 'Search Staff', 'staff' ),
        'not_found' => _x( 'No staff found', 'staff' ),
        'not_found_in_trash' => _x( 'No staff found in Trash', 'staff' ),
        'parent_item_colon' => _x( 'Parent Staff:', 'staff' ),
        'menu_name' => _x( 'Staff', 'staff' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        
        'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'menu_icon' => 'dashicons-groups',
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'staff', $args );
}

class GD_Builder_Module_Staff_Portfolio extends ET_Builder_Module {
	function init() {
		$this->name = __( 'Staff Portfolio', 'et_builder' );
		$this->slug = 'gd_pb_staff_portfolio';

		$this->whitelisted_fields = array(
			'fullwidth',
			'posts_number',
			'include_categories',
			'show_title',
			'show_categories',
			'show_pagination',
			'background_layout',
			'admin_label',
			'module_id',
			'module_class',
			'zoom_icon_color',
			'hover_overlay_color',
			'hover_icon',
		);

		$this->fields_defaults = array(
			'fullwidth'         => array( 'on' ),
			'posts_number'      => array( 10, 'add_default_setting' ),
			'show_title'        => array( 'on' ),
			'show_categories'   => array( 'on' ),
			'show_pagination'   => array( 'on' ),
			'background_layout' => array( 'light' ),
		);

		$this->main_css_element = '%%order_class%% .et_pb_portfolio_item';
		$this->advanced_options = array(
			'fonts' => array(
				'title'   => array(
					'label'    => __( 'Title', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} h2",
					),
				),
				'caption' => array(
					'label'    => __( 'Caption', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} .post-meta",
					),
				),
			),
			'background' => array(
				'settings' => array(
					'color' => 'alpha',
				),
			),
			'border' => array(),
		);
		$this->custom_css_options = array(
			'portfolio_image' => array(
				'label'    => __( 'Portfolio Image', 'et_builder' ),
				'selector' => '.et_portfolio_image',
			),
			'overlay' => array(
				'label'    => __( 'Overlay', 'et_builder' ),
				'selector' => '.et_overlay',
			),
			'overlay_icon' => array(
				'label'    => __( 'Overlay Icon', 'et_builder' ),
				'selector' => '.et_overlay:before',
			),
			'portfolio_title' => array(
				'label'    => __( 'Portfolio Title', 'et_builder' ),
				'selector' => '.et_pb_portfolio_item h2',
			),
			'portfolio_post_meta' => array(
				'label'    => __( 'Portfolio Post Meta', 'et_builder' ),
				'selector' => '.et_pb_portfolio_item .post-meta',
			),
		);
	}

	function get_fields() {
		$fields = array(
			'fullwidth' => array(
				'label'   => __( 'Layout', 'et_builder' ),
				'type'    => 'select',
				'options' => array(
					'on'  => __( 'Fullwidth', 'et_builder' ),
					'off' => __( 'Grid', 'et_builder' ),
				),
				'description'       => __( 'Choose your desired portfolio layout style.', 'et_builder' ),
			),
			'posts_number' => array(
				'label'             => __( 'Posts Number', 'et_builder' ),
				'type'              => 'text',
				'description'       => __( 'Define the number of projects that should be displayed per page.', 'et_builder' ),
			),
			'include_categories' => array(
				'label'            => __( 'Include Categories', 'et_builder' ),
				'renderer'         => 'et_builder_include_categories_option',
				'description'      => __( 'Select the categories that you would like to include in the feed.', 'et_builder' ),
			),
			'show_title' => array(
				'label'   => __( 'Show Title', 'et_builder' ),
				'type'    => 'yes_no_button',
				'options' => array(
					'on'  => __( 'Yes', 'et_builder' ),
					'off' => __( 'No', 'et_builder' ),
				),
				'description'       => __( 'Turn project titles on or off.', 'et_builder' ),
			),
			'show_categories' => array(
				'label'   => __( 'Show Categories', 'et_builder' ),
				'type'    => 'yes_no_button',
				'options' => array(
					'on'  => __( 'Yes', 'et_builder' ),
					'off' => __( 'No', 'et_builder' ),
				),
				'description'        => __( 'Turn the category links on or off.', 'et_builder' ),
			),
			'show_pagination' => array(
				'label'   => __( 'Show Pagination', 'et_builder' ),
				'type'    => 'yes_no_button',
				'options' => array(
					'on'  => __( 'Yes', 'et_builder' ),
					'off' => __( 'No', 'et_builder' ),
				),
				'description'        => __( 'Enable or disable pagination for this feed.', 'et_builder' ),
			),
			'background_layout' => array(
				'label'   => __( 'Text Color', 'et_builder' ),
				'type'    => 'select',
				'options' => array(
					'light'  => __( 'Dark', 'et_builder' ),
					'dark' => __( 'Light', 'et_builder' ),
				),
				'description'        => __( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder' ),
			),
			'admin_label' => array(
				'label'       => __( 'Admin Label', 'et_builder' ),
				'type'        => 'text',
				'description' => __( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			'module_id' => array(
				'label'       => __( 'CSS ID', 'et_builder' ),
				'type'        => 'text',
				'description' => __( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'et_builder' ),
			),
			'module_class' => array(
				'label'       => __( 'CSS Class', 'et_builder' ),
				'type'        => 'text',
				'description' => __( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'et_builder' ),
			),
			'zoom_icon_color' => array(
				'label'             => __( 'Zoom Icon Color', 'et_builder' ),
				'type'              => 'color',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
			),
			'hover_overlay_color' => array(
				'label'             => __( 'Hover Overlay Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
			),
			'hover_icon' => array(
				'label'               => __( 'Hover Icon Picker', 'et_builder' ),
				'type'                => 'text',
				'class'               => array( 'et-pb-font-icon' ),
				'renderer'            => 'et_pb_get_font_icon_list',
				'renderer_with_field' => true,
				'tab_slug'            => 'advanced',
			),
		);
		return $fields;
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id          = $this->shortcode_atts['module_id'];
		$module_class       = $this->shortcode_atts['module_class'];
		$fullwidth          = $this->shortcode_atts['fullwidth'];
		$posts_number       = $this->shortcode_atts['posts_number'];
		$include_categories = $this->shortcode_atts['include_categories'];
		$show_title         = $this->shortcode_atts['show_title'];
		$show_categories    = $this->shortcode_atts['show_categories'];
		$show_pagination    = $this->shortcode_atts['show_pagination'];
		$background_layout  = $this->shortcode_atts['background_layout'];
		$zoom_icon_color     = $this->shortcode_atts['zoom_icon_color'];
		$hover_overlay_color = $this->shortcode_atts['hover_overlay_color'];
		$hover_icon          = $this->shortcode_atts['hover_icon'];

		global $paged;

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		if ( '' !== $zoom_icon_color ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%% .et_overlay:before',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $zoom_icon_color )
				),
			) );
		}

		if ( '' !== $hover_overlay_color ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%% .et_overlay',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $hover_overlay_color )
				),
			) );
		}

		$container_is_closed = false;

		$args = array(
			'posts_per_page' => (int) $posts_number,
			'post_type'      => 'staff',
		);

		$et_paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );

		if ( is_front_page() ) {
			$paged = $et_paged;
		}

		if ( '' !== $include_categories )
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'project_category',
					'field' => 'id',
					'terms' => explode( ',', $include_categories ),
					'operator' => 'IN',
				)
			);

		if ( ! is_search() ) {
			$args['paged'] = $et_paged;
		}

		$main_post_class = sprintf(
			'et_pb_portfolio_item%1$s',
			( 'on' !== $fullwidth ? ' et_pb_grid_item' : '' )
		);

		ob_start();

		query_posts( $args );

		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class( $main_post_class ); ?>>

			<?php
				$thumb = '';

				$width = 'on' === $fullwidth ?  1080 : 400;
				$width = (int) apply_filters( 'et_pb_portfolio_image_width', $width );

				$height = 'on' === $fullwidth ?  9999 : 284;
				$height = (int) apply_filters( 'et_pb_portfolio_image_height', $height );
				$classtext = 'on' === $fullwidth ? 'et_pb_post_main_image' : '';
				$titletext = get_the_title();
				$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
				$thumb = $thumbnail["thumb"];

				if ( '' !== $thumb ) : ?>
					<a href="<?php the_permalink(); ?>">
					<?php if ( 'on' !== $fullwidth ) : ?>
						<span class="et_portfolio_image">
					<?php endif; ?>
							<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
					<?php if ( 'on' !== $fullwidth ) :

							$data_icon = '' !== $hover_icon
								? sprintf(
									' data-icon="%1$s"',
									esc_attr( et_pb_process_font_icon( $hover_icon ) )
								)
								: '';

							printf( '<span class="et_overlay%1$s"%2$s></span>',
								( '' !== $hover_icon ? ' et_pb_inline_icon' : '' ),
								$data_icon
							);

					?>
						</span>
					<?php endif; ?>
					</a>
			<?php
				endif;
			?>

				<?php if ( 'on' === $show_title ) : ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<h3>et_pb_position</h3>
				<?php endif; ?>

				<?php if ( 'on' === $show_categories ) : ?>
					<p class="post-meta"><?php echo get_the_term_list( get_the_ID(), 'project_category', '', ', ' ); ?></p>
				<?php endif; ?>

				</div> <!-- .et_pb_portfolio_item -->
	<?php	}

			if ( 'on' === $show_pagination && ! is_search() ) {
				echo '</div> <!-- .et_pb_portfolio -->';

				$container_is_closed = true;

				if ( function_exists( 'wp_pagenavi' ) )
					wp_pagenavi();
				else
					get_template_part( 'includes/navigation', 'index' );
			}

			wp_reset_query();
		} else {
			get_template_part( 'includes/no-results', 'index' );
		}

		$posts = ob_get_contents();

		ob_end_clean();

		$class = " et_pb_module et_pb_bg_layout_{$background_layout}";

		$output = sprintf(
			'<div%5$s class="%1$s%3$s%6$s">
				%2$s
			%4$s',
			( 'on' === $fullwidth ? 'et_pb_portfolio' : 'et_pb_portfolio_grid clearfix' ),
			$posts,
			esc_attr( $class ),
			( ! $container_is_closed ? '</div> <!-- .et_pb_portfolio -->' : '' ),
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' )
		);

		return $output;
	}
}
new GD_Builder_Module_Staff_Portfolio;