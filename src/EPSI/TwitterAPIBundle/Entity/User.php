<?php

namespace EPSI\TwitterAPIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Table(options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="EPSI\TwitterAPIBundle\Repository\UserRepository")
 */
class User
{

    /**
     * @var string
     *
     * @ORM\Column(name="idTwitter", type="string", length=255, unique=true)
     * @ORM\Id
     */
    private $idTwitter;

    /**
     * @var string
     *
     * @ORM\Column(name="screenname", type="string", length=255)
     */
    private $screenname;

    /**
     * @var string
     *
     * @ORM\Column(name="fullname", type="string", length=255)
     */
    private $fullname;

    /**
     * @var string
     *
     * @ORM\Column(name="urlphoto", type="string", length=255)
     */
    private $urlphoto;

    /**
     * @ORM\OneToMany(targetEntity="Tweet", mappedBy="user", cascade={"persist", "remove"})
     */
    private $tweets;

    /**
     * User constructor.
     * @param string $idTwitter
     * @param string $screenname
     * @param string $fullname
     * @param string $urlphoto
     */
    public function __construct($idTwitter, $screenname, $fullname, $urlphoto)
    {
        $this->idTwitter = $idTwitter;
        $this->screenname = $screenname;
        $this->fullname = $fullname;
        $this->urlphoto = $urlphoto;
        $this->tweets = new \Doctrine\Common\Collections\ArrayCollection();

    }


    /**
     * Set idTwitter
     *
     * @param string $idTwitter
     *
     * @return User
     */
    public function setIdTwitter($idTwitter)
    {
        $this->idTwitter = $idTwitter;

        return $this;
    }

    /**
     * Get idTwitter
     *
     * @return string
     */
    public function getIdTwitter()
    {
        return $this->idTwitter;
    }

    /**
     * Set screenname
     *
     * @param string $screenname
     *
     * @return User
     */
    public function setScreenname($screenname)
    {
        $this->screenname = $screenname;

        return $this;
    }

    /**
     * Get screenname
     *
     * @return string
     */
    public function getScreenname()
    {
        return $this->screenname;
    }

    /**
     * Set fullname
     *
     * @param string $fullname
     *
     * @return User
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set urlphoto
     *
     * @param string $urlphoto
     *
     * @return User
     */
    public function setUrlphoto($urlphoto)
    {
        $this->urlphoto = $urlphoto;

        return $this;
    }

    /**
     * Get urlphoto
     *
     * @return string
     */
    public function getUrlphoto()
    {
        return $this->urlphoto;
    }

    /**
     * Add tweet
     *
     * @param \EPSI\TwitterAPIBundle\Entity\Tweet $tweet
     *
     * @return User
     */
    public function addTweet(\EPSI\TwitterAPIBundle\Entity\Tweet $tweet)
    {
        $this->tweets[] = $tweet;

        return $this;
    }

    /**
     * Remove tweet
     *
     * @param \EPSI\TwitterAPIBundle\Entity\Tweet $tweet
     */
    public function removeTweet(\EPSI\TwitterAPIBundle\Entity\Tweet $tweet)
    {
        $this->tweets->removeElement($tweet);
    }

    /**
     * Get tweets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTweets()
    {
        return $this->tweets;
    }
}
