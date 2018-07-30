<?php
namespace AppBundle\Utils;

use AppBundle\AppBundle;
use AppBundle\Utils\Rate;

class Finder
{
    private $_data=array();
    private $_list=array();
    private $_listMin=array();
    private $_listMax=array();
    private $_execRun=0;

    /**
     * @param mixed $data
     */
    public function addData($data)
    {

        foreach ($data as $item){
            array_push(
                $this->_data,
                new Rate($item->getRate(),$item->getValue(),$item->getSource())
            );
        }

    }

    public function exec()
    {
        foreach ($this->_data as $data){
            $this->_list[$data->getType()][$data->getSource()]=$data->getValue();
        }
        foreach ($this->_list as $dataKey => $dataValue){
            $this->_listMin[$dataKey] = $this->findArrVal($dataValue,"min");
        }
        foreach ($this->_list as $dataKey => $dataValue){
            $this->_listMax[$dataKey] = $this->findArrVal($dataValue,"max");
        }
        $this->_execRun=1;
    }

    public function getMin()
    {
        if($this->_execRun==0) return array('-1'=>"Exec Function run require");
        else return $this->_listMin;
    }

    public function getMax()
    {
        if($this->_execRun==0) return array('-1'=>"Exec Function run require");
        else return $this->_listMax;
    }

    private function findArrVal($Arr,$typ){
        if($typ=="min"){
            $minVal=min($Arr);
            $returnVal=array();
            foreach ($Arr as $Key => $Val){
                if($minVal==$Val){
                    $returnVal=array($Key=>$Val);
                }
            }
            return $returnVal;
        }else if($typ=="max"){
            $minVal=max($Arr);
            $returnVal=array();
            foreach ($Arr as $Key => $Val){
                if($minVal==$Val){
                    $returnVal=array($Key=>$Val);
                }
            }
            return $returnVal;
        }
    }

}