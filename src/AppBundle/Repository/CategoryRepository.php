<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 20.09.18
 * Time: 7:37
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    /**
     * @param string $name
     * @return Category
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function getCategoryByName(string $name): Category
    {
        $category = $this->_em->getRepository(Category::class)->findOneBy(['name' => $name]);
        return $category ?? $this->categoryCreate($name);
    }

    /**
     * @param string $name
     * @return Category
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function categoryCreate(string $name): Category
    {
        $category = new Category;
        $category->setName($name);

        $this->_em->persist($category);
        $this->_em->flush();

        return $category;
    }
}