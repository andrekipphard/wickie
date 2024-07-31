<?php
    $headline = get_sub_field('headline');
    $highlightText = get_sub_field('highlight_text');
    $image = get_sub_field('image');
    $labelNameField = get_sub_field('label_name_field');
    $labelEmailField = get_sub_field('label_email_field');
    $labelMessageField = get_sub_field('label_message_field');
    $labelButton = get_sub_field('label_button');
    $emailRecipient = get_sub_field('email_recipient');
    $successMessage = get_sub_field('success_message');
?>
<section class="contact-form">
    <div class="container">
        <div class="contact-form-img">
            <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large'); ?>">
        </div>
        <div class="contact-form-form">
            <span class="highlight"><?= $highlightText; ?></span>
            <h2><?= $headline; ?></h2>
            <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" class="contact-form-container">
                <div class="form-group-inline">
                    <div class="form-group">
                        <label for="cf-name"><?= $labelNameField; ?></label>
                        <input type="text" id="cf-name" name="cf-name" required>
                    </div>
                    <div class="form-group">
                        <label for="cf-email"><?= $labelEmailField; ?></label>
                        <input type="email" id="cf-email" name="cf-email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cf-message"><?= $labelButton; ?></label>
                    <textarea id="cf-message" name="cf-message" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="cf-submitted" value="<?= $labelButton; ?>" class="btn btn-primary">
                </div>
            </form>
            <?php
                // Check if the form is submitted
                if (isset($_POST['cf-submitted'])) {
                    // Sanitize input fields
                    $name = sanitize_text_field($_POST['cf-name']);
                    $email = sanitize_email($_POST['cf-email']);
                    $message = esc_textarea($_POST['cf-message']);
                    
                    // Prepare email
                    $to = $emailRecipient; // Sends the email to the admin
                    $subject = 'Contact Form Submission from ' . $name;
                    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
                    $headers = array('Content-Type: text/plain; charset=UTF-8');
                    
                    // Send email
                    wp_mail($to, $subject, $body, $headers);

                    // Confirmation message
                    echo '<div class="success-message">'. $successMessage;'</div>';
                }
            ?>
        </div>
    </div>
</section>