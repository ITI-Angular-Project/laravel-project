<?php

namespace App\Notifications;

use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobsStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Job $job)
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
        $status = ucfirst($this->job->status);
        return (new MailMessage)
            ->subject("Job status updated: {$this->job->title} ({$status})")
            ->greeting("Hello {$notifiable->name},")
            ->line("Your job **{$this->job->title}** has been {$status}.")
            ->action('View Job', route('dashboard.jobs.show', $this->job->id))
            ->line('Thanks for using our platform!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title'     => 'Job status updated',
            'message'   => "Your job \"{$this->job->title}\" has been ".ucfirst($this->job->status).".",
            'job_id'    => $this->job->id,
            'status'    => $this->job->status,
            'company_id'=> $this->job->company_id,
            'url'       => route('dashboard.jobs.show', $this->job->id),
        ];
    }
}
