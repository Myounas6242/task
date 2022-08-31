<?php

namespace App\Events;

use App\Models\Department;
use App\Models\User;
use App\Models\UserDepartment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateUserEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {

        $this->user = $user;

        $departments = Department::get();
        $count = count($departments);
        if($count > 1){
            $selected_departments = [];
            while (sizeof($selected_departments) < 2) {
                $rand_number = rand(0, $count - 1);
                $selected_departments[] = $departments[$rand_number];
                $selected_departments = array_unique($selected_departments);
            }
            foreach ($selected_departments as $department) {
                UserDepartment::create([
                    'user_id' => $user->id,
                    'department_id' => $department->id,
                ]);
            }
        }
       
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
