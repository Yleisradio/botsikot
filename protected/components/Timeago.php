<?php

/**
 * Wrapper for timeago.js
 */
class Timeago
{

    /**
     * Echoes unknown for a unix epoch timestamp.
     * @param type $timestamp
     * @return string
     */
    public function timeagoOrUnknown($timestamp)
    {
        if (!$timestamp) {
            return 'Ei tiedossa';
        } else {
            return CHtml::tag("abbr", array("class" => "timeago", "title" => date("r", $timestamp)), date("d.m.Y H:i", $timestamp));
        }
    }

}