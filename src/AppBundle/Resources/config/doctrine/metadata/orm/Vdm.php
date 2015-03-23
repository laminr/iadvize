<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Vdm
 *
 * @ORM\Table(name="vdm")
 * @ORM\Entity
 */
class Vdm
{
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
     * @ORM\Column(name="when", type="datetime", nullable=false)
     */
    private $when;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="text", nullable=false)
     */
    private $author;


}
