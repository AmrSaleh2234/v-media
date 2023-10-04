<?php

namespace App\Traits;

use Illuminate\Support\MessageBag;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

trait ApiTrait
{
    protected $success = 'success';
    protected $error = 'error';

    protected $user, $site_mark;
    protected $language_multiple = 'yes';
    protected $site_language = "en";
    protected $limit = 10;
    protected $lang_array = ['ar', 'en'];

    protected function authUser()
    {
        return auth()->user();
    }

    protected function authUserID()
    {
        $id = 0;
        $user = $this->authUser();
        if ($user) {
            $id = $user->id;
        }
        return $id;
    }

    protected function successResponse($data = null, $message = 'Success', $statusCode = Response::HTTP_OK)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    protected function errorResponse($message = 'Error', $statusCode = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $statusCode);
    }

    protected function pendingResponse($message = 'Pending', $statusCode = Response::HTTP_ACCEPTED)
    {
        return response()->json([
            'status' => 'pending',
            'message' => $message,
        ], $statusCode);
    }

    protected function deniedResponse($data = null, $message = 'Denied', $statusCode = Response::HTTP_FORBIDDEN)
    {
        return response()->json([
            'status' => 'denied',
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    protected function validationErrorResponse(MessageBag $errors, $message = 'Validation Error', $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }

    protected function resourceResponse(JsonResource $resource, $statusCode = Response::HTTP_OK)
    {
        return $resource->response()->setStatusCode($statusCode);
    }

    protected function collectionResponse(ResourceCollection $collection, $includeMetaLinks = true, $statusCode = Response::HTTP_OK)
    {
        $response = $collection->response();
        $response->setStatusCode($statusCode);

        $data = ['data' => $collection->collection];
        if ($includeMetaLinks) {
            $meta = [
                'total' => $collection->total(),
                'count' => $collection->count(),
                'per_page' => $collection->perPage(),
                'current_page' => $collection->currentPage(),
                'total_pages' => $collection->lastPage(),
                'from' => $collection->firstItem(),
                'last_page' => $collection->lastPage(),
                'path' => $collection->path(),
                'to' => $collection->lastItem(),
            ];

            $links = [
                'first' => $collection->url(1),
                'last' => $collection->url($collection->lastPage()),
                'prev' => $collection->previousPageUrl(),
                'next' => $collection->nextPageUrl(),
            ];
            $data['meta'] = $meta;
            $data['links'] = $links;
        }

        return $this->successResponse($data, 'Success', $statusCode);
    }

    protected function collectionResponseWith(ResourceCollection $collection, $data_with = null, $data_with_array = null, $includeMetaLinks = true, $statusCode = Response::HTTP_OK)
    {
        $response = $collection->response();
        $response->setStatusCode($statusCode);

        $data = ['data' => $collection->collection];

        if ($includeMetaLinks) {
            $meta = [
                'total' => $collection->total(),
                'count' => $collection->count(),
                'per_page' => $collection->perPage(),
                'current_page' => $collection->currentPage(),
                'total_pages' => $collection->lastPage(),
                'from' => $collection->firstItem(),
                'last_page' => $collection->lastPage(),
                'path' => $collection->path(),
                'to' => $collection->lastItem(),
            ];

            $links = [
                'first' => $collection->url(1),
                'last' => $collection->url($collection->lastPage()),
                'prev' => $collection->previousPageUrl(),
                'next' => $collection->nextPageUrl(),
            ];
            $data['meta'] = $meta;
            $data['links'] = $links;
        }
        if ($data_with) {
            foreach ($data_with as $key => $value) {
                $data[$key] = $value;
            }
        }
        if ($data_with_array) {
            foreach ($data_with_array as $key_array => $value_array) {
                if (!empty($value_array)) {
                    foreach ($value_array as $key_array_value => $array_value) {
                        if ($key != "data") {
                            $data[$key_array][$key_array_value] = $array_value;
                        }
                    }
                }
            }
        }

        return $this->successResponse($data, 'Success', $statusCode);
    }

    public function getMessageError($code = null)
    {
        $message = NULL;
        switch ($code) {
            case 'password_old':
                $message = __("password does not match the database password");
                break;
            case 'image':
                $message = __('Upload Image Fail');
                break;
            case 'phone':
                $message = __("We can't find a user with that phone.");
                break;
            case 'email':
                $message = __("We can't find a user with that e-mail address.");
                break;
            case 'token':
                $message = __('This password reset token is invalid.');
                break;
            case 'code':
                $message = __('Code not found');
                break;
            case 'user':
                $message = __('User not found');
                break;
            case 'project':
                $message = __('Project not found');
                break;
            case 'not_found':
                $message = __('Not found');
                break;
            case 'delete':
                $message = __('Delete');
                break;
            case 'notifi_not_found':
                $message = __('Notification Not found');
                break;
            case 'notifi_delete':
                $message = __('Notification Delete');
                break;
            case 'unauthorise':
                $message = __('Unauthorise');
                break;
            case 'device':
                $message = __('Login From Other Device');
                break;
            case 'time':
                $message = __("please don't make it again in another time i will block your account");
                break;
            case 'card-id':
                $message = __('message.not-found', ['model' => __('names.card-id')]);
                break;
            case 'id':
                $message = __('message.not-found', ['model' => __('names.id')]);
                break;
            case 'pending':
                $message = __('message.request-pending');
                break;
            case 'denied':
                $message = __('message.request-denied');
                break;
            case 'wrong-otp':
                $message = __('message.wrong-otp');
                break;
            case 'requests-limit':
                $message = __('message.requests-limit');
                break;
        }
        return $message;
    }

    public function getMessageSuccess($code = null)
    {
        $message = NULL;
        switch ($code) {
            case 'password':
                $message = __('Update Password');
                break;
            case 'profile':
                $message = __('Update Profile');
                break;
            case 'locale':
                $message = __('Update Language');
                break;
            case 'image_update':
                $message = __('Update Image');
                break;
            case 'image_delete':
                $message = __('Delete Image');
                break;
            case 'action':
                $message = __('Action update successfully');
                break;
            case 'image':
                $message = __('Image upload successfully');
                break;
            case 'post':
                $message = __("Post send successfully");
                break;
            case 'contact':
                $message = __("Contact Us send successfully");
                break;
            case 'comment':
                $message = __("Comment send successfully");
                break;
            case 'success':
                $message = __('Send Successfully');
                break;
            case 'logout':
                $message = __('Successfully logged out');
                break;
        }
        return $message;
    }

    public function notAuthenticat()
    {
        return response()->json([
            'status' => 'Not Authenticated',
            'message' => 'You are not logged in',
            'data' => null,
        ], 401);
    }
}
