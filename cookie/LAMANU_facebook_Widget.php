<?php

class LAMANU_facebook_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct('LAMANU_facebook', 'facebook', array('description' => 'Ajout du fil d\'actualité Facebook'));
    }

    public function widget($args, $instance) {
        wp_enqueue_script('facebook.js', plugin_dir_url(__FILE__) . 'js/facebook.js');
        ?><div class="fb-like" data-layout="<?= $instance['layout'] ?>" data-action="<?= $instance['action'] ?>" data-share="<?= $instance['share'] == 1 ? 'true' : 'false' ?>"></div><?php
    }

//Les options du plugin.
    public function form($instance) {
        $share = isset($instance['share']) ? $instance['share'] : '';
        $layout = isset($instance['layout']) ? $instance['layout'] : '';
        $action = isset($instance['action']) ? $instance['action'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_name('share'); ?>"><?php _e('Share :'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('share'); ?>" name="<?php echo $this->get_field_name('share'); ?>">
                <option value="1" <?= $share == 1 ? 'selected' : '' ?>><?php _e('Yes') ?></option>
                <option value="2" <?= $share == 2 ? 'selected' : '' ?>><?php _e('No') ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_name('layout'); ?>"><?php _e('Layout :'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>">
                <option value="standard" <?= $layout == 'standard' ? 'selected' : '' ?>><?php _e('Standard') ?></option>
                <option value="box_count" <?= $layout == 'box_count' ? 'selected' : '' ?>><?php _e('Box') ?></option>
                <option value="button_count" <?= $layout == 'button_count' ? 'selected' : '' ?>><?php _e('Button (count)') ?></option>
                <option value="button" <?= $layout == 'button' ? 'selected' : '' ?>><?php _e('Button') ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_name('action'); ?>"><?php _e('Type button :'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('action'); ?>" name="<?php echo $this->get_field_name('action'); ?>">
                <option value="like" <?= $action == 'like' ? 'selected' : '' ?>><?php _e('Like') ?></option>
                <option value="recommend" <?= $action == 'recommend' ? 'selected' : '' ?>><?php _e('Recommend') ?></option>
            </select>
        </p>
        <?php
    }

}
