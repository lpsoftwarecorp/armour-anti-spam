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

It layers several lightweight, privacy friendly checks:

* Invisible spam trap - a hidden field added by JavaScript that only automated bots fill in.
* Signed time check - an HMAC-signed server timestamp blocks submissions sent faster than a human could, and bots cannot forge it even if they wait.
* Human interaction check - the trap is only activated after a real mouse move, scroll, tap, key press or click.
* Local stop-list - mark submissions that contain your own banned words or regular expressions as spam.

All checks run locally. No external services, no API keys, no captcha, no personal data collected.

<strong>Automatic anti spam protection for the following forms. No setup required.</strong>

* WP Comments
* WP Registraton
* BBPress Forum (<a href="https://bbpress.org">bbpress.org</a>)
* Contact Form 7 (<a href="https://wordpress.org/plugins/contact-form-7">wordpress.org/plugins/contact-form-7</a>)
* Gravity Forms (For Non Ajax and Single Page/Step Form - <a href="https://www.gravityforms.com">gravityforms.com</a>)
* WPForms (<a href="https://wpforms.com">wpforms.com</a>)
* Formidable Forms (<a href="https://formidableforms.com">formidableforms.com</a>)
* Caldera Forms (<a href="https://calderaforms.com">calderaforms.com</a>)
* Toolset Forms (<a href="https://toolset.com">toolset.com</a>)
* Elementor Forms (<a href="https://elementor.com">elementor.com</a>)
* Fluent Forms (<a href="https://fluentforms.com">fluentforms.com</a>)
* Divi Theme Contact Form (<a href="https://www.elegantthemes.com">elegantthemes.com</a>)
* Theme My Login ( https://wordpress.org/plugins/theme-my-login/ )
* WooCommerce Reviews Pro
* GDPR compliant. No tracking, cookie storage or external server calls.

<strong>How our plugin is different than other anti spam plugins ? </strong>

* Works for most of the forms and wordpress system including registation and comments. So All in one anti spam solution.
* No external API calls like Akismet or CleanTalk for spam filtering. 
* GDPR Compliant.
* Spam bots can't use javascript so we use javascript to insert an invisible spam trap field in the form and spam bots can't fill it to pass anti spam test.
* Unique spam trap field name generated for each wordpress installation, so it is hard for spam bots to make one fit for all solution to bypass the spam trap test.
* No setup required. Just activate the plugin and it enables anti spam for all supported forms, comment and registration.
* No API or monthly subscription needed like other plugins.

== Installation ==
1. You can install plugin directly from Wordpress Plugin menu. Search for Armour Anti-Spam plugin and click on Install OR you can download the plugin and install armour-anti-spam.zip from Upload Plugin button from Wordpress Plugin menu.
2. You can also access the settings from Armour Anti-Spam menu. From there you can change spam trap field name and spam submission message.
3. Please check your forms, comments, bbpress, registration to confirm they are working after the spam trap is placed. There will be widgets below the forms to confirm anti spam protection is enabled and ready to block spam.

== Frequently Asked Questions ==

= How this plugin is different than other anti spam plugins ? =

We have used the spam trap technic differently in this plugin to make it work better. What other plugin does is, they add the spam trap field from server side (PHP) and check if the spam bot have filled or not. If it is filled it is marked as spam. But in our case, we add the spam trap field from client side (Javascript) and check if the trap field exists or not. Spam bots can't use javascript and the trap field is not available for them. This way we can better trap spam bot.

= Will it block all the spam submission ? =

Spam submission are either created by spam bot or by manual submission from users. The spam trap is for spam bots only. So there won't be submission from spam bots. So you get rid of most of the spam, and it blocks spam in any language effectively.

= How can i verify that anti spam protection is enabled ? =

Armour Anti-Spam is a trap for spam bots, so it is not visible for users. However, if you are logged in as Administrator, Armour Anti-Spam test widget is shown below the form. This will confirm the anti spam checker is active in that form. And also allows you to test it as spam bot.

= Do i need Captcha verification ? =

No, with this plugin you don't need Captcha, reCaptcha or Invisble Captcha at all. Lets avoid hassle for common users. Just activate the plugin and for all supported forms, anti spam filter is enabled automatically.

= I am already using reCaptcha but still getting spam. Can this plugin stop spammers ? =

Yes. Spam bots are now able to solve the captcha puzzle. So they are no longer effective as anti spam checker . Our plugin's javascript based anti spam filter can block them as spam bots can't use javascript.

= I see settings to change the spam trap field name. Do i need to change it ? =

By default our plugin generates unqiue spam trap field name so that the slim chance of spam bots using the field to submit spam is more slimmer. This blocks them to create one for all type solution to bypass the spam trap field. But even in that case if you get spam bot submission, chaging the field name should work.

= Can i see what data spammers are trying to submit ? =

With Armour Anti-Spam plugin it is No. The plugin blocks spam bots without storing what they try to submit, keeping it lightweight and privacy friendly.

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
11. Spam trap for WooCommerce checkout.
12. Spam trap for Fluent Forms.

== Changelog ==

= 1.0.0 =
* Initial release of Armour Anti-Spam by LP Software.
* Invisible spam trap added by JavaScript - blocks bots that cannot run scripts.
* Signed time check (HMAC) - blocks submissions sent faster than a human realistically could; the server timestamp cannot be forged. Cache friendly and configurable from Settings.
* Human interaction check - the trap is activated only after a real mouse move, scroll, tap, key press or click.
* Local stop-word / blacklist (plain words or regular expressions) to catch manual spam too.
* Automatic protection for comments, registration, login, bbPress, Contact Form 7, WPForms, Gravity Forms, Formidable Forms, Caldera Forms, Toolset Forms, Elementor, Fluent Forms and Divi forms.
* No captcha, no external API calls, no personal data collected. GDPR friendly.