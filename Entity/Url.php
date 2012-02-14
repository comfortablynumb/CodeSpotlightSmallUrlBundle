<?php

/**
 * Created by Gustavo Falco <comfortablynumb84@gmail.com>
 */

namespace CodeSpotlight\Bundle\SmallUrlBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="UrlRepository")
 * @ORM\Table(
 *    name="url",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="code_idx", columns={"code"}),
 *        @ORM\UniqueConstraint(name="url_idx", columns={"url"})})
 *    }
 * ))
 */
class Url 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $code;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="La URL es obligatoria.")
     * @Assert\Url(message="La URL ingresada es inválida.")
     *
     * @var string
     */
    protected $url;


    /**
     * @param int $id
     * 
     * @return Url
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $code
     * 
     * @return Url
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $url
     *
     * @return Url
     */
    public function setUrl($url)
    {
        $this->url = $url;
        $this->code = '-';

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
