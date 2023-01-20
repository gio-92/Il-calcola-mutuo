<?php

class Il_calcola_mutuo_add_menu
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'active_menu'));
    }

    public function active_menu()
    {
        add_menu_page('menu il calcola mutuo', 'Il Calcola Mutuo', 'manage_options', 'il_calcola_mutuo_menu', array($this, 'il_calcola_mutuo_homepage'));
        add_submenu_page('il_calcola_mutuo_menu', 'Il Calcola Mutuo', 'Istruzioni', 'manage_options', 'il_calcola_mutuo_submenu', array($this, 'il_calcola_mutuo_istruzioni'));
    }

    public function il_calcola_mutuo_homepage()
    {
        if (isset($_POST['submit-homepage'])) {

            if (!get_option('il_calcola_mutuo_importo')) {
                add_option('il_calcola_mutuo_importo', '100000');
            } else {
                update_option('il_calcola_mutuo_importo', $_POST['option1']);
            }

            if (!get_option('il_calcola_mutuo_interesse')) {
                add_option('il_calcola_mutuo_interesse', '3');
            } else {
                update_option('il_calcola_mutuo_interesse', $_POST['option2']);
            }

            if (!get_option('il_calcola_mutuo_anni')) {
                add_option('il_calcola_mutuo_anni', '20');
            } else {
                update_option('il_calcola_mutuo_anni', $_POST['option3']);
            }

            if (!get_option('il_calcola_mutuo_color')) {
                add_option('il_calcola_mutuo_color', '#45a049');
            } else {
                update_option('il_calcola_mutuo_color', $_POST['option4']);
            }
        }
        $this->render_form();
    }

    public function render_form()
    {
?>
        <style>
            form#il-calcola-mutuo-homepage {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            form#il-calcola-mutuo-homepage strong {
                font-weight: bold;
                font-size: 15px;
                text-transform: capitalize;
            }

            form #submit-homepage {
                margin-top: 15px;
                max-width: 250px;
                padding: 10px;
                text-transform: capitalize;
                font-weight: bold;
                font-size: 16px;
            }
        </style>

        <h2>Il Calcola Mutuo</h2>
        <p style="font-style: italic;">Inseisci i valori di defult del Calcola Mutuo</p>
        <form method="POST" action="#" id="il-calcola-mutuo-homepage">
            <span><strong>Importo: </strong><input type="text" name="option1" placeholder="Inserisci l'importo" value="<?php echo get_option('il_calcola_mutuo_importo') ?>" /><strong> €</strong></span>
            <span><strong>Interesse: </strong><input type="text" name="option2" placeholder="Inserisci il tasso d'interesse" value="<?php echo get_option('il_calcola_mutuo_interesse') ?>" /> <strong>%</strong></span>
            <span><strong>Anni: </strong><input type="text" name="option3" placeholder="Inserisci il numero di anni" value="<?php echo get_option('il_calcola_mutuo_anni') ?>" /></span>
            <span>
                <strong><label for="il-calcola-mutuo-color">Scegli il colore del tema</label></strong>
                <input type="color" name="option4" value="<?php echo get_option('il_calcola_mutuo_color') ?>">
            </span>
            <input type="submit" name="submit-homepage" id="submit-homepage" value="Aggiorna" />
        </form>
    <?php
    }

    public function il_calcola_mutuo_istruzioni()
    {
    ?>
        <h2>Istruzioni</h2>
        <ul style="margin-top: 40px;">
            <li>Per <strong>attivare</strong> Il Calcola Mutuo sul sito web inserisci lo schortcode: <code style="color: blue;">[calcola-mutuo]</code>.</li>
            <br />
            <li style="line-height: 26px;">
                Per <strong>stilare</strong> Il Calcola Mutuo puoi utilizzare:
                <code style="color: blue;">form.il-calcola-mutuo</code> per il form,
                <code style="color: blue;">form.il-calcola-mutuo label</code> per la label,
                <code style="color: blue;">form.il-calcola-mutuo input[type=text], form.il-calcola-mutuo select</code> per gli input e
                <code style="color: blue;">form.il-calcola-mutuo button</code> per il button.
            </li>
        </ul>
<?php
    }
}
new Il_calcola_mutuo_add_menu();
