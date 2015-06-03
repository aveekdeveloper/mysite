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
<div class="container item">
            <div id="item_head">
               
            </div>
            <div id="content" class="col-md-10">
<div class="row">
<div class="product-img-box col-md-5">

<?php if( osc_images_enabled_at_items() ) { ?>
                    <?php if( osc_count_item_resources() > 0 ) { ?>
                    <div class="panel" id="photos-product">


<div class="targetarea">
<img id="image1" alt="zoomable" title="" src="<?php echo osc_resource_url(); ?>"/>

</div>
<div class="ad-nav">
                                <div class="ad-thumbs">
                                    <ul class="ad-thumb-list">
<?php for ( $i = 0; osc_has_item_resources(); $i++ ) { ?>
<li>
<div class="image1 thumbs">
<a href="<?php echo osc_resource_url(); ?>" data-large="<?php echo osc_resource_url(); ?>"><img src="<?php echo osc_resource_thumbnail_url(); ?>" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>"/></a> 
</div>
</li>
<?php } ?>  </ul></div></div>
                       
                    </div>
<?php } else { ?>
                                <center class="panel" style="border:#ddd 1px solid;"><img src="<?php echo osc_current_web_theme_url('images/no_photo.gif') ; ?>" alt="" title=""/></center>
                    <?php } ?>

                <?php } ?>

</div>
<div class="product-des-box col-md-7">
<div class="product-name">
                    <h1><p><?php echo osc_item_title(); ?></p></h1>
                </div>
 <strong><?php echo osc_item_category(); ?></strong>

<div class="inner">
                    
                    <?php if(osc_is_web_user_logged_in() && osc_logged_user_id()==osc_item_user_id()) { ?>
                        <p id="edit_item_view">
                            <strong>
                                <a href="<?php echo osc_item_edit_url(); ?>" rel="nofollow"><?php _e('Edit item', 'paris'); ?></a>
                            </strong>
                        </p>
                    <?php } else { ?>
                        <p id="report-ads">
                          <!-- Single button -->
<!--<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <?php _e('Mark as', 'paris'); ?> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a id="item_spam" href="<?php echo osc_item_link_spam(); ?>" rel="nofollow"><?php _e('spam', 'paris'); ?></a></li>
    <li><a id="item_bad_category" href="<?php echo osc_item_link_bad_category(); ?>" rel="nofollow"><?php _e('misclassified', 'paris'); ?></a></li>
    <li> <a id="item_repeated" href="<?php echo osc_item_link_repeated(); ?>" rel="nofollow"><?php _e('duplicated', 'paris'); ?></a>
                                </li>
    <li><a id="item_expired" href="<?php echo osc_item_link_expired(); ?>" rel="nofollow"><?php _e('expired', 'paris'); ?></a>
                                </li>
    <li><a id="item_offensive" href="<?php echo osc_item_link_offensive(); ?>" rel="nofollow"><?php _e('offensive', 'paris'); ?></a></li>
  </ul>
</div>--><button style="margin-left:5px" class="btn"><a href="<?php echo osc_item_send_friend_url(); ?>" rel="nofollow"><i class="fa fa-user"></i> <?php _e('Send to a friend', 'paris'); ?></a></button>                           
                           
                        </p>
                    <?php }; ?>
                </div>

<div class="product-price">
                    <h2><?php if( osc_price_enabled_at_items() && osc_item_category_price_enabled() ) { ?><?php echo osc_item_formated_price(); ?><?php } ?></h2>
					<p><?php voting_item_detail(); ?></p>
<div class="add-to-box">
<!-- Small modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-shopping-cart"></i> <?php _e('Book Now', 'paris'); ?></button><?php osc_current_web_theme_path('common/'.osc_get_preference('wl-us', 'paris').'-watchlist.php') ; ?>
</div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div style="padding:10px" class="modal-content">


                    <p class="contact_button">
                        <?php if( !osc_item_is_expired () ) { ?>
                        <?php if( !( ( osc_logged_user_id() == osc_item_user_id() ) && osc_logged_user_id() != 0 ) ) { ?>
                            <?php     if(osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ) { ?>
                                <strong></strong>
                            <?php     } ?>
                        <?php     } ?>
                        <?php } ?>



