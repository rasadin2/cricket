/**
 * Blog Admin Panel JavaScript
 */
(function($) {
    'use strict';

    $(document).ready(function() {

        var $generateBtn = $('#cricket-generate-posts-btn');
        var $progressContainer = $('#cricket-generation-progress');
        var $progressBar = $('#cricket-progress-bar');
        var $progressText = $('#cricket-progress-text');
        var $progressDetail = $('#cricket-progress-detail');
        var $progressPercentage = $('#cricket-progress-percentage');
        var $resultContainer = $('#cricket-generation-result');

        // Generate posts button click
        $generateBtn.on('click', function(e) {
            e.preventDefault();

            // Confirm action
            if (!confirm('আপনি কি নিশ্চিত যে আপনি ২০টি ডেমো পোস্ট তৈরি করতে চান?')) {
                return;
            }

            // Disable button and show progress
            $generateBtn.prop('disabled', true).text('তৈরি হচ্ছে...');
            $progressContainer.show();
            $resultContainer.hide().html('');

            // Simulate progress animation
            var progress = 0;
            var progressInterval = setInterval(function() {
                if (progress < 90) {
                    progress += Math.random() * 15;
                    if (progress > 90) progress = 90;
                    updateProgress(progress, 'পোস্ট তৈরি হচ্ছে...');
                }
            }, 200);

            // AJAX request
            $.ajax({
                url: cricketAdminAjax.ajax_url,
                type: 'POST',
                data: {
                    action: 'cricket_generate_demo_posts',
                    nonce: cricketAdminAjax.nonce
                },
                success: function(response) {
                    clearInterval(progressInterval);

                    if (response.success) {
                        // Complete progress
                        updateProgress(100, 'সম্পন্ন হয়েছে!');

                        // Show success message
                        setTimeout(function() {
                            $progressContainer.fadeOut(300, function() {
                                showResult('success', response.data.message);
                                resetButton();

                                // Reload page after 2 seconds to update stats
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            });
                        }, 500);

                    } else {
                        clearInterval(progressInterval);
                        $progressContainer.fadeOut(300, function() {
                            showResult('error', response.data.message || 'একটি ত্রুটি ঘটেছে।');
                            resetButton();
                        });
                    }
                },
                error: function(xhr, status, error) {
                    clearInterval(progressInterval);
                    console.error('AJAX Error:', error);
                    $progressContainer.fadeOut(300, function() {
                        showResult('error', 'সার্ভার ত্রুটি। অনুগ্রহ করে আবার চেষ্টা করুন।');
                        resetButton();
                    });
                }
            });
        });

        /**
         * Update progress bar
         */
        function updateProgress(percentage, text) {
            if (percentage > 100) percentage = 100;
            if (percentage < 0) percentage = 0;

            $progressBar.css('width', percentage + '%');
            $progressPercentage.text(Math.round(percentage) + '%');
            $progressText.text(text);

            // Update detail text based on progress
            var detail = '';
            if (percentage < 30) {
                detail = 'ক্যাটাগরি প্রস্তুত করা হচ্ছে...';
            } else if (percentage < 60) {
                detail = 'পোস্ট কন্টেন্ট তৈরি হচ্ছে...';
            } else if (percentage < 90) {
                detail = 'ডাটাবেসে সংরক্ষণ করা হচ্ছে...';
            } else {
                detail = 'চূড়ান্ত করা হচ্ছে...';
            }
            $progressDetail.text(detail);
        }

        /**
         * Show result message
         */
        function showResult(type, message) {
            var iconClass = type === 'success' ? 'dashicons-yes-alt' : 'dashicons-dismiss';
            var bgColor = type === 'success' ? '#d4edda' : '#f8d7da';
            var borderColor = type === 'success' ? '#28a745' : '#dc3545';
            var textColor = type === 'success' ? '#155724' : '#721c24';

            var html = '<div style="background: ' + bgColor + '; border-left: 4px solid ' + borderColor + '; padding: 15px; border-radius: 4px;">' +
                       '<p style="margin: 0; color: ' + textColor + '; font-weight: 600;">' +
                       '<span class="dashicons ' + iconClass + '" style="margin-right: 5px;"></span>' +
                       message +
                       '</p>' +
                       '</div>';

            $resultContainer.html(html).fadeIn(300);
        }

        /**
         * Reset button to original state
         */
        function resetButton() {
            $generateBtn.prop('disabled', false).html(
                '<span class="dashicons dashicons-plus-alt" style="margin-top: 4px;"></span> ' +
                '২০টি নমুনা পোস্ট তৈরি করুন'
            );
        }

        /**
         * Copy shortcode to clipboard
         */
        $(document).on('click', 'code', function() {
            var $code = $(this);
            var text = $code.text();

            // Create temporary textarea
            var $temp = $('<textarea>');
            $('body').append($temp);
            $temp.val(text).select();

            try {
                document.execCommand('copy');

                // Show feedback
                var originalBg = $code.css('background-color');
                $code.css('background-color', '#d4edda');

                setTimeout(function() {
                    $code.css('background-color', originalBg);
                }, 300);

                // Optional: Show tooltip
                showTooltip($code, 'কপি হয়েছে!');

            } catch (err) {
                console.error('Failed to copy:', err);
            }

            $temp.remove();
        });

        /**
         * Show tooltip
         */
        function showTooltip($element, text) {
            var $tooltip = $('<div class="cricket-tooltip">' + text + '</div>');
            $tooltip.css({
                position: 'absolute',
                background: '#333',
                color: '#fff',
                padding: '5px 10px',
                borderRadius: '3px',
                fontSize: '12px',
                zIndex: 9999,
                pointerEvents: 'none'
            });

            $('body').append($tooltip);

            var offset = $element.offset();
            $tooltip.css({
                top: offset.top - $tooltip.outerHeight() - 5,
                left: offset.left + ($element.outerWidth() / 2) - ($tooltip.outerWidth() / 2)
            });

            setTimeout(function() {
                $tooltip.fadeOut(200, function() {
                    $tooltip.remove();
                });
            }, 1500);
        }

        /**
         * Add hover effect to code blocks
         */
        $('code').css({
            cursor: 'pointer',
            transition: 'background-color 0.2s'
        }).hover(
            function() {
                $(this).css('opacity', '0.8');
            },
            function() {
                $(this).css('opacity', '1');
            }
        ).attr('title', 'ক্লিক করে কপি করুন');

    });

})(jQuery);
