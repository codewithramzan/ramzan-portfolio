<?php

declare(strict_types=1);

class Mailer
{
    public static function send(
        string $to,
        string $subject,
        string $html,
        ?string $text = null
    ): bool {
        $config = require BASE_PATH . '/config/config.php';
        $mail = $config['mail'] ?? [];

        $driver = $mail['driver'] ?? 'log';

        if ($driver === 'log') {
            $line = sprintf(
                "[%s] TO: %s | SUBJECT: %s | BODY: %s%s",
                date('Y-m-d H:i:s'),
                $to,
                $subject,
                $text ?? strip_tags($html),
                PHP_EOL
            );

            $logFile = BASE_PATH . '/storage/logs/mail.log';

            if (!is_dir(dirname($logFile))) {
                mkdir(dirname($logFile), 0750, true);
            }

            return file_put_contents(
                $logFile,
                $line,
                FILE_APPEND | LOCK_EX
            ) !== false;
        }

        $fromAddress = $mail['from_address'] ?? 'no-reply@example.com';
        $fromName = $mail['from_name'] ?? 'Website';

        $headers = [
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $fromName . ' <' . $fromAddress . '>',
        ];

        return mail(
            $to,
            $subject,
            $html,
            implode("\r\n", $headers)
        );
    }
}
