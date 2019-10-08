<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

/**
 * Class Common
 * @package App\Controller\Component
 */
class CommonComponent extends Component
{
    /**
     * Random string
     *
     * @param int $length
     * @return string
     */
    public function randomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
