<?php
/**************************************************************************
 * LoadGroupData.php, Aoc
 *
 * Mickael Gaillard Copyright 2016
 * Description :
 * Author(s)   :
 * Licence     : All right reserved.
 * Last update : 29 août 2016
 *
 **************************************************************************/
namespace Tact\AocBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Tact\AocBundle\Entity\Group;
use Tact\DoryBundle\DataFixtures\ORM\Base\AbstractOrdererFixture;

/**
 * Load Group data.
 */
class LoadGroupData extends AbstractOrdererFixture
{

    /**
     * The position to load data from anothers.
     *
     * @var integer
     */
    const ORDER = 50;

    const REFERENCE_ADMINISTRATOR = 'super-administrator';

    const REFERENCE_MANAGER = 'manager';

    const REFERENCE_USER = 'user';

    /**
     * The prefix name for values.
     *
     * @var string
     */
    const PREFIX = 'Group-';

    /**
     * Minimum data.
     *
     * @var array
     */
    const FIXTURE_DATA = [
        'admin' => [
            'name' => 'Administrator',
            'reference' => self::REFERENCE_ADMINISTRATOR,
            'default' => false,
            'roles' => [
                'ROLE_ESOFTLINK_ADMIN'
            ]
        ],
        'manager' => [
            'name' => 'Manager',
            'reference' => self::REFERENCE_MANAGER,
            'default' => false,
            'roles' => [
                'ROLE_ESOFTLINK_MANAGER'
            ]
        ],
        'user' => [
            'name' => 'User',
            'reference' => self::REFERENCE_USER,
            'default' => true,
            'roles' => [
                'ROLE_ESOFTLINK_USER'
            ]
        ]
    ];

    /**
     *
     * {@inheritdoc}
     *
     * @see \Tact\DoryBundle\DataFixtures\ORM\Base\AbstractOrdererFixture::generateMinimumFixtures()
     */
    protected function generateMinimumFixtures(ObjectManager $manager)
    {
        $result = [];

        foreach (self::FIXTURE_DATA as $data) {
            $reference = $data['reference'];
            $name = $data['name'];
            $default = $data['default'];
            $roles = $data['roles'];

            $result[] = $this->createObject($reference, $name, $default, $roles);
        }

        return $result;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Tact\DoryBundle\DataFixtures\ORM\Base\AbstractOrdererFixture::generateTestFixtures()
     */
    protected function generateTestFixtures(ObjectManager $manager)
    {
        $result = [];

        return $result;
    }

    /**
     * Create an object.
     *
     * @param string $reference
     *            The reference used to get the new object (concat with class prefix).
     * @param string $companyRef
     *            The reference of the linked company.
     * @param string $name
     *            The name to identify the object for clients.
     *
     * @return Group
     */
    private function createObject($reference, $name, $default, array $roles)
    {
        $object = new Group($name); // Don't put roles in construct bacause sonata ignore its rules.

        $object->setAddByDefault($default);

        foreach ($roles as $role) {
            $object->addRole($role);
        }

        $this->addReference(self::PREFIX . $reference, $object);

        self::$allObjects[] = $reference;

        return $object;
    }

    /**
     * Get the order.
     *
     * @see \Doctrine\Common\DataFixtures\OrderedFixtureInterface::getOrder()
     */
    public function getOrder()
    {
        return self::ORDER;
    }
}
