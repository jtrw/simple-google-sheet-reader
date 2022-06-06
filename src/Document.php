<?php

namespace Jtrw\SimpleGoogleSheet;

use Google_Client;
use Google_Service_Sheets;
use Jtrw\SimpleGoogleSheet\Exception\SheetNotFoundException;
use Generator;

class Document
{
    protected string $sheet;
    protected Google_Service_Sheets $serviceSheets;
    
    public function __construct(array $credentials)
    {
        $client = new Google_Client();
    
        $client->setApplicationName('Google Sheets and PHP');
    
        $client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
    
        $client->setAccessType('offline');
    
        $client->setAuthConfig($credentials);
    
        $this->serviceSheets = new Google_Service_Sheets($client);
    }
    
    public function setSheet(string $sheet): self
    {
        $this->sheet = $sheet;
        return $this;
    }
    
    /**
     * @param string $range
     * @return array
     * @throws SheetNotFoundException
     */
    public function getValues(string $range): array
    {
        if (!$this->sheet) {
            throw new SheetNotFoundException();
        }
        $response = $this->serviceSheets->spreadsheets_values->get($this->sheet, $range);
        
        return $response->getValues();
    }
    
    /**
     * @param string $range
     * @return Generator
     * @throws SheetNotFoundException
     */
    public function getGeneratorValue(string $range): Generator
    {
        $values = $this->getValues($range);
        
        foreach ($values as $row) {
            yield $row;
        }
    }
}