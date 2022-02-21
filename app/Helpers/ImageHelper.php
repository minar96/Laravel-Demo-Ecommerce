<?php

namespace App\Helpers;

use App\Models\User;
use App\Helpers\GravatarHelper;

/**
 * 
 */
class ImageHelper
{
	
	public static function getUser($id)
	{
		$user = User::find($id);
		$avater_url = "";

		if (!is_null($user)) {
			if ($user->avater==NULL) {
				// return gravater image
				if (GravatarHelper::validate_gravatar($user->email)) {
					$avater_url = GravatarHelper::gravatar_image($user->email, 100);
				}else{
					//when no gravater image
					$avater_url = url('images/defaults/default-user.png');

				}
			}else{
				//avater image that store in datebase avater field
				$avater_url = url('images/users/'.$user->avater);
			}
		}else{
			//return redirect('/'),
		}
		return $avater_url;
	}
}

