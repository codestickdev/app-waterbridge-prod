<?php
global $current_user;

if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action']) && $_POST['action'] == 'update-user') {

    /* Update user information. */

    if (!empty($_POST['updatePESEL']))
        update_user_meta($current_user->ID, 'user_pesel', esc_attr($_POST['updatePESEL']));
    if (!empty($_POST['updateBirthday']))
        update_user_meta($current_user->ID, 'user_birthday', esc_attr($_POST['updateBirthday']));
    if (!empty($_POST['updateStreet']))
        update_user_meta($current_user->ID, 'user_street', esc_attr($_POST['updateStreet']));
    if (!empty($_POST['updateBank']))
        update_user_meta($current_user->ID, 'user_bank', esc_attr($_POST['updateBank']));

    /* Redirect so the page will show updated info.*/
    /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
    if (count($error) == 0) {
        //action hook for plugins and extra fields saving
        do_action('edit_user_profile_update', $current_user->ID);
        wp_redirect(get_permalink());
        exit;
    }
}
?>
<div class="wbUpdate__content">
    <div class="popupLogo">
        <img src="/wp-content/themes/waterbridge/images/logo.svg"/>
    </div>
    <?php if ( is_user_logged_in() ) : ?>
        <div class="popupStep">
            <p>Krok <span>2 z 2</span></p>
        </div>
        <h3 class="popupTitle popupTitle--hasAfter">Uzupełnij dane</h3>
        <p class="popupAfterTitle">Dodaj pozostałe dane wymagane do podpisania umowy inwestycyjnej.</p>

        <form method="post" name="updateForm" class="updateForm" action="<?php the_permalink(); ?>">
            <input type="text" placeholder="Twój numer PESEL" minlength="11" maxlength="11" name="updatePESEL" class="input" value="<?php the_author_meta( 'user_pesel', $current_user->ID ); ?>" required/>
            <input type="text" class="input" placeholder="Data urodzenia" id="updateBirthday" name="updateBirthday" value="<?php the_author_meta( 'user_birthday', $current_user->ID ); ?>" title="Proszę uzyć formatu DD-MM-RRRR" pattern="(3[01]|[21][0-9]|0[1-9])-(1[0-2]|0[1-9])-(19[0-9][0-9]|20[0-9][0-9])" required>
            <input type="text" class="input" placeholder="Adres korespondencyjny" id="updateStreet" name="updateStreet" value="<?php the_author_meta( 'user_street', $current_user->ID ); ?>" required>
            <input type="text" class="input" placeholder="Numer konta bankowego" minlength="26" maxlength="26" id="updateBank" name="updateBank" value="<?php the_author_meta( 'user_bank', $current_user->ID ); ?>" required>
            <p class="formSubmit">
                <?php echo $referer; ?>
                <input name="updateuser" type="submit" id="updateuser" class="submit btn" value="Zapisz dane" />
                <?php wp_nonce_field( 'update-user' ) ?>
                <input name="action" type="hidden" id="action" value="update-user" />
            </p><!-- .form-submit -->
        </form>

        <div class="secureInfo">
            <p>Dbamy o bezpieczeństwo Twoich danych dzięki certyfikatowi SSL.</p>
        </div>
    <?php else: ?>
        <p>Musisz być zalogowany aby móc wprowadzić dane.</p>
    <?php endif; ?>
</div>