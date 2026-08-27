<?php

class ActivityLog extends Model
{
    public function record(
        string $action,
        ?string $description = null,
        ?int $userId = null
    ): void {

        $this->query(
            "INSERT INTO activity_logs
            (
                user_id,
                action,
                description,
                ip_address,
                user_agent
            )
            VALUES
            (
                :user_id,
                :action,
                :description,
                :ip,
                :user_agent
            )",
            [
                'user_id' => $userId ?? Auth::id(),
                'action' => $action,
                'description' => $description,
                'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
                'user_agent' =>
                    $_SERVER['HTTP_USER_AGENT'] ?? null
            ]
        );
    }
}