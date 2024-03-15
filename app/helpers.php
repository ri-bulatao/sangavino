<?php 



if(!function_exists('formatTime'))
{
    /**
     * format Time
     */
    function formatTime($time, $opt = "12")
    {
        if(!$time) {
            return '';
        }

        if($opt == "12") {
            return date('h:iA', strtotime($time));
        }
    }

}

if(!function_exists('formatDate'))
{
    /**
     * format date
     */
    function formatDate($date, $opt="fulldate")
    {
       return match($opt) {
           'dateInput' => date('Y-m-d'),
           'fulldate' => date('F d,Y', strtotime($date)),
           'dateTime' => date('M d,Y h:i A', strtotime($date)),
           'dateTimeWithSeconds' => date('Y-m-d h:i:s', strtotime($date)),
           'dateTimeLocal' => date('Y-m-d\TH:i', strtotime($date)),
           'time' => date('h:iA', strtotime($date)),
       };
    }

}


if(!function_exists('getAge'))
{
    /**
     * calculate the age base on the given date
     */
    function getAge($birth_date)
    {
        if($birth_date) {
            return \Carbon\Carbon::parse($birth_date)->age;
        }
    }

}



if(!function_exists('handleNullAvatar'))
{
    /**
     * handle Null Avatar Image
     */
    function handleNullAvatar($img)
    {
        return $img ?? '/img/noimg.svg';
    }
}


if(!function_exists('handleNullImage'))
{
    /**
     * handle Null Image
     */
    function handleNullImage($img)
    {
        return $img ?? '/img/noimg.png';
    }
}

if(!function_exists('handleNullCoverPhoto'))
{
    /**
     * handle Null Image
     */
    function handleNullCoverPhoto($img)
    {
        return $img ?? '/img/announcement/default.svg';
    }
}

if(!function_exists('handleRequestStatus'))
{
    /**
     * handle Null Image
     */
    function handleRequestStatus($status)
    {
        return match($status) 
        {
            0 => "<span class='badge badge-warning'>Pending <i class='fas fa-spinner ml-2'></i></span>",
            1 => "<span class='badge badge-success'>Approved <i class='fas fa-check-circle ml-2'></i></span>",
            2 => "<span class='badge badge-danger'>Declined <i class='fas fa-times-circle ml-2'></i> </span>"
        };
    }
}



if(!function_exists('isApproved'))
{
     /**
     * check if the status is approved
     */
    function isApproved($status)
    {
        return match($status) 
        {
            0 => "<span class='badge badge-warning'>Pending <i class='fas fa-spinner ml-2'></i></span>",
            1 => "<span class='badge badge-success'>Approved <i class='fas fa-check-circle ml-2'></i></span>",
            2 => "<span class='badge badge-danger'>Declined <i class='fas fa-times-circle ml-2'></i> </span>"
        };
    }

}

if(!function_exists('isVoter'))
{
     /**
     * check if the status is approved
     */
    function isVoter($bool)
    {
        return $bool == 0 ? "<span class='badge badge-warning'>No </span>"
        : "<span class='badge badge-success'> Yes <i class='fas fa-check-circle ml-2'></i></span>";
    }

}

if(!function_exists('isSolved'))
{
     /**
     * check if the status is approved
     */
    function isSolved($bool)
    {
        return $bool == 0 ? "<span class='badge badge-warning'>On Going <i class='fas fa-spinner ml-2'></i> </span>"
        : "<span class='badge badge-success'> Solved <i class='fas fa-check-circle ml-2'></i></span>";
    }

}