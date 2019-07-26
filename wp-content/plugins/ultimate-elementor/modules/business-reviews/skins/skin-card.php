<?php
/**
 * UAEL BusinessReviews Skin - Card.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\BusinessReviews\Skins;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

use UltimateElementor\Modules\BusinessReviews\TemplateBlocks\Skin_Init;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Skin_Card
 *
 * @property Products $parent
 */
class Skin_Card extends Skin_Base {

	/**
	 * Get ID.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function get_id() {
		return 'card';
	}

	/**
	 * Get title.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function get_title() {
		return __( 'Card', 'uael' );
	}

	/**
	 * Register Control Actions.
	 *
	 * @since 1.13.0
	 * @access protected
	 */
	protected function _register_controls_actions() {

		parent::_register_controls_actions();

		add_action( 'elementor/element/uael-business-reviews/card_section_info_controls/before_section_end', [ $this, 'update_image_controls' ] );

		add_action( 'elementor/element/uael-business-reviews/card_section_date_controls/before_section_end', [ $this, 'register_update_date_controls' ] );

		add_action( 'elementor/element/uael-business-reviews/card_section_styling/before_section_end', [ $this, 'update_box_style_controls' ] );

		add_action( 'elementor/element/uael-business-reviews/card_section_spacing/before_section_end', [ $this, 'update_spacing_controls' ] );
	}

	/**
	 * Update Date control.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function update_image_controls() {
		$this->update_control(
			'image_align',
			[
				'default'   => 'top',
				'condition' => [
					$this->get_control_id( 'reviewer_image' ) => 'yes',
				],
			]
		);

		$this->update_control(
			'review_source_icon',
			[
				'default'   => 'no',
				'condition' => [
					$this->get_control_id( 'image_align' ) . '!' => 'top',
				],
			]
		);

		$this->update_control(
			'image_size',
			[
				'default' => [
					'size' => 55,
				],
			]
		);
	}

	/**
	 * Update Date control.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function register_update_date_controls() {
		$this->update_control(
			'review_date',
			[
				'default' => 'yes',
			]
		);
	}

	/**
	 * Register Styling Controls.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function update_spacing_controls() {

		$this->remove_control( 'reviewer_name_spacing' );

		$this->add_responsive_control(
			'reviewer_content_spacing',
			[
				'label'     => __( 'Content Bottom Spacing', 'uael' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 15,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .uael-review-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
	}

	/**
	 * Update Box control.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function update_box_style_controls() {

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'card_block_border',
				'label'          => __( 'Border', 'uael' ),
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width'  => [
						'default' => [
							'top'    => '1',
							'right'  => '1',
							'bottom' => '1',
							'left'   => '1',
						],
					],
					'color'  => [
						'default' => '#ededed',
					],
				],
				'selector'       => '{{WRAPPER}} .uael-review',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'card_block_box_shadow',
				'selector' => '{{WRAPPER}} .uael-review',
			]
		);
	}

	/**
	 * Render Main HTML.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function render() {

		$settings = $this->parent->get_settings_for_display();

		$skin = Skin_Init::get_instance( $this->get_id() );

		echo $skin->render( $this->get_id(), $settings, $this->parent->get_id() );
	}
}
