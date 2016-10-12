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


    
  /*     if ($customer = \FutureFoam\Model\Customer::findFirst(987654327)) {
           if ($customer->delete() === false) {
               echo "Error: \n";
               $messages = $customer->getMessages();

               foreach ($messages as $message) {
                   echo $message, "\n";
               }
           }
       }*/
        
        //PENDING - DETAILED SEARCH

        //print_r($customer->Name);
        //print_r(get_class_methods($customer));
       $a = $this->db->query("SELECT * FROM PUB.BillTo");
        $a->setFetchMode(Phalcon\Db::FETCH_ASSOC);
        $results = $a->fetchAll();
        foreach($results as $result) {
            echo '<pre>';print_r($result);
        } 
        //echo '<pre>';print_r($customer);
        
//            $result = $this->db->query("SELECT MAX(BillToId) 'max' FROM PUB.BillTo");
//            $result->setFetchMode(Phalcon\Db::FETCH_ASSOC);
//            $billToResult = $result->fetch();
//            
//            $billTo = new \FutureFoam\Model\BillTo();
//            $billTo->BillToID = $billToResult['max'] + 1;
//            $billTo->CustNum = 2117;
//            $billTo->Address = 'Address : '.$billTo->CustNum.'--'.rand();
//            $billTo->Name = 'Name : '.$billTo->CustNum.'--'.rand();
//            $billTo->Contact = 'Contact :'. $billTo->CustNum.'--'.rand();
//            if(!$billTo->save()) {
//                foreach($billTo->getMessages() as $message) {
//                    echo $message.'<br/>';
//                }
//            }
        //Nested Model: --- DONE
        //$customer = \FutureFoam\Model\Customer::findFirst(2117);
//echo '<pre>';
        //$a = $customer->Bills;
        //foreach($a as $v) {
            //echo $v->Name.'--'.$v->Contact.PHP_EOL;
        //}
//        //print_r($customer->Bills);
        //foreach ($customer->Bills as $billTo) {
          //  print_r($billTo->Contact);
        //}
////        echo '<pre>';print_r($customer);die;
        
        /************** VARIOUS SEARCH STRATEGIES ***************/
        
//        $customer = \FutureFoam\Model\Customer::find('City = "name"');
//        $customer = \FutureFoam\Model\Customer::find(array(
//                    "CustNum = '1'",
//                    "order" => "CustNum",
//                    "limit" => 10
//        ));
        
//        $customers = \FutureFoam\Model\Customer::query()
//                    ->where("City = :city:")
//                    ->andWhere("CustNum < 2000")
//                    ->bind(["city" => "mechanical"])
//                    ->order("City")
//                    ->execute();
//           $customers = \FutureFoam\Model\Customer::find(
//                           [
//                            "City = :name: AND CustNum = :type:",
//                            "bind" => [
//                                "name" => "Robotina",
//                                "type" => "maid",
//                            ],
//                        ]
//        );
//        $group = \FutureFoam\Model\Customer::count(
//                        [
//                            "group" => "City",
//                            "order" => "CustNum",
//                        ]
//        );

//PENDING : NESTED MODEL - SAVE & UPDATE

//NESTED MODEL - UPDATE



/*$customer = \FutureFoam\Model\Customer::findFirst(987654327);



//$customer = new \FutureFoam\Model\Customer();

//$customer->CustNum = 216301;
//$customer->Name = 'Q3123';
//$customer->EmailAddress = 'test123@example.com';

$customer->Fax = '123456789';


$result = $this->db->query("SELECT MAX(BillToId) 'max' FROM PUB.BillTo");
$result->setFetchMode(Phalcon\Db::FETCH_ASSOC);
$billToResult = $result->fetch();

$billTo = new \FutureFoam\Model\BillTo();
$billTo->BillToID = $billToResult['max'] + 1;
$billTo->Customer = $customer;
$billTo->Name = 'Testname';
$billTo->CustNum = 987654327;
$billTo->Contact = 'Testcontact';

//$customer->Bills = array($billTo);

//echo '<pre>';print_r($customer);die;

$billTo->save(); */



