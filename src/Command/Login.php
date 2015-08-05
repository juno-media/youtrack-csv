<?php
namespace Juno\Command;

use Buzz\Browser;
use Buzz\Client\Curl;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use YouTrack\YouTrackCommunicator;

class Login extends Command
{
    protected $client;

    public function __construct($name = null)
    {
        parent::__construct($name);

        if (is_null($this->client)) {
            $this->client = new Browser();
            $this->client->setClient(new Curl());
        }
    }

    protected function configure()
    {
        $this->setName('login')
            ->addArgument('uri', InputArgument::REQUIRED, 'YouTrack URL')
            ->addArgument('username', InputArgument::REQUIRED, 'Username')
            ->addArgument('password', InputArgument::REQUIRED, 'Password')
            ->setDescription('Login to YouTrack');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $youtrack = new YouTrackCommunicator($this->client, array(
            'uri' => $input->getArgument('uri'),
            'username'  => $input->getArgument('username'),
            'password'  => $input->getArgument('password')
        ));


    }


}