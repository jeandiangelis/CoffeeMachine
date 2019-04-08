<?php

namespace App\Examples;

/** without dependecy injection / inversion of control */
class ReservatorBad
{
    private $reservationClient;

    public function __construct()
    {
        $this->reservationClient = new ReservationClient('x', 'y'); // <--- class can not be tested without testing client class
    }

    // no single responsibility
    public function saveReservation(\DateTime $time, Customer $customer)
    {
        $reservations = (new \PDO('x'))->query('SELECT * FROM reservations'); // Data not mockable, no cqs.

        if ($this->isAvailable($time, $reservations)) {
            $this->reservationClient->reserve($customer);
        };

        $this->sendEmail($customer); // sends email as sideffect
    }

}

class ReservatorGood
{
    private $reservationClient;
    private $availabiltyChecker;

    public function __construct(ReservationClient $reservationClient, $availabiltyChecker)
    {
        $this->reservationClient = $reservationClient; // Now we can mock client as needed
        $this->availabiltyChecker = $availabiltyChecker;
    }

    public function saveReservation(\DateTime $time, $amountNeededPlaces, $customer)
    {
        if ($this->availabiltyChecker->isAvailable($time, $amountNeededPlaces)) {
            $this->reservationClient->reserve($customer);
            $this->triggerReservationAcceptedEvent();
        };

        $this->triggerReservationDeclinedEvent();
    }


}