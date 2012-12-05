<div id="subHeader" class="clearFix"> <!-- begin: subheader -->

	<div id="bannerLeftWrapper">  <!-- begin: bannerLeftWrapper -->
		<h2><a href="#">Welcome to Permian Homes</a></h2>
		<p><strong>Permian Homes</strong> is excited to be a part of providing the Cox Family with a custom&nbsp;mortgage free home right here in Odessa! </p>
		<div id="subBannerLeft">
			<h2><a href="#">The Advantage</a></h2>
			<p><strong>Permian Homes</strong> is dedicated to offering quality homes and lasting value for our customers. Our philosophy is simple: <em><u>We focus on each customer to build one dream at a time.</u></em></p>
		</div>
	</div>   <!-- end: bannerLeftWrapper -->

	<div id="featureHolder"> <!-- begin: featureHolder -->

		<div id="featureMask">
			<div id="featureSlide">

				<?php

				function cutString($str, $length = 130) {
 
				        // if string is same length or shorter then send it back
				        if (strlen($str) <= $length) {
				            return $str;
				        }
				 
				        // cut the string
				        $str = substr($str, 0, $length);
				 
				        // make sure it isn't in the middle of a word
				        $str = explode(' ', $str);
				        array_pop($str);
				 
				        return implode(' ', $str) . '...';
				    }

					if ((isset($locations)) && (count($locations) >= 1)) {
						foreach ($locations->result() as $row) {

							if($row->featured == '1') { ?>

							<div>
								<img width="566px" height="258px;" src="<?php echo $row->thumb; ?>" alt="" />
								<div class="imageExcerpt">
									<h2><a href="/pages/index/1/18/<?php echo $row->idlocation; ?>"><?php echo $row->location_street; ?></a></h2>
									<?php echo cutString($row->description); ?>
								</div>
							</div>

							<?php }
							
						}
					}
				?>

			</div>
		</div>

		<div id="featureNav" class="clearFix">
			<ul id="featNumHolder">

				<?php
				

					if ((isset($locations)) && (count($locations) >= 1)) {
						$count = 1;
						foreach ($locations->result() as $row) {

							if($row->featured == '1') { ?>

							<li>
								<span class="jFlowControl"><?php echo $count; ?></span>
							</li>

							<?php $count++; }
							
						}
					}
				?>
			</ul>
			<div id="featButtonHolder">
				<span class="previous">Previous</span>
				<span class="next">Next</span>
			</div>
		</div>

	</div> <!-- end: featureHolder -->

</div>
<!-- end: subheader -->

