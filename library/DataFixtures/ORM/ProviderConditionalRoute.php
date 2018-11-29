<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRoute;

class ProviderConditionalRoute extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ConditionalRoute::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(ConditionalRoute::class);
        (function () {
            $this->setName("testConditional");
            $this->setRoutetype("user");
            $this->setNumbervalue("");
            $this->setFriendvalue("");
        })->call($item1);

        $item1->setCompany($this->getReference('_reference_ProviderCompany1'));
        $item1->setUser($this->getReference('_reference_ProviderUser1'));
        $item1->setNumberCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderConditionalRouteConditionalRoute1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(ConditionalRoute::class);
        (function () {
            $this->setName("testConditional2");
            $this->setRoutetype("user");
            $this->setNumbervalue("");
            $this->setFriendvalue("");
        })->call($item2);

        $item2->setCompany($this->getReference('_reference_ProviderCompany1'));
        $item2->setUser($this->getReference('_reference_ProviderUser2'));
        $item2->setNumberCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderConditionalRouteConditionalRoute2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderUser::class,
            ProviderCountry::class
        );
    }
}
