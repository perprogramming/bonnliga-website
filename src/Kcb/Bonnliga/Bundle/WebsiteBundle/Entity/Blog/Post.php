<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Blog;

use Sylius\Bundle\BloggerBundle\Model\Post as BasePost;
use Doctrine\ORM\Mapping as ORM;
use Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\User;

/**
 * @ORM\Entity
 */
class Post extends BasePost {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column
     */
    protected $title;

    /**
     * @ORM\Column
     */
    protected $slug;

    /**
     * TODO: Sollte eigentlich ein FOSUser sein... Allerdings ist es in den Templates des Blogs immer ein Textfeld...
     * Deshalb ist es hier auch erstmal ein Textfeld..
     *
     * ORM\ManyToOne(targetEntity="Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\User")
     * ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @ORM\Column
     */
    protected $author;

    /**
     * @ORM\Column(type="text")
     */
    protected $content;

    /**
     * @ORM\Column(type="date")
     */
    protected $published;

    /**
     * @ORM\Column(type="date")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="date")
     */
    protected $updatedAt;

}
