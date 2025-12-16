<?php
/**
 * Comments Template
 * 
 * @package IrimasKitchen
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area bg-white rounded-2xl shadow-lg overflow-hidden">
    
    <!-- Comments Header -->
    <div class="bg-gradient-to-r from-irimas-blue to-irimas-blue/90 px-8 py-6">
        <h2 class="text-2xl font-bold text-white font-playfair flex items-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <?php
            $comment_count = get_comments_number();
            if ($comment_count == 0) {
                _e('Join the Conversation', 'irimas-kitchen');
            } else {
                printf(
                    _n('%s Comment', '%s Comments', $comment_count, 'irimas-kitchen'),
                    number_format_i18n($comment_count)
                );
            }
            ?>
        </h2>
    </div>
    
    <?php if (have_comments()) : ?>
        
        <!-- Comments List -->
        <div class="p-8">
            <ol class="comment-list space-y-6">
                <?php
                wp_list_comments(array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'callback'    => 'irimas_comment_callback',
                ));
                ?>
            </ol>
            
            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                <nav class="comment-navigation mt-8 pt-6 border-t border-gray-200">
                    <div class="flex justify-between">
                        <div class="nav-previous">
                            <?php previous_comments_link('<span class="text-irimas-red hover:text-irimas-blue transition">&larr; ' . __('Older Comments', 'irimas-kitchen') . '</span>'); ?>
                        </div>
                        <div class="nav-next">
                            <?php next_comments_link('<span class="text-irimas-red hover:text-irimas-blue transition">' . __('Newer Comments', 'irimas-kitchen') . ' &rarr;</span>'); ?>
                        </div>
                    </div>
                </nav>
            <?php endif; ?>
        </div>
        
    <?php endif; ?>
    
    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <div class="p-8">
            <p class="no-comments text-gray-500 text-center py-4 bg-gray-50 rounded-lg">
                <?php _e('Comments are closed.', 'irimas-kitchen'); ?>
            </p>
        </div>
    <?php endif; ?>
    
    <?php if (comments_open()) : ?>
        <!-- Comment Form -->
        <div class="p-8 bg-cream-light border-t border-gray-200">
            <?php
            $commenter = wp_get_current_commenter();
            $req = get_option('require_name_email');
            $aria_req = ($req ? " aria-required='true' required" : '');
            
            $fields = array(
                'author' => sprintf(
                    '<div class="mb-4"><label for="author" class="block text-sm font-medium text-gray-700 mb-2">%s %s</label><input id="author" name="author" type="text" value="%s" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-irimas-red focus:ring-2 focus:ring-irimas-red/20 outline-none transition" placeholder="%s" %s /></div>',
                    __('Name', 'irimas-kitchen'),
                    ($req ? '<span class="text-irimas-red">*</span>' : ''),
                    esc_attr($commenter['comment_author']),
                    __('Your name', 'irimas-kitchen'),
                    $aria_req
                ),
                'email' => sprintf(
                    '<div class="mb-4"><label for="email" class="block text-sm font-medium text-gray-700 mb-2">%s %s</label><input id="email" name="email" type="email" value="%s" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-irimas-red focus:ring-2 focus:ring-irimas-red/20 outline-none transition" placeholder="%s" %s /></div>',
                    __('Email', 'irimas-kitchen'),
                    ($req ? '<span class="text-irimas-red">*</span>' : ''),
                    esc_attr($commenter['comment_author_email']),
                    __('your@email.com', 'irimas-kitchen'),
                    $aria_req
                ),
                'url' => sprintf(
                    '<div class="mb-4"><label for="url" class="block text-sm font-medium text-gray-700 mb-2">%s</label><input id="url" name="url" type="url" value="%s" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-irimas-red focus:ring-2 focus:ring-irimas-red/20 outline-none transition" placeholder="%s" /></div>',
                    __('Website', 'irimas-kitchen'),
                    esc_attr($commenter['comment_author_url']),
                    __('https://yourwebsite.com', 'irimas-kitchen')
                ),
            );
            
            comment_form(array(
                'title_reply' => __('Leave a Comment', 'irimas-kitchen'),
                'title_reply_to' => __('Reply to %s', 'irimas-kitchen'),
                'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title text-xl font-bold font-playfair text-irimas-blue mb-6 flex items-center gap-2">',
                'title_reply_after' => '</h3>',
                'cancel_reply_before' => ' <small class="text-sm font-normal">',
                'cancel_reply_after' => '</small>',
                'cancel_reply_link' => __('Cancel', 'irimas-kitchen'),
                'comment_notes_before' => '<p class="comment-notes text-sm text-gray-500 mb-6">' . __('Your email address will not be published. Required fields are marked *', 'irimas-kitchen') . '</p>',
                'fields' => $fields,
                'comment_field' => sprintf(
                    '<div class="mb-4"><label for="comment" class="block text-sm font-medium text-gray-700 mb-2">%s <span class="text-irimas-red">*</span></label><textarea id="comment" name="comment" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-irimas-red focus:ring-2 focus:ring-irimas-red/20 outline-none transition resize-none" placeholder="%s" required></textarea></div>',
                    __('Comment', 'irimas-kitchen'),
                    __('Share your thoughts...', 'irimas-kitchen')
                ),
                'class_form' => 'comment-form',
                'class_submit' => 'btn-primary cursor-pointer',
                'submit_button' => '<button type="submit" name="%1$s" id="%2$s" class="%3$s">%4$s</button>',
                'submit_field' => '<div class="form-submit">%1$s %2$s</div>',
                'label_submit' => __('Post Comment', 'irimas-kitchen'),
            ));
            ?>
        </div>
    <?php endif; ?>
    
</div>

<?php
/**
 * Custom comment callback function
 */
