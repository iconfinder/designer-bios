<?php
/**
 * Created by PhpStorm.
 * User: scott
 * Date: 12/19/16
 * Time: 3:30 PM
 */
?>
<h3>Iconfinder Profile Information</h3>
<table class="form-table">
    <tr>
        <th><label for="twitter">Iconfinder Username</label></th>
        <td>
            <input type="text" name="iconfinder_username" id="iconfinder_username" value="<?php echo esc_attr( get_the_author_meta( 'iconfinder_username', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Enter your Iconfinder.com username</span>
        </td>
    </tr>
    <tr>
        <th><label for="twitter">Twitter Username</label></th>
        <td>
            <input type="text" name="twitter_username" id="twitter_username" value="<?php echo esc_attr( get_the_author_meta( 'twitter_username', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Enter your Twitter.com username</span>
        </td>
    </tr>
</table>
