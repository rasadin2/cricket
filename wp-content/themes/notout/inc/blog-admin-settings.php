<?php
/**
 * Blog Admin Settings Page
 *
 * Provides shortcode documentation and post generator functionality
 */

// Add admin menu
function cricket_blog_add_admin_menu() {
    add_menu_page(
        'ক্রিকেট ব্লগ সেটিংস',           // Page title
        'ক্রিকেট ব্লগ',                   // Menu title
        'manage_options',                   // Capability
        'cricket-blog-settings',            // Menu slug
        'cricket_blog_admin_page',          // Callback function
        'dashicons-media-document',         // Icon
        30                                  // Position
    );
}
add_action( 'admin_menu', 'cricket_blog_add_admin_menu' );

/**
 * Admin page HTML
 */
function cricket_blog_admin_page() {
    ?>
    <div class="wrap cricket-blog-admin-wrap">
        <h1>🏏 ক্রিকেট ব্লগ ম্যানেজমেন্ট</h1>

        <div class="cricket-admin-container" style="max-width: 1200px;">

            <!-- Shortcode Documentation Section -->
            <div class="card" style="margin-top: 20px; padding: 20px;">
                <h2>📋 শর্টকোড ব্যবহার নির্দেশিকা</h2>
                <p>আপনার পেজ বা পোস্টে ব্লগ লিস্টিং দেখাতে নিচের শর্টকোড ব্যবহার করুন:</p>

                <!-- Regular Blog Listing -->
                <div style="background: #e7f3ff; padding: 20px; border-left: 4px solid #0073aa; margin: 20px 0; border-radius: 4px;">
                    <h3 style="margin-top: 0; color: #0073aa;">📰 সাধারণ ব্লগ লিস্টিং</h3>
                    <p>সকল প্রকাশিত পোস্ট দেখানোর জন্য:</p>
                    <div style="background: #f5f5f5; padding: 15px; border-left: 4px solid #0073aa; margin: 15px 0;">
                        <h4>বেসিক ব্যবহার:</h4>
                        <code style="background: #fff; padding: 10px; display: block; font-size: 14px;">
                            [cricket_blog_listing]
                        </code>
                    </div>

                    <div style="background: #f5f5f5; padding: 15px; border-left: 4px solid #0073aa; margin: 15px 0;">
                        <h4>প্যারামিটার সহ ব্যবহার:</h4>
                        <code style="background: #fff; padding: 10px; display: block; font-size: 14px;">
                            [cricket_blog_listing posts_per_page="6" category="গাইড" order="DESC" orderby="date"]
                        </code>
                    </div>
                </div>

                <!-- Featured Posts -->
                <div style="background: #fff9e6; padding: 20px; border-left: 4px solid #ffc107; margin: 20px 0; border-radius: 4px;">
                    <h3 style="margin-top: 0; color: #f57c00;">⭐ ফিচার্ড পোস্ট লিস্টিং</h3>
                    <p>শুধুমাত্র ফিচার্ড পোস্ট দেখানোর জন্য:</p>
                    <div style="background: #f5f5f5; padding: 15px; border-left: 4px solid #ffc107; margin: 15px 0;">
                        <h4>বেসিক ব্যবহার:</h4>
                        <code style="background: #fff; padding: 10px; display: block; font-size: 14px;">
                            [cricket_featured_posts]
                        </code>
                    </div>

                    <div style="background: #f5f5f5; padding: 15px; border-left: 4px solid #ffc107; margin: 15px 0;">
                        <h4>প্যারামিটার সহ ব্যবহার:</h4>
                        <code style="background: #fff; padding: 10px; display: block; font-size: 14px;">
                            [cricket_featured_posts posts_per_page="9" category="বোনাস" order="DESC"]
                        </code>
                    </div>

                    <div style="background: #fff3cd; padding: 12px; border-radius: 4px; margin-top: 15px;">
                        <strong>💡 টিপ:</strong> পোস্ট এডিট করার সময় সাইডবারে "⭐ ফিচার্ড পোস্ট" চেকবক্স টিক দিয়ে পোস্ট ফিচার্ড করুন।
                    </div>
                </div>

                <h3 style="margin-top: 25px;">📌 উপলব্ধ প্যারামিটার:</h3>
                <table class="wp-list-table widefat fixed striped" style="margin-top: 10px;">
                    <thead>
                        <tr>
                            <th style="width: 25%;">প্যারামিটার</th>
                            <th style="width: 20%;">ডিফল্ট মান</th>
                            <th style="width: 55%;">বর্ণনা</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>posts_per_page</strong></td>
                            <td><code>6</code></td>
                            <td>প্রতি পেজে কতটি পোস্ট দেখাবে (সংখ্যা)</td>
                        </tr>
                        <tr>
                            <td><strong>category</strong></td>
                            <td><code>""</code> (সব)</td>
                            <td>নির্দিষ্ট ক্যাটাগরির পোস্ট দেখাতে ক্যাটাগরি slug ব্যবহার করুন</td>
                        </tr>
                        <tr>
                            <td><strong>order</strong></td>
                            <td><code>DESC</code></td>
                            <td>সাজানোর ক্রম: <code>DESC</code> (নতুন প্রথম) অথবা <code>ASC</code> (পুরাতন প্রথম)</td>
                        </tr>
                        <tr>
                            <td><strong>orderby</strong></td>
                            <td><code>date</code></td>
                            <td>কিসের ভিত্তিতে সাজাবে: <code>date</code>, <code>title</code>, <code>modified</code>, <code>rand</code></td>
                        </tr>
                    </tbody>
                </table>

                <h3 style="margin-top: 25px;">💡 ব্যবহারের উদাহরণ:</h3>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 15px; margin-top: 15px;">
                    <div style="background: #fff3cd; padding: 15px; border-left: 4px solid #ffc107; border-radius: 4px;">
                        <p style="margin: 0 0 10px 0;"><strong>9টি সাধারণ পোস্ট:</strong></p>
                        <code style="background: #fff; padding: 8px; display: block;">[cricket_blog_listing posts_per_page="9"]</code>
                    </div>

                    <div style="background: #d1ecf1; padding: 15px; border-left: 4px solid #17a2b8; border-radius: 4px;">
                        <p style="margin: 0 0 10px 0;"><strong>শুধু "গাইড" ক্যাটাগরি:</strong></p>
                        <code style="background: #fff; padding: 8px; display: block;">[cricket_blog_listing category="গাইড"]</code>
                    </div>

                    <div style="background: #d4edda; padding: 15px; border-left: 4px solid #28a745; border-radius: 4px;">
                        <p style="margin: 0 0 10px 0;"><strong>শিরোনাম অনুযায়ী সাজান:</strong></p>
                        <code style="background: #fff; padding: 8px; display: block;">[cricket_blog_listing orderby="title" order="ASC"]</code>
                    </div>

                    <div style="background: #ffe6e6; padding: 15px; border-left: 4px solid #dc3545; border-radius: 4px;">
                        <p style="margin: 0 0 10px 0;"><strong>৬টি ফিচার্ড পোস্ট:</strong></p>
                        <code style="background: #fff; padding: 8px; display: block;">[cricket_featured_posts posts_per_page="6"]</code>
                    </div>

                    <div style="background: #f3e5f5; padding: 15px; border-left: 4px solid #9c27b0; border-radius: 4px;">
                        <p style="margin: 0 0 10px 0;"><strong>ফিচার্ড "বোনাস" পোস্ট:</strong></p>
                        <code style="background: #fff; padding: 8px; display: block;">[cricket_featured_posts category="বোনাস"]</code>
                    </div>

                    <div style="background: #e8f5e9; padding: 15px; border-left: 4px solid #4caf50; border-radius: 4px;">
                        <p style="margin: 0 0 10px 0;"><strong>র‍্যান্ডম ৩টি পোস্ট:</strong></p>
                        <code style="background: #fff; padding: 8px; display: block;">[cricket_blog_listing posts_per_page="3" orderby="rand"]</code>
                    </div>
                </div>
            </div>

            <!-- Post Generator Section -->
            <div class="card" style="margin-top: 20px; padding: 20px;">
                <h2>🎲 ডেমো পোস্ট জেনারেটর</h2>
                <p>টেস্টিং এর জন্য দ্রুত ২০টি নমুনা পোস্ট তৈরি করুন। প্রতিবার ক্লিক করলে ২০টি নতুন পোস্ট যুক্ত হবে।</p>

                <div style="background: #fff3cd; padding: 15px; border-left: 4px solid #ffc107; margin: 15px 0;">
                    <p><strong>⚠️ সতর্কতা:</strong> এই ফিচারটি শুধুমাত্র টেস্টিং এর জন্য। উৎপাদন সাইটে ব্যবহার করার আগে সাবধানে ব্যবহার করুন।</p>
                </div>

                <div style="margin: 20px 0;">
                    <button type="button" id="cricket-generate-posts-btn" class="button button-primary button-hero" style="padding: 10px 30px; font-size: 16px;">
                        <span class="dashicons dashicons-plus-alt" style="margin-top: 4px;"></span>
                        ২০টি নমুনা পোস্ট তৈরি করুন
                    </button>
                </div>

                <div id="cricket-generation-progress" style="display: none; margin-top: 20px;">
                    <div style="background: #f0f0f1; padding: 15px; border-radius: 4px;">
                        <p id="cricket-progress-text" style="margin: 0; font-weight: 600;">পোস্ট তৈরি হচ্ছে...</p>
                        <div style="background: #fff; height: 30px; border-radius: 4px; margin-top: 10px; overflow: hidden; position: relative;">
                            <div id="cricket-progress-bar" style="background: linear-gradient(90deg, #0073aa, #00a0d2); height: 100%; width: 0%; transition: width 0.3s; display: flex; align-items: center; justify-content: center;">
                                <span id="cricket-progress-percentage" style="color: #fff; font-weight: 600; font-size: 14px;"></span>
                            </div>
                        </div>
                        <p id="cricket-progress-detail" style="margin: 10px 0 0 0; font-size: 13px; color: #666;"></p>
                    </div>
                </div>

                <div id="cricket-generation-result" style="display: none; margin-top: 20px;"></div>

                <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;">
                    <h3>📊 বর্তমান পরিসংখ্যান:</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 15px;">
                        <?php
                        $total_posts = wp_count_posts('post');
                        $categories = get_categories(['hide_empty' => false]);
                        $published_posts = $total_posts->publish;
                        ?>
                        <div style="background: #0073aa; color: #fff; padding: 20px; border-radius: 4px; text-align: center;">
                            <div style="font-size: 32px; font-weight: 700;"><?php echo $published_posts; ?></div>
                            <div style="margin-top: 5px; opacity: 0.9;">প্রকাশিত পোস্ট</div>
                        </div>
                        <div style="background: #00a0d2; color: #fff; padding: 20px; border-radius: 4px; text-align: center;">
                            <div style="font-size: 32px; font-weight: 700;"><?php echo count($categories); ?></div>
                            <div style="margin-top: 5px; opacity: 0.9;">মোট ক্যাটাগরি</div>
                        </div>
                        <div style="background: #46b450; color: #fff; padding: 20px; border-radius: 4px; text-align: center;">
                            <div style="font-size: 32px; font-weight: 700;"><?php echo $total_posts->draft; ?></div>
                            <div style="margin-top: 5px; opacity: 0.9;">খসড়া পোস্ট</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="card" style="margin-top: 20px; padding: 20px;">
                <h2>✨ বৈশিষ্ট্যসমূহ</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
                    <div style="padding: 15px; background: #f0f9ff; border-radius: 4px;">
                        <span class="dashicons dashicons-update" style="color: #0073aa; font-size: 24px;"></span>
                        <h4 style="margin: 10px 0 5px 0; color: #0073aa;">AJAX লোড মোর</h4>
                        <p style="margin: 0; font-size: 13px; color: #666;">পেজ রিফ্রেশ ছাড়াই আরও পোস্ট লোড করুন</p>
                    </div>

                    <div style="padding: 15px; background: #f0fff4; border-radius: 4px;">
                        <span class="dashicons dashicons-translation" style="color: #46b450; font-size: 24px;"></span>
                        <h4 style="margin: 10px 0 5px 0; color: #46b450;">বাংলা সাপোর্ট</h4>
                        <p style="margin: 0; font-size: 13px; color: #666;">সম্পূর্ণ বাংলা ভাষা সমর্থন এবং সংখ্যা রূপান্তর</p>
                    </div>

                    <div style="padding: 15px; background: #fff9e6; border-radius: 4px;">
                        <span class="dashicons dashicons-category" style="color: #ffc107; font-size: 24px;"></span>
                        <h4 style="margin: 10px 0 5px 0; color: #f57c00;">ক্যাটাগরি ফিল্টার</h4>
                        <p style="margin: 0; font-size: 13px; color: #666;">নির্দিষ্ট ক্যাটাগরির পোস্ট দেখান</p>
                    </div>

                    <div style="padding: 15px; background: #fce4ec; border-radius: 4px;">
                        <span class="dashicons dashicons-star-filled" style="color: #e91e63; font-size: 24px;"></span>
                        <h4 style="margin: 10px 0 5px 0; color: #e91e63;">ফিচার্ড পোস্ট</h4>
                        <p style="margin: 0; font-size: 13px; color: #666;">বিশেষ পোস্ট আলাদাভাবে হাইলাইট করুন</p>
                    </div>

                    <div style="padding: 15px; background: #f3e5f5; border-radius: 4px;">
                        <span class="dashicons dashicons-clock" style="color: #9c27b0; font-size: 24px;"></span>
                        <h4 style="margin: 10px 0 5px 0; color: #9c27b0;">রিডিং টাইম</h4>
                        <p style="margin: 0; font-size: 13px; color: #666;">স্বয়ংক্রিয় পড়ার সময় গণনা (বাংলা+ইংরেজি)</p>
                    </div>

                    <div style="padding: 15px; background: #e8f5e9; border-radius: 4px;">
                        <span class="dashicons dashicons-smartphone" style="color: #4caf50; font-size: 24px;"></span>
                        <h4 style="margin: 10px 0 5px 0; color: #4caf50;">রেস্পন্সিভ ডিজাইন</h4>
                        <p style="margin: 0; font-size: 13px; color: #666;">সকল ডিভাইসে সুন্দর প্রদর্শন</p>
                    </div>
                </div>

                <!-- How to mark as featured -->
                <div style="background: #fff3cd; padding: 15px; border-left: 4px solid #ffc107; margin-top: 20px; border-radius: 4px;">
                    <h4 style="margin: 0 0 10px 0;">⭐ কিভাবে পোস্ট ফিচার্ড করবেন?</h4>
                    <ol style="margin: 0; padding-left: 20px;">
                        <li>পোস্ট এডিট করতে যান</li>
                        <li>ডান সাইডবারে "⭐ ফিচার্ড পোস্ট" মেটাবক্স খুঁজুন</li>
                        <li>"এই পোস্টটি ফিচার্ড করুন" চেকবক্সে টিক দিন</li>
                        <li>পোস্ট আপডেট/প্রকাশ করুন</li>
                        <li>এখন এই পোস্টটি <code>[cricket_featured_posts]</code> শর্টকোডে দেখাবে</li>
                    </ol>
                </div>
            </div>

        </div>
    </div>

    <style>
        .cricket-blog-admin-wrap {
            background: #f0f0f1;
            margin: -20px -20px 0 -22px;
            padding: 20px;
        }
        .cricket-blog-admin-wrap h1 {
            background: #fff;
            padding: 20px;
            margin: 0 0 20px 0;
            box-shadow: 0 1px 1px rgba(0,0,0,.04);
        }
        .cricket-blog-admin-wrap .card {
            background: #fff;
            box-shadow: 0 1px 1px rgba(0,0,0,.04);
        }
        #cricket-generate-posts-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
    <?php
}

