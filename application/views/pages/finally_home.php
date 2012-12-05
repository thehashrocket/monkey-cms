<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jason
 * Date: 11/17/12
 * Time: 9:50 AM
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
                            <li><a href="#tabs-1">Cox Family</a></li>
                            <li><a href="#tabs-2">The Cox Family Home</a></li>
                            <li><a href="#tabs-3">The Sponsors</a></li>
                            <li><a href="#tabs-4">Donate</a></li>

                            <li><a href="#tabs-7">Events</a> </li>
                        </ul>

                        <div id="tabs-1">
                            <h1>The Cox Family</h1>
                            <p><a href="/assets/pdfs/Permian_Homes_Trifold_Updated.pdf">Download a Brochure</a> </p>
                            <img width="500px" src="/assets/images/site-images/parade_of_homes_ad_finished_ezr.jpg">
                        </div>
                        <div id="tabs-2">
                            <h1>The Cox Family Mortgage Free Home
                                "The Fabiana"</h1>
                            <img src="/assets/images/site-images/FabianaB_ezr.jpg">
                            <p>This beautiful 2780 square foot home is designed to give SGT Cox freedom to move around. With a family oriented open floor plan, this 4 bedroom 3 bath home is a product of builder associates, developers, individual contributors and volunteers in and around the Permian Basin to make a Mortgage free home for SGT Cox and his family!</p>
                            <img width="500px" src="/assets/images/site-images/FabianaBfloorb.jpg">
                        </div>
                        <div id="tabs-3">
                            <h1>The Cox Mortgage Free Home Sponsors</h1>
                            <img src="/assets/images/site-images/pbhba.jpg">
                            <img src="/assets/images/site-images/fox24.jpg">
                            <img src="/assets/images/site-images/mccoys_.jpg">
                        </div>
                        <div id="tabs-4">
                            <h1>Donate</h1>
                            <p align="center"><strong>Please help support </strong><strong>the Cox Family<br>
                                by donating to<br>
                                Operation Finally Home</strong></p>
                            <p align="center">Please make check donations to:</p>
                            <p align="center">Operation Finally Home<br>
                                PO Box 12025<br>
                                Odessa, TX 79765</p>
                            <p align="center">Please ensure checks have “The Cox Family” in the memo.</p>
                            <p align="center"><a target="_blank" href="http://operationfinallyhome.org/index.php?id=6"><strong>Credit Card donations can be taken here</strong></a></p>
                            <p align="center">Please ensure CC payments have<br>
                                “The Cox Family” under the Comments Section.</p>
                        </div>

                        <div id="tabs-7">
                            <h1>Events</h1>
                            <p><a href="/assets/pdfs/Permian_Homes_5K_Flyer.pdf">Click here for More Information on the 5K and 1K Run</a></p>
                        </div>

                    </div>
                </div>



            </section>

        </div> <!--begin: entryWrapper-->



    </div>  <!--end: insideRightContent-->

</div> <!-- end: insideContentWrapper -->

</div> <!-- end: wrapper -->


