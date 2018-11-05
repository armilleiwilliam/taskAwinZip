<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 17/01/2018
 * Time: 14:19
 */

namespace MerchantTransactionsBundle\Classes;

use MerchantTransactionsBundle\Classes\CurrenciesHandler;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class CurrenciesHandlerTest
 * @package MerchantTransactionsBundle\Classes
 */
class CurrenciesHandlerTest extends WebTestCase
{
    static $client;

    /**
     * $entityManager, object
     * $curr, object
     */
    public function testCurrencyHandler()
    {
        // set the client
        $client = static::createClient();

        // Get an entity manager
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        // set the class
        $curr = new CurrenciesHandler($entityManager);

        // get the result
        $result = $curr->currencyHandler(1, 55.90);

        // match the values
        $this->assertEquals(34.94, $result);
    }
}