//NESTED MODEL - SAVE
      
           /* $array = json_decode('{
  "data": [
    {
      "name": "Test123456",
      "emailaddress": "test123456@example.com",
      "fax": "123445",
      "bills": {
        "1": {"BillToID":"35","Name":"Bill1","Contact":"Contact1"},
        "2": {"BillToID":"36","Name":"Bill2","Contact":"Contact2"}
        }
    }
    ]
}',true);

            $Customerdata = $array['data'];
            
            if(!empty($Customerdata))
            {
                foreach($Customerdata as $key=>$data)
                {
                    $result = $this->db->query("SELECT MAX(CustNum) 'max' FROM PUB.Customer");
                    $result->setFetchMode(Phalcon\Db::FETCH_ASSOC);
                    $custNumResul = $result->fetch();

                    $newCustomerId = $custNumResul['max'] + 1;

                    $bills = $data['bills'];

                    $i = 0;
                    $billDetails = [];
                    foreach($bills as $key2=>$billInfo)
                    {
                        $billDetails[$i] = new \FutureFoam\Model\BillTo();
                        $billDetails[$i]->BillToID = $billInfo['BillToID'];
                        $billDetails[$i]->CustNum = $newCustomerId;
                        $billDetails[$i]->Name = $billInfo['Name'];
                        $billDetails[$i]->Contact = $billInfo['Contact'];
                        $i++;

                    }

                    $customer = new \FutureFoam\Model\Customer();
                    $customer->CustNum = $newCustomerId;
                    $customer->Name = $data['name'];
                    $customer->EmailAddress = $data['emailaddress'];
                    $customer->Fax = $data['fax'];
                    $customer->Bills = $billDetails;

                    $customer->save();


                }

            } */
        



/*
$billTo1 = new \FutureFoam\Model\BillTo();
$billTo1->BillToID = '18';
$billTo1->CustNum = '2153';
$billTo1->Name = 'NameTest';
$billTo1->Contact = 'ContactTest';

$billTo2 = new \FutureFoam\Model\BillTo();
$billTo2->BillToID = '19';
$billTo2->CustNum = '2117';
$billTo2->Name = 'NameTest2';
$billTo2->Contact = 'ContactTest2';

$billToEleemnets = array($billTo1,$billTo2);

$result = $this->db->query("SELECT MAX(CustNum) 'max' FROM PUB.Customer");
$result->setFetchMode(Phalcon\Db::FETCH_ASSOC);
$custNumResul = $result->fetch();

$newCustomerId = $custNumResul['max'] + 1;

$customer = new \FutureFoam\Model\Customer();
$customer->CustNum = $newCustomerId;
$customer->Name = 'Test123456';
$customer->EmailAddress = 'test123456@example.com';
$customer->Fax = '12344556';
$customer->Bills = $billToEleemnets;

$customer->save();*/


/*$result = $this->db->query("SELECT MAX(CustNum) 'max' FROM PUB.Customer");
$result->setFetchMode(Phalcon\Db::FETCH_ASSOC);
$custNumResul = $result->fetch();

$customer = new \FutureFoam\Model\Customer();
$customer->CustNum = $custNumResul['max'] + 1;
$customer->Name = 'Test1234';
$customer->EmailAddress = 'test1234@example.com';
$customer->Fax = '123445';


if(!$customer->save()) {

    foreach($customer->getMessages() as $message)
    {
        echo $message.'<br/>';
    }
    
    $result = $this->db->query("SELECT MAX(BillToId) 'max' FROM PUB.BillTo");
    $result->setFetchMode(Phalcon\Db::FETCH_ASSOC);
    $billToResult = $result->fetch();

    $billTo = new \FutureFoam\Model\BillTo();
    $billTo->BillToID = $billToResult['max'] + 1;
    $billTo->CustNum = $customer->CustNum;
    $billTo->Name = 'Name : '.$billTo->CustNum.'--'.rand();
    $billTo->Contact = 'Contact :'. $billTo->CustNum.'--'.rand();

    if(!$billTo->save()) {
        foreach($billTo->getMessages() as $message) {
            echo $message.'<br/>';
        }
    }

}*/

/*$billTo = \FutureFoam\Model\BillTo::findFirst([
                            "BillToID = :billtoid:",
                            "bind" => [
                                "billtoid" => "14",
                            ],
                        ]);

    $billTo->Name = 'Updated';
    $billTo->Contact = 'Contacted';

    $billTo->save();*/

//NESTED MODEL - UPDATE

/*$customer = \FutureFoam\Model\Customer::findFirst([
                            "CustNum = :customerid:",
                            "bind" => [
                                "customerid" => "2117",
                            ],
                        ]);

$customer->Fax = '123456';


if($customer->update())
{
    $billTo = \FutureFoam\Model\BillTo::findFirst([
                            "BillToID = :billtoid:",
                            "bind" => [
                                "billtoid" => "14",
                            ],
                        ]);

    $billTo->Name = 'Updated';
    $billTo->Contact = 'Contacted';

    if(!$billTo->update()) {
        foreach($billTo->getMessages() as $message) {
            echo $message.'<br/>';
        }
    }

}*/


        echo PHP_EOL;
        die('script completed');
    }

}

