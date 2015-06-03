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
        <?php if( osc_count_items() == 0 || Params::getParam('iPage') > 0 || stripos($_SERVER['REQUEST_URI'], 'search') )  { ?>
            <meta name="robots" content="noindex, nofollow" />
            <meta name="googlebot" content="noindex, nofollow" />
        <?php } else { ?>
            <meta name="robots" content="index, follow" />
            <meta name="googlebot" content="index, follow" />
        <?php } ?>
            <style>
                ul.sub {
                    padding-left: 20px;
                }
                .chbx{
                    width:15px; height:15px;
                    display: inline;
                    padding:8px 3px;
                    background-repeat:no-repeat;
                    cursor: pointer;
                }
                .chbx span{
                    width:13px; height:13px;
                    display: inline-block;
                    border:solid 1px #bababa;
                    border-radius:2px;
                    -moz-border-radius:2px;
                    -webkit-border-radius:2px;
                }
                .chbx.checked{
                    background-image:url('<?php echo osc_current_web_theme_url('images/checkmark.png'); ?>');
                }
                .chbx.semi-checked{
                    background-image:url('<?php echo osc_current_web_theme_url('images/checkmark-partial.png'); ?>');
                }
            </style>
            <script type="text/javascript">
                $(document).ready(function(){
                    $('li.parent').each(function() {
                        var totalInputSub = $(this).find('ul.sub>li>input').size();
                        var totalInputSubChecked = $(this).find('ul.sub>li>input:checked').size();
                        $(this).find('ul.sub>li>input').each(function(){
                            $(this).hide();
                            var id = $(this).attr('id');
                            id = id+'_';
                            if( $(this).is(':checked') ){
                                var aux = $('<div class="chbx checked"><span></span></div>').attr('id', id);
                                $(this).before(aux);
                            } else {
                                var aux = $('<div class="chbx"><span></span></div>').attr('id', id);
                                $(this).before(aux);
                            }
                        });

                        var input = $(this).find('input.parent');
                        $(input).hide();
                        var id = $(input).attr('id');
                        id = id+'_';
                        if(totalInputSub == totalInputSubChecked) {
                            if(totalInputSub == 0) {
                                if( $(this).find("input[name='sCategory[]']:checked").size() > 0) {
                                    var aux = $('<div class="chbx checked"><span></span></div>').attr('id', id);
                                    $(input).before(aux);
                                } else {
                                    var aux = $('<div class="chbx"><span></span></div>').attr('id', id);
                                    $(input).before(aux);
                                }
                            } else {
                                var aux = $('<div class="chbx checked"><span></span></div>').attr('id', id);
                                $(input).before(aux);
                            }
                        }else if(totalInputSubChecked == 0) {
                            // no input checked
                            var aux = $('<div class="chbx"><span></span></div>').attr('id', id);
                            $(input).before(aux);
                        }else if(totalInputSubChecked < totalInputSub) {
                            var aux = $('<div class="chbx semi-checked"><span></span></div>').attr('id', id);
                            $(input).before(aux);
                        }
                    });

                    $('li.parent').prepend('<span style="width:6px;display:inline-block;" class="toggle">+</span>');
                    $('ul.sub').toggle();

                    $('span.toggle').click(function(){
                        $(this).parent().find('ul.sub').toggle();
                        if($(this).text()=='+'){
                            $(this).html('-');
                        } else {
                            $(this).html('+');
                        }
                    });

                    $("li input[name='sCategory[]']").change( function(){
                        var id = $(this).attr('id');
                        $(this).click();
                        $('#'+id+'_').click();
                    });

                    $('div.chbx').click( function() {
                        var isChecked       = $(this).hasClass('checked');
                        var isSemiChecked   = $(this).hasClass('semi-checked');

                        if(isChecked) {
                            $(this).removeClass('checked');
                            $(this).next('input').prop('checked', false);
                        } else if(isSemiChecked) {
                            $(this).removeClass('semi-checked');
                            $(this).next('input').prop('checked', false);
                        } else {
                            $(this).addClass('checked');
                            $(this).next('input').prop('checked', true);
                        }

                        // there are subcategories ?
                        if($(this).parent().find('ul.sub').size()>0) {
                            if(isChecked){
                                $(this).parent().find('ul.sub>li>div.chbx').removeClass('checked');
                                $(this).parent().find('ul.sub>li>input').prop('checked', false);
                            } else if(isSemiChecked){
                                // if semi-checked -> check-all
                                $(this).parent().find('ul.sub>li>div.chbx').removeClass('checked');
                                $(this).parent().find('ul.sub>li>input').prop('checked', false);
                                $(this).removeClass('semi-checked');
                            } else {
                                $(this).parent().find('ul.sub>li>div.chbx').addClass('checked');
                                $(this).parent().find('ul.sub>li>input').prop('checked', true);
                            }
                        } else {
                            // is subcategory checkbox or is category parent without subcategories
                            var parentLi = $(this).closest('li.parent');

                            // subcategory
                            if($(parentLi).find('ul.sub').size() > 0) {
                                var totalInputSub           = $(parentLi).find('ul.sub>li>input').size();
                                var totalInputSubChecked    = $(parentLi).find('ul.sub>li>input:checked').size();

                                var input    = $(parentLi).find('input.parent');
                                var divInput = $(parentLi).find('div.chbx').first();

                                $(input).prop('checked', false);
                                $(divInput).removeClass('checked');
                                $(divInput).removeClass('semi-checked');

                                if(totalInputSub == totalInputSubChecked) {
                                    $(divInput).addClass('checked');
                                    $(input).prop('checked', true);
                                }else if(totalInputSubChecked == 0) {
                                    // no input checked;
                                }else if(totalInputSubChecked < totalInputSub) {
                                    $(divInput).addClass('semi-checked');
                                }
                            } else {
                                // parent category
                            }
                        }
                    });
                });
            </script>
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php'); ?>
        <div id="content" class="container">
            <div class="col-md-9 nita">
                <div class="row list-group-item">
                    <div id="list_head">
                        <div class="inner">
 <h1><strong><?php echo search_title(); ?></strong></h1>
