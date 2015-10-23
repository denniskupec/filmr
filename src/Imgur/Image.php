<?php

namespace Filmr\Imgur;

class Image extends ImgurAPI
{

	public function upload(string $image_path)
	{
		$response = $this->client->request("POST", "/3/upload.json", [
			"multipart" => [
				[ 
					"name" => "image",
					"contents" => fopen($image_path, "r") 
				]
			]
		]);

		return new ImgurAPIResponse($response);
	}

	public function delete(string $id)
	{
		$response = $this->client->request("POST", "/3/image/{$id}.json");

		return new ImgurAPIResponse($response);
	}

}
