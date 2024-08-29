<?php

namespace Model\Entities;

use App\Entity;

final class Rando extends Entity {

    private $id;
    private string $title;
    private string $subtitle;
    private $dateRando;
    private float $distance;
    private $description;
    private $postDate;
    private $departure;
    private $destination;
    private $image;
    // private $itinerary;
    private $user;
    
    public function __construct($data){         
        $this->hydrate($data);        
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getDateRando()
    {
        return $this->dateRando;
    }
 
    public function setDateRando($dateRando)
    {
        $this->dateRando = $dateRando;

        return $this;
    }
 
    public function getDistance()
    {
        return $this->distance;
    }

    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
 
    public function getPostDate()
    {
        return $this->postDate;
    }

    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;

        return $this;
    }

    public function getDeparture()
    {
        return $this->departure;
    }

    public function setDeparture($departure)
    {
        $this->departure = $departure;

        return $this;
    }
 
    public function getDestination()
    {
        return $this->destination;
    }

    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }
 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    // public function getItinerary()
    // {
    //     return $this->itinerary;
    // }

    // public function setItinerary($itinerary)
    // {
    //     $this->itinerary = $itinerary;

    //     return $this;
    // }
 
    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    
    // METHODE TO__STRING POUR L'AFFICHAGE
        public function __toString()
        {
            return $this->rando;
        }
}