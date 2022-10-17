<?php

declare(strict_types=1);

namespace UnitTestsComponents\Stubs;

use Phalcon\Db\Adapter\Strategy\EmulationQuery;
use Phalcon\Db\Adapter\Sybase;
use Phalcon\Di;
use Phalcon\DiInterface;
use Pseudo\Pdo;
use Pseudo\PdoStatement;
use Pseudo\Result;
use Pseudo\ResultCollection;

class FakePdo extends Pdo
{
    private $replacements = [];

    /**
     * @inheritdoc
     */
    public function query($statement)
    {
        $key = FakePdo::getStatementHash($statement);
        $query = "SELECT * FROM {$key}";
        $res = parent::query($query);

        if ($res instanceof PdoStatement) {
            $this->resetResult($res);
        }

        if ($res === null) {
            throw new \Exception("Key is not found {$key} for: {$statement}");
        }
        return $res;
    }

    /**
     * @param string $sqlStatement
     * @param array|null $bindParams
     * @param array|null $bindTypes
     *
     * @return string
     */
    public function getStatementHash(string $sqlStatement, ?array $bindParams = [], ?array $bindTypes = []): string
    {
        if (!empty($bindParams)) {
            $sqlStatement = $this->getEmulatedBindQuery($sqlStatement, $bindParams, $bindTypes);
        }

        $stmt = md5($this->removeExcessCharacters($sqlStatement));
        return $stmt;
    }

    /**
     * @param string $sqlStatement
     * @param array|null $bindParams
     * @param array|null $bindTypes
     *
     * @return string
     */
    private function getEmulatedBindQuery(string $sqlStatement, ?array $bindParams = [], ?array $bindTypes = []): string
    {
        $di = $this->getDi();
        /** @var Sybase $adapter */
        $adapter = $di->getShared("db");

        $emulated = $adapter->getEmulationStrategy()->emulateQuery($sqlStatement, $bindParams, $bindTypes);
        return $emulated;
    }

    /**
     *
     */
    public function clear(): void
    {
        $ref = new \ReflectionProperty('Pseudo\\Pdo', 'mockedQueries');
        $ref->setAccessible(true);
        $ref->setValue($this, new ResultCollection());
        $this->replacements = [];
    }

    /**
     * @return DiInterface
     */
    private function getDi(): DiInterface
    {
        return DI::getDefault();
    }

    /**
     * @return array
     */
    public function getReplacements(): array
    {
        return $this->replacements;
    }

    /**
     * @param array $replacements
     */
    public function setReplacements(array $replacements): void
    {
        $this->replacements = $replacements;

        $di = $this->getDi();
        /** @var Sybase $adapter */
        $adapter = $di->getShared("db");
        $adapter->getEmulationStrategy();

        $adapter->setEmulationStrategy(

            new class ($this->replacements) extends EmulationQuery {

                private $replacements = [];

                public function __construct(array $replacements)
                {
                    $this->replacements = $replacements;
                }
                public function emulateQuery(string $sqlStatement, array $bindParams = null, array $bindTypes = null): string
                {
                    if (!empty($this->replacements) && !empty($bindParams)) {
                        foreach ($bindParams as $key => $param) {
                            if (isset($this->replacements[$key])) {
                                $bindParams[$key] = $this->replacements[$key];
                            }
                        }
                    }
                    return parent::emulateQuery($sqlStatement, $bindParams, $bindTypes);
                }
            }
        );
    }

    /**
     * @param string $sqlStatement
     *
     * @return string
     */
    private function removeExcessCharacters(string $sqlStatement): string
    {
        return strtolower(
            trim(
                preg_replace("/\s+/", " ", $sqlStatement)
            )
        );
    }

    /**
     * Method is needed to fix Pseudo, when for different calls the same result returns
     * @param $res
     */
    private function resetResult(PdoStatement $res)
    {
        $res->setResult(new Result($res->fetchAll()));
    }
}
