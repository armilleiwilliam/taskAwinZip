<?php
namespace AppBundle\Report\Advertiser;

interface TransactionsInterface
{
    public function showAllFinalTransactions(): void;
    public function showAllInitialTransactions(): void;
}