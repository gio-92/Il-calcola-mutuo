<?php

// Crea un shortcode da inserire nel sito per attivare il calcola mutuo che aggiunge un form con relativi campi
class Plugin_wp_shortcode
{
    public function __construct()
    {
        add_shortcode('calcola-mutuo', array($this, 'shortcode'));
    }

    public function shortcode($attr)
    {
        $array = array('id' => '');
        extract(shortcode_atts($array, $attr)); ?>
        <div class="il-calcola-mutuo-container">
            <form class='il-calcola-mutuo'>
                <label>Importo</label>
                <input type="text" name="importo" id="importo" placeholder="Importo" value="<?php echo get_option('il_calcola_mutuo_importo') ?>">
                <label>Interesse</label>
                <input type="text" name="interesse" id="interesse" placeholder="Interesse" value="<?php echo get_option('il_calcola_mutuo_interesse') ?>">
                <label>Anni</label>
                <input type="text" name="anni" id="anni" placeholder="Anni" value="<?php echo get_option('il_calcola_mutuo_anni') ?>">
                <label for="tipo-rata">Tipo Rata</label>
                <select id="tipo-rata" name="tipo-rata">
                    <option value="mensile">Mensile</option>
                    <option value="trimestrale">Trimestrale</option>
                    <option value="semestrale">Semestrale</option>
                    <option value="annuale">Annuale</option>
                </select>
                <button>Calcola</button>
            </form>
            <div id="il-calcola-mutuo-risultati"></div>
            <div id="il-calcola-mutuo-tabella-ammortamento"></div>
        </div>

        <!-- Crea una variabile js per salvare il colore -->
        <script>
            let inputColor = '<?php echo get_option('il_calcola_mutuo_color'); ?>'
        </script>
<?php
    }
}
new Plugin_wp_shortcode();