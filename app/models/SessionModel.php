<?php

class SessionModel {

    // Constructor ensures that the session is started when the model is instantiated
    public function __construct() {
        // Check if the session has not already been started, if not, start it
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Set a session variable with a specific key and value
    public function set($key, $value) {
        // Assign the value to the session using the provided key
        $_SESSION[$key] = $value;
    }

    // Get the value of a session variable by its key
    public function get($key) {
        // Return the session value if it exists, otherwise return null
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    // Remove a specific session variable by its key
    public function remove($key) {
        // Check if the session variable exists and then unset it
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    // Clear all session data and destroy the session
    public function clear() {
        // Unset all session variables
        session_unset();
        // Destroy the session entirely
        session_destroy();
    }
}
