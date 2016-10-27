<?php

namespace EPSI\TwitterAPIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Tweet
 *
 * @ORM\Table(name="tweet")
 * @ORM\Table(options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="EPSI\TwitterAPIBundle\Repository\TweetRepository")
 */
class Tweet
{
    /**
     * @var string
     *
     * @ORM\Column(name="idtweet", type="string", length=255)
     * @ORM\Id
     */
    private $idtweet;

    /**
     * @var $date
     *
     * @ORM\Column(name="datetest", type="string", length=255)
     */
    private $datepost;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="tweets", cascade={"persist" })
     * @JoinColumn(name="idTwitter", referencedColumnName="idTwitter")
     */
    private $user;
    


    /**
     * Set idtweet
     *
     * @param string $idtweet
     *
     * @return Tweet
     */
    public function setIdtweet($idtweet)
    {
        $this->idtweet = $idtweet;

        return $this;
    }

    /**
     * Get idtweet
     *
     * @return string
     */
    public function getIdtweet()
    {
        return $this->idtweet;
    }

    /**
     * Set datepost
     *
     * @param string $datepost
     *
     * @return Tweet
     */
    public function setDatepost($datepost)
    {
        $this->datepost = $datepost;

        return $this;
    }

    /**
     * Get datepost
     *
     * @return string
     */
    public function getDatepost()
    {
        return $this->datepost;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Tweet
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set user
     *
     * @param \EPSI\TwitterAPIBundle\Entity\User $user
     *
     * @return Tweet
     */
    public function setUser(\EPSI\TwitterAPIBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \EPSI\TwitterAPIBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
