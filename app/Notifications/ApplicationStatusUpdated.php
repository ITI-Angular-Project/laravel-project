<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Application $application)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $status = ucfirst($this->application->status);
        
        return (new MailMessage)
            ->subject("Your job application was {$status}")
            ->greeting("Hello {$notifiable->name},")
            ->line("Your application for **{$this->application->job->title}** was {$status}.")
            ->action('View Application', route('dashboard.applications.show', $this->application->id))
            ->line('Thank you for using our platform!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
            'title' => 'Application status updated',
            'message' => "Your application for '{$this->application->job->title}' was {$this->application->status}.",
            'application_id' => $this->application->id,
            'job_id' => $this->application->job_id,
            'status' => $this->application->status,
            'url' => route('dashboard.applications.show', $this->application->id),
        ];
    }
}
