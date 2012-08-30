


    <div id="bodycontent" class="row">
        <div class="row headline">
            <div class="twelve columns">
                <h2 >Contact Us</h2>
            </div>
        </div>
        <div class="row">
            <div class="twelve columns">
                <div class="four columns">
                    <h3>Call or Send Us A Letter</h3>
                    <p>Phone: 928-284-4222</p>
                    <p>AVI Transportation Services, LLC<br/>
                        2704 S. Mohave Lane,<br/>
                        Cottonwood, AZ 86326
                    </p>
                    <div class="fb-like" data-href="http://avitransportationservices.com/" data-send="true" data-width="300" data-show-faces="false"></div>
                    <p><a href="https://www.facebook.com/avitransportation" target="_blank"><img src="/assets/images/icons/facebook-64.png"></a></p>
                </div>
                <div class="four columns">
                    <h3>Use Our Easy Form</h3>
                    <?php echo validation_errors(); ?>
                    <?=form_open('/site/newcontact', 'class=nice');?>
                    <?=form_fieldset('');?>
                    <?=form_input('firstname', 'First Name', 'class="input-text"'); ?>
                    <?=form_input('lastname', 'Last Name', 'class="input-text"'); ?>
                    <?=form_input('email', 'Email Address', 'class="input-text"'); ?>
                    <?=form_input('street', 'Street Address', 'class="input-text"'); ?>
                    <?=form_input('city', 'City', 'class="input-text"'); ?>
                    <?=form_input('state', 'State', 'class="input-text"'); ?>
                    <?=form_input('zip', 'Zip', 'class="input-text"'); ?>
                    <?=form_input('telephone', 'Telephone', 'class="input-text"'); ?>
                    <?=form_textarea('message', 'Services Requested...', ''); ?>
                    <?=form_submit('mysubmit','Submit','class="blue button radius"');?>
                    <?=form_fieldset_close();?>
                    <?=form_close();?>
                </div>
                <div class="four columns">
                    <img src="/assets/images/site-images/a_phone_contact_us1.png">
                </div>
            </div>
        </div>
        <div class="row quote">
            <div class="twelve columns">
                <h2>Our professional drivers provide affordable, reliable, courteous and friendly service.</h2>
            </div>
        </div>

    </div>
<script type="text/javascript">
    $(function() {

        $('input[type=text]').focus(function() {

            $(this).val('');

        });

    });
</script>
