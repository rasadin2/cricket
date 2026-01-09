<?php
/**
 * Blog Listing Shortcode with Load More
 *
 * Usage: [cricket_blog_listing posts_per_page="6" category=""]
 */

// Register shortcode
function cricket_blog_listing_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'posts_per_page' => 6,
        'category' => '',
        'order' => 'DESC',
        'orderby' => 'date'
    ), $atts );

    // Query args
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => intval( $atts['posts_per_page'] ),
        'paged' => 1,
        'order' => $atts['order'],
        'orderby' => $atts['orderby'],
        'post_status' => 'publish'
    );

    // Add category filter if specified
    if ( ! empty( $atts['category'] ) ) {
        $args['category_name'] = $atts['category'];
    }

    // Get total posts count
    $total_query = new WP_Query( array_merge( $args, array( 'posts_per_page' => -1, 'fields' => 'ids' ) ) );
    $total_posts = $total_query->found_posts;
    wp_reset_postdata();

    // Get posts
    $query = new WP_Query( $args );

    ob_start();
    ?>
    <div class="cricket-bloglist-box blog-listinng" data-posts-per-page="<?php echo esc_attr( $atts['posts_per_page'] ); ?>" data-category="<?php echo esc_attr( $atts['category'] ); ?>" data-order="<?php echo esc_attr( $atts['order'] ); ?>" data-orderby="<?php echo esc_attr( $atts['orderby'] ); ?>">
        <div class="count-blog"><?php echo $total_posts; ?> Articles found</div>
        <div class="container cricket-blog-posts-container">
            <?php
            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();
                    cricket_render_blog_card();
                }
            } else {
                echo '<p>No articles found.</p>';
            }
            wp_reset_postdata();
            ?>
        </div>

        <?php if ( $query->max_num_pages > 1 ) : ?>
        <div class="load-more-wrapper" style="text-align: center; margin-top: 30px;">
            <button class="cricket-load-more-btn" data-page="1" data-max-pages="<?php echo $query->max_num_pages; ?>">
                Load More
            </button>
            <div class="cricket-loading" style="display: none; margin-top: 15px;">Loading...</div>
        </div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'cricket_blog_listing', 'cricket_blog_listing_shortcode' );

/**
 * Render single blog card
 */
