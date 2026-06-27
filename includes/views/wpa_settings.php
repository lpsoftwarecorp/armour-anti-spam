<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<form method="post" action="">

<!-- Spam Trap -->
<div class="wpa-card">
    <div class="wpa-card__head">
        <span class="dashicons dashicons-shield"></span>
        <h2 class="wpa-card__title">Spam Trap</h2>
    </div>
    <p class="wpa-card__intro">This plugin should work with default settings. If you begin to get spam, update the field name below.</p>
    <div class="wpa-card__body">

        <div class="wpa-row">
            <div class="wpa-row__label"><label for="wpa_field_name">Spam Trap Field Name</label></div>
            <div class="wpa-row__control">
                <div class="wpa-field-name">
                    <input id="wpa_field_name" name="wpa_field_name" style="width:300px;" value="<?php echo esc_attr(get_option('wpa_field_name')); ?>" type="text" readonly="readonly" />
                    <span class="wpa-regen" title="Generate a new field name" onclick="wpa_unqiue_field_name()"><span class="dashicons dashicons-update"></span></span>
                </div>
                <span class="wpa-hint">Changing the field name regularly is a good idea. Click the icon to generate a new field name.</span>
            </div>
        </div>

        <div class="wpa-row">
            <div class="wpa-row__label"><label for="wpa_error_message">Spam Trap Error Message</label></div>
            <div class="wpa-row__control">
                <input id="wpa_error_message" name="wpa_error_message" style="width:300px;" value="<?php echo esc_attr(get_option('wpa_error_message')); ?>" type="text" />
                <span class="wpa-hint">Message shown to bots. No average human user will ever see it.</span>
            </div>
        </div>

    </div>
</div>

<!-- Detection Rules -->
<div class="wpa-card">
    <div class="wpa-card__head">
        <span class="dashicons dashicons-clock"></span>
        <h2 class="wpa-card__title">Detection Rules</h2>
    </div>
    <div class="wpa-card__body">

        <div class="wpa-row">
            <div class="wpa-row__label"><label for="wpa_enable_timer">Enable Time Check (Signed Timer)</label></div>
            <div class="wpa-row__control">
                <select id="wpa_enable_timer" name="wpa_enable_timer">
                    <option value="yes" <?php selected( get_option('wpa_enable_timer', 'yes'), 'yes' ); ?>>Yes</option>
                    <option value="no" <?php selected( get_option('wpa_enable_timer', 'yes'), 'no' ); ?>>No</option>
                </select>
                <span class="wpa-hint">Blocks forms submitted faster than a human realistically could, using an HMAC-signed timestamp that bots cannot forge.</span>
            </div>
        </div>

        <div class="wpa-row">
            <div class="wpa-row__label"><label for="wpa_min_time">Minimum Fill Time (seconds)</label></div>
            <div class="wpa-row__control">
                <input id="wpa_min_time" name="wpa_min_time" style="width:80px;" value="<?php echo esc_attr(get_option('wpa_min_time', 3)); ?>" type="number" min="0" step="1" />
                <span class="wpa-hint">Submissions faster than this are treated as spam. Default 3. Set 0 to disable the minimum.</span>
            </div>
        </div>

        <div class="wpa-row">
            <div class="wpa-row__label"><label for="wpa_require_interaction">Require Human Interaction</label></div>
            <div class="wpa-row__control">
                <select id="wpa_require_interaction" name="wpa_require_interaction">
                    <option value="yes" <?php selected( get_option('wpa_require_interaction', 'yes'), 'yes' ); ?>>Yes</option>
                    <option value="no" <?php selected( get_option('wpa_require_interaction', 'yes'), 'no' ); ?>>No</option>
                </select>
                <span class="wpa-hint">The trap field is only activated after a real interaction (mouse move, scroll, tap, key press, focus or click), blocking bots that never interact. Set to No to restore the timed fallback if a form submits without user interaction. <span class="dashicons dashicons-warning wpa-warn-icon"></span> Test carefully on a live site.</span>
            </div>
        </div>

    </div>
</div>

<!-- Stop Words -->
<div class="wpa-card">
    <div class="wpa-card__head">
        <span class="dashicons dashicons-filter"></span>
        <h2 class="wpa-card__title">Stop Words / Blacklist</h2>
    </div>
    <div class="wpa-card__body">

        <div class="wpa-row">
            <div class="wpa-row__label"><label for="wpa_stop_words">Blocked words &amp; patterns</label></div>
            <div class="wpa-row__control">
                <textarea id="wpa_stop_words" name="wpa_stop_words" rows="6" style="width:100%;max-width:500px;" placeholder="One entry per line"><?php echo esc_textarea(get_option('wpa_stop_words', '')); ?></textarea>
                <span class="wpa-hint">One entry per line. Plain text matches as a case-insensitive substring (e.g. <code>buy diploma</code>). Wrap a line in slashes for a regular expression (e.g. <code>/\bcasino\b/i</code>). A submission matching any entry is treated as spam. Password fields are not scanned. Leave empty to disable.</span>
            </div>
        </div>

    </div>
</div>

<!-- Advanced -->
<div class="wpa-card">
    <div class="wpa-card__head">
        <span class="dashicons dashicons-admin-tools"></span>
        <h2 class="wpa-card__title">Advanced</h2>
    </div>
    <div class="wpa-card__body">

        <div class="wpa-row">
            <div class="wpa-row__label"><label for="wpa_disable_test_widget">Disable Spam Trap Test Widget</label></div>
            <div class="wpa-row__control">
                <select id="wpa_disable_test_widget" name="wpa_disable_test_widget">
                    <option value="no" <?php selected( get_option('wpa_disable_test_widget'), 'no' ); ?>>No</option>
                    <option value="yes" <?php selected( get_option('wpa_disable_test_widget'), 'yes' ); ?>>Yes</option>
                </select>
                <span class="wpa-hint">Only visible when an Admin user is logged in.</span>
            </div>
        </div>

        <div class="wpa-row">
            <div class="wpa-row__label"><label for="wpa_disable_jquery">Disable jQuery?</label></div>
            <div class="wpa-row__control">
                <select id="wpa_disable_jquery" name="wpa_disable_jquery">
                    <option value="no" <?php selected( get_option('wpa_disable_jquery'), 'no' ); ?>>No</option>
                    <option value="yes" <?php selected( get_option('wpa_disable_jquery'), 'yes' ); ?>>Yes</option>
                </select>
                <span class="wpa-hint"><span class="dashicons dashicons-warning wpa-warn-icon"></span> This is a new feature. Please test carefully before using on a live site.</span>
            </div>
        </div>

    </div>
</div>

<?php if (current_user_can('manage_options')) { ?>
    <div class="wpa-savebar">
        <?php wp_nonce_field( 'wpa_save_settings', 'wpa_nonce' ); ?>
        <input type="submit" name="submit-wpa-general-settings" class="button-primary" value="Save General Settings" />
    </div>
<?php } else { ?>
    <div class="wpa-savebar"><span class="wpa-warn">Only Administrators can make changes to these settings.</span></div>
<?php } ?>

</form>

<script type="text/javascript">
    function wpa_unqiue_field_name(){
        var randomChars = 'abcdefghijklmnopqrstuvwxyz';
        var length      = 6;
        var string = '';
        for ( var i = 0; i < length; i++ ) {
            string += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
        }
        var number = Math.floor(1000 + Math.random() * 9000);

        jQuery('#wpa_field_name').val(string+number);
    }
</script>
