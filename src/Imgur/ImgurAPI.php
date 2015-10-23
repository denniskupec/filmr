<?php

namespace Filmr\Imgur;

class ImgurAPI
{
	
	protected $client_id = "f898a66b3fa034c";
	protected $client_secret = "a5fc9958fa7674a694fcf24f540830cef7f96e8e";
	protected $client;

	public function __construct()
	{
		$this->client = new \GuzzleHttp\Client([
			"base_uri" => "https://api.imgur.com",
			"timeout" => 60,
			"connect_timeout" => 0,
			"http_errors" => false,
			"headers" => [
				"Authorization" => "Client-ID " . $this->client_id
			]
		]);
	}

	public function image()
	{
		return new Image;
	}

	public function credits()
	{
		return json_decode($this->client->request("GET", "/3/credits.json")->getBody()->getContents());
	}

}
