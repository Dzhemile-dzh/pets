<?php

declare(strict_types=1);

namespace Api\Mvc\DataProvider;

use Phalcon\DI;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\DiInterface;
use Phalcon\Mvc\DataProvider;

/**
 * @package Api\Mvc\DataProvider
 */
abstract class TemporaryTable extends DataProvider
    implements InjectionAwareInterface
{
    /**
     * @var string
     */
    private $suffix;

    /**
     * @var bool
     */
    private $isTemporaryTableCreated = false;
    private $di;
    private $isDropped = false;

    /**
     * @param string $tableName
     *
     * @return void
     */
    abstract protected function createTemporaryTable(string $tableName): void;

    /**
     * @return string
     */
    abstract protected function getTemporaryTableName(): string;

    /**
     * @return string
     */
    public function getSuffix(): string
    {
        if ($this->suffix === null) {
            $this->suffix = $this->buildUniqueSuffix();
        }
        return $this->suffix;
    }

    /**
     * @return string
     * @throws \LogicException
     */
    public function getTemporaryTable(): string
    {
        if ($this->isDropped) {
            throw new \LogicException("Temporary table already has been dropped");
        }

        $tableName = "#" . $this->getTemporaryTableName() . $this->getSuffix();

        if (!$this->isTemporaryTableCreated) {
            $this->createTemporaryTable($tableName);
            $this->isTemporaryTableCreated = true;

            $this->registerInManager();
            register_shutdown_function([$this, 'dropTemporaryTable']);
        }

        return $tableName;
    }

    /**
     * @return void
     */
    public function dropTemporaryTable(): void
    {
        if (!$this->isDropped) {
            $this->execute(
                "
            IF OBJECT_ID('{$this->getTemporaryTable()}') IS NOT NULL 
                DROP TABLE {$this->getTemporaryTable()}
            "
            );
            $this->isDropped = true;
        }
    }

    /**
     * Sets the dependency injector
     * @codeCoverageIgnore
     * @param mixed $dependencyInjector
     */
    public function setDI(DiInterface $dependencyInjector): void
    {
        $this->di = $dependencyInjector;
    }

    /**
     * Returns the internal dependency injector
     * @codeCoverageIgnore
     * @return DiInterface
     */
    public function getDI(): DiInterface
    {
        $this->di = ($this->di)?? DI::getDefault();
        return $this->di;
    }

    /**
     * @codeCoverageIgnore
     * @return string
     */
    protected function buildUniqueSuffix(): string
    {
        $math = $this->getDI()->getShared("math");
        return (string)$math::random();
    }

    public function __destruct()
    {
        $this->dropTemporaryTable();
    }

    /**
     * @return bool
     */
    private function registerInManager(): bool
    {
        $di = $this->getDI();
        if ($di->has(TemporaryTableManager::SERVICE_NAME)) {
            $manager = $di->getShared(TemporaryTableManager::SERVICE_NAME);
            if ($manager instanceof TemporaryTableManager) {
                $manager->add($this);
                return true;
            }
        }

        return false;
    }
}
