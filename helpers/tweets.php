<?php

function showTweetsWithHashtag($hashtag = 'custserv')
{
//    Search all tweets with a particular hashtag
    $hashtag_search = new CommonModel($hashtag);

    $output = new stdClass();
    if ($hashtag_search->getErrorStatus())
    {
        $output->error = TRUE;
        $output->t_response = "";
    }
    else
    {
        // get object of matched tweets
        $all_tweets = $hashtag_search->getTweets();
        $output->error = FALSE;
        $output->t_response = $all_tweets;
    }

    return $output;
}
