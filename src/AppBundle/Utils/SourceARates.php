<?php
namespace AppBundle\Utils;

class SourceARates implements RatesInterfaces
{
    protected $data;

    public function inputData($data)
    {
        $getJson = json_decode($data);

        $this->data[0] = new Rate("USD",(float)$getJson->result[0]->amount,"A");
        $this->data[1] = new Rate("EUR",(float)$getJson->result[1]->amount,"A");
        $this->data[2] = new Rate("GBP",(float)$getJson->result[2]->amount,"A");
        //Dataların Yerleri ve Kur bilgileri sabit ve sayısı az olarak baz alındığı için bu yöntem uygulanmıştır
    }

    public function outputData()
    {
        return $this->data;
    }
}