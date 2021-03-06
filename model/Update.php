<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Zone_Redirect
 * @subpackage Zone_Redirect/admin/model
 * @author     Zekinah Lecaros <zjlecaros@gmail.com> 
 * 
 */

/******************************************************************
This Model is the parent model class that returns database object
 *******************************************************************/
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
	exit;
}

class Zone_Redirect_Model_Update
{
    protected $redirect_links;
    protected $redirect_visits;
    protected $wpdb;

    public function __construct() {
        global $wpdb;

        $this->redirect_links = "`" . $wpdb->prefix . "zn_redirect_links`";
        $this->redirect_visits = "`" . $wpdb->prefix . "zn_redirect_visits`";
        $this->wpdb = $wpdb;
    }

    public function update_redirection_link($zn_id,$zn_from,$zn_to,$zn_type)
    {
        $query = "
            UPDATE " . $this->redirect_links . " SET
                `From` = '". $zn_from."',
                `To` = '". $zn_to."',
                `Type` = '". $zn_type."'
            WHERE `Redirect_ID` = '". $zn_id."'";
        $result = $this->wpdb->query($query);
        if ($result) {
            return true;
        } else {
            $this->wpdb->show_errors();
        }
    }

    public function trashLink($zn_id)
    {
        $query = "
            DELETE FROM " . $this->redirect_links . " WHERE `Redirect_ID` = '". $zn_id."'";
        $result = $this->wpdb->query($query);
        if ($result) {
            return true;
        } else {
            $this->wpdb->show_errors();
        }
    }

    public function offRedirectLink($zn_id)
    {
        $query = "
            UPDATE " . $this->redirect_links . " SET
                `Status` = '0'
            WHERE `Redirect_ID` = '". $zn_id."'";
        $result = $this->wpdb->query($query);
        if ($result) {
            return true;
        } else {
            $this->wpdb->show_errors();
        }
    }

    public function onRedirectLink($zn_id)
    {
        $query = "
            UPDATE " . $this->redirect_links . " SET
                `Status` = '1'
            WHERE `Redirect_ID` = '". $zn_id."'";
        $result = $this->wpdb->query($query);
        if ($result) {
            return true;
        } else {
            $this->wpdb->show_errors();
        }
    }
}
