<?php
namespace AppBundle\Utils;

class SourceCRates implements RatesInterfaces
{
    protected $data;

    public function inputData($data)
    {
        $getJson = json_decode($data);

        $this->data[0] = new Rate("USD",(float)$getJson->veri[0]->deger,"C");
        $this->data[1] = new Rate("EUR",(float)$getJson->veri[1]->deger,"C");
        $this->data[2] = new Rate("GBP",(float)$getJson->veri[2]->deger,"C");
        //Dataların Yerleri ve Kur bilgileri sabit ve sayısı az olarak baz alındığı için bu yöntem uygulanmıştır
    }

    public function outputData()
    {
        return $this->data;
    }
}