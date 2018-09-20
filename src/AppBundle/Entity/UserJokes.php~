<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 20.09.18
 * Time: 7:27
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserJokesRepository")
 * @ORM\Table(name="user_jokes")
 */
class UserJokes
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="UserJokes")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $category_id;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="UserJokes")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $category;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $joke;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $sended_date;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId.
     *
     * @param int $userId
     *
     * @return UserJokes
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set joke.
     *
     * @param string $joke
     *
     * @return UserJokes
     */
    public function setJoke($joke)
    {
        $this->joke = $joke;

        return $this;
    }

    /**
     * Get joke.
     *
     * @return string
     */
    public function getJoke()
    {
        return $this->joke;
    }

    /**
     * Set user.
     *
     * @param \AppBundle\Entity\Users|null $user
     *
     * @return UserJokes
     */
    public function setUser(\AppBundle\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \AppBundle\Entity\Users|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set categoryId.
     *
     * @param int $categoryId
     *
     * @return UserJokes
     */
    public function setCategoryId($categoryId)
    {
        $this->category_id = $categoryId;

        return $this;
    }

    /**
     * Get categoryId.
     *
     * @return int
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set sendedDate.
     *
     * @param \DateTime $sendedDate
     *
     * @return UserJokes
     */
    public function setSendedDate($sendedDate)
    {
        $this->sended_date = $sendedDate;

        return $this;
    }

    /**
     * Get sendedDate.
     *
     * @return \DateTime
     */
    public function getSendedDate()
    {
        return $this->sended_date;
    }

    /**
     * Set category.
     *
     * @param \AppBundle\Entity\Category|null $category
     *
     * @return UserJokes
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return \AppBundle\Entity\Category|null
     */
    public function getCategory()
    {
        return $this->category;
    }
}
