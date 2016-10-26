<?php
/**************************************************************************
 * LoadUserData.php, eSoftLink
 *
 * Mickael Gaillard Copyright 2016
 * Description :
 * Author(s) : Mickael Gaillard <mickael.gaillard@tactfactory.com>
 *             Jonathan Poncy <jonathan.poncy@tactfactory.com>
 * Licence : All right reserved.
 * Last update : 5 July, 2016
 *
 **************************************************************************/
namespace Tact\AocBundle\DataFixtures\ORM;

use Tact\DoryBundle\DataFixtures\ORM\UserFixtureHelper;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends UserFixtureHelper
{

    /**
     * Data to generate additionals admins.
     *
     * @var array
     */
    private static $admins = [
        [
            'username' => 'aws',
            'enable' => true,
            'password' => '5re1f4erz5d',
            'firstname' => 'Jonathan',
            'lastname' => 'Poncy',
            'email' => 'jonathan.poncy@tactfactory.com',
            'birthday' => '1989-08-26',
            'website' => null,
            'gender' => User::GENDER_MALE,
            'locale' => 'fr_FR',
            'timeZone' => 'Europe/Paris',
            'phone' => '0000000000',
            'customerId' => '0000000000000aws',
            'groups' => [
                LoadGroupData::REFERENCE_ADMINISTRATOR
            ]
        ],
        [
            'username' => 'theos',
            'enable' => true,
            'password' => '4frf5r25fr0d',
            'firstname' => 'Mickaël',
            'lastname' => 'Gaillard',
            'email' => 'mickael.gaillard@tactfactory.com',
            'birthday' => '1980-06-29',
            'website' => '',
            'gender' => User::GENDER_MALE,
            'locale' => 'en',
            'timeZone' => 'Europe/London',
            'phone' => '0000000000',
            'customerId' => '00000000000theos',
            'groups' => [
                LoadGroupData::REFERENCE_ADMINISTRATOR
            ]
        ],
        [
            'username' => 'isod',
            'enable' => true,
            'password' => '4def5ze4f1z5ef1cze5d4fze',
            'firstname' => 'Erwan',
            'lastname' => 'Le Huitouze',
            'email' => 'erwan.lehuitouze@tactfactory.com',
            'birthday' => 'today',
            'website' => '',
            'gender' => User::GENDER_MALE,
            'locale' => 'fr_FR',
            'timeZone' => 'Europe/Paris',
            'phone' => '0000000000',
            'customerId' => '000000000000isod',
            'groups' => [
                LoadGroupData::REFERENCE_ADMINISTRATOR
            ]
        ],
        [
            'username' => 'manager',
            'enable' => true,
            'password' => 'umoins16v21puh335t',
            'firstname' => 'Ger',
            'lastname' => 'Mana',
            'email' => 'mana.ger@tactfactory.com',
            'birthday' => '2016-08-30',
            'website' => null,
            'gender' => User::GENDER_MALE,
            'locale' => 'fr_FR',
            'timeZone' => 'Europe/Paris',
            'phone' => '0000000000',
            'customerId' => '00000000000nico2',
            'groups' => [
                LoadGroupData::REFERENCE_MANAGER
            ]
        ],
        [
            'username' => 'tony',
            'enable' => true,
            'password' => 'tonygregoire',
            'firstname' => 'tony',
            'lastname' => 'gregoire',
            'email' => 'Tony.Gregoire@direct-energie.com',
            'birthday' => '1901-12-13',
            'website' => null,
            'gender' => User::GENDER_MALE,
            'locale' => 'fr_FR',
            'timeZone' => 'Europe/Paris',
            'phone' => '0000000000',
            'customerId' => '00000000000nico2',
            'groups' => [
                LoadGroupData::REFERENCE_ADMINISTRATOR
            ]
        ]
    ];

    /**
     *
     * {@inheritdoc}
     *
     * @see \Tact\DoryBundle\DataFixtures\ORM\UserFixtureHelper::generateMinimumFixtures()
     */
    protected function generateMinimumFixtures(ObjectManager $manager)
    {
        $result = parent::generateMinimumFixtures($manager);

        $roles = [];

        foreach (self::$admins as $data) {
            $username = $data['username'];
            $enable = $data['enable'];
            $password = $data['password'];
            $firstname = $data['firstname'];
            $lastname = $data['lastname'];
            $email = $data['email'];
            $birthday = new \DateTime($data['birthday']);
            $website = $data['website'];
            $gender = $data['gender'];
            $locale = $data['locale'];
            $timeZone = $data['timeZone'];
            $phone = $data['phone'];
            $customerId = $data['customerId'];
            $groups = $data['groups'];

            $result[] = $this->createUser(
                $username, $enable, $password, $firstname, $lastname, $roles, $email, $birthday,
                $website, $gender, $locale, $timeZone, $phone, $customerId, $groups
            );
        }

        return $result;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Tact\DoryBundle\DataFixtures\ORM\UserFixtureHelper::generateTestFixtures()
     */
    protected function generateTestFixtures(ObjectManager $manager)
    {
        $result = [];

        $roles = [];
        $groups = [
            LoadGroupData::REFERENCE_USER
        ];
        $availableGenders = [
            User::GENDER_MALE, User::GENDER_FEMALE
        ];
        $emailUsed = [];

        for ($i = 4; $i <= 150; $i ++) {
            $username = sprintf('fake_%s', $this->faker->unique()->firstNameMale);

            $enable = $this->faker->boolean;
            $password = $this->faker->password;
            $firstname = $this->faker->firstName;
            $lastname = $this->faker->lastName;
            $birthday = $this->faker->dateTimeThisCentury;
            $website = 'https://www.fakeland.fr';
            $gender = $this->faker->randomElement($availableGenders);
            $locale = $this->faker->locale;
            $timeZone = $this->faker->timezone;
            $phone = $this->faker->phoneNumber;
            $customerId = $this->faker->words(3, true);

            do {
                $email = 'fake.' . $this->faker->email;
            } while (in_array($email, $emailUsed));
            $emailUsed[] = $email;

            $result[] = $this->createUser(
                $username, $enable, $password, $firstname, $lastname, $roles, $email, $birthday,
                $website, $gender, $locale, $timeZone, $phone, $customerId, $groups
            );
        }

        { // Add test user that will match with the relay data generattion.
            $result[] = $this->createUser(
                'user', true, 'fr5eg1t5g4tr1g1erf1', 'You', 'Ser', [],
                'test-user-with-relay@tactfactory.com', new \DateTime(), null, User::GENDER_MALE, 'fr_FR',
                'Europe/Paris', '0000000000', '0000000000000000', [LoadGroupData::REFERENCE_USER]
            );
        }

        return $result;
    }

    /**
     *
     * {@inheritdoc}
     *
     */
    protected function makeUser($username, $enable, $password, $firstname, $lastname, $roles, $email, $birthday,
            $website, $gender, $locale, $timeZone, $phone, $ref = null)
    {
        $user = $this->userManager->createUser();

        $user = $this->fillUser(
            $user, $username, $enable, $password, $firstname, $lastname, $roles, $email, $birthday,
            $website, $gender, $locale, $timeZone, $phone
        );

        if (! $ref) {
            $ref = "usr-" . $this->count; // Dory increments count.
        }

        $this->addReference($ref, $user);

        return $user;
    }

    /**
     * Generate a fixture object.
     *
     * @param string $username
     * @param boolean $enable
     * @param string $password
     * @param string $firstname
     * @param string $lastname
     * @param array $roles
     * @param string $email
     * @param \DateTime $birthday
     * @param string $website
     * @param string $gender
     * @param string $locale
     * @param string $timeZone
     * @param string $phone
     * @param string $customerId
     * @param string[]|Group[] $groups
     * @param string $ref
     *
     * @return \Tact\CoreBundle\Entity\User
     */
    private function createUser($username, $enable, $password, $firstname, $lastname, $roles, $email, $birthday,
            $website, $gender, $locale, $timeZone, $phone, $customerId, array $groups, $ref = null)
    {
        $result = $this->makeUser(
            $username, $enable, $password, $firstname, $lastname, $roles, $email, $birthday,
            $website, $gender, $locale, $timeZone, $phone, $ref
        );

        $result->setCustomerId($customerId);

        foreach ($groups as $group) {
            $result->addGroup($this->getObject($group, LoadGroupData::PREFIX));
        }

        return $result;
    }
}
