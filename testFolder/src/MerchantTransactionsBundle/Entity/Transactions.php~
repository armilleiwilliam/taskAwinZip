<?php

namespace MerchantTransactionsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Transactions
 *
 * @ORM\Table(name="transactions")
 * @ORM\Entity(repositoryClass="MerchantTransactionsBundle\Repository\TransactionsRepository")
 */
class Transactions
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Merchants" )
     * @JoinColumn(name="merchant_id", referencedColumnName="id")
     */
    private $merchants;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Currencies" )
     * @JoinColumn(name="currency_id", referencedColumnName="id")
     */
    private $currencies;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="date")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="decimal", precision=8, scale=2)
     */
    private $value;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return Transactions
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set merchants
     *
     * @param integer $merchants
     *
     * @return Transactions
     */
    public function setMerchants($merchants)
    {
        $this->merchants = $merchants;

        return $this;
    }

    /**
     * Get merchants
     *
     * @return integer
     */
    public function getMerchants()
    {
        return $this->merchants;
    }

    /**
     * Set currencies
     *
     * @param integer $currencies
     *
     * @return Transactions
     */
    public function setCurrencies($currencies)
    {
        $this->currencies = $currencies;

        return $this;
    }

    /**
     * Get currencies
     *
     * @return integer
     */
    public function getCurrencies()
    {
        return $this->currencies;
    }

    /**
     * @return mixed
     */
    public function __toString() {
        return 'Transactions';
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Transactions
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
