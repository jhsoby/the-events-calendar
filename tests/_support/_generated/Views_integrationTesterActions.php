<?php  //[STAMP] d6fc762f89c4ae5d61c091b8b4b8d3d2
namespace _generated;

// This class was automatically generated by build task
// You should not change it manually as it will be overwritten on next build
// @codingStandardsIgnoreFile

trait Views_integrationTesterActions
{
    /**
     * @return \Codeception\Scenario
     */
    abstract protected function getScenario();

    
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Accessor method to get the object storing the factories for things.
     * This methods gives access to the same factories provided by the
     * [Core test suite](https://make.wordpress.org/core/handbook/testing/automated-testing/writing-phpunit-tests/).
     *
     * @example
     * ```php
     * $postId = $I->factory()->post->create();
     * $userId = $I->factory()->user->create(['role' => 'administrator']);
     * ```
     *
     * @return FactoryStore A factory store, proxy to get hold of the Core suite object factories.
     *
     * @link https://make.wordpress.org/core/handbook/testing/automated-testing/writing-phpunit-tests/
     * @see \Codeception\Module\WPLoader::factory()
     */
    public function factory() {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('factory', func_get_args()));
    }
}