<div class="row">
						<div class="col-md-12 actions">
							<span class="counter-search"><b><?php
                $search_number = paris_search_number();
                printf(__('%1$d - %2$d of %3$d listings', 'paris'), $search_number['from'], $search_number['to'], $search_number['of']);
            ?></b></span>
							 <div class="btn-group btn-sm pull-right">
								<a title="Show As Galery" style="font-size: 1.5em;" class="btn btn-primary btn-sm " href="<?php echo osc_update_search_url(array('sShowAs'=> 'gallery')); ?>"><span class="fa fa-th" aria-hidden="true"></span></a>
<a title="Show As List" style="font-size: 1.5em;" class="btn btn-primary btn-sm " href="<?php echo osc_update_search_url(array('sShowAs'=> 'list')); ?>"><span class="fa fa-th-list" aria-hidden="true"></span></a>
								
							</div>




							<!--     START sort by       -->
							<div class="btn-group btn-sm pull-right">
															  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<?php _e('Sort by', 'paris'); ?><span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" role="menu">

<?php $i = 0; ?>
                                <?php $orders = osc_list_orders();
                                foreach($orders as $label => $params) {
                                    $orderType = ($params['iOrderType'] == 'asc') ? '0' : '1'; ?>
                                    <?php if(osc_search_order() == $params['sOrder'] && osc_search_order_type() == $orderType) { ?>
                                        <li><a class="current" href="<?php echo osc_esc_html(osc_update_search_url($params)); ?>"><?php echo $label; ?></a></li>
                                    <?php } else { ?>
                                       <li> <a href="<?php echo osc_esc_html(osc_update_search_url($params)); ?>"><?php echo $label; ?></a></li>
                                    <?php } ?>
                                    <?php if ($i != count($orders)-1) { ?>
                                        <span></span>
                                    <?php } ?>
                                    <?php $i++; ?>
                                <?php } ?>
								  									  										 
									  							  </ul>
							</div>
														<!--     END sort by       -->
									
							<div class="clear"></div>
						</div>
					
						<div class="clear"></div>
					</div>
                            
                        </div>
                    </div>
                    <?php if(osc_count_items() == 0) { ?>
                        <p class="empty" ><?php printf(__('There are no results matching "%s"', 'paris'), osc_search_pattern()); ?></p>
                    <?php } else { ?>
                        <?php osc_run_hook('search_ads_listing_top1'); ?>
                        <?php require(osc_search_show_as() == 'list' ? 'search_list.php' : 'search_gallery.php'); ?>
                        <div class="paginate" >
                        <?php echo osc_search_pagination(); ?>
                        </div>
                    <?php } ?>
                    <div class="clear"></div>
					<div id="related-searches">
                     <h5><?php _e('Other searches that may interest you','paris'); ?></h5>
                    <?php $footerLinks = osc_search_footer_links(); ?>
                    <ul class="footer-links">
                    <?php foreach($footerLinks as $f) { View::newInstance()->_exportVariableToView('footer_link', $f); ?>
                        <?php if($f['total'] < 3) continue; ?>
                        <li><a href="<?php echo osc_footer_link_url(); ?>"><?php echo osc_footer_link_title(); ?></a></li>
                    <?php } ?>
                    </ul>
					</div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="col-md-3 nita">
                <div style="padding:20px;" class="breadcrumb">
                    <form action="<?php echo osc_base_url(true); ?>" method="get" onsubmit="return doSearch()" class="nocsrf">
                        <input type="hidden" name="page" value="search" />
                        <input type="hidden" name="sOrder" value="<?php echo osc_esc_html(osc_search_order()); ?>" />
                        <input type="hidden" name="iOrderType" value="<?php $allowedTypesForSorting = Search::getAllowedTypesForSorting(); echo osc_esc_html($allowedTypesForSorting[osc_search_order_type()]); ?>" />
                        <?php foreach(osc_search_user() as $userId) { ?>
                            <input type="hidden" name="sUser[]" value="<?php echo osc_esc_html($userId); ?>" />
                        <?php } ?>
                        <fieldset class="box location">
                            
