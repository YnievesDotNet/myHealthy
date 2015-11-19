<?php

namespace App;

use App\Appointment;
use App\Business;
use Carbon\Carbon;

class BookingStrategyTimeslot implements BookingStrategyInterface
{
    public function makeReservation(Business $business, $data)
    {
        $data['business_id'] = $business->id;
        $appointment = new Appointment($data);
        return $appointment->save();
    }
}
