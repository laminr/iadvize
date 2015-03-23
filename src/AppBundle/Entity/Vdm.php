<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vdm
 *
 * @ORM\Table(name="vdm")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\VdmRepository") 
 */
class Vdm
{
    const CLASS_NAME = "AppBundle:Vdm";
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="postDate", type="datetime", nullable=false)
     */
    private $when;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="text", nullable=false)
     */
    private $author;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Vdm
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set when
     *
     * @param \DateTime $when
     * @return Vdm
     */
    public function setWhen($when)
    {
        $this->when = $when;

        return $this;
    }

    /**
     * Get when
     *
     * @return \DateTime 
     */
    public function getWhen()
    {
        return $this->when;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Vdm
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