<div id="homeContentWrapper" class="clearFix"> <!-- begin: homeContentWrapper -->

	<div id="homeContentLeft" class="clearFix"> <!-- begin: homeContentLeft -->

		<div id="postColumnLeft"> <!-- begin: postColumnLeft -->

			<?php
					if ((isset($locations)) && (count($locations) >= 1)) {
						foreach ($locations->result() as $row) {

							if($row->featured != '1') { ?>

							<div class="homePostContainer" >
								<h3><a href="/pages/index/1/18/<?php echo $row->idlocation; ?>"><?php echo $row->location_street; ?></a></h3>
								<p class="postInfo">
									<span class="postInfoDate"><?php echo $row->created; ?></span>
									<span class="postInfoComment">8</span>
								</p>
								<div class="postThumb">
									<a href="/pages/index/1/18/<?php echo $row->idlocation; ?>"><img width="208px" height="101px;" src="<?php echo $row->thumb; ?>" alt="" class="imgPostThumb" /></a>
									<?php
										if ($row->reduced == '1') {
											echo '<img class="ribbon" alt="" src="/assets/images/theme/ribbon-reduced.png"/>';
										}

										if ($row->rented == '1') {
											echo '<img class="ribbon" alt="" src="/assets/images/theme/ribbon-rented.png"/>';
										}

										if ($row->sold == '1') {
											echo '<img class="ribbon" alt="" src="/assets/images/theme/ribbon-sold.png"/>';
										}


									 ?>
								</div>
								<p class="unitAndPrice">
									<span class="unitInfo"><?php echo $row->bedrooms; ?> Bed, <?php echo $row->bathrooms; ?> Bath, <?php echo $row->square_feet; ?> Sq Ft</span>
									<span class="unitPrice"><strong>Price : </strong>$<?php echo $row->rent_price; ?> / Month</span>
								</p>
								<p><?php echo cutString($row->description); ?></p>
							</div>

							<?php }
							
						}
					}
				?>



			<p class="viewAllHolder"><a href="/pages/index/1/17/"><span>View All</span></a></p>

		</div> <!-- end: postColumnLeft -->

	</div> <!-- end: homeContentLeft -->

	<div id="homeContentRight"> <!-- begin: homeContentRight -->

		<div id="homeSearchSection">
			<gcse:searchbox-only></gcse:searchbox-only>
		</div>

		<div id="homeTabs"> <!-- begin: homeTabs -->

			<ul class="clearFix">
				<li>
					<a href="#firstTab"><span>Renaissance Estates</span></a>
				</li>
				<li>
					<a href="#secondTab"><span>Heritage Oaks</span></a>
				</li>
				<li>
					<a href="#thirdTab"><span>Castle Ridge</span></a>
				</li>
			</ul>

			<div id="firstTab">
				<div class="containerTab">
					<ul>
						<li>
							<h3><a href="#">Welcome to Renaissance Estates - A Place to Grow </a></h3>
							
							<div class="entry">
								<p>Renaissance Estates, by Permian Homes, is a planned community nestled near Mission Golf Course and Odessa Country Club.  This attractive community offers many included upgrades, large spacious lots, and lavish amenities!  These beautiful homes offer large lots and plenty of space for room to grow!</p>
							</div>
							<!-- <p class="readMoreHolder">
								<a href="#"><span>Read More</span></a>
							</p> -->
						</li>
						<!-- <li>
							<h3><a href="#">Sample Title (Tab 1)</a></h3>
							<p class="postInfo">
								<span class="postInfoDate">August 3rd, 2009</span>
								<span class="postInfoComment">8</span>
							</p>
							<div class="entry">
								<p>Twin Falls 78826 DC Maecenas lobortis diam et ipsum egestas euismod. Proin tincidunt tempus odio, at rhoncus purus bibendum vel. Mauris ...</p>
							</div>
							<p class="readMoreHolder">
								<a href="#"><span>Read More</span></a>
							</p>
						</li> -->
					</ul>
				</div>
			</div>

			<div id="secondTab">
				<div class="containerTab">
					<ul>
						<li>
							<h3><a href="#">Welcome to Heritage Oaks - A Place to Grow</a></h3>

							<div class="entry">
								<p>Single Family Homes from the low $200’s. Explore this luxurious community located on the upscale part of Andrews.  These beautiful custom homes offer many upgrades and amenities! </p>
							</div>
							<!-- <p class="readMoreHolder">
								<a href="#"><span>Read More</span></a>
							</p> -->
						</li>
					</ul>
				</div>
			</div>

			<div id="thirdTab">
				<div class="containerTab">
					<ul>
						<li>
							<h3><a href="#">Castle Ridge - Luxuriously Appointed Homes</a></h3>

							<div class="entry">
								<p>Situated next to Odessa Country Club and Mission Golf Course, this beautiful upscale community has it all.  From included upgrades and lavish amenities these custom built homes start from the low $300's.  Located behind the castle walls across from La Paz on Eastridge.</p>

<p>From designing your dream home with an architect, to selecting your cabinets, flooring, and countertops with an interior designer, Permian Homes will be with you every step of the way to ensure a great experience for your dream home.</p>
<p>Our special attention to the details of the building process, from the development of the land, the completion of a home, and the follow up and care after move in are what set us apart.</p>
							</div>
							<!-- <p class="readMoreHolder">
								<a href="#"><span>Read More</span></a>
							</p> -->
						</li>

					</ul>
				</div>
			</div>

		</div> <!-- end: homeTabs -->

	</div> <!-- end: homeContentRight -->

