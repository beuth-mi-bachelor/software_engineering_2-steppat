<?php
/**
 * @Entity @Table(name="user")
 **/
class User
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="string", unique=true) **/
    protected $username;
    /** @Column(type="string", unique=false) **/
    protected $email;
    /** @Column(type="string", unique=false) **/
    protected $password;
    /** @Column(type="string", unique=false) **/
    protected $hash;
    /** @gedmo:Timestampable(on="create") **/
    /** @Column(type="datetime", unique=false) **/
    protected $created_at;
    /** @Column(type="datetime", unique=false) **/
    protected $updated_at;
    /** @Column(type="integer", unique=false) **/
    protected $role_id;

    public function __construct() {
        $this->setCreatedAt(time());
        $this->setUpdatedAt(time());
    }

    /**
     * @return mixed
     */
    public function getRoleId() {
        return $this->role_id;
    }

    /**
     * @param mixed $role_id
     */
    public function setRoleId($role_id) {
        $this->role_id = $role_id;
    }

    /**
     * @return mixed
     */
    public function getHash() {
        return $this->hash;
    }

    /**
     * @param mixed $hash
     */
    public function setHash($hash) {
        $this->hash = $hash;
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
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt() {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }

    /**
     * @return mixed
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }
}