function irimas_comment_callback($comment, $args, $depth) {
    $tag = ($args['style'] === 'div') ? 'div' : 'li';
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class('comment-item'); ?>>
        <article class="comment-body bg-gray-50 rounded-xl p-6 <?php echo ($depth > 1) ? 'ml-8 mt-4' : ''; ?>">
            <header class="comment-meta flex items-start gap-4 mb-4">
                <div class="comment-author-avatar flex-shrink-0">
                    <div class="w-12 h-12 rounded-full overflow-hidden ring-2 ring-white shadow">
                        <?php echo get_avatar($comment, 48, '', '', array('class' => 'w-full h-full object-cover')); ?>
                    </div>
                </div>
                <div class="comment-metadata flex-1">
                    <div class="comment-author font-bold text-irimas-blue">
                        <?php comment_author(); ?>
                    </div>
                    <?php if ($comment->user_id === get_post_field('post_author', get_the_ID())): ?>
                        <span class="inline-block bg-irimas-red text-white text-xs px-2 py-0.5 rounded-full ml-2">
                            <?php _e('Author', 'irimas-kitchen'); ?>
                        </span>
                    <?php endif; ?>
                </div>
            </header>
            
            <?php if ($comment->comment_approved == '0') : ?>
                <p class="comment-awaiting-moderation text-sm text-amber-600 bg-amber-50 px-4 py-2 rounded-lg mb-4">
                    <?php _e('Your comment is awaiting moderation.', 'irimas-kitchen'); ?>
                </p>
            <?php endif; ?>
            
            <div class="comment-content prose prose-sm max-w-none text-gray-700">
                <?php comment_text(); ?>
            </div>
            
            <footer class="comment-actions mt-4 pt-4 border-t border-gray-200">
                <?php
                comment_reply_link(array_merge($args, array(
                    'reply_text' => '<span class="flex items-center gap-1 text-sm text-irimas-red hover:text-irimas-blue transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>' . __('Reply', 'irimas-kitchen') . '</span>',
                    'depth' => $depth,
                    'max_depth' => $args['max_depth'],
                )));
                ?>
                
                <?php edit_comment_link(__('Edit', 'irimas-kitchen'), '<span class="ml-4 text-sm text-gray-500 hover:text-irimas-blue transition">', '</span>'); ?>
            </footer>
        </article>
    <?php
}
?>
