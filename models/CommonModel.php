<?php

class CommonModel
{
    private $t_response = NULL;
    private $error_status = false;

    function __construct($hashtag = NULL, $tweet_count = 100)
    {
        // oauth connection to Twitter API
        $api_connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

        // basic search endpoint for Twitter API
        $base_url = 'https://api.twitter.com/1.1/search/tweets.json';
        $api_url = $base_url . '?q=' . urlencode('#' . $hashtag) . '&include_entities=false&result_type=recent&count=' . $tweet_count;

        // making API call
        $response = $api_connection->get($api_url);

        if (isset($response->errors) || !isset($response->statuses))
        {
            $this->error_status = true;
        }

        $this->t_response = $response;
    }

    public function getErrorStatus()
    {
        return $this->error_status;
    }

    public function getTweets()
    {
        return $this->t_response;
    }

}
