<?php

class Webpage {
    // Properties
    private $title;
    private $active;

    // Constructor to initialize webpage properties
    public function __construct($title, $active) {
        $this->title = $title;
        $this->active = $active;
    }

    // Method to return the title
    public function getTitle() {
        return $this->title;
    }

    // Method to return the active class for navigation
    public function getActive($type) {
        if ($type == "discover") {
            return in_array($this->active, ["animal", "facility"]) ? 'active text-bg-light' : '';
        }
        return $type == $this->active ? 'active text-bg-light' : '';
    }

    // Method to determine if the footer should be hidden
    public function disableFooter() {
        echo in_array($this->active, ["account", "profile"]) ? "hidden" : '';
    }

    // Method to determine if a section should be hidden
    public function getSectionDisplay($type) {
        if (isset($_GET["type"]) && $_GET["type"] !== $type) {
            echo "hidden";
        }
    }

    // Method to determine if flatpickr should be included
    public function getFlatPickr() {
        return in_array($this->active, ["ticket", "hotel"]);
    }

    // Method to determine if the current page is animal-related
    public function getAnimal() {
        return $this->active == "animal";
    }
}

