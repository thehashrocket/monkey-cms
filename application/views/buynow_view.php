
    <div id="bodycontent" class="row">
        <div class="row headline">
            <div class="twelve columns">
                <h2 >We're on our way!</h2>
            </div>
        </div>
        <div class="row">
            <div class="eight columns">
                <p>Fill out this form and we'll be there!</p>
                <div>
                    <h3>Use Our Easy Form</h3>
                    <?php echo validation_errors(); ?>
                    <?=form_open('/site/newpurchase', 'class=nice');?>
                    <?=form_fieldset('');?>
                    <h4>Your Information</h4>
                    <div class="row">
                        <div class="twelve columns">
                            <div class="six columns">
                                <?=form_label('First Name:', 'bill_firstname');?>
                                <?=form_input('bill_firstname', '', 'class="input-text" placeholder="First Name"'); ?>
                            </div>
                            <div class="six columns">
                                <?=form_label('Last Name', 'bill_lastname');?>
                                <?=form_input('bill_lastname', '', 'class="input-text" placeholder="Last Name"'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="twelve columns">
                            <div class="six columns">
                                <?=form_label('Email Address', 'bill_email');?>
                                <?=form_input('bill_email', '', 'class="input-text" placeholder="Email Address"'); ?>
                            </div>
                            <div class="six columns"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="twelve columns">
                                <?=form_label('Street Address', 'bill_street');?>
                                <?=form_input('bill_street', '', 'class="large input-text" placeholder="Street Address"'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="twelve columns">
                            <div class="six columns">
                                <?=form_label('City', 'bill_city');?>
                                <?=form_input('bill_city', '', 'class="input-text" placeholder="City"'); ?>
                            </div>
                            <div class="three columns">
                                <?=form_label('State', 'bill_state');?>
                                <?=form_input('bill_state', '', 'class="small input-text" placeholder="State"'); ?>
                            </div>
                            <div class="three columns">
                                <?=form_label('Zip', 'bill_zip');?>
                                <?=form_input('bill_zip', '', 'class=" small input-text" placeholder="Zip"'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="twelve columns">
                            <?=form_label('Telephone Number', 'bill_telephone');?>
                            <?=form_input('bill_telephone', '', 'class="input-text" placeholder="Telephone"'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="nine columns">
                            <?=form_label('Card Number', 'bill_card_numb');?>
                            <?=form_input('bill_card_numb', '', 'class="large input-text" placeholder="Card Number"'); ?>
                        </div>
                        <div class="three columns">
                            <?=form_label('Expiration Date', 'bill_exp_date');?>
                            <?=form_input('bill_exp_date', '', 'class="small input-text" placeholder="Exp Date"'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="twelve columns">
                            <?=form_label('Card Verification Number', 'bill_card_code');?>
                            <?=form_input('bill_card_code', '', 'class="input-text" placeholder="Card Verification Number"'); ?>
                        </div>
                    </div>
                    <h4>Your Pickup Information</h4>
                    <div class="row">
                        <div class="twelve columns">
                            <?=form_label('Pickup Street', 'pickup_street');?>
                            <?=form_input('pickup_street', '', 'class="large input-text" placeholder="Pickup Street Address"'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="six columns">
                            <?=form_label('Pickup City', 'pickup_city');?>
                            <?=form_input('pickup_city', '', 'class="input-text" placeholder="Pickup City"'); ?>
                        </div>
                        <div class="three columns">
                            <?=form_label('Pickup State', 'pickup_state');?>
                            <?=form_input('pickup_state', '', 'class="small input-text" placeholder="Pickup State"'); ?>
                        </div>
                        <div class="three columns">
                            <?=form_label('Pickup Zip', 'pickup_zip');?>
                            <?=form_input('pickup_zip', '', 'class=" small input-text" placeholder="Pickup Zip"'); ?>
                        </div>
                    </div>

                    <h4>Your Destination</h4>
                    <div class="row">
                        <div class="twelve columns">
                            <?=form_label('Destination Street', 'destination_street');?>
                            <?=form_input('destination_street', '', 'class="large input-text" placeholder="Destination Street Address"'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="six columns">
                            <?=form_label('Destination City', 'destination_city');?>
                            <?=form_input('destination_city', '', 'class="input-text" placeholder="Destination City"'); ?>
                        </div>
                        <div class="three columns">
                            <?=form_label('Destination State', 'destination_state');?>
                            <?=form_input('destination_state', '', 'class="small input-text" placeholder="Destination State"'); ?>
                        </div>
                        <div class="three columns">
                            <?=form_label('Destination Zip', 'destination_zip');?>
                            <?=form_input('destination_zip', '', 'class=" small input-text" placeholder="Destination Zip"'); ?>
                        </div>
                    </div>
                    <h4>Additional Notes</h4>
                    <div class="row">
                        <div class="twelve columns">
                            <?=form_label('Services Requested', 'message');?>
                            <?=form_textarea('message', '', 'placeholder ="Services Requested..."'); ?>
                        </div>
                    </div>



                    <?=form_submit('mysubmit','Submit','class="blue button radius"');?>
                    <?=form_fieldset_close();?>
                    <?=form_close();?>
                </div>
            </div>
            <div class="four columns">
                <div class="twelve columns">
                    <img src="/assets/images/site-images/CreditCardLOGO.jpg">
                </div>
                <div class="twelve columns">
                    <a href="http://www.instantssl.com">
                        <img src="/assets/images/site-images/comodo_secure-100x85.gif"
                             alt="Instant SSL Certificate Secure Site" width="100" height="85" style="border: 0px;"><br>
                        <span style="font-weight:bold; font-size:7pt">Instant SSL Certificate Secured</span> </a><br>
                </div>
            </div>
        </div>
        <div class="row quote">
            <div class="twelve columns">
                <h2>Our professional drivers provide affordable, reliable, courteous and friendly service.</h2>
            </div>
        </div>

    </div>

