<?php
namespace Elementor;

use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor video widget.
 *
 * Elementor widget that displays a video player.
 *
 * @since 1.0.0
 */
class Ultimate_Widget_Video extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve video widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Ultimate_Widget_Video';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve video widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Video', 'ultimate' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve video widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-youtube';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the video widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'ultimate-addons' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'video', 'player', 'embed', 'youtube', 'vimeo', 'dailymotion' ];
	}

	/**
	 * Register video widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_video',
			[
				'label' => __( 'Video', 'ultimate' ),
			]
		);

		$this->add_control(
			'video_type',
			[
				'label'   => __( 'Source', 'ultimate' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'youtube',
				'options' => [
					'youtube'     => __( 'YouTube', 'ultimate' ),
					'vimeo'       => __( 'Vimeo', 'ultimate' ),
					'dailymotion' => __( 'Dailymotion', 'ultimate' ),
					'hosted'      => __( 'Self Hosted', 'ultimate' ),
				],
			]
		);

		$this->add_control(
			'youtube_url',
			[
				'label'   => __( 'Link', 'ultimate' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [
					'active'     => true,
					'categories' => [
						TagsModule:: POST_META_CATEGORY,
						TagsModule:: URL_CATEGORY,
					],
				],
				'placeholder' => __( 'Enter your URL', 'ultimate' ) . ' (YouTube)',
				'default'     => 'https://www.youtube.com/watch?v=XHOmBV4js_E',
				'label_block' => true,
				'condition'   => [
					'video_type' => 'youtube',
				],
			]
		);

		$this->add_control(
			'vimeo_url',
			[
				'label'   => __( 'Link', 'ultimate' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [
					'active'     => true,
					'categories' => [
						TagsModule:: POST_META_CATEGORY,
						TagsModule:: URL_CATEGORY,
					],
				],
				'placeholder' => __( 'Enter your URL', 'ultimate' ) . ' (Vimeo)',
				'default'     => 'https://vimeo.com/235215203',
				'label_block' => true,
				'condition'   => [
					'video_type' => 'vimeo',
				],
			]
		);

		$this->add_control(
			'dailymotion_url',
			[
				'label'   => __( 'Link', 'ultimate' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [
					'active'     => true,
					'categories' => [
						TagsModule:: POST_META_CATEGORY,
						TagsModule:: URL_CATEGORY,
					],
				],
				'placeholder' => __( 'Enter your URL', 'ultimate' ) . ' (Dailymotion)',
				'default'     => 'https://www.dailymotion.com/video/x6tqhqb',
				'label_block' => true,
				'condition'   => [
					'video_type' => 'dailymotion',
				],
			]
		);

		$this->add_control(
			'insert_url',
			[
				'label'     => __( 'External URL', 'ultimate' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'video_type' => 'hosted',
				],
			]
		);

		$this->add_control(
			'hosted_url',
			[
				'label'   => __( 'Choose File', 'ultimate' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => [
					'active'     => true,
					'categories' => [
						TagsModule:: MEDIA_CATEGORY,
					],
				],
				'media_type' => 'video',
				'condition'  => [
					'video_type' => 'hosted',
					'insert_url' => '',
				],
			]
		);

		$this->add_control(
			'external_url',
			[
				'label'         => __( 'URL', 'ultimate' ),
				'type'          => Controls_Manager::URL,
				'autocomplete'  => false,
				'show_external' => false,
				'label_block'   => true,
				'show_label'    => false,
				'dynamic'       => [
					'active'     => true,
					'categories' => [
						TagsModule:: POST_META_CATEGORY,
						TagsModule:: URL_CATEGORY,
					],
				],
				'media_type'  => 'video',
				'placeholder' => __( 'Enter your URL', 'ultimate' ),
				'condition'   => [
					'video_type' => 'hosted',
					'insert_url' => 'yes',
				],
			]
		);

		$this->add_control(
			'start',
			[
				'label'       => __( 'Start Time', 'ultimate' ),
				'type'        => Controls_Manager::NUMBER,
				'description' => __( 'Specify a start time (in seconds)', 'ultimate' ),
				'condition'   => [
					'loop' => '',
				],
			]
		);

		$this->add_control(
			'end',
			[
				'label'       => __( 'End Time', 'ultimate' ),
				'type'        => Controls_Manager::NUMBER,
				'description' => __( 'Specify an end time (in seconds)', 'ultimate' ),
				'condition'   => [
					'loop'       => '',
					'video_type' => [ 'youtube', 'hosted' ],
				],
			]
		);

		$this->add_control(
			'video_options',
			[
				'label'     => __( 'Video Options', 'ultimate' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'ultimate' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'mute',
			[
				'label' => __( 'Mute', 'ultimate' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'loop',
			[
				'label'     => __( 'Loop', 'ultimate' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'video_type!' => 'dailymotion',
				],
			]
		);

		$this->add_control(
			'controls',
			[
				'label'     => __( 'Player Controls', 'ultimate' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'ultimate' ),
				'label_on'  => __( 'Show', 'ultimate' ),
				'default'   => 'yes',
				'condition' => [
					'video_type!' => 'vimeo',
				],
			]
		);

		$this->add_control(
			'showinfo',
			[
				'label'     => __( 'Video Info', 'ultimate' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'ultimate' ),
				'label_on'  => __( 'Show', 'ultimate' ),
				'default'   => 'yes',
				'condition' => [
					'video_type' => [ 'dailymotion' ],
				],
			]
		);

		$this->add_control(
			'modestbranding',
			[
				'label'     => __( 'Modest Branding', 'ultimate' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'video_type' => [ 'youtube' ],
					'controls'   => 'yes',
				],
			]
		);

		$this->add_control(
			'logo',
			[
				'label'     => __( 'Logo', 'ultimate' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'ultimate' ),
				'label_on'  => __( 'Show', 'ultimate' ),
				'default'   => 'yes',
				'condition' => [
					'video_type' => [ 'dailymotion' ],
				],
			]
		);

		$this->add_control(
			'color',
			[
				'label'     => __( 'Controls Color', 'ultimate' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => [
					'video_type' => [ 'vimeo', 'dailymotion' ],
				],
			]
		);

		// YouTube.
		$this->add_control(
			'yt_privacy',
			[
				'label'       => __( 'Privacy Mode', 'ultimate' ),
				'type'        => Controls_Manager::SWITCHER,
				'description' => __( 'When you turn on privacy mode, YouTube won\'t store information about visitors on your website unless they play the video.', 'ultimate' ),
				'condition'   => [
					'video_type' => 'youtube',
				],
			]
		);

		$this->add_control(
			'rel',
			[
				'label'   => __( 'Suggested Videos', 'ultimate' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''    => __( 'Current Video Channel', 'ultimate' ),
					'yes' => __( 'Any Video', 'ultimate' ),
				],
				'condition' => [
					'video_type' => 'youtube',
				],
			]
		);

		// Vimeo.
		$this->add_control(
			'vimeo_title',
			[
				'label'     => __( 'Intro Title', 'ultimate' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'ultimate' ),
				'label_on'  => __( 'Show', 'ultimate' ),
				'default'   => 'yes',
				'condition' => [
					'video_type' => 'vimeo',
				],
			]
		);

		$this->add_control(
			'vimeo_portrait',
			[
				'label'     => __( 'Intro Portrait', 'ultimate' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'ultimate' ),
				'label_on'  => __( 'Show', 'ultimate' ),
				'default'   => 'yes',
				'condition' => [
					'video_type' => 'vimeo',
				],
			]
		);

		$this->add_control(
			'vimeo_byline',
			[
				'label'     => __( 'Intro Byline', 'ultimate' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'ultimate' ),
				'label_on'  => __( 'Show', 'ultimate' ),
				'default'   => 'yes',
				'condition' => [
					'video_type' => 'vimeo',
				],
			]
		);

		$this->add_control(
			'download_button',
			[
				'label'     => __( 'Download Button', 'ultimate' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'ultimate' ),
				'label_on'  => __( 'Show', 'ultimate' ),
				'condition' => [
					'video_type' => 'hosted',
				],
			]
		);

		$this->add_control(
			'poster',
			[
				'label'     => __( 'Poster', 'ultimate' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => [
					'video_type' => 'hosted',
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label'   => __( 'View', 'ultimate' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'youtube',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_overlay',
			[
				'label' => __( 'Image Overlay', 'ultimate' ),
			]
		);

		$this->add_control(
			'show_image_overlay',
			[
				'label'     => __( 'Image Overlay', 'ultimate' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'ultimate' ),
				'label_on'  => __( 'Show', 'ultimate' ),
			]
		);

		$this->add_control(
			'image_overlay',
			[
				'label'   => __( 'Choose Image', 'ultimate' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'show_image_overlay' => 'yes',
				],
			]
		);

		$this->add_control(
			'lazy_load',
			[
				'label'     => __( 'Lazy Load', 'ultimate' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'show_image_overlay' => 'yes',
					'video_type!'        => 'hosted',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size:: get_type(),
			[
				'name'      => 'image_overlay',   // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_overlay_size` and `image_overlay_custom_dimension`.
				'default'   => 'full',
				'separator' => 'none',
				'condition' => [
					'show_image_overlay' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_play_icon',
			[
				'label'     => __( 'Play Icon', 'ultimate' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'show_image_overlay'  => 'yes',
					'image_overlay[url]!' => '',
				],
			]
		);

		$this->add_control(
			'lightbox',
			[
				'label'              => __( 'Lightbox', 'ultimate' ),
				'type'               => Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'label_off'          => __( 'Off', 'ultimate' ),
				'label_on'           => __( 'On', 'ultimate' ),
				'condition'          => [
					'show_image_overlay'  => 'yes',
					'image_overlay[url]!' => '',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_video_style',
			[
				'label' => __( 'Video', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'aspect_ratio',
			[
				'label'   => __( 'Aspect Ratio', 'ultimate' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'169' => '16:9',
					'219' => '21:9',
					'43'  => '4:3',
					'32'  => '3:2',
					'11'  => '1:1',
				],
				'default'            => '169',
				'prefix_class'       => 'elementor-aspect-ratio-',
				'frontend_available' => true,
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter:: get_type(),
			[
				'name'     => 'css_filters',
				'selector' => '{{WRAPPER}} .elementor-wrapper',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => __( 'Icon', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'icon_style_tabs'
		);

		$this->start_controls_tab(
			'style_icon_normal_tab',
			[
				'label' => __( 'Normal', 'ultimate' ),
			]
		);
			// Width
			$this->add_responsive_control(
				'play_icon_width',
				[
					'label'      => __( 'Width', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 200,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .video__play__button' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			// Height
			$this->add_responsive_control(
				'play_icon_height',
				[
					'label'      => __( 'Height', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 200,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .video__play__button' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'play_icon_color',
				[
					'label'     => __( 'Color', 'ultimate' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .video__play__button' => 'color: {{VALUE}}',
					],
					'condition' => [
						'show_image_overlay' => 'yes',
						'show_play_icon'     => 'yes',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'play_icon_backgroundd',
					'label' => __( 'Background', 'plugin-domain' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .video__play__button,{{WRAPPER}} .video__play__button:before',
				]
			);

			$this->add_responsive_control(
				'play_icon_size',
				[
					'label' => __( 'Size', 'ultimate' ),
					'type'  => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 10,
							'max' => 300,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .video__play__button' => 'font-size: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'show_image_overlay' => 'yes',
						'show_play_icon'     => 'yes',
					],
				]
			);


			$this->add_responsive_control(
				'play_border_radius',
				[
					'label'      => __( 'Border Radius', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .video__play__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow:: get_type(),
				[
					'name'           => 'play_icon_box_shadow',
					'selector'       => '{{WRAPPER}} .video__play__button',
					'condition' => [
						'show_image_overlay' => 'yes',
						'show_play_icon'     => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'play_icon_box_padding',
				[
					'label'      => __( 'Padding', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .video__play__button i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'style_icon_hover_tab',
			[
				'label' => __( 'Hover', 'ultimate' ),
			]
		);

			$this->add_control(
				'play_icon_hover_color',
				[
					'label'     => __( 'Color', 'ultimate' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .video__play__button:hover' => 'color: {{VALUE}}',
					],
					'condition' => [
						'show_image_overlay' => 'yes',
						'show_play_icon'     => 'yes',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'play_icon_hover_backgroundd',
					'label' => __( 'Background', 'plugin-domain' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .video__play__button:hover,{{WRAPPER}} .video__play__button:hover:before',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow:: get_type(),
				[
					'name'           => 'play_icon_hover_box_shadow',
					'selector'       => '{{WRAPPER}} .video__play__button:hover',
					'condition' => [
						'show_image_overlay' => 'yes',
						'show_play_icon'     => 'yes',
					],
				]
			);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[
				'label' => __( 'Overlay Image', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'play_image_width',
				[
					'label'      => __( 'Width', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 200,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-custom-embed-image-overlay img' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'play_image_radius',
				[
					'label'      => __( 'Border Radius', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .elementor-custom-embed-image-overlay img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_lightbox_style',
			[
				'label'     => __( 'Lightbox', 'ultimate' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_image_overlay'  => 'yes',
					'image_overlay[url]!' => '',
					'lightbox'            => 'yes',
				],
			]
		);

		$this->add_control(
			'lightbox_color',
			[
				'label'     => __( 'Background Color', 'ultimate' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#elementor-lightbox-{{ID}}' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'lightbox_ui_color',
			[
				'label'     => __( 'UI Color', 'ultimate' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#elementor-lightbox-{{ID}} .dialog-lightbox-close-button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'lightbox_ui_color_hover',
			[
				'label'     => __( 'UI Hover Color', 'ultimate' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#elementor-lightbox-{{ID}} .dialog-lightbox-close-button:hover' => 'color: {{VALUE}}',
				],
				'separator' => 'after',
			]
		);

		$this->add_control(
			'lightbox_video_width',
			[
				'label'   => __( 'Content Width', 'ultimate' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 50,
					],
				],
				'selectors' => [
					'(desktop+)#elementor-lightbox-{{ID}} .elementor-video-container' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'lightbox_content_position',
			[
				'label'              => __( 'Content Position', 'ultimate' ),
				'type'               => Controls_Manager::SELECT,
				'frontend_available' => true,
				'options'            => [
					''    => __( 'Center', 'ultimate' ),
					'top' => __( 'Top', 'ultimate' ),
				],
				'selectors' => [
					'#elementor-lightbox-{{ID}} .elementor-video-container' => '{{VALUE}}; transform: translateX(-50%);',
				],
				'selectors_dictionary' => [
					'top' => 'top: 60px',
				],
			]
		);

		$this->add_responsive_control(
			'lightbox_content_animation',
			[
				'label'              => __( 'Entrance Animation', 'ultimate' ),
				'type'               => Controls_Manager::ANIMATION,
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render video widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$video_url = $settings[ $settings['video_type'] . '_url' ];

		if ( 'hosted' === $settings['video_type'] ) {
			$video_url = $this->get_hosted_video_url();
		}

		if ( empty( $video_url ) ) {
			return;
		}

		if ( 'hosted' === $settings['video_type'] ) {
			ob_start();

			$this->render_hosted_video();

			$video_html = ob_get_clean();
		} else {
			$embed_params = $this->get_embed_params();

			$embed_options = $this->get_embed_options();

			$video_html = Embed::get_embed_html( $video_url, $embed_params, $embed_options );
		}

		if ( empty( $video_html ) ) {
			echo esc_url( $video_url );

			return;
		}

		$this->add_render_attribute( 'video-wrapper', 'class', 'elementor-wrapper' );

		if ( ! $settings['lightbox'] ) {
			$this->add_render_attribute( 'video-wrapper', 'class', 'elementor-fit-aspect-ratio' );
		}

		$this->add_render_attribute( 'video-wrapper', 'class', 'elementor-open-' . ( $settings['lightbox'] ? 'lightbox' : 'inline' ) );
		?>
		<div <?php echo $this->get_render_attribute_string( 'video-wrapper' ); ?>>
			<?php
			if ( ! $settings['lightbox'] ) {
				echo $video_html; // XSS ok.
			}

			if ( $this->has_image_overlay() ) {
				$this->add_render_attribute( 'image-overlay', 'class', 'elementor-custom-embed-image-overlay' );

				if ( $settings['lightbox'] ) {
					if ( 'hosted' === $settings['video_type'] ) {
						$lightbox_url = $video_url;
					} else {
						$lightbox_url = Embed::get_embed_url( $video_url, $embed_params, $embed_options );
					}

					$lightbox_options = [
						'type'         => 'video',
						'videoType'    => $settings['video_type'],
						'url'          => $lightbox_url,
						'modalOptions' => [
							'id'                       => 'elementor-lightbox-' . $this->get_id(),
							'entranceAnimation'        => $settings['lightbox_content_animation'],
							'entranceAnimation_tablet' => $settings['lightbox_content_animation_tablet'],
							'entranceAnimation_mobile' => $settings['lightbox_content_animation_mobile'],
							'videoAspectRatio'         => $settings['aspect_ratio'],
						],
					];

					if ( 'hosted' === $settings['video_type'] ) {
						$lightbox_options['videoParams'] = $this->get_hosted_params();
					}

					$this->add_render_attribute( 'image-overlay', [
						'data-elementor-open-lightbox' => 'yes',
						'data-elementor-lightbox'      => wp_json_encode( $lightbox_options ),
					] );

					if ( Plugin::$instance->editor->is_edit_mode() ) {
						$this->add_render_attribute( 'image-overlay', [
							'class' => 'elementor-clickable',
						] );
					}
				} else {
					$this->add_render_attribute( 'image-overlay', 'style', 'background-image: url(' . Group_Control_Image_Size::get_attachment_image_src( $settings['image_overlay']['id'], 'image_overlay', $settings ) . ');' );
				}
				?>
				<div <?php echo $this->get_render_attribute_string( 'image-overlay' ); ?>>
					<?php if ( $settings['lightbox'] ) : ?>
						<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_overlay' ); ?>
					<?php endif; ?>
					<?php if ( 'yes' === $settings['show_play_icon'] ) : ?>
						<div class="video__play__button" role="button">
							<i class="fa fa-play" aria-hidden="true"></i>
						</div>
					<?php endif; ?>
				</div>
			<?php } ?>
		</div>
		<?php
	}

	/**
	 * Render video widget as plain content.
	 *
	 * Override the default behavior, by printing the video URL insted of rendering it.
	 *
	 * @since 1.4.5
	 * @access public
	 */
	public function render_plain_content() {
		$settings = $this->get_settings_for_display();

		if ( 'hosted' !== $settings['video_type'] ) {
			$url = $settings[ $settings['video_type'] . '_url' ];
		} else {
			$url = $this->get_hosted_video_url();
		}

		echo esc_url( $url );
	}

	/**
	 * Get embed params.
	 *
	 * Retrieve video widget embed parameters.
	 *
	 * @since 1.5.0
	 * @access public
	 *
	 * @return array Video embed parameters.
	 */
	public function get_embed_params() {
		$settings = $this->get_settings_for_display();

		$params = [];

		if ( $settings['autoplay'] && ! $this->has_image_overlay() ) {
			$params['autoplay'] = '1';
		}

		$params_dictionary = [];

		if ( 'youtube' === $settings['video_type'] ) {
			$params_dictionary = [
				'loop',
				'controls',
				'mute',
				'rel',
				'modestbranding',
			];

			if ( $settings['loop'] ) {
				$video_properties = Embed::get_video_properties( $settings['youtube_url'] );

				$params['playlist'] = $video_properties['video_id'];
			}

			$params['start'] = $settings['start'];

			$params['end'] = $settings['end'];

			$params['wmode'] = 'opaque';
		} elseif ( 'vimeo' === $settings['video_type'] ) {
			$params_dictionary = [
				'loop',
				'mute'           => 'muted',
				'vimeo_title'    => 'title',
				'vimeo_portrait' => 'portrait',
				'vimeo_byline'   => 'byline',
			];

			$params['color'] = str_replace( '#', '', $settings['color'] );

			$params['autopause'] = '0';
		} elseif ( 'dailymotion' === $settings['video_type'] ) {
			$params_dictionary = [
				'controls',
				'mute',
				'showinfo' => 'ui-start-screen-info',
				'logo'     => 'ui-logo',
			];

			$params['ui-highlight'] = str_replace( '#', '', $settings['color'] );

			$params['start'] = $settings['start'];

			$params['endscreen-enable'] = '0';
		}

		foreach ( $params_dictionary as $key => $param_name ) {
			$setting_name = $param_name;

			if ( is_string( $key ) ) {
				$setting_name = $key;
			}

			$setting_value = $settings[ $setting_name ] ? '1' : '0';

			$params[ $param_name ] = $setting_value;
		}

		return $params;
	}

	/**
	 * Whether the video widget has an overlay image or not.
	 *
	 * Used to determine whether an overlay image was set for the video.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return bool Whether an image overlay was set for the video.
	 */
	protected function has_image_overlay() {
		$settings = $this->get_settings_for_display();

		return ! empty( $settings['image_overlay']['url'] ) && 'yes' === $settings['show_image_overlay'];
	}

	/**
	 * @since 2.1.0
	 * @access private
	 */
	private function get_embed_options() {
		$settings = $this->get_settings_for_display();

		$embed_options = [];

		if ( 'youtube' === $settings['video_type'] ) {
			$embed_options['privacy'] = $settings['yt_privacy'];
		} elseif ( 'vimeo' === $settings['video_type'] ) {
			$embed_options['start'] = $settings['start'];
		}

		$embed_options['lazy_load'] = ! empty( $settings['lazy_load'] );

		return $embed_options;
	}

	/**
	 * @since 2.1.0
	 * @access private
	 */
	private function get_hosted_params() {
		$settings = $this->get_settings_for_display();

		$video_params = [];

		foreach ( [ 'autoplay', 'loop', 'controls' ] as $option_name ) {
			if ( $settings[ $option_name ] ) {
				$video_params[ $option_name ] = '';
			}
		}

		if ( $settings['mute'] ) {
			$video_params['muted'] = 'muted';
		}

		if ( ! $settings['download_button'] ) {
			$video_params['controlsList'] = 'nodownload';
		}

		if ( $settings['poster']['url'] ) {
			$video_params['poster'] = $settings['poster']['url'];
		}

		return $video_params;
	}

	/**
	 * @param bool $from_media
	 *
	 * @return string
	 * @since 2.1.0
	 * @access private
	 */
	private function get_hosted_video_url() {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['insert_url'] ) ) {
			$video_url = $settings['external_url']['url'];
		} else {
			$video_url = $settings['hosted_url']['url'];
		}

		if ( empty( $video_url ) ) {
			return '';
		}

		if ( $settings['start'] || $settings['end'] ) {
			$video_url .='#t=';
		}

		if ( $settings['start'] ) {
			$video_url .= $settings['start'];
		}

		if ( $settings['end'] ) {
			$video_url .= ',' . $settings['end'];
		}

		return $video_url;
	}

	/**
	 *
	 * @since 2.1.0
	 * @access private
	 */
	private function render_hosted_video() {
		$video_url = $this->get_hosted_video_url();
		if ( empty( $video_url ) ) {
			return;
		}

		$video_params = $this->get_hosted_params();
		?>
		<video class="elementor-video" src="<?php echo esc_url( $video_url ); ?>" <?php echo Utils::render_html_attributes( $video_params ); ?>></video>
		<?php
	}
}