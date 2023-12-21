<?php

/**
 * isLoggedIn
 * ----------
 * Geeft true als er iemand is ingelogd, anders een false
 *
 * @return boolean      TRUE als er iemand is ingelogd, FALSE als er niemand is ingelogd.
 */
function isLoggedIn(): bool
{
    if(isset($_SESSION['user_id']) && isset($_SESSION['username']))
        return true;

    return false;
}

/**
 * getLoggedInUsername
 * -------------------
 * Geeft de username van de ingelogde user terug. Is er nog niemand ingelogd
 * dan geven we een lege string terug.
 *
 * @return string       Username van de ingelogde user of Leeg
 */
function getLoggedInUsername(): string 
{
    if(isset($_SESSION['username']) && session_status() == PHP_SESSION_ACTIVE)
        return $_SESSION['username'];

    return '';
}


/**
 * getLoggedInUserID
 * -----------------
 * Geeft de ID van de ingelogde user als INT terug. Als er niemand is ingelogd
 * geeft deze functie een waarde 0 terug.
 *
 * @return integer              ID van de ingelogde user of 0
 */
function getLoggedInUserID(): int
{
    if(isset($_SESSION['user_id']) && session_status() == PHP_SESSION_ACTIVE)
        return intval($_SESSION['user_id']);

    return 0;
}