<?php
if (!class_exists('YouTrackCliBoostrap')) {
    class YouTrackCliBoostrap
    {
        public static function includeIfExists($file)
        {
            if (file_exists($file)) {
                return include $file;
            }
        }
        /**
         * @throws ErrorException
         * @return \Composer\Autoload\ClassLoader
         */
        public static function getLoader()
        {
            if ((!$loader = \YouTrackCliBoostrap::includeIfExists(__DIR__.'/../vendor/autoload.php'))
                && (!$loader = \YouTrackCliBoostrap::includeIfExists(__DIR__.'/../../../autoload.php'))) {
                throw new \ErrorException('You must set up the project dependencies, run the following commands:'.PHP_EOL.
                    'curl -s http://getcomposer.org/installer | php'.PHP_EOL.
                    'php composer.phar install'.PHP_EOL);
            }
            return $loader;
        }
    }
}
try {
    $loader = \YouTrackCliBoostrap::getLoader();
    $application = new \Juno\Application();
    $application->add(new \Juno\Command\IssueUpload());
    $application->add(new \Juno\Command\Login());
    return $application;
} catch (\Exception $e) {
    echo $e->getMessage();
    exit(1);
}