<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->



<head>

    <?php
    $this->load->view('meta');
    ?>

</head>


<body>
<?php
		  $this->load->view('header');
		  $this->load->view($page);
		  $this->load->view('footer');
?>
<script type="text/javascript">
	$(function() {
		$('#s1').cycle({ 
			fx:    'fade', 
			delay: 2000,
			timeout: 4000
		});
	});
	</script>
</body>



</html>