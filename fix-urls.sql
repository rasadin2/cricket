-- Fix WordPress URLs in database
USE cricket;

-- Update siteurl
UPDATE wp_options SET option_value = 'http://localhost/cricket' WHERE option_name = 'siteurl';

-- Update home URL
UPDATE wp_options SET option_value = 'http://localhost/cricket' WHERE option_name = 'home';

-- Check the updates
SELECT option_name, option_value FROM wp_options WHERE option_name IN ('siteurl', 'home');