<div id="contact">
                    <button type="button" class="btn btn-primary btn-lg btn-block"><strong><?php _e("Contact seller", 'paris'); ?></strong></button>

                    <?php if( osc_item_is_expired () ) { ?>
                        <p>
                            <?php _e("The listing is expired. You can't contact the publisher.", 'paris'); ?>
                        </p>
                    <?php } else if( ( osc_logged_user_id() == osc_item_user_id() ) && osc_logged_user_id() != 0 ) { ?>
                        <p>
                            <?php _e("It's your own listing, you can't contact the publisher.", 'paris'); ?>
                        </p>
                    <?php } else if( osc_reg_user_can_contact() && !osc_is_web_user_logged_in() ) { ?>
                        <p>
                            <?php _e("You must log in or register a new account in order to contact the advertiser", 'paris'); ?>
                        </p>
                        <p class="contact_button">
                            <button type="button" class="btn btn-default btn-lg btn-block"><strong><a href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', 'paris'); ?></a></strong></button>
                            <button type="button" class="btn btn-default btn-lg btn-block"><strong><a href="<?php echo osc_register_account_url(); ?>"><?php _e('Register for a free account', 'paris'); ?></a></strong></button>
                        </p>
                  <br></br>
                    <?php } else { ?>
                        <?php if( osc_item_user_id() != null ) { ?>
                                
<button type="button" class="btn btn-default btn-lg btn-block">
                            <strong><p class="name"><?php _e('Name', 'paris') ?>: <a href="<?php echo osc_user_public_profile_url( osc_item_user_id() ); ?>" ><?php echo osc_item_contact_name(); ?></a></p></strong></button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-default btn-lg btn-block"><strong><p class="name"><?php _e('Name', 'paris') ?>: <?php echo osc_item_contact_name(); ?></p></strong></button>
                        <?php } ?>
                        <?php if( osc_item_show_email() ) { ?>
                            <button type="button" class="btn btn-default btn-lg btn-block"><strong><p class="email"><?php _e('E-mail', 'paris'); ?>: <?php echo osc_item_contact_email(); ?></p></strong></button>
                        <?php } ?>
                        
<?php if ( osc_user_phone() != '' ) { ?>
                           <button type="button" class="btn btn-default btn-lg btn-block"><strong> <p class="phone"><?php _e("Phone", 'paris'); ?>: <?php echo osc_user_phone(); ?></p></strong></button>
                        <?php } ?>

<?php if ( osc_user_address() != '' ) { ?>
                           <button type="button" class="btn btn-default btn-lg btn-block"><strong> <p class="address"><?php _e("Address", 'paris'); ?>: <?php echo osc_user_address(); ?></p></strong></button>
                        <?php } ?>

<?php if ( osc_user_city() != '' ) { ?>
                           <button type="button" class="btn btn-default btn-lg btn-block"><strong> <p class="city"><?php _e("City", 'paris'); ?>: <?php echo osc_user_city(); ?></p></strong></button>
                        <?php } ?>

<?php if ( osc_user_region() != '' ) { ?>
                           <button type="button" class="btn btn-default btn-lg btn-block"><strong> <p class="region"><?php _e("Region", 'paris'); ?>: <?php echo osc_user_region(); ?></p></strong></button>
                        <?php } ?>




                        <ul id="error_list"></ul>
                        <?php ContactForm::js_validation(); ?>


                    <?php } ?>
</form>
</div>


      
    </div>
  </div>
</div>


<ul id="item_location">
<?php if ( osc_item_address() != "" ) { ?><li><?php _e("Address", 'paris'); ?>: <strong><?php echo osc_item_address(); ?></strong> <?php } ?>
<?php if ( osc_item_city_area() != "" ) { ?><?php /*_e("City area", 'paris');*/ ?>, <strong><?php echo osc_item_city_area(); ?></strong> <?php } ?>
<?php if ( osc_item_city() != "" ) { ?><?php /*_e("City", 'paris');*/ ?>, <strong><?php echo osc_item_city(); ?></strong> <?php } ?>
<?php if ( osc_item_region() != "" ) { ?><?php /*_e("Region", 'paris');*/ ?>, <strong><?php echo osc_item_region(); ?></strong> <?php } ?>
                    <?php if ( osc_item_country() != "" ) { ?><?php /*_e("Country", 'paris');*/ ?>, <strong><?php echo osc_item_country(); ?></strong></li> <?php } ?>        
</ul>

<div id="type_dates">
                   
</div>

