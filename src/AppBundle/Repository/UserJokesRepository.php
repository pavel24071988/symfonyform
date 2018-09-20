<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 20.09.18
 * Time: 7:37
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Users;
use AppBundle\Entity\UserJokes;
use AppBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;

class UserJokesRepository extends EntityRepository
{
    /**
     * @param array $formData
     * @return UserJokes
     */
    public function setUserJoke(array $formData): UserJokes
    {
        $this->_em->beginTransaction();
        try {
            $user = $this->_em->getRepository(Users::class)->getUserByEmail($formData['email']);
            $category = $this->_em->getRepository(Category::class)->getCategoryByName($formData['category']);

            $userJoke = new UserJokes;
            $userJoke->setCategory($category);
            $userJoke->setCategoryId($category->getId());
            $userJoke->setJoke($formData['joke']);
            $userJoke->setUser($user);
            $userJoke->setUserId($user->getId());
            $userJoke->setSendedDate(new \DateTime("now"));

            $this->_em->persist($userJoke);
            $this->_em->flush();

            $this->_em->commit();

            return $userJoke;
        } catch (\Exception $exception) {
            $this->_em->rollback();
            $this->_em->close();

            return new UserJokes;
        }
    }
}