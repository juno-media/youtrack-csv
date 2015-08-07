<?php

namespace Juno\DataImport\Writer;

use Buzz\Browser;
use Buzz\Util\Cookie;
use Buzz\Util\CookieJar;
use Ddeboer\DataImport\Writer\WriterInterface;
use Faker\Provider\File;
use Guzzle\Plugin\Cookie\CookieJar\FileCookieJar;
use Guzzle\Plugin\Cookie\CookiePlugin;
use Guzzle\Service\Client;
use YouTrack\YouTrackCommunicator;

/**
 * Created by PhpStorm.
 * User: joeshiels
 * Date: 05/08/15
 * Time: 09:39
 */

class IssueWriter implements WriterInterface {

    /**
     * Prepare the writer before writing the items
     *
     * @return $this
     */
    public function prepare()
    {
        // TODO: Implement prepare() method.
    }

    /**
     * Write one data item
     *
     * @param array $item The data item with converted values
     *
     * @return $this
     */
    public function writeItem(array $item)
    {
        // TODO: Implement writeItem() method.

        $project = $item["project"];
        $summary = $item["summary"];
        $description = $item["description"];

        $jar = new FileCookieJar("/Users/joeshiels/Desktop/cookies.json");

        $client = new Client();

        $cookie = $jar->all()[0];
        $domain = $cookie->getDomain();
        $path = $cookie->getPath();

        $request = $client->put("http://".$domain.$path."/rest/issue",array(),["project" => $project, "summary" => $summary, "description" => $description]);

        foreach($jar->all() as $cookie) {
            $request->addCookie($cookie->getName(), $cookie->getValue());
        }

        $response = $request->send();

        if ($response->getStatusCode() == 201) {
            echo "Successfully created the issues.";
        }else {
            echo "Something went wrong.";
        }

    }

    /**
     * Wrap up the writer after all items have been written
     *
     * @return $this
     */
    public function finish()
    {
        // TODO: Implement finish() method.
    }
}