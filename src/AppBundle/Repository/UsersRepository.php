<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 20.09.18
 * Time: 7:37
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Users;
use Doctrine\ORM\EntityRepository;

class UsersRepository extends EntityRepository
{
    /**
     * @param string $email
     * @return Users
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function getUserByEmail(string $email): Users
    {
        $user = $this->_em->getRepository(Users::class)->findOneBy(['email' => $email]);
        return $user ?? $this->userCreate($email);
    }

    /**
     * @param string $email
     * @return Users
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function userCreate(string $email): Users
    {
        $user = new Users;
        $user->setCreated(new \DateTime("now"));
        $user->setEmail($email);

        $this->_em->persist($user);
        $this->_em->flush();

        return $user;
    }
}