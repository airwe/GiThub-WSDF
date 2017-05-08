<div class="wrap">
    <?php screen_icon(); ?>
    <h2>Advanced Twitter Feed Integration Settings</h2>

    <h2 class="nav-tab-wrapper">
        <a href="#atfi_api_keys" class="nav-tab" id="atfi_api_tab">API Keys</a>
        <a href="#atfi_shortcode" class="nav-tab" id="atfi_shortcode_tab">Shortcode Usage</a>
        <a href="#atfi_how_to" class="nav-tab" id="atfi_how_to_tab">How Do I Generate My API Keys?</a>
        <?php if(get_option('atfi_error') || get_option('atfi_searcherror')): ?>
        <a href="#atfi_errors" class="nav-tab" id="atfi_errors_tab">Errors</a>
        <?php endif; ?>
    </h2>

        <div id="atfi_api_keys" class="group tool-box">      
        <form method="post" action="options.php">  
            <?php
                settings_fields( 'atfi_option_group' );
                do_settings_sections('atfi_option_group');
            ?> 
            <?php echo '<input type="hidden" id="page_id" name="page" value="' . $_REQUEST['page'] . '"/>'; ?>              
         <h3 class="title">Your Twitter API Credentials</h3>
         <p>Please enter your Twitter API Credentials below - if you're struggling to get hold of them - please see our "How Do I Generate My API Keys?"</p>
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                    <th scope="row">Consumer Key</th>
                        <td>
                           <input type="text" name="atfi_consumer_key" value="<?php echo get_option('atfi_consumer_key'); ?>" placeholder="xxxx" class="regular-text" /><br />
                           <span class="description">Please enter your Twitter <strong>consumer_key</strong>.</span>

                        </td>
                    </tr>
                    <tr valign="top">
                    <th scope="row">Consumer Secret</th>
                        <td>
                           <input type="password" name="atfi_consumer_secret" value="<?php echo get_option('atfi_consumer_secret'); ?>" placeholder="xxxx" class="regular-text" /><br />
                           <span class="description">Please enter your Twitter <strong>consumer_secret</strong>.</span>

                        </td>
                    </tr>
                    <tr valign="top">
                    <th scope="row">Access Token</th>
                        <td>
                           <input type="text" name="atfi_access_token" value="<?php echo get_option('atfi_access_token'); ?>" placeholder="xxxx" class="regular-text" /><br />
                           <span class="description">Please enter your Twitter <strong>access_token</strong>.</span>

                        </td>
                    </tr>
                    <tr valign="top">
                    <th scope="row">Access Token Secret</th>
                        <td>
                           <input type="password" name="atfi_access_token_secret" value="<?php echo get_option('atfi_access_token_secret'); ?>" placeholder="xxxx" class="regular-text" /><br />
                           <span class="description">Please enter your Twitter <strong>access_token_secret</strong>.</span>

                        </td>
                    </tr>
                </tbody>
            </table>            
            <p>Once you have entered all of your credentials you'll be able to configure your widget in <strong>Appearance</strong> > <strong>Widgets</strong></p>
            <input type="button" value="Test API Credentials" class="button" name="test_api" id="test_api" />
            <p class="atfi-test-result"></p>
                <?php submit_button('Save all WP Recent Tweets Settings'); ?>
            </form>
        </div>
        <div id="atfi_shortcode" class="group tool-box">
            <h3 class="title">Shortcode Usage</h3>
            <p>Below is how to use your shortcodes in the WYSIWYG editor.</p>
            <h3>Timeline Shortcode</h3>
            <p>CMS Page</p>
            <pre>
                <code>[get_tweet_timeline username="crearegroup" number="3" showlinks="true" newwindow="true" nofollow="true" avatar="true"]</code>
            </pre>
            <p>PHP Template</p>
            <pre>
                <code>&lt;?php echo do_shortcode('[get_tweet_timeline username="crearegroup" number="3" showlinks="true" newwindow="true" nofollow="true" avatar="true"]'); ?></code>
            </pre>
            <ol>
                <li><strong>Username (required)</strong>: Please enter your twitter username here</li>
                <li><strong>Number (optional)</strong>: Please enter the number of tweets you wish to return here (default: <code>1</code>)</li>
                <li><strong>Showlinks (optional)</strong>: Please enter "true" if you wish to show links (default: <code>false</code>)</li>
                <li><strong>Newwindow (optional)</strong>: Please enter "true" if you wish to open links in a new window (default: <code>false</code>)</li>
                <li><strong>Nofollow (optional)</strong>: Please enter "true" if you wish to links to use the nofollow attribute (default: <code>false</code>)</li>
                <li><strong>Avatar</strong>: Please enter "true" if you wish to show avatar images in you tweets (default: <code>false</code>)</li>
            </ol>
            <h3>Search Shortcode</h3>
            <p>CMS Page</p>
            <pre>
                <code>[get_tweet_search searchterm="#wordpress" username="crearegroup" number="3" showlinks="true" newwindow="true" nofollow="true" avatar="true"]</code>
            </pre>
            <p>PHP Template</p>
            <pre>
                <code>&lt;?php echo do_shortcode('[get_tweet_search searchterm="#wordpress" username="crearegroup" number="3" showlinks="true" newwindow="true" nofollow="true" avatar="true"]'); ?></code>
            </pre>
            <ol>
                <li><strong>Searchterm (required)</strong>: Please enter your search term (e.g. #wordpress OR wordpress OR @wordpress)</li>
                <li><strong>Username (required)</strong>: Please enter your twitter username here (used in the follow button)</li>
                <li><strong>Number (optional)</strong>: Please enter the number of tweets you wish to return here (default: <code>1</code>)</li>
                <li><strong>Showlinks (optional)</strong>: Please enter "true" if you wish to show links (default: <code>false</code>)</li>
                <li><strong>Newwindow (optional)</strong>: Please enter "true" if you wish to open links in a new window (default: <code>false</code>)</li>
                <li><strong>Nofollow (optional)</strong>: Please enter "true" if you wish to links to use the nofollow attribute (default: <code>false</code>)</li>
                <li><strong>Avatar</strong>: Please enter "true" if you wish to show avatar images in you tweets (default: <code>false</code>)</li>
            </ol>
        </div>
        <div id="atfi_how_to" class="group tool-box">
            <h3 class="title">How To Generate your API Keys</h3>
            <p>Here is how to generate your Twitter API Keys</p>
            <ol>
                <li>Login to <a target="_blank" href="https://dev.twitter.com">http://dev.twitter.com</a> using your normal Twitter username/password.</li>
                <li>Hover-over your little icon top-right and then click <strong>My Applications</strong></li>
                <li>Click <strong>Create New Application</strong></li>
                <li>Fill out the form - the name, description and website should at least be filled in - then click <strong>Create Your Twitter Application</strong></li>
                <li>On the next page - navigate to the bottom and click <strong>Create my access token</strong></li>
                <li>Wait 10 seconds then refresh the page - you should now see all your access keys!!</li>
                <li>Copy/Paste the appropriate key into the appropriate field in the API Keys tab above :)</li>
            </ol>
        </div>
        <?php if(get_option('atfi_error') || get_option('atfi_searcherror')): ?>
        <div id="atfi_errors" class="group tool-box">
            <h3 class="title">You have errors with your widgets / shortcodes</h3>
            <p>Any errors are displayed below (please refresh this page if you're not sure you should be still getting these errors):</p>
            <?php if($errors = get_option('atfi_error')): ?>
            <h3>Timeline Errors</h3>
            <p>The below timeline errors are causing your Timeline integrations to display your last good "cache" (if you have one - if you don't - nothing will display).</p>
            <ul>
            <?php $errors = json_decode($errors,true);
                  foreach($errors as $error): ?>
                <li><strong>Code: <?php echo $error['code'] ?> - <?php echo $error['message'] ?></strong></li>
            <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <?php if($errors = get_option('atfi_searcherror')): ?>
            <h3>Search Errors</h3>
            <p>The below search errors are causing your Search integrations to display your last good "searchcache"  (if you have one - if you don't - nothing will display).</p>
            <ul>
            <?php $errors = json_decode($errors,true);
                  foreach($errors as $error): ?>
                <li><strong>Code: <?php echo $error['code'] ?> - <?php echo $error['message'] ?></strong></li>
            <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
        <?php endif; ?>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('.wrap .group').hide();
    $('.wrap .group:first').show();
    $('.wrap .nav-tab-wrapper a:first').addClass('nav-tab-active');
     
    $('.wrap .nav-tab-wrapper a').click(function(){
        $('.wrap .nav-tab-wrapper a').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        var currentTab = $(this).attr('href');
        $('.wrap .group').hide();
        $(currentTab).show();
        return false;
    });

    $('#test_api').click(function(){

        $('.atfi-test-result').html('<img src="/wp-admin/images/loading.gif" alt="loading">');

        var fail = false;
        $('.form-table input').each(function(){
            if($(this).val() == ""){
                $('.atfi-test-result').html("Please enter all API credentials before testing");
                fail = true;
            }
        });

        var data = {
            action: 'atfi_test_api',
            atfi_consumer_key: $('.form-table input[name="atfi_consumer_key"]').val(),
            atfi_consumer_secret: $('.form-table input[name="atfi_consumer_secret"]').val(),
            atfi_access_token: $('.form-table input[name="atfi_access_token"]').val(),
            atfi_access_token_secret: $('.form-table input[name="atfi_access_token_secret"]').val()
        };

        if(!fail){

            $.post(ajaxurl, data, function(response) {
                $('.atfi-test-result').html(response);
            });

        }
    })

});
</script>

<?php
require('creare-footer.php');