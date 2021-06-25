<h4><?php $text = 'Display Options'; esc_html_e( $text ); ?></h4>

<p><label for="<?php echo $field_ids[ 'title' ]; ?>"><?php $text = 'Title for the widget'; esc_html_e( $text ); ?></label>
<input class="widefat" id="<?php echo $field_ids[ 'title' ]; ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" placeholder="<?php $text = 'Recent Posts'; esc_html_e( $text ); ?>" /><br />
<em><?php esc_html_e( 'This field can be empty.', 'recent-posts-widget-with-thumbnails' );?></em></p>

<p><label for="<?php echo $field_ids[ 'number_posts' ]; ?>"><?php $text = 'Number of posts to show:'; esc_html_e( $text ); ?></label>
<input id="<?php echo $field_ids[ 'number_posts' ]; ?>" name="<?php echo $this->get_field_name( 'number_posts' ); ?>" type="text" value="<?php echo $ints[ 'number_posts' ]; ?>" size="3" /></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'open_new_window' ] ); ?> id="<?php echo $field_ids[ 'open_new_window' ]; ?>" name="<?php echo $this->get_field_name( 'open_new_window' ); ?>" />
<label for="<?php echo $field_ids[ 'open_new_window' ]; ?>"><?php esc_html_e( 'Open post links in new windows?', 'recent-posts-widget-with-thumbnails' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'random_order' ] ); ?> id="<?php echo $field_ids[ 'random_order' ]; ?>" name="<?php echo $this->get_field_name( 'random_order' ); ?>" />
<label for="<?php echo $field_ids[ 'random_order' ]; ?>"><?php esc_html_e( 'Show posts in random order?', 'recent-posts-widget-with-thumbnails' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'hide_current_post' ] ); ?> id="<?php echo $field_ids[ 'hide_current_post' ]; ?>" name="<?php echo $this->get_field_name( 'hide_current_post' ); ?>" />
<label for="<?php echo $field_ids[ 'hide_current_post' ]; ?>"><?php esc_html_e( 'Do not show the current post?', 'recent-posts-widget-with-thumbnails' ); ?></label></p>

<h4><?php $text = 'Sticky'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'only_sticky_posts' ] ); ?> id="<?php echo $field_ids[ 'only_sticky_posts' ]; ?>" name="<?php echo $this->get_field_name( 'only_sticky_posts' ); ?>" />
<label for="<?php echo $field_ids[ 'only_sticky_posts' ]; ?>"><?php esc_html_e( 'Show only sticky posts?', 'recent-posts-widget-with-thumbnails' ); ?><br />
<em><?php esc_html_e( 'If activated the options to hide sticky posts and to keep them on top will be ignored.', 'recent-posts-widget-with-thumbnails' ); ?></em></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'hide_sticky_posts' ] ); ?> id="<?php echo $field_ids[ 'hide_sticky_posts' ]; ?>" name="<?php echo $this->get_field_name( 'hide_sticky_posts' ); ?>" />
<label for="<?php echo $field_ids[ 'hide_sticky_posts' ]; ?>"><?php esc_html_e( 'Do not show sticky posts?', 'recent-posts-widget-with-thumbnails' ); ?><br />
<em><?php esc_html_e( 'If activated the option to keep sticky posts on top will be ignored.', 'recent-posts-widget-with-thumbnails' ); ?></em></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'keep_sticky' ] ); ?> id="<?php echo $field_ids[ 'keep_sticky' ]; ?>" name="<?php echo $this->get_field_name( 'keep_sticky' ); ?>" />
<label for="<?php echo $field_ids[ 'keep_sticky' ]; ?>"><?php esc_html_e( 'Keep sticky posts on top of the list?', 'recent-posts-widget-with-thumbnails' ); ?></label></p>

<h4><?php $text = 'Title'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'hide_title' ] ); ?> id="<?php echo $field_ids[ 'hide_title' ]; ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" />
<label for="<?php echo $field_ids[ 'hide_title' ]; ?>"><?php esc_html_e( 'Do not show post title?', 'recent-posts-widget-with-thumbnails' ); ?><br />
<em><?php esc_html_e( 'Make sure you set a default thumbnail for posts without a thumbnail, otherwise there will be no link.', 'recent-posts-widget-with-thumbnails' ); ?></em></label></p>