<div class="form-group">
								<label for="sCity"><?php _e('Your Search', 'paris'); ?></label>
								<input type="text" name="sPattern" class="form-control" id="query" value="<?php echo osc_esc_html( osc_search_pattern() ); ?>" />
							</div>
<div class="form-group">
								<label for="sCity"><?php _e('Categories', 'paris'); ?></label>
								<?php chosen_select_standard() ; ?>
							</div><div class="form-group">
								<label for="sCity"><?php _e('Region/City', 'paris'); ?></label>
								<?php chosen_region_select() ; ?>
							</div>
                                                         <div class="form-group">
								<label for="sCity"><?php _e('Locality', 'paris'); ?></label>
								<input type="text" class="form-control" id="sCity" name="sCity" value="<?php echo osc_esc_html( osc_search_city() ); ?>" />
                                <input type="hidden" id="sRegion" name="sRegion" value="" />
							</div>
                            
                        </fieldset>
<div class="form-group"> <?php if( osc_images_enabled_at_items() ) { ?>
								<label for="bPic">Show only</label><br>
								<div class="checkboxes">
                                <ul>
                                    <li>
                                        <input type="checkbox" name="bPic" id="withPicture" value="1" <?php echo (osc_search_has_pic() ? 'checked="checked"' : ''); ?> />
                                      <p id="withPicture" for="withPicture"><?php _e('Show only listings with pictures', 'paris'); ?></p>
                                    </li>
                                </ul>
                            </div>
                            <?php } ?>
							</div>

<div class="form-group price-slice"><?php if( osc_price_enabled_at_items() ) { ?>
								<label for="sCity"><?php _e('Price', 'paris'); ?></label>
								<div class="row">
									<div class="col-md-12">
                                
                                <div class="col-md-6"><?php _e('Min', 'paris'); ?>
                                <input type="text" class="form-control" name="sPriceMin" value="<?php echo osc_esc_html(osc_search_price_min()); ?>" size="6" maxlength="6" /></div>
                                <div class="col-md-6"><?php _e('Max', 'paris'); ?>
                                <input type="text" class="form-control" name="sPriceMax" value="<?php echo osc_esc_html(osc_search_price_max()); ?>" size="6" maxlength="6" /></div>
                            </div>
                            <?php } ?>
								</div>
								
							</div>
                        
                        <?php
                            if(osc_search_category_id()) {
                                osc_run_hook('search_form', osc_search_category_id());
                            } else {
                                osc_run_hook('search_form');
                            }
                        ?>
                        <button style="width:100%;" class="btn btn-success" type="submit"><?php _e('Apply', 'paris'); ?></button>
                    </form>
                    <?php osc_alert_form(); ?>
                </div>
<center class="ads-right"><?php echo osc_get_preference('sidebar-160x600', 'paris'); ?></center>
            </div>
            <script type="text/javascript">
                $(function() {
                    function log( message ) {
                        $( "<div/>" ).text( message ).prependTo( "#log" );
                        $( "#log" ).attr( "scrollTop", 0 );
                    }

                    $( "#sCity" ).autocomplete({
                        source: "<?php echo osc_base_url(true); ?>?page=ajax&action=location",
                        minLength: 2,
                        select: function( event, ui ) {
                            $("#sRegion").attr("value", ui.item.region);
                            log( ui.item ?
                                "<?php _e('Selected', 'paris'); ?>: " + ui.item.value + " aka " + ui.item.id :
                                "<?php _e('Nothing selected, input was', 'paris'); ?> " + this.value );
                        }
                    });
                });

                function checkEmptyCategories() {
                    var n = $("input[id*=cat]:checked").length;
                    if(n>0) {
                        return true;
                    } else {
                        return false;
                    }
                }
            </script>
          

        </div>
        <?php osc_current_web_theme_path('footer.php'); ?>
<script type="text/javascript">$(".flashmessage .ico-close").click(function(){$(this).parent().hide();});</script>
    </body>
</html>