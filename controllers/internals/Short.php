<?php
namespace controllers\internals;

use \models\Short as ModelShort;

class Short extends \InternalController
{
    public function __construct(\PDO $pdo)
    {
        $this->model_short = new ModelShort($pdo);
    }

    public function minify ($url)
    {
        $short = $this->model_short->get_one_by_url($url);

        if ($short)
        {
            return $short['uid'];
        }

        $uid = str_replace('=', '', strtr(base64_encode(random_bytes(4)), '+/', '-_'));

        $this->model_short->create($url, $uid);
        return $uid;
    }
    
    
    public function develop ($uid)
    {
        $short = $this->model_short->get_one_by_uid($uid);

        if (!$short)
        {
            return false;
        }

        return $short['url'];
    }
}
