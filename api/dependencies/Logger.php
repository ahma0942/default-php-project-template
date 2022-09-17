<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log
{
    /**
     * @var Logger[]
     */
    private $loggers = [];

    public function __construct()
    {
        foreach (LOGGERS::array() as $logger) {
            $this->loggers[$logger] = new Logger($logger);
            $this->loggers[$logger]->pushHandler(new StreamHandler("logs/$logger.log"));
        }
    }

    public function log($message, $data = [], $log = LOGGERS::misc, $level = LEVELS::info)
    {
        if (!in_array($log, LOGGERS::array())) {
            $this->loggers['misc']->error("Could not find logger: $log");
        }

        if (!in_array($level, LEVELS::array())) {
            $this->loggers['misc']->error("Could not find logger level: $level");
        }

        $this->loggers[$log]->$level($message, $data);
        error_log($message);
        if (DI::env('ENV') != "LOCAL") {
            DI::discord()->error($message, $data);
        }
    }
}

abstract class LOGGERS
{
    const email = 'email';
    const sms = 'sms';
    const database = 'database';
    const php = 'php';
    const misc = 'misc';

    static function array() {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }
}

abstract class LEVELS
{
    const debug = 'debug';
    const info = 'info';
    const notice = 'notice';
    const warning = 'warning';
    const error = 'error';
    const critical = 'critical';
    const alert = 'alert';
    const emergency = 'emergency';

    static function array() {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }
}