function cricket_render_blog_card() {
    $post_id = get_the_ID();
    $title = get_the_title();
    $excerpt = get_the_excerpt();
    $permalink = get_the_permalink();
    $thumbnail_url = get_the_post_thumbnail_url( $post_id, 'full' );
    if ( ! $thumbnail_url ) {
        $thumbnail_url = get_template_directory_uri() . '/assets/img/no-image-placeholder.svg';
    }

    // Get post date in English
    $post_date = get_the_date( 'j F Y' );

    // Get category (first category)
    $categories = get_the_category();
    $category_name = ! empty( $categories ) ? $categories[0]->name : 'General';

    // Calculate reading time for Bengali content
    $content = get_the_content();
    $content = strip_tags( $content );

    // Count both English words and Bengali characters
    $english_word_count = str_word_count( $content );
    // For Bengali, count characters and divide by average word length (5-6 chars)
    $bengali_char_count = mb_strlen( preg_replace( '/[a-zA-Z0-9\s]/', '', $content ) );
    $bengali_word_count = ceil( $bengali_char_count / 5 );

    $total_word_count = $english_word_count + $bengali_word_count;

    // Calculate reading time (200 words per minute)
    $reading_time = max( 1, ceil( $total_word_count / 200 ) );

    ?>
    <div class="card">
        <div class="card-image gradient-green">
            <div class="img-box">
                <img decoding="async" src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="card-image">
            </div>
            <div class="date-badge">
                <svg class="date-icon" fill="white" viewBox="0 0 24 24">
                    <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z"/>
                </svg>
                <?php echo $post_date; ?>
            </div>
            <div class="date-badge sports-name">
                <?php echo esc_html( $category_name ); ?>
            </div>
        </div>
        <div class="card-content">
            <h2 class="card-title"><?php echo esc_html( $title ); ?></h2>
            <p class="card-description"><?php echo esc_html( wp_trim_words( $excerpt, 20, '...' ) ); ?></p>
            <div class="card-footer">
                <span class="read-time"><?php echo $reading_time; ?> min read</span>
                <a href="<?php echo esc_url( $permalink ); ?>" class="read-more-btn">
                    Read More
                    <span class="arrow">›</span>
                </a>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Convert date to Bengali format
 */
function cricket_convert_to_bengali_date( $date_string ) {
    $bengali_months = array(
        'January' => 'জানুয়ারি',
        'February' => 'ফেব্রুয়ারি',
        'March' => 'মার্চ',
        'April' => 'এপ্রিল',
        'May' => 'মে',
        'June' => 'জুন',
        'July' => 'জুলাই',
        'August' => 'আগস্ট',
        'September' => 'সেপ্টেম্বর',
        'October' => 'অক্টোবর',
        'November' => 'নভেম্বর',
        'December' => 'ডিসেম্বর'
    );

    $bengali_numerals = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    $english_numerals = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

    foreach ( $bengali_months as $english => $bengali ) {
        $date_string = str_replace( $english, $bengali, $date_string );
    }

    $date_string = str_replace( $english_numerals, $bengali_numerals, $date_string );

    return $date_string;
}

/**
 * Convert numbers to Bengali numerals
 */
function cricket_convert_number_to_bengali( $number ) {
    $bengali_numerals = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    $english_numerals = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

    return str_replace( $english_numerals, $bengali_numerals, strval( $number ) );
}

/**
 * AJAX handler for loading more posts
 */
function cricket_load_more_posts_ajax() {
    check_ajax_referer( 'cricket_load_more_nonce', 'nonce' );

    $page = isset( $_POST['page'] ) ? intval( $_POST['page'] ) : 1;
    $posts_per_page = isset( $_POST['posts_per_page'] ) ? intval( $_POST['posts_per_page'] ) : 6;
    $category = isset( $_POST['category'] ) ? sanitize_text_field( $_POST['category'] ) : '';
    $order = isset( $_POST['order'] ) ? sanitize_text_field( $_POST['order'] ) : 'DESC';
    $orderby = isset( $_POST['orderby'] ) ? sanitize_text_field( $_POST['orderby'] ) : 'date';

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $posts_per_page,
        'paged' => $page,
        'order' => $order,
        'orderby' => $orderby,
        'post_status' => 'publish'
    );

    if ( ! empty( $category ) ) {
        $args['category_name'] = $category;
    }

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        ob_start();
        while ( $query->have_posts() ) {
            $query->the_post();
            cricket_render_blog_card();
        }
        $html = ob_get_clean();

        wp_send_json_success( array(
            'html' => $html,
            'max_pages' => $query->max_num_pages
        ) );
    } else {
        wp_send_json_error( array( 'message' => 'No articles found.' ) );
    }

    wp_reset_postdata();
    wp_die();
}
add_action( 'wp_ajax_cricket_load_more_posts', 'cricket_load_more_posts_ajax' );
add_action( 'wp_ajax_nopriv_cricket_load_more_posts', 'cricket_load_more_posts_ajax' );

/**
 * Featured Posts Shortcode
 *
 * Usage: [cricket_featured_posts posts_per_page="6" category=""]
 */
