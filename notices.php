<?php

// Aggiungi una notice con le istruzioni per usare il plugin e fai in modo che la notice possa essere licenziata
class Il_Calcola_Mutuo_notices {
    public function __construct() {
        add_action('admin_notices', array($this, 'notices'));
        add_action('admin_init', array($this, 'is_dismiss'));
    }

    public function notices() {
        $user_id = get_current_user_id();
        if (!get_user_meta($user_id, 'calcola_mutuo_notices_dismissed')) {
            ?>
            <div class="notice notice-info">
                <p><?php _e('Per inserire Il Calcola Mutuo sul sito inserisci lo shortcose [calcola-mutuo]', 'il_calcola_mutuo') ?>
                    <a style="float: right;" href="?calcola-mutuo-is-dismissed">Dismiss</a>
                </p>
            </div>
            <?php
        }
    }

    public function is_dismiss() {
        $user_id = get_current_user_id();
        if (isset($_GET['calcola-mutuo-is-dismissed'])) {
            add_user_meta($user_id, 'calcola_mutuo_notices_dismissed', 'true', true);
        }
    }
}
new Il_Calcola_Mutuo_notices();