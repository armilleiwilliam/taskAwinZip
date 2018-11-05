<?php

namespace MerchantTransactionsBundle\Classes;

/**
 * Class ExceptionHandler
 */
class ExceptionHandler
{
    /**
     * @param string $exceptionMessage
     *
     * @return \Exception
     * @throws \Exception
     */
    public function exceptionHandler(string $exceptionMessage): \Exception
    {
        if ($exceptionMessage !== '') {
            throw new \Exception($exceptionMessage);
        }
        throw new \Exception('No exception string set!');
    }
}
