<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jason
 * Date: 12/2/12
 * Time: 9:03 AM
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



        echo '<h2 class="postTitle">' . $page_content->page_headline . '</h2>';

        echo '';

        ?>

        <section class="entry">


            <div class="demo">
                <div id="tabs">

                    <ul>
                        <li><a href="#tabs-1">About Us</a></li>
                        <li><a href="#tabs-2">Warranty</a></li>
                        <li><a href="#tabs-3">Contact Us</a></li>

                    </ul>

                    <div id="tabs-1">
                        <h1>About Permian Homes</h1>
                       <?php echo $page_content->page_content ?>
                    </div>
                    <div id="tabs-2">
                        <h1>The Permian Homes Warranty</h1>
                        <p>At Permian Homes,  we realize that with new home construction there will be items that naturally occur and require minor adjustments and corrections. In the event that you should experience these occurrences, an extensive warranty is provided for each home. This warranty consists of a one-year limited warranty on all components of your home, a two-year limited warranty on the Plumbing, HVAC, and Electrical systems of your home, and a ten-year warranty covering the structural components in your home.</p>
                        <p>In addition to this warranty package, we provide you with the Permian Homes Customer Care Manual. This manual contains information on specific components of your home, the occurrences that Permian will warrant, and supplemental details on maintenance and homeowner responsibility.</p>

                    </div>
                    <div id="tabs-3">
                        <h1>Contact Us</h1>

                        <h3>Use Our Easy Form</h3>
                        <?php echo validation_errors(); ?>
                        <?=form_open('/site/newcontact', 'class=nice');?>
                        <?=form_fieldset('');?>
                        <?=form_input('firstname', '', 'class="input-text" placeholder="First Name"'); ?>
                        <?=form_input('lastname', '', 'class="input-text" placeholder="Last Name"'); ?>
                        <?=form_input('email', '', 'class="input-text" placeholder="Email Address"'); ?>
                        <?=form_input('street', '', 'class="input-text" placeholder="Street Address"'); ?>
                        <?=form_input('city', '', 'class="input-text" placeholder="City"'); ?>
                        <?=form_input('state', '', 'class="input-text" placeholder="State"'); ?>
                        <?=form_input('zip', '', 'class="input-text" placeholder="Zip"'); ?>
                        <?=form_input('telephone', '', 'class="input-text" placeholder="Telephone"'); ?>
                        <?=form_textarea('message', '', 'placeholder="Services Requested..."'); ?>
                        <?=form_submit('mysubmit','Submit','class="blue button radius"');?>
                        <?=form_fieldset_close();?>
                        <?=form_close();?>


                    </div>


                </div>
            </div>



        </section>

    </div> <!--begin: entryWrapper-->



</div>  <!--end: insideRightContent-->

</div> <!-- end: insideContentWrapper -->

</div> <!-- end: wrapper -->


