<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jason
 * Date: 12/2/12
 * Time: 9:32 AM
 * To change this template use File | Settings | File Templates.
 */?>

<div id="insideSearchSection">
    <gcse:searchbox-only></gcse:searchbox-only>
</div>



<ul id="widgetHolder">  <!-- begin: widgetHolder -->

    <li class="clearFix widget widget_recent_entries">

        <h3 class="widgettitle">Recent Listings</h3>

        <ul>

            <?php

            if ((isset($locations)) && (count($locations) >= 1)) {
                foreach ($locations->result() as $row) {

                    ?>

                    <li>
                        <a href="/pages/index/1/18/<?php echo $row->idlocation; ?>"><?php echo $row->location_street; ?></a>
                    </li>

                    <?php

                }
            }

            ?>
        </ul>

    </li>
    <li class="clearFix widget widget_recent_entries"">
    <h3 class="widgettitle">Contact Us</h3>
    <ul>
        <li>
            PO Box 12025<br/>
            Odessa, TX 79768-2025<br/>
            Phone 432-362-3436<br/>
            Fax 866.497.6551
        </li>
        <li>
            <strong>Cindy Winfrey</strong><br/>
            Broker / Sales Representative<br/>
            432.553.5265<br/> cindy@permianhomes.com<br/>
        </li>
        <li>
            <strong>Kaete Hawkins</strong><br/>
            Assistant Sales Representative<br/>
            432.260.4017<br/> kaete@permianhomes.com
        </li>
        <li>
            <strong>Olivia Grubbs</strong><br/>
            Assistant Sales Representative<br/>
            432.213.0130<br/> olivia@permianhomes.com
        </li>
    </ul>
    </li>


</ul>  <!-- end: widgetHolder -->