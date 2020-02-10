<!-- Please send a .php file containing a function that achieves the following:

A string parameter is passed to the function – attached are various samples of possible input data
-The function receives this data as a string, not an array, JSON or other data formats
-The function should parse the string and mask sensitive data.
-Sensitive data should be masked (replaced) with an Asterix (*) character.
-Number of (*) should match the original number of characters in that sensitive data.
-Sensitive data includes the fields below, but new sensitive fields should be easily added to the function as needed:

The credit card number
The credit card expiry date
The credit card CVV value

The function returns the parsed string in the same format that it was provided, but with the sensitive data now masked.

We are looking for clean, commented code and a smart approach to problem solving.
Thank you for your interest and we look forward to your reply. -->

<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<!-- <?php
// echo "Hello World!";
?> -->


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
                          <CardDataNumber>5454545454545454</AccountNum>
                          <Exp>1026</Exp>
                          <CVVCVCSecurity>300</Exp>
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

/*
this function will take a provided string, $data, and replace all credit card information including 16-digit numbers, expiry dates and 3-digit CVV numbers.
$parseNew is an optional field to parse other sensitive information that matches the type of information entered into $parseNew, such as the transaction amount.
if the strings in $parseNew matches any field in the data given, then that data will be parsed as well assign each piece of given test data to a variable for each to be passed into helcimTest. Because of the variance of the data,
matches must be made with expected keywords.
 */

function tester($data)
{

    $parseNew = array("CardDataNumber", "CardNumber", "Card_Number", "exp", "expir", "CVVCVCSecurity", "cvv"); //some optional fields to parse
    $nonos = array("amount"); //keywords of default fields to be parsed, credit card numbers need to be searched for differently
    $nonos = array_merge($nonos, $parseNew); //take optional parse data types and add it to array of default credit card data types

    preg_match_all('~&\d+(?:\.\d+)?|[\w ./]+~', $data, $matches);
    $results = $matches[0]; //grabs only the keywords and the data from the test data and is ordered in a predictable manner

    $cleanResults = array_filter(array_map('trim', $results), 'strlen'); //
    //above regex pattern includes spaces but makes elements or array carry a single whitespace
    //clean out all whitespace to amek life easier

    foreach ($cleanResults as &$val) { //clean up results even more of unwanted character
        if (substr($val, 0, 1) === '.') {
            $val = ltrim($val, ".");
        }
    }

    print_r($cleanResults);

    for ($currRes = 0; $currRes < sizeof($cleanResults); $currRes++) {

        for ($currNono = 0; $currNono < sizeof($nonos); $currNono++) {

            echo "Current Result: ";
            echo $cleanResults[$currRes];
            echo "\n";
            echo "Current nono : ";
            echo $nonos[$currNono];
            echo "\n";
            echo "Match result: ";
            $compres = stripos($cleanResults[$currRes], $nonos[$currNono]);
            print_r($compres);
            echo "\n";
            echo "\n";

            if (stripos($cleanResults[$currRes], $nonos[$currNono]) !== false) { //if keyword with data to be parsed is found inside the regex results
                $len = strlen($cleanResults[$currRes + 1]); //get length of the data in front of it
                $hash = str_repeat("*", $len); //make hash version with same number of characters
                //$nonoPos = stripos($cleanResults[$currRes], $data);
                $dataPos = stripos($cleanResults[$currRes + 1], $data);

                str_replace($cleanResults[$currRes + 1], $hash, $data);
            }
        }
    }

    print_r($cleanResults);
}

tester($testData1);
echo "\n";
tester($testData2);
echo "\n";
tester($testData3);
echo "\n";
tester($testData4);
echo "\n";
?>

</body>
</html>