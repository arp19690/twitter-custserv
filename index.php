<?php
// include all config files
require_once './config/config.php';

// include Twitter Oauth Library
require_once './libraries/twitter/twitteroauth.php';

// include all models
require_once './models/CommonModel.php';

// include all helpers
require_once './helpers/tweets.php';

$hashtag = 'custserv';
$data = showTweetsWithHashtag($hashtag);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Twitter Client API - #<?php echo $hashtag; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="">
        <meta name="keywords" content="">

        <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="assets/css/style.css">

        <script src="assets/js/jquery-2.1.4.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <div class="clearfix text-center">
                <p>Showing tweets for <strong>#<?php echo $hashtag; ?></strong> with atleast one retweet.</p>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div id="instant_results">
                        <?php
                        if (isset($data->t_response->statuses))
                        {
                            $tweets = $data->t_response->statuses;
                            foreach ($tweets as $tweet)
                            {
//                                Displaying only tweets which have atleast one Retweet
                                if ($tweet->retweet_count != 0)
                                {
                                    ?>
                                    <div class='timeline-tweets'>
                                        <div class="col-md-2 text-center">
                                            <img src='<?php echo $tweet->user->profile_image_url; ?>' class='img-thumbnail timeline' width='50'>
                                        </div>
                                        <div class="col-md-10">
                                            <p><a href='http://twitter.com/intent/user?screen_name=<?php echo $tweet->user->screen_name; ?>' target='_blank'><?php echo ($tweet->user->name); ?> <span class='text-muted'><?php echo '@' . $tweet->user->screen_name; ?></span></a></p>
                                            <p class="tweet-text"><?php echo ($tweet->text); ?></p>
                                            <span class='text-muted small'><?php echo date("g:i A D, F jS Y", strtotime($tweet->created_at)); ?></span>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        else
                        {
                            echo "<h2>An error occurred while fetching Tweets.</h2>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
