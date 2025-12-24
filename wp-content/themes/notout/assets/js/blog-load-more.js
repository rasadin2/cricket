/**
 * Blog Load More Functionality
 */
(function($) {
    'use strict';

    $(document).ready(function() {

        // Load more button click handler (works for both regular and featured posts)
        $(document).on('click', '.cricket-load-more-btn', function(e) {
            e.preventDefault();

            var $button = $(this);
            var $wrapper = $button.closest('.cricket-bloglist-box');
            var $container = $wrapper.find('.cricket-blog-posts-container');
            var $loading = $wrapper.find('.cricket-loading');

            // Get data attributes
            var currentPage = parseInt($button.attr('data-page'));
            var maxPages = parseInt($button.attr('data-max-pages'));
            var postsPerPage = $wrapper.attr('data-posts-per-page');
            var category = $wrapper.attr('data-category');
            var order = $wrapper.attr('data-order');
            var orderby = $wrapper.attr('data-orderby');
            var isFeatured = $button.attr('data-featured') === '1';

            // Calculate next page
            var nextPage = currentPage + 1;

            // Check if we've reached the max pages
            if (nextPage > maxPages) {
                $button.text('আর কোন পোস্ট নেই').prop('disabled', true);
                return;
            }

            // Show loading state
            $button.prop('disabled', true).hide();
            $loading.show();

            // Determine which AJAX action to use
            var ajaxAction = isFeatured ? 'cricket_load_more_featured_posts' : 'cricket_load_more_posts';

            // AJAX request
            $.ajax({
                url: cricketBlogAjax.ajax_url,
                type: 'POST',
                data: {
                    action: ajaxAction,
                    nonce: cricketBlogAjax.nonce,
                    page: nextPage,
                    posts_per_page: postsPerPage,
                    category: category,
                    order: order,
                    orderby: orderby
                },
                success: function(response) {
                    if (response.success) {
                        // Append new posts to container
                        $container.append(response.data.html);

                        // Update button data attribute
                        $button.attr('data-page', nextPage);

                        // Hide loading and show button
                        $loading.hide();
                        $button.prop('disabled', false).show();

                        // Check if we've reached the last page
                        if (nextPage >= response.data.max_pages) {
                            $button.text('আর কোন পোস্ট নেই').prop('disabled', true);
                        }

                        // Optional: Add animation to new cards
                        $container.find('.card').slice(-parseInt(postsPerPage)).css({
                            opacity: 0,
                            transform: 'translateY(20px)'
                        }).each(function(index) {
                            $(this).delay(index * 100).animate({
                                opacity: 1
                            }, 400).css({
                                transform: 'translateY(0)'
                            });
                        });

                    } else {
                        alert(response.data.message || 'একটি ত্রুটি ঘটেছে।');
                        $loading.hide();
                        $button.prop('disabled', false).show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    alert('একটি ত্রুটি ঘটেছে। আবার চেষ্টা করুন।');
                    $loading.hide();
                    $button.prop('disabled', false).show();
                }
            });
        });

    });

})(jQuery);
