<?php

namespace Juno\Command;

use Buzz\Browser;
use Buzz\Client\Curl;
use Guzzle\Plugin\Cookie\Cookie;
use Guzzle\Plugin\Cookie\CookieJar\FileCookieJar;
use Guzzle\Plugin\Cookie\CookiePlugin;
use Guzzle\Service\Client;
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
        $this->client = new Client();
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

        $uri = $input->getArgument("uri");
        $username = $input->getArgument("username");
        $password = $input->getArgument("password");

        $request = $this->client->post("http://".$uri."/rest/user/login",array(),["login"=>$username,"password"=>$password]);

        $response = $request->send();

        if ($response->getStatusCode() == 200) {

            echo "Successfully logged in.\n";

            $jar = new FileCookieJar("/Users/joeshiels/Desktop/cookies.json");

            $jar->addCookiesFromResponse($response, $request);

        }else {
            echo "You entered the wrong information.\n";
        }

    }


}