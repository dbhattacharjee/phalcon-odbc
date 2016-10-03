<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        
        if($customer = \FutureFoam\Model\Customer::findFirst(3)) {
            //echo '<pre>';print_r($customer);die;
            ////echo 'Before :'.$customer->EmailAddress.PHP_EOL;
            //die;
            $customer->Name = 'Q3123';
            $customer->EmailAddress = 'test@example.com';
            $customer->Fax = '1234';
            if(!$customer->save()) {
                echo 'Error:';
                foreach($customer->getMessages() as $message) {
                    echo $message.'<br/>';
                }
            }
        }
        echo '<pre>';
        
        print_r($customer->Name);
        //print_r(get_class_methods($customer));
//        $a = $this->db->query("SELECT * FROM PUB.Customer");
//        $a->setFetchMode(Phalcon\Db::FETCH_ASSOC);
//        $results = $a->fetchAll();
//        foreach($results as $result) {
//            echo '<pre>';print_r($result);
//        }
        //echo '<pre>';print_r($customer);
        echo PHP_EOL;
        die('script completed');
    }

}

