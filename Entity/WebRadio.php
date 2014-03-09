<?php
namespace Cogipix\CogimixWebRadioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="webradio",indexes={@ORM\Index(name="search_idx", columns={"name"})})
 * @ORM\Entity(repositoryClass="Cogipix\CogimixWebRadioBundle\Repository\WebRadioRepository")
 *
 * @author plfort - Cogipix
 *
 */
class WebRadio
{

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var int $id
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     *
     * @var string $name
     */
    protected $name;

    /**
     * @ORM\Column(type="string",length=500)
     *
     * @var string $url
     */
    protected $url;

    /**
     * @ORM\Column(type="string",length=500)
     *
     * @var string $originalUrl
     */
    protected $originalUrl;

    /**
     * @ORM\Column(type="string",nullable=true)
     *
     * @var string $webSite
     */
    protected $webSite;

    /**
     * @ORM\Column(type="string",nullable=true)
     *
     * @var string $pictureUrl
     */
    protected $pictureUrl;

    /**
     * @ORM\Column(type="integer")
     * @var int $playCount
     */
    protected $playCount=0;

    /**
     * @ORM\Column(type="boolean",options={"default=false"})
     * @var boolean $confirmed
     */
    protected $confirmed = false;

    /**
     * @ORM\Column(type="boolean",options={"default=false"})
     * @var boolean $active
     */
    protected $active = true;


    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function getWebSite()
    {
        return $this->webSite;
    }

    public function setWebSite($webSite)
    {
        $this->webSite = $webSite;
        return $this;
    }

    public function getPictureUrl()
    {
        return $this->pictureUrl;
    }

    public function setPictureUrl($pictureUrl)
    {
        $this->pictureUrl = $pictureUrl;
        return $this;
    }

    public function getPlayCount()
    {
        return $this->playCount;
    }

    public function setPlayCount($playCount)
    {
        $this->playCount = $playCount;
        return $this;
    }

    public function increasePlayCount(){
        $this->playCount++;
    }

    public function getConfirmed()
    {
        return $this->confirmed;
    }

    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
        return $this;
    }

    public function getOriginalUrl()
    {
        return $this->originalUrl;
    }

    public function setOriginalUrl($originalUrl)
    {
        $this->originalUrl = $originalUrl;
        return $this;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }






}
