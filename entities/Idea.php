<?php
/**
 * @Entity @Table(name="idea")
 **/
class Idea {
    /** @Id @Column(type="integer") @GeneratedValue * */
    protected $id;
    /** @Column(type="string", unique=false) * */
    protected $description;
    /** @Column(type="string", unique=false) * */
    protected $name;
    /** @Column(type="string", unique=false) * */
    protected $image_url;
    /** @Column(type="integer") * */
    protected $contest_id;
    /** @Column(type="integer") * */
    protected $user_id;

    /**
     * @return mixed
     */
    public function getContestId() {
        return $this->contest_id;
    }

    /**
     * @param mixed $contest_id
     */
    public function setContestId($contest_id) {
        $this->contest_id = $contest_id;
    }

    /**
     * @return mixed
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getImageUrl() {
        return $this->image_url;
    }

    /**
     * @param mixed $image_url
     */
    public function setImageUrl($image_url) {
        $this->image_url = $image_url;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
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