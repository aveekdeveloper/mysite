<?php
    /*
     *      Osclass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2015 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php'); ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php'); ?>
        <div class="container">
        <div class="veraari">
            
            <div class="col-md-3">
                <?php echo osc_private_user_menu(); ?>
            </div>
            <div class="col-md-9">
              <div class="panel panel-default row">
  <div class="panel-heading">
                <h1><?php _e('Change your password', 'paris'); ?></h1></div>
  <div class="panel-body">
                
                <form action="<?php echo osc_base_url(true); ?>" method="post">
                    <input type="hidden" name="page" value="user" />
                    <input type="hidden" name="action" value="change_password_post" />
                    <fieldset>
                        <div class="form-group">
                            <label class="control-label" for="password"><?php _e('Current password', 'paris'); ?> *</label>
                            <input type="password" name="password" id="password" value="" />
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="new_password"><?php _e('New password', 'paris'); ?> *</label>
                            <input type="password" name="new_password" id="new_password" value="" />
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="new_password2"><?php _e('Repeat new password', 'paris'); ?> *</label>
                            <input type="password" name="new_password2" id="new_password2" value="" />
                        </div>
                        <div style="clear:both;"></div>
                        <button class="btn btn-primary btn-lg" type="submit"><span class="fa fa-check-square" aria-hidden="true"></span> <?php _e('Update', 'paris'); ?></button>
                    </fieldset>
                </form>
            </div>
        </div></div>
        </div></div>
        
        <?php osc_current_web_theme_path('footer.php'); ?>
    </body>
</html>