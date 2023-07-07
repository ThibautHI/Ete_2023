<?php

class User {

    private int $id ; 
    
    private int $user_id ; 

    private string $name ; 

    private int $pts; 

    private bool $fait ;

    private string $image ;

    /**
     * @param int $id
     * @param int $user_id
     * @param string $name
     * @param int $pts
     * @param bool $fait
     * @param string $image
     */
    public function __construct(int $id, int $user_id, string $name, int $pts, bool $fait, string $image)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->name = $name;
        $this->pts = $pts;
        $this->fait = $fait;
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
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
     * @return bool
     */
    public function isFait(): bool
    {
        return $this->fait;
    }

    /**
     * @param bool $fait
     */
    public function setFait(bool $fait): void
    {
        $this->fait = $fait;
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