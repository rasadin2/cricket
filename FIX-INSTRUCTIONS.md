# WordPress Cricket Project - Redirect Fix

## 🚨 Problem Identified
The cricket project at `http://localhost/cricket/` was redirecting to `http://localhost/notout/wp-login.php` due to incorrect URL configuration.

## ✅ Fixes Applied

### 1. **wp-config.php** (Lines 96-104)
**Changed from:**
```php
define('WP_HOME', 'http://localhost/notout');
define('WP_SITEURL', 'http://localhost/notout');
define('COOKIEPATH', '/notout/');
define('SITECOOKIEPATH', '/notout/');
define('ADMIN_COOKIE_PATH', '/notout/');
define('PLUGINS_COOKIE_PATH', '/notout/wp-content/plugins');
```

**Changed to:**
```php
define('WP_HOME', 'http://localhost/cricket');
define('WP_SITEURL', 'http://localhost/cricket');
define('COOKIEPATH', '/cricket/');
define('SITECOOKIEPATH', '/cricket/');
define('ADMIN_COOKIE_PATH', '/cricket/');
define('PLUGINS_COOKIE_PATH', '/cricket/wp-content/plugins');
```

### 2. **.htaccess** (Created)
Created proper WordPress .htaccess file with correct RewriteBase:
```apache
RewriteBase /cricket/
```

### 3. **Database URLs** (Needs Manual Update)
Created `fix-urls.php` script to update database settings.

## 📋 Steps to Complete the Fix

### Step 1: Run the Database Fix Script
1. Make sure XAMPP MySQL is running
2. Visit: `http://localhost/cricket/fix-urls.php`
3. The script will update the database URLs automatically
4. **Delete the fix-urls.php file after running it** (for security)

### Step 2: Clear Browser Data
1. Clear your browser cache
2. Clear all cookies for `localhost`
3. Close and reopen your browser

### Step 3: Test the Fix
1. Visit: `http://localhost/cricket`
2. Login at: `http://localhost/cricket/wp-login.php`
3. Verify the site loads without redirecting to `/notout/`

## 🔧 Alternative: Manual Database Fix

If you prefer to update the database manually using phpMyAdmin:

1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Select database: `cricket`
3. Click on table: `wp_options`
4. Find and edit these rows:
   - `option_name = 'siteurl'` → Set `option_value = 'http://localhost/cricket'`
   - `option_name = 'home'` → Set `option_value = 'http://localhost/cricket'`

## 📁 Files Modified/Created

- ✏️ **Modified:** `wp-config.php` (URL configurations)
- ➕ **Created:** `.htaccess` (WordPress rewrite rules)
- ➕ **Created:** `fix-urls.php` (Database URL fixer - delete after use)
- ➕ **Created:** `fix-urls.sql` (Alternative SQL script)

## ⚠️ Security Notes

1. **Delete fix-urls.php** after running it
2. Keep `WP_DEBUG` enabled only for development
3. The database uses empty password for root (change in production)

## 🎯 Expected Result

After completing all steps:
- ✅ `http://localhost/cricket` loads the WordPress site
- ✅ `http://localhost/cricket/wp-login.php` shows login page
- ✅ No redirects to `/notout/`
- ✅ Admin dashboard accessible at `http://localhost/cricket/wp-admin`
