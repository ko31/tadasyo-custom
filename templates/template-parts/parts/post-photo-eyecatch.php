<?php
/**
 * photo投稿詳細ページ アイキャッチ画像
 *
 * @package ystandard
 * @author  ko31
 * @license GPL-2.0+
 */

?>
<?php
echo get_the_post_thumbnail( get_the_ID(), 'medium' );
?>
