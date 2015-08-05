<?php
namespace Juno\Command;

use Symfony\Component\Console\Command\Command;

class IssueUpload extends Command
{
    protected function configure()
    {
        $this->setName('issue:upload')
            ->addArgument('file', \Symfony\Component\Console\Input\InputArgument::REQUIRED, 'CSV File')
            ->setDescription('Upload CSV issues');
    }
}