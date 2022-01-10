<?php

class Catalogue
{
    function createProductColumn($columns, $listOfRawProduct)
    {
        // print_r($columns);
        // print "<br>";
        // print_r($listOfRawProduct);
        // print "<pre>";
        // print "<pre>";
        // exit;
        foreach (array_keys($listOfRawProduct) as $listOfRawProductKey) {
            // print_r($listOfRawProductKey);
            // echo "<br>";
            // print_r($listOfRawProduct[$listOfRawProductKey]);
            // echo "<br>";
            //mengisikan item kedalam item dan price dan price
            // $listOfRawProduct[$columns[$listOfRawProductKey]] = $listOfRawProduct[$listOfRawProductKey];
            $listOfRawProduct[] = $listOfRawProduct[$listOfRawProductKey];
            // echo ($columns[$listOfRawProductKey]) . ' = ' . $listOfRawProductKey . '<br>';
            unset($listOfRawProduct[$listOfRawProductKey]);
        }
        // exit;
        // var_dump($listOfRawProduct);
        return $listOfRawProduct;
    }

    function product($parameters)
    {
        $collectionOfListProduct = [];

        $raw_data = file($parameters['file_name']);
        foreach ($raw_data as $listOfRawProduct) {
            $collectionOfListProduct[] = $this->createProductColumn($parameters['columns'], explode(",", $listOfRawProduct));
        }
        return [
            'product' => $collectionOfListProduct,
            'gen_length' => count($collectionOfListProduct)
        ];
    }
}


class PopulationGenerator
{
    function createIndividu($parameters)
    {
        $catalogue = new Catalogue;
        $lengthOfGen = $catalogue->product($parameters)['gen_length'];
        for ($i = 0; $i <= $lengthOfGen - 1; $i++) {
            $ret[] = rand(0, 1);
        }
        return $ret;
    }

    function createPopulation($parameters)
    {
        for ($i = 0; $i <= $parameters['population_size']; $i++) {
            $ret[] = $this->createIndividu($parameters);
        }
        //$val merupakan representasi populasi sengankan $ret keseluruhan populasi

        foreach ($ret as $key => $val) {
            // print "<pre>";
            print_r($val);
        }
    }
}


$parameters = [
    'file_name' => 'products.txt',
    'columns' => ['item', 'price'],
    'population_size' => 10
];

$katalog = new Catalogue;
// print "<pre>";
// var_dump($katalog->product($parameters));
// var_dump($katalog->createProductColumn($parameters));
// print "<pre>";
$initialPopulation = new PopulationGenerator;
$initialPopulation->createPopulation($parameters);
