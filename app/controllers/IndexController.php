<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        /*UPDATE --- DONE*/
//        if($customer = \FutureFoam\Model\Customer::findFirst(3)) {
//            $customer->Name = 'Q3123';
//            $customer->EmailAddress = 'test@example.com';
//            $customer->Fax = '1234';
//            if(!$customer->save()) {
//                echo 'Error:';
//                foreach($customer->getMessages() as $message) {
//                    echo $message.'<br/>';
//                }
//            }
//        }
        /*INSERT --- DONE*/
            /*Auto-increment is not working :(*/
            /*get max of cust num*/
//            $result = $this->db->query("SELECT MAX(CustNum) 'max' FROM PUB.Customer");
//            $result->setFetchMode(Phalcon\Db::FETCH_ASSOC);
//            $custNumResul = $result->fetch();
//            
//            $customer = new \FutureFoam\Model\Customer();
//            $customer->CustNum = $custNumResul['max'] + 1;
//            $customer->Name = 'Q3123';
//            $customer->EmailAddress = 'test123@example.com';
//            $customer->Fax = '12345';
//            
//            
//            if(!$customer->save()) {
//                foreach($customer->getMessages() as $message) {
//                    echo $message.'<br/>';
//                }
//            }
        /*DELETE --- DONE*/
//        if ($customer = \FutureFoam\Model\Customer::findFirst(2113)) {
//            if ($customer->delete() === false) {
//                echo "Error: \n";
//                $messages = $customer->getMessages();
//
//                foreach ($messages as $message) {
//                    echo $message, "\n";
//                }
//            }
//        }
        
        //PENDING - DETAILED SEARCH, NESTED MODELS

        //print_r($customer->Name);
        //print_r(get_class_methods($customer));
//        $a = $this->db->query("SELECT * FROM PUB.Customer");
//        $a->setFetchMode(Phalcon\Db::FETCH_ASSOC);
//        $results = $a->fetchAll();
//        foreach($results as $result) {
//            echo '<pre>';print_r($result);
//        }
        //echo '<pre>';print_r($customer);
        
//            $result = $this->db->query("SELECT MAX(BillToId) 'max' FROM PUB.BillTo");
//            $result->setFetchMode(Phalcon\Db::FETCH_ASSOC);
//            $billToResult = $result->fetch();
//            
//            $billTo = new \FutureFoam\Model\BillTo();
//            $billTo->BillToID = $billToResult['max'] + 1;
//            $billTo->CustNum = 5;
//            if(!$billTo->save()) {
//                foreach($billTo->getMessages() as $message) {
//                    echo $message.'<br/>';
//                }
//            }
        //Nested Model:
        $customer = \FutureFoam\Model\Customer::findFirst(5);
        //echo '<pre>';
        $a = $customer->Bills;
        foreach($a as $v) {
            echo $v->Name.'--'.$v->Contact.PHP_EOL;
        }
        //print_r($customer->Bills);
//        foreach ($customer->Bills as $billTo) {
//            print_r($billTo->Contact);
//        }
//        echo '<pre>';print_r($customer);die;
        echo PHP_EOL;
        die('script completed');
    }

}