function cricket_featured_posts_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'posts_per_page' => 6,
        'category' => '',
        'order' => 'DESC',
        'orderby' => 'date'
    ), $atts );

    // Query args for featured posts only
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => intval( $atts['posts_per_page'] ),
        'paged' => 1,
        'order' => $atts['order'],
        'orderby' => $atts['orderby'],
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => '_cricket_featured_post',
                'value' => '1',
                'compare' => '='
            )
        )
    );

    // Add category filter if specified
    if ( ! empty( $atts['category'] ) ) {
        $args['category_name'] = $atts['category'];
    }

    // Get total featured posts count
    $total_query = new WP_Query( array_merge( $args, array( 'posts_per_page' => -1, 'fields' => 'ids' ) ) );
    $total_posts = $total_query->found_posts;
    wp_reset_postdata();

    // Get posts
    $query = new WP_Query( $args );

    ob_start();
    ?>
    <div class="cricket-bloglist-box blog-listinng cricket-featured-posts" data-posts-per-page="<?php echo esc_attr( $atts['posts_per_page'] ); ?>" data-category="<?php echo esc_attr( $atts['category'] ); ?>" data-order="<?php echo esc_attr( $atts['order'] ); ?>" data-orderby="<?php echo esc_attr( $atts['orderby'] ); ?>">
        <div class="count-blog">⭐ <?php echo $total_posts; ?> Featured articles found</div>
        <div class="container cricket-blog-posts-container">
            <?php
            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();
                    cricket_render_blog_card();
                }
            } else {
                echo '<p>No featured articles found.</p>';
            }
            wp_reset_postdata();
            ?>
        </div>

        <?php if ( $query->max_num_pages > 1 ) : ?>
        <div class="load-more-wrapper" style="text-align: center; margin-top: 30px;">
            <button class="cricket-load-more-btn cricket-featured-load-more" data-page="1" data-max-pages="<?php echo $query->max_num_pages; ?>" data-featured="1">
                Load More
            </button>
            <div class="cricket-loading" style="display: none; margin-top: 15px;">Loading...</div>
        </div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'cricket_featured_posts', 'cricket_featured_posts_shortcode' );

/**
 * AJAX handler for loading more featured posts
 */
function cricket_load_more_featured_posts_ajax() {
    check_ajax_referer( 'cricket_load_more_nonce', 'nonce' );

    $page = isset( $_POST['page'] ) ? intval( $_POST['page'] ) : 1;
    $posts_per_page = isset( $_POST['posts_per_page'] ) ? intval( $_POST['posts_per_page'] ) : 6;
    $category = isset( $_POST['category'] ) ? sanitize_text_field( $_POST['category'] ) : '';
    $order = isset( $_POST['order'] ) ? sanitize_text_field( $_POST['order'] ) : 'DESC';
    $orderby = isset( $_POST['orderby'] ) ? sanitize_text_field( $_POST['orderby'] ) : 'date';

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $posts_per_page,
        'paged' => $page,
        'order' => $order,
        'orderby' => $orderby,
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => '_cricket_featured_post',
                'value' => '1',
                'compare' => '='
            )
        )
    );

    if ( ! empty( $category ) ) {
        $args['category_name'] = $category;
    }

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        ob_start();
        while ( $query->have_posts() ) {
            $query->the_post();
            cricket_render_blog_card();
        }
        $html = ob_get_clean();

        wp_send_json_success( array(
            'html' => $html,
            'max_pages' => $query->max_num_pages
        ) );
    } else {
        wp_send_json_error( array( 'message' => 'No articles found.' ) );
    }

    wp_reset_postdata();
    wp_die();
}
add_action( 'wp_ajax_cricket_load_more_featured_posts', 'cricket_load_more_featured_posts_ajax' );
add_action( 'wp_ajax_nopriv_cricket_load_more_featured_posts', 'cricket_load_more_featured_posts_ajax' );

/**
 * Add meta box for featured posts
 */
