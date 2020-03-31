<?php
$fields = [
    'full_name' => filter_input( INPUT_POST, 'full_name', FILTER_SANITIZE_STRING ),
    'position' => filter_input( INPUT_POST, 'position', FILTER_SANITIZE_STRING ),
    'phone' => filter_input( INPUT_POST, 'phone', FILTER_SANITIZE_STRING ),
];

if ( ! empty( $fields['full_name'] ) ) :

    $fields['tokenized_name'] = strtolower( str_replace( ' ', '-', $fields['full_name'] ) );
    $template = file_get_contents( 'https://raw.githubusercontent.com/nimblehq/email-signature/master/index.html' );

    foreach( $fields as $field => $value ) {
        switch( $field ) {
            case 'full_name':
                $template = str_replace( 'Your Name', $value, $template );
            break;

            case 'position':
                $template = str_replace( 'Position', $value, $template );
            break;

            case 'phone':
                $template = str_replace( '+66 (0)2 258 3649', $value, $template );
            break;

            case 'tokenized_name':
                $template = str_replace( 'your-name', $value, $template );
            break;
        }
    }

    echo $template;
    exit;

else : ?>

    <!DOCTYPE html>
    <html>
    <body>

        <form method="POST" action="">
            <label for="full_name">Full Name</label><br>
            <input type="text" id="full_name" name="full_name" value="">

            <br><br>

            <label for="position">Your Position</label><br>
            <input type="text" id="position" name="position" placeholder="Android Developer">

            <br><br>
            
            <label for="phone">Your Phone Number</label><br>
            <input type="text" id="phone" name="phone" placeholder="+66 (0)12-345-6789">

            <br><br>

            <input type="submit" value="Generate">
        </form>

    </body>
    </html>

<?php endif;