<?php
/**
 * Initialize custom post type photo.
 */
add_action( 'init', function () {
	register_post_type( 'photo', [
		'has_archive'  => true,
		'public'       => true,
		'supports'     => [ 'title', 'editor', 'thumbnail', 'author' ],
		'label'        => '写真',
		'menu_icon'    => 'dashicons-media-default',
		'show_in_rest' => true,
		'rewrite'      => [
			'with_front' => false
		],

	] );

	add_rewrite_rule( 'photo/([0-9]+)/?$', 'index.php?post_type=photo&p=$matches[1]', 'top' );

	register_taxonomy( 'photo-cat', [ 'photo' ], [
		'label'             => 'カテゴリー',
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => [
			'hierarchical' => true,
		],
		'show_in_rest'      => true,
	] );

	register_taxonomy( 'photo-tag', [ 'photo' ], [
		'label'             => 'タグ',
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => [
			'hierarchical' => true,
		],
		'show_in_rest'      => true,
	] );
} );

/**
 * Add filters for the permalink of the custom post type.
 */
add_filter( 'post_type_link', 'tts_post_link_photo', 10, 2 );
add_filter( 'post_link', 'tts_post_link_photo', 10, 2 );
function tts_post_link_photo( $post_link, $post ) {
	if ( 'photo' === $post->post_type ) {
		return home_url( '/photo/' . $post->ID );
	}

	return $post_link;
}

/**
 * Add filters for the contents.
 */
add_filter( 'the_content', function ( $content ) {
	// Post type photo only.
	if ( ! is_singular( 'photo' ) ) {
		return $content;
	}

	// Add contents before original contents.
	ob_start();
	ys_get_template_part( TDS_DIRPATH . 'templates/template-parts/parts/post-photo-eyecatch.php' );
	$content = ob_get_clean() . $content;

	// Add contents after original contents.
	ob_start();
	ys_get_template_part( TDS_DIRPATH . 'templates/template-parts/parts/post-photo-downloads.php' );
	$content .= ob_get_clean();

	return $content;
} );
