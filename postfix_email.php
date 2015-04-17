<?php
/**
 * Created by PhpStorm.
 * User: stephen
 * Date: 4/17/15
 * Time: 11:57 AM
 */

class postfix_email {
    /**
     * @var Email address
     */
    public $address;

    /**
     * @var Action postfix will take if date range is valid (it will auto reject if date not valid)
     */
    public $postfix_action;

    CONST POSTFIX_ACCEPT = "ACCEPT";
    CONST POSTFIX_REJECT = "REJECT";

    /**
     * @var Date this entry was created
     */
    public $creation_datetime;

    /**
     * @var Date last updated (any update, including counters)
     */
    public $edited_datetime;

    /**
     * @var Website for which this was created
     */
    public $website;

    /**
     * @var Start date when this becomes valid
     */
    public $valid_start_datetime;

    /**
     * @var End date when this stops being valid
     */
    public $valid_end_datetime;

    /**
     * @var Number of successful (non-rejection) emails.
     */
    public $count_emails_received;

    /**
     * @var Number of rejected emails.
     */
    public $count_emails_rejected;

    /**
     * @param null $email_id Email id to load from database. If not defined, create a blank class.
     */
    public function __construct($email_id = null){
        if ($email_id){

        } else {
            $this->address = '';
            $this->postfix_action = self::POSTFIX_ACCEPT;
            $this->creation_datetime = new DateTime();
            $this->edited_datetime = new DateTime();
            $this->website = '';
            $this->valid_start_datetime = new DateTime();
            $this->valid_end_datetime = new DateTime('now +2 years');
            $this->count_emails_received = 0;
            $this->count_emails_rejected = 0;
        }
    }

    /**
     * Returns true if the email is blacklisted.
     * Email is blacklisted if the current date is not within the  valid start and end,
     * or if it has been manually blacklisted by the user.
     * @param bool $manually_blacklisted If true, only return a TRUE result if the email has been manually blacklisted (disregard any dates)
     * @return bool
     */
    public function is_blacklisted($manually_blacklisted = false) {
        $blacklist = false;

        if (!$manually_blacklisted){
            $blacklist = !($this->is_valid_date());
        }

        if ($this->postfix_action == email::POSTFIX_REJECT){
            $blacklist = true;
        }
        return $blacklist;

    }

    /**
     * Returns TRUE if the current date is between the start and end valid dates.
     * @return bool
     */
    public function is_valid_date() {
        $current_date = new DateTime();
        // @TODO get datetimes from database
        return (($current_date >= $this->valid_start_datetime) && ($current_date <= $this->valid_end_datetime));
    }

    /**
     * Returns the proper postfix action
     * @return string
     */
    public function postfix_action() {
        if ($this->is_blacklisted()){
            return self::POSTFIX_REJECT;
        } else {
            return self::POSTFIX_ACCEPT;
        }
    }
}