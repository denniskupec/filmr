# Filmr

Needed a way to upload a bunch of VLC snapshots as I took them to Imgur. No authentication required.

This was the result. Quick, dirty, but it works for the most part.

## How To Use

1. `composer install`
2. Point VLC to save snapshots in the `images` folder and run the `./filmr` application
3. Once you start taking snapshots, the console application will upload the images to Imgur, rename them to the given hash and move them to the `uploaded` folder. A link to the image is also printed.

