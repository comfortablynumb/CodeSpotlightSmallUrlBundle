<?php

/**
 * Created by Gustavo Falco <comfortablynumb84@gmail.com>
 */

namespace CodeSpotlight\Bundle\SmallUrlBundle\Service\Response;

use CodeSpotlight\Bundle\ApplicationToolsBundle\Service\Response\BaseResponse;

class Response extends BaseResponse
{
    protected $url;


    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }
}
