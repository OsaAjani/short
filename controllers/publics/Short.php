<?php
namespace controllers\publics;

use \controllers\internals\Short as InternalShort;

class Short extends \Controller
{

	public function __construct()
    {
        $pdo = \Model::connect(DATABASE_HOST, DATABASE_NAME, DATABASE_USER, DATABASE_PASSWORD);
        $this->internal_short = new InternalShort($pdo);
    }

	/**
	 * Home Page
	 */	
	public function home ()
	{
		return $this->render("short/home");
	}


	public function minify ()
	{
		$url = $_POST['url'] ?? false;

        if (!$url || !filter_var($url, FILTER_VALIDATE_URL))
        {
            return $this->render('short/minify', ['success' => false]);
        }

        $uid = $this->internal_short->minify($url);

        if (!$uid)
        {
            return $this->render('short/minify', ['success' => false]);
        }

        return $this->render('short/minify', ['success' => true, 'url' => $url, 'uid' => $uid]);
	}


    public function develop (string $uid)
    {
        $url = $this->internal_short->develop($uid);
        
        if (!$url)
        {
            return $this->render('short/develop', ['success' => false]);
        }

        header('Location: ' . $url);
        return true;
    }
}
