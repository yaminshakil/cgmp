<?php

namespace App\Support;

use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

/**
 * Sends contact-form emails using the SMTP account configured in Admin → Settings,
 * falling back to the app's .env mail configuration when none is saved.
 */
class ContactMailer
{
    public static function recipient(): ?string
    {
        return Setting::get('mail_to') ?: config('mail.contact_to');
    }

    public static function send(ContactMessage $message): void
    {
        $mailable = new ContactMessageReceived($message, static::fromAddress());

        static::mailer()->to(static::recipient())->send($mailable);
    }

    public static function sendTest(): void
    {
        $test = new ContactMessage([
            'name' => 'Test message',
            'email' => static::fromAddress() ?: config('mail.from.address'),
            'message' => 'This is a test email from the website admin panel. If you received it, contact-form emails are working.',
        ]);

        static::send($test);
    }

    public static function fromAddress(): ?string
    {
        return Setting::get('mail_username') ?: null;
    }

    public static function storePassword(?string $password): void
    {
        $password = preg_replace('/\s+/', '', (string) $password);

        Setting::query()->updateOrCreate(
            ['key' => 'mail_password'],
            ['value' => $password === '' ? null : Crypt::encryptString($password)]
        );
    }

    public static function hasPassword(): bool
    {
        return (bool) Setting::query()->where('key', 'mail_password')->value('value');
    }

    protected static function password(): ?string
    {
        $stored = Setting::query()->where('key', 'mail_password')->value('value');

        try {
            return $stored ? Crypt::decryptString($stored) : null;
        } catch (DecryptException) {
            return null;
        }
    }

    protected static function mailer()
    {
        $username = static::fromAddress();
        $password = static::password();

        if (! $username || ! $password) {
            return Mail::mailer();
        }

        return Mail::build([
            'transport' => 'smtp',
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'username' => $username,
            'password' => $password,
        ]);
    }
}
