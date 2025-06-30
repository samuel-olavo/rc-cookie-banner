document.addEventListener('DOMContentLoaded', function () {
    const banner = document.getElementById('cookie-banner');
    const overlay = document.getElementById('cookie-overlay');

    if (!banner || !overlay) return;

    const cookieLifetime = window.rcmail?.env?.rc_cookie_banner_lifetime || 31536000;
    const defaultConsent = window.rcmail?.env?.rc_cookie_banner_default_consent || 'none';
    const oncePerSession = !!window.rcmail?.env?.rc_cookie_banner_once_per_session;

    const consent = getStoredConsent();

    if (!consent) {
        if (defaultConsent === 'accepted' || defaultConsent === 'rejected') {
            setStoredConsent(defaultConsent);
            if (defaultConsent === 'accepted') enableOptionalScripts();
            return;
        }

        overlay.style.display = 'block';
        banner.style.display = 'block';
    } else if (consent === 'accepted') {
        enableOptionalScripts();
    }

    document.getElementById('cookie-accept')?.addEventListener('click', () => {
        setStoredConsent('accepted');
        enableOptionalScripts();
        overlay?.remove();
        banner?.remove();
    });

    document.getElementById('cookie-decline')?.addEventListener('click', () => {
        setStoredConsent('rejected');
        overlay?.remove();
        banner?.remove();
    });

    function getStoredConsent() {
        if (oncePerSession) {
            return sessionStorage.getItem('rc_cookie_consent');
        } else {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; rc_cookie_consent=`);
            return parts.length === 2 ? parts.pop().split(';').shift() : null;
        }
    }

    function setStoredConsent(value) {
        if (oncePerSession) {
            sessionStorage.setItem('rc_cookie_consent', value);
        } else {
            const secure = location.protocol === 'https:' ? '; Secure' : '';
            document.cookie = `rc_cookie_consent=${value}; path=/; max-age=${cookieLifetime}; SameSite=Lax${secure}`;
        }
    }
});

function enableOptionalScripts() {
    // Load optional scripts here if needed
    //Example:
    /*
    const script = document.createElement('script');
    script.src = 'https://www.googletagmanager.com/gtag/js?id=UA-XXXXXXX-X';
    script.async = true;
    document.head.appendChild(script);

    window.dataLayer = window.dataLayer || [];
    function gtag(){ dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'UA-XXXXXXX-X');
    */
}