<p><label for="<?php echo $field_ids[ 'post_title_length' ]; ?>"><?php esc_html_e( 'Maximum length of post title', 'recent-posts-widget-with-thumbnails' ); ?>:</label>
<input id="<?php echo $field_ids[ 'post_title_length' ]; ?>" name="<?php echo $this->get_field_name( 'post_title_length' ); ?>" type="text" value="<?php echo $ints[ 'post_title_length' ]; ?>" size="3" /></p>

<h4><?php $text = 'Author'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_author' ] ); ?> id="<?php echo $field_ids[ 'show_author' ]; ?>" name="<?php echo $this->get_field_name( 'show_author' ); ?>" />
<label for="<?php echo $field_ids[ 'show_author' ]; ?>"><?php esc_html_e( 'Show post author?', 'recent-posts-widget-with-thumbnails' ); ?></label></p>

<p><label for="<?php echo $field_ids[ 'author_label' ]; ?>"><?php esc_html_e( 'Label for authors:', 'recent-posts-widget-with-thumbnails' ); ?></label>
<input class="widefat" id="<?php echo $field_ids[ 'author_label' ]; ?>" name="<?php echo $this->get_field_name( 'author_label' ); ?>" type="text" value="<?php echo esc_attr( $optional_texts[ 'author_label' ] ); ?>" placeholder="<?php echo $this->defaults[ 'author_label' ]; ?>" /><br />
<em><?php esc_html_e( 'This field can be empty.', 'recent-posts-widget-with-thumbnails' );?> <?php esc_html_e( 'A space will be added automatically between the label and the name.', 'recent-posts-widget-with-thumbnails' );?></em></p>

<h4><?php $text = 'Categories'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_categories' ] ); ?> id="<?php echo $field_ids[ 'show_categories' ]; ?>" name="<?php echo $this->get_field_name( 'show_categories' ); ?>" />
<label for="<?php echo $field_ids[ 'show_categories' ]; ?>"><?php esc_html_e( 'Show post categories?', 'recent-posts-widget-with-thumbnails' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'set_cats_as_links' ] ); ?> id="<?php echo $field_ids[ 'set_cats_as_links' ]; ?>" name="<?php echo $this->get_field_name( 'set_cats_as_links' ); ?>" />
<label for="<?php echo $field_ids[ 'set_cats_as_links' ]; ?>"><?php esc_html_e( 'Set post category names as links, pointing to their archives?', 'recent-posts-widget-with-thumbnails' ); ?></label></p>

<p><label for="<?php echo $field_ids[ 'category_label' ]; ?>"><?php esc_html_e( 'Label for categories:', 'recent-posts-widget-with-thumbnails' ); ?></label>
<input class="widefat" id="<?php echo $field_ids[ 'category_label' ]; ?>" name="<?php echo $this->get_field_name( 'category_label' ); ?>" type="text" value="<?php echo esc_attr( $optional_texts[ 'category_label' ] ); ?>" placeholder="<?php echo $this->defaults[ 'category_label' ]; ?>" /><br />
<em><?php esc_html_e( 'This field can be empty.', 'recent-posts-widget-with-thumbnails' );?> <?php esc_html_e( 'A space will be added automatically between the label and the name.', 'recent-posts-widget-with-thumbnails' );?></em></p>

<h4><?php $text = 'Date'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_date' ] ); ?> id="<?php echo $field_ids[ 'show_date' ]; ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
<label for="<?php echo $field_ids[ 'show_date' ]; ?>"><?php esc_html_e( 'Show post date?', 'recent-posts-widget-with-thumbnails' ); ?></label></p>

<h4><?php $text = 'Excerpt'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_excerpt' ] ); ?> id="<?php echo $field_ids[ 'show_excerpt' ]; ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" />
<label for="<?php echo $field_ids[ 'show_excerpt' ]; ?>"><?php esc_html_e( 'Show excerpt?', 'recent-posts-widget-with-thumbnails' ); ?></label></p>

<p><label for="<?php echo $field_ids[ 'excerpt_length' ]; ?>"><?php esc_html_e( 'Maximum length of excerpt', 'recent-posts-widget-with-thumbnails' ); ?>:</label>
<input id="<?php echo $field_ids[ 'excerpt_length' ]; ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" type="text" value="<?php echo $ints[ 'excerpt_length' ]; ?>" size="3" /></p>

