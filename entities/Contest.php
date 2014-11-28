<?php
/**
 * @Entity @Table(name="contest")
 **/
class Contest {
    /** @Id @Column(type="integer") @GeneratedValue * */
    protected $id;
    /** @Column(type="string", unique=false) * */
    protected $description;
    /** @Column(type="string", unique=false) * */
    protected $name;
    /** @Column(type="string", unique=false) * */
    protected $image_url;
    /** @Column(type="datetime") * */
    protected $starts_at;
    /** @Column(type="datetime") * */
    protected $ends_at;

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
    public function getEndsAt() {
        return $this->ends_at;
    }

    /**
     * @param mixed $ends_at
     */
    public function setEndsAt($ends_at) {
        $this->ends_at = $ends_at;
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
    public function getStartsAt() {
        return $this->starts_at;
    }

    /**
     * @param mixed $starts_at
     */
    public function setStartsAt($starts_at) {
        $this->starts_at = $starts_at;
    }



}