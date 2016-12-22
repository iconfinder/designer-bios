<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="designer-bio <?php echo $username; ?>-bio vcard">
    <?php if ( Utils::is_true($show_avatar ) ) : ?>
    <div class="avatar">
        <?php echo $avatar; ?>
    </div>
    <?php endif; ?>
    <?php if ( Utils::is_true($show_bio ) ) : ?>
    <div class="bio">
        <h4 class="name fn n">Article by <?php $nickname; ?></h4>
        <?php if ( $show_bio ) : ?>
            <p><?php echo $bio; ?></p>
        <?php endif; ?>
    </div>
    <?php else : ?>
        <h2>Icon sets by <?php echo $username; ?></h2>
    <? endif; ?>
    <div class="samples col-<?php echo $count; ?>">
        <?php echo isset($iconsets) ? $iconsets : '' ; ?>
    </div>
</div>
