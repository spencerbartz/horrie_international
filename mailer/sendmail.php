<?php
$GLOBALS["params"] = array();
$GLOBALS["headers"] = '';

function multiexplode($delimiters, $string) 
{
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

function validate_text_input($input_data, $field_name)
{
    if(strlen($input_data) > 0)
    {
        return TRUE;
    }
    else
    {
        return "ERROR: \"$field_name\" cannot be blank.";
    }
}

function validate_emails($input_data)
{
    $addresses = multiexplode(array(",",";"), $input_data);
    
    foreach($addresses as $address)
    {
            //filter_var() sanitizes the e-mail address using FILTER_SANITIZE_EMAIL
            $address = filter_var($address, FILTER_SANITIZE_EMAIL);
    
            //filter_var() validates the e-mail address using FILTER_VALIDATE_EMAIL
            if(!filter_var($address, FILTER_VALIDATE_EMAIL))
            {
                return "ERROR: \"$address\" is an invalid email format.";
            }
    }
    
    return TRUE;
}

function validate_input_presence($params)
{
    foreach($params as $key => $param)
    {
        if(strcmp($param, "") === 0 && strcmp($param, "no") !== 0)
        {
            return "ERROR: \"$key\" cannot be left blank.";
        }
    }
    return TRUE;
}

function validate_form_input()
{
    //Grab the address of params in $GLOBALS. Is this necessary?
    $params = &$GLOBALS["params"];
    $params["to"] =           isset($_REQUEST["to"]) ? $_REQUEST["to"] : "";
    $params["from"] =         isset($_REQUEST["from"]) ? $_REQUEST["from"] : "";
    $params["subject"] =      isset($_REQUEST["subject"]) ? $_REQUEST["subject"] : "";
    $params["message"] =      isset($_REQUEST["message"]) ? $_REQUEST["message"] : "";
    $params["bcc_checkbox"] = isset($_REQUEST["bcc_checkbox"]) ? $_REQUEST["bcc_checkbox"] : "no";
    
    $result = validate_input_presence($params);
    if($result !== TRUE)
        return $result;
    
    $result = validate_emails($params["to"]);
    if($result !== TRUE)
        return $result;
    
    $result = validate_emails($params["from"]);
    if($result !== TRUE)
        return $result;
    
    $result = validate_text_input($params["subject"], "subject");
    if($result !== TRUE)
        return $result;
    
    $result = validate_text_input($params["message"], "message");
    if($result !== TRUE)
        return $result;
    
    $bcc_address = "";
    
    //Only validate the BCC address(es) if the checkbox has been checked
    if(strcmp($params["bcc_checkbox"], "yes") === 0)
    {
        $bcc_address = isset($_REQUEST["bcc_input"]) ? $_REQUEST["bcc_input"] : "";
        $result = validate_emails($bcc_address);
        if($result !== TRUE)
            return $result;
    }
    
    $GLOBALS["headers"] = 'From: ' . $params["from"] . "\r\n";
    $GLOBALS["headers"] .= 'Bcc: spencerbartz@gmail.com,' . $bcc_address . "\r\n";
    return TRUE;
}



function main()
{
    
    $form_valid = validate_form_input();
    
    if($form_valid !== TRUE)
    {
        echo $form_valid;
    }
    else
    {
        $params = $GLOBALS["params"];
        $headers = $GLOBALS["headers"];
        
        if(mail($params["to"], $params["subject"], $params["message"], $headers))
        {
    
            echo "Your important message was sent to the following email addresses:\n\n";

            $addresses = multiexplode(array(",", ";"), $params["to"]);

            foreach($addresses as $address)
            {
                    echo $address . "\n";
            }

            echo "Thank you for using our mail form. Have a nice day. HORRIE!!!\n\n";
            //echo "HEADERS: " . $headers . "\n";
        }
        else
        {
            echo "Sorry, an error occurred and your mail was not sent. HORRIE!!!";
        }
    }
}

main();
?>