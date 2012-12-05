<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jason
 * Date: 12/2/12
 * Time: 10:45 AM
 * To change this template use File | Settings | File Templates.
 */
?>


<div id="insideContentWrapper" class="clearFix"> <!-- begin: insideContentWrapper -->


    <div id="leftSidebar"> <!-- begin: leftSidebar -->

        <?php $this->load->view($sidebar); ?>

    </div>  <!-- end: leftSidebar -->

    <div id="insideRightContent"> <!--begin: insideRightContent-->

        <div class="entryWrapper" id="post-1"> <!--begin: entryWrapper-->

            <?php



            echo '<h2 class="postTitle">Thank You!</h2>';

            echo '<section class="entry">
            <p>Thank you for contacting us!</p>
            <p>Someone will be returning your message soon!</p>
		</section>';

            ?>

        </div> <!--begin: entryWrapper-->

    </div>  <!--end: insideRightContent-->

</div> <!-- end: insideContentWrapper -->

</div> <!-- end: wrapper -->


