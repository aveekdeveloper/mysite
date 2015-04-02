<?php osc_current_web_theme_path('header.php') ; ?>

<div class="content-item">
            <div id="item-head">
                <h1 itemprop="itemreviewed"><?php echo osc_item_title().", ". osc_item_city().", ". osc_item_region();?></h1>
                <div id="type_dates">
                    <strong><?php echo osc_item_category() ; ?></strong>
                </div>
            </div>
</div>
<?php
osc_register_script('jquerydate',"//code.jquery.com/ui/1.11.4/jquery-ui.js" , 'jquery');
osc_enqueue_script('jquerydate');
?>

<?php require_once('checkout.php');?>
<?php require_once('booking_slots.php'); ?>


<script>
  $(function() {
    $( "#new_slot_date" ).datepicker({
		dateFormat: "dd-mm-yy" , 
		onSelect: function(dateStr) 
			{
				alert($(this).val());
			}
		} )
		
  });
  </script>