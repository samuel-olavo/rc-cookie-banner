<?php
// List of Roundcube tasks (contexts) where the cookie banner will be shown.
// Typical values include: 'login', 'mail', 'settings'
$config['rc_cookie_banner.show_on_tasks'] = ['login', 'mail', 'settings'];

// Default consent behavior if no user choice has been made yet:
// - 'accepted' → Automatically accept all cookies
// - 'rejected' → Automatically reject all cookies
// - 'none'     → Ask user for consent via banner
$config['rc_cookie_banner.default_consent'] = 'none'; // 'accepted' or 'rejected'

// Cookie lifetime in seconds (default: 1 year = 31536000)
$config['rc_cookie_banner_lifetime'] = 31536000;

// If true, store consent only for the current session (uses sessionStorage instead of cookies)
$config['rc_cookie_banner.once_per_session'] = false;
