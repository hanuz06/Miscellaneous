<?php

$testData1 = "[orderId] => 212939129
[orderNumber] => INV10001
[salesTax] => 1.00
[amount] => 21.00
[terminal] => 5
[currency] => 1
[type] => purchase
[avsStreet] => 123 Road
[avsZip] => A1A 2B2
[customerCode] => CST1001
[cardId] => 18951828182
[cardHolderName] => John Smith
[cardNumber] => 5454545454545454
[cardExpiry] => 1025
[cardCVV] => 100";

$testData2 = "Request=Credit Card.Auth Only&Version=4022&HD.Network_Status_Byte=*&HD.Application_ID=TZAHSK!&HD."
        . "Terminal_ID=12991kakajsjas&HD.Device_Tag=000123&07."
        . "POS_Entry_Capability=1&07.PIN_Entry_Capability=0&07.CAT_Indicator=0&07."
        . "Terminal_Type=4&07.Account_Entry_Mode=1&07.Partial_Auth_Indicator=0&07.Account_Card_Number="
        . "4242424242424242&07.Account_Expiry=1024&07.Transaction_Amount=142931&07."
        . "Association_Token_Indicator=0&17.CVV=200&17.Street_Address=123 Road SW&17.Postal_Zip_Code=90210&17.Invoice_Number=INV19291";

$testData3 = '{
        "MsgTypId": 111231232300,
        "CardNumber": "4242424242424242",
        "CardExp": 1024,
        "CardCVV": 240,
        "TransProcCd": "004800",
        "TransAmt": "57608",
        "MerSysTraceAudNbr": "456211",
        "TransTs": "180603162242",
        "AcqInstCtryCd": "840",
        "FuncCd": "100",
        "MsgRsnCd": "1900",
        "MerCtgyCd": "5013",
        "AprvCdLgth": "6",
        "RtrvRefNbr": "1029301923091239",
    }';

$testData4 = "<?xml version='1.0' encoding='UTF-8'?>
    <Request>
        <NewOrder>
            <IndustryType>MO</IndustryType>
            <MessageType>AC</MessageType>
            <BIN>000001</BIN>
            <MerchantID>209238</MerchantID>
            <TerminalID>001</TerminalID>
            <CardBrand>VI</CardBrand>
            <CardDataNumber>5454545454545454</CardDataNumber>
            <Exp>1026</Exp>
            <CVVCVCSecurity>300</CVVCVCSecurity>
            <CurrencyCode>124</CurrencyCode>
            <CurrencyExponent>2</CurrencyExponent>
            <AVSzip>A2B3C3</AVSzip>
            <AVSaddress1>2010 Road SW</AVSaddress1>
            <AVScity>Calgary</AVScity>
            <AVSstate>AB</AVSstate>
            <AVSname>JOHN R SMITH</AVSname>
            <OrderID>23123INV09123</OrderID>
            <Amount>127790</Amount>
        </NewOrder>
    </Request>";

$parseNew = array("name", "amt", "amount"); //some optional fields to parse
//this function will take a provided string, $data, and replace all credit card information including 16-digit numbers, expiry dates and 3-digit CVV numbers.
//$parseNew is an optional field to parse other sensitive information that matches the type of information entered into $parseNew, such as the transaction amount.
//if the strings in $parseNew matches any field in the data given, then that data will be parsed as well
//assign each piece of given test data to a variable for each to be passed into tester()

function tester($data, $parseNew)
{
    $delimiter=' ';

    // $lines = explode("\n", $data); //split data by new lines into an array

    // print_r(count($lines));

    
    // if (preg_match('/[,]/', $data)) {
        //     $delimiter = ',';
        // } else {
            //     $delimiter = '\n';
            // }          

    switch ($delimiter) {
        case ',':
            $lines = explode(",", $data);
            break;
        case '\n':
            $lines = explode("\n", $data);
            break;        
        default:
        $lines = explode(".", $data);
        break;
    }

    if (count($lines) == 1) { //if there aren't any new lines, then periods are used
        $lines = explode(".", $data); //different splits can also be added with another if, like a ,
        //print_r($lines);
    }

    // print_r($lines);

    $senseInfo = array("cvv", "CVV", "exp", "expiry", "Exp"); //keywords of default fields to be parsed, credit card numbers need to be searched for differently

    $senseInfo = array_merge($senseInfo, $parseNew); //take optional parse data types and add it to array of default credit card data types
    //checking credit card number first


    for ($currLine = 0; $currLine < count($lines); $currLine++) { //loop through the lines and check for credit card information keywords as well as if theres any matches in $parseNew

        $cardPos = strpos($lines[$currLine], "card"); //find "card" as part of Card Number

        if ($cardPos === false) {
            $cardPos = strpos($lines[$currLine], "Card");
        } 

        if ($cardPos > 0) { //if "card" is in the line, we check if "number" is also
            $numberPos = strpos($lines[$currLine], "Number");

            if ($numberPos === false) {
                $numberPos = strpos($lines[$currLine], "number");
            }

            if ($numberPos > 0) {
                $numberLength = 0;

                $matches = array();
                preg_match_all('!\d+!', $lines[$currLine], $matches); //grabs all numbers in the line and throws them in an array

                $digits = $matches[0]; //unpack array inside matches array

                print_r($digits);

                // $lines[$currLine] = str_replace($theNumber, "****************", $lines[$currLine]);

                // for ($i = 0; $i < count($digits); $i++) {

                //     if (strlen($digits[$i]) == 16) {

                //         $theNumber = $digits[$i];
                //         $numberLength = strlen($digits[$i]);
                //     }
                // }

                // if ($numberLength == 16) { //when all of these things are true then this number is definitely a credit card number

                //     $lines[$currLine] = str_replace($theNumber, "****************", $lines[$currLine]);
                //     //print_r($lines);
                // }

                
            }
        }

        //credit card number check complete

        //now to check for everythign else
        for ($i = 0; $i < count($senseInfo); $i++) {

            $currNono = $senseInfo[$i]; //current type of data we are looking to parse

            if (strpos($lines[$currLine], $currNono) > 0) { //check to see if current parsing field exists on current line

                preg_match_all("/\d+\.\d+|\d+|[A-Za-z]+/", $lines[$currLine], $matches);
                $sensData = $matches[0]; //unpack array from wihtin another array

                // print_r($sensData);

                for ($f = 0; $f < count($sensData); $f++) { //if we find any fields we want to parse

                    // if (strcmp($sensData[$f], $currNono) == true && $f + 1 != count($sensData)) {

                    //     $hash = str_repeat("*", strlen($sensData[$f + 1]));
                    //     $lines[$currLine] = str_replace($sensData[$f + 1], $hash, $lines[$currLine]);
                    // }
                    if ($f > 0 && $f < count($sensData)-1){
                      $hash = str_repeat("*", strlen($sensData[$f]));
                      $lines[$currLine] = str_replace($sensData[$f], $hash, $lines[$currLine]);
                    }
                }
            }
        }
    }

    //print_r($lines);
}

// echo "Data set 1:\n\n"; //print results
// tester($testData1, $parseNew);
// echo "Data set 2:\n\n";
tester($testData2, $parseNew);
// echo "Data set 3:\n\n";
// tester($testData3, $parseNew);
// echo "Data set 4:\n\n";
// tester($testData4, $parseNew);
