<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use YnievesDotNet\FourStream\Events\MessageReceived as Received;

class TextController extends Controller
{
    public function sendText(Received $event)
    {
    	$data = $event->bucket->getData();
    	$data = json_decode($data['message']);
    	if(isset($data->node_id) and $data->node_id != "") {
            foreach ($nodes as $node) {
                if($node->getId() == $data->node_id) {
                    $event->bucket->getSource()->send(json_encode($data), $node);
                }
            };
        } else {
            $event->bucket->getSource()->send(json_encode($data));
        }
    }
}
