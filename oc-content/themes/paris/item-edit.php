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

   $locales   = __get('locales');
    $user = osc_user();
    osc_enqueue_style('jquery-ui-custom', osc_current_web_theme_styles_url('jquery-ui/jquery-ui-1.8.20.custom.css'));
    osc_enqueue_script('jquery-validate');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php'); ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />

        <!-- only item-edit.php -->
        <?php UserForm::location_javascript(); ?>
        <?php
        if(osc_images_enabled_at_items() && !paris_is_fineuploader()) {
            ItemForm::photos_javascript();
        }
        ?>
        <script type="text/javascript">

            $(document).ready(function(){
                $('body').on("created", '[name^="select_"]',function(evt) {
                    $(this).uniform();
                });
                $('body').on("removed", '[name^="select_"]',function(evt) {
                    $(this).parent().remove();
                });
            });

            function uniform_input_file(){
                photos_div = $('div.photos');
                $('div',photos_div).each(
                    function(){
                        if( $(this).find('div.uploader').length == 0  ){
                            divid = $(this).attr('id');
                            if(divid != 'photos'){
                                divclass = $(this).hasClass('box');
                                if( !$(this).hasClass('box') & !$(this).hasClass('uploader') & !$(this).hasClass('row')){
                                    $("div#"+$(this).attr('id')+" input:file").uniform({fileDefaultText: fileDefaultText,fileBtnText: fileBtnText});
                                }
                            }
                        }
                    }
                );
            }

            setInterval("uniform_plugins()", 250);
            function uniform_plugins() {

                var content_plugin_hook = $('#plugin-hook').text();
                content_plugin_hook = content_plugin_hook.replace(/(\r\n|\n|\r)/gm,"");
                if( content_plugin_hook != '' ){

                    var div_plugin_hook = $('#plugin-hook');
                    var num_uniform = $("div[id*='uniform-']", div_plugin_hook ).size();
                    if( num_uniform == 0 ){
                        if( $('#plugin-hook input:text').size() > 0 ){
                            $('#plugin-hook input:text').uniform();
                        }
                        if( $('#plugin-hook select').size() > 0 ){
                            $('#plugin-hook select').uniform();
                        }
                    }
                }
            }
            <?php if(osc_locale_thousands_sep()!='' || osc_locale_dec_point() != '') { ?>
            $().ready(function(){
                $("#price").blur(function(event) {
                    var price = $("#price").prop("value");
                    <?php if(osc_locale_thousands_sep()!='') { ?>
                    while(price.indexOf('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>')!=-1) {
                        price = price.replace('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>', '');
                    }
                    <?php }; ?>
                    <?php if(osc_locale_dec_point()!='') { ?>
                    var tmp = price.split('<?php echo osc_esc_js(osc_locale_dec_point())?>');
                    if(tmp.length>2) {
                        price = tmp[0]+'<?php echo osc_esc_js(osc_locale_dec_point())?>'+tmp[1];
                    }
                    <?php }; ?>
                    $("#price").prop("value", price);
                });
            });
            <?php }; ?>
        </script>
        <!-- end only item-edit.php -->
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php'); ?>
        <div id="content" class="container">
            <div class="col-md-8">
             <div class="row">
              <div class="col-md-12">