<p><label for="<?php echo $field_ids[ 'excerpt_more' ]; ?>"><?php esc_html_e( 'Signs after excerpt', 'recent-posts-widget-with-thumbnails' ); ?>:</label>
<input id="<?php echo $field_ids[ 'excerpt_more' ]; ?>" name="<?php echo $this->get_field_name( 'excerpt_more' ); ?>" type="text" value="<?php echo esc_attr( $optional_texts[ 'excerpt_more' ] ); ?>" size="3" /></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'set_more_as_link' ] ); ?> id="<?php echo $field_ids[ 'set_more_as_link' ]; ?>" name="<?php echo $this->get_field_name( 'set_more_as_link' ); ?>" />
<label for="<?php echo $field_ids[ 'set_more_as_link' ]; ?>"><?php esc_html_e( 'Set signs after excerpt as a link to the post?', 'recent-posts-widget-with-thumbnails' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'ignore_excerpt' ] ); ?> id="<?php echo $field_ids[ 'ignore_excerpt' ]; ?>" name="<?php echo $this->get_field_name( 'ignore_excerpt' ); ?>" />
<label for="<?php echo $field_ids[ 'ignore_excerpt' ]; ?>"><?php esc_html_e( 'Ignore post excerpt field as excerpt source?', 'recent-posts-widget-with-thumbnails' ); ?></label><br />
<em><?php esc_html_e( 'Normally the widget takes the excerpt from the text of the excerpt field unchanged and if there is no text it creates the excerpt from the post content automatically. If this option is activated the excerpt is created from the post content only.', 'recent-posts-widget-with-thumbnails' );?></em></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'ignore_post_content_excerpt' ] ); ?> id="<?php echo $field_ids[ 'ignore_post_content_excerpt' ]; ?>" name="<?php echo $this->get_field_name( 'ignore_post_content_excerpt' ); ?>" />
<label for="<?php echo $field_ids[ 'ignore_post_content_excerpt' ]; ?>"><?php esc_html_e( 'Ignore post content as excerpt source?', 'recent-posts-widget-with-thumbnails' ); ?></label><br />
<em><?php esc_html_e( 'If activated, the excerpts are created only by the excerpt fields. If both Ignore checkboxes are activated no excerpts are displayed in the list.', 'recent-posts-widget-with-thumbnails' );?></em></p>

<h4><?php $text = 'Comments'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_comments_number' ] ); ?> id="<?php echo $field_ids[ 'show_comments_number' ]; ?>" name="<?php echo $this->get_field_name( 'show_comments_number' ); ?>" />
<label for="<?php echo $field_ids[ 'show_comments_number' ]; ?>"><?php esc_html_e( 'Show number of comments?', 'recent-posts-widget-with-thumbnails' ); ?></label></p>

<h4><?php $text = 'Filter by category'; esc_html_e( $text ); ?></h4>

<p><label for="<?php echo $field_ids[ 'category_ids' ];?>"><?php esc_html_e( 'Show posts of selected categories only?', 'recent-posts-widget-with-thumbnails' ); ?></label><br />
<?php echo $selection_element; ?><br />
<em><?php printf( esc_html__( 'Click on the categories with pressed CTRL key to select multiple categories. If &#8220;%s&#8221; was selected then other selections will be ignored.', 'recent-posts-widget-with-thumbnails' ), $label_all_cats ); ?></em></p>

<h4><?php $text = 'Thumbnail Settings'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'show_thumb' ] ); ?> id="<?php echo $field_ids[ 'show_thumb' ]; ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" />
<label for="<?php echo $field_ids[ 'show_thumb' ]; ?>"><?php esc_html_e( 'Show thumbnail?', 'recent-posts-widget-with-thumbnails' ); ?></label><br>
<em><?php esc_html_e( 'By default, the featured image of the post is used as long as the next checkboxes do not specify anything different.', 'recent-posts-widget-with-thumbnails' ); ?></em></p>

<p><label for="<?php echo $field_ids[ 'thumb_dimensions' ]; ?>"><?php esc_html_e( 'Size of thumbnail', 'recent-posts-widget-with-thumbnails' ); ?>:</label>
	<select id="<?php echo $field_ids[ 'thumb_dimensions' ]; ?>" name="<?php echo $this->get_field_name( 'thumb_dimensions' ); ?>">
		<option value="<?php echo $this->defaults[ 'thumb_dimensions' ]; ?>" <?php selected( $thumb_dimensions, $this->defaults[ 'thumb_dimensions' ] ); ?>><?php esc_html_e( 'Specified width and height', 'recent-posts-widget-with-thumbnails' ); ?></option>
