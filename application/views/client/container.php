<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->



<head>

    <?php
    $this->load->view('/client/meta');
    ?>

</head>


<body>
<?php
		  $this->load->view('/client/header');
		  $this->load->view($page);
		  $this->load->view('/client/footer');
?>


<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>


<script src="<?php echo base_url();?>assets/js/jquery.cycle.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.cookie.js"></script>
<script src="<?php echo base_url();?>assets/js/superfish-min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.tablesorter.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.tablesorter.pager.js"></script>
<script src="<?php echo base_url();?>assets/js/admin.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="/assets/js/gmap3.js"></script>



<script type="text/javascript">
	$(function() {
		$('#s1').cycle({ 
			fx:    'fade', 
			delay: 2000,
			timeout: 4000
		});
		$("table#locations").tablesorter();
	});
	</script>
</body>



</html>