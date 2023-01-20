<?php

// Rimuovere le opzioni al database nella tabella wp_option quando il plugin viene disattivato
class Il_calcola_mutuo_deactivation {
    public static function deactivate() {
        delete_option('il_calcola_mutuo_importo');
        delete_option('il_calcola_mutuo_interessi');
        delete_option('il_calcola_mutuo_anni');
        delete_option('il_calcola_mutuo_color');
    }
}