<?php
class Logger {
    private $logFile;
    private $logLevel;
    private $confile;
    const DEBUG = 100;
    const INFO = 75;
    const NOTICE = 50;
    const WARNING = 25;
    const ERROR = 10;
    const CRITICAL = 5;

    private function __construct() {
        $this->logLevel = 100;
        $this->logFile = "logmessage.txt";
        echo "File" . $this->logFile;
        $this->confile = fopen($this->logFile, 'a+');
        if (!is_resource($this->confile)) {
            printf("No puedo abrir el fichero %s", $this->logFile);
            return false;
        }
        echo " Fichero abierto!";
    }

    public static function getInstance() {
        static $objLog;
        if (!isset($objLog)) {
            $objLog = new Logger(); // Fix typo here
        }
        return $objLog;
    }

    public function __destruct() {
        if (is_resource($this->confile)) {
            fclose($this->confile);
        }
    }

    public function logMessage($msg, $loglevel = Logger::INFO) {
        if ($loglevel > $this->logLevel) { // Fix typo in logLevel
            return false;
        }
        date_default_timezone_set('America/New_York');
        $formatterDate = DateTimeImmutable::createFromFormat('U', time());
        $time = $formatterDate->format('Y-m-d H:i:s');

        $msg = str_replace("\t", "", $msg); // Fix variable name here
        $msg = str_replace("\n", "", $msg); // Fix variable name here

        $strloglevel = $this->levelToString($loglevel);

        $message = $time . "\t" . $strloglevel . "\t" . $msg . "\n";
        fwrite($this->confile, $message);
    }

    public static function levelToString($loglevel = null) {
        switch ($loglevel) {
            case Logger::DEBUG:
                return 'DEBUG';
                break;
            case Logger::INFO:
                return 'INFO';
                break;
            case Logger::NOTICE:
                return 'NOTICE';
                break;
            case Logger::WARNING:
                return 'WARNING';
                break;
            case Logger::ERROR:
                return 'ERROR';
                break;
            case Logger::CRITICAL:
                return 'CRITICAL';
                break;
            default:
                return '[OTHER]';
                break;
        }
    }
}

$log = Logger::getInstance();
$log->logMessage('Texto a registrar', Logger::DEBUG);