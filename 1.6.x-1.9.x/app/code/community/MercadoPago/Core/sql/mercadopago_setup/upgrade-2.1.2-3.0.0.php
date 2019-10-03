<?php
$installer = $this;
$installer->startSetup();

/**
 * @param $path
 * @return string|null
 */
function getConfig($path)
{
    $resource = Mage::getSingleton('core/resource');
    $readConnection = $resource->getConnection('core_read');
    $query = 'SELECT * FROM ' . $resource->getTableName('core/config_data') . " WHERE path = '{$path}'";
    $row = $readConnection->fetchRow($query);
    if(isset($row['value'])){
        return $row['value'];
    }

    return null;
}

/**
 * @return string|null
 */
function getOldPublicKey()
{
    return getConfig('payment/mercadopago_custom_checkout/public_key');
}

/**
 * @return string|null
 */
function getOldAccessToken()
{
    return getConfig('payment/mercadopago_custom_checkout/access_token');
}

/**
 * @param $testMode
 * @param $accessToken
 * @param $publicKey
 */
function saveNewCredentials($testMode, $accessToken, $publicKey)
{
    $setup = new Mage_Core_Model_Config();
    if ($testMode) {
        $setup->saveConfig('payment/mercadopago/test_mode', 0);
        $setup->saveConfig('payment/mercadopago/public_key_test', $publicKey);
        $setup->saveConfig('payment/mercadopago/access_token_test', $accessToken);
    } else {
        $setup->saveConfig('payment/mercadopago/test_mode', 1);
        $setup->saveConfig('payment/mercadopago/public_key_prod', $publicKey);
        $setup->saveConfig('payment/mercadopago/access_token_prod', $accessToken);
    }
}

//TRATAR CREDENCIAIS
$oldPublicKey = getOldPublicKey();
$oldAccessToken = getOldAccessToken();

if (is_null($oldPublicKey) || is_null($oldAccessToken)) {
    return;
}

if (strpos($oldPublicKey, 'TEST') !== false && strpos($oldAccessToken, 'TEST') !== false) {
    saveNewCredentials(true, $oldAccessToken, $oldPublicKey);
    return;
}

if (strpos($oldPublicKey, 'APP') !== false && strpos($oldAccessToken, 'APP') !== false) {
    saveNewCredentials(false, $oldAccessToken, $oldPublicKey);
    return;
}

//STATEMENT DESCRIPTOR TO STORE NAME
$statement = getConfig('payment/mercadopago_custom/statement_descriptor');
if(!empty($statement)){
    $storeName = getConfig('payment/mercadopago/store_name');
    if(empty($storeName)){
        $setup->saveConfig('payment/mercadopago/store_name', $storeName);
    }
}

$installer->endSetup();