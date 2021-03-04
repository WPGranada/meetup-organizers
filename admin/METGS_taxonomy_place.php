<?php defined( 'ABSPATH' ) or die( 'Not today.' );

class METGS_taxonomy_place extends METGS_admin_taxonomies {
	public $cpt_meetings = METGS_CPT_MEETING;
	public $taxonomy = METGS_TAX_PLACE;
	public $taxonomy_rewrite = 'place';

	function __construct() {

	}

	public function initTaxonomy() {
		add_action( 'init', array( $this, 'taxonomy_register' ) );
		parent::initTaxonomies();
	}

	function taxonomy_register() {

		$labels = array(
			'name'              => __( 'Places', 'meetings' ),
			'singular_name'     => __( 'Place', 'meetings' ),
			'search_items'      => __( 'Search place', 'meetings' ),
			'all_items'         => __( 'All places', 'meetings' ),
			'parent_item'       => __( 'Parent place', 'meetings' ),
			'parent_item_colon' => __( 'Parent place:', 'meetings' ),
			'edit_item'         => __( 'Edit place', 'meetings' ),
			'update_item'       => __( 'Update place', 'meetings' ),
			'add_new_item'      => __( 'Add new place', 'meetings' ),
			'new_item_name'     => __( 'New place', 'meetings' ),
			'menu_name'         => __( 'Places', 'meetings' ),
		);

		$rewrite = array(
			'slug'         => $this->taxonomy_rewrite,
			'with_front'   => true,
			'hierarchical' => false,
		);

		$args                 = $this->getStandardPublicTaxonomyArgs( $labels );
		$args['hierarchical'] = false;
		$args['rewrite']      = $rewrite;

		register_taxonomy( $this->taxonomy, $this->cpt_meetings, $args );

	}

	function add_metaboxes($taxonomy, $term_id=0){
		$inputObj = new METGS_functions_inputs($this->prefix.'_image', $term_id, 'taxonomy');
		$inputObj->setInput(false, __('Image', 'metgs'));
		$inputObj->showImage();

		$inputObj = new METGS_functions_inputs($this->prefix.'_social_links', $term_id, 'taxonomy');
		$inputObj->setInput(false, __('Social links', 'metgs'));
		$inputObj->showSocialLinks();

		$inputObj = new METGS_functions_inputs($this->prefix.'_street', $term_id, 'taxonomy');
		$inputObj->setInput(false, __('Street', 'metgs'));
		$inputObj->showText();

		$inputObj = new METGS_functions_inputs($this->prefix.'_address_details', $term_id, 'taxonomy');
		$inputObj->setInput(false, __('Address details', 'metgs'));
		$inputObj->showText();

		$inputObj = new METGS_functions_inputs($this->prefix.'_cp', $term_id, 'taxonomy');
		$inputObj->setInput(false, __('Postal code', 'metgs'));
		$inputObj->showText();

		$inputObj = new METGS_functions_inputs($this->prefix.'_city', $term_id, 'taxonomy');
		$inputObj->setInput(false, __('City', 'metgs'));
		$inputObj->showText();

		$inputObj = new METGS_functions_inputs($this->prefix.'_state', $term_id, 'taxonomy');
		$inputObj->setInput(false, __('State', 'metgs'));
		$inputObj->showText();

		$inputObj = new METGS_functions_inputs($this->prefix.'_country', $term_id, 'taxonomy');
		$inputObj->setInput(false, __('Country', 'metgs'));
		$inputObj->showCountry();
	}

	function add_metaboxes_scripts($screen){
		if ( ( $screen->base == 'term' || $screen->base == 'edit-tags' ) && $screen->taxonomy == $this->taxonomy ) {
			add_action( 'admin_enqueue_scripts', array( 'METGS_functions_inputs', 'enqueueImageScripts' ) );
		}
	}

	function save_metaboxes($term_id){
		$inputObj = new METGS_functions_inputs($this->prefix.'_image', $term_id, 'taxonomy');
		$inputObj->save();

		$inputObj = new METGS_functions_inputs($this->prefix.'_social_links', $term_id, 'taxonomy');
		$inputObj->saveSocialLinks();

		$inputObj = new METGS_functions_inputs($this->prefix.'_street', $term_id, 'taxonomy');
		$inputObj->save();

		$inputObj = new METGS_functions_inputs($this->prefix.'_address_details', $term_id, 'taxonomy');
		$inputObj->save();

		$inputObj = new METGS_functions_inputs($this->prefix.'_address_details', $term_id, 'taxonomy');
		$inputObj->save();

		$inputObj = new METGS_functions_inputs($this->prefix.'_city', $term_id, 'taxonomy');
		$inputObj->save();

		$inputObj = new METGS_functions_inputs($this->prefix.'_state', $term_id, 'taxonomy');
		$inputObj->save();

		$inputObj = new METGS_functions_inputs($this->prefix.'_country', $term_id, 'taxonomy');
		$inputObj->save();
	}
}



