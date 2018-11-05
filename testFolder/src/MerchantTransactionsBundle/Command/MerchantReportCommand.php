<?php
// src/MerchantTransactionsBundle/Command
namespace MerchantTransactionsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Question\Question;
use MerchantTransactionsBundle\Entity\Transactions;

/**
 * Class BattleCommand
 * @package AppBundle\Command
 */
class MerchantReportCommand extends ContainerAwareCommand
{
    // Messages to be returned
    const FIRST_QUESTION = 'Please, enter the id number or the brand name to see the list of its 
    transactions in POUND currency:';
    const REQUIRED_VALUE = 'Please, insert a valid id or brand name.';
    const THERE_ARE_NO_TRANSACTIONS_TO_SHOW = "There are no transactions to show.";
    const THE_FOLLOWING_IS_THE_LIST_OF_TRANSACTIONS = 'The following is the list of transactions:';
    const WELCOME_TO_REPORTS_GENERATOR = 'WELCOME TO REPORTS GENERATOR';
    const THERE_IS_NO_TRANSACTION_TO_SHOW_OR_THIS_CLIENT_IS_NO_EXISTING = 'There is no transaction to show for
    this brand or the brand is no existing.';
    const COLON = ":";
    const LIST_OF_TRANSACTIONS_FOR = "List of transactions for ";
    const TOTAL_TRANSACTIONS = "Total transactions: ";
    const POUNDS = "  POUNDS";

    /**
     * @var
     */
    private $exceptionHandler;

    protected function configure()
    {
        $this
            ->setName('demo:generateReport')
            ->setDescription('Generate reports')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // set style for titles
        $style = new OutputFormatterStyle(
            'red',
            'yellow',
            ['bold', 'blink']
        );

        // set the exception handler
        $this->exceptionHandler = $this->getContainer()->get('MerchantTransactions.classes.exception_handler');

        // get currency list
        $this->currency = $this->getContainer()->get('MerchantTransactions.classes.currencies_handler');

        $output->getFormatter()->setStyle('fireTwo', $style);

        // welcome message
        $output->writeln([
            '<fireTwo>',
            ' ____   ____  _____   _____   _____   _______  _______ ',
            '|    \ |      |    | |     |  |    \     |    |        ',
            '|    / |      |    | |     |  |    /     |    |        ',
            '|====  |==    |____| |     |  |====      |     ======  ',
            '|    \ |      |      |     |  |    \     |           | ',
            '|     ||____  |      |_____|  |     |   _|_   _______| ',
            '                                                       ',
            '',
            '</fireTwo>',
            self::WELCOME_TO_REPORTS_GENERATOR,
            '============================================================',
            '',
            self::THE_FOLLOWING_IS_THE_LIST_OF_TRANSACTIONS,
        ]);

        // get al transactions and show them
        $getTransactions = $this->getContainer()->get('doctrine')->getRepository(Transactions::class)
            ->showAllTransactions();

        // show transactions
        if($getTransactions && count($getTransactions) > 0) {

            // loop
            foreach ($getTransactions as $getTrans) {
                $output->writeln($getTrans->getMerchants()->getId() . " " . $getTrans->getMerchants()->getName()
                    . " " . $getTrans->getValue() . " " . $getTrans->getCurrencies()->getName());
            }
        } else {
            $output->writeln(self::THERE_ARE_NO_TRANSACTIONS_TO_SHOW);
        }

        // empty line
        $output->writeln('');

        // ask to see the list of transactions per client given the id / name
        $question = new Question("<question>" . self::FIRST_QUESTION . "</question>\n");

        $helper = $this->getHelper('question');

        $insertedValue = $helper->ask($input, $output, $question);

        // if value required inserted I proceed
        if($insertedValue !== "" && $insertedValue !== NULL){
            // get al transactions and show them
            $getBrandTransactions = $this->getContainer()->get('doctrine')->getRepository(Transactions::class)
                ->showAllTransactionsByIdOrName($insertedValue);

            // show list of transactions per brand chosen
            if($getBrandTransactions && count($getBrandTransactions) > 0) {
                // header
                $output->writeln(['',
                        self::LIST_OF_TRANSACTIONS_FOR . $getBrandTransactions[0]->getMerchants()
                        ->getName() . self::COLON
                ]);

                // loop
                foreach ($getBrandTransactions as $getTrans) {
                    $output->writeln($getTrans->getMerchants()->getId() . " " . $getTrans->getMerchants()->getName()
                    . " " . $this->currency->currencyHandler($getTrans->getCurrencies()->getId(), $getTrans->getValue())
                    . self::POUNDS);
                }

                // footer
                $output->writeln(self::TOTAL_TRANSACTIONS . count($getBrandTransactions));
            } else {
                $output->writeln(self::THERE_IS_NO_TRANSACTION_TO_SHOW_OR_THIS_CLIENT_IS_NO_EXISTING);
            }
        } else {
            $this->exceptionHandler->exceptionHandler(
                self::REQUIRED_VALUE
            );
        }
    }
}
