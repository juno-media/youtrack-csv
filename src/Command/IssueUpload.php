<?php
namespace Juno\Command;

use Buzz\Browser;
use Buzz\Client\Curl;
use Ddeboer\DataImport\Reader\CsvReader;
use Ddeboer\DataImport\Workflow;
use Guzzle\Http\Client;
use Juno\DataImport\Writer\IssueWriter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class IssueUpload extends Command
{

    protected $client;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->client = new Client();
    }

    protected function configure()
    {
        $this->setName('issue:upload')
            ->addArgument('file', \Symfony\Component\Console\Input\InputArgument::REQUIRED, 'CSV File')
            ->setDescription('Upload CSV issues');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $reader = new CsvReader(new \SplFileObject($input->getArgument("file")));
        $reader->setHeaderRowNumber(0);
        $workflow = new Workflow($reader);
        $workflow->addWriter(new IssueWriter($this->client));
        $workflow->process();

    }

}