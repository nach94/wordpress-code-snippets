<?php
// Add an extra field to the native WordPress login form
function add_invitation_code_field() {
// Add invitation code field
    ?>
    <p>
        <label for="invitation_code">Código de invitación:</label>
        <input type="text" name="invitation_code" id="invitation_code" class="input" value="<?php echo isset( $_POST['invitation_code'] ) ? esc_attr( $_POST['invitation_code'] ) : ''; ?>" required autofocus />
    </p>
    <?php
}
add_action( 'login_form', 'add_invitation_code_field' );

// Validate mandatory fields and invitation code after form submission
function validate_invitation_code( $user, $username, $password ) {
    if ( isset( $_POST['wp-submit'] ) ) {
        $invitation_code = $_POST['invitation_code'];

        if ( empty( $invitation_code ) ) {
// Error message if invitation code is empty
            $error = new WP_Error();
            $error->add( 'empty_invitation_code', '<strong>ERROR</strong>: Please, insert your invitation code to Log in.' );
            return $error;
        }

// Get user meta fields
        $user_meta = get_user_meta( $user->ID );
// Get invitation code from meta field
        $user_invitation_code = isset( $user_meta['___USER META FIELD ID___'][0] ) ? $user_meta['___USER META FIELD ID___'][0] : '';

// Validate invitation code
        if ( $invitation_code !== $user_invitation_code ) {
// Error message if invitation code is incorrect
            $error = new WP_Error();
            $error->add( 'incorrect_invitation_code', '<strong>ERROR</strong>: Invalid invitation code.' );
            return $error;
        }
    }

    return $user;
}
add_filter( 'authenticate', 'validate_invitation_code', 30, 3 );