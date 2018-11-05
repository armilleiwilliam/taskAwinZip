<?php

namespace MerchantTransactionsBundle\Repository;
use bar\foo\baz\Object;

/**
 * TransactionssRepository
 *
 * functions to return queries values
 */
class TransactionsRepository extends \Doctrine\ORM\EntityRepository
{

    // show all transactions and details
    public function showAllTransactions(): Object
    {
        // query
        $allTransactions = $this->createQueryBuilder('d')
            ->leftJoin('MerchantTransactionsBundle\Entity\Currencies','c', 'WITH', 'd.currencies = c.id')
            ->leftJoin('MerchantTransactionsBundle\Entity\Merchants', 'm', 'WITH', 'd.merchants = m.id')
            ->getQuery()
            ->getResult();

        return $allTransactions;
    }

    // show the list of transactions per id or brand name given
    public function showAllTransactionsByIdOrName($idName): Object
    {
        // query
        $allTransactions = $this->createQueryBuilder('d')
            ->leftJoin('MerchantTransactionsBundle\Entity\Currencies','c', 'WITH', 'd.currencies = c.id')
            ->leftJoin('MerchantTransactionsBundle\Entity\Merchants', 'm', 'WITH', 'd.merchants = m.id')
            ->where('m.id = :idName')
            ->orWhere('m.name = :idName')
            ->setParameter(':idName', $idName)
            ->getQuery()
            ->getResult();

        return $allTransactions;
    }
}
