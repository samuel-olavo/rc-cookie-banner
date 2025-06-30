# rc_cookie_banner

**Roundcube plugin to display a GDPR-compliant cookie consent banner.**

This plugin shows a customizable modal asking the user for cookie consent and allows control over optional cookies (e.g., analytics, ads, embedded media). Consent is stored via either browser cookies or sessionStorage.

---

## 📦 Features

- Configurable list of Roundcube tasks where the banner is shown (`mail`, `login`, `settings`, etc.)
- Support for default consent (`accepted`, `rejected`, or `none`)
- Option to store consent only during the session (`sessionStorage`)
- Customizable banner text, buttons, and design via `banner.html` and `cookieconsent.css`
- Clean JavaScript logic with support for optional script injection

---

## 🛠 Installation

1. Clone or copy this plugin into the `plugins/` directory of your Roundcube installation:

```bash
cd roundcube/plugins/
git clone https://github.com/your-org/rc_cookie_banner.git
```
2. Enable the plugin by adding it to the $config['plugins'] array in your config/config.inc.php:

```php
$config['plugins'] = ['rc_cookie_banner'];
```

3. Configure the plugin by copying the example configuration file:

```bash
cp plugins/rc_cookie_banner/config.inc.php.dist plugins/rc_cookie_banner/config.inc.php
```
## ⚙ Configuration

Edit config.inc.php with the following options:

```php
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
```
## 🧱 Customisation

You can fully customise the banner appearance and content:

- `banner.html` – The modal layout and wording
- `cookieconsent.css` – The visual styles of the banner and buttons
- `cookieconsent.js` – The logic to show/hide the banner and store consent

