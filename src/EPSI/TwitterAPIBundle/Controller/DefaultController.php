<?php

namespace EPSI\TwitterAPIBundle\Controller;

use EPSI\TwitterAPIBundle\Entity\Tweet;
use EPSI\TwitterAPIBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home_twitter", name="homeTweet")
     */
    public function homeAction()
    {
        $twitter = $this->get('endroid.twitter');
        $response = $twitter->query('statuses/home_timeline', 'GET', 'json', array('count' => 50));
        $tweets = json_decode($response->getContent(), true);

        return $this->render('EPSITwitterAPIBundle:Tweet:actu_tweet.html.twig', array("tweets" => $tweets));
    }

    /**
     * @Route("/saveTweet/{id}", requirements={"id" = "\d+"}, defaults={"id" = 1}, name="saveTweet")
     */
    public function savedTweet($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $twitter = $this->get('endroid.twitter');
        $response = $twitter->query('statuses/show', 'GET', 'json', array('id' => $id));
        $tweetapi = json_decode($response->getContent(), true);

        //On vérifie si le tweet n'existe pas dans la BD avant de le sauvegarder
        $tweet = $em->getRepository("EPSITwitterAPIBundle:Tweet")->findOneByIdtweet($tweetapi['id']);
        if (!$tweet) {

            //On vérifie si le user n'existe pas dans la BD avant de le sauvegarder

            $user = $em->getRepository("EPSITwitterAPIBundle:User")->findOneByIdTwitter($tweetapi['user']['id']);
            /*On vérifie si l'utilisateur du tweet est existant dans la BD. Si ce n'est pas le cas, on l'integre dans la BD*/
            if (!$user) {
                $user = new User($tweetapi['user']['id'], $tweetapi['user']['screen_name'], $tweetapi['user']['name'], $tweetapi['user']['profile_image_url_https']);
            }

            $tweet = new Tweet();
            $tweet->setIdtweet($tweetapi['id'])
                ->setUser($user)
                ->setDatepost($tweetapi['created_at'])
                ->setText(utf8_encode($tweetapi['text']));

            $em->persist($tweet);
            $em->flush();

            return new Response("save");
        }

        return new Response("not save");
    }


    /**
     * @Route("/removeTweet/{id}", requirements={"id" = "\d+"}, defaults={"id" = 1}, name="removeTweet")
     */
    public function removeTweet($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        //On vérifie si le tweet n'existe pas dans la BD avant de le sauvegarder
        $tweet = $em->getRepository("EPSITwitterAPIBundle:Tweet")->findOneByIdtweet($id);

        $em->remove($tweet);
        $em->flush();

        return new Response("remove");

    }

    /**
     * @Route("/removeUser/{id}", requirements={"id" = "\d+"}, defaults={"id" = 1}, name="removeUser")
     */
    public function removeUser($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository("EPSITwitterAPIBundle:User")->findOneByIdTwitter($id);

        $em->remove($user);
        $em->flush();

        return new Response("remove");
    }

    /**
     * @Route("/show/user", name="users_show")
     */
    public function viewUser()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $users = $em->getRepository("EPSITwitterAPIBundle:User")->findAll();
        return $this->render('EPSITwitterAPIBundle:User:liste_user.html.twig', array('users' => $users));
    }

    /**
     * @Route("/show/user/{id}", requirements={"id" = "\d+"}, defaults={"id" = 1}, name="oneUser_show")
     */
    public function viewOneUser($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository("EPSITwitterAPIBundle:User")->findOneByIdTwitter($id);
        return $this->render('EPSITwitterAPIBundle:User:user.html.twig', array('user' => $user));
    }

    /**
     * @Route("/show/tweet", name="tweets_show")
     */
    public function viewTweet()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $tweets = $em->getRepository("EPSITwitterAPIBundle:Tweet")->findAll();
        return $this->render('EPSITwitterAPIBundle:Tweet:liste_tweet.html.twig', array('tweets' => $tweets));
    }

    /**
     * @Route("/show/tweet/{id}", requirements={"id" = "\d+"}, defaults={"id" = 1},  name="oneTweet_show")
     */
    public function viewOneTweet($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $tweet = $em->getRepository("EPSITwitterAPIBundle:Tweet")->findOneByIdtweet($id);

        return $this->render('EPSITwitterAPIBundle:Tweet:tweet.html.twig', array('tweet' => $tweet));
    }


    /**
     * @Route("/reload", name="reload_tweet")
     */
    public function reloadTweet()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $twitter = $this->get('endroid.twitter');
        $response = $twitter->query('statuses/home_timeline', 'GET', 'json', array('count' => 200));
        $tweetsapi = json_decode($response->getContent(), true);


        /* On parcout la liste des tweetsapi */
        foreach ($tweetsapi as $tweetapi) {
            $tweet = $em->getRepository("EPSITwitterAPIBundle:Tweet")->findOneByIdtweet($tweetapi['id']);
            if (!$tweet) {
                $user = $em->getRepository("EPSITwitterAPIBundle:User")->findOneByIdTwitter($tweetapi['user']['id']);
                /*On vérifie si l'utilisateur du tweet est existant dans la BD. Si ce n'est pas le cas, on l'integre dans la BD*/
                if (!$user) {
                    $user = new User($tweetapi['user']['id'], $tweetapi['user']['screen_name'], $tweetapi['user']['name'], $tweetapi['user']['profile_image_url_https']);
                }

                $tweet = new Tweet();
                $tweet->setIdtweet($tweetapi['id'])
                    ->setUser($user)
                    ->setDatepost($tweetapi['created_at'])
                    ->setText(utf8_encode($tweetapi['text']));

                $em->persist($tweet);
                $em->flush();
            }

        }

        return $this->render('EPSITwitterAPIBundle:actu_tweet.html.twig');

    }


}