<?php
// Display the sizes in the array
foreach ( $size_options as $option ) {
?>
		<option value="<?php echo esc_attr( $option[ 'size_name' ] ); ?>"<?php selected( $thumb_dimensions, $option[ 'size_name' ] ); ?>><?php echo esc_html( $option[ 'name' ] ); ?> (<?php echo absint( $option[ 'width' ] ); ?> &times; <?php echo absint( $option[ 'height' ] ); ?>)</option>
<?php
} // end foreach(option)
?>
	</select><br />
	<em><?php printf( esc_html__( 'If you use a specified size the following sizes will be taken, otherwise they will be ignored and the selected dimension as stored in %s will be used:', 'recent-posts-widget-with-thumbnails' ), $media_trail ); ?></em>
</p>

<p><label for="<?php echo $field_ids[ 'thumb_width' ]; ?>"><?php esc_html_e( 'Width of thumbnail', 'recent-posts-widget-with-thumbnails' ); ?>:</label>
<input id="<?php echo $field_ids[ 'thumb_width' ]; ?>" name="<?php echo $this->get_field_name( 'thumb_width' ); ?>" type="text" value="<?php echo $ints[ 'thumb_width' ]; ?>" size="3" /></p>

<p><label for="<?php echo $field_ids[ 'thumb_height' ]; ?>"><?php esc_html_e( 'Height of thumbnail', 'recent-posts-widget-with-thumbnails' ); ?>:</label>
<input id="<?php echo $field_ids[ 'thumb_height' ]; ?>" name="<?php echo $this->get_field_name( 'thumb_height' ); ?>" type="text" value="<?php echo $ints[ 'thumb_height' ]; ?>" size="3" /></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'keep_aspect_ratio' ] ); ?> id="<?php echo $field_ids[ 'keep_aspect_ratio' ]; ?>" name="<?php echo $this->get_field_name( 'keep_aspect_ratio' ); ?>" />
<label for="<?php echo $field_ids[ 'keep_aspect_ratio' ]; ?>"><?php esc_html_e( 'Use aspect ratios of original images?', 'recent-posts-widget-with-thumbnails' ); ?><br />
<em><?php esc_html_e( 'If activated the given width is used to determine the height of the thumbnail automatically. This option also supports responsive web design.', 'recent-posts-widget-with-thumbnails' ); ?></em></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'try_1st_img' ] ); ?> id="<?php echo $field_ids[ 'try_1st_img' ]; ?>" name="<?php echo $this->get_field_name( 'try_1st_img' ); ?>" />
<label for="<?php echo $field_ids[ 'try_1st_img' ]; ?>"><?php esc_html_e( "Try to use the post's first image if post has no featured image?", 'recent-posts-widget-with-thumbnails' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'only_1st_img' ] ); ?> id="<?php echo $field_ids[ 'only_1st_img' ]; ?>" name="<?php echo $this->get_field_name( 'only_1st_img' ); ?>" />
<label for="<?php echo $field_ids[ 'only_1st_img' ]; ?>"><?php esc_html_e( 'Use first image only, ignore featured image?', 'recent-posts-widget-with-thumbnails' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'use_default' ] ); ?> id="<?php echo $field_ids[ 'use_default' ]; ?>" name="<?php echo $this->get_field_name( 'use_default' ); ?>" />
<label for="<?php echo $field_ids[ 'use_default' ]; ?>"><?php esc_html_e( 'Use default thumbnail if no image could be determined?', 'recent-posts-widget-with-thumbnails' ); ?></label></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'use_default_only' ] ); ?> id="<?php echo $field_ids[ 'use_default_only' ]; ?>" name="<?php echo $this->get_field_name( 'use_default_only' ); ?>" />
<label for="<?php echo $field_ids[ 'use_default_only' ]; ?>"><?php esc_html_e( 'Ignore all thumbnails and always use only the default thumbnail?', 'recent-posts-widget-with-thumbnails' ); ?></label></p>

<p><label for="<?php echo $field_ids[ 'default_url' ]; ?>"><?php esc_html_e( 'URL of default thumbnail (start with http://)', 'recent-posts-widget-with-thumbnails' ); ?>:</label>
<input class="widefat" id="<?php echo $field_ids[ 'default_url' ]; ?>" name="<?php echo $this->get_field_name( 'default_url' ); ?>" type="text" value="<?php echo esc_url( $default_url ); ?>" /></p>

