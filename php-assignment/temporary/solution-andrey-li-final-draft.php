<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

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

$testData2 = "Request=Credit Card.Auth Only&Version=4022&HD.Network_Status_Byte=*&HD.Application_ID=TZAHSK!&HD." . "Terminal_ID=12991kakajsjas&HD.Device_Tag=000123&07." . "POS_Entry_Capability=1&07.PIN_Entry_Capability=0&07.CAT_Indicator=0&07." . "Terminal_Type=4&07.Account_Entry_Mode=1&07.Partial_Auth_Indicator=0&07.Account_Card_Number=" . "4242424242424242&07.Account_Expiry=1024&07.Transaction_Amount=142931&07." . "Association_Token_Indicator=0&17.CVV=200&17.Street_Address=123 Road SW&17.Postal_Zip_Code=90210&17.Invoice_Number=INV19291";

$testData3 = '{
    "MsgTypId": 111231232300,
    "CardNumber": "4242424242424242",
    "CardExp": "1024",
    "CardCVV": "240",
    "TransProcCd": "004800",
    "TransAmt": "57608",
    "MerSysTraceAudNbr": "456211",
    "TransTs": "180603162242",
    "AcqInstCtryCd": "840",
    "FuncCd": "100",
    "MsgRsnCd": "1900",
    "MerCtgyCd": "5013",
    "AprvCdLgth": "6",
    "RtrvRefNbr": "1029301923091239"
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

/* based on given data(such as JSON, XML formats) I considered potential using of similar_text(), levenshtein(), json_decode()/json_encode() */

//some optional fields to parse
$parseFields = array(
    "amt",
    "amount",
    "city",
    "Address",
);

function hideSensitiveInfo($data, $parseFields)
{
    $delimiter = ' ';
    $isXML = false;

    // verify if data has xml format
    if (preg_match('/\?xml/', $data)) {
        $isXML = true;
    }

    // assign a delimiter type to convert data string into an array
    if (preg_match('/[,]/', $data)) {
        $delimiter = ',';
    } elseif (preg_match('/[&]/', $data)) {
        $delimiter = '&';
    } else {
        $delimiter = "\n";
    }

    switch ($delimiter) {
        case ',':
            $lines = explode(",", $data);
            break;
        case '&':
            $lines = explode("&", $data);
            break;
        default:
            $lines = explode("\n", $data);
            break;
    }

    // keywords of default fields to be parsed, credit card numbers will be processed separately
    $sensitiveInfo = array(
        "exp",
        "expiry",
        "cvv",
        "CVV",
    );

    // take optional parse data types and add it to array of default credit card data types
    $sensitiveInfo = array_merge($sensitiveInfo, $parseFields);

    //=======================================
    // check credit card number first
    //=======================================

    // loop through the lines and check for credit card information keywords as well as if theres any matches in $parseFields
    for ($currLine = 0; $currLine < count($lines); $currLine++) {
        //find "card" as part of card number
        $cardPos = strpos(strtolower($lines[$currLine]), "card");

        // if "card" is in the line, we check if "number" is also present
        if ($cardPos > 0) {
            $numberPos = strpos(strtolower($lines[$currLine]), "number");

            if ($numberPos > 0) {
                // initial length value
                $numberLength = 0;

                // grabs all numbers in the line and throws them in an array
                preg_match_all('!\d+!', $lines[$currLine], $matches);
                // grabs all equal signs in the line and throws them in an array. Keys and values divided by "=", are processed separately
                preg_match_all('/=[^>]/', $lines[$currLine], $matchVal);

                // mask card numbers
                if (count($matchVal[0]) > 0) {
                    $numberLength = strlen($matches[0][1]);
                    $lines[$currLine] = str_replace($matches[0][1], str_repeat('*', $numberLength), $lines[$currLine]);
                } else {
                    foreach ($matches[0] as $key => $value) {
                        $digits = $value;
                        $numberLength = strlen($digits);
                        $lines[$currLine] = str_replace($digits, str_repeat('*', $numberLength), $lines[$currLine]);
                    }
                }
            }
        }

        //=======================================
        // credit card number check completed
        //=======================================

        //=======================================
        // other required fields masking
        //=======================================

        for ($i = 0; $i < count($sensitiveInfo); $i++) {
            // current type of data we are looking to parse
            $currsensitiveInfo = strtolower($sensitiveInfo[$i]);
            // check to see if current parsing field exists on current line
            if (strpos(strtolower($lines[$currLine]), $currsensitiveInfo) > 0) {
                // XML format is processed separately
                if ($isXML === true) {
                    $string_data = $lines[$currLine];
                    $xml = simplexml_load_string($string_data);
                    $xmlVal = (string) $xml;
                    $hash = str_repeat("*", strlen($xmlVal));
                    $lines[$currLine] = str_replace($xmlVal, $hash, $lines[$currLine]);
                    array_shift($sensitiveInfo);
                } else {
                    // data is masked depending on how key and value divided
                    if (stripos($lines[$currLine], '=>') !== false) {
                        $newArr = explode('=>', $lines[$currLine]);
                        $hash = str_repeat("*", strlen($newArr[1]) - 1);
                        $lines[$currLine] = str_replace($newArr[1], $hash, $lines[$currLine]);
                    } elseif (stripos($lines[$currLine], '=') !== false) {
                        $newArr = explode('=', $lines[$currLine]);
                        $hash = str_repeat("*", strlen($newArr[1]));
                        $lines[$currLine] = str_replace($newArr[1], $hash, $lines[$currLine]);
                    } else {
                        $newArr = explode(':', $lines[$currLine]);
                        preg_match_all('/[^"]*[^"]/', $newArr[1], $onlyVal);
                        $hash = str_repeat("*", strlen($onlyVal[0][1]));
                        $lines[$currLine] = str_replace($onlyVal[0][1], $hash, $lines[$currLine]);
                    }
                    array_shift($sensitiveInfo);
                }
            }
        }
    }

    //==============================================
    // other required fields masking completed
    //==============================================

    //===========================================================
    // convert final array into string and print the result
    //===========================================================

    $result = '';
    foreach ($lines as $line) {
        $result .= $line . $delimiter;
    }
    print_r($result);
    return (string) $result;

    //=============================================================
    // final array converted into string and the result is printed
    //=============================================================
}

hideSensitiveInfo($testData1, $parseFields);
echo "\n";
hideSensitiveInfo($testData2, $parseFields);
echo "\n";
hideSensitiveInfo($testData3, $parseFields);
echo "\n";
hideSensitiveInfo($testData4, $parseFields);
?>

</body>
</html>