<?php
namespace AppBundle\Utils;


class SourceBRates implements RatesInterfaces
{
    protected $data;

    public function inputData($data)
    {
        $getJson = json_decode($data);

        $this->data[0] = new Rate("USD",(float)$getJson[0]->oran,"B");
        $this->data[1] = new Rate("EUR",(float)$getJson[1]->oran,"B");
        $this->data[2] = new Rate("GBP",(float)$getJson[2]->oran,"B");
        //Dataların Yerleri ve Kur bilgileri sabit ve sayısı az olarak baz alındığı için bu yöntem uygulanmıştır
    }

    public function outputData()
    {
        return $this->data;
    }
}