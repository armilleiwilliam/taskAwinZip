<?php

namespace MerchantTransactionsBundle\Classes;

use MerchantTransactionsBundle\Entity\Currencies;
use Doctrine\ORM\EntityManager;

/**
 * Class ExceptionHandler
 */
class CurrenciesHandler
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * CurrenciesHandler constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param $currency
     * @param $value
     * @return float|int
     */
    public function currencyHandler($currency, $value)
    {
        if($currency !== "" && $currency !== NULL && $value !== "" && $value !== NULL){
            // currency VALUES
            $currencyValues = $this->em->getRepository(Currencies::class)->find($currency);

            // return pound currency value
            if($currencyValues->getExchangeRate() !== "" && $currencyValues->getExchangeRate() !== NULL){
                return round($value / $currencyValues->getExchangeRate(), 2);
            }

            return $value;
        }
    }
}
