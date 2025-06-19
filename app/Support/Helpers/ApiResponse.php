<?php

namespace App\Support\Helpers;

use App\ValueObjects\BaseValueObject;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiResponse
{
    public static function success(?string $message = null, int $statusCode = 200)
    {
        return response()->json([
            'status' => true,
            'status_code' => $statusCode,
            'message' => $message ?? trans('apiresponse.success_message'),
        ], $statusCode);
    }

    public static function item(array|JsonResource|null|BaseValueObject $data = null, ?string $message = null, int $statusCode = 200)
    {
        return response()->json([
            'data' => $data,
            'status' => true,
            'status_code' => $statusCode,
            'message' => $message ?? trans('apiresponse.success_message'),
        ], $statusCode);
    }

    public static function error(?string $message = null, int $statusCode = 400, array $errors = [])
    {
        if (empty($errors)) {
            $errors = [$message];
        }

        return response()->json([
            'status' => false,
            'status_code' => $statusCode,
            'message' => $message ?? trans('apiresponse.error_message'),
            'errors' => $errors,
        ], $statusCode);
    }

    public static function created($data = null, ?string $message = null)
    {
        return self::item($data, $message ?? trans('apiresponse.created_message'), 201);
    }

    public static function updated($data = null, ?string $message = null)
    {
        return self::item($data, $message ?? trans('apiresponse.updated_message'));
    }

    public static function deleted(?string $message = null)
    {
        return self::success($message ?? trans('apiresponse.deleted_message'));
    }

    public static function collection(ResourceCollection $collection, ?string $message = null)
    {
        $return = [
            'status' => true,
            'status_code' => 200,
            'message' => $message ?? trans('apiresponse.success_message'),
            'data' => $collection->response()->getData()->data,
        ];

        if (! empty($collection->response()->getData()->meta)) {
            $meta = $collection->response()->getData()->meta;
            $return['meta'] = $meta;
            unset($meta->links);
            unset($meta->path);
        }

        return $return;
    }
}
