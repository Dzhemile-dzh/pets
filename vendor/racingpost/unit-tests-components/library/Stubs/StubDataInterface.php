<?php

namespace UnitTestsComponents\Stubs;

/**
 * @package UnitTestsComponents\Stubs
 */
interface StubDataInterface
{
    /**
     * Mocked data
     * Format:
     * 'some_MD5_hash' => [
     *      [row...]
     * ]
     * @return array
     */
    public function getPseudoPdoData(): array;

    /**
     * What actualyy should we receive
     * @return string
     */
    public function getExpected(): string;

    /**
     * Replace all placeholders values to needed value. It works for all queries in the run.
     * So be careful if you have more than one query with similar placeholders.
     * Format:
     * ['placeholderName' => 'newMockedValue']
     * @return array
     */
    public function getReplacement(): array;
}
