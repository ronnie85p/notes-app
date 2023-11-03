<?php
namespace App\Services;

use App\Models\Feedback;
use App\Models\Profile\Settings;
use App\Services\ProfileService;
use App\Mail\FeedbackShipped;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FeedbackService
{
    public static function getList()
    {
        return Feedback::all();
    }

    public static function send(array $data)
    {
        // $settings = ProfileService::getSettings();
        // if ($settings->email) {
        //     throw new BadRequestHttpException('Укажите email в настройках');
        // }

        $created = Feedback::create($data);
        //Mail::to($settings->email)->send(new FeedbackShipped($feedback));

        return $created;
    }
}