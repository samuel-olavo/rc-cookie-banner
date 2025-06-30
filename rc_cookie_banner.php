<?php
/**
 * Cookie Consent Banner Plugin for Roundcube
 *
 * This plugin displays a cookie consent modal to users and allows them
 * to accept or decline optional cookies. Consent information is stored
 * using either cookies or sessionStorage, based on configuration.
 *
 * Features:
 * - Configurable cookie lifetime
 * - Option to apply default consent without showing the banner
 * - Option to limit consent to the current session
 * - Allows customisation of tasks where the banner should appear
 *
 * For installation and configuration instructions, please read the README file.
 *
 * @author Samuel Olavo
 * @license GNU GPLv3+
 */

class rc_cookie_banner extends rcube_plugin
{
    public $task;

    function init()
    {
        $this->rc = rcube::get_instance();
        $this->load_config();

        $this->task = implode('|', $this->rc->config->get('rc_cookie_banner.show_on_tasks', ['login', 'mail', 'settings']));

        $this->include_script('cookieconsent.js');
        $this->include_stylesheet('cookieconsent.css');

        $lifetime = (int) $this->rc->config->get('rc_cookie_banner_lifetime', 31536000);
        $this->rc->output->set_env('rc_cookie_banner_lifetime', $lifetime);

        $default_consent = $this->rc->config->get('rc_cookie_banner.default_consent', 'none');
        $this->rc->output->set_env('rc_cookie_banner_default_consent', $default_consent);

        $once_per_session = (bool) $this->rc->config->get('rc_cookie_banner.once_per_session', false);
        $this->rc->output->set_env('rc_cookie_banner_once_per_session', $once_per_session);

        $this->add_hook('render_page', [$this, 'insert_banner']);
    }

    function insert_banner($p)
    {
        // Se é apenas por sessão, verificar sessionStorage via JS, não aqui
        if (!isset($_COOKIE['rc_cookie_consent'])) {
            $banner_path = __DIR__ . '/banner.html';
            if (file_exists($banner_path)) {
                $p['content'] .= file_get_contents($banner_path);
            }
        }
        return $p;
    }
}