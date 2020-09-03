<?php

namespace shfretak\lib;
/**
 * Trait Helper
 * @package shfretak\lib
 */
trait Helper
{
    /**
     * @param $path , the path location that you want to redirect to it (path)
     */
    public function redirect($path)
    {
        header("location: $path ");
        exit;
    }


}