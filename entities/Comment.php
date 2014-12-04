<?php
/**
 * @Entity @Table(name="comments")
 **/
class Comment
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="string", unique=false) **/
    protected $text;
    /** @Column(type="string", unique=false) **/
    protected $user_id;
    /** @Column(type="string", unique=false) **/
    protected $idea_id;
    /** @gedmo:Timestampable(on="create") **/
    /** @Column(type="datetime", unique=false) **/
    protected $created_at;

    public function __construct() {
        $this->setCreatedAt(new \DateTime());
    }

    public function getId(){
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt() {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getIdeaId() {
        return $this->idea_id;
    }

    /**
     * @param mixed $idea_id
     */
    public function setIdeaId($idea_id) {
        $this->idea_id = $idea_id;
    }

    /**
     * @return mixed
     */
    public function getText() {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text) {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getUserId() {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }



}