function cricket_add_featured_meta_box() {
    add_meta_box(
        'cricket_featured_post',
        '⭐ Featured Post',
        'cricket_featured_meta_box_callback',
        'post',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'cricket_add_featured_meta_box' );

/**
 * Meta box callback
 */
function cricket_featured_meta_box_callback( $post ) {
    wp_nonce_field( 'cricket_save_featured_meta', 'cricket_featured_nonce' );
    $is_featured = get_post_meta( $post->ID, '_cricket_featured_post', true );
    ?>
    <p>
        <label>
            <input type="checkbox" name="cricket_featured_post" value="1" <?php checked( $is_featured, '1' ); ?>>
            Mark this post as featured
        </label>
    </p>
    <p class="description">Featured posts will only show in [cricket_featured_posts] shortcode.</p>
    <?php
}

/**
 * Save meta box data
 */
function cricket_save_featured_meta( $post_id ) {
    // Security checks
    if ( ! isset( $_POST['cricket_featured_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( $_POST['cricket_featured_nonce'], 'cricket_save_featured_meta' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Save or delete meta
    if ( isset( $_POST['cricket_featured_post'] ) && $_POST['cricket_featured_post'] === '1' ) {
        update_post_meta( $post_id, '_cricket_featured_post', '1' );
    } else {
        delete_post_meta( $post_id, '_cricket_featured_post' );
    }
}
add_action( 'save_post', 'cricket_save_featured_meta' );

/**
 * Add custom column to post list
 */
function cricket_add_featured_column( $columns ) {
    // Insert Featured column after title
    $new_columns = array();
    foreach ( $columns as $key => $value ) {
        $new_columns[ $key ] = $value;
        if ( $key === 'title' ) {
            $new_columns['featured'] = '⭐ Featured';
        }
    }
    return $new_columns;
}
add_filter( 'manage_post_posts_columns', 'cricket_add_featured_column' );

/**
 * Display featured column content
 */
function cricket_display_featured_column( $column, $post_id ) {
    if ( $column === 'featured' ) {
        $is_featured = get_post_meta( $post_id, '_cricket_featured_post', true );
        if ( $is_featured === '1' ) {
            echo '<span style="color: #ffc107; font-size: 18px; font-weight: bold;" title="Featured Post">⭐ Yes</span>';
        } else {
            echo '<span style="color: #ccc;" title="Not Featured">—</span>';
        }
    }
}
add_action( 'manage_post_posts_custom_column', 'cricket_display_featured_column', 10, 2 );

/**
 * Make featured column sortable
 */
function cricket_make_featured_column_sortable( $columns ) {
    $columns['featured'] = 'featured';
    return $columns;
}
add_filter( 'manage_edit-post_sortable_columns', 'cricket_make_featured_column_sortable' );

/**
 * Handle featured column sorting
 */
function cricket_featured_column_orderby( $query ) {
    if ( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( $query->get( 'orderby' ) === 'featured' ) {
        $query->set( 'meta_key', '_cricket_featured_post' );
        $query->set( 'orderby', 'meta_value' );
    }
}
add_action( 'pre_get_posts', 'cricket_featured_column_orderby' );

/**
 * Add featured to Quick Edit
 */
function cricket_add_featured_quick_edit() {
    global $pagenow;

    if ( $pagenow !== 'edit.php' || ( isset( $_GET['post_type'] ) && $_GET['post_type'] !== 'post' ) ) {
        return;
    }
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // Add featured checkbox to quick edit
        $('#the-list').on('click', '.editinline', function() {
            var post_id = $(this).closest('tr').attr('id').replace('post-', '');
            var $row = $('#post-' + post_id);
            var $featured_column = $row.find('.column-featured');
            var is_featured = $featured_column.text().trim().indexOf('Yes') !== -1;

            // Set checkbox state
            var $quick_edit_row = $('#edit-' + post_id);
            setTimeout(function() {
                $quick_edit_row.find('input[name="cricket_featured_post_quick"]').prop('checked', is_featured);
            }, 100);
        });
    });
    </script>
    <?php
}
add_action( 'admin_footer-edit.php', 'cricket_add_featured_quick_edit' );

/**
 * Add featured field to Quick Edit
 */
function cricket_add_featured_quick_edit_field( $column_name, $post_type ) {
    if ( $column_name !== 'featured' || $post_type !== 'post' ) {
        return;
    }
    ?>
    <fieldset class="inline-edit-col-right">
        <div class="inline-edit-col">
            <label class="alignleft">
                <input type="checkbox" name="cricket_featured_post_quick" value="1">
                <span class="checkbox-title">⭐ Featured Post</span>
            </label>
        </div>
    </fieldset>
    <?php
}
add_action( 'quick_edit_custom_box', 'cricket_add_featured_quick_edit_field', 10, 2 );

/**
 * Save Quick Edit data
 */
function cricket_save_featured_quick_edit( $post_id ) {
    // Security checks
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Check if this is a quick edit request
    if ( isset( $_POST['_inline_edit'] ) && wp_verify_nonce( $_POST['_inline_edit'], 'inlineeditnonce' ) ) {
        if ( isset( $_POST['cricket_featured_post_quick'] ) && $_POST['cricket_featured_post_quick'] === '1' ) {
            update_post_meta( $post_id, '_cricket_featured_post', '1' );
        } else {
            delete_post_meta( $post_id, '_cricket_featured_post' );
        }
    }
}
add_action( 'save_post', 'cricket_save_featured_quick_edit' );

/**
 * Add featured to Bulk Edit
 */
function cricket_add_featured_bulk_edit( $column_name, $post_type ) {
    if ( $column_name !== 'featured' || $post_type !== 'post' ) {
        return;
    }
    ?>
    <fieldset class="inline-edit-col-right">
        <div class="inline-edit-col">
            <label class="inline-edit-group">
                <span class="title">⭐ Featured Post</span>
                <select name="cricket_featured_post_bulk">
                    <option value="-1">— No Change —</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </label>
        </div>
    </fieldset>
    <?php
}
add_action( 'bulk_edit_custom_box', 'cricket_add_featured_bulk_edit', 10, 2 );

/**
 * Save Bulk Edit data
 */
function cricket_save_featured_bulk_edit() {
    if ( ! isset( $_GET['bulk_edit'] ) ) {
        return;
    }

    check_admin_referer( 'bulk-posts' );

    $post_ids = isset( $_GET['post'] ) ? array_map( 'intval', (array) $_GET['post'] ) : array();

    if ( empty( $post_ids ) ) {
        return;
    }

    $featured_value = isset( $_GET['cricket_featured_post_bulk'] ) ? $_GET['cricket_featured_post_bulk'] : '-1';

    if ( $featured_value === '-1' ) {
        return; // No change
    }

    foreach ( $post_ids as $post_id ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            continue;
        }

        if ( $featured_value === '1' ) {
            update_post_meta( $post_id, '_cricket_featured_post', '1' );
        } else {
            delete_post_meta( $post_id, '_cricket_featured_post' );
        }
    }
}
add_action( 'load-edit.php', 'cricket_save_featured_bulk_edit' );

/**
 * Handle bulk edit with JavaScript
 */
function cricket_bulk_edit_featured_script() {
    global $pagenow;

    if ( $pagenow !== 'edit.php' || ( isset( $_GET['post_type'] ) && $_GET['post_type'] !== 'post' ) ) {
        return;
    }
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#bulk_edit').on('click', function() {
            var $bulk_row = $('#bulk-edit');
            var $featured_select = $bulk_row.find('select[name="cricket_featured_post_bulk"]');
            var featured_value = $featured_select.val();

            if (featured_value && featured_value !== '-1') {
                var post_ids = [];
                $bulk_row.find('#bulk-titles').children().each(function() {
                    post_ids.push($(this).attr('id').replace(/^(_)/g, ''));
                });

                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'cricket_save_bulk_featured',
                        post_ids: post_ids,
                        featured_value: featured_value,
                        nonce: '<?php echo wp_create_nonce( 'cricket_bulk_featured_nonce' ); ?>'
                    }
                });
            }
        });
    });
    </script>
    <?php
}
add_action( 'admin_footer-edit.php', 'cricket_bulk_edit_featured_script' );

/**
 * AJAX handler for bulk edit
 */
function cricket_ajax_save_bulk_featured() {
    check_ajax_referer( 'cricket_bulk_featured_nonce', 'nonce' );

    if ( ! current_user_can( 'edit_posts' ) ) {
        wp_send_json_error();
    }

    $post_ids = isset( $_POST['post_ids'] ) ? array_map( 'intval', $_POST['post_ids'] ) : array();
    $featured_value = isset( $_POST['featured_value'] ) ? sanitize_text_field( $_POST['featured_value'] ) : '-1';

    if ( empty( $post_ids ) || $featured_value === '-1' ) {
        wp_send_json_error();
    }

    foreach ( $post_ids as $post_id ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            continue;
        }

        if ( $featured_value === '1' ) {
            update_post_meta( $post_id, '_cricket_featured_post', '1' );
        } else {
            delete_post_meta( $post_id, '_cricket_featured_post' );
        }
    }

    wp_send_json_success();
}
add_action( 'wp_ajax_cricket_save_bulk_featured', 'cricket_ajax_save_bulk_featured' );
