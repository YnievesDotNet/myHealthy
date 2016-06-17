<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\ConciergeStrategy as Concierge;
use App\Business;
use App\Vacancy;
use Redirect;
use Flash;
use Log;
use BootstrapCalendar;

class BusinessVacancyController extends Controller
{
    /**
     * TODO: This should probably not be a resource Controller
     */

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Business $business)
    {
        Log::info("BusinessServiceController: indexing: businessId:{$business->id}");
        $calendar = BootstrapCalendar::setOptions([
            'firstDay' => 1,
            'aspectRatio' => 3,
            'events' => route('api.business.vacancy'),
            'eventLimit' => 'false',
            'events' => route('api.business.vacancy', $business->id),
        ]);
        $events = [];

        $events[] = BootstrapCalendar::event(
            'Event One', //event title
            false, //full day event?
            '2015-12-25T0800', //start time (you can also use Carbon instead of DateTime)
            '2015-12-26T0800', //end time (you can also use Carbon instead of DateTime)
            0 //optionally, you can specify an event ID
        );

        $events[] = BootstrapCalendar::event(
            "Valentine's Day", //event title
            true, //full day event?
            new \DateTime('2015-12-28'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2015-12-28'), //end time (you can also use Carbon instead of DateTime)
            'stringEventId' //optionally, you can specify an event ID
        );
//addEvents($events)->
        $calendar = BootstrapCalendar::setOptions([ //set fullcalendar options
            'firstDay' => 1,
            'editable' => true,
            'laziFetching' => false,
            'eventSources' => route('api.business.vacancy', $business->id),
        ]);
        $dates = Concierge::generateAvailability($business->vacancies);
        $services = $business->services;
        return view('manager.businesses.vacancies.index', compact('business', 'dates', 'services', 'calendar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Business $business)
    {
        Log::info("BusinessServiceController: create: businessId:{$business->id}");

        $dates = Concierge::generateAvailability($business->vacancies);
        $services = $business->services;
        return view('manager.businesses.vacancies.edit', compact('business', 'dates', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Business $business, Request $request)
    {
        Log::info("BusinessServiceController: store: businessId:{$business->id}");
        $dates = $request->get('vacancy');
        $success = false;
        foreach ($dates as $date => $vacancy) {
            foreach ($vacancy as $serviceId => $capacity) {
                switch (trim($capacity)) {
                    case '':
                        // Dont update, leave as is
                        Log::info("BusinessServiceController: store: [ADVICE] Blank vacancy capacity value businessId:{$business->id}");
                        break;
                    default:
                        $vacancy = Vacancy::updateOrCreate(['business_id' => $business->id, 'service_id' => $serviceId, 'date' => $date], ['capacity' => intval($capacity)]);
                        $success = true;
                        break;
                }
            }
        }
        if (!$success) {
            Log::info("BusinessServiceController: store: [ADVICE] Nothing to update businessId:{$business->id}");
            Flash::warning(trans('manager.vacancies.msg.store.nothing_changed'));
            return Redirect::back();
        }
        Flash::success(trans('manager.vacancies.msg.store.success'));
        return Redirect::route('manager.business.show', [$business]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        // TODO: Provide elegant display of individual Vacancy
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit(Business $business)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
