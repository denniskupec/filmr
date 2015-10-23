<?php

namespace Filmr;

use Filmr\Imgur\ImgurAPI;
use League\CLImate\CLImate;

class Filmr
{

	protected $imgur, $out;
	protected $queue = [];
	protected $allowed_filetypes = ["png", "jpg", "tiff"];

	public function __construct()
	{
		$this->imgur = new ImgurAPI();
		$this->out = new CLImate();

		$this->out->darkGray(time());
	}

	public function run()
	{
		$dir = scandir(dirname(__DIR__) . "/images");

		foreach($dir as $file) {

			$path = dirname(__DIR__) . "/images/{$file}";

			if(!is_file($path)) {
				continue;
			}

			$info = pathinfo($path);

			if(in_array($info['extension'], $this->allowed_filetypes) && !in_array($file, $this->queue)) {
				//$this->out->darkGray("New image '{$file}' found!");
				$this->queue[] = $file;
			}
		}

		foreach($this->queue as $key=>$value) {
			$r = $this->imgur->image()->upload(dirname(__DIR__) . "/images/{$value}");

			if($r->statusCode() === 200) {
				unset($this->queue[$key]);

				$data = $r->getBody()->data;
				$info = pathinfo(dirname(__DIR__) . "/images/{$value}");

				$this->out->inline("{$value} --> ");
				$this->out->bold()->lightGreen($data->link);
				//$this->out->lightGreen("\t\t\t Delete: http://imgur.com/delete/" . $data->deletehash);

				rename(dirname(__DIR__) . "/images/{$value}", dirname(__DIR__) . "/uploaded/" . $data->id . "." . $info['extension']);
			}
		}
	}

}
