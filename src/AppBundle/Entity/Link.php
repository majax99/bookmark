<?php
/**
 * Created by PhpStorm.
 * User: Pierre-Yves
 * Date: 23/06/2018
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Link
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $link;

    /**
     * @ORM\Column(type="json_array")
     */
    private $bookmark;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $type;

    public function getId()
    {
        return $this->id;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    public function getBookmark()
    {
        return $this->bookmark;
    }

    public function setBookmark($bookmark)
    {
        $this->bookmark = $bookmark;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}