<p><label for="<?php echo $field_ids[ 'thumb_alt' ]; ?>"><?php esc_html_e( 'Alt text of the default thumbnail:', 'recent-posts-widget-with-thumbnails' ); ?></label>
<input class="widefat" id="<?php echo $field_ids[ 'thumb_alt' ]; ?>" name="<?php echo $this->get_field_name( 'thumb_alt' ); ?>" type="text" value="<?php echo esc_attr( $optional_texts[ 'thumb_alt' ] ); ?>" placeholder="<?php echo $this->defaults[ 'thumb_alt' ]; ?>" /><br />
<em><?php 
$text_1 = '<a href="%1$s" %2$s>Describe the purpose of the image%3$s</a>. Leave empty if the image is purely decorative.';
$text_2 = '(opens in a new tab)';
printf(
	__( $text_1 ),
	esc_url( 'https://www.w3.org/WAI/tutorials/images/decision-tree' ),
	'target="_blank" rel="noopener noreferrer"',
	sprintf(
		'<span class="screen-reader-text"> %s</span>',
		__( $text_2 )
	)
);?></em></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'hide_alt_texts' ] ); ?> id="<?php echo $field_ids[ 'hide_alt_texts' ]; ?>" name="<?php echo $this->get_field_name( 'hide_alt_texts' ); ?>" />
<label for="<?php echo $field_ids[ 'hide_alt_texts' ]; ?>"><?php esc_html_e( 'Omit alternative texts of the thumbnails?', 'recent-posts-widget-with-thumbnails' ); ?></label><br>
<em><?php esc_html_e( 'Activate this option to eliminate possible confusion when the alternative texts and the post titles do not refer to each other. This can improve the accessibility of the post list. Do not activate this option if the post titles are hidden.', 'recent-posts-widget-with-thumbnails' ); ?></em></p>

<h4><?php $text = 'Additional settings'; esc_html_e( $text ); ?></h4>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'print_post_categories' ] ); ?> id="<?php echo $field_ids[ 'print_post_categories' ]; ?>" name="<?php echo $this->get_field_name( 'print_post_categories' ); ?>" />
<label for="<?php echo $field_ids[ 'print_post_categories' ]; ?>"><?php esc_html_e( 'Print slugs of post categories in class attribute of LI elements?', 'recent-posts-widget-with-thumbnails' ); ?></label><br />
<em><?php esc_html_e( 'For developers: If checked you can set CSS rules for each list item on base of the assigned categories.', 'recent-posts-widget-with-thumbnails' ); ?></em></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'use_inline_css' ] ); ?> id="<?php echo $field_ids[ 'use_inline_css' ]; ?>" name="<?php echo $this->get_field_name( 'use_inline_css' ); ?>" />
<label for="<?php echo $field_ids[ 'use_inline_css' ]; ?>"><?php esc_html_e( 'Print inline CSS instead of creating a CSS file?', 'recent-posts-widget-with-thumbnails' ); ?></label><br />
<em><?php esc_html_e( 'If activated this option applies to all instances of this widget.', 'recent-posts-widget-with-thumbnails' ); ?></em></p>

<p><input class="checkbox" type="checkbox" <?php checked( $bools[ 'use_no_css' ] ); ?> id="<?php echo $field_ids[ 'use_no_css' ]; ?>" name="<?php echo $this->get_field_name( 'use_no_css' ); ?>" />
<label for="<?php echo $field_ids[ 'use_no_css' ]; ?>"><?php esc_html_e( 'No CSS generation at all, neither inline CSS nor a CSS file?', 'recent-posts-widget-with-thumbnails' ); ?></label><br />
<em><?php esc_html_e( 'If activated this option applies to all instances of this widget.', 'recent-posts-widget-with-thumbnails' ); ?></em></p>

<p><?php esc_html_e( 'Do you like the plugin?', 'recent-posts-widget-with-thumbnails' ); ?> <a href="https://wordpress.org/support/plugin/recent-posts-widget-with-thumbnails/reviews/" target="_blank"><?php esc_html_e( 'Please rate it at wordpress.org!', 'recent-posts-widget-with-thumbnails' ); ?></a></p>
