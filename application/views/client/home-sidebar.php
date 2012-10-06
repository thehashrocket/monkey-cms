



    <?php
        if ($login == 'false')
        {   echo '<h4>Login or Create an Account</h4>';
            echo '<p class="login"><a href="/auth/login">If you have an account log in</a>.</p>
                    <p class="caccount"><a href="/auth/register">Register for an account.</a></p>';
        } else
        {
            echo '<h4>Welcome</h4>';
            echo'<p class="userlink"><a href="/client/#tabs-1">You are logged in ' . $username . '.</a></p>';
            echo'<p class="clientlogin"><a href="/client#tabs-1">Access Your Client Area</a></p>';
        }
?>


