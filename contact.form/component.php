<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arUtm = $this->utmGetSave();

if ($_REQUEST['AJAX_CALL'] == "Y")
{

    if (!empty($arParams['REQUIRED_FIELDS']))
    {
        foreach ($_REQUEST['form_fields'] as $key => $value)
        {
            if (in_array($key, $arParams['REQUIRED_FIELDS']))
            {
                if (empty($value))
                {
                    //TODO:beauty error system
                    $arResult['ERROR'][] = "Заполните все поля";
                }
            }
        }
    }

    if (empty($arResult['ERROR']))
    {
        $this->prepareMessage($_REQUEST['form_fields'], 'MESSAGE');
        $this->prepareMessage($arUtm, 'UTM');
        $this->message['SUBJECT'] = $arParams['SUBJECT'] . ": " . date("d.m.y h:i:s");
        $arResult['SEND_MAIL'] = $this->sendEmail($arParams['EVENT_NAME'], SITE_ID, $this->message);
    }

}

$this->IncludeComponentTemplate();





