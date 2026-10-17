<?php
declare(strict_types=1);
final class RegistrationPolicy {
    public function decide(int $capacity, int $registered,
        bool $open, bool $waitingEnabled): string {
        // 1. Du lieu sai -> rejected
        if ($capacity <= 0 || $registered < 0 || $registered > $capacity) {
            return 'rejected';
        }
        // 2. Su kien dong -> rejected (ke ca con cho)
        if (!$open) {
            return 'rejected';
        }
        // 3. Con cho -> confirmed
        if ($registered < $capacity) {
            return 'confirmed';
        }
        // 4. Het cho: co danh sach cho -> waiting, khong co -> rejected
        return $waitingEnabled ? 'waiting' : 'rejected';
    }
}