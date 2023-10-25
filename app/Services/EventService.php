<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\Event;
use App\Models\EventMember;

class EventService
{
    public static function toArray($collection)
    {
        return array_values($collection->toArray());
    }

    public static function getAll()
    {
        return self::toArray(Event::all()->where('user_id', '!=', Auth::user()->id));
    }

    public static function getAllByCreator()
    {
        return self::toArray(Event::all()->where('user_id', '=', Auth::user()->id));
    }

    public static function getMembers(int $evtId)
    {
        $results = EventMember::all()->where('event_id', $evtId);
        $results->load('event', 'user');

        return self::toArray($results);
    }

    public static function checkMember(int $evtId, int $userId)
    {
        return EventMember::where('event_id', $evtId)
            ->where('user_id', $userId)->exists();
    }

    public static function create(array $data)
    {
        $data['user_id'] = Auth::user()->id;
        $event = new Event($data);

        if (!$event->save()) {
            throw new BadRequestHttpException('Произошла непредвиденная ошибка!');
        }

        EventMember::create([
            'event_id' => $event->id,
            'user_id' => Auth::user()->id
        ]);

        return self::get($event->id);
    }

    public static function get(int $evtId)
    {
        $result = Event::find($evtId);
        $result->is_member = self::checkMember($evtId, Auth::user()->id);
        $result->is_creator = $result->user_id == Auth::user()->id;
        $result->load('user');

        return $result;
    }   

    public static function join(int $evtId)
    {
        if (!Event::find($evtId)->where('user_id', '!=', Auth::user()->id)->exists()) {
            throw new NotFoundHttpException('Событие не найдено!');
        }

        if (!self::checkMember($evtId, Auth::user()->id)) {
            $member = new EventMember([
                'event_id' => $evtId,
                'user_id' => Auth::user()->id
            ]);

            if (!$member->save()) {
                throw new BadRequestHttpException('Произошла непредвиденная ошибка!');
            }
        }
    }

    public static function leave(int $evtId)
    {
        $member = EventMember::where('user_id', Auth::user()->id)
            ->where('event_id', $evtId)->first();
        if ($member && !$member->delete()) {
            throw new BadRequestHttpException('Произошла непредвиденная ошибка!');
        }
    }

    public static function delete(int $evtId)
    {
        $event = Event::where('id', $evtId)
            ->where('user_id', '=', Auth::user()->id)->first();
        if ($event) {
            if (!($event->members()->delete() && $event->delete())) {
                throw new BadRequestHttpException('Произошла непредвиденная ошибка!');
            } 
        }
    }
}