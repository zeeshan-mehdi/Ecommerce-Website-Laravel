<?php
/**
 * Created by PhpStorm.
 * User: zeesh
 * Date: 8/15/2019
 * Time: 11:24 AM
 */

namespace App\Model;


class EarningModel
{

    public $earnings =null;

    /**
     * EarningModel constructor.
     * @param $earning
     * @param $date
     */
    public function __construct()
    {

    }
    public function insert($id,$price,$date){

        $item  =['date'=>$date,'price'=>$price];
        $this->earnings[$id]=$item;
    }

}