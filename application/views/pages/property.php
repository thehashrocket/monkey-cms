
<div id="insideContentWrapper" class="clearFix"> <!-- begin: insideContentWrapper -->


    <div id="leftSidebar"> <!-- begin: leftSidebar -->

        <?php $this->load->view($sidebar); ?>

    </div>  <!-- end: leftSidebar -->

<div id="insideRightContent"> <!--begin: insideRightContent-->

	

    <?php
      if ((isset($location)) && (count($location) >= 1)) {
            foreach ($location->result() as $row) {

          ?>
              <div class="entryWrapper" id="post-1"> <!--begin: entryWrapper-->
                  <h2 class="postTitle"><?php echo $row->location_name; ?></h2>
<p class="postInfo">
              <!-- <span class="postInfoAuthor">Author Name</span> -->
                <span class="postInfoDate"><?php echo $row->created; ?></span>
                    
                </p>
                  <div class="image">
                      <img width="566px" height="258px;"  src="<?php echo $row->fullsize; ?>">
                  </div>

                  
                <p class="unitAndPrice">
                  <span class="unitInfo"><?php echo $row->bedrooms; ?> Bed, <?php echo $row->bathrooms; ?> Bath, <?php echo $row->square_feet; ?> Sq Ft</span>
                  <span class="unitPrice"><strong>Price : </strong>$<?php echo $row->rent_price; ?> / Month</span>
                </p>
                <div class="entry"><!--begin: entry-->
                  
                  <p><?php echo $row->description; ?></p>
                </div>
              </div> 
              <?php 
              
            }
          } else {
            echo '<h2 class="postTitle">There Are No Properties To Show</h2>';
          }
     ?>


</div>  <!--end: insideRightContent-->

</div> <!-- end: insideContentWrapper -->

</div> <!-- end: wrapper -->


