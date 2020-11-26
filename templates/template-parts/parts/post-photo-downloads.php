<?php
/**
 * photo投稿詳細ページ ダウンロードボタン
 *
 * @package ystandard
 * @author  ko31
 * @license GPL-2.0+
 */

?>
<h3>＼ 無料ダウンロードはこちら ／</h3>
<div class="wp-block-buttons">
	<?php
	$sizes = [
		'thumbnail' => 'SMALL サイズ',
		'medium'    => 'MEDIUM サイズ',
		'large'     => 'LARGE サイズ',
	];
	foreach ( $sizes as $key => $val ):
		if ( $url = get_the_post_thumbnail_url( get_the_ID(), $key ) ):
			$filename = basename( $url );
			?>
            <div class="wp-block-button"><a href="<?php echo esc_url( $url ); ?>"
                                            download="<?php echo esc_attr( $filename ); ?>"
                                            class="wp-block-button__link"
                                            target="_blank"><?php echo esc_html( $val ); ?></a></div>
		<?php
		endif;
	endforeach;
	?>

	<?php
	ys_get_template_part( 'template-parts/single/pagination' );
	?>
</div>
