<?php
namespace App\Helpers;
//Gravater Helper

/**
 * 
 */
class GravatarHelper 
{
	public static function validate_gravatar($email) {
	// Craft a potential url and test its headers
	$hash = md5(strtolower(trim($email)));

	$url = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
	$headers = @get_headers($uri);

		if (!preg_match("|200|", $headers[0])) {
			$has_valid_avatar = false;
		} else {
			$has_valid_avatar = true;
		}

	return $has_valid_avatar;
	}

	public static function gravatar_image($email, $size=0, $d="") {
		$hash = md5(strtolower(trim($email)));
		$image_url = 'http://www.gravatar.com/avatar/' . $hash . '?s='.$size. '&d='.$d;

		return $image_url;
	}
}


