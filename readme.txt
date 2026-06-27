=== Armour Anti-Spam ===
Contributors: plsoftware
Tags: antispam, spam protection, comment spam, contact form spam, login spam
Requires at least: 5.0
Requires PHP: 7.0
Tested up to: 7.0
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Block spam without captcha or external services, using an invisible trap, a signed timer and a local stop-list. For comments, forms and logins.

== Description ==
Armour Anti-Spam blocks spam submissions using an invisible trap, with no captcha or extra fields for your visitors and no external API calls.

It layers several lightweight, privacy-friendly checks:

* Invisible spam trap - a hidden field added by JavaScript that only automated bots fill in.
* Signed time check - an HMAC-signed server timestamp blocks submissions sent faster than a human could, and bots cannot forge it even if they wait.
* Human interaction check - the trap is only activated after a real mouse move, scroll, tap, key press or click.
* Local stop-list - mark submissions that contain your own banned words or regular expressions as spam.

All checks run locally. No external services, no API keys, no captcha, no personal data collected.

Source code, documentation and issue tracker: [github.com/lpsoftwarecorp/armour-anti-spam](https://github.com/lpsoftwarecorp/armour-anti-spam)

**Automatic anti-spam protection for the following forms. No setup required.**

* WP Comments
* WP Registration
* bbPress Forum ([bbpress.org](https://bbpress.org))
* Contact Form 7 ([wordpress.org/plugins/contact-form-7](https://wordpress.org/plugins/contact-form-7))
* Gravity Forms (non-Ajax, single page/step forms - [gravityforms.com](https://www.gravityforms.com))
* WPForms ([wpforms.com](https://wpforms.com))
* Formidable Forms ([formidableforms.com](https://formidableforms.com))
* Caldera Forms ([calderaforms.com](https://calderaforms.com))
* Toolset Forms ([toolset.com](https://toolset.com))
* Elementor Forms ([elementor.com](https://elementor.com))
* Fluent Forms ([fluentforms.com](https://fluentforms.com))
* Divi Theme Contact Form ([elegantthemes.com](https://www.elegantthemes.com))
* Theme My Login ([wordpress.org/plugins/theme-my-login](https://wordpress.org/plugins/theme-my-login/))
* WooCommerce (login and product reviews)

GDPR compliant: no tracking, no cookie storage and no external server calls.

**How this plugin differs from other anti-spam plugins**

* Works with most forms and WordPress systems, including registration and comments - an all-in-one anti-spam solution.
* No external API calls like Akismet or CleanTalk for spam filtering.
* GDPR compliant.
* Spam bots can't run JavaScript, so we use JavaScript to insert an invisible spam-trap field that bots can't fill in to pass the check.
* A unique spam-trap field name is generated for each WordPress installation, so it is hard for bots to build a one-size-fits-all bypass.
* No setup required. Just activate the plugin and it enables anti-spam for all supported forms, comments and registration.
* No API key or monthly subscription needed, unlike many other plugins.

== Installation ==
1. You can install the plugin directly from the WordPress Plugins menu. Search for Armour Anti-Spam and click Install, or download the plugin and install armour-anti-spam.zip from the Upload Plugin button in the WordPress Plugins menu.
2. You can access the settings from the Armour Anti-Spam menu. From there you can change the spam-trap field name and the spam submission message.
3. Please check your forms, comments, bbPress and registration to confirm they work after the spam trap is placed. A widget below the forms confirms anti-spam protection is enabled and ready to block spam.

== Frequently Asked Questions ==

= How is this plugin different from other anti-spam plugins? =

We use the spam-trap technique differently to make it work better. Most plugins add the spam-trap field from the server side (PHP) and check whether the spam bot filled it in; if it is filled, the submission is marked as spam. In our case, we add the spam-trap field from the client side (JavaScript) and check whether the trap field exists at all. Spam bots can't run JavaScript, so the trap field is not available to them. This lets us trap spam bots more reliably.

= Will it block all spam submissions? =

Spam submissions are created either by spam bots or manually by users. The spam trap is for spam bots only, so submissions from spam bots are stopped. You get rid of most of the spam, and it blocks spam in any language effectively.

= How can I verify that anti-spam protection is enabled? =

Armour Anti-Spam is a trap for spam bots, so it is not visible to users. However, if you are logged in as an Administrator, the Armour Anti-Spam test widget is shown below the form. This confirms the anti-spam checker is active on that form, and also lets you test it as a spam bot.

= Do I need captcha verification? =

No. With this plugin you don't need Captcha, reCaptcha or Invisible Captcha at all. Let's avoid the hassle for ordinary users. Just activate the plugin and anti-spam filtering is enabled automatically for all supported forms.

= I am already using reCaptcha but still getting spam. Can this plugin stop spammers? =

Yes. Spam bots can now solve captcha puzzles, so captchas are no longer an effective filter. Our JavaScript-based filter can still block them, because spam bots can't run JavaScript.

= I see a setting to change the spam-trap field name. Do I need to change it? =

By default the plugin generates a unique spam-trap field name, making it even less likely that a bot can use the field to submit spam and preventing a one-size-fits-all bypass. If you still get spam-bot submissions, changing the field name should help.

= Can I see what data spammers are trying to submit? =

No. Armour Anti-Spam blocks spam bots without storing what they try to submit, keeping it lightweight and privacy-friendly.

== Screenshots ==

1. Settings page.
2. Statistics page.
3. Spam trap for Contact Form 7.
4. Spam trap for Formidable Forms.
5. Spam trap for Gravity Forms.
6. Spam trap for bbPress forum.
7. Spam trap for comments.
8. Spam trap for WPForms.
9. Spam trap for Caldera Forms.
10. Spam trap for Divi contact forms.
11. Spam trap for WooCommerce.
12. Spam trap for Fluent Forms.

== Changelog ==

= 1.0.0 =
* Initial release of Armour Anti-Spam by LP Software.
* Invisible spam trap added by JavaScript - blocks bots that cannot run scripts.
* Signed time check (HMAC) - blocks submissions sent faster than a human realistically could; the server timestamp cannot be forged. Cache-friendly and configurable from Settings.
* Human interaction check - the trap is activated only after a real mouse move, scroll, tap, key press or click.
* Local stop-word / blacklist (plain words or regular expressions) to catch manual spam too.
* Automatic protection for comments, registration, login, bbPress, Contact Form 7, WPForms, Gravity Forms, Formidable Forms, Caldera Forms, Toolset Forms, Elementor, Fluent Forms and Divi forms.
* No captcha, no external API calls, no personal data collected. GDPR-friendly.

== Upgrade Notice ==

= 1.0.0 =
Initial release. Activate to enable invisible spam-trap protection for comments, registration, login and all supported forms. No setup required.
