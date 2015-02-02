<?php


namespace Facebook\Repositories;


interface UserRepositoryInterface {

    /**
     * Get logged in user
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\User
     */
    public function getUser($id);

    /**
     * Get user by id
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\User
     */
    public function getUserById($id);

    /**
     * Get user's status
     *
     * @param $id
     * @return int
     */
    public function getStatus($id);

    /**
     * Register new user
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection|\User
     */
    public function register($data);

    /**
     * Login user
     *
     * @param $data
     * @return bool
     */
    public function login($data);

    /**
     * Activates a account
     *
     * @param array $data
     * @return bool
     */
    public function activate($data);

    /**
     * create user meta data
     *
     * @param string $option
     * @param string $value
     * @return bool
     */
    public function createMeta($option,$value);

    /**
     * update user meta data
     *
     * @param string $option
     * @param string $value
     * @return bool
     */
    public function updateMeta($option,$value);

}