<div class="share ulfa"><!-- AddThis Button BEGIN -->
          <div class="addthis_default_style"><a class="addthis_button_compact at300m" href="#"><span class="at4-icon aticon-compact" style="background-color: rgb(252, 109, 76);"><span class="at_a11y">More Sharing Services</span></span>Share</a> <a class="addthis_button_email at300b" target="_blank" title="Email" href="#" tabindex="1000"><span class="at4-icon aticon-email" style="background-color: rgb(115, 138, 141);"><span class="at_a11y">Share on email</span></span></a><a class="addthis_button_print at300b" title="Print" href="#"><span class="at4-icon aticon-print" style="background-color: rgb(115, 138, 141);"><span class="at_a11y">Share on print</span></span></a> <a class="addthis_button_facebook at300b" title="Facebook" href="#"><span class="at4-icon aticon-facebook" style="background-color: rgb(48, 88, 145);"><span class="at_a11y">Share on facebook</span></span></a> <a class="addthis_button_twitter at300b" title="Tweet" href="#"><span class="at4-icon aticon-twitter" style="background-color: rgb(44, 168, 210);"><span class="at_a11y">Share on twitter</span></span></a></div>
          <script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js"></script> 
          <!-- AddThis Button END --> 
        </div>

                </div>

</div>
</div>
<div class="row">
<div class="product-info-box col-md-12">
<div class="bs-docs-example">
    <ul id="myTab" class="nav nav-tabs">
      <li class="active"><a href="#detail" data-toggle="tab"><?php _e('Description', 'paris'); ?></a></li>
      <li><a href="#profile" data-toggle="tab"><?php _e('Additional', 'paris'); ?></a></li>
 <!--<li><a href="#more" data-toggle="tab"><?php _e('Contact seller', 'paris'); ?></a></li>-->
 <li><a href="#review" data-toggle="tab"><?php _e('Reviews', 'paris'); ?></a></li>

 <!--<li><a href="#warning" data-toggle="tab"><?php _e('Warning', 'paris'); ?></a></li>-->

     
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="panel tab-pane fade in active" id="detail">
         <p><?php echo osc_item_description(); ?></p>
              <?php osc_run_hook('item_detail', osc_item() ); ?>
      </div>
      <div class="tab-pane fade panel" id="profile">
       <strong><?php _e('More information', 'paris'); ?></strong>
        <div id="custom_fields">
                        <?php if( osc_count_item_meta() >= 1 ) { ?>
                            <div class="meta_list">
                                <?php while ( osc_has_item_meta() ) { ?>
                                    <?php if(osc_item_meta_value()!='') { ?>
                                        <div class="meta">
                                            <strong><?php echo osc_item_meta_name(); ?>:</strong> <?php echo osc_item_meta_value(); ?>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
      </div>
      


<div class="tab-pane fade panel" id="more">
         
        <?php osc_run_hook('item_detail', osc_item() ); ?>
                    <p class="contact_button">
                        <?php if( !osc_item_is_expired () ) { ?>
                        <?php if( !( ( osc_logged_user_id() == osc_item_user_id() ) && osc_logged_user_id() != 0 ) ) { ?>
                            <?php     if(osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ) { ?>
                                <strong></strong>
                            <?php     } ?>
                        <?php     } ?>
                        <?php } ?>



<div id="contact">
                     <button type="button" class="btn btn-primary btn-lg btn-block"><strong><?php _e("Contact seller", 'paris'); ?></strong></button>
                    <?php if( osc_item_is_expired () ) { ?>
                        <p>
                            <?php _e("The listing is expired. You can't contact the publisher.", 'paris'); ?>
                        </p>
                    <?php } else if( ( osc_logged_user_id() == osc_item_user_id() ) && osc_logged_user_id() != 0 ) { ?>
                        <p>
                            <?php _e("It's your own listing, you can't contact the publisher.", 'paris'); ?>
                        </p>
                    <?php } else if( osc_reg_user_can_contact() && !osc_is_web_user_logged_in() ) { ?>
                        <p>
                            <?php _e("You must log in or register a new account in order to contact the advertiser", 'paris'); ?>
                        </p>
                        <p class="contact_button">
                            <strong><a href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', 'paris'); ?></a></strong>
                            <strong><a href="<?php echo osc_register_account_url(); ?>"><?php _e('Register for a free account', 'paris'); ?></a></strong>
                        </p>
                  <br></br>
                    <?php } else { ?>
                        <?php if( osc_item_user_id() != null ) { ?>
                            <button type="button" class="btn btn-default btn-lg btn-block">
                            <strong><p class="name"><?php _e('Name', 'paris') ?>: <a href="<?php echo osc_user_public_profile_url( osc_item_user_id() ); ?>" ><?php echo osc_item_contact_name(); ?></a></p></strong></button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-default btn-lg btn-block"><strong><p class="name"><?php _e('Name', 'paris') ?>: <?php echo osc_item_contact_name(); ?></p></strong></button>
                        <?php } ?>
                        <?php if( osc_item_show_email() ) { ?>
                            <button type="button" class="btn btn-default btn-lg btn-block"><strong><p class="email"><?php _e('E-mail', 'paris'); ?>: <?php echo osc_item_contact_email(); ?></p></strong></button>
                        <?php } ?>
                        
<?php if ( osc_user_phone() != '' ) { ?>
                           <button type="button" class="btn btn-default btn-lg btn-block"><strong> <p class="phone"><?php _e("Phone", 'paris'); ?>: <?php echo osc_user_phone(); ?></p></strong></button>
                        <?php } ?>

<?php if ( osc_user_address() != '' ) { ?>
                           <button type="button" class="btn btn-default btn-lg btn-block"><strong> <p class="address"><?php _e("Address", 'paris'); ?>: <?php echo osc_user_address(); ?></p></strong></button>
                        <?php } ?>

<?php if ( osc_user_city() != '' ) { ?>
                           <button type="button" class="btn btn-default btn-lg btn-block"><strong> <p class="city"><?php _e("City", 'paris'); ?>: <?php echo osc_user_city(); ?></p></strong></button>
                        <?php } ?>

<?php if ( osc_user_region() != '' ) { ?>
                           <button type="button" class="btn btn-default btn-lg btn-block"><strong> <p class="region"><?php _e("Region", 'paris'); ?>: <?php echo osc_user_region(); ?></p></strong></button>
                        <?php } ?>

 <button type="button" class="btn btn-primary btn-lg btn-block"><strong> <p class="region"><?php _e("Send Mail", 'paris'); ?></p></strong></button>

                        <ul id="error_list"></ul>
                        <?php ContactForm::js_validation(); ?>

<div class="row">
<div class="col-md-12">
<form <?php if( osc_item_attachment() ) { ?>enctype="multipart/form-data"<?php } ?> action="<?php echo osc_base_url(true); ?>" method="post" name="contact_form" id="contact_form" class="well col-md-12">
<?php osc_prepare_user_info(); ?>
                            <fieldset>
  <div class="row">
		<div class="col-md-5">
			<div class="form-group"><label><?php _e('Your name', 'paris'); ?></label>
<?php ContactForm::your_name(); ?></div>
			
			<div class="form-group"><label><?php _e('Your e-mail address', 'paris'); ?></label>
                         <?php ContactForm::your_email(); ?></div>
			
			<div class="form-group"><label><?php _e('Phone number', 'paris'); ?></label>
                         <?php ContactForm::your_phone_number(); ?>
			
		</div></div>
		<div class="col-md-7">
<?php if( osc_item_attachment() ) { ?>
                                <label for="contact-attachment"><?php _e('Attachments', 'twitter') ; ?></label><?php ContactForm::your_attachment() ; ?>
                                <?php } ?>
                                <?php osc_run_hook('item_contact_form', osc_item_id()); ?>
			<div class="form-group"><label><?php _e('Message', 'paris'); ?></label>
			              
                        <?php ContactForm::your_message(); ?></div>
                                <input type="hidden" name="action" value="contact_post" />
                                <input type="hidden" name="page" value="item" />
                                <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                                <?php if( osc_recaptcha_public_key() ) { ?>
                                <script type="text/javascript">
                                    var RecaptchaOptions = {
                                        theme : 'custom',
                                        custom_theme_widget: 'recaptcha_widget'
                                    };
                                </script>
                                <style type="text/css"> div#recaptcha_widget, div#recaptcha_image > img { width:280px; } </style>
                                <div id="recaptcha_widget">
                                    <div id="recaptcha_image"><img /></div>
                                    <span class="recaptcha_only_if_image"><?php _e('Enter the words above','paris'); ?>:</span>
                                    <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
                                    <div><a href="javascript:Recaptcha.showhelp()"><?php _e('Help', 'paris'); ?></a></div>
                                </div>
                                <?php } ?>
                                <?php osc_show_recaptcha(); ?>

		</div>
	<div class="col-md-12">
		<button type="submit" class="btn btn-primary pull-left"><?php _e('Send', 'paris'); ?></button></div>
	</div>
</fieldset>
                        </form>

</div>
</div> 
                    <?php } ?>
             
                </div>
 </div>




      <div class="tab-pane fade panel" id="review">
        

<?php if( osc_comments_enabled() ) { ?>
                    <div id="comments">
                        <strong><?php _e('Ratings and reviews', 'paris'); ?></strong>
						<?php voting_item_detail(); ?>
                        <ul id="comment_error_list"></ul>
                        <?php CommentForm::js_validation(); ?>
                        <?php if( osc_count_item_comments() >= 1 ) { ?>
                            <div class="comments_list">
                                <?php while ( osc_has_item_comments() ) { ?>
                                    <div class="comment">
                                        <h3><strong><?php echo osc_comment_title(); ?></strong> <em><?php _e("by", 'paris'); ?> <?php echo osc_comment_author_name(); ?>:</em></h3>
                                        <p><?php echo nl2br( osc_comment_body() ); ?> </p>
                                        <?php if ( osc_comment_user_id() && (osc_comment_user_id() == osc_logged_user_id()) ) { ?>
                                        <p>
                                            <a rel="nofollow" href="<?php echo osc_delete_comment_url(); ?>" title="<?php _e('Delete your comment', 'paris'); ?>"><?php _e('Delete', 'paris'); ?></a>
                                        </p>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <div class="paginate" style="text-align: right;">
                                    <?php echo osc_comments_pagination(); ?>
                                </div>
                            </div>
                        <?php } ?>
						<?php if( osc_reg_user_post_comments () && osc_is_web_user_logged_in() || !osc_reg_user_post_comments() ) { ?>
                        <form action="<?php echo osc_base_url(true); ?>" method="post" name="comment_form" id="comment_form">
                            <fieldset>
                                <strong><?php _e('Leave your comment', 'paris'); ?></strong><br></br>
                                <input type="hidden" name="action" value="add_comment" />
                                <input type="hidden" name="page" value="item" />
                                <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                                <?php if(osc_is_web_user_logged_in()) { ?>
                                    <input type="hidden" name="authorName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
                                    <input type="hidden" name="authorEmail" value="<?php echo osc_logged_user_email();?>" />
                                <?php } else { ?>
                                    <label for="authorName"><?php _e('Your name', 'paris'); ?>:</label><br> <?php CommentForm::author_input_text(); ?></br />
                                    <label for="authorEmail"><?php _e('Your e-mail', 'paris'); ?>:</label><br> <?php CommentForm::email_input_text(); ?></br />
                                <?php }; ?>
                                <label for="title"><?php _e('Title', 'paris'); ?>:</label><br><?php CommentForm::title_input_text(); ?><br />
                                <label for="body"><?php _e('Comment', 'paris'); ?>:</label><br><?php CommentForm::body_input_textarea(); ?><br />
                                <button style="margin-top:15px;" class="btn btn-success" type="submit"><?php _e('Send', 'paris'); ?></button>
                            </fieldset>
                        </form>
                    
                    <?php } ?>
</div>
                <?php } ?>
</div>

<!--
 <div class="tab-pane fade panel" id="warning">
<div id="useful_info">
                    <strong><?php //_e('Useful information', 'paris'); ?></strong>
                    <ul>
                        <li><?php //_e('Avoid scams by acting locally or paying with PayPal', 'paris'); ?></li>
                        <li><?php //_e('Never pay with Western Union, Moneygram or other anonymous payment services', 'paris'); ?></li>
                        <li><?php //_e('Don\'t buy or sell outside of your country. Don\'t accept cashier cheques from outside your country', 'paris'); ?></li>
                        <li><?php //_e('This site is never involved in any transaction, and does not handle payments, shipping, guarantee transactions, provide escrow services, or offer "buyer protection" or "seller certification"', 'paris'); ?></li>
                    </ul>
                </div>
</div>
=======
</div>-->


</div>
</div>
</div>
</div>

<div class="panel" id="descript"> <style>.related_ads table td.photo img {
width: 100px;}.related_ads table td.text {
width: 100%;
}</style>
                        <?php if (function_exists('related_ads_start')) {related_ads_start();} ?> 
                    </p>
                    <?php osc_run_hook('location'); ?>
                </div>
                <!-- plugins -->
                
                
                <?php osc_current_web_theme_path('popular1.php'); ?>
                
            </div>
            <div id="sidebar" class="col-md-2">
                <center class="ads-right"><?php echo osc_get_preference('sidebar-160x600', 'paris'); ?></center>
                
                
            </div>
        </div>
        <?php osc_current_web_theme_path('footer.php'); ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script src="<?php echo osc_current_web_theme_js_url('multizoom.js') ; ?>"></script> 
<script type="text/javascript">
$('#myTab a').click(function (e) {
    if($(this).parent('li').hasClass('active')){
        $( $(this).attr('href') ).hide();
    }
    else {
        e.preventDefault();
        $(this).tab('show');
    }
});

$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
  });

</script>
<script type="text/javascript">

jQuery(document).ready(function($){

	$('#image1').addimagezoom({ // single image zoom
		zoomrange: [0, 0],
		magnifiersize: [0,0],
		//magnifierpos: 'right',
		cursorshade: true,
		largeimage: 'hayden.jpg' //<-- No comma after last option!
	})


	$('#image2').addimagezoom() // single image zoom with default options
	
})

</script>