<style>.qq-uploader {
  position: relative;
  width: 100%;
}.qq-upload-button {background: #0088CC;}</style>
<div class="panel panel-default row">
  <div class="panel-heading">
                  <h1><strong><?php _e('Update your listing', 'paris'); ?></strong></h1></div>
  <div class="panel-body">
           
            <div class="col-md-12">
           
            <ul id="error_list"></ul>
                <form name="item" action="<?php echo osc_base_url(true)?>" method="post" enctype="multipart/form-data">
                <fieldset>
                    <input type="hidden" name="action" value="item_edit_post" />
                    <input type="hidden" name="page" value="item" />
                    <input type="hidden" name="id" value="<?php echo osc_item_id();?>" />
                    <input type="hidden" name="secret" value="<?php echo osc_item_secret();?>" />
                        <div class="box general_info">
                            
                            <div class="form-group">
                            <label class="control-label" for="select_1"><?php _e('Select a category', 'paris'); ?></label>
                            <div class="controls">
                                <?php ItemForm::category_select(null, null, __('Select a category', 'paris')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="title[<?php echo osc_locale_code(); ?>]"><?php _e('Title', 'paris'); ?></label>
                            <div class="controls">
                                <?php ItemForm::title_input('title',osc_locale_code(), osc_esc_html( paris_item_title() )); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description[<?php echo osc_locale_code(); ?>]"><?php _e('Description', 'paris'); ?></label>
                            <div class="controls">
                                <?php ItemForm::description_textarea('description',osc_locale_code(), osc_esc_html( paris_item_description() )); ?>
                            </div>
                          
                        </div>
                            <?php if( osc_price_enabled_at_items() ) { ?>
                            <div class="form-group price">
                                <label><?php _e('Price', 'paris'); ?></label>
                                <?php ItemForm::price_input_text(); ?>
                                <?php ItemForm::currency_select(); ?>
                            </div>
                            <?php } ?>
                        </div>
                        <?php if( osc_images_enabled_at_items() ) { ?>
                        <div class="box photos">
                            <?php
                            if(osc_images_enabled_at_items()) {
                                if(paris_is_fineuploader()) {
                                    // new ajax photo upload
                                    ItemForm::ajax_photos();
                                }
                            } else { ?>
                            <h2><?php _e('Photos', 'paris'); ?></h2>
                            <?php ItemForm::photos(); ?>
                            <div id="photos">
                                <?php if(osc_max_images_per_item()==0 || (osc_max_images_per_item()!=0 && osc_count_item_resources()<  osc_max_images_per_item())) { ?>
                                <div class="row">
                                    <input type="file" name="photos[]" />
                                </div>
                                <?php }; ?>
                            </div>
                            <a href="#" onclick="addNewPhoto(); uniform_input_file(); return false;"><?php _e('Add new photo', 'paris'); ?></a>
                        <?php
                            }
                        }
                        ?>

                        <div class="box location">
                            
                            
                            <div class="form-group">
                            <label class="control-label" for="country"><?php _e('Country', 'paris'); ?> *</label>
                            <?php UserForm::country_select(osc_get_countries(), osc_user()); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="region"><?php _e('City', 'paris'); ?> *</label>
                            <?php UserForm::region_select(osc_get_regions(), osc_user()); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="city"><?php _e('Locality', 'paris'); ?> *</label>
                              <?php UserForm::city_select(osc_get_cities(), osc_user()); ?>
                        </div>
                            <div class="form-group">
                                <label><?php _e('Address', 'paris'); ?></label>
                                <?php ItemForm::city_area_text(); ?>
                            </div>
                            <div class="form-group">
                                <label><?php _e('Map search string', 'paris'); ?></label>
                                <?php ItemForm::address_text(); ?>
                            </div>
                        </div>
                        
                        <?php ItemForm::plugin_edit_item(); ?>
                        <div class="form-group">
                            
                            <label><input type="checkbox" required=""><?php _e('I agree to the', 'paris'); ?><a target="_blank" href="<?php echo osc_get_preference('tos-me', 'paris'); ?>"><?php _e('Terms of Use', 'paris'); ?></a></label>
                        </div>
                        <?php if( osc_recaptcha_items_enabled() ) {?>
                        <div class="box">
                            <div class="row">
                                <?php osc_show_recaptcha(); ?>
                            </div>
                        </div>
                        <?php }?>
                    <button class="btn btn-primary btn-lg" type="submit"><span class="fa fa-check-square" aria-hidden="true"></span> <?php _e('Update', 'paris'); ?></button>
                    <a href="javascript:history.back(-1)" class="btn btn-warning btn-lg go_back"><span class="fa fa-undo" aria-hidden="true"></span> <?php _e('Cancel', 'paris'); ?></a>
                </fieldset>
            </form></div>

            </div>
          </div>
        </div>
        </div>
        </div>
<?php osc_current_web_theme_path('sidebar.php'); ?>
</div>
        <?php osc_current_web_theme_path('footer.php'); ?>
    </body>
</html>