/**
 * AJAX handler for generating posts
 */
function cricket_generate_demo_posts_ajax() {
    // Security check
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( array( 'message' => 'অনুমতি নেই।' ) );
    }

    check_ajax_referer( 'cricket_generate_posts_nonce', 'nonce' );

    // Sample data in Bengali
    $titles = array(
        'ক্রিকেট বেটিং এর সম্পূর্ণ গাইড',
        'কিভাবে জিতবেন ক্রিকেট বাজিতে',
        'টি-২০ বেটিং এর সেরা কৌশল',
        'ওয়ান ডে ম্যাচে বেটিং টিপস',
        'টেস্ট ক্রিকেটে বাজি ধরার নিয়ম',
        'লাইভ বেটিং এর কৌশল',
        'ক্রিকেট বেটিং অডস বোঝার উপায়',
        'সেরা ক্রিকেট বেটিং সাইট',
        'ভারত বনাম পাকিস্তান বেটিং প্রিডিকশন',
        'আইপিএল বেটিং গাইড',
        'বিশ্বকাপ বেটিং কৌশল',
        'ক্রিকেট বেটিং বোনাস কিভাবে পাবেন',
        'মোবাইলে ক্রিকেট বেটিং',
        'ক্রিকেট ফ্যান্টাসি লিগ টিপস',
        'প্লেয়ার পারফরম্যান্স বেটিং',
        'ইনিংস বেটিং কৌশল',
        'টস বেটিং এর নিয়ম',
        'ক্রিকেট বেটিং এ সফল হওয়ার উপায়',
        'বেটিং এ ব্যাংকরোল ম্যানেজমেন্ট',
        'ক্রিকেট বেটিং ভুল এড়ানোর উপায়'
    );

    $categories = array('গাইড', 'বোনাস', 'বেটিং টিপস', 'সংবাদ', 'বিশ্লেষণ');

    $content_templates = array(
        'ক্রিকেট বেটিং এর জগতে আপনাকে স্বাগতম। এই নিবন্ধে আমরা আলোচনা করব কিভাবে আপনি সফলভাবে ক্রিকেট বেটিং করতে পারেন এবং সর্বোচ্চ মুনাফা অর্জন করতে পারেন। আমাদের বিশেষজ্ঞ টিম বছরের অভিজ্ঞতা থেকে এই টিপস প্রদান করছে।',
        'ক্রিকেট বাজি ধরা একটি জনপ্রিয় বিনোদন যা সারা বিশ্বে লক্ষ লক্ষ মানুষ উপভোগ করে। এই গাইডে আমরা দেখাব কিভাবে আপনি স্মার্ট বেটিং এর মাধ্যমে জয়ী হতে পারেন।',
        'বেটিং এর ক্ষেত্রে সঠিক কৌশল এবং বিশ্লেষণ অত্যন্ত গুরুত্বপূর্ণ। আমাদের এই নিবন্ধে রয়েছে প্রমাণিত কৌশল যা আপনার সাফল্যের সম্ভাবনা বৃদ্ধি করবে।',
        'ক্রিকেট বেটিং এ নতুন? চিন্তার কোন কারণ নেই। আমাদের বিস্তারিত গাইড অনুসরণ করে আপনি সহজেই শিখতে পারবেন কিভাবে বেটিং করতে হয় এবং জিততে হয়।'
    );

    $posts_created = 0;
    $errors = array();

    for ( $i = 0; $i < 20; $i++ ) {
        // Random title
        $title = $titles[array_rand($titles)] . ' - ' . ($i + 1);

        // Random content
        $content = $content_templates[array_rand($content_templates)] . "\n\n";
        $content .= "এই নিবন্ধে আমরা বিস্তারিত আলোচনা করব বিভিন্ন দিক নিয়ে। ক্রিকেট বেটিং এর ক্ষেত্রে অভিজ্ঞতা এবং জ্ঞান অত্যন্ত গুরুত্বপূর্ণ।\n\n";
        $content .= "আমাদের টিপস অনুসরণ করে আপনি আপনার বেটিং দক্ষতা উন্নত করতে পারবেন এবং সফল হতে পারবেন।";

        // Create post
        $post_data = array(
            'post_title'    => $title,
            'post_content'  => $content,
            'post_status'   => 'publish',
            'post_author'   => get_current_user_id(),
            'post_type'     => 'post',
            'post_category' => array()
        );

        // Add random category
        $random_category = $categories[array_rand($categories)];
        $category_obj = get_term_by('name', $random_category, 'category');

        if ( ! $category_obj ) {
            $category_id = wp_create_category( $random_category );
        } else {
            $category_id = $category_obj->term_id;
        }

        $post_data['post_category'] = array( $category_id );

        // Insert post
        $post_id = wp_insert_post( $post_data, true );

        if ( is_wp_error( $post_id ) ) {
            $errors[] = $post_id->get_error_message();
        } else {
            $posts_created++;

            // Set random date within last 30 days
            $random_days = rand(0, 30);
            $post_date = date('Y-m-d H:i:s', strtotime("-{$random_days} days"));
            wp_update_post( array(
                'ID' => $post_id,
                'post_date' => $post_date,
                'post_date_gmt' => get_gmt_from_date( $post_date )
            ) );
        }
    }

    if ( $posts_created > 0 ) {
        $message = cricket_convert_number_to_bengali( $posts_created ) . ' টি পোস্ট সফলভাবে তৈরি হয়েছে!';
        wp_send_json_success( array(
            'message' => $message,
            'posts_created' => $posts_created,
            'errors' => $errors
        ) );
    } else {
        wp_send_json_error( array(
            'message' => 'পোস্ট তৈরি করতে ব্যর্থ হয়েছে।',
            'errors' => $errors
        ) );
    }

    wp_die();
}
add_action( 'wp_ajax_cricket_generate_demo_posts', 'cricket_generate_demo_posts_ajax' );

/**
 * Enqueue admin scripts
 */
function cricket_blog_admin_scripts( $hook ) {
    // Only load on our admin page
    if ( $hook !== 'toplevel_page_cricket-blog-settings' ) {
        return;
    }

    wp_enqueue_script(
        'cricket-blog-admin',
        get_template_directory_uri() . '/assets/js/blog-admin.js',
        array('jquery'),
        '1.0.0',
        true
    );

    wp_localize_script( 'cricket-blog-admin', 'cricketAdminAjax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'cricket_generate_posts_nonce' )
    ) );
}
add_action( 'admin_enqueue_scripts', 'cricket_blog_admin_scripts' );
