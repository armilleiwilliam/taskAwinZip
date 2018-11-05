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
    this brand or the brand is no existing anymore.';
    const COLON = ":";
    const LIST_OF_TRANSACTIONS_FOR = "List of transactions for ";
    const TOTAL_TRANSACTIONS = "Total transactions: ";
    const POUNDS = "  POUNDS";

    /**
     * @var
     */
    private $exceptionHandler;
    private $output;
    private $input;

    protected function configure()
    {
        $this
            ->setName('demo:generateReport')
            ->setDescription('Generate reports');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $this->input = $input;

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
        $this->showIntroductiveMessage($style);
        $this->showAllInitialTransactions();
        $insertedValue = $this->askQuestion(self::FIRST_QUESTION);
        $this->showAllFinalTransactions($insertedValue);
    }

    public function askQuestion(string $question): String
    {
        // ask to see the list of transactions per client given the id / name
        $question = new Question("<question>" . $question . "</question>\n");
        $helper = $this->getHelper('question');

        return $helper->ask($this->input, $this->output, $question);
    }

    public function showAllFinalTransactions(String $insertedValueTransactions): void
    {
        $insertedValue = $insertedValueTransactions;

        // if value required inserted I proceed
        if ($insertedValue !== "" && $insertedValue !== NULL) {

            // get al transactions and show them
            $getBrandTransactions = $this->getContainer()->get('doctrine')->getRepository(Transactions::class)
                ->showAllTransactionsByIdOrName($insertedValue);

            // show list of transactions per brand chosen
            if ($getBrandTransactions && count($getBrandTransactions) > 0) {
                // header
                $this->output->writeln(['',
                    self::LIST_OF_TRANSACTIONS_FOR . $getBrandTransactions[0]->getMerchants()
                        ->getName() . self::COLON
                ]);

                // loop
                foreach ($getBrandTransactions as $getTrans) {
                    $this->output->writeln($getTrans->getMerchants()->getId() . " " . $getTrans->getMerchants()->getName()
                        . " " . $this->currency->currencyHandler($getTrans->getCurrencies()->getId(), $getTrans->getValue())
                        . self::POUNDS);
                }

                // footer
                $this->output->writeln(self::TOTAL_TRANSACTIONS . count($getBrandTransactions));
            } else {
                $this->output->writeln(self::THERE_IS_NO_TRANSACTION_TO_SHOW_OR_THIS_CLIENT_IS_NO_EXISTING);
            }
        } else {
            $this->exceptionHandler->exceptionHandler(
                self::REQUIRED_VALUE
            );
        }
    }

    public function showAllInitialTransactions(): void
    {
        // get al transactions and show them
        $getTransactions = $this->getContainer()->get('doctrine')->getRepository(Transactions::class)
            ->showAllTransactions();

        // show transactions
        if ($getTransactions && count($getTransactions) > 0) {

            // loop
            foreach ($getTransactions as $getTrans) {
                $this->output->writeln($getTrans->getMerchants()->getId() . " " . $getTrans->getMerchants()->getName()
                    . " " . $getTrans->getValue() . " " . $getTrans->getCurrencies()->getName());
            }
        } else {
            $this->output->writeln(self::THERE_ARE_NO_TRANSACTIONS_TO_SHOW);
        }

        // empty line
        $this->output->writeln('');
    }

    public function showIntroductiveMessage(OutputFormatterStyle $style): void
    {
        $this->output->getFormatter()->setStyle('fireTwo', $style);

        // welcome message
        $this->output->writeln([
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
    }
}
