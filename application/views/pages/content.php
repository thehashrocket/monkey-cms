
<div id="insideContentWrapper" class="clearFix"> <!-- begin: insideContentWrapper -->


    <div id="leftSidebar"> <!-- begin: leftSidebar -->

        <?php $this->load->view($sidebar); ?>

    </div>  <!-- end: leftSidebar -->

<div id="insideRightContent"> <!--begin: insideRightContent-->

	<div class="entryWrapper" id="post-1"> <!--begin: entryWrapper-->

		<?php



		echo '<h2 class="postTitle">' . $page_content->page_headline . '</h2>';

		echo '<section class="entry">' . $page_content->page_content . '</section>';

		?>

	</div> <!--begin: entryWrapper-->

</div>  <!--end: insideRightContent-->

</div> <!-- end: insideContentWrapper -->

</div> <!-- end: wrapper -->


