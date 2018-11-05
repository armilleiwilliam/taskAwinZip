<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 17/01/2018
 * Time: 14:59
 */

namespace MerchantTransactionsBundle\Classes;

use MerchantTransactionsBundle\Classes\ExceptionHandler;

class ExceptionHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function exceptionHandlerTest()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->exceptionHandler->exceptionHandler(
            self::REQUIRED_VALUE
        );
    }
}
