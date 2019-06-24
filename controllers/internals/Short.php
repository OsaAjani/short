<?php
	namespace controllers\internals;

	use \models\Short as ModelShort;

	class Short extends \InternalController
	{
		public function __construct (\PDO $pdo)
		{
			$this->model_short = new ModelShort($pdo);
		}


		/**
		 * Minify an url to his short uid
		 * @param string $url : the url to minify
		 * @return string : the short uid
		 */
		public function minify (string $url) : string
		{
			$short = $this->model_short->get_one_by_url($url);

			if ($short)
			{
				return $short['uid'];
			}

			$uid = str_replace('=', '', strtr(base64_encode(random_bytes(4)), '+/', '-_'));

			$this->model_short->create($url, $uid, time());
			return $uid;

		}

		
		public function develop (string $uid)
		{
			$short = $this->model_short->get_one_by_uid($uid);

			if (!$short)
			{
				return false;
			}

			$this->model_short->update_last_click($short['id'], time());

			return $short['url'];
		}
	}