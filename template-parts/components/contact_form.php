<?php
    $headline = get_sub_field('headline');
    $highlightText = get_sub_field('highlight_text');
    $mediaType = get_sub_field('media_type');
    $video = get_sub_field('video');
    $youtube = get_sub_field('youtube');
    $lottie = get_sub_field('lottie');
    $image = get_sub_field('image');
    $labelNameField = get_sub_field('label_name_field');
    $labelEmailField = get_sub_field('label_email_field');
    $labelMessageField = get_sub_field('label_message_field');
    $labelButton = get_sub_field('label_button');
    $emailRecipient = get_sub_field('email_recipient');
    $successMessage = get_sub_field('success_message');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $fullHeight = get_sub_field('full_height');
    $subline = get_sub_field('subline');
    $text = get_sub_field('text');
    $imageWidth = get_sub_field('image_width');
    $imagePosition = get_sub_field('image_position');
?>
<section class="contact-form<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    ">
    <div class="container">
        <div class="contact-form-img"<?php if ($imageWidth || $imagePosition): ?> style="<?php if($imageWidth):?>--image-width: <?= $imageWidth; ?>;<?php endif;?><?php if($imagePosition):?>--image-position:<?php if($imagePosition === 'Top'):?> flex-start;<?php endif; ?><?php if($imagePosition === 'Center'):?> center;<?php endif; ?><?php if($imagePosition === 'Bottom'):?> flex-end;<?php endif; ?><?php endif;?>"<?php endif; ?>>
            <?php if($mediaType === 'Image'):?>
                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($image, 'large'); ?>">
            <?php endif;?>
            <?php if($mediaType === 'Video'):?>
                <video controls autoplay muted preload="metadata" class="video">
                    <source src="<?= $video; ?>" type="video/mp4">
                </video>
            <?php endif;?>
            <?php if($mediaType === 'Youtube'):?>
                <div class="iframe-container">
                    <iframe src="<?= $youtube; ?>?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            <?php endif;?>
            <?php if($mediaType === 'Lottie'):?>
                <?= $lottie; ?>
            <?php endif;?>
        </div>
        <div class="contact-form-form">
        <?php if ($highlightText): ?><span class="highlight"><?= $highlightText; ?></span><?php endif; ?>
            <h2><?= $headline; ?></h2>
            <?php if ($subline): ?>
                <h3>
                    <?= $subline; ?>
                </h3>
            <?php endif; ?>
            <?php if ($text): ?>  
                <span>
                    <?= $text; ?>
                </span>
                <?php endif; ?>
            <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" class="contact-form-container">
                <div class="form-group">
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
                    <label for="cf-message"><?= $labelMessageField; ?></label>
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
                    
                    // Email to admin
                    $to = $emailRecipient; // Sends the email to the admin
                    $subject = 'Contact Form Submission from ' . $name;
                    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
                    $headers = array('Content-Type: text/plain; charset=UTF-8');
                    
                    // Send email to admin
                    wp_mail($to, $subject, $body, $headers);
                
                    // Email to customer
                    $customer_subject = 'Thank you for contacting us!';
                    $customer_body = "Hello $name,\n\nThank you for reaching out! We have received your message and will get back to you shortly.\n\nBest regards,\nwickie";
                    $customer_headers = array('Content-Type: text/plain; charset=UTF-8');
                
                    // Send email to customer
                    wp_mail($email, $customer_subject, $customer_body, $customer_headers);
                
                    // Confirmation message
                    echo '<div class="success-message">' . $successMessage . '</div>';
                }
            ?>
        </div>
    </div>
</section>