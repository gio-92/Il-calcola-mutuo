<?php

// Aggiungere le opzioni al database nella tabella wp_option quando il plugin viene disattivato
class Il_calcola_mutuo_activation {
    public static function activate() {
        if (!get_option('il_calcola_mutuo_importo')) {
            add_option('il_calcola_mutuo_importo', '100000');
        }
        if (!get_option('il_calcola_mutuo_interessi')) {
            add_option('il_calcola_mutuo_interessi', '3');
        }
        if (!get_option('il_calcola_mutuo_anni')) {
            add_option('il_calcola_mutuo_anni', '20');
        }
        if (!get_option('il_calcola_mutuo_color')) {
            add_option('il_calcola_mutuo_color', '#45a049');
        }
    }
}