</div> <!-- end: homeContentWrapper -->

<div id="homeWidgetContainer" class="clearFix">  <!-- begin: homeWidgetContainer -->

	<div id="home-widget-about" class="home-widget">
		<h2><a href="#">About Us</a></h2>
		<p align="justify"><strong>Permian Homes</strong> is dedicated to offering quality homes and lasting value for our customers. Our philosophy is simple: <em><u>We focus on each customer to build one dream at a time.</u></em></p>
		<p class="readmore"><a href="<?php echo site_url(); ?>/pages/index/1/7/"><span>Read More</span></a></p>
	</div>

    <div id="home-widget-twitter" class="home-widget">
        <h2><a href="#">Operation Finally Home</a></h2>
        <p align="justify">KPEJ FOX 24 has teamed up with Permian Homes, the <strong>Permian Basin</strong> Home Builders Association, and Operation finally home. It our mission is to provide custom made mortgage free homes to wounded and disabled veterans and the widows of the fallen in an effort to get their lives back on track and become productive members of their communities. Operation finally home partners with corporate sponsors, builder associations, builders, developers, individual contributors, and volunteers to help severely wounded heroes and their families' transition from the battlefront to the home front and help them succeed in their challenging new world so they may ultimately enjoy a productive and rewarding life. This house will be awarded to the Cox family! Welcome Home!</p>
        <p class="readmore"><a href="<?php echo site_url(); ?>/pages/index/1/7/"><span>Read More</span></a></p>
    </div>

	<div id="home-widget-flickr" class="home-widget">
		<h2>Testimonials</h2>
        <div id="quotes">
            <div class="textItem">
                <div class="client-say">
                    <p>"We love the design of our new home. From the open floor plan to the high ceilings, Permian does it&nbsp;right.&nbsp;Now we're living the life we always&nbsp;dreamed about!&nbsp;" </p>
                </div>
                <div class="client-name">
                    <p>STEVE AND LAUREL</p>
                </div>
            </div>
            <div class="textItem">
                <div class="client-say">
                    <p>"Permian made buying a home a&nbsp;wonderful experience.&nbsp;&nbsp;We love our new home and community and could not be happier!"</p>
                </div>
                <div class="client-name">
                    <p>CHRIS AND ANGELIQUE</p>
                </div>
            </div>
            <div class="textItem">
                <div class="client-say">
                    <p>"I appreciate Permian's constant support and communication while building my dream home.&nbsp; They answered my thousand questions and I am so happy in my new home!"</p>
                </div>
                <div class="client-name">
                    <p>MABEL</p>
                </div>
            </div>
            <div class="textItem">
                <div class="client-say">
                    <p"I loved that I was able to design my closets exactly how I wanted them!&nbsp; What a great experience I had!"</p>
                </div>
                <div class="client-name">
                    <p>BOBBIE</p>
                </div>
            </div>
            <div class="textItem">
                <div class="client-say">
                    <p>"We have had a wonderful experience working with Permian Homes! They have built such a beautiful home for us and we are so excited and pleased to live in it!"</p>
                </div>
                <div class="client-name">
                    <p>JEFF AND NANCY</p>
                </div>
            </div>
            <div class="textItem">
                <div class="client-say">
                    <p>"We have built several homes in the past but have never had such a great time than with Permian Homes! With their experience and focus on quality, we got our dream home!&nbsp; We would recommend Permian Homes to anyone!"</p>
                </div>
                <div class="client-name">
                    <p>RONALD AND TRISH</p>
                </div>
            </div>
        </div>
	</div>

</div> <!-- end: homeWidgetContainer -->

</div> <!-- end: wrapper -->