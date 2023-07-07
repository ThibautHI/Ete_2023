<?php

class User {

    private int $id ; 
    
    private string $firstname ; 

    private string $lastName ; 

    private int $pts; 

    private string $image ;


    public function __construct(int $id, string $firstname, string $lastName, int $pts, string $image)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastName = $lastName;
        $this->pts = $pts;
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return int
     */
    public function getPts(): int
    {
        return $this->pts;
    }

    /**
     * @param int $pts
     */
    public function setPts(int $pts): void
    {
        $this->pts = $pts;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }


}

?>