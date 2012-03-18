<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle\Entity\Blog;

use Sylius\Bundle\BloggerBundle\Entity\Post as BasePost;
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

    public function __construct() {
        parent::__construct();
        $this->incrementUpdatedAt();
    }

}
